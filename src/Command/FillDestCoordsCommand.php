<?php

namespace App\Command;

use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:fill-dest-coords',
    description: 'Fills missing coordinates for destinations using the REST Countries API.',
)]
class FillDestCoordsCommand extends Command
{
    private EntityManagerInterface $em;
    private HttpClientInterface $client;

    public function __construct(EntityManagerInterface $em, HttpClientInterface $client)
    {
        parent::__construct();
        $this->em = $em;
        $this->client = $client;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Destination Coordinates Autofill');

        $repo = $this->em->getRepository(Destination::class);
        $destinations = $repo->findAll();

        $processed = 0;
        $success = 0;
        $failed = 0;

        foreach ($destinations as $dest) {
            // Skip if already filled
            if ($dest->getLatitude() !== null && $dest->getLongitude() !== null) {
                continue;
            }

            $country = $dest->getCountry();
            if (empty($country)) {
                $io->warning("Destination '{$dest->getName()}' has no country specified. Skipping.");
                continue;
            }

            $processed++;
            $io->text("Looking up coordinates for: {$dest->getName()} ({$country})...");

            try {
                // Fetch coordinates using injected HttpClient
                $response = $this->client->request('GET', 'https://restcountries.com/v3.1/name/' . urlencode($country));

                if ($response->getStatusCode() === 200) {
                    $data = $response->toArray();
                    
                    if (!empty($data) && isset($data[0]['latlng'])) {
                        $latlng = $data[0]['latlng'];
                        
                        $dest->setLatitude((string)$latlng[0]);
                        $dest->setLongitude((string)$latlng[1]);
                        
                        $this->em->persist($dest);
                        $success++;
                        $io->info("Found: [Lat: {$latlng[0]}, Lng: {$latlng[1]}]");
                    } else {
                        $failed++;
                        $io->error("No coordinates block found for {$country}.");
                    }
                } else {
                    $failed++;
                    $io->error("Failed to fetch API for {$country}. Status: " . $response->getStatusCode());
                }
            } catch (\Exception $e) {
                $failed++;
                $io->error("Exception querying {$country}: " . $e->getMessage());
            }

            // Important: sleep to avoid hammering the free public API
            usleep(250000); // 0.25 seconds
        }

        $this->em->flush();

        if ($processed > 0) {
            $io->success("Finished processing $processed destinations ($success successful, $failed failed). Database updated flawlessly!");
        } else {
            $io->success("All destinations already possess coordinates. Nothing to do!");
        }

        return Command::SUCCESS;
    }
}
