<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* front/accommodations.html.twig */
class __TwigTemplate_8c10a7f4e61dda1bc0286708efd8def3 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/accommodations.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Find your perfect stay — luxury resorts, boutique hotels, hidden gems. AI-curated accommodations worldwide.\">
  <title>Accommodations — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    .view-toggle { display: flex; gap: 4px; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px; padding: 4px; }
    .view-btn { padding: 8px 16px; border-radius: 10px; font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-muted); cursor: none; transition: all var(--transition-fast); }
    .view-btn.active { background: var(--accent-primary); color: #fff; }

    /* Accommodation card */
    .stay-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      transition: all var(--transition-smooth);
    }
    .stay-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .stay-img {
      height: 220px;
      display: flex; align-items: center; justify-content: center;
      font-size: 72px;
      position: relative;
      overflow: hidden;
    }
    .stay-img-badge { position: absolute; top: 14px; left: 14px; }
    .stay-img-fav {
      position: absolute; top: 14px; right: 14px;
      width: 36px; height: 36px;
      background: var(--bg-glass);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; cursor: none;
      transition: transform var(--transition-fast);
    }
    .stay-img-fav:hover { transform: scale(1.15); }
    .stay-body { padding: 20px; }
    .stay-name { font-weight: 700; font-size: 1.05rem; margin-bottom: 4px; }
    .stay-loc { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); letter-spacing: 0.08em; margin-bottom: 10px; }
    .stay-rating { display: flex; align-items: center; gap: 6px; margin-bottom: 12px; }
    .stars { color: var(--accent-gold); font-size: 14px; }
    .ai-score { font-family: var(--font-mono); font-size: 10px; color: var(--accent-teal); }
    .stay-ai-summary { font-size: 0.82rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; border-left: 2px solid var(--accent-teal); padding-left: 10px; font-style: italic; }
    .stay-footer { display: flex; justify-content: space-between; align-items: center; }
    .stay-price { font-family: var(--font-display); font-size: 26px; color: var(--accent-primary); line-height: 1; }
    .stay-price-sub { font-size: 0.75rem; color: var(--text-muted); }
    .stay-amenities { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 14px; }
    .amenity { font-size: 16px; }

    /* Swipe view */
    .mood-board { display: flex; justify-content: center; padding: 40px 0; }

    /* Hidden Gems */
    .gem-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 24px;
      display: flex; gap: 20px;
      transition: all var(--transition-smooth);
    }
    .gem-card:hover { border-color: var(--accent-gold); box-shadow: var(--shadow-md); }
    .gem-icon { font-size: 48px; flex-shrink: 0; }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 83
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 86
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link\">Destinations</a>
      <a href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link\">Activities</a>
      <a href=\"";
        // line 88
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link active\">Accommodations</a>
      <a href=\"";
        // line 89
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link\">Transport</a>
      <a href=\"";
        // line 90
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 91
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 98
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("users");
        yield "\" class=\"btn-nav-primary ripple-btn\">My Profile</a><a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
        <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
        <div class=\"text\">Logout</div>
      </a>
    </div>
  </div>
</nav>

<div class=\"page-top\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>12,000+ Properties</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Your Perfect <span class=\"gradient-text\">Home Away</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">AI doesn't just rate stars — it reads 10,000 reviews so you don't have to.</p>
    <div style=\"display:flex;gap:16px;margin-top:32px;flex-wrap:wrap;align-items:center\" class=\"reveal reveal-delay-2\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All Stays</button>
        <button class=\"filter-pill\">🏨 Hotel</button>
        <button class=\"filter-pill\">🌿 Boutique</button>
        <button class=\"filter-pill\">🏡 Villa</button>
        <button class=\"filter-pill\">🏕️ Eco Lodge</button>
        <button class=\"filter-pill\">💎 Luxury</button>
      </div>
      <div class=\"view-toggle\" style=\"margin-left:auto\">
        <button class=\"view-btn active\">⊞ Grid</button>
        <button class=\"view-btn\">🗺 Map</button>
        <button class=\"view-btn\">♠ Swipe</button>
      </div>
    </div>
  </div>
</div>

<!-- Grid View -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"grid-3 stagger\">
      <!-- Card 1 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#1a3a5c,#2d6a4f)\">
          🏝️
          <div class=\"stay-img-badge\"><span class=\"badge badge-gold\">Premium 💎</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Soneva Fushi Maldives</div>
          <div class=\"stay-loc\">🏝️ Baa Atoll, Maldives</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.8/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Unmatched barefoot luxury. Guests consistently praise the overwater villa experience and exceptional marine life access.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\" title=\"Private Pool\">🏊</span>
            <span class=\"amenity\" title=\"Spa\">💆</span>
            <span class=\"amenity\" title=\"Fine Dining\">🍽️</span>
            <span class=\"amenity\" title=\"Water Sports\">🤿</span>
            <span class=\"amenity\" title=\"Eco-Certified\">🌿</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€980</div><div class=\"stay-price-sub\">per night · room only</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#7b2d00,#ffd500)\">
          🏰
          <div class=\"stay-img-badge\"><span class=\"badge badge-coral\">Hidden Gem ✦</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Canaves Oia Suites</div>
          <div class=\"stay-loc\">🇬🇷 Oia, Santorini</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.5/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"The caldera-view infinity pool at sunset is literally every photo you've ever seen of Santorini. Worth every cent.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">♾️</span><span class=\"amenity\">🌅</span><span class=\"amenity\">🍷</span><span class=\"amenity\">💆</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€520</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#003049,#d62828)\">
          🌿
          <div class=\"stay-img-badge\"><span class=\"badge badge-teal\">Eco ♻️</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Mandapa Reserve Ubud</div>
          <div class=\"stay-loc\">🇮🇩 Ubud, Bali</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.6/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"A Ritz-Carlton in a jungle valley. The river-sound ambience and rice terrace views make this incomparably special.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🌿</span><span class=\"amenity\">🧘</span><span class=\"amenity\">🏊</span><span class=\"amenity\">🍃</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€340</div><div class=\"stay-price-sub\">per night · full board</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#1b1f4a,#3a0ca3)\">
          🌌
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Ion Adventure Hotel</div>
          <div class=\"stay-loc\">🇮🇸 Selfoss, Iceland</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★☆</div>
            <span class=\"ai-score\">AI Score: 9.1/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Floor-to-ceiling windows designed specifically for Northern Lights viewing from your bed. Architectural masterpiece.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🌌</span><span class=\"amenity\">♨️</span><span class=\"amenity\">🧊</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€280</div><div class=\"stay-price-sub\">per night</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#003049,#f77f00)\">
          🏜️
          <div class=\"stay-img-badge\"><span class=\"badge badge-gold\">AI Pick ✦</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Amanjena Resort</div>
          <div class=\"stay-loc\">🇲🇦 Marrakech, Morocco</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.4/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Step into a 12th-century Moroccan palace. The pavilions around the central bassin are architectural perfection.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🎭</span><span class=\"amenity\">🏊</span><span class=\"amenity\">🛎️</span><span class=\"amenity\">🌴</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€420</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#0a1628,#1e3c72)\">
          🌸
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Nishiki Ryokan Kyoto</div>
          <div class=\"stay-loc\">🇯🇵 Gion District, Kyoto</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.7/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Authentic Edo-period ryokan. The tatami rooms and kaiseki breakfast are as traditional as Japan gets.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">♨️</span><span class=\"amenity\">🎋</span><span class=\"amenity\">🍵</span><span class=\"amenity\">👘</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€195</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Hidden Gems -->
<section class=\"section\" style=\"background:var(--bg-secondary)\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>AI Curated</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:8px\">Hidden <span class=\"text-gold\">Gems ✦</span></h2>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\" style=\"margin-bottom:32px\">Under-the-radar places most travellers walk right past.</p>
    <div style=\"display:flex;flex-direction:column;gap:16px\" class=\"stagger\">
      <div class=\"gem-card\">
        <div class=\"gem-icon\">🏡</div>
        <div style=\"flex:1\">
          <div style=\"font-weight:700;margin-bottom:6px\">Masseria Torre Coccaro, Puglia</div>
          <div style=\"font-size:0.85rem;color:var(--text-muted);line-height:1.65\">A 17th-century fortified farmhouse in southern Italy's «heel» — olive groves, spa, and farm-to-table cuisine that Instagram hasn't found yet.</div>
        </div>
        <div style=\"text-align:right;flex-shrink:0\">
          <div class=\"ai-badge\" style=\"margin-bottom:8px\">ARIA Gem Pick</div>
          <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\">€165/night</div>
        </div>
      </div>
      <div class=\"gem-card\">
        <div class=\"gem-icon\">🌋</div>
        <div style=\"flex:1\">
          <div style=\"font-weight:700;margin-bottom:6px\">Lava Lava Beach Club, Big Island Hawaii</div>
          <div style=\"font-size:0.85rem;color:var(--text-muted);line-height:1.65\">Oceanfront bungalows steps from black-sand beaches and active lava flows. Raw, spectacular, and deeply peaceful.</div>
        </div>
        <div style=\"text-align:right;flex-shrink:0\">
          <div class=\"ai-badge\" style=\"margin-bottom:8px\">ARIA Gem Pick</div>
          <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\">€240/night</div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"";
        // line 325
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Accommodation Expert</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Looking for the perfect stay? Tell me your destination, budget, and vibe — I'll find you something extraordinary! 🏨✨</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Find me a stay...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/accommodations.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  400 => 325,  168 => 98,  158 => 91,  154 => 90,  150 => 89,  146 => 88,  142 => 87,  138 => 86,  134 => 85,  129 => 83,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Find your perfect stay — luxury resorts, boutique hotels, hidden gems. AI-curated accommodations worldwide.\">
  <title>Accommodations — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    .view-toggle { display: flex; gap: 4px; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px; padding: 4px; }
    .view-btn { padding: 8px 16px; border-radius: 10px; font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-muted); cursor: none; transition: all var(--transition-fast); }
    .view-btn.active { background: var(--accent-primary); color: #fff; }

    /* Accommodation card */
    .stay-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      transition: all var(--transition-smooth);
    }
    .stay-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .stay-img {
      height: 220px;
      display: flex; align-items: center; justify-content: center;
      font-size: 72px;
      position: relative;
      overflow: hidden;
    }
    .stay-img-badge { position: absolute; top: 14px; left: 14px; }
    .stay-img-fav {
      position: absolute; top: 14px; right: 14px;
      width: 36px; height: 36px;
      background: var(--bg-glass);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; cursor: none;
      transition: transform var(--transition-fast);
    }
    .stay-img-fav:hover { transform: scale(1.15); }
    .stay-body { padding: 20px; }
    .stay-name { font-weight: 700; font-size: 1.05rem; margin-bottom: 4px; }
    .stay-loc { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); letter-spacing: 0.08em; margin-bottom: 10px; }
    .stay-rating { display: flex; align-items: center; gap: 6px; margin-bottom: 12px; }
    .stars { color: var(--accent-gold); font-size: 14px; }
    .ai-score { font-family: var(--font-mono); font-size: 10px; color: var(--accent-teal); }
    .stay-ai-summary { font-size: 0.82rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; border-left: 2px solid var(--accent-teal); padding-left: 10px; font-style: italic; }
    .stay-footer { display: flex; justify-content: space-between; align-items: center; }
    .stay-price { font-family: var(--font-display); font-size: 26px; color: var(--accent-primary); line-height: 1; }
    .stay-price-sub { font-size: 0.75rem; color: var(--text-muted); }
    .stay-amenities { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 14px; }
    .amenity { font-size: 16px; }

    /* Swipe view */
    .mood-board { display: flex; justify-content: center; padding: 40px 0; }

    /* Hidden Gems */
    .gem-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 24px;
      display: flex; gap: 20px;
      transition: all var(--transition-smooth);
    }
    .gem-card:hover { border-color: var(--accent-gold); box-shadow: var(--shadow-md); }
    .gem-icon { font-size: 48px; flex-shrink: 0; }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"{{ path('index') }}\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"{{ path('index') }}\"          class=\"nav-link\">Home</a>
      <a href=\"{{ path('destinations') }}\"   class=\"nav-link\">Destinations</a>
      <a href=\"{{ path('activities') }}\"     class=\"nav-link\">Activities</a>
      <a href=\"{{ path('accommodations') }}\" class=\"nav-link active\">Accommodations</a>
      <a href=\"{{ path('transport') }}\"      class=\"nav-link\">Transport</a>
      <a href=\"{{ path('offers') }}\"         class=\"nav-link\">Offers</a>
      <a href=\"{{ path('blog') }}\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"{{ path('users') }}\" class=\"btn-nav-primary ripple-btn\">My Profile</a><a href=\"{{ path('app_logout') }}\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
        <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
        <div class=\"text\">Logout</div>
      </a>
    </div>
  </div>
</nav>

<div class=\"page-top\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>12,000+ Properties</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Your Perfect <span class=\"gradient-text\">Home Away</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">AI doesn't just rate stars — it reads 10,000 reviews so you don't have to.</p>
    <div style=\"display:flex;gap:16px;margin-top:32px;flex-wrap:wrap;align-items:center\" class=\"reveal reveal-delay-2\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All Stays</button>
        <button class=\"filter-pill\">🏨 Hotel</button>
        <button class=\"filter-pill\">🌿 Boutique</button>
        <button class=\"filter-pill\">🏡 Villa</button>
        <button class=\"filter-pill\">🏕️ Eco Lodge</button>
        <button class=\"filter-pill\">💎 Luxury</button>
      </div>
      <div class=\"view-toggle\" style=\"margin-left:auto\">
        <button class=\"view-btn active\">⊞ Grid</button>
        <button class=\"view-btn\">🗺 Map</button>
        <button class=\"view-btn\">♠ Swipe</button>
      </div>
    </div>
  </div>
</div>

<!-- Grid View -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"grid-3 stagger\">
      <!-- Card 1 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#1a3a5c,#2d6a4f)\">
          🏝️
          <div class=\"stay-img-badge\"><span class=\"badge badge-gold\">Premium 💎</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Soneva Fushi Maldives</div>
          <div class=\"stay-loc\">🏝️ Baa Atoll, Maldives</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.8/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Unmatched barefoot luxury. Guests consistently praise the overwater villa experience and exceptional marine life access.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\" title=\"Private Pool\">🏊</span>
            <span class=\"amenity\" title=\"Spa\">💆</span>
            <span class=\"amenity\" title=\"Fine Dining\">🍽️</span>
            <span class=\"amenity\" title=\"Water Sports\">🤿</span>
            <span class=\"amenity\" title=\"Eco-Certified\">🌿</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€980</div><div class=\"stay-price-sub\">per night · room only</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#7b2d00,#ffd500)\">
          🏰
          <div class=\"stay-img-badge\"><span class=\"badge badge-coral\">Hidden Gem ✦</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Canaves Oia Suites</div>
          <div class=\"stay-loc\">🇬🇷 Oia, Santorini</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.5/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"The caldera-view infinity pool at sunset is literally every photo you've ever seen of Santorini. Worth every cent.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">♾️</span><span class=\"amenity\">🌅</span><span class=\"amenity\">🍷</span><span class=\"amenity\">💆</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€520</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#003049,#d62828)\">
          🌿
          <div class=\"stay-img-badge\"><span class=\"badge badge-teal\">Eco ♻️</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Mandapa Reserve Ubud</div>
          <div class=\"stay-loc\">🇮🇩 Ubud, Bali</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.6/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"A Ritz-Carlton in a jungle valley. The river-sound ambience and rice terrace views make this incomparably special.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🌿</span><span class=\"amenity\">🧘</span><span class=\"amenity\">🏊</span><span class=\"amenity\">🍃</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€340</div><div class=\"stay-price-sub\">per night · full board</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#1b1f4a,#3a0ca3)\">
          🌌
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Ion Adventure Hotel</div>
          <div class=\"stay-loc\">🇮🇸 Selfoss, Iceland</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★☆</div>
            <span class=\"ai-score\">AI Score: 9.1/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Floor-to-ceiling windows designed specifically for Northern Lights viewing from your bed. Architectural masterpiece.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🌌</span><span class=\"amenity\">♨️</span><span class=\"amenity\">🧊</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€280</div><div class=\"stay-price-sub\">per night</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#003049,#f77f00)\">
          🏜️
          <div class=\"stay-img-badge\"><span class=\"badge badge-gold\">AI Pick ✦</span></div>
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Amanjena Resort</div>
          <div class=\"stay-loc\">🇲🇦 Marrakech, Morocco</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.4/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Step into a 12th-century Moroccan palace. The pavilions around the central bassin are architectural perfection.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">🎭</span><span class=\"amenity\">🏊</span><span class=\"amenity\">🛎️</span><span class=\"amenity\">🌴</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€420</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class=\"stay-card\">
        <div class=\"stay-img\" style=\"background:linear-gradient(135deg,#0a1628,#1e3c72)\">
          🌸
          <button class=\"stay-img-fav\">♡</button>
        </div>
        <div class=\"stay-body\">
          <div class=\"stay-name\">Nishiki Ryokan Kyoto</div>
          <div class=\"stay-loc\">🇯🇵 Gion District, Kyoto</div>
          <div class=\"stay-rating\">
            <div class=\"stars\">★★★★★</div>
            <span class=\"ai-score\">AI Score: 9.7/10</span>
          </div>
          <div class=\"stay-ai-summary\">\"Authentic Edo-period ryokan. The tatami rooms and kaiseki breakfast are as traditional as Japan gets.\"</div>
          <div class=\"stay-amenities\">
            <span class=\"amenity\">♨️</span><span class=\"amenity\">🎋</span><span class=\"amenity\">🍵</span><span class=\"amenity\">👘</span>
          </div>
          <div class=\"stay-footer\">
            <div><div class=\"stay-price\">€195</div><div class=\"stay-price-sub\">per night · breakfast</div></div>
            <button class=\"btn btn-primary btn-sm ripple-btn\">Book Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Hidden Gems -->
<section class=\"section\" style=\"background:var(--bg-secondary)\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>AI Curated</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:8px\">Hidden <span class=\"text-gold\">Gems ✦</span></h2>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\" style=\"margin-bottom:32px\">Under-the-radar places most travellers walk right past.</p>
    <div style=\"display:flex;flex-direction:column;gap:16px\" class=\"stagger\">
      <div class=\"gem-card\">
        <div class=\"gem-icon\">🏡</div>
        <div style=\"flex:1\">
          <div style=\"font-weight:700;margin-bottom:6px\">Masseria Torre Coccaro, Puglia</div>
          <div style=\"font-size:0.85rem;color:var(--text-muted);line-height:1.65\">A 17th-century fortified farmhouse in southern Italy's «heel» — olive groves, spa, and farm-to-table cuisine that Instagram hasn't found yet.</div>
        </div>
        <div style=\"text-align:right;flex-shrink:0\">
          <div class=\"ai-badge\" style=\"margin-bottom:8px\">ARIA Gem Pick</div>
          <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\">€165/night</div>
        </div>
      </div>
      <div class=\"gem-card\">
        <div class=\"gem-icon\">🌋</div>
        <div style=\"flex:1\">
          <div style=\"font-weight:700;margin-bottom:6px\">Lava Lava Beach Club, Big Island Hawaii</div>
          <div style=\"font-size:0.85rem;color:var(--text-muted);line-height:1.65\">Oceanfront bungalows steps from black-sand beaches and active lava flows. Raw, spectacular, and deeply peaceful.</div>
        </div>
        <div style=\"text-align:right;flex-shrink:0\">
          <div class=\"ai-badge\" style=\"margin-bottom:8px\">ARIA Gem Pick</div>
          <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\">€240/night</div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"{{ path('index') }}\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Accommodation Expert</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Looking for the perfect stay? Tell me your destination, budget, and vibe — I'll find you something extraordinary! 🏨✨</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Find me a stay...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/accommodations.html.twig", "C:\\Sym\\templates\\front\\accommodations.html.twig");
    }
}
