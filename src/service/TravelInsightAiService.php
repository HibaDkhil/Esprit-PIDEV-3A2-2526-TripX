<?php

namespace App\service;

use App\Entity\Transport;
use Phpml\Classification\NaiveBayes;

class TravelInsightAiService
{
    /**
     * Predicts a travel insight based on transport type, price, and number of seats.
     */
    public function predictInsight(Transport $transport, int $seatCount = 1): string
    {
        $classifier = new NaiveBayes();

        // Training data: [Type, PriceRange, SeatConcentration]
        // PriceRanges: 1 = Budget, 2 = Mid, 3 = Premium
        // SeatGroup: 1 = Solo, 2 = Pair/Small Group (2-3), 3 = Family/Large Group (4+)
        $samples = [
            ['FLIGHT', 1, 1], ['FLIGHT', 1, 2], ['FLIGHT', 1, 3],
            ['FLIGHT', 2, 1], ['FLIGHT', 2, 2], ['FLIGHT', 2, 3],
            ['FLIGHT', 3, 1], ['FLIGHT', 3, 2], ['FLIGHT', 3, 3],
            ['BUS', 1, 1],    ['BUS', 1, 2],    ['BUS', 1, 3],
            ['BUS', 2, 1],    ['BUS', 2, 2],    ['BUS', 2, 3],
            ['TRAIN', 1, 1],  ['TRAIN', 1, 2],  ['TRAIN', 1, 3],
            ['TRAIN', 2, 1],  ['TRAIN', 2, 2],  ['TRAIN', 2, 3],
            ['TRAIN', 3, 1],  ['TRAIN', 3, 2],  ['TRAIN', 3, 3],
            ['CAR', 1, 1],    ['CAR', 1, 2],    ['CAR', 1, 3],
            ['CAR', 2, 1],    ['CAR', 2, 2],    ['CAR', 2, 3]
        ];

        $labels = [
            'Budget solo flight! Check in 24h early to snag the best remaining window seat.',
            'Budget flight for your group. Book bags together to save on separate processing fees.',
            'Large group budget flight. Ensure everyone has their boarding pass ready to speed up the gate process.',
            'Standard solo flight. Bringing a neck pillow? It is a lifesaver for those mid-range hauls.',
            'Mid-range flight for the pair. Coordinate your in-flight movie choices for a shared experience!',
            'Group flight booking. Keep all passports in one secure organizer to avoid airport stress.',
            'Premium solo travel. You have lounge access—arrive early and enjoy the tranquility before takeoff.',
            'Premium flight for the group. Priority boarding is included, so relax and take your time at the gate.',
            'High-end family flight. ARIA recommends booking the bulkhead seats for extra legroom with the kids.',
            'Solo bus trip. A window seat and a good playlist are your best friends today.',
            'Small group bus travel. Perfect time to catch up—those seats usually come in pairs anyway!',
            'Group bus trip! Keeping spirits high? Bring some travel games to share with the crew.',
            'Business bus trip. Modern coaches usually have Wi-Fi; catch up on work while the miles fly by.',
            'Comfort bus travel for the group. Stretch your legs at every stop to stay fresh for the arrival.',
            'Comfort bus journey! Pack a light blanket—the AC can vary depending on your seat position.',
            'Regional train hop. Quick and efficient. Have your digital ticket ready for the conductor.',
            'Train travel with a friend. Grab a table seat if you can to share snacks and surface space.',
            'Large group rail journey. Stick together in the same carriage for a more social atmosphere.',
            'Standard rail solo. Perfect quiet time—aria suggests a podcast or that book you have been meaning to start.',
            'Inter-city pair travel. Scenic views ahead! Keep your phone charged for those landscape photos.',
            'Group rail trip. Check if the dining car is open for a change of scenery during the ride.',
            'First-class rail. Pure comfort! The steward will be by shortly with refreshments.',
            'Premium group rail. Luxury on tracks—the spacious seating is perfect for your group meeting or chat.',
            'Large group premium rail. A sophisticated way for the whole team to travel together in style.',
            'Solo car rental. Check the fuel policy and the spare tire before hitting the open road.',
            'Car trip for two. Take turns driving to keep everyone alert and the journey safe.',
            'Family road trip! Delegate a resident DJ to manage the playlist and keep everyone entertained.',
            'Executive car solo. Arrive at your destination refreshed with this high-comfort vehicle.',
            'Premium group car. A smooth, quiet ride that makes conversation easy even at highway speeds.',
            'Large group comfort vehicle. Plenty of space for everyone and their luggage—enjoy the cruise!'
        ];

        $classifier->train($samples, $labels);

        $type = strtoupper($transport->getTransportType());
        $price = $transport->getBasePrice();

        $priceRange = 2; 
        if ($price < 50) $priceRange = 1;
        elseif ($price > 200) $priceRange = 3;

        $seatGroup = 2; // Default (2-3)
        if ($seatCount <= 1) $seatGroup = 1;
        elseif ($seatCount >= 4) $seatGroup = 3;

        try {
            return $classifier->predict([$type, $priceRange, $seatGroup]);
        } catch (\Exception $e) {
            return "ARIA Suggestion: Wishing a safe and pleasant journey for all {$seatCount} travelers!";
        }
    }
}
