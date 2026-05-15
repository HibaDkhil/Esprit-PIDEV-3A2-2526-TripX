<?php

$dir = 'c:\Users\USER\Downloads\Sym\templates\front\\';
$files = [
    'TransportUserInterface.html.twig',
    'transport.html.twig',
    'recommendations.html.twig',
    'offers.html.twig',
    'destinations.html.twig',
    'destination-detail.html.twig',
    'activities.html.twig'
];

foreach ($files as $file) {
    $path = $dir . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        
        // Remove the block starting with <button class="aria-orb" id="aria-orb" ... and ending with the closing </div> of the aria-panel.
        // It looks like:
        // <button class="aria-orb" id="aria-orb"...>...</button>
        // <div class="aria-panel" id="aria-panel">
        // ...
        // </div>
        
        // Regex to match the button and the following aria-panel div
        $pattern = '/<button class="aria-orb" id="aria-orb"[^>]*>.*?<\/button>\s*<div class="aria-panel" id="aria-panel">.*?<\/div>\s*<\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s';
        
        // Actually, matching nested divs with regex is hard. Let's just find the start and string replace.
        $startStr = '<button class="aria-orb" id="aria-orb" aria-label="Open ARIA">';
        $pos = strpos($content, $startStr);
        if ($pos !== false) {
            // Find the end of the aria-panel div
            $panelStart = strpos($content, '<div class="aria-panel" id="aria-panel">', $pos);
            if ($panelStart !== false) {
                // The aria-panel structure typically ends just before <script> or {% endblock %}
                // In transport.html.twig it ends right before <script>
                // So let's delete until <script> or {% endblock %}
                $scriptPos = strpos($content, '<script>', $panelStart);
                $endblockPos = strpos($content, '{% endblock %}', $panelStart);
                
                $endPos = false;
                if ($scriptPos !== false && $endblockPos !== false) {
                    $endPos = min($scriptPos, $endblockPos);
                } elseif ($scriptPos !== false) {
                    $endPos = $scriptPos;
                } elseif ($endblockPos !== false) {
                    $endPos = $endblockPos;
                }
                
                if ($endPos !== false) {
                    $newContent = substr($content, 0, $pos) . substr($content, $endPos);
                    file_put_contents($path, $newContent);
                    echo "Cleaned up $file\n";
                }
            }
        }
    }
}
