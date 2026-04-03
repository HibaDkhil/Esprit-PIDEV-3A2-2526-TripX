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

/* front/destinations.html.twig */
class __TwigTemplate_7bfe848c82bf0a8d6250caecce89e722 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/destinations.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Explore 190+ stunning destinations worldwide. Find your perfect match with TripX AI-powered recommendations.\">
  <title>Destinations — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    .dest-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }
    .dest-card-wrap { border-radius: var(--border-radius-lg); overflow: hidden; position: relative; }
    .dest-card-wrap.tall .dest-card-inner { height: 460px; }
    .dest-card-wrap.mid  .dest-card-inner { height: 360px; }
    .dest-card-wrap.short .dest-card-inner { height: 300px; }
    .dest-card-inner {
      position: relative;
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      cursor: pointer;
      transition: transform var(--transition-smooth), box-shadow var(--transition-smooth);
    }
    .dest-card-inner:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .dest-card-bg {
      width: 100%; height: 100%;
      display: flex; align-items: center; justify-content: center;
      font-size: 80px;
      transition: transform var(--transition-smooth);
    }
    .dest-card-inner:hover .dest-card-bg { transform: scale(1.07); }
    .dest-card-over {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(3,7,18,0.85) 0%, rgba(3,7,18,0.15) 55%, transparent 100%);
    }
    .dest-card-cnt {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      padding: 24px;
      color: #F0F4F8;
    }
    .dest-name { font-family: var(--font-display); font-size: 34px; text-transform: uppercase; line-height: 1; }
    .dest-country { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.12em; opacity: 0.7; margin-bottom: 8px; }
    .dest-meta-row { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; }
    .dest-hover-layer {
      position: absolute; inset: 0;
      background: rgba(3,7,18,0.7);
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      opacity: 0;
      transition: opacity var(--transition-smooth);
      gap: 14px;
    }
    .dest-card-inner:hover .dest-hover-layer { opacity: 1; }
    .dest-hover-btn {
      background: var(--accent-primary);
      color: #fff;
      padding: 11px 28px;
      border-radius: 100px;
      font-family: var(--font-mono);
      font-size: 11px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      transition: transform var(--transition-fast);
    }
    .dest-hover-btn:hover { transform: scale(1.06); }
    @media (max-width: 900px) {
      .dest-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
      .dest-grid { grid-template-columns: 1fr; }
    }
    .filter-bar { position: sticky; top: var(--nav-height); z-index: 99; background: var(--bg-nav); backdrop-filter: var(--bg-glass-blur); border-bottom: 1px solid var(--border-color); padding: 16px 0; }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 88
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 90
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 91
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link active\">Destinations</a>
      <a href=\"";
        // line 92
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link\">Activities</a>
      <a href=\"";
        // line 93
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
      <a href=\"";
        // line 94
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link\">Transport</a>
      <a href=\"";
        // line 95
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 96
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 103
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

<!-- Filter Bar -->
<div class=\"filter-bar\">
  <div class=\"container\">
    <div style=\"display:flex;gap:16px;align-items:center;flex-wrap:wrap\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All</button>
        <button class=\"filter-pill\">🌍 Europe</button>
        <button class=\"filter-pill\">🌏 Asia</button>
        <button class=\"filter-pill\">🌎 Americas</button>
        <button class=\"filter-pill\">🌴 Islands</button>
        <button class=\"filter-pill\">🏔️ Mountains</button>
      </div>
      <div style=\"margin-left:auto;display:flex;gap:10px\">
        <div class=\"filter-pills\">
          <button class=\"filter-pill\">😎 Chill</button>
          <button class=\"filter-pill\">🧗 Adventure</button>
          <button class=\"filter-pill\">💑 Romantic</button>
          <button class=\"filter-pill\">🎭 Cultural</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Header -->
<div class=\"page-top\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>190+ Destinations</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Find Your <span class=\"gradient-text\">Perfect Place</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">Every corner of the earth, curated by AI for you.</p>
  </div>
</div>

<!-- Destinations Grid -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"dest-grid stagger\">
      ";
        // line 148
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["destinations"]) || array_key_exists("destinations", $context) ? $context["destinations"] : (function () { throw new RuntimeError('Variable "destinations" does not exist.', 148, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["dest"]) {
            // line 149
            yield "        ";
            $context["shape"] = CoreExtension::getAttribute($this->env, $this->source, ["tall", "mid", "short", "tall", "mid", "short"], (CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 149) % 6), [], "array", false, false, false, 149);
            // line 150
            yield "        <div class=\"dest-card-wrap ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["shape"]) || array_key_exists("shape", $context) ? $context["shape"] : (function () { throw new RuntimeError('Variable "shape" does not exist.', 150, $this->source); })()), "html", null, true);
            yield "\">
          <div class=\"dest-card-inner\">
            <div class=\"dest-card-bg\" style=\"background:linear-gradient(135deg,#1a3a5c,#2d6a4f)\">
               ";
            // line 153
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "imageUrl", [], "any", false, false, false, 153)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 154
                yield "                  <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "imageUrl", [], "any", false, false, false, 154), "html", null, true);
                yield "\" style=\"width:100%; height:100%; object-fit:cover; opacity:0.6;\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "name", [], "any", false, false, false, 154), "html", null, true);
                yield "\">
               ";
            } else {
                // line 156
                yield "                  🌍
               ";
            }
            // line 158
            yield "            </div>
            <div class=\"dest-card-over\"></div>
            <div class=\"dest-hover-layer\">
              <a href=\"#\" class=\"btn-31\">
                <span class=\"text-container\">
                  <span class=\"text\">Explore ";
            // line 163
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "name", [], "any", false, false, false, 163), "html", null, true);
            yield "</span>
                </span>
              </a>
              <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"margin-top:10px;\">Recommend</button>
            </div>
            <div class=\"dest-card-cnt\">
              <div class=\"dest-country\">";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "country", [], "any", false, false, false, 169), "html", null, true);
            yield "</div>
              <div class=\"dest-name\">";
            // line 170
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "name", [], "any", false, false, false, 170), "html", null, true);
            yield "</div>
              <div class=\"dest-meta-row\">
                <span class=\"badge badge-teal\">";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "type", [], "any", false, false, false, 172)), "html", null, true);
            yield "</span>
                <span class=\"badge badge-muted\">From €";
            // line 173
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(((CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "estimatedBudget", [], "any", true, true, false, 173)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["dest"], "estimatedBudget", [], "any", false, false, false, 173), 0)) : (0)), 0), "html", null, true);
            yield "</span>
              </div>
            </div>
          </div>
        </div>
      ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['dest'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 179
        yield "    </div>

    <div class=\"text-center mt-48\">
      <button class=\"btn btn-secondary btn-lg ripple-btn\">Load More Destinations</button>
    </div>
  </div>
</section>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"";
        // line 191
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Travel Assistant</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Exploring destinations? I can help you find the perfect match based on your travel style! Tell me your dream vibe 🌍</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA...\">
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
        return "front/destinations.html.twig";
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
        return array (  327 => 191,  313 => 179,  293 => 173,  289 => 172,  284 => 170,  280 => 169,  271 => 163,  264 => 158,  260 => 156,  252 => 154,  250 => 153,  243 => 150,  240 => 149,  223 => 148,  173 => 103,  163 => 96,  159 => 95,  155 => 94,  151 => 93,  147 => 92,  143 => 91,  139 => 90,  134 => 88,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Explore 190+ stunning destinations worldwide. Find your perfect match with TripX AI-powered recommendations.\">
  <title>Destinations — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .page-top { padding-top: calc(var(--nav-height) + 60px); padding-bottom: 40px; }
    .dest-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }
    .dest-card-wrap { border-radius: var(--border-radius-lg); overflow: hidden; position: relative; }
    .dest-card-wrap.tall .dest-card-inner { height: 460px; }
    .dest-card-wrap.mid  .dest-card-inner { height: 360px; }
    .dest-card-wrap.short .dest-card-inner { height: 300px; }
    .dest-card-inner {
      position: relative;
      border-radius: var(--border-radius-lg);
      overflow: hidden;
      cursor: pointer;
      transition: transform var(--transition-smooth), box-shadow var(--transition-smooth);
    }
    .dest-card-inner:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .dest-card-bg {
      width: 100%; height: 100%;
      display: flex; align-items: center; justify-content: center;
      font-size: 80px;
      transition: transform var(--transition-smooth);
    }
    .dest-card-inner:hover .dest-card-bg { transform: scale(1.07); }
    .dest-card-over {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(3,7,18,0.85) 0%, rgba(3,7,18,0.15) 55%, transparent 100%);
    }
    .dest-card-cnt {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      padding: 24px;
      color: #F0F4F8;
    }
    .dest-name { font-family: var(--font-display); font-size: 34px; text-transform: uppercase; line-height: 1; }
    .dest-country { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.12em; opacity: 0.7; margin-bottom: 8px; }
    .dest-meta-row { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; }
    .dest-hover-layer {
      position: absolute; inset: 0;
      background: rgba(3,7,18,0.7);
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      opacity: 0;
      transition: opacity var(--transition-smooth);
      gap: 14px;
    }
    .dest-card-inner:hover .dest-hover-layer { opacity: 1; }
    .dest-hover-btn {
      background: var(--accent-primary);
      color: #fff;
      padding: 11px 28px;
      border-radius: 100px;
      font-family: var(--font-mono);
      font-size: 11px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      transition: transform var(--transition-fast);
    }
    .dest-hover-btn:hover { transform: scale(1.06); }
    @media (max-width: 900px) {
      .dest-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
      .dest-grid { grid-template-columns: 1fr; }
    }
    .filter-bar { position: sticky; top: var(--nav-height); z-index: 99; background: var(--bg-nav); backdrop-filter: var(--bg-glass-blur); border-bottom: 1px solid var(--border-color); padding: 16px 0; }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"{{ path('index') }}\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"{{ path('index') }}\"          class=\"nav-link\">Home</a>
      <a href=\"{{ path('destinations') }}\"   class=\"nav-link active\">Destinations</a>
      <a href=\"{{ path('activities') }}\"     class=\"nav-link\">Activities</a>
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

<!-- Filter Bar -->
<div class=\"filter-bar\">
  <div class=\"container\">
    <div style=\"display:flex;gap:16px;align-items:center;flex-wrap:wrap\">
      <div class=\"filter-pills\">
        <button class=\"filter-pill active\">All</button>
        <button class=\"filter-pill\">🌍 Europe</button>
        <button class=\"filter-pill\">🌏 Asia</button>
        <button class=\"filter-pill\">🌎 Americas</button>
        <button class=\"filter-pill\">🌴 Islands</button>
        <button class=\"filter-pill\">🏔️ Mountains</button>
      </div>
      <div style=\"margin-left:auto;display:flex;gap:10px\">
        <div class=\"filter-pills\">
          <button class=\"filter-pill\">😎 Chill</button>
          <button class=\"filter-pill\">🧗 Adventure</button>
          <button class=\"filter-pill\">💑 Romantic</button>
          <button class=\"filter-pill\">🎭 Cultural</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Header -->
<div class=\"page-top\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>190+ Destinations</span></div>
    <h1 class=\"display-md reveal\" style=\"margin-bottom:8px\">Find Your <span class=\"gradient-text\">Perfect Place</span></h1>
    <p class=\"serif-mood text-muted reveal reveal-delay-1\">Every corner of the earth, curated by AI for you.</p>
  </div>
</div>

<!-- Destinations Grid -->
<section class=\"section-sm\">
  <div class=\"container\">
    <div class=\"dest-grid stagger\">
      {% for dest in destinations %}
        {% set shape = ['tall', 'mid', 'short', 'tall', 'mid', 'short'][loop.index0 % 6] %}
        <div class=\"dest-card-wrap {{ shape }}\">
          <div class=\"dest-card-inner\">
            <div class=\"dest-card-bg\" style=\"background:linear-gradient(135deg,#1a3a5c,#2d6a4f)\">
               {% if dest.imageUrl %}
                  <img src=\"{{ dest.imageUrl }}\" style=\"width:100%; height:100%; object-fit:cover; opacity:0.6;\" alt=\"{{ dest.name }}\">
               {% else %}
                  🌍
               {% endif %}
            </div>
            <div class=\"dest-card-over\"></div>
            <div class=\"dest-hover-layer\">
              <a href=\"#\" class=\"btn-31\">
                <span class=\"text-container\">
                  <span class=\"text\">Explore {{ dest.name }}</span>
                </span>
              </a>
              <button class=\"btn btn-secondary btn-sm ripple-btn\" style=\"margin-top:10px;\">Recommend</button>
            </div>
            <div class=\"dest-card-cnt\">
              <div class=\"dest-country\">{{ dest.country }}</div>
              <div class=\"dest-name\">{{ dest.name }}</div>
              <div class=\"dest-meta-row\">
                <span class=\"badge badge-teal\">{{ dest.type|capitalize }}</span>
                <span class=\"badge badge-muted\">From €{{ dest.estimatedBudget|default(0)|number_format(0) }}</span>
              </div>
            </div>
          </div>
        </div>
      {% endfor %}
    </div>

    <div class=\"text-center mt-48\">
      <button class=\"btn btn-secondary btn-lg ripple-btn\">Load More Destinations</button>
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
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Travel Assistant</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Exploring destinations? I can help you find the perfect match based on your travel style! Tell me your dream vibe 🌍</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>

<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/destinations.html.twig", "C:\\Sym\\templates\\front\\destinations.html.twig");
    }
}
