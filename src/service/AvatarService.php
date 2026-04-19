<?php

namespace App\service;

class AvatarService
{
    // Available styles [citation:1]
    private const STYLES = [
        'adventurer', 'adventurer-neutral', 'avataaars', 'bottts', 
        'croodles', 'dylan', 'fun-emoji', 'glass', 'icons', 
        'identicon', 'initials', 'lorelei', 'micah', 'miniavs',
        'notionists', 'open-peeps', 'personas', 'pixel-art',
        'rings', 'shapes', 'thumbs'
    ];
    
    /**
     * Generate avatar URL for a user
     */
    public function getAvatarUrl(?int $avatarId = null, ?string $seed = null, ?string $style = null): string
    {
        // Use stored avatar ID as seed, or generate random
        $seedValue = $seed ?? ($avatarId ? (string)$avatarId : $this->generateRandomSeed());
        $selectedStyle = $style ?? $this->getRandomStyle();
        
        return sprintf(
            'https://api.dicebear.com/9.x/%s/svg?seed=%s&size=128&radius=50',
            $selectedStyle,
            urlencode($seedValue)
        );
    }
    
    /**
     * Get avatar URL with custom options [citation:5]
     */
    public function getCustomAvatarUrl(string $seed, string $style, array $options = []): string
    {
        $url = sprintf('https://api.dicebear.com/9.x/%s/svg?seed=%s', $style, urlencode($seed));
        
        foreach ($options as $key => $value) {
            $url .= sprintf('&%s=%s', $key, urlencode($value));
        }
        
        return $url;
    }
    
    /**
     * Generate random seed
     */
    private function generateRandomSeed(): string
    {
        $adjectives = ['Happy', 'Brave', 'Clever', 'Swift', 'Bright', 'Calm', 'Wise', 'Kind'];
        $nouns = ['Traveler', 'Explorer', 'Wanderer', 'Dreamer', 'Pilot', 'Captain', 'Guide', 'Nomad'];
        
        return $adjectives[array_rand($adjectives)] . $nouns[array_rand($nouns)] . rand(1, 999);
    }
    
    /**
     * Get random avatar style
     */
    private function getRandomStyle(): string
    {
        return self::STYLES[array_rand(self::STYLES)];
    }
    
    /**
     * Get all available styles
     */
    public function getStyles(): array
    {
        return self::STYLES;
    }
}