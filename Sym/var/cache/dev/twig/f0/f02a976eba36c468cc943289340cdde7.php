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

/* front/users.html.twig */
class __TwigTemplate_53aad5c79712831a4e398b4f88cc2f7c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/users.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Your TripX profile — Travel DNA, trip history, AI recommendations, and achievements.\">
  <title>My Profile — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .profile-layout { display: grid; grid-template-columns: 300px 1fr; gap: 32px; padding-top: calc(var(--nav-height) + 40px); }
    /* Sidebar */
    .profile-sidebar { position: sticky; top: calc(var(--nav-height) + 20px); align-self: start; max-height: calc(100vh - var(--nav-height) - 40px); overflow-y: auto; padding-right: 6px; }
    .profile-sidebar::-webkit-scrollbar { width: 4px; }
    .profile-sidebar::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .profile-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 32px;
      text-align: center;
      margin-bottom: 20px;
    }
    .profile-avatar {
      width: 96px; height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-gold));
      margin: 0 auto 16px;
      display: flex; align-items: center; justify-content: center;
      font-size: 40px; color: #fff; font-family: var(--font-body); font-weight: 700;
      box-shadow: 0 0 40px rgba(255,77,109,0.35);
    }
    .profile-name { font-family: var(--font-display); font-size: 28px; text-transform: uppercase; margin-bottom: 4px; }
    .profile-handle { font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); letter-spacing: 0.1em; margin-bottom: 16px; }
    .profile-badge-row { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; }

    /* Sidebar nav */
    .sidebar-nav {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
    }
    .sidebar-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 16px 20px;
      font-size: 0.9rem;
      color: var(--text-secondary);
      border-bottom: 1px solid var(--border-color);
      transition: all var(--transition-fast);
    }
    .sidebar-nav-item:last-child { border-bottom: none; }
    .sidebar-nav-item:hover, .sidebar-nav-item.active {
      background: rgba(255,77,109,0.06);
      color: var(--accent-primary);
    }
    .sidebar-nav-item.active { font-weight: 600; }
    .sidebar-nav-icon { font-size: 18px; }

    /* Achievement badges */
    .achievement {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px;
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-md);
      transition: all var(--transition-fast);
    }
    .achievement:hover { border-color: var(--accent-gold); }
    .achievement-icon {
      width: 48px; height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-gold), #FF6B00);
      display: flex; align-items: center; justify-content: center;
      font-size: 22px;
      box-shadow: 0 0 20px rgba(255,183,3,0.3);
    }
    .achievement.locked { opacity: 0.45; filter: grayscale(1); }
    .achievement.locked .achievement-icon { background: var(--border-color); }

    /* Recommendation feed */
    .reco-card {
      display: flex; gap: 16px; align-items: center;
      padding: 16px; background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-md);
      transition: all var(--transition-fast);
    }
    .reco-card:hover { border-color: var(--accent-teal); }
    .reco-thumb {
      width: 72px; height: 72px;
      border-radius: var(--border-radius-sm);
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-teal));
      display: flex; align-items: center; justify-content: center;
      font-size: 30px;
      flex-shrink: 0;
    }

    /* === TRAVEL DNA REDESIGN === */
    .dna-card {
      padding: 24px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 140px;
      overflow: hidden;
      word-break: break-word;
      transition: border-color 0.2s, transform 0.2s;
    }
    .dna-card:hover { border-color: var(--accent-teal); transform: translateY(-2px); }
    .dna-stat-num {
      font-family: var(--font-display);
      font-size: 2.4rem;
      line-height: 1;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-teal));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .dna-persona-card {
      background: linear-gradient(135deg, rgba(255,77,109,0.12), rgba(0,166,237,0.12));
      border: 1px solid rgba(255,77,109,0.3);
      border-radius: var(--border-radius-lg);
      padding: 28px 32px;
      display: flex;
      align-items: center;
      gap: 24px;
      margin-bottom: 28px;
    }
    .dna-persona-emoji { font-size: 52px; }
    .dna-persona-label { font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 6px; }
    .dna-persona-name { font-family: var(--font-display); font-size: 28px; text-transform: uppercase; color: var(--accent-primary); }
    .dna-persona-desc { font-size: 0.85rem; color: var(--text-muted); margin-top: 6px; }
    .dna-funfact {
      background: linear-gradient(90deg, rgba(0,200,150,0.08), rgba(0,166,237,0.08));
      border-left: 3px solid var(--accent-teal);
      border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0;
      padding: 14px 18px;
      font-size: 0.85rem;
      color: var(--text-secondary);
      margin-bottom: 28px;
    }
    .dna-funfact strong { color: var(--accent-teal); }
    .chart-label-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .chart-label-row h4 { font-family: var(--font-display); font-size: 15px; text-transform: uppercase; letter-spacing: 0.04em; }
    .chart-legend { display: flex; gap: 14px; flex-wrap: wrap; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; }
    .legend-item { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); display: flex; align-items: center; }
    .dna-bar-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .dna-bar-label { font-size: 0.78rem; color: var(--text-muted); min-width: 90px; }
    .dna-bar-track { flex: 1; height: 8px; background: rgba(255,255,255,0.06); border-radius: 99px; overflow: hidden; }
    .dna-bar-fill { height: 100%; border-radius: 99px; transition: width 1.2s cubic-bezier(0.22,1,0.36,1); }
    .dna-bar-pct { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); min-width: 36px; text-align: right; }
    .engagement-ring { position: relative; display: inline-flex; align-items: center; justify-content: center; }
    .engagement-ring svg { transform: rotate(-90deg); }
    .engagement-ring-inner { position: absolute; text-align: center; }
    /* === ARIA CHAT REDESIGN === */
    .aria-panel { width: 400px; max-height: min(560px, calc(100vh - 160px)); display: flex; flex-direction: column; background: linear-gradient(160deg, rgba(5,16,42,0.95), rgba(9,28,68,0.92)); border: 1px solid rgba(0,166,237,0.35); }
    .aria-header { flex-shrink: 0; padding: 12px 14px; }
    .aria-messages { flex: 1 1 auto; min-height: 0; overflow-y: auto; padding: 12px 14px; display: flex; flex-direction: column; gap: 10px; }
    .aria-input-row { display: flex; align-items: center; gap: 8px; padding: 12px 16px; border-top: 1px solid var(--border-color); flex-shrink: 0; }
    .aria-input { flex: 1; min-width: 0; font-size: 0.78rem; color: #e2e8f0; }
    .aria-attach-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 10px; cursor: pointer; color: var(--text-muted); font-size: 16px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-attach-btn:hover { border-color: var(--accent-teal); color: var(--accent-teal); }
    .aria-img-preview { margin: 8px 16px 0; position: relative; display: none; }
    .aria-img-preview img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); }
    .aria-img-preview .remove-img { position: absolute; top: -6px; left: 70px; background: var(--accent-primary); color: #fff; border: none; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .pref-check-row { display: flex; flex-wrap: wrap; gap: 10px 18px; margin-top: 8px; }
    .pref-check-row label { display: inline-flex; align-items: center; gap: 6px; font-size: 0.84rem; cursor: pointer; color: var(--text-secondary); }
    .aria-msg .aria-bubble { white-space: pre-line; }
    .aria-voice-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 10px; cursor: pointer; color: var(--text-muted); font-size: 14px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-voice-btn:hover, .aria-voice-btn.active { border-color: var(--accent-gold); color: var(--accent-gold); }
    .aria-stop-voice-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 9px; cursor: pointer; color: var(--text-muted); font-size: 13px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-stop-voice-btn:hover { border-color: var(--accent-primary); color: var(--accent-primary); }
    .aria-msg .aria-bubble { font-size: 0.78rem; }
    .aria-msg.user .aria-bubble { background: #ffffff; color: #0f172a; }
    @media (max-width: 900px) {
      .profile-layout { grid-template-columns: 1fr; }
      .profile-sidebar { position: static; }
      .aria-panel { width: 92vw; max-width: 400px; }
    }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 198
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 200
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 201
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link\">Destinations</a>
      <a href=\"";
        // line 202
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link\">Activities</a>
      <a href=\"";
        // line 203
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
      <a href=\"";
        // line 204
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link\">Transport</a>
      <a href=\"";
        // line 205
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 206
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 213
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("users");
        yield "\" class=\"btn-nav-primary ripple-btn\">My Profile</a>
      <a href=\"";
        // line 214
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
        <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
        <div class=\"text\">Logout</div>
      </a>
    </div>
  </div>
</nav>

<div class=\"container\">
  <div class=\"profile-layout\">
    <!-- Sidebar -->
    <aside class=\"profile-sidebar\">
      <div class=\"profile-card reveal\">
        <div class=\"profile-avatar\">";
        // line 227
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 227, $this->source); })()), "firstName", [], "any", false, false, false, 227))), "html", null, true);
        yield "</div>
        <div class=\"profile-name\">";
        // line 228
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 228, $this->source); })()), "firstName", [], "any", false, false, false, 228), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 228, $this->source); })()), "lastName", [], "any", false, false, false, 228), "html", null, true);
        yield "</div>
        <div class=\"profile-handle\">@";
        // line 229
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["profileHandle"]) || array_key_exists("profileHandle", $context) ? $context["profileHandle"] : (function () { throw new RuntimeError('Variable "profileHandle" does not exist.', 229, $this->source); })()), "html", null, true);
        yield " · ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 229, $this->source); })()), "role", [], "any", false, false, false, 229)), "html", null, true);
        yield " · TripX</div>
        <div class=\"profile-badge-row\">
          ";
        // line 231
        $context["badge_classes"] = ["badge-coral", "badge-gold", "badge-teal"];
        // line 232
        yield "          ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(((array_key_exists("profileSidebarBadges", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["profileSidebarBadges"]) || array_key_exists("profileSidebarBadges", $context) ? $context["profileSidebarBadges"] : (function () { throw new RuntimeError('Variable "profileSidebarBadges" does not exist.', 232, $this->source); })()), [(isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 232, $this->source); })())])) : ([(isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 232, $this->source); })())])));
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
        foreach ($context['_seq'] as $context["_key"] => $context["badge"]) {
            // line 233
            yield "          <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["badge_classes"]) || array_key_exists("badge_classes", $context) ? $context["badge_classes"] : (function () { throw new RuntimeError('Variable "badge_classes" does not exist.', 233, $this->source); })()), (CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 233) % 3), [], "array", false, false, false, 233), "html", null, true);
            yield "\" title=\"From your preferences &amp; activity\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["badge"], "html", null, true);
            yield "</span>
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
        unset($context['_seq'], $context['_key'], $context['badge'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 235
        yield "        </div>
        <div style=\"display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;text-align:center\">
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">";
        // line 237
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("profileStatBookings", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["profileStatBookings"]) || array_key_exists("profileStatBookings", $context) ? $context["profileStatBookings"] : (function () { throw new RuntimeError('Variable "profileStatBookings" does not exist.', 237, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Bookings</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">";
        // line 238
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("profileStatDestinationsTapped", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["profileStatDestinationsTapped"]) || array_key_exists("profileStatDestinationsTapped", $context) ? $context["profileStatDestinationsTapped"] : (function () { throw new RuntimeError('Variable "profileStatDestinationsTapped" does not exist.', 238, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Dest. explored</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">";
        // line 239
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("profileStatMinutes", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["profileStatMinutes"]) || array_key_exists("profileStatMinutes", $context) ? $context["profileStatMinutes"] : (function () { throw new RuntimeError('Variable "profileStatMinutes" does not exist.', 239, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Min on site</div></div>
        </div>
      </div>

      <div class=\"sidebar-nav reveal reveal-delay-1\">
        <a href=\"#personal\"   class=\"sidebar-nav-item active\" data-track=\"NAV_PERSONAL\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">👤</span> Personal Info</a>
        <a href=\"#preferences\" class=\"sidebar-nav-item\" data-track=\"NAV_PREFERENCES\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">✈️</span> Travel Preferences</a>
        <a href=\"#activity\"   class=\"sidebar-nav-item\" data-track=\"NAV_ACTIVITY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">📊</span> Your Activity</a>
        <a href=\"#history\"    class=\"sidebar-nav-item\" data-track=\"NAV_HISTORY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🗺️</span> Trip History</a>
        <a href=\"#recos\"      class=\"sidebar-nav-item\" data-track=\"NAV_RECOS\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">✦</span> AI Picks</a>
        <a href=\"#achievements\" class=\"sidebar-nav-item\" data-track=\"NAV_ACHIEVEMENTS\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🏆</span> Achievements</a>
        <a href=\"#loyalty\"    class=\"sidebar-nav-item\" data-track=\"NAV_LOYALTY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">💎</span> Loyalty Points</a>
        <a href=\"#security\"   class=\"sidebar-nav-item\" data-track=\"NAV_SECURITY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🔐</span> Security</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main style=\"padding-bottom:80px\">

      <!-- Personal Info -->
      <section id=\"personal\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Personal Info</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-coral\">Details</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div class=\"grid-2\" style=\"gap:30px\">
              <div class=\"wavy-control\">
                <input id=\"profile_first_name\" type=\"text\" value=\"";
        // line 266
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 266, $this->source); })()), "firstName", [], "any", false, false, false, 266), "html", null, true);
        yield "\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 266, $this->source); })()), "firstName", [], "any", false, false, false, 266)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("has-value") : (""));
        yield "\">
                <label>
                  ";
        // line 268
        $context["label"] = "First Name";
        // line 269
        yield "                  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 269, $this->source); })()), ""));
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
        foreach ($context['_seq'] as $context["_key"] => $context["letter"]) {
            yield "<span style=\"transition-delay:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 269) * 30), "html", null, true);
            yield "ms\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["letter"], "html", null, true);
            yield "</span>";
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
        unset($context['_seq'], $context['_key'], $context['letter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 270
        yield "                </label>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_last_name\" type=\"text\" value=\"";
        // line 273
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 273, $this->source); })()), "lastName", [], "any", false, false, false, 273), "html", null, true);
        yield "\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 273, $this->source); })()), "lastName", [], "any", false, false, false, 273)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("has-value") : (""));
        yield "\">
                <label>
                  ";
        // line 275
        $context["label"] = "Last Name";
        // line 276
        yield "                  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 276, $this->source); })()), ""));
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
        foreach ($context['_seq'] as $context["_key"] => $context["letter"]) {
            yield "<span style=\"transition-delay:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 276) * 30), "html", null, true);
            yield "ms\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["letter"], "html", null, true);
            yield "</span>";
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
        unset($context['_seq'], $context['_key'], $context['letter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 277
        yield "                </label>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_email\" type=\"email\" value=\"";
        // line 280
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 280, $this->source); })()), "email", [], "any", false, false, false, 280), "html", null, true);
        yield "\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 280, $this->source); })()), "email", [], "any", false, false, false, 280)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("has-value") : (""));
        yield "\">
                <label>
                  ";
        // line 282
        $context["label"] = "Email";
        // line 283
        yield "                  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 283, $this->source); })()), ""));
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
        foreach ($context['_seq'] as $context["_key"] => $context["letter"]) {
            yield "<span style=\"transition-delay:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 283) * 30), "html", null, true);
            yield "ms\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["letter"], "html", null, true);
            yield "</span>";
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
        unset($context['_seq'], $context['_key'], $context['letter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 284
        yield "                </label>
                <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_phone\" type=\"tel\" value=\"";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 288, $this->source); })()), "phoneNumber", [], "any", false, false, false, 288), "html", null, true);
        yield "\" placeholder=\" \" oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 288, $this->source); })()), "phoneNumber", [], "any", false, false, false, 288)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("has-value") : (""));
        yield "\">
                <label>
                  ";
        // line 290
        $context["label"] = "Phone";
        // line 291
        yield "                  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 291, $this->source); })()), ""));
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
        foreach ($context['_seq'] as $context["_key"] => $context["letter"]) {
            yield "<span style=\"transition-delay:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 291) * 30), "html", null, true);
            yield "ms\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["letter"], "html", null, true);
            yield "</span>";
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
        unset($context['_seq'], $context['_key'], $context['letter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 292
        yield "                </label>
                <span class=\"field-icon\"><i class=\"fas fa-phone-alt\"></i></span>
              </div>
            </div>
            <div class=\"grid-2\" style=\"gap:20px; margin-top:10px\">
              <div class=\"input-group\"><div class=\"input-label\">Gender</div><input class=\"input\" type=\"text\" value=\"";
        // line 297
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "gender", [], "any", true, true, false, 297)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 297, $this->source); })()), "gender", [], "any", false, false, false, 297), "Not specified")) : ("Not specified")), "html", null, true);
        yield "\" disabled></div>
              <div class=\"input-group\"><div class=\"input-label\">Birth Year</div><input class=\"input\" type=\"text\" value=\"";
        // line 298
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 298, $this->source); })()), "birthYear", [], "any", false, false, false, 298), "html", null, true);
        yield "\" disabled></div>
            </div>
            <div class=\"input-group\" style=\"margin-top:24px\">
              <div class=\"input-label\">Bio / Travel Style</div>
              <textarea id=\"profile_bio\" class=\"input\" rows=\"3\" style=\"resize:vertical; color:var(--text-primary)\" placeholder=\"Tell us about your travel style...\">";
        // line 302
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "bio", [], "any", true, true, false, 302)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 302, $this->source); })()), "bio", [], "any", false, false, false, 302), "")) : ("")), "html", null, true);
        yield "</textarea>
            </div>
            <div style=\"margin-top:28px;display:flex;gap:12px\">
              <button class=\"btn btn-primary ripple-btn\" id=\"saveProfileBtn\">Save Changes</button>
              <button class=\"btn btn-secondary\">Cancel</button>
            </div>

          </div>
        </div>
      </section>

      <!-- Travel preferences (userpreferences) -->
      <section id=\"preferences\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Travel Preferences</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-teal\">Travel Style</span></h2>
        
        <style>
          .pref-accordion-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(0,200,150,0.2);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          html[data-theme=\"light\"] .pref-accordion-card {
            background: rgba(255,255,255,0.6);
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
          }
          .pref-accordion-header {
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            user-select: none;
          }
          .pref-accordion-header h3 {
            margin: 0;
            font-family: var(--font-display);
            font-size: 1.2rem;
            color: var(--accent-primary);
          }
          .pref-arrow {
            font-size: 14px;
            color: var(--text-muted);
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          .pref-accordion-card.expanded .pref-arrow {
            transform: rotate(-180deg);
          }
          .pref-accordion-body {
            padding: 0 24px;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          .pref-accordion-card.expanded .pref-accordion-body {
            padding: 0 24px 24px;
            max-height: 2000px;
            opacity: 1;
          }
          
          /* Chip styles matching onboarding */
          .pref-chip-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
          }
          .pref-chip {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 0.85rem;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.2s ease;
            user-select: none;
          }
          html[data-theme=\"light\"] .pref-chip { background: #f8fafc; }
          .pref-chip:hover { border-color: var(--accent-teal); }
          .pref-chip.selected {
            background: var(--accent-teal);
            color: #1a1a1a !important; /* Darker visible text when selected */
            font-weight: 700;
            border-color: var(--accent-teal);
            box-shadow: 0 4px 12px rgba(0,200,150,0.3);
          }
          
          /* Wavy Control Style for Personal Info */
          .wavy-control {
            position: relative;
            margin: 20px 0 35px;
            width: 100%;
          }
          .wavy-control input {
            background-color: transparent !important;
            border: 0 !important;
            border-bottom: 2px #d1d5db solid !important;
            display: block;
            width: 100%;
            padding: 12px 0 !important;
            font-size: 16px;
            color: var(--text-primary);
            border-radius: 0 !important;
            transition: 0.3s ease;
          }
          .wavy-control input:focus, .wavy-control input.has-value {
            outline: 0;
            border-bottom-color: var(--accent-primary) !important;
          }
          .wavy-control label {
            position: absolute;
            top: 12px;
            left: 0;
            pointer-events: none;
            color: var(--text-muted);
          }
          .wavy-control label span {
            display: inline-block;
            font-size: 16px;
            min-width: 5px;
            transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
          }
          .wavy-control input:focus + label span,
          .wavy-control input.has-value + label span {
            color: var(--accent-primary);
            transform: translateY(-25px);
            font-size: 14px;
            font-weight: 600;
          }
          .wavy-control .field-icon {
            position: absolute;
            right: 0;
            top: 12px;
            color: var(--text-muted);
            transition: color 0.3s;
          }
          .wavy-control input:focus ~ .field-icon {
            color: var(--accent-primary);
          }
          
          .pref-section-title { font-weight: 700; font-size: 0.95rem; margin-top: 24px; margin-bottom: 4px; color: var(--text-primary); }
        </style>

        <div class=\"pref-accordion-card reveal\" id=\"prefAccordion\">
          <div class=\"pref-accordion-header\" onclick=\"document.getElementById('prefAccordion').classList.toggle('expanded')\">
            <h3>✈️ Manage Preferences</h3>
            <span class=\"pref-arrow\">▼</span>
          </div>
          
          <div class=\"pref-accordion-body\" id=\"prefManagerRoot\">
            <p style=\"color:var(--text-muted);font-size:0.88rem;margin-bottom:20px;margin-top: -10px;\">Update your travel parameters. These influence ARIA and destination matching.</p>
            
            <div class=\"pref-section-title\">Budget (Per Night)</div>
            <div style=\"max-width: 400px; display: flex; flex-direction: column; gap: 20px; margin-top: 14px;\">
              <div>
                <div style=\"display:flex; justify-content:space-between; font-weight:600; font-size:0.85rem; margin-bottom:6px;\">
                  <span>Min Budget</span><span id=\"profMinBudgetDisplay\">\$";
        // line 464
        yield (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 464, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "budgetMinPerNight", [], "any", true, true, false, 464)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 464, $this->source); })()), "budgetMinPerNight", [], "any", false, false, false, 464), "50")) : ("50")), "html", null, true)) : ("50"));
        yield "</span>
                </div>
                <input type=\"range\" id=\"profMinBudget\" class=\"budget-slider\" min=\"0\" max=\"1000\" step=\"50\" value=\"";
        // line 466
        yield (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 466, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "budgetMinPerNight", [], "any", true, true, false, 466)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 466, $this->source); })()), "budgetMinPerNight", [], "any", false, false, false, 466), "50")) : ("50")), "html", null, true)) : ("50"));
        yield "\" style=\"width:100%\">
              </div>
              <div>
                <div style=\"display:flex; justify-content:space-between; font-weight:600; font-size:0.85rem; margin-bottom:6px;\">
                  <span>Max Budget</span><span id=\"profMaxBudgetDisplay\">\$";
        // line 470
        yield (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 470, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "budgetMaxPerNight", [], "any", true, true, false, 470)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 470, $this->source); })()), "budgetMaxPerNight", [], "any", false, false, false, 470), "500")) : ("500")), "html", null, true)) : ("500"));
        yield "</span>
                </div>
                <input type=\"range\" id=\"profMaxBudget\" class=\"budget-slider\" min=\"0\" max=\"2000\" step=\"100\" value=\"";
        // line 472
        yield (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 472, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "budgetMaxPerNight", [], "any", true, true, false, 472)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 472, $this->source); })()), "budgetMaxPerNight", [], "any", false, false, false, 472), "500")) : ("500")), "html", null, true)) : ("500"));
        yield "\" style=\"width:100%\">
              </div>
            </div>

            <div class=\"grid-2\" style=\"gap:24px; margin-top: 24px;\">
              <div>
                <div class=\"pref-section-title\" style=\"margin-top:0\">Travel Pace</div>
                <div class=\"pref-chip-grid\" data-group=\"travel_pace\" data-multi=\"false\">
                  ";
        // line 480
        $context["ppace"] = (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 480, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "travelPace", [], "any", true, true, false, 480)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 480, $this->source); })()), "travelPace", [], "any", false, false, false, 480), "")) : (""))) : (""));
        // line 481
        yield "                  <div class=\"pref-chip ";
        yield ((((isset($context["ppace"]) || array_key_exists("ppace", $context) ? $context["ppace"] : (function () { throw new RuntimeError('Variable "ppace" does not exist.', 481, $this->source); })()) == "Relaxed")) ? ("selected") : (""));
        yield "\" data-val=\"Relaxed\">🌅 Relaxed</div>
                  <div class=\"pref-chip ";
        // line 482
        yield ((((isset($context["ppace"]) || array_key_exists("ppace", $context) ? $context["ppace"] : (function () { throw new RuntimeError('Variable "ppace" does not exist.', 482, $this->source); })()) == "Moderate")) ? ("selected") : (""));
        yield "\" data-val=\"Moderate\">🚶 Moderate</div>
                  <div class=\"pref-chip ";
        // line 483
        yield ((((isset($context["ppace"]) || array_key_exists("ppace", $context) ? $context["ppace"] : (function () { throw new RuntimeError('Variable "ppace" does not exist.', 483, $this->source); })()) == "Fast-paced")) ? ("selected") : (""));
        yield "\" data-val=\"Fast-paced\">⚡ Fast-paced</div>
                </div>
              </div>
              
              <div>
                <div class=\"pref-section-title\" style=\"margin-top:0\">Who do you travel with?</div>
                <div class=\"pref-chip-grid\" data-group=\"group_type\" data-multi=\"false\">
                  ";
        // line 490
        $context["pgrp"] = (((($tmp = (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 490, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((CoreExtension::getAttribute($this->env, $this->source, ($context["preferences"] ?? null), "groupType", [], "any", true, true, false, 490)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 490, $this->source); })()), "groupType", [], "any", false, false, false, 490), "")) : (""))) : (""));
        // line 491
        yield "                  <div class=\"pref-chip ";
        yield ((((isset($context["pgrp"]) || array_key_exists("pgrp", $context) ? $context["pgrp"] : (function () { throw new RuntimeError('Variable "pgrp" does not exist.', 491, $this->source); })()) == "Solo")) ? ("selected") : (""));
        yield "\" data-val=\"Solo\">🎒 Solo</div>
                  <div class=\"pref-chip ";
        // line 492
        yield ((((isset($context["pgrp"]) || array_key_exists("pgrp", $context) ? $context["pgrp"] : (function () { throw new RuntimeError('Variable "pgrp" does not exist.', 492, $this->source); })()) == "Couple")) ? ("selected") : (""));
        yield "\" data-val=\"Couple\">💑 Couple</div>
                  <div class=\"pref-chip ";
        // line 493
        yield ((((isset($context["pgrp"]) || array_key_exists("pgrp", $context) ? $context["pgrp"] : (function () { throw new RuntimeError('Variable "pgrp" does not exist.', 493, $this->source); })()) == "Family")) ? ("selected") : (""));
        yield "\" data-val=\"Family\">👨‍👩‍👧 Family</div>
                  <div class=\"pref-chip ";
        // line 494
        yield ((((isset($context["pgrp"]) || array_key_exists("pgrp", $context) ? $context["pgrp"] : (function () { throw new RuntimeError('Variable "pgrp" does not exist.', 494, $this->source); })()) == "Friends")) ? ("selected") : (""));
        yield "\" data-val=\"Friends\">👯 Friends</div>
                  <div class=\"pref-chip ";
        // line 495
        yield ((((isset($context["pgrp"]) || array_key_exists("pgrp", $context) ? $context["pgrp"] : (function () { throw new RuntimeError('Variable "pgrp" does not exist.', 495, $this->source); })()) == "Business")) ? ("selected") : (""));
        yield "\" data-val=\"Business\">💼 Business</div>
                </div>
              </div>
            </div>

            <div class=\"pref-section-title\">Priorities (Max 5)</div>
            <div class=\"pref-chip-grid\" data-group=\"priorities\" data-multi=\"true\" data-max=\"5\">
              ";
        // line 502
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Activities", "Wellness", "Food and Drinks", "Family Friendly", "Parking", "Amenities", "Pet-Friendly", "Business Facilities", "I dont care"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 503
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefPriorities", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefPriorities"]) || array_key_exists("prefPriorities", $context) ? $context["prefPriorities"] : (function () { throw new RuntimeError('Variable "prefPriorities" does not exist.', 503, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 505
        yield "            </div>

            <div class=\"pref-section-title\">Preferred Climate</div>
            <div class=\"pref-chip-grid\" data-group=\"preferred_climate\" data-multi=\"true\">
              ";
        // line 509
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Temperate", "Tropical", "Desert", "Cold/Arctic", "Oceanic", "Mountain"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 510
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefClimate", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefClimate"]) || array_key_exists("prefClimate", $context) ? $context["prefClimate"] : (function () { throw new RuntimeError('Variable "prefClimate" does not exist.', 510, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 512
        yield "            </div>

            <div class=\"pref-section-title\">Location Preferences</div>
            <div class=\"pref-chip-grid\" data-group=\"location_preferences\" data-multi=\"true\">
              ";
        // line 516
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["City Center", "Beachfront", "Mountain View", "Countryside"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 517
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefLocations", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefLocations"]) || array_key_exists("prefLocations", $context) ? $context["prefLocations"] : (function () { throw new RuntimeError('Variable "prefLocations" does not exist.', 517, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 519
        yield "            </div>

            <div class=\"pref-section-title\">Accommodation Types</div>
            <div class=\"pref-chip-grid\" data-group=\"accommodation_types\" data-multi=\"true\">
              ";
        // line 523
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Hotel", "Resort", "Villa", "Hostel", "Vacation Rental", "Camping", "Cabin", "Boat/Yacht"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 524
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefAccommodation", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefAccommodation"]) || array_key_exists("prefAccommodation", $context) ? $context["prefAccommodation"] : (function () { throw new RuntimeError('Variable "prefAccommodation" does not exist.', 524, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 526
        yield "            </div>

            <div class=\"pref-section-title\">Style Preferences (Max 5)</div>
            <div class=\"pref-chip-grid\" data-group=\"style_preferences\" data-multi=\"true\" data-max=\"5\">
              ";
        // line 530
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Minimalist", "Urban", "Luxury", "Bohemian", "Rustic", "Traditional", "Tropical", "Mediterranean", "Vintage", "Classic"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 531
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefStyles", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefStyles"]) || array_key_exists("prefStyles", $context) ? $context["prefStyles"] : (function () { throw new RuntimeError('Variable "prefStyles" does not exist.', 531, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 533
        yield "            </div>

            <div class=\"pref-section-title\">Dietary Restrictions</div>
            <div class=\"pref-chip-grid\" data-group=\"dietary_restrictions\" data-multi=\"true\">
              ";
        // line 537
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["None", "Vegetarian", "Vegan", "Gluten-Free", "Dairy-Free", "Halal", "Nut Allergies", "Seafood Allergies", "Raw Food", "Sugar-Free", "Low-Sodium"]);
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 538
            yield "              <div class=\"pref-chip ";
            yield ((CoreExtension::inFilter($context["opt"], ((array_key_exists("prefDietary", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["prefDietary"]) || array_key_exists("prefDietary", $context) ? $context["prefDietary"] : (function () { throw new RuntimeError('Variable "prefDietary" does not exist.', 538, $this->source); })()), [])) : ([])))) ? ("selected") : (""));
            yield "\" data-val=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["opt"], "html", null, true);
            yield "</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['opt'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 540
        yield "            </div>
            
            <div class=\"pref-section-title\">Accessibility</div>
            <div class=\"pref-chip-grid\">
              <div id=\"profAccToggle\" class=\"pref-chip ";
        // line 544
        yield ((((isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 544, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 544, $this->source); })()), "accessibilityNeeds", [], "any", false, false, false, 544))) ? ("selected") : (""));
        yield "\" style=\"width:100%; max-width: 300px; padding: 14px; text-align:center; font-weight:600\">
                ♿ I require accessibility features
              </div>
            </div>

            <div style=\"margin-top:32px;display:flex;gap:12px; border-top: 1px solid var(--border-color); padding-top: 20px;\">
              <button class=\"btn btn-primary ripple-btn\" type=\"button\" id=\"savePreferencesBtn\">Save Preferences</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Your Activity / Travel DNA -->
      <section id=\"activity\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Your Activity</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:8px\">Travel <span class=\"text-teal\">DNA</span></h2>
        <p class=\"reveal\" style=\"color:var(--text-muted);font-size:0.88rem;margin-bottom:28px\">Built from your real browsing behaviour, clicks & preferences on TripX</p>

        ";
        // line 563
        yield "        <div class=\"dna-persona-card reveal\">
          <div class=\"dna-persona-emoji\">
            ";
        // line 565
        $context["personaEmoji"] = ["AI-Powered Explorer" => "🤖", "Luxury Wanderer" => "💎", "Budget Backpacker" => "🎒", "Beach Seeker" => "🏖️", "Mountain Soul" => "🏔️", "Slow Travel Connoisseur" => "☕", "Adrenaline Chaser" => "⚡", "Family Adventure Planner" => "👨‍👩‍👧", "Solo Pathfinder" => "🧭", "Romantic Voyager" => "💑", "Cultural Wanderer" => "🏛️", "Culinary Nomad" => "🍜", "Research-Driven Planner" => "📊", "Global Nomad" => "🌍", "Free Spirit" => "🌈"];
        // line 582
        yield "            ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["personaEmoji"] ?? null), (isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 582, $this->source); })()), [], "array", true, true, false, 582)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["personaEmoji"]) || array_key_exists("personaEmoji", $context) ? $context["personaEmoji"] : (function () { throw new RuntimeError('Variable "personaEmoji" does not exist.', 582, $this->source); })()), (isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 582, $this->source); })()), [], "array", false, false, false, 582), "🌍")) : ("🌍")), "html", null, true);
        yield "
          </div>
          <div>
            <div class=\"dna-persona-label\">Your Travel Persona</div>
            <div class=\"dna-persona-name\">";
        // line 586
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 586, $this->source); })()), "html", null, true);
        yield "</div>
            <div class=\"dna-persona-desc\">
              Derived from ";
        // line 588
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 588, $this->source); })()), "html", null, true);
        yield " page visits · ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalMinutes"]) || array_key_exists("totalMinutes", $context) ? $context["totalMinutes"] : (function () { throw new RuntimeError('Variable "totalMinutes" does not exist.', 588, $this->source); })()), "html", null, true);
        yield "min on platform · ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 588, $this->source); })()), "html", null, true);
        yield " AI interactions
            </div>
          </div>
          <div style=\"margin-left:auto; text-align:center\">
            <div class=\"engagement-ring\">
              <svg width=\"90\" height=\"90\" viewBox=\"0 0 90 90\">
                <circle cx=\"45\" cy=\"45\" r=\"38\" fill=\"none\" stroke=\"rgba(255,255,255,0.06)\" stroke-width=\"8\"/>
                <circle id=\"engagement-arc\" cx=\"45\" cy=\"45\" r=\"38\" fill=\"none\"
                  stroke=\"url(#dnaGrad)\" stroke-width=\"8\"
                  stroke-linecap=\"round\"
                  stroke-dasharray=\"239\"
                  stroke-dashoffset=\"239\"
                  style=\"transition:stroke-dashoffset 1.4s cubic-bezier(0.22,1,0.36,1)\"/>
                <defs>
                  <linearGradient id=\"dnaGrad\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"0%\">
                    <stop offset=\"0%\" stop-color=\"#ff4d6d\"/>
                    <stop offset=\"100%\" stop-color=\"#00a6ed\"/>
                  </linearGradient>
                </defs>
              </svg>
              <div class=\"engagement-ring-inner\">
                <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\" id=\"eng-score-num\">0</div>
                <div style=\"font-size:9px;color:var(--text-muted);text-transform:uppercase\">Score</div>
              </div>
            </div>
            <div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted);margin-top:4px\">Engagement</div>
          </div>
        </div>

        ";
        // line 618
        yield "        <div class=\"dna-funfact reveal\">
          💡 <strong>Fun Fact:</strong>
          ";
        // line 620
        if (((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 620, $this->source); })()) > 3)) {
            // line 621
            yield "            You use ARIA ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 621, $this->source); })()), "html", null, true);
            yield "× — you're in the top AI users on TripX! 🤖
          ";
        } elseif ((        // line 622
(isset($context["totalMinutes"]) || array_key_exists("totalMinutes", $context) ? $context["totalMinutes"] : (function () { throw new RuntimeError('Variable "totalMinutes" does not exist.', 622, $this->source); })()) > 30)) {
            // line 623
            yield "            You've spent <strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalMinutes"]) || array_key_exists("totalMinutes", $context) ? $context["totalMinutes"] : (function () { throw new RuntimeError('Variable "totalMinutes" does not exist.', 623, $this->source); })()), "html", null, true);
            yield " min</strong> exploring TripX. That's serious wanderlust.
          ";
        } elseif ((        // line 624
(isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 624, $this->source); })()) > 10)) {
            // line 625
            yield "            You've visited <strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 625, $this->source); })()), "html", null, true);
            yield " pages</strong> — you clearly love to browse before you book.
          ";
        } else {
            // line 627
            yield "            Keep exploring! Your Travel DNA grows richer with every click & search.
          ";
        }
        // line 629
        yield "        </div>

        ";
        // line 632
        yield "        <div class=\"grid-3 reveal\" style=\"gap:16px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">⏱ Time on Platform</div>
            <div class=\"dna-stat-num\" id=\"stat-time\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">minutes tracked</div>
          </div>
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">📄 Pages Visited</div>
            <div class=\"dna-stat-num\" id=\"stat-visits\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">unique page views</div>
          </div>
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">✦ AI Chats</div>
            <div class=\"dna-stat-num\" id=\"stat-ai\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">ARIA interactions</div>
          </div>
        </div>

        ";
        // line 651
        yield "        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">

          ";
        // line 654
        yield "          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Activity Breakdown</h4>
              <div class=\"chart-legend\">
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#00a6ed\"></span>Home</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#ff4d6d\"></span>Destinations</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#00c896\"></span>Activities</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#f59e0b\"></span>Offers</span>
              </div>
            </div>
            <div style=\"position:relative;width:200px;height:200px;margin:0 auto\">
              <canvas id=\"dna-donut\"></canvas>
              <div style=\"position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center\">
                <div style=\"font-family:var(--font-display);font-size:26px\">";
        // line 667
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageVisits", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 667, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</div>
                <div style=\"font-size:9px;color:var(--text-muted);text-transform:uppercase\">page visits</div>
              </div>
            </div>
          </div>

          ";
        // line 674
        yield "          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>When You Browse</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">by hour of day</span>
            </div>
            <canvas id=\"dna-hourly\" height=\"200\"></canvas>
          </div>
        </div>

        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Top Destinations Clicked</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">most explored</span>
            </div>
            <canvas id=\"dna-destinations\" height=\"210\"></canvas>
          </div>

          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Travel Style Radar</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">pace · climate · group</span>
            </div>
            <canvas id=\"dna-radar\" height=\"210\"></canvas>
          </div>
        </div>

        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>AI Usage Meter</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">";
        // line 705
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 705, $this->source); })()), "html", null, true);
        yield " interactions</span>
            </div>
            ";
        // line 707
        $context["aiPctRaw"] = ((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 707, $this->source); })()) * 10);
        // line 708
        yield "            ";
        $context["aiPct"] = ((((isset($context["aiPctRaw"]) || array_key_exists("aiPctRaw", $context) ? $context["aiPctRaw"] : (function () { throw new RuntimeError('Variable "aiPctRaw" does not exist.', 708, $this->source); })()) > 100)) ? (100) : ((isset($context["aiPctRaw"]) || array_key_exists("aiPctRaw", $context) ? $context["aiPctRaw"] : (function () { throw new RuntimeError('Variable "aiPctRaw" does not exist.', 708, $this->source); })())));
        // line 709
        yield "            <div style=\"height:10px;background:rgba(255,255,255,0.08);border-radius:99px;overflow:hidden;margin:8px 0 10px\">
              <div id=\"ai-meter-fill\" style=\"height:100%;width:0%;background:linear-gradient(90deg,#7209b7,#00a6ed);transition:width 1.2s cubic-bezier(0.22,1,0.36,1)\" data-target=\"";
        // line 710
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiPct"]) || array_key_exists("aiPct", $context) ? $context["aiPct"] : (function () { throw new RuntimeError('Variable "aiPct" does not exist.', 710, $this->source); })()), "html", null, true);
        yield "\"></div>
            </div>
            <div style=\"display:flex;justify-content:space-between;font-size:11px;color:var(--text-muted)\">
              <span>Occasional</span><span id=\"ai-meter-pct\">";
        // line 713
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiPct"]) || array_key_exists("aiPct", $context) ? $context["aiPct"] : (function () { throw new RuntimeError('Variable "aiPct" does not exist.', 713, $this->source); })()), "html", null, true);
        yield "%</span><span>Power user</span>
            </div>
          </div>

          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Top Pages Visited</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">top 5 sections</span>
            </div>
            <div style=\"display:flex;flex-direction:column;gap:10px\">
              ";
        // line 723
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["topPages"]) || array_key_exists("topPages", $context) ? $context["topPages"] : (function () { throw new RuntimeError('Variable "topPages" does not exist.', 723, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["page"] => $context["count"]) {
            // line 724
            yield "                ";
            $context["safePage"] = ((true) ? (Twig\Extension\CoreExtension::default($context["page"], "Unknown")) : ("Unknown"));
            // line 725
            yield "                ";
            $context["pagePct"] = ((((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 725, $this->source); })()) > 0)) ? (Twig\Extension\CoreExtension::round((($context["count"] / (isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 725, $this->source); })())) * 100))) : (0));
            // line 726
            yield "                <div class=\"dna-bar-row\" style=\"margin-bottom:0\">
                  <div class=\"dna-bar-label\" style=\"min-width:110px\">";
            // line 727
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["safePage"]) || array_key_exists("safePage", $context) ? $context["safePage"] : (function () { throw new RuntimeError('Variable "safePage" does not exist.', 727, $this->source); })()), 0, 16), "html", null, true);
            yield "</div>
                  <div class=\"dna-bar-track\"><div class=\"dna-bar-fill\" style=\"width:";
            // line 728
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pagePct"]) || array_key_exists("pagePct", $context) ? $context["pagePct"] : (function () { throw new RuntimeError('Variable "pagePct" does not exist.', 728, $this->source); })()), "html", null, true);
            yield "%;background:#00c896\"></div></div>
                  <div class=\"dna-bar-pct\">";
            // line 729
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
            yield "</div>
                </div>
              ";
            $context['_iterated'] = true;
        }
        // line 731
        if (!$context['_iterated']) {
            // line 732
            yield "                <div style=\"color:var(--text-muted);font-size:0.84rem\">No page history yet.</div>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['page'], $context['count'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 734
        yield "            </div>
          </div>
        </div>

        ";
        // line 739
        yield "        <div class=\"dna-card reveal\" style=\"padding:28px;margin-bottom:28px\">
          <h4 style=\"font-family:var(--font-display);font-size:15px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:20px\">Behavioural DNA Report</h4>
          ";
        // line 741
        $context["totalActions"] = ((((((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "VISIT", [], "any", true, true, false, 741)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 741, $this->source); })()), "VISIT", [], "any", false, false, false, 741), 0)) : (0)) + ((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "SEARCH", [], "any", true, true, false, 741)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 741, $this->source); })()), "SEARCH", [], "any", false, false, false, 741), 0)) : (0))) + ((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "BOOKING", [], "any", true, true, false, 741)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 741, $this->source); })()), "BOOKING", [], "any", false, false, false, 741), 0)) : (0))) + ((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "AI_FEATURE", [], "any", true, true, false, 741)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 741, $this->source); })()), "AI_FEATURE", [], "any", false, false, false, 741), 0)) : (0))) + ((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "NAV", [], "any", true, true, false, 741)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 741, $this->source); })()), "NAV", [], "any", false, false, false, 741), 0)) : (0)));
        // line 742
        yield "          ";
        $context["totalActions"] = ((((isset($context["totalActions"]) || array_key_exists("totalActions", $context) ? $context["totalActions"] : (function () { throw new RuntimeError('Variable "totalActions" does not exist.', 742, $this->source); })()) > 0)) ? ((isset($context["totalActions"]) || array_key_exists("totalActions", $context) ? $context["totalActions"] : (function () { throw new RuntimeError('Variable "totalActions" does not exist.', 742, $this->source); })())) : (1));
        // line 743
        yield "
          ";
        // line 744
        $context["bars"] = [["label" => "📍 Page Visits", "val" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 745
($context["activityStats"] ?? null), "VISIT", [], "any", true, true, false, 745)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 745, $this->source); })()), "VISIT", [], "any", false, false, false, 745), 0)) : (0)), "color" => "#00a6ed"], ["label" => "🔍 Searches", "val" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 746
($context["activityStats"] ?? null), "SEARCH", [], "any", true, true, false, 746)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 746, $this->source); })()), "SEARCH", [], "any", false, false, false, 746), 0)) : (0)), "color" => "#ff4d6d"], ["label" => "🏨 Bookings", "val" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 747
($context["activityStats"] ?? null), "BOOKING", [], "any", true, true, false, 747)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 747, $this->source); })()), "BOOKING", [], "any", false, false, false, 747), 0)) : (0)), "color" => "#00c896"], ["label" => "✦ AI Chats", "val" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 748
($context["activityStats"] ?? null), "AI_FEATURE", [], "any", true, true, false, 748)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 748, $this->source); })()), "AI_FEATURE", [], "any", false, false, false, 748), 0)) : (0)), "color" => "#7209b7"], ["label" => "🧭 Navigation", "val" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 749
($context["activityStats"] ?? null), "NAV", [], "any", true, true, false, 749)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 749, $this->source); })()), "NAV", [], "any", false, false, false, 749), 0)) : (0)), "color" => "#f59e0b"]];
        // line 751
        yield "
          ";
        // line 752
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["bars"]) || array_key_exists("bars", $context) ? $context["bars"] : (function () { throw new RuntimeError('Variable "bars" does not exist.', 752, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["bar"]) {
            // line 753
            yield "          ";
            $context["pct"] = Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, $context["bar"], "val", [], "any", false, false, false, 753) / (isset($context["totalActions"]) || array_key_exists("totalActions", $context) ? $context["totalActions"] : (function () { throw new RuntimeError('Variable "totalActions" does not exist.', 753, $this->source); })())) * 100));
            // line 754
            yield "          <div class=\"dna-bar-row\">
            <div class=\"dna-bar-label\">";
            // line 755
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["bar"], "label", [], "any", false, false, false, 755), "html", null, true);
            yield "</div>
            <div class=\"dna-bar-track\">
              <div class=\"dna-bar-fill dna-bar-animated\" style=\"background:";
            // line 757
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["bar"], "color", [], "any", false, false, false, 757), "html", null, true);
            yield ";width:0%\" data-target=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 757, $this->source); })()), "html", null, true);
            yield "\"></div>
            </div>
            <div class=\"dna-bar-pct\">";
            // line 759
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 759, $this->source); })()), "html", null, true);
            yield "%</div>
          </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['bar'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 762
        yield "        </div>

        ";
        // line 765
        yield "        <div class=\"dna-card reveal\" style=\"padding:24px\">
          <h4 style=\"font-family:var(--font-display);font-size:15px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:16px\">Recent Searches</h4>
          <div style=\"display:flex;flex-direction:column;gap:8px\">
          ";
        // line 768
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentSearches"]) || array_key_exists("recentSearches", $context) ? $context["recentSearches"] : (function () { throw new RuntimeError('Variable "recentSearches" does not exist.', 768, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["search"]) {
            // line 769
            yield "            <div style=\"display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:rgba(255,255,255,0.025);border-radius:8px;border:1px solid transparent;transition:border-color 0.2s\" onmouseover=\"this.style.borderColor='var(--border-color)'\" onmouseout=\"this.style.borderColor='transparent'\">
              <div style=\"display:flex;gap:12px;align-items:center\">
                <span class=\"badge badge-coral\" style=\"font-size:9px;min-width:72px;text-align:center\">SEARCH</span>
                <span style=\"font-size:0.85rem;opacity:0.8\">";
            // line 772
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["search"], "query", [], "any", true, true, false, 772)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["search"], "query", [], "any", false, false, false, 772), "—")) : ("—")), "html", null, true);
            yield "</span>
              </div>
              <div style=\"font-family:var(--font-mono);font-size:0.75rem;opacity:0.45;white-space:nowrap\">";
            // line 774
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["search"], "timestampLabel", [], "any", false, false, false, 774), "html", null, true);
            yield "</div>
            </div>
          ";
            $context['_iterated'] = true;
        }
        // line 776
        if (!$context['_iterated']) {
            // line 777
            yield "            <div style=\"color:var(--text-muted);font-size:0.85rem;padding:16px\">No recent searches yet — use the home search bar to start. 🌍</div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['search'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 779
        yield "          </div>
        </div>
      </section>

      <!-- Trip History Timeline -->
      <section id=\"history\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Trip Timeline</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-coral\">Adventures</span></h2>
        <div class=\"timeline-scroll reveal\">
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#003049,#d62828);display:flex;align-items:center;justify-content:center;font-size:56px\">🌊</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">JAN 2025</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Bali</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">14 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-teal\">Beach</span><span class=\"badge badge-coral\">Cultural</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#0a1628,#1e3c72);display:flex;align-items:center;justify-content:center;font-size:56px\">🌸</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">OCT 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Kyoto</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">10 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-indigo\">Cultural</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#185a37,#f9a825);display:flex;align-items:center;justify-content:center;font-size:56px\">🦁</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">JUL 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Serengeti</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">8 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-gold\">Adventure</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#3d1c6b,#c9184a);display:flex;align-items:center;justify-content:center;font-size:56px\">🗼</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">APR 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Paris</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">6 days · ⭐ 4/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-coral\">Romantic</span></div>
            </div>
          </div>
        </div>
      </section>

      <!-- AI Picks -->
      <section id=\"recos\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>AI Recommendations</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">ARIA's <span class=\"gradient-text\">Picks for You</span></h2>
        <div style=\"display:flex;flex-direction:column;gap:14px\" class=\"stagger\">
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🏔️</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Faroe Islands, Denmark</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Because you loved Iceland's raw landscapes & solitude</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">93% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🍜</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Hanoi, Vietnam</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Your street food obsession + cultural depth = perfect match</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">91% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🏛️</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Athens, Greece</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Based on history and culture scores in your Travel DNA</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">88% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Achievements -->
      <section id=\"achievements\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Gamification</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-gold\">Achievements</span></h2>
        <div class=\"grid-2 stagger\" style=\"gap:14px\">
          <div class=\"achievement\"><div class=\"achievement-icon\">🌍</div><div><div style=\"font-weight:600;margin-bottom:4px\">World Explorer</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visited 30+ countries</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement\"><div class=\"achievement-icon\">🍜</div><div><div style=\"font-weight:600;margin-bottom:4px\">Culinary Nomad</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Tried local food in 20 countries</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement\"><div class=\"achievement-icon\">⛺</div><div><div style=\"font-weight:600;margin-bottom:4px\">Trailblazer</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">5 off-beaten-path destinations</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">🚀</div><div><div style=\"font-weight:600;margin-bottom:4px\">Supernova</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visit all 7 continents</div></div><span class=\"badge badge-muted\">6/7</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">💎</div><div><div style=\"font-weight:600;margin-bottom:4px\">Diamond Traveller</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">50+ trips completed</div></div><span class=\"badge badge-muted\">23/50</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">🌊</div><div><div style=\"font-weight:600;margin-bottom:4px\">Island Hopper</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visit 10 island destinations</div></div><span class=\"badge badge-muted\">7/10</span></div>
        </div>
      </section>

      <!-- Loyalty -->
      <section id=\"loyalty\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Rewards</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Loyalty <span class=\"text-gold\">Points</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div style=\"display:flex;justify-content:space-between;align-items:center;margin-bottom:28px\">
              <div>
                <div style=\"font-family:var(--font-mono);font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em\">Your Balance</div>
                <div style=\"font-family:var(--font-display);font-size:56px;color:var(--accent-gold);line-height:1\">8,420</div>
                <div style=\"font-size:0.85rem;color:var(--text-muted)\">Explorer Tier · 1,580 pts to Gold</div>
              </div>
              <div style=\"text-align:right\">
                <span class=\"badge badge-gold\" style=\"font-size:14px;padding:8px 20px\">EXPLORER</span>
                <div style=\"font-size:0.8rem;color:var(--text-muted);margin-top:8px\">Next: Gold Tier 🥇</div>
              </div>
            </div>
            <div class=\"loyalty-track\">
              <div class=\"loyalty-fill\" style=\"width:84%\"></div>
              <div class=\"loyalty-glow\" style=\"right:16%\"></div>
            </div>
            <div style=\"display:flex;justify-content:space-between;font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-top:8px\">
              <span>Explorer (0)</span><span>Gold (10,000)</span><span>Diamond (25,000)</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Security -->
      <section id=\"security\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Security</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Account <span class=\"text-coral\">Security</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div style=\"display:flex;flex-direction:column;gap:16px\">
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Password</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Secure your account</div></div>
                <button class=\"btn btn-secondary btn-sm\" id=\"togglePasswordBtn\">Change</button>
              </div>
              <div id=\"password-change-section\" style=\"display:none; padding:16px; border-radius:var(--border-radius-md); border:1px solid var(--border-color); background:var(--bg-surface)\">
                <h3 style=\"margin-bottom:16px; font-family:var(--font-display)\">Change Password</h3>
                <div class=\"grid-2\" style=\"gap:20px\">
                  <div class=\"input-group\"><div class=\"input-label\">New Password</div><input class=\"input\" type=\"password\" id=\"new_password\"></div>
                  <div class=\"input-group\"><div class=\"input-label\">Confirm New Password</div><input class=\"input\" type=\"password\" id=\"confirm_password\"></div>
                </div>
                <button class=\"btn btn-primary ripple-btn\" style=\"margin-top:16px\" id=\"confirmPasswordBtn\">Update Password</button>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Two-Factor Authentication</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Enabled via Authenticator App ✓</div></div>
                <span class=\"badge badge-teal\">Active</span>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:var(--bg-surface);border-radius:var(--border-radius-md);border:1px solid var(--border-color)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">AI Data Training</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Control what ARIA learns from your behavior</div></div>
                <button class=\"btn btn-secondary btn-sm\">Manage Privacy</button>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(255,77,109,0.08);border-radius:var(--border-radius-md);border:1px solid rgba(255,77,109,0.35)\">
                <div><div style=\"font-weight:600;margin-bottom:4px;color:#ff4d6d\">Delete Account</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Permanently disable your account access</div></div>
                <button class=\"btn btn-secondary btn-sm\" id=\"deleteAccountBtn\" style=\"border-color:#ff4d6d;color:#ff4d6d\">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</div>

<div class=\"toast\" id=\"profileToast\" style=\"display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:#0b1f4d; color:#fff; padding:12px 24px; border-radius:50px; z-index:9999; font-weight:500; font-size:0.9rem; box-shadow:0 10px 30px rgba(0,0,0,0.35); transition:opacity 0.3s; opacity:0;\">
    <span id=\"toastMsg\"></span>
</div>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"";
        // line 958
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">🤖</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">🤖</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Personalized for ";
        // line 967
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 967, $this->source); })()), "firstName", [], "any", false, false, false, 967), "html", null, true);
        yield "</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);background:none;border:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hey ";
        // line 971
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 971, $this->source); })()), "firstName", [], "any", false, false, false, 971), "html", null, true);
        yield "! 👋 I know you well — you're a <strong>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["travelPersona"]) || array_key_exists("travelPersona", $context) ? $context["travelPersona"] : (function () { throw new RuntimeError('Variable "travelPersona" does not exist.', 971, $this->source); })()), "html", null, true);
        yield "</strong>. Want a destination curated just for you? Or ask me anything about travel! ✨</div></div>
  </div>
  <div class=\"aria-img-preview\" id=\"aria-img-preview\">
    <img id=\"aria-preview-img\" src=\"\" alt=\"preview\">
    <button class=\"remove-img\" id=\"aria-remove-img\" title=\"Remove image\">✕</button>
  </div>
  <div class=\"aria-input-row\">
    <button class=\"aria-attach-btn\" id=\"aria-attach-btn\" title=\"Attach image\">📎</button>
    <button class=\"aria-voice-btn\" id=\"aria-voice-btn\" title=\"Voice search\">🎤</button>
    <button class=\"aria-stop-voice-btn\" id=\"aria-stop-voice-btn\" title=\"Stop voice\">⏹</button>
    <input type=\"file\" id=\"aria-file-input\" accept=\"image/*\" style=\"display:none\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA anything...\">
    <button class=\"aria-send\" id=\"aria-send\" data-track=\"AI_ARIA_CHAT\" data-track-type=\"AI_FEATURE\">➤</button>
  </div>
</div>
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  window.__ariaChatInitialized = true;

  // ════════════════════════════════════════════
  // PASSWORD TOGGLE
  // ════════════════════════════════════════════
  const toggleBtn = document.getElementById('togglePasswordBtn');
  const pwdSection = document.getElementById('password-change-section');
  if (toggleBtn && pwdSection) {
    toggleBtn.addEventListener('click', () => {
      const isHidden = pwdSection.style.display === 'none';
      pwdSection.style.display = isHidden ? 'block' : 'none';
      if (isHidden) pwdSection.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // ════════════════════════════════════════════
  // SAVE PROFILE (Upgraded for Wavy Inputs)
  // ════════════════════════════════════════════
  document.getElementById('saveProfileBtn')?.addEventListener('click', () => {
    const btn = document.getElementById('saveProfileBtn');
    const origText = btn.innerText;
    
    const data = {
      firstName: document.getElementById('profile_first_name')?.value || '',
      lastName:  document.getElementById('profile_last_name')?.value || '',
      email:     document.getElementById('profile_email')?.value || '',
      phone:     document.getElementById('profile_phone')?.value || '',
      bio:       document.getElementById('profile_bio')?.value || ''
    };

    // Phone Validation
    const phoneRegex = /^[+]?[(]?[0-9]{3}[)]?[-\\s.]?[0-9]{3}[-\\s.]?[0-9]{4,6}\$/;
    if (data.phone && !phoneRegex.test(data.phone.replace(/\\s/g, ''))) {
      showToast('⚠️ Please enter a valid phone number', true);
      return;
    }

    btn.innerText = 'Saving...';
    fetch('/profile/update', { 
      method:'POST', 
      headers:{'Content-Type':'application/json'}, 
      body:JSON.stringify(data) 
    })
    .then(r=>r.json())
    .then(res => {
      btn.innerText = origText;
      showToast(res.success ? '✅ Profile updated successfully!' : '❌ ' + (res.error || 'Update failed.'));
      if (res.success) setTimeout(() => window.location.reload(), 1000);
    });
  });

  // Old collectTravelPrefs and savePreferencesBtn removed to avoid duplication with the new chip-based logic below

  document.getElementById('confirmPasswordBtn')?.addEventListener('click', () => {
    const p1 = document.getElementById('new_password').value;
    const p2 = document.getElementById('confirm_password').value;
    if (!p1 || p1 !== p2) { showToast('⚠️ Passwords do not match.'); return; }
    fetch('/profile/password', { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({password:p1}) })
      .then(r=>r.json()).then(res => {
        if (res.success) {
          showToast('✅ Password updated!');
          pwdSection.style.display = 'none';
          document.getElementById('new_password').value = '';
          document.getElementById('confirm_password').value = '';
        } else { showToast('❌ Error updating password.'); }
      });
  });

  document.getElementById('deleteAccountBtn')?.addEventListener('click', () => {
    if (!confirm('Delete your account? This action cannot be undone.')) return;
    fetch('/profile/delete', { method:'POST', headers:{'Content-Type':'application/json'}, body:'{}' })
      .then(r=>r.json())
      .then(res => {
        if (res.success) {
          showToast('✅ Account deleted.');
          setTimeout(() => { window.location.href = '/logout'; }, 600);
        } else {
          showToast('❌ Could not delete account.');
        }
      })
      .catch(() => showToast('❌ Could not delete account.'));
  });

  function showToast(msg, isError = false) {
    const t = document.getElementById('profileToast');
    const m = document.getElementById('toastMsg');
    if (!t || !m) return;
    
    m.textContent = msg;
    t.style.background = isError ? '#ef4444' : '#0b1f4d'; // Red for error, dark navy for success
    t.style.display = 'block';
    t.style.opacity = '0';
    
    setTimeout(() => { t.style.opacity = '1'; }, 50);
    
    if (window.toastTimeout) clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(() => {
      t.style.opacity = '0';
      setTimeout(() => { t.style.display = 'none'; }, 300);
    }, 4000);
  }

  // ════════════════════════════════════════════
  // TRAVEL DNA — ANIMATED COUNTERS
  // ════════════════════════════════════════════
  function animateCounter(elId, target) {
    const el = document.getElementById(elId);
    if (!el) return;
    let start = 0;
    const step = Math.ceil(target / 40) || 1;
    const t = setInterval(() => {
      start = Math.min(start + step, target);
      el.textContent = start;
      if (start >= target) clearInterval(t);
    }, 30);
  }
  animateCounter('stat-time',   ";
        // line 1105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((array_key_exists("totalMinutes", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["totalMinutes"]) || array_key_exists("totalMinutes", $context) ? $context["totalMinutes"] : (function () { throw new RuntimeError('Variable "totalMinutes" does not exist.', 1105, $this->source); })()), 0)) : (0))), "html", null, true);
        yield ");
  animateCounter('stat-visits', ";
        // line 1106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageVisits", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 1106, $this->source); })()), 0)) : (0)), "html", null, true);
        yield ");
  animateCounter('stat-ai',     ";
        // line 1107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("aiInteractions", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 1107, $this->source); })()), 0)) : (0)), "html", null, true);
        yield ");
  animateCounter('eng-score-num', ";
        // line 1108
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("engagementScore", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["engagementScore"]) || array_key_exists("engagementScore", $context) ? $context["engagementScore"] : (function () { throw new RuntimeError('Variable "engagementScore" does not exist.', 1108, $this->source); })()), 0)) : (0)), "html", null, true);
        yield ");

  // Engagement ring arc
  const arc = document.getElementById('engagement-arc');
  if (arc) {
    const score = ";
        // line 1113
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("engagementScore", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["engagementScore"]) || array_key_exists("engagementScore", $context) ? $context["engagementScore"] : (function () { throw new RuntimeError('Variable "engagementScore" does not exist.', 1113, $this->source); })()), 0)) : (0)), "html", null, true);
        yield ";
    const circ  = 239;
    setTimeout(() => { arc.style.strokeDashoffset = circ - (circ * score / 100); }, 200);
  }

  // ── DNA Bar animations
  document.querySelectorAll('.dna-bar-animated').forEach(bar => {
    const target = bar.dataset.target || 0;
    setTimeout(() => { bar.style.width = target + '%'; }, 300);
  });

  // ════════════════════════════════════════════
  // CHART.JS — ACTIVITY DONUT
  // ════════════════════════════════════════════
  const donutCtx = document.getElementById('dna-donut')?.getContext('2d');
  if (donutCtx) {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Home', 'Destinations', 'Activities', 'Offers', 'Other'],
        datasets: [{
          data: [
            ";
        // line 1135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["pageBreakdown"] ?? null), "Home", [], "any", true, true, false, 1135)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pageBreakdown"]) || array_key_exists("pageBreakdown", $context) ? $context["pageBreakdown"] : (function () { throw new RuntimeError('Variable "pageBreakdown" does not exist.', 1135, $this->source); })()), "Home", [], "any", false, false, false, 1135), 0)) : (0)), "html", null, true);
        yield ",
            ";
        // line 1136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["pageBreakdown"] ?? null), "Destinations", [], "any", true, true, false, 1136)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pageBreakdown"]) || array_key_exists("pageBreakdown", $context) ? $context["pageBreakdown"] : (function () { throw new RuntimeError('Variable "pageBreakdown" does not exist.', 1136, $this->source); })()), "Destinations", [], "any", false, false, false, 1136), 0)) : (0)), "html", null, true);
        yield ",
            ";
        // line 1137
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["pageBreakdown"] ?? null), "Activities", [], "any", true, true, false, 1137)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pageBreakdown"]) || array_key_exists("pageBreakdown", $context) ? $context["pageBreakdown"] : (function () { throw new RuntimeError('Variable "pageBreakdown" does not exist.', 1137, $this->source); })()), "Activities", [], "any", false, false, false, 1137), 0)) : (0)), "html", null, true);
        yield ",
            ";
        // line 1138
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["pageBreakdown"] ?? null), "Offers", [], "any", true, true, false, 1138)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pageBreakdown"]) || array_key_exists("pageBreakdown", $context) ? $context["pageBreakdown"] : (function () { throw new RuntimeError('Variable "pageBreakdown" does not exist.', 1138, $this->source); })()), "Offers", [], "any", false, false, false, 1138), 0)) : (0)), "html", null, true);
        yield ",
            ";
        // line 1139
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["pageBreakdown"] ?? null), "Other", [], "any", true, true, false, 1139)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pageBreakdown"]) || array_key_exists("pageBreakdown", $context) ? $context["pageBreakdown"] : (function () { throw new RuntimeError('Variable "pageBreakdown" does not exist.', 1139, $this->source); })()), "Other", [], "any", false, false, false, 1139), 0)) : (0)), "html", null, true);
        yield "
          ],
          backgroundColor: ['#00a6ed','#ff4d6d','#00c896','#f59e0b','#6b7280'],
          borderWidth: 0,
          hoverOffset: 12
        }]
      },
      options: {
        responsive: true,
        cutout: '72%',
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: (ctx) => {
                const total = ctx.dataset.data.reduce((a, b) => a + b, 0) || 1;
                const pct = Math.round((ctx.parsed / total) * 100);
                return ` \${ctx.label}: \${ctx.parsed} (\${pct}%)`;
              }
            }
          }
        },
        animation: { animateRotate: true, duration: 1200 }
      }
    });
  }

  // ════════════════════════════════════════════
  // CHART.JS — HOURLY ACTIVITY BAR
  // ════════════════════════════════════════════
  const hourCtx = document.getElementById('dna-hourly')?.getContext('2d');
  if (hourCtx) {
    const hourlyData = ";
        // line 1171
        yield json_encode((isset($context["hourlyActivity"]) || array_key_exists("hourlyActivity", $context) ? $context["hourlyActivity"] : (function () { throw new RuntimeError('Variable "hourlyActivity" does not exist.', 1171, $this->source); })()));
        yield ";
    const labels = Array.from({length:24},(_,i)=> i===0?'12am': i<12?`\${i}am`: i===12?'12pm':`\${i-12}pm`);
    new Chart(hourCtx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          data: hourlyData,
          backgroundColor: hourlyData.map((v,i) => {
            const hour = i;
            if (hour >= 6 && hour < 12)  return 'rgba(255,183,3,0.75)';  // morning gold
            if (hour >= 12 && hour < 18) return 'rgba(0,166,237,0.75)';  // afternoon blue
            if (hour >= 18 && hour < 22) return 'rgba(255,77,109,0.75)'; // evening coral
            return 'rgba(114,9,183,0.6)'; // night purple
          }),
          borderRadius: 4,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { callbacks: { title: (c) => `\${c[0].label}`, label: (c) => ` \${c.parsed.y} actions` } } },
        scales: {
          x: { ticks: { font: { size: 8 }, color: '#6b7280', maxRotation: 45 }, grid: { display: false } },
          y: { ticks: { font: { size: 9 }, color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.04)' } }
        },
        animation: { duration: 1000 }
      }
    });
  }

  const destCtx = document.getElementById('dna-destinations')?.getContext('2d');
  if (destCtx) {
    const destinationData = ";
        // line 1204
        yield json_encode(((array_key_exists("destinationClicks", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["destinationClicks"]) || array_key_exists("destinationClicks", $context) ? $context["destinationClicks"] : (function () { throw new RuntimeError('Variable "destinationClicks" does not exist.', 1204, $this->source); })()), [])) : ([])));
        yield ";
    const labels = Object.keys(destinationData);
    const values = Object.values(destinationData);

    new Chart(destCtx, {
      type: 'bar',
      data: {
        labels: labels.length ? labels : ['No destination data'],
        datasets: [{
          data: values.length ? values : [0],
          backgroundColor: 'rgba(255, 77, 109, 0.75)',
          borderRadius: 6
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.04)' } },
          y: { ticks: { color: '#6b7280', font: { size: 10 } }, grid: { display: false } }
        }
      }
    });
  }

  const radarCtx = document.getElementById('dna-radar')?.getContext('2d');
  if (radarCtx) {
    const pace = '";
        // line 1232
        yield ((((isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1232, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1232, $this->source); })()), "travelPace", [], "any", false, false, false, 1232))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1232, $this->source); })()), "travelPace", [], "any", false, false, false, 1232)), "html", null, true)) : (""));
        yield "';
    const climate = '";
        // line 1233
        yield ((((isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1233, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1233, $this->source); })()), "preferredClimate", [], "any", false, false, false, 1233))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1233, $this->source); })()), "preferredClimate", [], "any", false, false, false, 1233)), "html", null, true)) : (""));
        yield "';
    const groupType = '";
        // line 1234
        yield ((((isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1234, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1234, $this->source); })()), "groupType", [], "any", false, false, false, 1234))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 1234, $this->source); })()), "groupType", [], "any", false, false, false, 1234)), "html", null, true)) : (""));
        yield "';

    const radarData = [
      pace === 'fast' ? 90 : (pace === 'slow' ? 45 : 65),
      (climate.includes('tropical') || climate.includes('beach')) ? 85 : 55,
      groupType.includes('solo') ? 90 : (groupType.includes('family') ? 75 : 60),
      ";
        // line 1240
        yield (((((array_key_exists("aiInteractions", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 1240, $this->source); })()), 0)) : (0)) > 0)) ? ((((((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 1240, $this->source); })()) * 10) > 100)) ? (100) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((isset($context["aiInteractions"]) || array_key_exists("aiInteractions", $context) ? $context["aiInteractions"] : (function () { throw new RuntimeError('Variable "aiInteractions" does not exist.', 1240, $this->source); })()) * 10), "html", null, true)))) : (35));
        yield ",
      ";
        // line 1241
        yield (((((array_key_exists("pageVisits", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 1241, $this->source); })()), 0)) : (0)) > 0)) ? ((((((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 1241, $this->source); })()) * 4) > 100)) ? (100) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 1241, $this->source); })()) * 4), "html", null, true)))) : (40));
        yield "
    ];

    new Chart(radarCtx, {
      type: 'radar',
      data: {
        labels: ['Pace', 'Climate Match', 'Group Fit', 'AI Affinity', 'Explorer Depth'],
        datasets: [{
          label: 'Travel DNA',
          data: radarData,
          borderColor: '#00a6ed',
          backgroundColor: 'rgba(0,166,237,0.2)',
          pointBackgroundColor: '#ff4d6d'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          r: {
            suggestedMin: 0,
            suggestedMax: 100,
            angleLines: { color: 'rgba(255,255,255,0.08)' },
            grid: { color: 'rgba(255,255,255,0.08)' },
            pointLabels: { color: '#9ca3af', font: { size: 10 } },
            ticks: { display: false }
          }
        }
      }
    });
  }

  const aiMeter = document.getElementById('ai-meter-fill');
  if (aiMeter) {
    const target = parseInt(aiMeter.dataset.target || '0', 10);
    setTimeout(() => { aiMeter.style.width = target + '%'; }, 250);
  }

  // ════════════════════════════════════════════
  // ARIA CHAT — FULLY WORKING
  // ════════════════════════════════════════════
  const orbBtn     = document.getElementById('aria-orb');
  const panel      = document.getElementById('aria-panel');
  const closeBtn   = document.getElementById('aria-close');
  const msgBox     = document.getElementById('aria-messages');
  const inputEl    = document.getElementById('aria-input');
  const sendBtn    = document.getElementById('aria-send');
  const attachBtn  = document.getElementById('aria-attach-btn');
  const voiceBtn   = document.getElementById('aria-voice-btn');
  const stopVoiceBtn = document.getElementById('aria-stop-voice-btn');
  const fileInput  = document.getElementById('aria-file-input');
  const imgPreview = document.getElementById('aria-img-preview');
  const previewImg = document.getElementById('aria-preview-img');
  const removeImg  = document.getElementById('aria-remove-img');

  let selectedImageBase64 = null;
  let selectedImageMimeType = null;
  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  const speechRecognition = SpeechRecognition ? new SpeechRecognition() : null;
  if (speechRecognition) {
    speechRecognition.lang = 'en-US';
    speechRecognition.interimResults = false;
    speechRecognition.maxAlternatives = 1;
  }

  // Open / close panel
  orbBtn?.addEventListener('click', () => panel?.classList.toggle('open'));
  closeBtn?.addEventListener('click', () => panel?.classList.remove('open'));

  // Image attach
  attachBtn?.addEventListener('click', () => fileInput?.click());

  fileInput?.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;
    if (!file.type.startsWith('image/')) {
      appendBubble('bot', 'Please attach a valid image file.');
      return;
    }
    if (file.size > 5 * 1024 * 1024) {
      appendBubble('bot', 'Image too large. Please use a file smaller than 5MB.');
      return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
      const dataUrl = e.target.result;
      // strip prefix: data:image/jpeg;base64,
      selectedImageBase64 = dataUrl.split(',')[1];
      selectedImageMimeType = file.type;
      previewImg.src = dataUrl;
      imgPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });

  removeImg?.addEventListener('click', () => {
    selectedImageBase64 = null;
    selectedImageMimeType = null;
    fileInput.value = '';
    imgPreview.style.display = 'none';
    previewImg.src = '';
  });

  voiceBtn?.addEventListener('click', () => {
    if (!speechRecognition) {
      appendBubble('bot', 'Voice search is not supported in this browser.');
      return;
    }
    voiceBtn.classList.add('active');
    speechRecognition.start();
  });

  speechRecognition?.addEventListener('result', (event) => {
    const transcript = event.results?.[0]?.[0]?.transcript || '';
    if (!transcript.trim()) return;
    inputEl.value = transcript;
    sendMessage();
  });

  speechRecognition?.addEventListener('end', () => {
    voiceBtn?.classList.remove('active');
  });
  stopVoiceBtn?.addEventListener('click', () => {
    if ('speechSynthesis' in window) window.speechSynthesis.cancel();
  });

  // Send message
  function sendMessage() {
    const text = (inputEl?.value || '').trim();
    if (!text && !selectedImageBase64) return;

    // Append user bubble
    appendBubble('user', text, selectedImageBase64 ? previewImg.src : null);

    // Clear inputs
    inputEl.value = '';
    const imgB64 = selectedImageBase64;
    const imgMimeType = selectedImageMimeType;
    selectedImageBase64 = null;
    selectedImageMimeType = null;
    fileInput.value = '';
    imgPreview.style.display = 'none';
    previewImg.src = '';

    // Typing indicator
    const typingEl = document.createElement('div');
    typingEl.className = 'aria-msg bot';
    typingEl.innerHTML = '<div class=\"aria-bubble aria-typing-bubble\" aria-live=\"polite\"><span class=\"aria-ellipsis\">...</span></div>';
    msgBox.appendChild(typingEl);
    scrollMsgs();

    // API call
    fetch('/api/chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
      body: JSON.stringify({ message: text, image: imgB64, imageMimeType: imgMimeType })
    })
    .then(function (r) {
      return r.text().then(function (txt) {
        var data = {};
        try {
          data = txt ? JSON.parse(txt) : {};
        } catch (e) {
          typingEl.remove();
          appendBubble('bot', '⚠️ Server error (HTTP ' + r.status + '). If you are logged in, try refreshing the page.');
          return null;
        }
        return { ok: r.ok, status: r.status, data: data };
      });
    })
    .then(function (result) {
      if (!result) return;
      typingEl.remove();
      var data = result.data;
      if (data.response) {
        appendBubble('bot', data.response);
        speakText(data.response);
      } else if (data.error) {
        appendBubble('bot', '⚠️ ' + data.error);
      } else {
        appendBubble('bot', '⚠️ Unexpected response (HTTP ' + result.status + ').');
      }
    })
    .catch(function () {
      typingEl.remove();
      appendBubble('bot', '⚠️ Network error. Check your connection and try again.');
    });
  }

  function appendBubble(role, text, imgSrc) {
    const wrap = document.createElement('div');
    wrap.className = 'aria-msg ' + role;
    if (imgSrc) {
      const img = document.createElement('img');
      img.src = imgSrc;
      img.style.maxWidth = '120px';
      img.style.borderRadius = '8px';
      img.style.marginBottom = '6px';
      img.style.display = 'block';
      wrap.appendChild(img);
    }
    if (text) {
      const bubble = document.createElement('div');
      bubble.className = 'aria-bubble';
      bubble.textContent = text;
      wrap.appendChild(bubble);
    }
    msgBox.appendChild(wrap);
    scrollMsgs();
  }

  function scrollMsgs() {
    if (msgBox) msgBox.scrollTop = msgBox.scrollHeight;
  }

  function speakText(text) {
    if (window.TRIPX_ARIA && typeof window.TRIPX_ARIA.speak === 'function') {
      window.TRIPX_ARIA.speak(text);
    }
  }

  sendBtn?.addEventListener('click', sendMessage);
  inputEl?.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
  });

  // Prevent input from clearing on focus (ensure value is preserved)
  inputEl?.addEventListener('focus', (e) => e.stopPropagation());

  // Initial scroll
  scrollMsgs();

  // ════════════════════════════════════════════
  // TRAVEL PREFERENCES CHIPS
  // ════════════════════════════════════════════
  const prefChips = document.querySelectorAll('#prefManagerRoot .pref-chip');
  prefChips.forEach(chip => {
    chip.addEventListener('click', function() {
      // Toggle for AccToggle isolated
      if (this.id === 'profAccToggle') {
        this.classList.toggle('selected');
        return;
      }
      const group = this.closest('.pref-chip-grid')?.dataset.group;
      if (!group) return;
      const isMulti = this.closest('.pref-chip-grid').dataset.multi === 'true';
      const max = this.closest('.pref-chip-grid').dataset.max ? parseInt(this.closest('.pref-chip-grid').dataset.max) : 99;

      if (isMulti) {
        if (!this.classList.contains('selected')) {
          const currentlySelected = this.closest('.pref-chip-grid').querySelectorAll('.pref-chip.selected').length;
          if (currentlySelected >= max) {
            showToast(`You can only select up to \${max} options.`, true);
            return;
          }
        }
        this.classList.toggle('selected');
      } else {
        const siblings = this.closest('.pref-chip-grid').querySelectorAll('.pref-chip');
        siblings.forEach(s => s.classList.remove('selected'));
        this.classList.add('selected');
      }
    });
  });

  const profMinB = document.getElementById('profMinBudget');
  const profMaxB = document.getElementById('profMaxBudget');
  if (profMinB && profMaxB) {
    profMinB.addEventListener('input', () => {
      if (parseInt(profMinB.value) > parseInt(profMaxB.value)) profMinB.value = profMaxB.value;
      document.getElementById('profMinBudgetDisplay').innerText = '\$' + profMinB.value;
    });
    profMaxB.addEventListener('input', () => {
      if (parseInt(profMaxB.value) < parseInt(profMinB.value)) profMaxB.value = profMinB.value;
      document.getElementById('profMaxBudgetDisplay').innerText = '\$' + profMaxB.value;
    });
  }

  document.getElementById('savePreferencesBtn')?.addEventListener('click', () => {
    const origText = document.getElementById('savePreferencesBtn').innerText;
    document.getElementById('savePreferencesBtn').innerText = 'Saving...';
    
    // Gather prefs
    const prefsPayload = {
      budget_min_per_night: profMinB ? parseInt(profMinB.value) : null,
      budget_max_per_night: profMaxB ? parseInt(profMaxB.value) : null,
      accessibility_needs: document.getElementById('profAccToggle')?.classList.contains('selected') || false
    };

    const extractGroup = (groupName) => {
      const grid = document.querySelector(`.pref-chip-grid[data-group=\"\${groupName}\"]`);
      if (!grid) return [];
      const selected = Array.from(grid.querySelectorAll('.pref-chip.selected')).map(c => c.dataset.val);
      return grid.dataset.multi === 'true' ? selected : (selected[0] || '');
    };

    prefsPayload.travel_pace = extractGroup('travel_pace');
    prefsPayload.group_type = extractGroup('group_type');
    prefsPayload.priorities = extractGroup('priorities');
    prefsPayload.preferred_climate = extractGroup('preferred_climate');
    prefsPayload.location_preferences = extractGroup('location_preferences');
    prefsPayload.accommodation_types = extractGroup('accommodation_types');
    prefsPayload.style_preferences = extractGroup('style_preferences');
    prefsPayload.dietary_restrictions = extractGroup('dietary_restrictions');

    fetch('/profile/preferences', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(prefsPayload)
    })
    .then(r => r.json())
    .then(data => {
      document.getElementById('savePreferencesBtn').innerText = origText;
      if (data.success) {
        showToast('✈️ Travel preferences saved successfully!');
        setTimeout(() => window.location.reload(), 1500);
      } else {
        showToast('⚠️ Error: ' + (data.error || 'Check fields.'), true);
      }
    })
    .catch(() => {
      document.getElementById('savePreferencesBtn').innerText = origText;
      showToast('⚠️ Connection error', true);
    });
  });

});
</script>
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
        return "front/users.html.twig";
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
        return array (  1875 => 1241,  1871 => 1240,  1862 => 1234,  1858 => 1233,  1854 => 1232,  1823 => 1204,  1787 => 1171,  1752 => 1139,  1748 => 1138,  1744 => 1137,  1740 => 1136,  1736 => 1135,  1711 => 1113,  1703 => 1108,  1699 => 1107,  1695 => 1106,  1691 => 1105,  1552 => 971,  1545 => 967,  1533 => 958,  1352 => 779,  1345 => 777,  1343 => 776,  1336 => 774,  1331 => 772,  1326 => 769,  1321 => 768,  1316 => 765,  1312 => 762,  1303 => 759,  1296 => 757,  1291 => 755,  1288 => 754,  1285 => 753,  1281 => 752,  1278 => 751,  1276 => 749,  1275 => 748,  1274 => 747,  1273 => 746,  1272 => 745,  1271 => 744,  1268 => 743,  1265 => 742,  1263 => 741,  1259 => 739,  1253 => 734,  1246 => 732,  1244 => 731,  1237 => 729,  1233 => 728,  1229 => 727,  1226 => 726,  1223 => 725,  1220 => 724,  1215 => 723,  1202 => 713,  1196 => 710,  1193 => 709,  1190 => 708,  1188 => 707,  1183 => 705,  1150 => 674,  1141 => 667,  1126 => 654,  1122 => 651,  1102 => 632,  1098 => 629,  1094 => 627,  1088 => 625,  1086 => 624,  1081 => 623,  1079 => 622,  1074 => 621,  1072 => 620,  1068 => 618,  1032 => 588,  1027 => 586,  1019 => 582,  1017 => 565,  1013 => 563,  992 => 544,  986 => 540,  973 => 538,  969 => 537,  963 => 533,  950 => 531,  946 => 530,  940 => 526,  927 => 524,  923 => 523,  917 => 519,  904 => 517,  900 => 516,  894 => 512,  881 => 510,  877 => 509,  871 => 505,  858 => 503,  854 => 502,  844 => 495,  840 => 494,  836 => 493,  832 => 492,  827 => 491,  825 => 490,  815 => 483,  811 => 482,  806 => 481,  804 => 480,  793 => 472,  788 => 470,  781 => 466,  776 => 464,  611 => 302,  604 => 298,  600 => 297,  593 => 292,  558 => 291,  556 => 290,  549 => 288,  543 => 284,  508 => 283,  506 => 282,  499 => 280,  494 => 277,  459 => 276,  457 => 275,  450 => 273,  445 => 270,  410 => 269,  408 => 268,  401 => 266,  371 => 239,  367 => 238,  363 => 237,  359 => 235,  340 => 233,  322 => 232,  320 => 231,  313 => 229,  307 => 228,  303 => 227,  287 => 214,  283 => 213,  273 => 206,  269 => 205,  265 => 204,  261 => 203,  257 => 202,  253 => 201,  249 => 200,  244 => 198,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"description\" content=\"Your TripX profile — Travel DNA, trip history, AI recommendations, and achievements.\">
  <title>My Profile — TripX</title>
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Montserrat:wght@100..900&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    .profile-layout { display: grid; grid-template-columns: 300px 1fr; gap: 32px; padding-top: calc(var(--nav-height) + 40px); }
    /* Sidebar */
    .profile-sidebar { position: sticky; top: calc(var(--nav-height) + 20px); align-self: start; max-height: calc(100vh - var(--nav-height) - 40px); overflow-y: auto; padding-right: 6px; }
    .profile-sidebar::-webkit-scrollbar { width: 4px; }
    .profile-sidebar::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .profile-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      padding: 32px;
      text-align: center;
      margin-bottom: 20px;
    }
    .profile-avatar {
      width: 96px; height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-gold));
      margin: 0 auto 16px;
      display: flex; align-items: center; justify-content: center;
      font-size: 40px; color: #fff; font-family: var(--font-body); font-weight: 700;
      box-shadow: 0 0 40px rgba(255,77,109,0.35);
    }
    .profile-name { font-family: var(--font-display); font-size: 28px; text-transform: uppercase; margin-bottom: 4px; }
    .profile-handle { font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); letter-spacing: 0.1em; margin-bottom: 16px; }
    .profile-badge-row { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; }

    /* Sidebar nav */
    .sidebar-nav {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      overflow: hidden;
    }
    .sidebar-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 16px 20px;
      font-size: 0.9rem;
      color: var(--text-secondary);
      border-bottom: 1px solid var(--border-color);
      transition: all var(--transition-fast);
    }
    .sidebar-nav-item:last-child { border-bottom: none; }
    .sidebar-nav-item:hover, .sidebar-nav-item.active {
      background: rgba(255,77,109,0.06);
      color: var(--accent-primary);
    }
    .sidebar-nav-item.active { font-weight: 600; }
    .sidebar-nav-icon { font-size: 18px; }

    /* Achievement badges */
    .achievement {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px;
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-md);
      transition: all var(--transition-fast);
    }
    .achievement:hover { border-color: var(--accent-gold); }
    .achievement-icon {
      width: 48px; height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-gold), #FF6B00);
      display: flex; align-items: center; justify-content: center;
      font-size: 22px;
      box-shadow: 0 0 20px rgba(255,183,3,0.3);
    }
    .achievement.locked { opacity: 0.45; filter: grayscale(1); }
    .achievement.locked .achievement-icon { background: var(--border-color); }

    /* Recommendation feed */
    .reco-card {
      display: flex; gap: 16px; align-items: center;
      padding: 16px; background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-md);
      transition: all var(--transition-fast);
    }
    .reco-card:hover { border-color: var(--accent-teal); }
    .reco-thumb {
      width: 72px; height: 72px;
      border-radius: var(--border-radius-sm);
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-teal));
      display: flex; align-items: center; justify-content: center;
      font-size: 30px;
      flex-shrink: 0;
    }

    /* === TRAVEL DNA REDESIGN === */
    .dna-card {
      padding: 24px;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border-color);
      border-radius: var(--border-radius-lg);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 140px;
      overflow: hidden;
      word-break: break-word;
      transition: border-color 0.2s, transform 0.2s;
    }
    .dna-card:hover { border-color: var(--accent-teal); transform: translateY(-2px); }
    .dna-stat-num {
      font-family: var(--font-display);
      font-size: 2.4rem;
      line-height: 1;
      background: linear-gradient(135deg, var(--accent-primary), var(--accent-teal));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .dna-persona-card {
      background: linear-gradient(135deg, rgba(255,77,109,0.12), rgba(0,166,237,0.12));
      border: 1px solid rgba(255,77,109,0.3);
      border-radius: var(--border-radius-lg);
      padding: 28px 32px;
      display: flex;
      align-items: center;
      gap: 24px;
      margin-bottom: 28px;
    }
    .dna-persona-emoji { font-size: 52px; }
    .dna-persona-label { font-family: var(--font-mono); font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 6px; }
    .dna-persona-name { font-family: var(--font-display); font-size: 28px; text-transform: uppercase; color: var(--accent-primary); }
    .dna-persona-desc { font-size: 0.85rem; color: var(--text-muted); margin-top: 6px; }
    .dna-funfact {
      background: linear-gradient(90deg, rgba(0,200,150,0.08), rgba(0,166,237,0.08));
      border-left: 3px solid var(--accent-teal);
      border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0;
      padding: 14px 18px;
      font-size: 0.85rem;
      color: var(--text-secondary);
      margin-bottom: 28px;
    }
    .dna-funfact strong { color: var(--accent-teal); }
    .chart-label-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .chart-label-row h4 { font-family: var(--font-display); font-size: 15px; text-transform: uppercase; letter-spacing: 0.04em; }
    .chart-legend { display: flex; gap: 14px; flex-wrap: wrap; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; }
    .legend-item { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); display: flex; align-items: center; }
    .dna-bar-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .dna-bar-label { font-size: 0.78rem; color: var(--text-muted); min-width: 90px; }
    .dna-bar-track { flex: 1; height: 8px; background: rgba(255,255,255,0.06); border-radius: 99px; overflow: hidden; }
    .dna-bar-fill { height: 100%; border-radius: 99px; transition: width 1.2s cubic-bezier(0.22,1,0.36,1); }
    .dna-bar-pct { font-family: var(--font-mono); font-size: 10px; color: var(--text-muted); min-width: 36px; text-align: right; }
    .engagement-ring { position: relative; display: inline-flex; align-items: center; justify-content: center; }
    .engagement-ring svg { transform: rotate(-90deg); }
    .engagement-ring-inner { position: absolute; text-align: center; }
    /* === ARIA CHAT REDESIGN === */
    .aria-panel { width: 400px; max-height: min(560px, calc(100vh - 160px)); display: flex; flex-direction: column; background: linear-gradient(160deg, rgba(5,16,42,0.95), rgba(9,28,68,0.92)); border: 1px solid rgba(0,166,237,0.35); }
    .aria-header { flex-shrink: 0; padding: 12px 14px; }
    .aria-messages { flex: 1 1 auto; min-height: 0; overflow-y: auto; padding: 12px 14px; display: flex; flex-direction: column; gap: 10px; }
    .aria-input-row { display: flex; align-items: center; gap: 8px; padding: 12px 16px; border-top: 1px solid var(--border-color); flex-shrink: 0; }
    .aria-input { flex: 1; min-width: 0; font-size: 0.78rem; color: #e2e8f0; }
    .aria-attach-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 10px; cursor: pointer; color: var(--text-muted); font-size: 16px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-attach-btn:hover { border-color: var(--accent-teal); color: var(--accent-teal); }
    .aria-img-preview { margin: 8px 16px 0; position: relative; display: none; }
    .aria-img-preview img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); }
    .aria-img-preview .remove-img { position: absolute; top: -6px; left: 70px; background: var(--accent-primary); color: #fff; border: none; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .pref-check-row { display: flex; flex-wrap: wrap; gap: 10px 18px; margin-top: 8px; }
    .pref-check-row label { display: inline-flex; align-items: center; gap: 6px; font-size: 0.84rem; cursor: pointer; color: var(--text-secondary); }
    .aria-msg .aria-bubble { white-space: pre-line; }
    .aria-voice-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 10px; cursor: pointer; color: var(--text-muted); font-size: 14px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-voice-btn:hover, .aria-voice-btn.active { border-color: var(--accent-gold); color: var(--accent-gold); }
    .aria-stop-voice-btn { background: none; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 9px; cursor: pointer; color: var(--text-muted); font-size: 13px; transition: border-color 0.2s; flex-shrink: 0; }
    .aria-stop-voice-btn:hover { border-color: var(--accent-primary); color: var(--accent-primary); }
    .aria-msg .aria-bubble { font-size: 0.78rem; }
    .aria-msg.user .aria-bubble { background: #ffffff; color: #0f172a; }
    @media (max-width: 900px) {
      .profile-layout { grid-template-columns: 1fr; }
      .profile-sidebar { position: static; }
      .aria-panel { width: 92vw; max-width: 400px; }
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
      <a href=\"{{ path('transport') }}\"      class=\"nav-link\">Transport</a>
      <a href=\"{{ path('offers') }}\"         class=\"nav-link\">Offers</a>
      <a href=\"{{ path('blog') }}\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"{{ path('users') }}\" class=\"btn-nav-primary ripple-btn\">My Profile</a>
      <a href=\"{{ path('app_logout') }}\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
        <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
        <div class=\"text\">Logout</div>
      </a>
    </div>
  </div>
</nav>

<div class=\"container\">
  <div class=\"profile-layout\">
    <!-- Sidebar -->
    <aside class=\"profile-sidebar\">
      <div class=\"profile-card reveal\">
        <div class=\"profile-avatar\">{{ user.firstName|first|upper }}</div>
        <div class=\"profile-name\">{{ user.firstName }} {{ user.lastName }}</div>
        <div class=\"profile-handle\">@{{ profileHandle }} · {{ user.role|capitalize }} · TripX</div>
        <div class=\"profile-badge-row\">
          {% set badge_classes = ['badge-coral', 'badge-gold', 'badge-teal'] %}
          {% for badge in profileSidebarBadges|default([travelPersona]) %}
          <span class=\"badge {{ badge_classes[loop.index0 % 3] }}\" title=\"From your preferences &amp; activity\">{{ badge }}</span>
          {% endfor %}
        </div>
        <div style=\"display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;text-align:center\">
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">{{ profileStatBookings|default(0) }}</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Bookings</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">{{ profileStatDestinationsTapped|default(0) }}</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Dest. explored</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">{{ profileStatMinutes|default(0) }}</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Min on site</div></div>
        </div>
      </div>

      <div class=\"sidebar-nav reveal reveal-delay-1\">
        <a href=\"#personal\"   class=\"sidebar-nav-item active\" data-track=\"NAV_PERSONAL\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">👤</span> Personal Info</a>
        <a href=\"#preferences\" class=\"sidebar-nav-item\" data-track=\"NAV_PREFERENCES\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">✈️</span> Travel Preferences</a>
        <a href=\"#activity\"   class=\"sidebar-nav-item\" data-track=\"NAV_ACTIVITY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">📊</span> Your Activity</a>
        <a href=\"#history\"    class=\"sidebar-nav-item\" data-track=\"NAV_HISTORY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🗺️</span> Trip History</a>
        <a href=\"#recos\"      class=\"sidebar-nav-item\" data-track=\"NAV_RECOS\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">✦</span> AI Picks</a>
        <a href=\"#achievements\" class=\"sidebar-nav-item\" data-track=\"NAV_ACHIEVEMENTS\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🏆</span> Achievements</a>
        <a href=\"#loyalty\"    class=\"sidebar-nav-item\" data-track=\"NAV_LOYALTY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">💎</span> Loyalty Points</a>
        <a href=\"#security\"   class=\"sidebar-nav-item\" data-track=\"NAV_SECURITY\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">🔐</span> Security</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main style=\"padding-bottom:80px\">

      <!-- Personal Info -->
      <section id=\"personal\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Personal Info</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-coral\">Details</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div class=\"grid-2\" style=\"gap:30px\">
              <div class=\"wavy-control\">
                <input id=\"profile_first_name\" type=\"text\" value=\"{{ user.firstName }}\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"{{ user.firstName ? 'has-value' : '' }}\">
                <label>
                  {% set label = \"First Name\" %}
                  {% for letter in label|split('') %}<span style=\"transition-delay:{{ loop.index0 * 30 }}ms\">{{ letter }}</span>{% endfor %}
                </label>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_last_name\" type=\"text\" value=\"{{ user.lastName }}\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"{{ user.lastName ? 'has-value' : '' }}\">
                <label>
                  {% set label = \"Last Name\" %}
                  {% for letter in label|split('') %}<span style=\"transition-delay:{{ loop.index0 * 30 }}ms\">{{ letter }}</span>{% endfor %}
                </label>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_email\" type=\"email\" value=\"{{ user.email }}\" placeholder=\" \" required oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"{{ user.email ? 'has-value' : '' }}\">
                <label>
                  {% set label = \"Email\" %}
                  {% for letter in label|split('') %}<span style=\"transition-delay:{{ loop.index0 * 30 }}ms\">{{ letter }}</span>{% endfor %}
                </label>
                <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
              </div>
              <div class=\"wavy-control\">
                <input id=\"profile_phone\" type=\"tel\" value=\"{{ user.phoneNumber }}\" placeholder=\" \" oninput=\"this.classList.toggle('has-value', this.value!='')\" class=\"{{ user.phoneNumber ? 'has-value' : '' }}\">
                <label>
                  {% set label = \"Phone\" %}
                  {% for letter in label|split('') %}<span style=\"transition-delay:{{ loop.index0 * 30 }}ms\">{{ letter }}</span>{% endfor %}
                </label>
                <span class=\"field-icon\"><i class=\"fas fa-phone-alt\"></i></span>
              </div>
            </div>
            <div class=\"grid-2\" style=\"gap:20px; margin-top:10px\">
              <div class=\"input-group\"><div class=\"input-label\">Gender</div><input class=\"input\" type=\"text\" value=\"{{ user.gender|default('Not specified') }}\" disabled></div>
              <div class=\"input-group\"><div class=\"input-label\">Birth Year</div><input class=\"input\" type=\"text\" value=\"{{ user.birthYear }}\" disabled></div>
            </div>
            <div class=\"input-group\" style=\"margin-top:24px\">
              <div class=\"input-label\">Bio / Travel Style</div>
              <textarea id=\"profile_bio\" class=\"input\" rows=\"3\" style=\"resize:vertical; color:var(--text-primary)\" placeholder=\"Tell us about your travel style...\">{{ user.bio|default('') }}</textarea>
            </div>
            <div style=\"margin-top:28px;display:flex;gap:12px\">
              <button class=\"btn btn-primary ripple-btn\" id=\"saveProfileBtn\">Save Changes</button>
              <button class=\"btn btn-secondary\">Cancel</button>
            </div>

          </div>
        </div>
      </section>

      <!-- Travel preferences (userpreferences) -->
      <section id=\"preferences\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Travel Preferences</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-teal\">Travel Style</span></h2>
        
        <style>
          .pref-accordion-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(0,200,150,0.2);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          html[data-theme=\"light\"] .pref-accordion-card {
            background: rgba(255,255,255,0.6);
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
          }
          .pref-accordion-header {
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            user-select: none;
          }
          .pref-accordion-header h3 {
            margin: 0;
            font-family: var(--font-display);
            font-size: 1.2rem;
            color: var(--accent-primary);
          }
          .pref-arrow {
            font-size: 14px;
            color: var(--text-muted);
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          .pref-accordion-card.expanded .pref-arrow {
            transform: rotate(-180deg);
          }
          .pref-accordion-body {
            padding: 0 24px;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
          }
          .pref-accordion-card.expanded .pref-accordion-body {
            padding: 0 24px 24px;
            max-height: 2000px;
            opacity: 1;
          }
          
          /* Chip styles matching onboarding */
          .pref-chip-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
          }
          .pref-chip {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 0.85rem;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.2s ease;
            user-select: none;
          }
          html[data-theme=\"light\"] .pref-chip { background: #f8fafc; }
          .pref-chip:hover { border-color: var(--accent-teal); }
          .pref-chip.selected {
            background: var(--accent-teal);
            color: #1a1a1a !important; /* Darker visible text when selected */
            font-weight: 700;
            border-color: var(--accent-teal);
            box-shadow: 0 4px 12px rgba(0,200,150,0.3);
          }
          
          /* Wavy Control Style for Personal Info */
          .wavy-control {
            position: relative;
            margin: 20px 0 35px;
            width: 100%;
          }
          .wavy-control input {
            background-color: transparent !important;
            border: 0 !important;
            border-bottom: 2px #d1d5db solid !important;
            display: block;
            width: 100%;
            padding: 12px 0 !important;
            font-size: 16px;
            color: var(--text-primary);
            border-radius: 0 !important;
            transition: 0.3s ease;
          }
          .wavy-control input:focus, .wavy-control input.has-value {
            outline: 0;
            border-bottom-color: var(--accent-primary) !important;
          }
          .wavy-control label {
            position: absolute;
            top: 12px;
            left: 0;
            pointer-events: none;
            color: var(--text-muted);
          }
          .wavy-control label span {
            display: inline-block;
            font-size: 16px;
            min-width: 5px;
            transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
          }
          .wavy-control input:focus + label span,
          .wavy-control input.has-value + label span {
            color: var(--accent-primary);
            transform: translateY(-25px);
            font-size: 14px;
            font-weight: 600;
          }
          .wavy-control .field-icon {
            position: absolute;
            right: 0;
            top: 12px;
            color: var(--text-muted);
            transition: color 0.3s;
          }
          .wavy-control input:focus ~ .field-icon {
            color: var(--accent-primary);
          }
          
          .pref-section-title { font-weight: 700; font-size: 0.95rem; margin-top: 24px; margin-bottom: 4px; color: var(--text-primary); }
        </style>

        <div class=\"pref-accordion-card reveal\" id=\"prefAccordion\">
          <div class=\"pref-accordion-header\" onclick=\"document.getElementById('prefAccordion').classList.toggle('expanded')\">
            <h3>✈️ Manage Preferences</h3>
            <span class=\"pref-arrow\">▼</span>
          </div>
          
          <div class=\"pref-accordion-body\" id=\"prefManagerRoot\">
            <p style=\"color:var(--text-muted);font-size:0.88rem;margin-bottom:20px;margin-top: -10px;\">Update your travel parameters. These influence ARIA and destination matching.</p>
            
            <div class=\"pref-section-title\">Budget (Per Night)</div>
            <div style=\"max-width: 400px; display: flex; flex-direction: column; gap: 20px; margin-top: 14px;\">
              <div>
                <div style=\"display:flex; justify-content:space-between; font-weight:600; font-size:0.85rem; margin-bottom:6px;\">
                  <span>Min Budget</span><span id=\"profMinBudgetDisplay\">\${{ preferences ? preferences.budgetMinPerNight|default('50') : '50' }}</span>
                </div>
                <input type=\"range\" id=\"profMinBudget\" class=\"budget-slider\" min=\"0\" max=\"1000\" step=\"50\" value=\"{{ preferences ? preferences.budgetMinPerNight|default('50') : '50' }}\" style=\"width:100%\">
              </div>
              <div>
                <div style=\"display:flex; justify-content:space-between; font-weight:600; font-size:0.85rem; margin-bottom:6px;\">
                  <span>Max Budget</span><span id=\"profMaxBudgetDisplay\">\${{ preferences ? preferences.budgetMaxPerNight|default('500') : '500' }}</span>
                </div>
                <input type=\"range\" id=\"profMaxBudget\" class=\"budget-slider\" min=\"0\" max=\"2000\" step=\"100\" value=\"{{ preferences ? preferences.budgetMaxPerNight|default('500') : '500' }}\" style=\"width:100%\">
              </div>
            </div>

            <div class=\"grid-2\" style=\"gap:24px; margin-top: 24px;\">
              <div>
                <div class=\"pref-section-title\" style=\"margin-top:0\">Travel Pace</div>
                <div class=\"pref-chip-grid\" data-group=\"travel_pace\" data-multi=\"false\">
                  {% set ppace = preferences ? preferences.travelPace|default('') : '' %}
                  <div class=\"pref-chip {{ ppace == 'Relaxed' ? 'selected' : '' }}\" data-val=\"Relaxed\">🌅 Relaxed</div>
                  <div class=\"pref-chip {{ ppace == 'Moderate' ? 'selected' : '' }}\" data-val=\"Moderate\">🚶 Moderate</div>
                  <div class=\"pref-chip {{ ppace == 'Fast-paced' ? 'selected' : '' }}\" data-val=\"Fast-paced\">⚡ Fast-paced</div>
                </div>
              </div>
              
              <div>
                <div class=\"pref-section-title\" style=\"margin-top:0\">Who do you travel with?</div>
                <div class=\"pref-chip-grid\" data-group=\"group_type\" data-multi=\"false\">
                  {% set pgrp = preferences ? preferences.groupType|default('') : '' %}
                  <div class=\"pref-chip {{ pgrp == 'Solo' ? 'selected' : '' }}\" data-val=\"Solo\">🎒 Solo</div>
                  <div class=\"pref-chip {{ pgrp == 'Couple' ? 'selected' : '' }}\" data-val=\"Couple\">💑 Couple</div>
                  <div class=\"pref-chip {{ pgrp == 'Family' ? 'selected' : '' }}\" data-val=\"Family\">👨‍👩‍👧 Family</div>
                  <div class=\"pref-chip {{ pgrp == 'Friends' ? 'selected' : '' }}\" data-val=\"Friends\">👯 Friends</div>
                  <div class=\"pref-chip {{ pgrp == 'Business' ? 'selected' : '' }}\" data-val=\"Business\">💼 Business</div>
                </div>
              </div>
            </div>

            <div class=\"pref-section-title\">Priorities (Max 5)</div>
            <div class=\"pref-chip-grid\" data-group=\"priorities\" data-multi=\"true\" data-max=\"5\">
              {% for opt in ['Activities','Wellness','Food and Drinks','Family Friendly','Parking','Amenities','Pet-Friendly','Business Facilities','I dont care'] %}
              <div class=\"pref-chip {{ opt in prefPriorities|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>

            <div class=\"pref-section-title\">Preferred Climate</div>
            <div class=\"pref-chip-grid\" data-group=\"preferred_climate\" data-multi=\"true\">
              {% for opt in ['Temperate','Tropical','Desert','Cold/Arctic','Oceanic','Mountain'] %}
              <div class=\"pref-chip {{ opt in prefClimate|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>

            <div class=\"pref-section-title\">Location Preferences</div>
            <div class=\"pref-chip-grid\" data-group=\"location_preferences\" data-multi=\"true\">
              {% for opt in ['City Center','Beachfront','Mountain View','Countryside'] %}
              <div class=\"pref-chip {{ opt in prefLocations|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>

            <div class=\"pref-section-title\">Accommodation Types</div>
            <div class=\"pref-chip-grid\" data-group=\"accommodation_types\" data-multi=\"true\">
              {% for opt in ['Hotel','Resort','Villa','Hostel','Vacation Rental','Camping','Cabin','Boat/Yacht'] %}
              <div class=\"pref-chip {{ opt in prefAccommodation|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>

            <div class=\"pref-section-title\">Style Preferences (Max 5)</div>
            <div class=\"pref-chip-grid\" data-group=\"style_preferences\" data-multi=\"true\" data-max=\"5\">
              {% for opt in ['Minimalist','Urban','Luxury','Bohemian','Rustic','Traditional','Tropical','Mediterranean','Vintage','Classic'] %}
              <div class=\"pref-chip {{ opt in prefStyles|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>

            <div class=\"pref-section-title\">Dietary Restrictions</div>
            <div class=\"pref-chip-grid\" data-group=\"dietary_restrictions\" data-multi=\"true\">
              {% for opt in ['None','Vegetarian','Vegan','Gluten-Free','Dairy-Free','Halal','Nut Allergies','Seafood Allergies','Raw Food','Sugar-Free','Low-Sodium'] %}
              <div class=\"pref-chip {{ opt in prefDietary|default([]) ? 'selected' : '' }}\" data-val=\"{{ opt }}\">{{ opt }}</div>
              {% endfor %}
            </div>
            
            <div class=\"pref-section-title\">Accessibility</div>
            <div class=\"pref-chip-grid\">
              <div id=\"profAccToggle\" class=\"pref-chip {{ preferences and preferences.accessibilityNeeds ? 'selected' : '' }}\" style=\"width:100%; max-width: 300px; padding: 14px; text-align:center; font-weight:600\">
                ♿ I require accessibility features
              </div>
            </div>

            <div style=\"margin-top:32px;display:flex;gap:12px; border-top: 1px solid var(--border-color); padding-top: 20px;\">
              <button class=\"btn btn-primary ripple-btn\" type=\"button\" id=\"savePreferencesBtn\">Save Preferences</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Your Activity / Travel DNA -->
      <section id=\"activity\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Your Activity</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:8px\">Travel <span class=\"text-teal\">DNA</span></h2>
        <p class=\"reveal\" style=\"color:var(--text-muted);font-size:0.88rem;margin-bottom:28px\">Built from your real browsing behaviour, clicks & preferences on TripX</p>

        {# ── Persona Card ── #}
        <div class=\"dna-persona-card reveal\">
          <div class=\"dna-persona-emoji\">
            {% set personaEmoji = {
              'AI-Powered Explorer': '🤖',
              'Luxury Wanderer': '💎',
              'Budget Backpacker': '🎒',
              'Beach Seeker': '🏖️',
              'Mountain Soul': '🏔️',
              'Slow Travel Connoisseur': '☕',
              'Adrenaline Chaser': '⚡',
              'Family Adventure Planner': '👨‍👩‍👧',
              'Solo Pathfinder': '🧭',
              'Romantic Voyager': '💑',
              'Cultural Wanderer': '🏛️',
              'Culinary Nomad': '🍜',
              'Research-Driven Planner': '📊',
              'Global Nomad': '🌍',
              'Free Spirit': '🌈'
            } %}
            {{ personaEmoji[travelPersona]|default('🌍') }}
          </div>
          <div>
            <div class=\"dna-persona-label\">Your Travel Persona</div>
            <div class=\"dna-persona-name\">{{ travelPersona }}</div>
            <div class=\"dna-persona-desc\">
              Derived from {{ pageVisits }} page visits · {{ totalMinutes }}min on platform · {{ aiInteractions }} AI interactions
            </div>
          </div>
          <div style=\"margin-left:auto; text-align:center\">
            <div class=\"engagement-ring\">
              <svg width=\"90\" height=\"90\" viewBox=\"0 0 90 90\">
                <circle cx=\"45\" cy=\"45\" r=\"38\" fill=\"none\" stroke=\"rgba(255,255,255,0.06)\" stroke-width=\"8\"/>
                <circle id=\"engagement-arc\" cx=\"45\" cy=\"45\" r=\"38\" fill=\"none\"
                  stroke=\"url(#dnaGrad)\" stroke-width=\"8\"
                  stroke-linecap=\"round\"
                  stroke-dasharray=\"239\"
                  stroke-dashoffset=\"239\"
                  style=\"transition:stroke-dashoffset 1.4s cubic-bezier(0.22,1,0.36,1)\"/>
                <defs>
                  <linearGradient id=\"dnaGrad\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"0%\">
                    <stop offset=\"0%\" stop-color=\"#ff4d6d\"/>
                    <stop offset=\"100%\" stop-color=\"#00a6ed\"/>
                  </linearGradient>
                </defs>
              </svg>
              <div class=\"engagement-ring-inner\">
                <div style=\"font-family:var(--font-display);font-size:22px;color:var(--accent-primary)\" id=\"eng-score-num\">0</div>
                <div style=\"font-size:9px;color:var(--text-muted);text-transform:uppercase\">Score</div>
              </div>
            </div>
            <div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted);margin-top:4px\">Engagement</div>
          </div>
        </div>

        {# ── Fun Fact ── #}
        <div class=\"dna-funfact reveal\">
          💡 <strong>Fun Fact:</strong>
          {% if aiInteractions > 3 %}
            You use ARIA {{ aiInteractions }}× — you're in the top AI users on TripX! 🤖
          {% elseif totalMinutes > 30 %}
            You've spent <strong>{{ totalMinutes }} min</strong> exploring TripX. That's serious wanderlust.
          {% elseif pageVisits > 10 %}
            You've visited <strong>{{ pageVisits }} pages</strong> — you clearly love to browse before you book.
          {% else %}
            Keep exploring! Your Travel DNA grows richer with every click & search.
          {% endif %}
        </div>

        {# ── 3 Stat Cards ── #}
        <div class=\"grid-3 reveal\" style=\"gap:16px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">⏱ Time on Platform</div>
            <div class=\"dna-stat-num\" id=\"stat-time\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">minutes tracked</div>
          </div>
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">📄 Pages Visited</div>
            <div class=\"dna-stat-num\" id=\"stat-visits\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">unique page views</div>
          </div>
          <div class=\"dna-card\" style=\"text-align:center\">
            <div style=\"font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px\">✦ AI Chats</div>
            <div class=\"dna-stat-num\" id=\"stat-ai\">0</div>
            <div style=\"font-size:11px;color:var(--text-muted);margin-top:6px\">ARIA interactions</div>
          </div>
        </div>

        {# ── Charts Row ── #}
        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">

          {# Activity Breakdown Doughnut #}
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Activity Breakdown</h4>
              <div class=\"chart-legend\">
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#00a6ed\"></span>Home</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#ff4d6d\"></span>Destinations</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#00c896\"></span>Activities</span>
                <span class=\"legend-item\"><span class=\"legend-dot\" style=\"background:#f59e0b\"></span>Offers</span>
              </div>
            </div>
            <div style=\"position:relative;width:200px;height:200px;margin:0 auto\">
              <canvas id=\"dna-donut\"></canvas>
              <div style=\"position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center\">
                <div style=\"font-family:var(--font-display);font-size:26px\">{{ pageVisits|default(0) }}</div>
                <div style=\"font-size:9px;color:var(--text-muted);text-transform:uppercase\">page visits</div>
              </div>
            </div>
          </div>

          {# Hourly Activity Bar #}
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>When You Browse</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">by hour of day</span>
            </div>
            <canvas id=\"dna-hourly\" height=\"200\"></canvas>
          </div>
        </div>

        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Top Destinations Clicked</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">most explored</span>
            </div>
            <canvas id=\"dna-destinations\" height=\"210\"></canvas>
          </div>

          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Travel Style Radar</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">pace · climate · group</span>
            </div>
            <canvas id=\"dna-radar\" height=\"210\"></canvas>
          </div>
        </div>

        <div class=\"grid-2 reveal\" style=\"gap:24px;margin-bottom:28px\">
          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>AI Usage Meter</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">{{ aiInteractions }} interactions</span>
            </div>
            {% set aiPctRaw = aiInteractions * 10 %}
            {% set aiPct = aiPctRaw > 100 ? 100 : aiPctRaw %}
            <div style=\"height:10px;background:rgba(255,255,255,0.08);border-radius:99px;overflow:hidden;margin:8px 0 10px\">
              <div id=\"ai-meter-fill\" style=\"height:100%;width:0%;background:linear-gradient(90deg,#7209b7,#00a6ed);transition:width 1.2s cubic-bezier(0.22,1,0.36,1)\" data-target=\"{{ aiPct }}\"></div>
            </div>
            <div style=\"display:flex;justify-content:space-between;font-size:11px;color:var(--text-muted)\">
              <span>Occasional</span><span id=\"ai-meter-pct\">{{ aiPct }}%</span><span>Power user</span>
            </div>
          </div>

          <div class=\"dna-card\" style=\"padding:24px\">
            <div class=\"chart-label-row\">
              <h4>Top Pages Visited</h4>
              <span style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted)\">top 5 sections</span>
            </div>
            <div style=\"display:flex;flex-direction:column;gap:10px\">
              {% for page, count in topPages %}
                {% set safePage = page|default('Unknown') %}
                {% set pagePct = pageVisits > 0 ? ((count / pageVisits) * 100)|round : 0 %}
                <div class=\"dna-bar-row\" style=\"margin-bottom:0\">
                  <div class=\"dna-bar-label\" style=\"min-width:110px\">{{ safePage|slice(0, 16) }}</div>
                  <div class=\"dna-bar-track\"><div class=\"dna-bar-fill\" style=\"width:{{ pagePct }}%;background:#00c896\"></div></div>
                  <div class=\"dna-bar-pct\">{{ count }}</div>
                </div>
              {% else %}
                <div style=\"color:var(--text-muted);font-size:0.84rem\">No page history yet.</div>
              {% endfor %}
            </div>
          </div>
        </div>

        {# ── Behavioral DNA Bars ── #}
        <div class=\"dna-card reveal\" style=\"padding:28px;margin-bottom:28px\">
          <h4 style=\"font-family:var(--font-display);font-size:15px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:20px\">Behavioural DNA Report</h4>
          {% set totalActions = activityStats.VISIT|default(0) + activityStats.SEARCH|default(0) + activityStats.BOOKING|default(0) + activityStats.AI_FEATURE|default(0) + activityStats.NAV|default(0) %}
          {% set totalActions = totalActions > 0 ? totalActions : 1 %}

          {% set bars = [
            { label: '📍 Page Visits', val: activityStats.VISIT|default(0), color: '#00a6ed' },
            { label: '🔍 Searches', val: activityStats.SEARCH|default(0), color: '#ff4d6d' },
            { label: '🏨 Bookings', val: activityStats.BOOKING|default(0), color: '#00c896' },
            { label: '✦ AI Chats', val: activityStats.AI_FEATURE|default(0), color: '#7209b7' },
            { label: '🧭 Navigation', val: activityStats.NAV|default(0), color: '#f59e0b' }
          ] %}

          {% for bar in bars %}
          {% set pct = ((bar.val / totalActions) * 100)|round %}
          <div class=\"dna-bar-row\">
            <div class=\"dna-bar-label\">{{ bar.label }}</div>
            <div class=\"dna-bar-track\">
              <div class=\"dna-bar-fill dna-bar-animated\" style=\"background:{{ bar.color }};width:0%\" data-target=\"{{ pct }}\"></div>
            </div>
            <div class=\"dna-bar-pct\">{{ pct }}%</div>
          </div>
          {% endfor %}
        </div>

        {# ── Recent Searches (last 10) ── #}
        <div class=\"dna-card reveal\" style=\"padding:24px\">
          <h4 style=\"font-family:var(--font-display);font-size:15px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:16px\">Recent Searches</h4>
          <div style=\"display:flex;flex-direction:column;gap:8px\">
          {% for search in recentSearches %}
            <div style=\"display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:rgba(255,255,255,0.025);border-radius:8px;border:1px solid transparent;transition:border-color 0.2s\" onmouseover=\"this.style.borderColor='var(--border-color)'\" onmouseout=\"this.style.borderColor='transparent'\">
              <div style=\"display:flex;gap:12px;align-items:center\">
                <span class=\"badge badge-coral\" style=\"font-size:9px;min-width:72px;text-align:center\">SEARCH</span>
                <span style=\"font-size:0.85rem;opacity:0.8\">{{ search.query|default('—') }}</span>
              </div>
              <div style=\"font-family:var(--font-mono);font-size:0.75rem;opacity:0.45;white-space:nowrap\">{{ search.timestampLabel }}</div>
            </div>
          {% else %}
            <div style=\"color:var(--text-muted);font-size:0.85rem;padding:16px\">No recent searches yet — use the home search bar to start. 🌍</div>
          {% endfor %}
          </div>
        </div>
      </section>

      <!-- Trip History Timeline -->
      <section id=\"history\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Trip Timeline</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-coral\">Adventures</span></h2>
        <div class=\"timeline-scroll reveal\">
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#003049,#d62828);display:flex;align-items:center;justify-content:center;font-size:56px\">🌊</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">JAN 2025</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Bali</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">14 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-teal\">Beach</span><span class=\"badge badge-coral\">Cultural</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#0a1628,#1e3c72);display:flex;align-items:center;justify-content:center;font-size:56px\">🌸</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">OCT 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Kyoto</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">10 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-indigo\">Cultural</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#185a37,#f9a825);display:flex;align-items:center;justify-content:center;font-size:56px\">🦁</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">JUL 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Serengeti</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">8 days · ⭐ 5/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-gold\">Adventure</span></div>
            </div>
          </div>
          <div class=\"timeline-card\">
            <div class=\"timeline-card-img\" style=\"background:linear-gradient(135deg,#3d1c6b,#c9184a);display:flex;align-items:center;justify-content:center;font-size:56px\">🗼</div>
            <div class=\"timeline-card-body\">
              <div style=\"font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-bottom:6px\">APR 2024</div>
              <div style=\"font-family:var(--font-display);font-size:22px;text-transform:uppercase;margin-bottom:6px\">Paris</div>
              <div style=\"font-size:0.8rem;color:var(--text-muted)\">6 days · ⭐ 4/5 rated</div>
              <div style=\"display:flex;gap:6px;margin-top:10px\"><span class=\"badge badge-coral\">Romantic</span></div>
            </div>
          </div>
        </div>
      </section>

      <!-- AI Picks -->
      <section id=\"recos\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>AI Recommendations</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">ARIA's <span class=\"gradient-text\">Picks for You</span></h2>
        <div style=\"display:flex;flex-direction:column;gap:14px\" class=\"stagger\">
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🏔️</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Faroe Islands, Denmark</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Because you loved Iceland's raw landscapes & solitude</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">93% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🍜</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Hanoi, Vietnam</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Your street food obsession + cultural depth = perfect match</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">91% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
          <div class=\"reco-card\">
            <div class=\"reco-thumb\">🏛️</div>
            <div style=\"flex:1\">
              <div style=\"font-weight:600;margin-bottom:4px\">Athens, Greece</div>
              <div style=\"font-size:0.82rem;color:var(--text-muted)\">Based on history and culture scores in your Travel DNA</div>
            </div>
            <div style=\"display:flex;gap:8px;align-items:center\">
              <span class=\"ai-badge\">88% match</span>
              <a href=\"destination-detail.html.twig\" class=\"btn btn-secondary btn-sm\">Explore</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Achievements -->
      <section id=\"achievements\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Gamification</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Your <span class=\"text-gold\">Achievements</span></h2>
        <div class=\"grid-2 stagger\" style=\"gap:14px\">
          <div class=\"achievement\"><div class=\"achievement-icon\">🌍</div><div><div style=\"font-weight:600;margin-bottom:4px\">World Explorer</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visited 30+ countries</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement\"><div class=\"achievement-icon\">🍜</div><div><div style=\"font-weight:600;margin-bottom:4px\">Culinary Nomad</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Tried local food in 20 countries</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement\"><div class=\"achievement-icon\">⛺</div><div><div style=\"font-weight:600;margin-bottom:4px\">Trailblazer</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">5 off-beaten-path destinations</div></div><span class=\"badge badge-gold\">Unlocked</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">🚀</div><div><div style=\"font-weight:600;margin-bottom:4px\">Supernova</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visit all 7 continents</div></div><span class=\"badge badge-muted\">6/7</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">💎</div><div><div style=\"font-weight:600;margin-bottom:4px\">Diamond Traveller</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">50+ trips completed</div></div><span class=\"badge badge-muted\">23/50</span></div>
          <div class=\"achievement locked\"><div class=\"achievement-icon\">🌊</div><div><div style=\"font-weight:600;margin-bottom:4px\">Island Hopper</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Visit 10 island destinations</div></div><span class=\"badge badge-muted\">7/10</span></div>
        </div>
      </section>

      <!-- Loyalty -->
      <section id=\"loyalty\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Rewards</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Loyalty <span class=\"text-gold\">Points</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div style=\"display:flex;justify-content:space-between;align-items:center;margin-bottom:28px\">
              <div>
                <div style=\"font-family:var(--font-mono);font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em\">Your Balance</div>
                <div style=\"font-family:var(--font-display);font-size:56px;color:var(--accent-gold);line-height:1\">8,420</div>
                <div style=\"font-size:0.85rem;color:var(--text-muted)\">Explorer Tier · 1,580 pts to Gold</div>
              </div>
              <div style=\"text-align:right\">
                <span class=\"badge badge-gold\" style=\"font-size:14px;padding:8px 20px\">EXPLORER</span>
                <div style=\"font-size:0.8rem;color:var(--text-muted);margin-top:8px\">Next: Gold Tier 🥇</div>
              </div>
            </div>
            <div class=\"loyalty-track\">
              <div class=\"loyalty-fill\" style=\"width:84%\"></div>
              <div class=\"loyalty-glow\" style=\"right:16%\"></div>
            </div>
            <div style=\"display:flex;justify-content:space-between;font-family:var(--font-mono);font-size:10px;color:var(--text-muted);margin-top:8px\">
              <span>Explorer (0)</span><span>Gold (10,000)</span><span>Diamond (25,000)</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Security -->
      <section id=\"security\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Security</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Account <span class=\"text-coral\">Security</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div style=\"display:flex;flex-direction:column;gap:16px\">
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Password</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Secure your account</div></div>
                <button class=\"btn btn-secondary btn-sm\" id=\"togglePasswordBtn\">Change</button>
              </div>
              <div id=\"password-change-section\" style=\"display:none; padding:16px; border-radius:var(--border-radius-md); border:1px solid var(--border-color); background:var(--bg-surface)\">
                <h3 style=\"margin-bottom:16px; font-family:var(--font-display)\">Change Password</h3>
                <div class=\"grid-2\" style=\"gap:20px\">
                  <div class=\"input-group\"><div class=\"input-label\">New Password</div><input class=\"input\" type=\"password\" id=\"new_password\"></div>
                  <div class=\"input-group\"><div class=\"input-label\">Confirm New Password</div><input class=\"input\" type=\"password\" id=\"confirm_password\"></div>
                </div>
                <button class=\"btn btn-primary ripple-btn\" style=\"margin-top:16px\" id=\"confirmPasswordBtn\">Update Password</button>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Two-Factor Authentication</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Enabled via Authenticator App ✓</div></div>
                <span class=\"badge badge-teal\">Active</span>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:var(--bg-surface);border-radius:var(--border-radius-md);border:1px solid var(--border-color)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">AI Data Training</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Control what ARIA learns from your behavior</div></div>
                <button class=\"btn btn-secondary btn-sm\">Manage Privacy</button>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(255,77,109,0.08);border-radius:var(--border-radius-md);border:1px solid rgba(255,77,109,0.35)\">
                <div><div style=\"font-weight:600;margin-bottom:4px;color:#ff4d6d\">Delete Account</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Permanently disable your account access</div></div>
                <button class=\"btn btn-secondary btn-sm\" id=\"deleteAccountBtn\" style=\"border-color:#ff4d6d;color:#ff4d6d\">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</div>

<div class=\"toast\" id=\"profileToast\" style=\"display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:#0b1f4d; color:#fff; padding:12px 24px; border-radius:50px; z-index:9999; font-weight:500; font-size:0.9rem; box-shadow:0 10px 30px rgba(0,0,0,0.35); transition:opacity 0.3s; opacity:0;\">
    <span id=\"toastMsg\"></span>
</div>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"{{ path('index') }}\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">🤖</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">🤖</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Personalized for {{ user.firstName }}</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);background:none;border:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hey {{ user.firstName }}! 👋 I know you well — you're a <strong>{{ travelPersona }}</strong>. Want a destination curated just for you? Or ask me anything about travel! ✨</div></div>
  </div>
  <div class=\"aria-img-preview\" id=\"aria-img-preview\">
    <img id=\"aria-preview-img\" src=\"\" alt=\"preview\">
    <button class=\"remove-img\" id=\"aria-remove-img\" title=\"Remove image\">✕</button>
  </div>
  <div class=\"aria-input-row\">
    <button class=\"aria-attach-btn\" id=\"aria-attach-btn\" title=\"Attach image\">📎</button>
    <button class=\"aria-voice-btn\" id=\"aria-voice-btn\" title=\"Voice search\">🎤</button>
    <button class=\"aria-stop-voice-btn\" id=\"aria-stop-voice-btn\" title=\"Stop voice\">⏹</button>
    <input type=\"file\" id=\"aria-file-input\" accept=\"image/*\" style=\"display:none\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA anything...\">
    <button class=\"aria-send\" id=\"aria-send\" data-track=\"AI_ARIA_CHAT\" data-track-type=\"AI_FEATURE\">➤</button>
  </div>
</div>
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  window.__ariaChatInitialized = true;

  // ════════════════════════════════════════════
  // PASSWORD TOGGLE
  // ════════════════════════════════════════════
  const toggleBtn = document.getElementById('togglePasswordBtn');
  const pwdSection = document.getElementById('password-change-section');
  if (toggleBtn && pwdSection) {
    toggleBtn.addEventListener('click', () => {
      const isHidden = pwdSection.style.display === 'none';
      pwdSection.style.display = isHidden ? 'block' : 'none';
      if (isHidden) pwdSection.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // ════════════════════════════════════════════
  // SAVE PROFILE (Upgraded for Wavy Inputs)
  // ════════════════════════════════════════════
  document.getElementById('saveProfileBtn')?.addEventListener('click', () => {
    const btn = document.getElementById('saveProfileBtn');
    const origText = btn.innerText;
    
    const data = {
      firstName: document.getElementById('profile_first_name')?.value || '',
      lastName:  document.getElementById('profile_last_name')?.value || '',
      email:     document.getElementById('profile_email')?.value || '',
      phone:     document.getElementById('profile_phone')?.value || '',
      bio:       document.getElementById('profile_bio')?.value || ''
    };

    // Phone Validation
    const phoneRegex = /^[+]?[(]?[0-9]{3}[)]?[-\\s.]?[0-9]{3}[-\\s.]?[0-9]{4,6}\$/;
    if (data.phone && !phoneRegex.test(data.phone.replace(/\\s/g, ''))) {
      showToast('⚠️ Please enter a valid phone number', true);
      return;
    }

    btn.innerText = 'Saving...';
    fetch('/profile/update', { 
      method:'POST', 
      headers:{'Content-Type':'application/json'}, 
      body:JSON.stringify(data) 
    })
    .then(r=>r.json())
    .then(res => {
      btn.innerText = origText;
      showToast(res.success ? '✅ Profile updated successfully!' : '❌ ' + (res.error || 'Update failed.'));
      if (res.success) setTimeout(() => window.location.reload(), 1000);
    });
  });

  // Old collectTravelPrefs and savePreferencesBtn removed to avoid duplication with the new chip-based logic below

  document.getElementById('confirmPasswordBtn')?.addEventListener('click', () => {
    const p1 = document.getElementById('new_password').value;
    const p2 = document.getElementById('confirm_password').value;
    if (!p1 || p1 !== p2) { showToast('⚠️ Passwords do not match.'); return; }
    fetch('/profile/password', { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({password:p1}) })
      .then(r=>r.json()).then(res => {
        if (res.success) {
          showToast('✅ Password updated!');
          pwdSection.style.display = 'none';
          document.getElementById('new_password').value = '';
          document.getElementById('confirm_password').value = '';
        } else { showToast('❌ Error updating password.'); }
      });
  });

  document.getElementById('deleteAccountBtn')?.addEventListener('click', () => {
    if (!confirm('Delete your account? This action cannot be undone.')) return;
    fetch('/profile/delete', { method:'POST', headers:{'Content-Type':'application/json'}, body:'{}' })
      .then(r=>r.json())
      .then(res => {
        if (res.success) {
          showToast('✅ Account deleted.');
          setTimeout(() => { window.location.href = '/logout'; }, 600);
        } else {
          showToast('❌ Could not delete account.');
        }
      })
      .catch(() => showToast('❌ Could not delete account.'));
  });

  function showToast(msg, isError = false) {
    const t = document.getElementById('profileToast');
    const m = document.getElementById('toastMsg');
    if (!t || !m) return;
    
    m.textContent = msg;
    t.style.background = isError ? '#ef4444' : '#0b1f4d'; // Red for error, dark navy for success
    t.style.display = 'block';
    t.style.opacity = '0';
    
    setTimeout(() => { t.style.opacity = '1'; }, 50);
    
    if (window.toastTimeout) clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(() => {
      t.style.opacity = '0';
      setTimeout(() => { t.style.display = 'none'; }, 300);
    }, 4000);
  }

  // ════════════════════════════════════════════
  // TRAVEL DNA — ANIMATED COUNTERS
  // ════════════════════════════════════════════
  function animateCounter(elId, target) {
    const el = document.getElementById(elId);
    if (!el) return;
    let start = 0;
    const step = Math.ceil(target / 40) || 1;
    const t = setInterval(() => {
      start = Math.min(start + step, target);
      el.textContent = start;
      if (start >= target) clearInterval(t);
    }, 30);
  }
  animateCounter('stat-time',   {{ totalMinutes|default(0)|round }});
  animateCounter('stat-visits', {{ pageVisits|default(0) }});
  animateCounter('stat-ai',     {{ aiInteractions|default(0) }});
  animateCounter('eng-score-num', {{ engagementScore|default(0) }});

  // Engagement ring arc
  const arc = document.getElementById('engagement-arc');
  if (arc) {
    const score = {{ engagementScore|default(0) }};
    const circ  = 239;
    setTimeout(() => { arc.style.strokeDashoffset = circ - (circ * score / 100); }, 200);
  }

  // ── DNA Bar animations
  document.querySelectorAll('.dna-bar-animated').forEach(bar => {
    const target = bar.dataset.target || 0;
    setTimeout(() => { bar.style.width = target + '%'; }, 300);
  });

  // ════════════════════════════════════════════
  // CHART.JS — ACTIVITY DONUT
  // ════════════════════════════════════════════
  const donutCtx = document.getElementById('dna-donut')?.getContext('2d');
  if (donutCtx) {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Home', 'Destinations', 'Activities', 'Offers', 'Other'],
        datasets: [{
          data: [
            {{ pageBreakdown.Home|default(0) }},
            {{ pageBreakdown.Destinations|default(0) }},
            {{ pageBreakdown.Activities|default(0) }},
            {{ pageBreakdown.Offers|default(0) }},
            {{ pageBreakdown.Other|default(0) }}
          ],
          backgroundColor: ['#00a6ed','#ff4d6d','#00c896','#f59e0b','#6b7280'],
          borderWidth: 0,
          hoverOffset: 12
        }]
      },
      options: {
        responsive: true,
        cutout: '72%',
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: (ctx) => {
                const total = ctx.dataset.data.reduce((a, b) => a + b, 0) || 1;
                const pct = Math.round((ctx.parsed / total) * 100);
                return ` \${ctx.label}: \${ctx.parsed} (\${pct}%)`;
              }
            }
          }
        },
        animation: { animateRotate: true, duration: 1200 }
      }
    });
  }

  // ════════════════════════════════════════════
  // CHART.JS — HOURLY ACTIVITY BAR
  // ════════════════════════════════════════════
  const hourCtx = document.getElementById('dna-hourly')?.getContext('2d');
  if (hourCtx) {
    const hourlyData = {{ hourlyActivity|json_encode|raw }};
    const labels = Array.from({length:24},(_,i)=> i===0?'12am': i<12?`\${i}am`: i===12?'12pm':`\${i-12}pm`);
    new Chart(hourCtx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          data: hourlyData,
          backgroundColor: hourlyData.map((v,i) => {
            const hour = i;
            if (hour >= 6 && hour < 12)  return 'rgba(255,183,3,0.75)';  // morning gold
            if (hour >= 12 && hour < 18) return 'rgba(0,166,237,0.75)';  // afternoon blue
            if (hour >= 18 && hour < 22) return 'rgba(255,77,109,0.75)'; // evening coral
            return 'rgba(114,9,183,0.6)'; // night purple
          }),
          borderRadius: 4,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { callbacks: { title: (c) => `\${c[0].label}`, label: (c) => ` \${c.parsed.y} actions` } } },
        scales: {
          x: { ticks: { font: { size: 8 }, color: '#6b7280', maxRotation: 45 }, grid: { display: false } },
          y: { ticks: { font: { size: 9 }, color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.04)' } }
        },
        animation: { duration: 1000 }
      }
    });
  }

  const destCtx = document.getElementById('dna-destinations')?.getContext('2d');
  if (destCtx) {
    const destinationData = {{ destinationClicks|default({})|json_encode|raw }};
    const labels = Object.keys(destinationData);
    const values = Object.values(destinationData);

    new Chart(destCtx, {
      type: 'bar',
      data: {
        labels: labels.length ? labels : ['No destination data'],
        datasets: [{
          data: values.length ? values : [0],
          backgroundColor: 'rgba(255, 77, 109, 0.75)',
          borderRadius: 6
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.04)' } },
          y: { ticks: { color: '#6b7280', font: { size: 10 } }, grid: { display: false } }
        }
      }
    });
  }

  const radarCtx = document.getElementById('dna-radar')?.getContext('2d');
  if (radarCtx) {
    const pace = '{{ preferences and preferences.travelPace ? preferences.travelPace|lower : \"\" }}';
    const climate = '{{ preferences and preferences.preferredClimate ? preferences.preferredClimate|lower : \"\" }}';
    const groupType = '{{ preferences and preferences.groupType ? preferences.groupType|lower : \"\" }}';

    const radarData = [
      pace === 'fast' ? 90 : (pace === 'slow' ? 45 : 65),
      (climate.includes('tropical') || climate.includes('beach')) ? 85 : 55,
      groupType.includes('solo') ? 90 : (groupType.includes('family') ? 75 : 60),
      {{ aiInteractions|default(0) > 0 ? ((aiInteractions * 10) > 100 ? 100 : (aiInteractions * 10)) : 35 }},
      {{ pageVisits|default(0) > 0 ? ((pageVisits * 4) > 100 ? 100 : (pageVisits * 4)) : 40 }}
    ];

    new Chart(radarCtx, {
      type: 'radar',
      data: {
        labels: ['Pace', 'Climate Match', 'Group Fit', 'AI Affinity', 'Explorer Depth'],
        datasets: [{
          label: 'Travel DNA',
          data: radarData,
          borderColor: '#00a6ed',
          backgroundColor: 'rgba(0,166,237,0.2)',
          pointBackgroundColor: '#ff4d6d'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          r: {
            suggestedMin: 0,
            suggestedMax: 100,
            angleLines: { color: 'rgba(255,255,255,0.08)' },
            grid: { color: 'rgba(255,255,255,0.08)' },
            pointLabels: { color: '#9ca3af', font: { size: 10 } },
            ticks: { display: false }
          }
        }
      }
    });
  }

  const aiMeter = document.getElementById('ai-meter-fill');
  if (aiMeter) {
    const target = parseInt(aiMeter.dataset.target || '0', 10);
    setTimeout(() => { aiMeter.style.width = target + '%'; }, 250);
  }

  // ════════════════════════════════════════════
  // ARIA CHAT — FULLY WORKING
  // ════════════════════════════════════════════
  const orbBtn     = document.getElementById('aria-orb');
  const panel      = document.getElementById('aria-panel');
  const closeBtn   = document.getElementById('aria-close');
  const msgBox     = document.getElementById('aria-messages');
  const inputEl    = document.getElementById('aria-input');
  const sendBtn    = document.getElementById('aria-send');
  const attachBtn  = document.getElementById('aria-attach-btn');
  const voiceBtn   = document.getElementById('aria-voice-btn');
  const stopVoiceBtn = document.getElementById('aria-stop-voice-btn');
  const fileInput  = document.getElementById('aria-file-input');
  const imgPreview = document.getElementById('aria-img-preview');
  const previewImg = document.getElementById('aria-preview-img');
  const removeImg  = document.getElementById('aria-remove-img');

  let selectedImageBase64 = null;
  let selectedImageMimeType = null;
  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  const speechRecognition = SpeechRecognition ? new SpeechRecognition() : null;
  if (speechRecognition) {
    speechRecognition.lang = 'en-US';
    speechRecognition.interimResults = false;
    speechRecognition.maxAlternatives = 1;
  }

  // Open / close panel
  orbBtn?.addEventListener('click', () => panel?.classList.toggle('open'));
  closeBtn?.addEventListener('click', () => panel?.classList.remove('open'));

  // Image attach
  attachBtn?.addEventListener('click', () => fileInput?.click());

  fileInput?.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;
    if (!file.type.startsWith('image/')) {
      appendBubble('bot', 'Please attach a valid image file.');
      return;
    }
    if (file.size > 5 * 1024 * 1024) {
      appendBubble('bot', 'Image too large. Please use a file smaller than 5MB.');
      return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
      const dataUrl = e.target.result;
      // strip prefix: data:image/jpeg;base64,
      selectedImageBase64 = dataUrl.split(',')[1];
      selectedImageMimeType = file.type;
      previewImg.src = dataUrl;
      imgPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });

  removeImg?.addEventListener('click', () => {
    selectedImageBase64 = null;
    selectedImageMimeType = null;
    fileInput.value = '';
    imgPreview.style.display = 'none';
    previewImg.src = '';
  });

  voiceBtn?.addEventListener('click', () => {
    if (!speechRecognition) {
      appendBubble('bot', 'Voice search is not supported in this browser.');
      return;
    }
    voiceBtn.classList.add('active');
    speechRecognition.start();
  });

  speechRecognition?.addEventListener('result', (event) => {
    const transcript = event.results?.[0]?.[0]?.transcript || '';
    if (!transcript.trim()) return;
    inputEl.value = transcript;
    sendMessage();
  });

  speechRecognition?.addEventListener('end', () => {
    voiceBtn?.classList.remove('active');
  });
  stopVoiceBtn?.addEventListener('click', () => {
    if ('speechSynthesis' in window) window.speechSynthesis.cancel();
  });

  // Send message
  function sendMessage() {
    const text = (inputEl?.value || '').trim();
    if (!text && !selectedImageBase64) return;

    // Append user bubble
    appendBubble('user', text, selectedImageBase64 ? previewImg.src : null);

    // Clear inputs
    inputEl.value = '';
    const imgB64 = selectedImageBase64;
    const imgMimeType = selectedImageMimeType;
    selectedImageBase64 = null;
    selectedImageMimeType = null;
    fileInput.value = '';
    imgPreview.style.display = 'none';
    previewImg.src = '';

    // Typing indicator
    const typingEl = document.createElement('div');
    typingEl.className = 'aria-msg bot';
    typingEl.innerHTML = '<div class=\"aria-bubble aria-typing-bubble\" aria-live=\"polite\"><span class=\"aria-ellipsis\">...</span></div>';
    msgBox.appendChild(typingEl);
    scrollMsgs();

    // API call
    fetch('/api/chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
      body: JSON.stringify({ message: text, image: imgB64, imageMimeType: imgMimeType })
    })
    .then(function (r) {
      return r.text().then(function (txt) {
        var data = {};
        try {
          data = txt ? JSON.parse(txt) : {};
        } catch (e) {
          typingEl.remove();
          appendBubble('bot', '⚠️ Server error (HTTP ' + r.status + '). If you are logged in, try refreshing the page.');
          return null;
        }
        return { ok: r.ok, status: r.status, data: data };
      });
    })
    .then(function (result) {
      if (!result) return;
      typingEl.remove();
      var data = result.data;
      if (data.response) {
        appendBubble('bot', data.response);
        speakText(data.response);
      } else if (data.error) {
        appendBubble('bot', '⚠️ ' + data.error);
      } else {
        appendBubble('bot', '⚠️ Unexpected response (HTTP ' + result.status + ').');
      }
    })
    .catch(function () {
      typingEl.remove();
      appendBubble('bot', '⚠️ Network error. Check your connection and try again.');
    });
  }

  function appendBubble(role, text, imgSrc) {
    const wrap = document.createElement('div');
    wrap.className = 'aria-msg ' + role;
    if (imgSrc) {
      const img = document.createElement('img');
      img.src = imgSrc;
      img.style.maxWidth = '120px';
      img.style.borderRadius = '8px';
      img.style.marginBottom = '6px';
      img.style.display = 'block';
      wrap.appendChild(img);
    }
    if (text) {
      const bubble = document.createElement('div');
      bubble.className = 'aria-bubble';
      bubble.textContent = text;
      wrap.appendChild(bubble);
    }
    msgBox.appendChild(wrap);
    scrollMsgs();
  }

  function scrollMsgs() {
    if (msgBox) msgBox.scrollTop = msgBox.scrollHeight;
  }

  function speakText(text) {
    if (window.TRIPX_ARIA && typeof window.TRIPX_ARIA.speak === 'function') {
      window.TRIPX_ARIA.speak(text);
    }
  }

  sendBtn?.addEventListener('click', sendMessage);
  inputEl?.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
  });

  // Prevent input from clearing on focus (ensure value is preserved)
  inputEl?.addEventListener('focus', (e) => e.stopPropagation());

  // Initial scroll
  scrollMsgs();

  // ════════════════════════════════════════════
  // TRAVEL PREFERENCES CHIPS
  // ════════════════════════════════════════════
  const prefChips = document.querySelectorAll('#prefManagerRoot .pref-chip');
  prefChips.forEach(chip => {
    chip.addEventListener('click', function() {
      // Toggle for AccToggle isolated
      if (this.id === 'profAccToggle') {
        this.classList.toggle('selected');
        return;
      }
      const group = this.closest('.pref-chip-grid')?.dataset.group;
      if (!group) return;
      const isMulti = this.closest('.pref-chip-grid').dataset.multi === 'true';
      const max = this.closest('.pref-chip-grid').dataset.max ? parseInt(this.closest('.pref-chip-grid').dataset.max) : 99;

      if (isMulti) {
        if (!this.classList.contains('selected')) {
          const currentlySelected = this.closest('.pref-chip-grid').querySelectorAll('.pref-chip.selected').length;
          if (currentlySelected >= max) {
            showToast(`You can only select up to \${max} options.`, true);
            return;
          }
        }
        this.classList.toggle('selected');
      } else {
        const siblings = this.closest('.pref-chip-grid').querySelectorAll('.pref-chip');
        siblings.forEach(s => s.classList.remove('selected'));
        this.classList.add('selected');
      }
    });
  });

  const profMinB = document.getElementById('profMinBudget');
  const profMaxB = document.getElementById('profMaxBudget');
  if (profMinB && profMaxB) {
    profMinB.addEventListener('input', () => {
      if (parseInt(profMinB.value) > parseInt(profMaxB.value)) profMinB.value = profMaxB.value;
      document.getElementById('profMinBudgetDisplay').innerText = '\$' + profMinB.value;
    });
    profMaxB.addEventListener('input', () => {
      if (parseInt(profMaxB.value) < parseInt(profMinB.value)) profMaxB.value = profMinB.value;
      document.getElementById('profMaxBudgetDisplay').innerText = '\$' + profMaxB.value;
    });
  }

  document.getElementById('savePreferencesBtn')?.addEventListener('click', () => {
    const origText = document.getElementById('savePreferencesBtn').innerText;
    document.getElementById('savePreferencesBtn').innerText = 'Saving...';
    
    // Gather prefs
    const prefsPayload = {
      budget_min_per_night: profMinB ? parseInt(profMinB.value) : null,
      budget_max_per_night: profMaxB ? parseInt(profMaxB.value) : null,
      accessibility_needs: document.getElementById('profAccToggle')?.classList.contains('selected') || false
    };

    const extractGroup = (groupName) => {
      const grid = document.querySelector(`.pref-chip-grid[data-group=\"\${groupName}\"]`);
      if (!grid) return [];
      const selected = Array.from(grid.querySelectorAll('.pref-chip.selected')).map(c => c.dataset.val);
      return grid.dataset.multi === 'true' ? selected : (selected[0] || '');
    };

    prefsPayload.travel_pace = extractGroup('travel_pace');
    prefsPayload.group_type = extractGroup('group_type');
    prefsPayload.priorities = extractGroup('priorities');
    prefsPayload.preferred_climate = extractGroup('preferred_climate');
    prefsPayload.location_preferences = extractGroup('location_preferences');
    prefsPayload.accommodation_types = extractGroup('accommodation_types');
    prefsPayload.style_preferences = extractGroup('style_preferences');
    prefsPayload.dietary_restrictions = extractGroup('dietary_restrictions');

    fetch('/profile/preferences', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(prefsPayload)
    })
    .then(r => r.json())
    .then(data => {
      document.getElementById('savePreferencesBtn').innerText = origText;
      if (data.success) {
        showToast('✈️ Travel preferences saved successfully!');
        setTimeout(() => window.location.reload(), 1500);
      } else {
        showToast('⚠️ Error: ' + (data.error || 'Check fields.'), true);
      }
    })
    .catch(() => {
      document.getElementById('savePreferencesBtn').innerText = origText;
      showToast('⚠️ Connection error', true);
    });
  });

});
</script>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/users.html.twig", "C:\\Sym\\templates\\front\\users.html.twig");
    }
}
