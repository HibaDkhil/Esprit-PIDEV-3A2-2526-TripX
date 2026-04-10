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

/* front/activities.html.twig */
class __TwigTemplate_2be52b1faf71b965d2a593eb9b0ee2a0 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/activities.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Browse thousands of activities worldwide — thrilling, serene, cultural, culinary, and more.\">
  <title>Activities — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    /* Activity card */
    .activity-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      transition: all var(--transition-smooth);
      position: relative;
    }
    .activity-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-lg);
      border-color: var(--accent-primary);
    }
    .act-icon-wrap {
      height: 140px;
      display: flex; align-items: center; justify-content: center;
      font-size: 60px;
      position: relative;
    }
    .act-body { padding: 20px; }
    .act-title { font-weight: 700; font-size: 1rem; margin-bottom: 6px; }
    .act-desc { font-size: 0.82rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; }
    .act-meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
    .act-meta-item { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); }
    .act-price { font-family: var(--font-display); font-size: 22px; color: var(--accent-primary); }
    .act-footer { display: flex; justify-content: space-between; align-items: center; }

    /* Map view placeholder */
    .map-view {
      height: 480px;
      background: 
        radial-gradient(ellipse 60% 70% at 30% 40%, rgba(0,245,212,0.1), transparent 60%),
        radial-gradient(ellipse 50% 50% at 70% 60%, rgba(255,77,109,0.08), transparent 60%),
        var(--bg-surface);
      border-radius: var(--border-radius-xl);
      border: 1px solid var(--border-color);
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .map-grid {
      position: absolute; inset: 0;
      background-image: 
        linear-gradient(rgba(107,127,163,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(107,127,163,0.08) 1px, transparent 1px);
      background-size: 40px 40px;
    }
    .map-label {
      font-family: var(--font-display);
      font-size: 48px;
      text-transform: uppercase;
      color: var(--text-muted);
      opacity: 0.3;
      position: relative; z-index: 1;
    }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 79
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 81
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 82
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link\">Destinations</a>
      <a href=\"";
        // line 83
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link active\">Activities</a>
      <a href=\"";
        // line 84
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
      <a href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link\">Transport</a>
      <a href=\"";
        // line 86
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 94
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
    <div class=\"section-label reveal\"><span>3,200+ Experiences</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Live More, <span class=\"gradient-text\">Experience Everything</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">From sunrise surfing to midnight culinary tours — your next memory starts here.</p>

    <!-- Filter -->
    <div style=\"display:flex;gap:16px;margin-top:32px;flex-wrap:wrap\" class=\"reveal reveal-delay-2\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All</button>
        <button class=\"filter-pill\">⚡ Thrilling</button>
        <button class=\"filter-pill\">🧘 Serene</button>
        <button class=\"filter-pill\">🎭 Cultural</button>
        <button class=\"filter-pill\">🍜 Culinary</button>
        <button class=\"filter-pill\">🌙 Nightlife</button>
      </div>
      <div style=\"margin-left:auto;display:flex;gap:10px;align-items:center\">
        <select class=\"input\" style=\"width:auto;padding:8px 14px\">
          <option>Any Duration</option>
          <option>Under 2 hours</option>
          <option>Half Day</option>
          <option>Full Day</option>
        </select>
        <select class=\"input\" style=\"width:auto;padding:8px 14px\">
          <option>Any Budget</option>
          <option>Under €30</option>
          <option>€30–€80</option>
          <option>€80+</option>
        </select>
      </div>
    </div>
  </div>
</div>

<!-- Activity Map -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>Activity Map</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Activities <span class=\"text-teal\">Worldwide</span></h2>
    <div class=\"map-view reveal\">
      <div class=\"map-grid\"></div>
      <!-- Map pins -->
      <div class=\"map-pin\" style=\"top:35%;left:48%;\" title=\"Eiffel Tower Tour\"></div>
      <div class=\"map-pin teal\" style=\"top:60%;left:75%;\" title=\"Bali Surf Lesson\"></div>
      <div class=\"map-pin\" style=\"top:45%;left:22%;\" title=\"NYC Food Tour\"></div>
      <div class=\"map-pin teal\" style=\"top:55%;left:58%;\" title=\"Serengeti Safari\"></div>
      <div class=\"map-pin\" style=\"top:28%;left:68%;\" title=\"Kyoto Temple Walk\"></div>
      <div class=\"map-pin teal\" style=\"top:70%;left:35%;\" title=\"Amazon Canopy Tour\"></div>
      <div class=\"map-pin\" style=\"top:42%;left:82%;\" title=\"Great Wall Hike\"></div>
      <div class=\"map-label\">World Activity Map</div>
    </div>
  </div>
</section>

<!-- Activity Cards by Category -->
<section class=\"section\">
  <div class=\"container\">

    <div class=\"section-label reveal\"><span>All Experiences</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Discover <span class=\"text-coral\">Your Next Adventure</span></h2>
    <div class=\"grid-4 stagger\" style=\"margin-bottom:60px\">
      ";
        // line 163
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["activities"]) || array_key_exists("activities", $context) ? $context["activities"] : (function () { throw new RuntimeError('Variable "activities" does not exist.', 163, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["act"]) {
            // line 164
            yield "      <div class=\"activity-card\">
        <div class=\"act-icon-wrap\" style=\"background:linear-gradient(135deg,rgba(255,183,3,0.12),rgba(255,183,3,0.05))\">
           ✨
        </div>
        <div class=\"act-body\">
          <div class=\"act-title\">";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["act"], "name", [], "any", false, false, false, 169), "html", null, true);
            yield "</div>
          <div class=\"act-desc\">";
            // line 170
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["act"], "description", [], "any", false, false, false, 170), 0, 80) . "..."), "html", null, true);
            yield "</div>
          <div class=\"act-meta\">
            <span class=\"act-meta-item\">⏱ ";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["act"], "durationMinutes", [], "any", false, false, false, 172), "html", null, true);
            yield " mins</span>
            <span class=\"act-meta-item\">";
            // line 173
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["act"], "category", [], "any", false, false, false, 173), "html", null, true);
            yield "</span>
          </div>
          <div class=\"act-footer\">
            <div class=\"act-price\">€";
            // line 176
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["act"], "price", [], "any", false, false, false, 176), "html", null, true);
            yield "</div>
            <div style=\"display:flex; gap:8px; align-items:center;\">
               <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"padding:6px 10px; font-size:12px;\">Recommend</button>
               <a href=\"#\" class=\"btn-31\">
                  <span class=\"text-container\">
                    <span class=\"text\">Book</span>
                  </span>
               </a>
            </div>
          </div>
        </div>
      </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['act'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 189
        yield "    </div>

  </div>
</section>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"";
        // line 198
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Activity Finder</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Tell me where you're going and your vibe, and I'll find you the perfect activities! ⚡</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"What kind of experience?\">
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
        return "front/activities.html.twig";
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
        return array (  298 => 198,  287 => 189,  268 => 176,  262 => 173,  258 => 172,  253 => 170,  249 => 169,  242 => 164,  238 => 163,  164 => 94,  154 => 87,  150 => 86,  146 => 85,  142 => 84,  138 => 83,  134 => 82,  130 => 81,  125 => 79,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Browse thousands of activities worldwide — thrilling, serene, cultural, culinary, and more.\">
  <title>Activities — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    /* Activity card */
    .activity-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      transition: all var(--transition-smooth);
      position: relative;
    }
    .activity-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-lg);
      border-color: var(--accent-primary);
    }
    .act-icon-wrap {
      height: 140px;
      display: flex; align-items: center; justify-content: center;
      font-size: 60px;
      position: relative;
    }
    .act-body { padding: 20px; }
    .act-title { font-weight: 700; font-size: 1rem; margin-bottom: 6px; }
    .act-desc { font-size: 0.82rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; }
    .act-meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
    .act-meta-item { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); }
    .act-price { font-family: var(--font-display); font-size: 22px; color: var(--accent-primary); }
    .act-footer { display: flex; justify-content: space-between; align-items: center; }

    /* Map view placeholder */
    .map-view {
      height: 480px;
      background: 
        radial-gradient(ellipse 60% 70% at 30% 40%, rgba(0,245,212,0.1), transparent 60%),
        radial-gradient(ellipse 50% 50% at 70% 60%, rgba(255,77,109,0.08), transparent 60%),
        var(--bg-surface);
      border-radius: var(--border-radius-xl);
      border: 1px solid var(--border-color);
      position: relative;
      overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .map-grid {
      position: absolute; inset: 0;
      background-image: 
        linear-gradient(rgba(107,127,163,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(107,127,163,0.08) 1px, transparent 1px);
      background-size: 40px 40px;
    }
    .map-label {
      font-family: var(--font-display);
      font-size: 48px;
      text-transform: uppercase;
      color: var(--text-muted);
      opacity: 0.3;
      position: relative; z-index: 1;
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
      <a href=\"{{ path('activities') }}\"     class=\"nav-link active\">Activities</a>
      <a href=\"{{ path('accommodations') }}\" class=\"nav-link\">Accommodations</a>
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
    <div class=\"section-label reveal\"><span>3,200+ Experiences</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Live More, <span class=\"gradient-text\">Experience Everything</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">From sunrise surfing to midnight culinary tours — your next memory starts here.</p>

    <!-- Filter -->
    <div style=\"display:flex;gap:16px;margin-top:32px;flex-wrap:wrap\" class=\"reveal reveal-delay-2\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All</button>
        <button class=\"filter-pill\">⚡ Thrilling</button>
        <button class=\"filter-pill\">🧘 Serene</button>
        <button class=\"filter-pill\">🎭 Cultural</button>
        <button class=\"filter-pill\">🍜 Culinary</button>
        <button class=\"filter-pill\">🌙 Nightlife</button>
      </div>
      <div style=\"margin-left:auto;display:flex;gap:10px;align-items:center\">
        <select class=\"input\" style=\"width:auto;padding:8px 14px\">
          <option>Any Duration</option>
          <option>Under 2 hours</option>
          <option>Half Day</option>
          <option>Full Day</option>
        </select>
        <select class=\"input\" style=\"width:auto;padding:8px 14px\">
          <option>Any Budget</option>
          <option>Under €30</option>
          <option>€30–€80</option>
          <option>€80+</option>
        </select>
      </div>
    </div>
  </div>
</div>

<!-- Activity Map -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>Activity Map</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Activities <span class=\"text-teal\">Worldwide</span></h2>
    <div class=\"map-view reveal\">
      <div class=\"map-grid\"></div>
      <!-- Map pins -->
      <div class=\"map-pin\" style=\"top:35%;left:48%;\" title=\"Eiffel Tower Tour\"></div>
      <div class=\"map-pin teal\" style=\"top:60%;left:75%;\" title=\"Bali Surf Lesson\"></div>
      <div class=\"map-pin\" style=\"top:45%;left:22%;\" title=\"NYC Food Tour\"></div>
      <div class=\"map-pin teal\" style=\"top:55%;left:58%;\" title=\"Serengeti Safari\"></div>
      <div class=\"map-pin\" style=\"top:28%;left:68%;\" title=\"Kyoto Temple Walk\"></div>
      <div class=\"map-pin teal\" style=\"top:70%;left:35%;\" title=\"Amazon Canopy Tour\"></div>
      <div class=\"map-pin\" style=\"top:42%;left:82%;\" title=\"Great Wall Hike\"></div>
      <div class=\"map-label\">World Activity Map</div>
    </div>
  </div>
</section>

<!-- Activity Cards by Category -->
<section class=\"section\">
  <div class=\"container\">

    <div class=\"section-label reveal\"><span>All Experiences</span></div>
    <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Discover <span class=\"text-coral\">Your Next Adventure</span></h2>
    <div class=\"grid-4 stagger\" style=\"margin-bottom:60px\">
      {% for act in activities %}
      <div class=\"activity-card\">
        <div class=\"act-icon-wrap\" style=\"background:linear-gradient(135deg,rgba(255,183,3,0.12),rgba(255,183,3,0.05))\">
           ✨
        </div>
        <div class=\"act-body\">
          <div class=\"act-title\">{{ act.name }}</div>
          <div class=\"act-desc\">{{ act.description|slice(0, 80) ~ '...' }}</div>
          <div class=\"act-meta\">
            <span class=\"act-meta-item\">⏱ {{ act.durationMinutes }} mins</span>
            <span class=\"act-meta-item\">{{ act.category }}</span>
          </div>
          <div class=\"act-footer\">
            <div class=\"act-price\">€{{ act.price }}</div>
            <div style=\"display:flex; gap:8px; align-items:center;\">
               <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"padding:6px 10px; font-size:12px;\">Recommend</button>
               <a href=\"#\" class=\"btn-31\">
                  <span class=\"text-container\">
                    <span class=\"text\">Book</span>
                  </span>
               </a>
            </div>
          </div>
        </div>
      </div>
      {% endfor %}
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
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Activity Finder</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Tell me where you're going and your vibe, and I'll find you the perfect activities! ⚡</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"What kind of experience?\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/activities.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\activities.html.twig");
    }
}
