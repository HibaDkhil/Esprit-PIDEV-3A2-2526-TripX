<?php
namespace App\Controller\admin;

use App\Entity\Transport;
use App\Entity\Schedule;
use App\Entity\Bookingtrans;
use App\service\TransportService;
use App\service\ScheduleService;
use App\service\BookingtransService;
use App\service\ValidationService;
use App\service\DestinationTransService;
use App\Entity\DestinationTrans;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Dompdf\Dompdf;
use Dompdf\Options;


#[Route('/admin/transport')]
class TransportAdminController extends AbstractController
{
    private DestinationTransService $destService;
    private ValidatorInterface $validator;
    private TransportService $transportService;
    private ScheduleService $scheduleService;
    private BookingtransService $bookingService;
    private ValidationService $validation;

    public function __construct(
        TransportService $transportService,
        ScheduleService $scheduleService,
        BookingtransService $bookingService,
        ValidationService $validation,
        ValidatorInterface $validator,
        DestinationTransService $destService
    ) {
        $this->transportService = $transportService;
        $this->scheduleService  = $scheduleService;
        $this->bookingService   = $bookingService;
        $this->validation       = $validation;
        $this->validator        = $validator;
        $this->destService      = $destService;
    }
    // ════════════════════════════════

    // HELPER — build errors array from Symfony violations

    // ════════════════════════════════

    // ★ NEW — converts ConstraintViolationList into ['fieldName' => ['msg1', 'msg2']]

    private function buildErrors(iterable $violations): array

    {

        $map = [];

        foreach ($violations as $v) {

            $map[$v->getPropertyPath()][] = $v->getMessage();

        }

        return $map;

    }

    // ★ END NEW helper

    // ════════════════════════════════
    // DESTINATIONS HELPER
    // ════════════════════════════════

    private function getDestinations(): array
    {
        return $this->destService->getAllDestinations();
    }

    // ════════════════════════════════
    // DASHBOARD
    // ════════════════════════════════

    #[Route('', name: 'admin_transport_index')]
    public function index(): Response
    {
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'        => 'transport',
            'transports' => $this->transportService->getAllTransports(),
            'schedules'  => [],
            'bookings'   => [],
            'stats'      => $this->getStats('transport'),
        ]);
    }

    // ════════════════════════════════
    // TRANSPORT CRUD
    // ════════════════════════════════

    #[Route('/list', name: 'admin_transport_list')]
    public function transportList(): Response
    {
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'        => 'transport',
            'transports' => $this->transportService->getAllTransports(),
            'schedules'  => [],
            'bookings'   => [],
            'stats'      => $this->getStats('transport'),
        ]);
    }

    #[Route('/add', name: 'admin_transport_add', methods: ['GET', 'POST'])]
    public function addTransport(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('transport_form', $request->request->get('_token'))) {
                $this->addFlash('error', 'Invalid security token.');
                return $this->redirectToRoute('admin_transport_add');
            }

            $basePrice = (float) $request->request->get('basePrice');
            $capacity  = (int)   $request->request->get('capacity');
            $units     = (int)   $request->request->get('availableUnits');
            $eco       = (float) $request->request->get('sustainabilityRating');
            $type      = strtoupper((string) $request->request->get('transportType', ''));
            $provider  = $request->request->get('providerName');
            $model     = $request->request->get('vehicleModel');

            $t = new Transport();
            $t->setTransportType($type);
            $t->setProviderName($provider);
            $t->setVehicleModel($model);
            $t->setBasePrice($basePrice);
            $t->setCapacity($capacity);
            $t->setAvailableUnits($units);
            $t->setSustainabilityRating($eco);
            $t->setAmenities($request->request->get('amenities'));
            
            // Handle File Upload
            $imageFile = $request->files->get('imageFile');
            if ($imageFile) {
                $ext = $imageFile->guessExtension() ?: $imageFile->getClientOriginalExtension();
                $newFilename = uniqid().'.'.$ext;
                try {
                    $imageFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads/transport',
                        $newFilename
                    );
                    $t->setImageUrl('uploads/transport/' . $newFilename);
                } catch (\Exception $e) {
                    $errors['imageFile'][] = 'Could not upload image: ' . $e->getMessage();
                }
            }

            $t->setActive(true);
            // ★ Run Symfony Validator — uses Assert annotations on Transport entity

            $violations = $this->validator->validate($t);

            $errors     = $this->buildErrors($violations);


            // ★ Cross-field rule: capacity must be >= availableUnits

            if ($capacity > 0 && $units > 0 && $capacity < $units) {

                $errors['capacity'][] = 'Capacity (seats per vehicle) must be >= available units.';

            }


            // ★ If errors exist: re-render form WITH inline errors (no redirect)

            if (!empty($errors)) {

                return $this->render('admin/transportadmindashboard.html.twig', [

                    'tab'        => 'transport',

                    'formAction' => 'add',

                    'transport'  => null,

                    'errors'     => $errors,                        // ★ pass errors

                    'formData'   => $request->request->all(),      // ★ re-fill form values

                    'transports' => $this->transportService->getAllTransports(),

                    'schedules'  => [],

                    'bookings'   => [],

                    'stats'      => $this->getStats('transport'),

                ]);

            }

            // ★ No errors — persist

            $this->transportService->addTransport($t);
            $this->addFlash('success', 'Transport added successfully!');
            return $this->redirectToRoute('admin_transport_list');
        }

        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'        => 'transport',
            'formAction' => 'add',
            'transport'  => null,
            'transports' => $this->transportService->getAllTransports(),
            'schedules'  => [],
            'bookings'   => [],
            'stats'      => $this->getStats('transport'),
        ]);
    }

    #[Route('/edit/{id}', name: 'admin_transport_edit', methods: ['GET', 'POST'])]
    public function editTransport(int $id, Request $request): Response
    {
        $transport = $this->transportService->findById($id);
        if (!$transport) {
            $this->addFlash('error', 'Transport not found.');
            return $this->redirectToRoute('admin_transport_list');
        }

        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('transport_form', $request->request->get('_token'))) {
                $this->addFlash('error', 'Invalid security token.');
                return $this->redirectToRoute('admin_transport_edit', ['id' => $id]);
            }

            $basePrice = (float) $request->request->get('basePrice');
            $capacity  = (int)   $request->request->get('capacity');
            $units     = (int)   $request->request->get('availableUnits');
            $eco       = (float) $request->request->get('sustainabilityRating');
            $type      = strtoupper((string) $request->request->get('transportType', ''));
            $provider  = $request->request->get('providerName');
            $model     = $request->request->get('vehicleModel');

            $transport->setTransportType($type);
            $transport->setProviderName($provider);
            $transport->setVehicleModel($model);
            $transport->setBasePrice($basePrice);
            $transport->setCapacity($capacity);
            $transport->setAvailableUnits($units);
            $transport->setSustainabilityRating($eco);
            $transport->setAmenities($request->request->get('amenities'));
            
            // Handle File Upload
            $imageFile = $request->files->get('imageFile');
            if ($imageFile) {
                $ext = $imageFile->guessExtension() ?: $imageFile->getClientOriginalExtension();
                $newFilename = uniqid().'.'.$ext;
                try {
                    $imageFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads/transport',
                        $newFilename
                    );
                    // Optional: delete old image if it exists
                    $transport->setImageUrl('uploads/transport/' . $newFilename);
                } catch (\Exception $e) {
                    $errors['imageFile'][] = 'Could not upload image: ' . $e->getMessage();
                }
            }
            // ★ Validate with Symfony Validator

            $violations = $this->validator->validate($transport);

            $errors     = $this->buildErrors($violations);

            if ($capacity > 0 && $units > 0 && $capacity < $units) {

                $errors['capacity'][] = 'Capacity must be >= available units.';

            }

            if (!empty($errors)) {

                return $this->render('admin/transportadmindashboard.html.twig', [

                    'tab'        => 'transport',

                    'formAction' => 'edit',

                    'transport'  => $transport,

                    'errors'     => $errors,

                    'formData'   => $request->request->all(),

                    'transports' => $this->transportService->getAllTransports(),

                    'schedules'  => [],

                    'bookings'   => [],

                    'stats'      => $this->getStats('transport'),

                ]);

            }

            $this->transportService->updateTransport($transport);
            $this->addFlash('success', 'Transport updated successfully!');
            return $this->redirectToRoute('admin_transport_list');
        }

        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'        => 'transport',
            'formAction' => 'edit',
            'transport'  => $transport,
            'transports' => $this->transportService->getAllTransports(),
            'schedules'  => [],
            'bookings'   => [],
            'stats'      => $this->getStats('transport'),
        ]);
    }

    #[Route('/export/pdf', name: 'admin_transport_export_pdf')]
    public function exportPdf(): Response
    {
        $transports = $this->transportService->getAllTransports();
        
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        
        $html = $this->renderView('admin/transport_pdf.html.twig', [
            'transports' => $transports,
            'date'       => new \DateTime()
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="transport_fleet.pdf"'
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_transport_delete')]
    public function deleteTransport(int $id): Response
    {
        $transport = $this->transportService->findById($id);
        if (!$transport) { $this->addFlash('error', 'Transport not found.'); return $this->redirectToRoute('admin_transport_list'); }
        $this->transportService->deleteTransport($id);
        $this->addFlash('success', 'Transport deleted successfully!');
        return $this->redirectToRoute('admin_transport_list');
    }

    #[Route('/toggle/{id}', name: 'admin_transport_toggle')]
    public function toggleTransport(int $id): Response
    {
        $transport = $this->transportService->findById($id);
        if (!$transport) { $this->addFlash('error', 'Transport not found.'); return $this->redirectToRoute('admin_transport_list'); }
        $transport->setActive(!$transport->isActive());
        $this->transportService->updateTransport($transport);
        $this->addFlash('success', 'Transport status toggled!');
        return $this->redirectToRoute('admin_transport_list');
    }

    // ════════════════════════════════
    // SCHEDULE CRUD
    // ════════════════════════════════

    #[Route('/schedules', name: 'admin_schedule_list')]
    public function scheduleList(): Response
    {
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'schedule',
            'transports'   => $this->transportService->getAllTransports(),
            'schedules'    => $this->scheduleService->getAllSchedules(),
            'destinations' => $this->getDestinations(),
            'bookings'     => [],
            'stats'        => $this->getStats('schedule'),
        ]);
    }

    #[Route('/schedules/add', name: 'admin_schedule_add', methods: ['GET', 'POST'])]
    public function addSchedule(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('schedule_form', $request->request->get('_token'))) {
                $this->addFlash('error', 'Invalid security token.');
                return $this->redirectToRoute('admin_schedule_add');
            }

            $transportId = (int)   $request->request->get('transportId');
            $travelClass = $request->request->get('travelClass');
            $status      = $request->request->get('status', 'ON_TIME');
            $mult        = (float) $request->request->get('priceMultiplier', 1.0);
            $depDt       = $request->request->get('departureDatetime');
            $arrDt       = $request->request->get('arrivalDatetime');
            $rsStart     = $request->request->get('rentalStart');
            $rsEnd       = $request->request->get('rentalEnd');
            $depDestId   = (int) $request->request->get('departureDestinationId');
            $arrDestId   = (int) $request->request->get('arrivalDestinationId');

            $s = new Schedule();
            $s->setTransportId($transportId);
            $s->setDepartureDestinationId($depDestId);
            $s->setArrivalDestinationId($arrDestId);
            $s->setTravelClass($travelClass);
            $s->setStatus($status);
            $s->setPriceMultiplier($mult);
            $s->setAiDemandScore((float) $request->request->get('aiDemandScore', 0.0));
            $s->setDelayMinutes(0);

            if ($depDt)  $s->setDepartureDatetime(new \DateTime($depDt));
            if ($arrDt)  $s->setArrivalDatetime(new \DateTime($arrDt));
            if ($rsStart) $s->setRentalStart(new \DateTime($rsStart));
            if ($rsEnd)   $s->setRentalEnd(new \DateTime($rsEnd));
            // ★ Symfony Validator — uses Assert annotations on Schedule entity

            $violations = $this->validator->validate($s);

            $errors     = $this->buildErrors($violations);


            // ★ Cross-field date checks (cannot be done with basic Assert)

            if ($depDt && !$this->validation->isFutureDate(new \DateTime($depDt))) {

                $errors['departureDatetime'][] = 'Departure date must be in the future.';

            }

            if ($depDt && $arrDt && !$this->validation->isValidReturnDate(new \DateTime($depDt), new \DateTime($arrDt))) {

                $errors['arrivalDatetime'][] = 'Arrival must be after departure.';

            }

            if ($rsStart && $rsEnd && !$this->validation->isValidReturnDate(new \DateTime($rsStart), new \DateTime($rsEnd))) {

                $errors['rentalEnd'][] = 'Rental end must be after rental start.';

            }


            if (!empty($errors)) {

                return $this->render('admin/transportadmindashboard.html.twig', [

                    'tab'          => 'schedule',

                    'formAction'   => 'add',

                    'schedule'     => null,

                    'errors'       => $errors,

                    'formData'     => $request->request->all(),

                    'transports'   => $this->transportService->getAllTransports(),

                    'schedules'    => $this->scheduleService->getAllSchedules(),

                    'destinations' => $this->getDestinations(),

                    'bookings'     => [],

                    'stats'        => $this->getStats('schedule'),

                ]);

            }

            $this->scheduleService->addSchedule($s);
            $this->addFlash('success', 'Schedule added successfully!');
            return $this->redirectToRoute('admin_schedule_list');
        }

        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'schedule',
            'formAction'   => 'add',
            'schedule'     => null,
            'transports'   => $this->transportService->getAllTransports(),
            'schedules'    => $this->scheduleService->getAllSchedules(),
            'destinations' => $this->getDestinations(),
            'bookings'     => [],
            'stats'        => $this->getStats('schedule'),
        ]);
    }

    #[Route('/schedules/edit/{id}', name: 'admin_schedule_edit', methods: ['GET', 'POST'])]
    public function editSchedule(int $id, Request $request): Response
    {
        $schedule = $this->scheduleService->findById($id);
        if (!$schedule) {
            $this->addFlash('error', 'Schedule not found.');
            return $this->redirectToRoute('admin_schedule_list');
        }

        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('schedule_form', $request->request->get('_token'))) {
                $this->addFlash('error', 'Invalid security token.');
                return $this->redirectToRoute('admin_schedule_edit', ['id' => $id]);
            }

            $travelClass = $request->request->get('travelClass');
            $mult        = (float) $request->request->get('priceMultiplier', 1.0);
            $depDt       = $request->request->get('departureDatetime');
            $arrDt       = $request->request->get('arrivalDatetime');
            $rsStart     = $request->request->get('rentalStart');
            $rsEnd       = $request->request->get('rentalEnd');
            $depDestId   = (int) $request->request->get('departureDestinationId');
            $arrDestId   = (int) $request->request->get('arrivalDestinationId');

            $schedule->setTravelClass($travelClass);
            $schedule->setPriceMultiplier($mult);
            $schedule->setStatus($request->request->get('status', 'ON_TIME'));
            $schedule->setDepartureDestinationId($depDestId);
            $schedule->setArrivalDestinationId($arrDestId);
            $schedule->setAiDemandScore((float) $request->request->get('aiDemandScore', 0.0));

            if ($depDt)  $schedule->setDepartureDatetime(new \DateTime($depDt));
            if ($arrDt)  $schedule->setArrivalDatetime(new \DateTime($arrDt));
            if ($rsStart) $schedule->setRentalStart(new \DateTime($rsStart));
            if ($rsEnd)   $schedule->setRentalEnd(new \DateTime($rsEnd));

            // ★ Symfony Validator pattern
            $violations = $this->validator->validate($schedule);
            $errors     = $this->buildErrors($violations);

            // ★ Cross-field date checks
            if ($depDt && !$this->validation->isFutureDate(new \DateTime($depDt))) {
                $errors['departureDatetime'][] = 'Departure date must be in the future.';
            }
            if ($depDt && $arrDt && !$this->validation->isValidReturnDate(new \DateTime($depDt), new \DateTime($arrDt))) {
                $errors['arrivalDatetime'][] = 'Arrival must be after departure.';
            }
            if ($rsStart && $rsEnd && !$this->validation->isValidReturnDate(new \DateTime($rsStart), new \DateTime($rsEnd))) {
                $errors['rentalEnd'][] = 'Rental end must be after rental start.';
            }

            if (!empty($errors)) {
                return $this->render('admin/transportadmindashboard.html.twig', [
                    'tab'          => 'schedule',
                    'formAction'   => 'edit',
                    'schedule'     => $schedule,
                    'errors'       => $errors,
                    'formData'     => $request->request->all(),
                    'transports'   => $this->transportService->getAllTransports(),
                    'schedules'    => $this->scheduleService->getAllSchedules(),
                    'destinations' => $this->getDestinations(),
                    'bookings'     => [],
                    'stats'        => $this->getStats('schedule'),
                ]);
            }

            $this->scheduleService->updateSchedule($schedule);
            $this->addFlash('success', 'Schedule updated successfully!');
            return $this->redirectToRoute('admin_schedule_list');
        }


        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'schedule',
            'formAction'   => 'edit',
            'schedule'     => $schedule,
            'transports'   => $this->transportService->getAllTransports(),
            'schedules'    => $this->scheduleService->getAllSchedules(),
            'destinations' => $this->getDestinations(),
            'bookings'     => [],
            'stats'        => $this->getStats('schedule'),
        ]);
    }

    #[Route('/schedules/delete/{id}', name: 'admin_schedule_delete')]
    public function deleteSchedule(int $id): Response
    {
        $schedule = $this->scheduleService->findById($id);
        if (!$schedule) { $this->addFlash('error', 'Schedule not found.'); return $this->redirectToRoute('admin_schedule_list'); }
        $this->scheduleService->deleteSchedule($id);
        $this->addFlash('success', 'Schedule deleted successfully!');
        return $this->redirectToRoute('admin_schedule_list');
    }

    #[Route('/schedules/delay/{id}', name: 'admin_schedule_delay', methods: ['POST'])]
    public function delaySchedule(int $id, Request $request): Response
    {
        if (!$this->isCsrfTokenValid('schedule_action', $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid security token.');
            return $this->redirectToRoute('admin_schedule_list');
        }

        $schedule = $this->scheduleService->findById($id);
        if (!$schedule) { $this->addFlash('error', 'Schedule not found.'); return $this->redirectToRoute('admin_schedule_list'); }

        $delayMinutes = (int) $request->request->get('delayMinutes', 30);
        if ($delayMinutes <= 0) { $this->addFlash('error', 'Delay minutes must be greater than 0.'); return $this->redirectToRoute('admin_schedule_list'); }

        $schedule->setDelayMinutes($delayMinutes);
        $schedule->setStatus('DELAYED');
        $this->scheduleService->updateSchedule($schedule);
        $this->addFlash('success', 'Schedule marked as DELAYED (' . $delayMinutes . ' min).');
        return $this->redirectToRoute('admin_schedule_list');
    }

    #[Route('/schedules/cancel/{id}', name: 'admin_schedule_cancel')]
    public function cancelSchedule(int $id): Response
    {
        $schedule = $this->scheduleService->findById($id);
        if (!$schedule) { $this->addFlash('error', 'Schedule not found.'); return $this->redirectToRoute('admin_schedule_list'); }
        $schedule->setStatus('CANCELLED');
        $this->scheduleService->updateSchedule($schedule);
        $this->addFlash('success', 'Schedule cancelled.');
        return $this->redirectToRoute('admin_schedule_list');
    }

    #[Route('/export/schedules-csv', name: 'admin_schedule_export_csv')]
    public function exportSchedulesCsv(): StreamedResponse
    {
        $schedules = $this->scheduleService->getAllSchedules();

        $transportService = $this->transportService;
        $response = new StreamedResponse(function() use ($schedules, $transportService) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($handle, [
                'Schedule ID', 'Transport ID', 'From', 'To', 
                'Departure', 'Arrival', 'Base Price', 'Multiplier', 
                'Final Price', 'Class', 'Status'
            ], ';');

            foreach ($schedules as $s) {
                $transport = $transportService->findById($s->getTransportId());
                $basePrice = $transport ? $transport->getBasePrice() : 0.0;
                $finalPrice = $basePrice * $s->getPriceMultiplier();

                fputcsv($handle, [
                    $s->getScheduleId(),
                    $s->getTransportId(),
                    $s->getDepartureDestinationId(),
                    $s->getArrivalDestinationId(),
                    $s->getDepartureDatetime()?->format('Y-m-d H:i'),
                    $s->getArrivalDatetime()?->format('Y-m-d H:i'),
                    number_format($basePrice, 2, '.', ''),
                    $s->getPriceMultiplier(),
                    number_format($finalPrice, 2, '.', ''),
                    $s->getTravelClass(),
                    $s->getStatus()
                ], ';');
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="tripx_schedules.csv"');

        return $response;
    }

    // ════════════════════════════════
    // DESTINATION MANAGEMENT
    // ════════════════════════════════

    #[Route('/destinations', name: 'admin_destination_list')]
    public function listDestinations(): Response
    {
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'destination',
            'destinations' => $this->destService->getAllDestinations(),
            'stats'        => $this->getStats('destination'),
            'transports'   => [],
            'schedules'    => [],
            'bookings'     => [],
        ]);
    }

    #[Route('/destinations/add', name: 'admin_destination_add')]
    public function addDestination(Request $request): Response
    {
        $errors = [];
        $formData = [];

        if ($request->isMethod('POST')) {
            $formData = $request->request->all();
            
            $d = new DestinationTrans();
            $d->setName($request->request->get('name'));
            $d->setType($request->request->get('type'));
            $d->setCountry($request->request->get('country'));
            $d->setCity($request->request->get('city'));
            $d->setBestSeason($request->request->get('bestSeason'));
            $d->setDescription($request->request->get('description'));
            $d->setTimezone($request->request->get('timezone'));
            $d->setAverageRating((float)$request->request->get('averageRating', 0));

            $violations = $this->validator->validate($d);
            if (count($violations) > 0) {
                $errors = $this->buildErrors($violations);
            } else {
                $this->destService->addDestination($d);
                $this->addFlash('success', 'Destination added!');
                return $this->redirectToRoute('admin_destination_list');
            }
        }

        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'destination',
            'formAction'   => 'add',
            'formData'     => $formData,
            'errors'       => $errors,
            'destination'  => null,
            'destinations' => $this->destService->getAllDestinations(),
            'stats'        => $this->getStats('destination'),
            'transports'   => [],
            'schedules'    => [],
            'bookings'     => [],
        ]);
    }

    #[Route('/destinations/edit/{id}', name: 'admin_destination_edit')]
    public function editDestination(int $id, Request $request): Response
    {
        $destination = $this->destService->findById($id);
        if (!$destination) throw $this->createNotFoundException();

        $errors = [];
        $formData = [];

        if ($request->isMethod('POST')) {
            $formData = $request->request->all();
            
            $destination->setName($request->request->get('name'));
            $destination->setType($request->request->get('type'));
            $destination->setCountry($request->request->get('country'));
            $destination->setCity($request->request->get('city'));
            $destination->setBestSeason($request->request->get('bestSeason'));
            $destination->setDescription($request->request->get('description'));
            $destination->setTimezone($request->request->get('timezone'));
            $destination->setAverageRating((float)$request->request->get('averageRating', 0));

            $violations = $this->validator->validate($destination);
            if (count($violations) > 0) {
                $errors = $this->buildErrors($violations);
            } else {
                $this->destService->updateDestination($destination);
                $this->addFlash('success', 'Destination updated!');
                return $this->redirectToRoute('admin_destination_list');
            }
        }

        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'          => 'destination',
            'formAction'   => 'edit',
            'destination'  => $destination,
            'formData'     => $formData,
            'errors'       => $errors,
            'destinations' => $this->destService->getAllDestinations(),
            'stats'        => $this->getStats('destination'),
            'transports'   => [],
            'schedules'    => [],
            'bookings'     => [],
        ]);
    }

    #[Route('/destinations/delete/{id}', name: 'admin_destination_delete')]
    public function deleteDestination(int $id): Response
    {
        $this->destService->deleteDestination($id);
        $this->addFlash('success', 'Destination deleted.');
        return $this->redirectToRoute('admin_destination_list');
    }

    #[Route('/bookings/receipt/{id}', name: 'admin_booking_receipt_pdf')]
    public function exportReceiptPdf(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) throw $this->createNotFoundException('Booking not found.');

        $transport = $this->transportService->findById($booking->getTransportId());
        $schedule = $booking->getScheduleId() > 0 ? $this->scheduleService->findById($booking->getScheduleId()) : null;

        $qrCodeBase64 = null;
        if ($booking->getQrCode()) {
            $path = $this->getParameter('kernel.project_dir') . '/public/' . $booking->getQrCode();
            if (file_exists($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $mimeType = ($ext === 'svg') ? 'image/svg+xml' : 'image/' . $ext;
                $data = file_get_contents($path);
                $qrCodeBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($data);
            }
        }

        $html = $this->renderView('admin/booking_receipt_pdf.html.twig', [
            'booking' => $booking,
            'transport' => $transport,
            'schedule' => $schedule,
            'qrCodeBase64' => $qrCodeBase64,
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="receipt_#'. $id .'.pdf"',
        ]);
    }

    // ════════════════════════════════
    // BOOKING MANAGEMENT
    // ════════════════════════════════

    #[Route('/bookings', name: 'admin_booking_list')]
    public function bookingList(): Response
    {
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'        => 'booking',
            'transports' => $this->transportService->getAllTransports(),
            'schedules'  => [],
            'bookings'   => $this->bookingService->getAllBookings(),
            'stats'      => $this->getStats('booking'),
        ]);
    }

    #[Route('/bookings/confirm/{id}', name: 'admin_booking_confirm')]
    public function confirmBooking(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) { $this->addFlash('error', 'Booking not found.'); return $this->redirectToRoute('admin_booking_list'); }
        if ($booking->getBookingStatus() === 'CANCELLED') { $this->addFlash('error', 'Cannot confirm a cancelled booking.'); return $this->redirectToRoute('admin_booking_list'); }

        $booking->setBookingStatus('CONFIRMED');
        $booking->setPaymentStatus('PAID');
        $this->bookingService->updateBookingtrans($booking);
        $this->addFlash('success', 'Booking #' . $id . ' confirmed!');
        return $this->redirectToRoute('admin_booking_list');
    }

    #[Route('/export/bookings-csv', name: 'admin_booking_export_csv')]
    public function exportBookingsCsv(): StreamedResponse
    {
        $bookings = $this->bookingService->getAllBookings();

        $response = new StreamedResponse(function() use ($bookings) {
            $handle = fopen('php://output', 'w');
            
            // BOM for Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($handle, [
                'Booking ID', 'User ID', 'Transport ID', 'Schedule ID', 
                'Adults', 'Children', 'Total Seats', 'Total Price (EUR)', 
                'Booking Status', 'Payment Status', 'Insurance', 
                'Booking Date', 'Cancellation Reason'
            ], ';');

            foreach ($bookings as $b) {
                fputcsv($handle, [
                    $b->getBookingId(),
                    $b->getUserId(),
                    $b->getTransportId(),
                    $b->getScheduleId(),
                    $b->getAdultsCount(),
                    $b->getChildrenCount(),
                    $b->getTotalSeats(),
                    number_format($b->getTotalPrice(), 2, '.', ''),
                    $b->getBookingStatus(),
                    $b->getPaymentStatus(),
                    $b->isInsuranceIncluded() ? 'Yes' : 'No',
                    $b->getBookingDate()?->format('Y-m-d H:i:s'),
                    $b->getCancellationReason()
                ], ';');
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="tripx_bookings.csv"');

        return $response;
    }

    #[Route('/bookings/cancel/{id}', name: 'admin_booking_cancel', methods: ['POST'])]
    public function cancelBooking(int $id, Request $request): Response
    {
        if (!$this->isCsrfTokenValid('booking_action', $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid security token.');
            return $this->redirectToRoute('admin_booking_list');
        }

        $booking = $this->bookingService->findById($id);
        if (!$booking) { $this->addFlash('error', 'Booking not found.'); return $this->redirectToRoute('admin_booking_list'); }
        if ($booking->getBookingStatus() === 'CANCELLED') { $this->addFlash('error', 'Booking is already cancelled.'); return $this->redirectToRoute('admin_booking_list'); }

        $booking->setBookingStatus('CANCELLED');
        $booking->setCancellationReason($request->request->get('cancellationReason', ''));
        $this->bookingService->updateBookingtrans($booking);
        $this->addFlash('success', 'Booking #' . $id . ' cancelled.');
        return $this->redirectToRoute('admin_booking_list');
    }

    #[Route('/bookings/refund/{id}', name: 'admin_booking_refund')]
    public function refundBooking(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) { $this->addFlash('error', 'Booking not found.'); return $this->redirectToRoute('admin_booking_list'); }
        if ($booking->getPaymentStatus() === 'REFUNDED') { $this->addFlash('error', 'Booking is already refunded.'); return $this->redirectToRoute('admin_booking_list'); }
        if ($booking->getPaymentStatus() !== 'PAID') { $this->addFlash('error', 'Only PAID bookings can be refunded.'); return $this->redirectToRoute('admin_booking_list'); }

        $booking->setPaymentStatus('REFUNDED');
        $this->bookingService->updateBookingtrans($booking);
        $this->addFlash('success', 'Booking #' . $id . ' marked as REFUNDED.');
        return $this->redirectToRoute('admin_booking_list');
    }

    #[Route('/bookings/delete/{id}', name: 'admin_booking_delete')]
    public function deleteBooking(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) { $this->addFlash('error', 'Booking not found.'); return $this->redirectToRoute('admin_booking_list'); }
        $this->bookingService->deleteBookingtrans($id);
        $this->addFlash('success', 'Booking #' . $id . ' deleted.');
        return $this->redirectToRoute('admin_booking_list');
    }

    #[Route('/bookings/details/{id}', name: 'admin_booking_details')]
    public function bookingDetails(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) { $this->addFlash('error', 'Booking not found.'); return $this->redirectToRoute('admin_booking_list'); }
        return $this->render('admin/transportadmindashboard.html.twig', [
            'tab'            => 'booking',
            'bookingDetails' => $booking,
            'transports'     => $this->transportService->getAllTransports(),
            'schedules'      => [],
            'bookings'       => $this->bookingService->getAllBookings(),
            'stats'          => $this->getStats('booking')
        ]);
    }

    private function getStats(string $tab): array
    {
        $transports  = $this->transportService->getAllTransports();
        $schedules   = $this->scheduleService->getAllSchedules();
        $bookings    = $this->bookingService->getAllBookings();

        $activeTrans = 0;
        foreach ($transports as $t) if ($t->isActive()) $activeTrans++;

        $onTimeSched = 0;
        foreach ($schedules as $s) if ($s->getStatus() === 'ON_TIME') $onTimeSched++;

        $revenue = 0;
        $confirmed = 0;
        foreach ($bookings as $b) {
            if ($b->getBookingStatus() === 'CONFIRMED') {
                $confirmed++;
                $revenue += $b->getTotalPrice();
            }
        }

        return [
            'totalTransports'   => count($transports),
            'activeTransports'  => $activeTrans,
            'totalSchedules'    => count($schedules),
            'activeSchedules'   => $onTimeSched,
            'totalBookings'     => count($bookings),
            'confirmedBookings' => $confirmed,
            'revenue'           => $revenue
        ];
    }
}