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

/* front/transport.html.twig */
class __TwigTemplate_9561e932d82db9ee98afb6d1e232c089 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/transport.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"TripX Transport — Flights, trains, ferries, car rental. AI price prediction, carbon tracker, multi-city planner.\">
  <title>Transport — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    /* Transport type tabs */
    .transport-tabs { display: flex; gap: 0; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--border-radius-md); padding: 6px; margin-bottom: 32px; width: fit-content; }
    .transport-tab { padding: 10px 24px; border-radius: var(--border-radius-sm); font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted); cursor: none; transition: all var(--transition-fast); }
    .transport-tab.active { background: var(--accent-primary); color: #fff; }

    /* Search form */
    .transport-search {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 28px;
      margin-bottom: 32px;
    }
    .trip-type-row { display: flex; gap: 16px; margin-bottom: 20px; }
    .radio-pill { display: flex; align-items: center; gap: 8px; font-size: 0.9rem; cursor: none; }
    .radio-pill input[type=radio] { accent-color: var(--accent-primary); width: 16px; height: 16px; cursor: none; }
    .search-fields { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 12px; align-items: end; }
    @media (max-width: 900px) { .search-fields { grid-template-columns: 1fr 1fr; } }

    /* Route card */
    .route-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 24px;
      margin-bottom: 16px;
      transition: all var(--transition-smooth);
    }
    .route-card:hover { border-color: var(--accent-primary); transform: translateX(4px); }
    .route-top { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
    .airline-logo { width: 40px; height: 40px; border-radius: 8px; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .route-flight-info { flex: 1; display: flex; align-items: center; gap: 20px; }
    .route-time { font-family: var(--font-display); font-size: 28px; line-height: 1; }
    .route-arrow { font-size: 20px; color: var(--text-muted); }
    .route-city { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.1em; color: var(--text-muted); margin-top: 4px; }
    .route-duration { text-align: center; font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); }
    .route-price { font-family: var(--font-display); font-size: 32px; color: var(--accent-primary); text-align: right; }
    .route-price-sub { font-size: 0.75rem; color: var(--text-muted); }

    /* AI Price Prediction */
    .price-pred {
      background: rgba(0,245,212,0.06);
      border: 1px solid rgba(0,245,212,0.2);
      border-radius: var(--border-radius-md);
      padding: 14px 18px;
      display: flex; align-items: center; gap: 12px;
      font-size: 0.85rem;
      color: var(--text-secondary);
    }
    .price-pred-icon { font-size: 20px; }

    /* Carbon tracker */
    .carbon-row {
      display: flex; gap: 10px; align-items: center; margin-top: 12px;
      font-family: var(--font-mono); font-size: 10px; color: var(--text-muted);
    }
    .carbon-val { color: var(--accent-teal); font-size: 12px; }

    /* Route map SVG */
    .route-map {
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      height: 280px;
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .route-svg { width: 100%; height: 100%; }

    /* Multi-city builder */
    .city-leg {
      display: flex; gap: 12px; align-items: center; margin-bottom: 12px;
    }
    .leg-number {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--accent-primary); color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display); font-size: 16px;
      flex-shrink: 0;
    }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 104
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 106
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 107
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link\">Destinations</a>
      <a href=\"";
        // line 108
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link\">Activities</a>
      <a href=\"";
        // line 109
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
      <a href=\"";
        // line 110
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link active\">Transport</a>
      <a href=\"";
        // line 111
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 112
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 119
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
    <div class=\"section-label reveal\"><span>Smart Travel Planner</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Get There <span class=\"gradient-text\">Smarter</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">AI finds the best routes, predicts price drops, and tracks your carbon footprint — all in one place.</p>

    <!-- Transport Type Selector -->
    <div class=\"transport-tabs reveal reveal-delay-2\">
      <button class=\"transport-tab active\">✈️ Flights</button>
      <button class=\"transport-tab\">🚂 Trains</button>
      <button class=\"transport-tab\">⛴️ Ferries</button>
      <button class=\"transport-tab\">🚗 Car Rental</button>
    </div>

    <!-- Search Form -->
    <div class=\"transport-search reveal reveal-delay-3\">
      <div class=\"trip-type-row\">
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\" checked> Round Trip</label>
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\"> One Way</label>
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\"> Multi-City</label>
      </div>
      <div class=\"search-fields\">
        <div class=\"input-group\">
          <div class=\"input-label\">From</div>
          <input class=\"input\" type=\"text\" placeholder=\"Paris (CDG)\" value=\"Paris (CDG)\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">To</div>
          <input class=\"input\" type=\"text\" placeholder=\"Bali (DPS)\" value=\"Bali (DPS)\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">Departure</div>
          <input class=\"input\" type=\"date\" value=\"2025-06-15\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">Return</div>
          <input class=\"input\" type=\"date\" value=\"2025-06-29\">
        </div>
        <button class=\"btn btn-primary ripple-btn\" style=\"height:46px;align-self:end;white-space:nowrap\">Search Flights</button>
      </div>
    </div>
  </div>
</div>

<!-- Route Visualization -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"grid-2\" style=\"gap:40px;align-items:start\">
      <div>
        <div class=\"section-label reveal\"><span>Best Routes Found</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Paris <span class=\"text-coral\">→</span> Bali</h2>

        <!-- AI Price Predictor -->
        <div class=\"price-pred reveal reveal-delay-1\" style=\"margin-bottom:24px\">
          <span class=\"price-pred-icon\">💡</span>
          <div>
            <strong>ARIA Price Alert:</strong> Prices on this route are likely to drop <strong style=\"color:var(--accent-teal)\">18%</strong> in 6 days. <span style=\"color:var(--accent-primary)\">Wait or book now?</span>
            <button style=\"font-family:var(--font-mono);font-size:10px;color:var(--accent-teal);text-decoration:underline;cursor:none;margin-left:8px\">Explain →</button>
          </div>
        </div>

        <!-- Route Cards -->
        <div class=\"stagger\">
          <div class=\"route-card\">
            <div class=\"route-top\">
              <div class=\"airline-logo\">✈️</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">07:30</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">14h 45m · 1 stop</div>
                </div>
                <div><div class=\"route-time\">21:15</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€680</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div>
                <span class=\"badge badge-teal\" style=\"margin-right:6px\">Direct → Singapore</span>
                <span class=\"badge badge-muted\">Economy</span>
              </div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">342kg CO₂</span><span>· Offset available</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-primary ripple-btn\">Select Flight</button></div>
          </div>

          <div class=\"route-card\" style=\"border-color:rgba(0,245,212,0.3)\">
            <div style=\"display:flex;justify-content:space-between;align-items:center;margin-bottom:12px\">
              <span class=\"badge badge-teal\">✦ ARIA's Best Pick</span>
              <span class=\"badge badge-coral\">Save €85</span>
            </div>
            <div class=\"route-top\">
              <div class=\"airline-logo\">🛫</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">10:50</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">16h 20m · 1 stop</div>
                </div>
                <div><div class=\"route-time\">04:10+1</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€595</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div><span class=\"badge badge-indigo\" style=\"margin-right:6px\">Via Doha</span><span class=\"badge badge-muted\">Economy+</span></div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">290kg CO₂</span><span>· Greener option ✓</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-primary ripple-btn\">Select Flight</button></div>
          </div>

          <div class=\"route-card\">
            <div class=\"route-top\">
              <div class=\"airline-logo\">🌏</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">23:55</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">18h 55m · 2 stops</div>
                </div>
                <div><div class=\"route-time\">17:50+1</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€510</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div><span class=\"badge badge-muted\" style=\"margin-right:6px\">Via Dubai & KL</span><span class=\"badge badge-muted\">Economy</span></div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">410kg CO₂</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-secondary ripple-btn\">Select Flight</button></div>
          </div>
        </div>
      </div>

      <!-- Map + Multi-city -->
      <div>
        <!-- Route Map -->
        <div class=\"route-map reveal\" style=\"margin-bottom:24px\">
          <svg class=\"route-svg\" viewBox=\"0 0 600 280\">
            <!-- Background grid -->
            <defs>
              <pattern id=\"grid\" width=\"40\" height=\"40\" patternUnits=\"userSpaceOnUse\">
                <path d=\"M 40 0 L 0 0 0 40\" fill=\"none\" stroke=\"rgba(107,127,163,0.08)\" stroke-width=\"1\"/>
              </pattern>
              <marker id=\"arrow\" viewBox=\"0 0 10 10\" refX=\"10\" refY=\"5\" markerWidth=\"6\" markerHeight=\"6\" orient=\"auto\">
                <path d=\"M 0 0 L 10 5 L 0 10 z\" fill=\"#FF4D6D\"/>
              </marker>
            </defs>
            <rect width=\"600\" height=\"280\" fill=\"url(#grid)\"/>
            <!-- Flight path arc -->
            <path d=\"M 100 180 Q 300 60 500 170\" stroke=\"#FF4D6D\" stroke-width=\"2.5\" fill=\"none\" stroke-dasharray=\"8 4\" class=\"flight-path\" marker-end=\"url(#arrow)\"/>
            <!-- City dots -->
            <circle cx=\"100\" cy=\"180\" r=\"8\" fill=\"#FF4D6D\"/>
            <circle cx=\"100\" cy=\"180\" r=\"16\" fill=\"rgba(255,77,109,0.2)\"/>
            <text x=\"100\" y=\"210\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"11\" fill=\"#6B7FA3\">PARIS</text>
            <circle cx=\"500\" cy=\"170\" r=\"8\" fill=\"#00F5D4\"/>
            <circle cx=\"500\" cy=\"170\" r=\"16\" fill=\"rgba(0,245,212,0.2)\"/>
            <text x=\"500\" y=\"200\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"11\" fill=\"#6B7FA3\">BALI</text>
            <!-- Midpoint -->
            <circle cx=\"300\" cy=\"95\" r=\"5\" fill=\"#FFB703\"/>
            <text x=\"300\" y=\"78\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"9\" fill=\"#FFB703\">STOPOVER</text>
          </svg>
        </div>

        <!-- Carbon Tracker -->
        <div class=\"carbon-bar reveal reveal-delay-1\" style=\"margin-bottom:24px\">
          <span style=\"font-size:24px\">🌿</span>
          <div style=\"flex:1\">
            <div style=\"font-weight:600;margin-bottom:4px;font-size:0.9rem\">Carbon Footprint</div>
            <div style=\"font-size:0.8rem;color:var(--text-muted)\">This trip: 290kg CO₂ — 22% less than average</div>
            <div class=\"progress-bar\" style=\"margin-top:8px;background:rgba(0,200,150,0.15)\">
              <div class=\"progress-fill\" style=\"width:72%;background:linear-gradient(90deg,#00C4AA,#00F5D4)\"></div>
            </div>
          </div>
          <button class=\"btn btn-teal btn-sm ripple-btn\">Offset It</button>
        </div>

        <!-- Multi-city builder -->
        <div class=\"card reveal reveal-delay-2\">
          <div class=\"card-body\">
            <h3 style=\"margin-bottom:20px\">🗺 Multi-City Builder</h3>
            <div class=\"city-leg\"><div class=\"leg-number\">1</div><input class=\"input\" type=\"text\" placeholder=\"Paris (CDG)\" style=\"flex:1\"></div>
            <div class=\"city-leg\"><div class=\"leg-number\">2</div><input class=\"input\" type=\"text\" placeholder=\"Singapore (SIN)\" style=\"flex:1\"></div>
            <div class=\"city-leg\"><div class=\"leg-number\">3</div><input class=\"input\" type=\"text\" placeholder=\"Bali (DPS)\" style=\"flex:1\"></div>
            <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"margin-bottom:16px;margin-top:4px\">+ Add City</button>
            <button class=\"btn btn-primary btn-lg ripple-btn w-full\">✦ Let ARIA Fill Optimal Routes</button>
          </div>
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
        // line 331
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Transport Intelligence</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">I'm tracking 47 price changes on flights to Bali right now. The best window to book is probably in 5–7 days. Want me to set an alert? 📊</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask about flights...\">
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
        return "front/transport.html.twig";
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
        return array (  406 => 331,  189 => 119,  179 => 112,  175 => 111,  171 => 110,  167 => 109,  163 => 108,  159 => 107,  155 => 106,  150 => 104,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"TripX Transport — Flights, trains, ferries, car rental. AI price prediction, carbon tracker, multi-city planner.\">
  <title>Transport — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    /* Transport type tabs */
    .transport-tabs { display: flex; gap: 0; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--border-radius-md); padding: 6px; margin-bottom: 32px; width: fit-content; }
    .transport-tab { padding: 10px 24px; border-radius: var(--border-radius-sm); font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted); cursor: none; transition: all var(--transition-fast); }
    .transport-tab.active { background: var(--accent-primary); color: #fff; }

    /* Search form */
    .transport-search {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 28px;
      margin-bottom: 32px;
    }
    .trip-type-row { display: flex; gap: 16px; margin-bottom: 20px; }
    .radio-pill { display: flex; align-items: center; gap: 8px; font-size: 0.9rem; cursor: none; }
    .radio-pill input[type=radio] { accent-color: var(--accent-primary); width: 16px; height: 16px; cursor: none; }
    .search-fields { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 12px; align-items: end; }
    @media (max-width: 900px) { .search-fields { grid-template-columns: 1fr 1fr; } }

    /* Route card */
    .route-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 24px;
      margin-bottom: 16px;
      transition: all var(--transition-smooth);
    }
    .route-card:hover { border-color: var(--accent-primary); transform: translateX(4px); }
    .route-top { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
    .airline-logo { width: 40px; height: 40px; border-radius: 8px; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .route-flight-info { flex: 1; display: flex; align-items: center; gap: 20px; }
    .route-time { font-family: var(--font-display); font-size: 28px; line-height: 1; }
    .route-arrow { font-size: 20px; color: var(--text-muted); }
    .route-city { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.1em; color: var(--text-muted); margin-top: 4px; }
    .route-duration { text-align: center; font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); }
    .route-price { font-family: var(--font-display); font-size: 32px; color: var(--accent-primary); text-align: right; }
    .route-price-sub { font-size: 0.75rem; color: var(--text-muted); }

    /* AI Price Prediction */
    .price-pred {
      background: rgba(0,245,212,0.06);
      border: 1px solid rgba(0,245,212,0.2);
      border-radius: var(--border-radius-md);
      padding: 14px 18px;
      display: flex; align-items: center; gap: 12px;
      font-size: 0.85rem;
      color: var(--text-secondary);
    }
    .price-pred-icon { font-size: 20px; }

    /* Carbon tracker */
    .carbon-row {
      display: flex; gap: 10px; align-items: center; margin-top: 12px;
      font-family: var(--font-mono); font-size: 10px; color: var(--text-muted);
    }
    .carbon-val { color: var(--accent-teal); font-size: 12px; }

    /* Route map SVG */
    .route-map {
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      height: 280px;
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .route-svg { width: 100%; height: 100%; }

    /* Multi-city builder */
    .city-leg {
      display: flex; gap: 12px; align-items: center; margin-bottom: 12px;
    }
    .leg-number {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--accent-primary); color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-display); font-size: 16px;
      flex-shrink: 0;
    }
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
      <a href=\"{{ path('accommodations') }}\" class=\"nav-link\">Accommodations</a>
      <a href=\"{{ path('transport') }}\"      class=\"nav-link active\">Transport</a>
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
    <div class=\"section-label reveal\"><span>Smart Travel Planner</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Get There <span class=\"gradient-text\">Smarter</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">AI finds the best routes, predicts price drops, and tracks your carbon footprint — all in one place.</p>

    <!-- Transport Type Selector -->
    <div class=\"transport-tabs reveal reveal-delay-2\">
      <button class=\"transport-tab active\">✈️ Flights</button>
      <button class=\"transport-tab\">🚂 Trains</button>
      <button class=\"transport-tab\">⛴️ Ferries</button>
      <button class=\"transport-tab\">🚗 Car Rental</button>
    </div>

    <!-- Search Form -->
    <div class=\"transport-search reveal reveal-delay-3\">
      <div class=\"trip-type-row\">
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\" checked> Round Trip</label>
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\"> One Way</label>
        <label class=\"radio-pill\"><input type=\"radio\" name=\"triptype\"> Multi-City</label>
      </div>
      <div class=\"search-fields\">
        <div class=\"input-group\">
          <div class=\"input-label\">From</div>
          <input class=\"input\" type=\"text\" placeholder=\"Paris (CDG)\" value=\"Paris (CDG)\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">To</div>
          <input class=\"input\" type=\"text\" placeholder=\"Bali (DPS)\" value=\"Bali (DPS)\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">Departure</div>
          <input class=\"input\" type=\"date\" value=\"2025-06-15\">
        </div>
        <div class=\"input-group\">
          <div class=\"input-label\">Return</div>
          <input class=\"input\" type=\"date\" value=\"2025-06-29\">
        </div>
        <button class=\"btn btn-primary ripple-btn\" style=\"height:46px;align-self:end;white-space:nowrap\">Search Flights</button>
      </div>
    </div>
  </div>
</div>

<!-- Route Visualization -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"grid-2\" style=\"gap:40px;align-items:start\">
      <div>
        <div class=\"section-label reveal\"><span>Best Routes Found</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Paris <span class=\"text-coral\">→</span> Bali</h2>

        <!-- AI Price Predictor -->
        <div class=\"price-pred reveal reveal-delay-1\" style=\"margin-bottom:24px\">
          <span class=\"price-pred-icon\">💡</span>
          <div>
            <strong>ARIA Price Alert:</strong> Prices on this route are likely to drop <strong style=\"color:var(--accent-teal)\">18%</strong> in 6 days. <span style=\"color:var(--accent-primary)\">Wait or book now?</span>
            <button style=\"font-family:var(--font-mono);font-size:10px;color:var(--accent-teal);text-decoration:underline;cursor:none;margin-left:8px\">Explain →</button>
          </div>
        </div>

        <!-- Route Cards -->
        <div class=\"stagger\">
          <div class=\"route-card\">
            <div class=\"route-top\">
              <div class=\"airline-logo\">✈️</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">07:30</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">14h 45m · 1 stop</div>
                </div>
                <div><div class=\"route-time\">21:15</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€680</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div>
                <span class=\"badge badge-teal\" style=\"margin-right:6px\">Direct → Singapore</span>
                <span class=\"badge badge-muted\">Economy</span>
              </div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">342kg CO₂</span><span>· Offset available</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-primary ripple-btn\">Select Flight</button></div>
          </div>

          <div class=\"route-card\" style=\"border-color:rgba(0,245,212,0.3)\">
            <div style=\"display:flex;justify-content:space-between;align-items:center;margin-bottom:12px\">
              <span class=\"badge badge-teal\">✦ ARIA's Best Pick</span>
              <span class=\"badge badge-coral\">Save €85</span>
            </div>
            <div class=\"route-top\">
              <div class=\"airline-logo\">🛫</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">10:50</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">16h 20m · 1 stop</div>
                </div>
                <div><div class=\"route-time\">04:10+1</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€595</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div><span class=\"badge badge-indigo\" style=\"margin-right:6px\">Via Doha</span><span class=\"badge badge-muted\">Economy+</span></div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">290kg CO₂</span><span>· Greener option ✓</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-primary ripple-btn\">Select Flight</button></div>
          </div>

          <div class=\"route-card\">
            <div class=\"route-top\">
              <div class=\"airline-logo\">🌏</div>
              <div class=\"route-flight-info\">
                <div><div class=\"route-time\">23:55</div><div class=\"route-city\">CDG · Paris</div></div>
                <div style=\"flex:1;text-align:center\">
                  <div class=\"route-arrow\">─────────────→</div>
                  <div class=\"route-duration\">18h 55m · 2 stops</div>
                </div>
                <div><div class=\"route-time\">17:50+1</div><div class=\"route-city\">DPS · Bali</div></div>
              </div>
              <div style=\"text-align:right\">
                <div class=\"route-price\">€510</div>
                <div class=\"route-price-sub\">per person</div>
              </div>
            </div>
            <div style=\"display:flex;justify-content:space-between;align-items:center\">
              <div><span class=\"badge badge-muted\" style=\"margin-right:6px\">Via Dubai & KL</span><span class=\"badge badge-muted\">Economy</span></div>
              <div class=\"carbon-row\"><span>🌿</span><span class=\"carbon-val\">410kg CO₂</span></div>
            </div>
            <div style=\"margin-top:14px;display:flex;justify-content:flex-end\"><button class=\"btn btn-secondary ripple-btn\">Select Flight</button></div>
          </div>
        </div>
      </div>

      <!-- Map + Multi-city -->
      <div>
        <!-- Route Map -->
        <div class=\"route-map reveal\" style=\"margin-bottom:24px\">
          <svg class=\"route-svg\" viewBox=\"0 0 600 280\">
            <!-- Background grid -->
            <defs>
              <pattern id=\"grid\" width=\"40\" height=\"40\" patternUnits=\"userSpaceOnUse\">
                <path d=\"M 40 0 L 0 0 0 40\" fill=\"none\" stroke=\"rgba(107,127,163,0.08)\" stroke-width=\"1\"/>
              </pattern>
              <marker id=\"arrow\" viewBox=\"0 0 10 10\" refX=\"10\" refY=\"5\" markerWidth=\"6\" markerHeight=\"6\" orient=\"auto\">
                <path d=\"M 0 0 L 10 5 L 0 10 z\" fill=\"#FF4D6D\"/>
              </marker>
            </defs>
            <rect width=\"600\" height=\"280\" fill=\"url(#grid)\"/>
            <!-- Flight path arc -->
            <path d=\"M 100 180 Q 300 60 500 170\" stroke=\"#FF4D6D\" stroke-width=\"2.5\" fill=\"none\" stroke-dasharray=\"8 4\" class=\"flight-path\" marker-end=\"url(#arrow)\"/>
            <!-- City dots -->
            <circle cx=\"100\" cy=\"180\" r=\"8\" fill=\"#FF4D6D\"/>
            <circle cx=\"100\" cy=\"180\" r=\"16\" fill=\"rgba(255,77,109,0.2)\"/>
            <text x=\"100\" y=\"210\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"11\" fill=\"#6B7FA3\">PARIS</text>
            <circle cx=\"500\" cy=\"170\" r=\"8\" fill=\"#00F5D4\"/>
            <circle cx=\"500\" cy=\"170\" r=\"16\" fill=\"rgba(0,245,212,0.2)\"/>
            <text x=\"500\" y=\"200\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"11\" fill=\"#6B7FA3\">BALI</text>
            <!-- Midpoint -->
            <circle cx=\"300\" cy=\"95\" r=\"5\" fill=\"#FFB703\"/>
            <text x=\"300\" y=\"78\" text-anchor=\"middle\" font-family=\"Space Mono\" font-size=\"9\" fill=\"#FFB703\">STOPOVER</text>
          </svg>
        </div>

        <!-- Carbon Tracker -->
        <div class=\"carbon-bar reveal reveal-delay-1\" style=\"margin-bottom:24px\">
          <span style=\"font-size:24px\">🌿</span>
          <div style=\"flex:1\">
            <div style=\"font-weight:600;margin-bottom:4px;font-size:0.9rem\">Carbon Footprint</div>
            <div style=\"font-size:0.8rem;color:var(--text-muted)\">This trip: 290kg CO₂ — 22% less than average</div>
            <div class=\"progress-bar\" style=\"margin-top:8px;background:rgba(0,200,150,0.15)\">
              <div class=\"progress-fill\" style=\"width:72%;background:linear-gradient(90deg,#00C4AA,#00F5D4)\"></div>
            </div>
          </div>
          <button class=\"btn btn-teal btn-sm ripple-btn\">Offset It</button>
        </div>

        <!-- Multi-city builder -->
        <div class=\"card reveal reveal-delay-2\">
          <div class=\"card-body\">
            <h3 style=\"margin-bottom:20px\">🗺 Multi-City Builder</h3>
            <div class=\"city-leg\"><div class=\"leg-number\">1</div><input class=\"input\" type=\"text\" placeholder=\"Paris (CDG)\" style=\"flex:1\"></div>
            <div class=\"city-leg\"><div class=\"leg-number\">2</div><input class=\"input\" type=\"text\" placeholder=\"Singapore (SIN)\" style=\"flex:1\"></div>
            <div class=\"city-leg\"><div class=\"leg-number\">3</div><input class=\"input\" type=\"text\" placeholder=\"Bali (DPS)\" style=\"flex:1\"></div>
            <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"margin-bottom:16px;margin-top:4px\">+ Add City</button>
            <button class=\"btn btn-primary btn-lg ripple-btn w-full\">✦ Let ARIA Fill Optimal Routes</button>
          </div>
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
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Transport Intelligence</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">I'm tracking 47 price changes on flights to Bali right now. The best window to book is probably in 5–7 days. Want me to set an alert? 📊</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask about flights...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/transport.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\transport.html.twig");
    }
}
