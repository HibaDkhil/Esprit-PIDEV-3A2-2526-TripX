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
    }
    #travel-dna-chart { filter: drop-shadow(0 0 20px rgba(0,166,237,0.3)); }
    
    @media (max-width: 900px) {
      .profile-layout { grid-template-columns: 1fr; }
      .profile-sidebar { position: static; }
    }
  </style>
</head>
<body>
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>



<nav class=\"nav\">
  <div class=\"nav-inner\">
    <a href=\"";
        // line 130
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">Trip<span>X</span></a>
    <div class=\"nav-links\">
      <a href=\"";
        // line 132
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"          class=\"nav-link\">Home</a>
      <a href=\"";
        // line 133
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\"   class=\"nav-link\">Destinations</a>
      <a href=\"";
        // line 134
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\"     class=\"nav-link\">Activities</a>
      <a href=\"";
        // line 135
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
      <a href=\"";
        // line 136
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\"      class=\"nav-link\">Transport</a>
      <a href=\"";
        // line 137
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\"         class=\"nav-link\">Offers</a>
      <a href=\"";
        // line 138
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a><a href=\"#\" class=\"nav-link\">My Bookings</a>
    </div>
    <div class=\"nav-actions\">
      <button id=\"theme-toggle\" class=\"theme-toggle\" aria-label=\"Toggle dark mode\">
        <span class=\"toggle-icon icon-sun\">☀️</span>
        <span class=\"toggle-icon icon-moon\">🌙</span>
      </button>
      <a href=\"";
        // line 145
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("users");
        yield "\" class=\"btn-nav-primary ripple-btn\">My Profile</a>
      <a href=\"";
        // line 146
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
        // line 159
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 159, $this->source); })()), "firstName", [], "any", false, false, false, 159))), "html", null, true);
        yield "</div>
        <div class=\"profile-name\">";
        // line 160
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 160, $this->source); })()), "firstName", [], "any", false, false, false, 160), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 160, $this->source); })()), "lastName", [], "any", false, false, false, 160), "html", null, true);
        yield "</div>
        <div class=\"profile-handle\">@";
        // line 161
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 161, $this->source); })()), "firstName", [], "any", false, false, false, 161)), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 161, $this->source); })()), "userId", [], "any", false, false, false, 161), "html", null, true);
        yield " · ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 161, $this->source); })()), "role", [], "any", false, false, false, 161)), "html", null, true);
        yield " Tier 🌍</div>
        <div class=\"profile-badge-row\">
          <span class=\"badge badge-coral\">Nomad</span>
          <span class=\"badge badge-gold\">Trailblazer</span>
          <span class=\"badge badge-teal\">Foodie</span>
        </div>
        <div style=\"display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;text-align:center\">
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">23</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Trips</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">31</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Countries</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">142K</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Air Miles</div></div>
        </div>
      </div>

      <div class=\"sidebar-nav reveal reveal-delay-1\">
        <a href=\"#personal\"   class=\"sidebar-nav-item active\" data-track=\"NAV_PERSONAL\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">👤</span> Personal Info</a>
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
            <div class=\"grid-2\" style=\"gap:20px\">
              <div class=\"input-group\"><div class=\"input-label\">First Name</div><input class=\"input\" type=\"text\" value=\"";
        // line 195
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 195, $this->source); })()), "firstName", [], "any", false, false, false, 195), "html", null, true);
        yield "\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Last Name</div><input class=\"input\" type=\"text\" value=\"";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 196, $this->source); })()), "lastName", [], "any", false, false, false, 196), "html", null, true);
        yield "\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Email</div><input class=\"input\" type=\"email\" value=\"";
        // line 197
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 197, $this->source); })()), "email", [], "any", false, false, false, 197), "html", null, true);
        yield "\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Phone</div><input class=\"input\" type=\"tel\" value=\"";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 198, $this->source); })()), "phoneNumber", [], "any", false, false, false, 198), "html", null, true);
        yield "\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Gender</div><input class=\"input\" type=\"text\" value=\"";
        // line 199
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "gender", [], "any", true, true, false, 199)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 199, $this->source); })()), "gender", [], "any", false, false, false, 199), "Not specified")) : ("Not specified")), "html", null, true);
        yield "\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Birth Year</div><input class=\"input\" type=\"text\" value=\"";
        // line 200
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 200, $this->source); })()), "birthYear", [], "any", false, false, false, 200), "html", null, true);
        yield "\"></div>
            </div>
            <div class=\"input-group\" style=\"margin-top:16px\">
              <div class=\"input-label\">Bio / Travel Style</div>
              <textarea class=\"input\" rows=\"3\" style=\"resize:vertical; color:#6b7280\" placeholder=\"Tell us about your travel style...\">";
        // line 204
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "bio", [], "any", true, true, false, 204)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 204, $this->source); })()), "bio", [], "any", false, false, false, 204), "")) : ("")), "html", null, true);
        yield "</textarea>
            </div>
            <div style=\"margin-top:20px;display:flex;gap:12px\">
              <button class=\"btn btn-primary ripple-btn\" id=\"saveProfileBtn\">Save Changes</button>
              <button class=\"btn btn-secondary\">Cancel</button>
            </div>

            <div id=\"password-change-section\" style=\"display:none; margin-top:32px; padding-top:24px; border-top:1px solid var(--border-color)\">
              <h3 style=\"margin-bottom:16px; font-family:var(--font-display)\">Change Password</h3>
              <div class=\"grid-2\" style=\"gap:20px\">
                <div class=\"input-group\"><div class=\"input-label\">New Password</div><input class=\"input\" type=\"password\" id=\"new_password\"></div>
                <div class=\"input-group\"><div class=\"input-label\">Confirm New Password</div><input class=\"input\" type=\"password\" id=\"confirm_password\"></div>
              </div>
              <button class=\"btn btn-primary ripple-btn\" style=\"margin-top:16px\" id=\"confirmPasswordBtn\">Update Password</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Your Activity / Travel DNA -->
      <section id=\"activity\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Your Activity</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Travel <span class=\"text-teal\">DNA</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div class=\"grid-3\" style=\"gap:20px; margin-bottom:32px\">
              <div class=\"card dna-card reveal\" style=\"padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Screen Time</div>
                <div style=\"font-family:var(--font-display);font-size:32px;color:var(--accent-primary)\">";
        // line 232
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("totalMinutes", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["totalMinutes"]) || array_key_exists("totalMinutes", $context) ? $context["totalMinutes"] : (function () { throw new RuntimeError('Variable "totalMinutes" does not exist.', 232, $this->source); })()), 0)) : (0)), "html", null, true);
        yield " <span style=\"font-size:16px\">min</span></div>
                <div style=\"font-size:12px;color:#10b981;margin-top:8px\">Last 50 interactions</div>
              </div>
              <div class=\"card dna-card reveal\" style=\"animation-delay:0.1s; padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Platform Visits</div>
                <div style=\"font-family:var(--font-display);font-size:32px;color:var(--accent-teal)\">";
        // line 237
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageVisits", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 237, $this->source); })()), 0)) : (0)), "html", null, true);
        yield "</div>
                <div style=\"font-size:12px;color:var(--text-muted);margin-top:8px\">Page requests tracked</div>
              </div>
              <div class=\"card dna-card reveal\" style=\"animation-delay:0.2s; padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Latest Search</div>
                <div style=\"font-family:var(--font-display);font-size:20px;color:var(--accent-coral); margin-top:8px; word-wrap:break-word;\">";
        // line 242
        yield (((($tmp = Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["activity_logs"]) || array_key_exists("activity_logs", $context) ? $context["activity_logs"] : (function () { throw new RuntimeError('Variable "activity_logs" does not exist.', 242, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["activity_logs"]) || array_key_exists("activity_logs", $context) ? $context["activity_logs"] : (function () { throw new RuntimeError('Variable "activity_logs" does not exist.', 242, $this->source); })())), "targetId", [], "any", false, false, false, 242), "html", null, true)) : ("Home Page"));
        yield "</div>
                <div style=\"font-size:12px;color:var(--text-muted);margin-top:8px\">Recent activity</div>
              </div>
            </div>

            <div class=\"panel reveal\" style=\"margin-bottom:32px\">
                <h3 style=\"font-family:var(--font-display);font-size:18px;margin-bottom:20px\">Recent Platform Activity</h3>
                <div style=\"display:flex;flex-direction:column;gap:12px\">
                ";
        // line 250
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["activity_logs"]) || array_key_exists("activity_logs", $context) ? $context["activity_logs"] : (function () { throw new RuntimeError('Variable "activity_logs" does not exist.', 250, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 251
            yield "                    <div style=\"display:flex;justify-content:space-between;align-items:center;padding:12px;background:rgba(255,255,255,0.03);border-radius:8px;font-size:0.9rem\">
                        <div style=\"display:flex; gap:16px; align-items:center\">
                            <span class=\"badge ";
            // line 253
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "activityType", [], "any", false, false, false, 253) == "VISIT")) ? ("badge-teal") : ("badge-coral"));
            yield "\" style=\"min-width:80px; text-align:center\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "activityType", [], "any", false, false, false, 253), "html", null, true);
            yield "</span>
                            <span style=\"opacity:0.8\">";
            // line 254
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "targetId", [], "any", false, false, false, 254), "html", null, true);
            yield "</span>
                        </div>
                        <div style=\"font-size:0.8rem;opacity:0.5\">";
            // line 256
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "timestamp", [], "any", false, false, false, 256), "M d, H:i"), "html", null, true);
            yield "</div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 258
        if (!$context['_iterated']) {
            // line 259
            yield "                    <div class=\"text-muted\">No activity data found.</div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['log'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 261
        yield "                </div>
            </div>

            <div class=\"grid-2\" style=\"align-items:center;gap:40px\">
              <div style=\"display:flex;flex-direction:column;align-items:center; position:relative;\">
                <canvas id=\"travel-dna-chart\" width=\"280\" height=\"280\"></canvas>
                <div style=\"position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; pointer-events:none;\">
                    <div style=\"font-family:var(--font-display); font-size:40px; color:var(--accent-primary)\">";
        // line 268
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 268, $this->source); })()), "html", null, true);
        yield "</div>
                    <div style=\"font-size:10px; color:var(--text-muted); text-transform:uppercase;\">Visits</div>
                </div>
                <div style=\"margin-top:20px;text-align:center\">
                  <div style=\"font-family:var(--font-mono);font-size:11px;color:var(--text-muted)\">AI TRAVEL GENOME</div>
                  <div style=\"font-family:var(--font-display);font-size:24px;margin-top:4px\">";
        // line 273
        yield ((((isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 273, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 273, $this->source); })()), "stylePreferences", [], "any", false, false, false, 273))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["preferences"]) || array_key_exists("preferences", $context) ? $context["preferences"] : (function () { throw new RuntimeError('Variable "preferences" does not exist.', 273, $this->source); })()), "stylePreferences", [], "any", false, false, false, 273), ",")), "html", null, true)) : ("Classic"));
        yield " explorer</div>
                </div>
              </div>
              <div>
                <h3 style=\"margin-bottom:20px\">Behavioral DNA Report</h3>
                <div style=\"display:flex;flex-direction:column;gap:14px\">
                  <div>
                    <div style=\"display:flex;justify-content:space-between;margin-bottom:6px\">
                      <span style=\"font-size:0.9rem;opacity:0.7\">Onboarding Completion</span>
                      <span style=\"font-family:var(--font-mono);font-size:11px;color:var(--accent-primary)\">100%</span>
                    </div>
                    <div class=\"progress-bar\"><div class=\"progress-fill\" style=\"width:100%\"></div></div>
                  </div>
                  <div>
                    <div style=\"display:flex;justify-content:space-between;margin-bottom:6px\">
                      <span style=\"font-size:0.9rem;opacity:0.7\">Site Engagement</span>
                      <span style=\"font-family:var(--font-mono);font-size:11px;color:var(--accent-primary)\">";
        // line 289
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 289, $this->source); })()) * 2), 0), "html", null, true);
        yield "%</span>
                    </div>
                    <div class=\"progress-bar\"><div class=\"progress-fill\" style=\"width:";
        // line 291
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(((isset($context["pageVisits"]) || array_key_exists("pageVisits", $context) ? $context["pageVisits"] : (function () { throw new RuntimeError('Variable "pageVisits" does not exist.', 291, $this->source); })()) * 2), 20), "html", null, true);
        yield "%\"></div></div>
                  </div>
                </div>
              </div>
            </div>
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
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Two-Factor Authentication</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Enabled via Authenticator App ✓</div></div>
                <span class=\"badge badge-teal\">Active</span>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:var(--bg-surface);border-radius:var(--border-radius-md);border:1px solid var(--border-color)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">AI Data Training</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Control what ARIA learns from your behavior</div></div>
                <button class=\"btn btn-secondary btn-sm\">Manage Privacy</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</div>

<div class=\"toast\" id=\"profileToast\" style=\"display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:var(--navy); color:#fff; padding:12px 24px; border-radius:50px; z-index:9999; font-weight:500; font-size:0.9rem; box-shadow:0 10px 30px rgba(0,0,0,0.2); transition:opacity 0.3s; opacity:0;\">
    <span id=\"toastMsg\"></span>
</div>

<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"footer-bottom\">
      <div class=\"footer-copy\">© 2026 TripX. All rights reserved.</div>
      <a href=\"";
        // line 463
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"footer-copy\" style=\"color:var(--accent-primary)\">← Back to Home</a>
    </div>
  </div>
</footer>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Personalized for ";
        // line 472
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 472, $this->source); })()), "firstName", [], "any", false, false, false, 472), "html", null, true);
        yield "</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hey ";
        // line 476
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 476, $this->source); })()), "firstName", [], "any", false, false, false, 476), "html", null, true);
        yield "! Based on your Travel DNA, I think you'd absolutely love the Faroe Islands next. Want me to build you an itinerary? 🏔️</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA...\">
    <button class=\"aria-send\" id=\"aria-send\" data-track=\"AI_ARIA_CHAT\" data-track-type=\"AI_FEATURE\">➤</button>
  </div>
</div>
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const pwdSection = document.getElementById('password-change-section');
    if (toggleBtn && pwdSection) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = pwdSection.style.display === 'none';
            pwdSection.style.display = isHidden ? 'block' : 'none';
            if (isHidden) pwdSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Chart.js - Travel DNA
    const ctx = document.getElementById('travel-dna-chart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Visits', 'Searches', 'Bookings', 'Social'],
                datasets: [{
                    data: [
                        ";
        // line 506
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "VISIT", [], "any", true, true, false, 506)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 506, $this->source); })()), "VISIT", [], "any", false, false, false, 506), 0)) : (0)), "html", null, true);
        yield ", 
                        ";
        // line 507
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "SEARCH", [], "any", true, true, false, 507)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 507, $this->source); })()), "SEARCH", [], "any", false, false, false, 507), 0)) : (0)), "html", null, true);
        yield ", 
                        ";
        // line 508
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "BOOKING", [], "any", true, true, false, 508)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 508, $this->source); })()), "BOOKING", [], "any", false, false, false, 508), 0)) : (0)), "html", null, true);
        yield ", 
                        ";
        // line 509
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["activityStats"] ?? null), "SOCIAL", [], "any", true, true, false, 509)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["activityStats"]) || array_key_exists("activityStats", $context) ? $context["activityStats"] : (function () { throw new RuntimeError('Variable "activityStats" does not exist.', 509, $this->source); })()), "SOCIAL", [], "any", false, false, false, 509), 0)) : (0)), "html", null, true);
        yield "
                    ],
                    backgroundColor: ['#00a6ed', '#ff4d6d', '#00c896', '#7209b7'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: '80%',
                plugins: { legend: { display: false } }
            }
        });
    }

    // Save Changes
    document.getElementById('saveProfileBtn')?.addEventListener('click', () => {
        const data = {
            firstName: document.querySelector('input[value=\"";
        // line 527
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 527, $this->source); })()), "firstName", [], "any", false, false, false, 527), "html", null, true);
        yield "\"]')?.value || '";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 527, $this->source); })()), "firstName", [], "any", false, false, false, 527), "html", null, true);
        yield "',
            lastName: document.querySelector('input[value=\"";
        // line 528
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 528, $this->source); })()), "lastName", [], "any", false, false, false, 528), "html", null, true);
        yield "\"]')?.value || '";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 528, $this->source); })()), "lastName", [], "any", false, false, false, 528), "html", null, true);
        yield "',
            email: document.querySelector('input[value=\"";
        // line 529
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 529, $this->source); })()), "email", [], "any", false, false, false, 529), "html", null, true);
        yield "\"]')?.value || '";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 529, $this->source); })()), "email", [], "any", false, false, false, 529), "html", null, true);
        yield "',
            bio: document.querySelector('textarea')?.value
        };

        fetch('/profile/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(r => r.json())
        .then(res => {
            const toast = document.getElementById('profileToast');
            const msg = document.getElementById('toastMsg');
            toast.style.display = 'block';
            
            if (res.success) {
                msg.innerHTML = '<i class=\"fas fa-check-circle\" style=\"color:#10b981; margin-right:8px;\"></i> Profile updated successfully!';
            } else {
                msg.innerHTML = '<i class=\"fas fa-times-circle\" style=\"color:#ef4444; margin-right:8px;\"></i> Failed to update profile.';
            }
            
            // Fade in
            setTimeout(() => toast.style.opacity = '1', 10);
            
            // Fade out
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.style.display = 'none', 300);
            }, 3000);
        });
    });

    document.getElementById('confirmPasswordBtn')?.addEventListener('click', () => {
        const p1 = document.getElementById('new_password').value;
        const p2 = document.getElementById('confirm_password').value;
        if (p1 && p1 === p2) {
            fetch('/profile/password', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ password: p1 })
            })
            .then(r => r.json())
            .then(res => {
                const toast = document.getElementById('profileToast');
                const msg = document.getElementById('toastMsg');
                toast.style.display = 'block';
                
                if (res.success) {
                    msg.innerHTML = '<i class=\"fas fa-check-circle\" style=\"color:#10b981; margin-right:8px;\"></i> Password updated!';
                    pwdSection.style.display = 'none';
                    document.getElementById('new_password').value = '';
                    document.getElementById('confirm_password').value = '';
                } else {
                    msg.innerHTML = '<i class=\"fas fa-times-circle\" style=\"color:#ef4444; margin-right:8px;\"></i> Error updating password.';
                }
                
                setTimeout(() => toast.style.opacity = '1', 10);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.style.display = 'none', 300);
                }, 3000);
            });
        } else {
            const toast = document.getElementById('profileToast');
            const msg = document.getElementById('toastMsg');
            toast.style.display = 'block';
            msg.innerHTML = '<i class=\"fas fa-exclamation-triangle\" style=\"color:#f59e0b; margin-right:8px;\"></i> Passwords do not match.';
            setTimeout(() => toast.style.opacity = '1', 10);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.style.display = 'none', 300);
            }, 3000);
        }
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
        return array (  719 => 529,  713 => 528,  707 => 527,  686 => 509,  682 => 508,  678 => 507,  674 => 506,  641 => 476,  634 => 472,  622 => 463,  447 => 291,  442 => 289,  423 => 273,  415 => 268,  406 => 261,  399 => 259,  397 => 258,  390 => 256,  385 => 254,  379 => 253,  375 => 251,  370 => 250,  359 => 242,  351 => 237,  343 => 232,  312 => 204,  305 => 200,  301 => 199,  297 => 198,  293 => 197,  289 => 196,  285 => 195,  245 => 161,  239 => 160,  235 => 159,  219 => 146,  215 => 145,  205 => 138,  201 => 137,  197 => 136,  193 => 135,  189 => 134,  185 => 133,  181 => 132,  176 => 130,  45 => 1,);
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
    }
    #travel-dna-chart { filter: drop-shadow(0 0 20px rgba(0,166,237,0.3)); }
    
    @media (max-width: 900px) {
      .profile-layout { grid-template-columns: 1fr; }
      .profile-sidebar { position: static; }
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
        <div class=\"profile-handle\">@{{ user.firstName|lower }}{{ user.userId }} · {{ user.role|capitalize }} Tier 🌍</div>
        <div class=\"profile-badge-row\">
          <span class=\"badge badge-coral\">Nomad</span>
          <span class=\"badge badge-gold\">Trailblazer</span>
          <span class=\"badge badge-teal\">Foodie</span>
        </div>
        <div style=\"display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;text-align:center\">
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">23</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Trips</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">31</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Countries</div></div>
          <div><div style=\"font-family:var(--font-display);font-size:28px;color:var(--accent-primary)\">142K</div><div style=\"font-family:var(--font-mono);font-size:9px;color:var(--text-muted)\">Air Miles</div></div>
        </div>
      </div>

      <div class=\"sidebar-nav reveal reveal-delay-1\">
        <a href=\"#personal\"   class=\"sidebar-nav-item active\" data-track=\"NAV_PERSONAL\" data-track-type=\"NAV\"><span class=\"sidebar-nav-icon\">👤</span> Personal Info</a>
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
            <div class=\"grid-2\" style=\"gap:20px\">
              <div class=\"input-group\"><div class=\"input-label\">First Name</div><input class=\"input\" type=\"text\" value=\"{{ user.firstName }}\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Last Name</div><input class=\"input\" type=\"text\" value=\"{{ user.lastName }}\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Email</div><input class=\"input\" type=\"email\" value=\"{{ user.email }}\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Phone</div><input class=\"input\" type=\"tel\" value=\"{{ user.phoneNumber }}\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Gender</div><input class=\"input\" type=\"text\" value=\"{{ user.gender|default('Not specified') }}\"></div>
              <div class=\"input-group\"><div class=\"input-label\">Birth Year</div><input class=\"input\" type=\"text\" value=\"{{ user.birthYear }}\"></div>
            </div>
            <div class=\"input-group\" style=\"margin-top:16px\">
              <div class=\"input-label\">Bio / Travel Style</div>
              <textarea class=\"input\" rows=\"3\" style=\"resize:vertical; color:#6b7280\" placeholder=\"Tell us about your travel style...\">{{ user.bio|default('') }}</textarea>
            </div>
            <div style=\"margin-top:20px;display:flex;gap:12px\">
              <button class=\"btn btn-primary ripple-btn\" id=\"saveProfileBtn\">Save Changes</button>
              <button class=\"btn btn-secondary\">Cancel</button>
            </div>

            <div id=\"password-change-section\" style=\"display:none; margin-top:32px; padding-top:24px; border-top:1px solid var(--border-color)\">
              <h3 style=\"margin-bottom:16px; font-family:var(--font-display)\">Change Password</h3>
              <div class=\"grid-2\" style=\"gap:20px\">
                <div class=\"input-group\"><div class=\"input-label\">New Password</div><input class=\"input\" type=\"password\" id=\"new_password\"></div>
                <div class=\"input-group\"><div class=\"input-label\">Confirm New Password</div><input class=\"input\" type=\"password\" id=\"confirm_password\"></div>
              </div>
              <button class=\"btn btn-primary ripple-btn\" style=\"margin-top:16px\" id=\"confirmPasswordBtn\">Update Password</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Your Activity / Travel DNA -->
      <section id=\"activity\" style=\"margin-bottom:48px\">
        <div class=\"section-label reveal\"><span>Your Activity</span></div>
        <h2 class=\"display-md reveal\" style=\"margin-bottom:24px\">Travel <span class=\"text-teal\">DNA</span></h2>
        <div class=\"card reveal\">
          <div class=\"card-body\">
            <div class=\"grid-3\" style=\"gap:20px; margin-bottom:32px\">
              <div class=\"card dna-card reveal\" style=\"padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Screen Time</div>
                <div style=\"font-family:var(--font-display);font-size:32px;color:var(--accent-primary)\">{{ totalMinutes|default(0) }} <span style=\"font-size:16px\">min</span></div>
                <div style=\"font-size:12px;color:#10b981;margin-top:8px\">Last 50 interactions</div>
              </div>
              <div class=\"card dna-card reveal\" style=\"animation-delay:0.1s; padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Platform Visits</div>
                <div style=\"font-family:var(--font-display);font-size:32px;color:var(--accent-teal)\">{{ pageVisits|default(0) }}</div>
                <div style=\"font-size:12px;color:var(--text-muted);margin-top:8px\">Page requests tracked</div>
              </div>
              <div class=\"card dna-card reveal\" style=\"animation-delay:0.2s; padding:24px; text-align:center;\">
                <div style=\"font-size:12px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:8px\">Latest Search</div>
                <div style=\"font-family:var(--font-display);font-size:20px;color:var(--accent-coral); margin-top:8px; word-wrap:break-word;\">{{ activity_logs|first ? activity_logs|first.targetId : 'Home Page' }}</div>
                <div style=\"font-size:12px;color:var(--text-muted);margin-top:8px\">Recent activity</div>
              </div>
            </div>

            <div class=\"panel reveal\" style=\"margin-bottom:32px\">
                <h3 style=\"font-family:var(--font-display);font-size:18px;margin-bottom:20px\">Recent Platform Activity</h3>
                <div style=\"display:flex;flex-direction:column;gap:12px\">
                {% for log in activity_logs %}
                    <div style=\"display:flex;justify-content:space-between;align-items:center;padding:12px;background:rgba(255,255,255,0.03);border-radius:8px;font-size:0.9rem\">
                        <div style=\"display:flex; gap:16px; align-items:center\">
                            <span class=\"badge {{ log.activityType == 'VISIT' ? 'badge-teal' : 'badge-coral' }}\" style=\"min-width:80px; text-align:center\">{{ log.activityType }}</span>
                            <span style=\"opacity:0.8\">{{ log.targetId }}</span>
                        </div>
                        <div style=\"font-size:0.8rem;opacity:0.5\">{{ log.timestamp|date('M d, H:i') }}</div>
                    </div>
                {% else %}
                    <div class=\"text-muted\">No activity data found.</div>
                {% endfor %}
                </div>
            </div>

            <div class=\"grid-2\" style=\"align-items:center;gap:40px\">
              <div style=\"display:flex;flex-direction:column;align-items:center; position:relative;\">
                <canvas id=\"travel-dna-chart\" width=\"280\" height=\"280\"></canvas>
                <div style=\"position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; pointer-events:none;\">
                    <div style=\"font-family:var(--font-display); font-size:40px; color:var(--accent-primary)\">{{ pageVisits }}</div>
                    <div style=\"font-size:10px; color:var(--text-muted); text-transform:uppercase;\">Visits</div>
                </div>
                <div style=\"margin-top:20px;text-align:center\">
                  <div style=\"font-family:var(--font-mono);font-size:11px;color:var(--text-muted)\">AI TRAVEL GENOME</div>
                  <div style=\"font-family:var(--font-display);font-size:24px;margin-top:4px\">{{ (preferences and preferences.stylePreferences) ? preferences.stylePreferences|split(',')|first : 'Classic' }} explorer</div>
                </div>
              </div>
              <div>
                <h3 style=\"margin-bottom:20px\">Behavioral DNA Report</h3>
                <div style=\"display:flex;flex-direction:column;gap:14px\">
                  <div>
                    <div style=\"display:flex;justify-content:space-between;margin-bottom:6px\">
                      <span style=\"font-size:0.9rem;opacity:0.7\">Onboarding Completion</span>
                      <span style=\"font-family:var(--font-mono);font-size:11px;color:var(--accent-primary)\">100%</span>
                    </div>
                    <div class=\"progress-bar\"><div class=\"progress-fill\" style=\"width:100%\"></div></div>
                  </div>
                  <div>
                    <div style=\"display:flex;justify-content:space-between;margin-bottom:6px\">
                      <span style=\"font-size:0.9rem;opacity:0.7\">Site Engagement</span>
                      <span style=\"font-family:var(--font-mono);font-size:11px;color:var(--accent-primary)\">{{ (pageVisits * 2)|default(0) }}%</span>
                    </div>
                    <div class=\"progress-bar\"><div class=\"progress-fill\" style=\"width:{{ (pageVisits * 2)|default(20) }}%\"></div></div>
                  </div>
                </div>
              </div>
            </div>
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
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:rgba(0,200,150,0.06);border-radius:var(--border-radius-md);border:1px solid rgba(0,200,150,0.2)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">Two-Factor Authentication</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Enabled via Authenticator App ✓</div></div>
                <span class=\"badge badge-teal\">Active</span>
              </div>
              <div style=\"display:flex;justify-content:space-between;align-items:center;padding:16px;background:var(--bg-surface);border-radius:var(--border-radius-md);border:1px solid var(--border-color)\">
                <div><div style=\"font-weight:600;margin-bottom:4px\">AI Data Training</div><div style=\"font-size:0.8rem;color:var(--text-muted)\">Control what ARIA learns from your behavior</div></div>
                <button class=\"btn btn-secondary btn-sm\">Manage Privacy</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</div>

<div class=\"toast\" id=\"profileToast\" style=\"display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:var(--navy); color:#fff; padding:12px 24px; border-radius:50px; z-index:9999; font-weight:500; font-size:0.9rem; box-shadow:0 10px 30px rgba(0,0,0,0.2); transition:opacity 0.3s; opacity:0;\">
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

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">✦</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">✦</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">Personalized for {{ user.firstName }}</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);cursor:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hey {{ user.firstName }}! Based on your Travel DNA, I think you'd absolutely love the Faroe Islands next. Want me to build you an itinerary? 🏔️</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA...\">
    <button class=\"aria-send\" id=\"aria-send\" data-track=\"AI_ARIA_CHAT\" data-track-type=\"AI_FEATURE\">➤</button>
  </div>
</div>
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const pwdSection = document.getElementById('password-change-section');
    if (toggleBtn && pwdSection) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = pwdSection.style.display === 'none';
            pwdSection.style.display = isHidden ? 'block' : 'none';
            if (isHidden) pwdSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Chart.js - Travel DNA
    const ctx = document.getElementById('travel-dna-chart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Visits', 'Searches', 'Bookings', 'Social'],
                datasets: [{
                    data: [
                        {{ activityStats.VISIT|default(0) }}, 
                        {{ activityStats.SEARCH|default(0) }}, 
                        {{ activityStats.BOOKING|default(0) }}, 
                        {{ activityStats.SOCIAL|default(0) }}
                    ],
                    backgroundColor: ['#00a6ed', '#ff4d6d', '#00c896', '#7209b7'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: '80%',
                plugins: { legend: { display: false } }
            }
        });
    }

    // Save Changes
    document.getElementById('saveProfileBtn')?.addEventListener('click', () => {
        const data = {
            firstName: document.querySelector('input[value=\"{{ user.firstName }}\"]')?.value || '{{ user.firstName }}',
            lastName: document.querySelector('input[value=\"{{ user.lastName }}\"]')?.value || '{{ user.lastName }}',
            email: document.querySelector('input[value=\"{{ user.email }}\"]')?.value || '{{ user.email }}',
            bio: document.querySelector('textarea')?.value
        };

        fetch('/profile/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(r => r.json())
        .then(res => {
            const toast = document.getElementById('profileToast');
            const msg = document.getElementById('toastMsg');
            toast.style.display = 'block';
            
            if (res.success) {
                msg.innerHTML = '<i class=\"fas fa-check-circle\" style=\"color:#10b981; margin-right:8px;\"></i> Profile updated successfully!';
            } else {
                msg.innerHTML = '<i class=\"fas fa-times-circle\" style=\"color:#ef4444; margin-right:8px;\"></i> Failed to update profile.';
            }
            
            // Fade in
            setTimeout(() => toast.style.opacity = '1', 10);
            
            // Fade out
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.style.display = 'none', 300);
            }, 3000);
        });
    });

    document.getElementById('confirmPasswordBtn')?.addEventListener('click', () => {
        const p1 = document.getElementById('new_password').value;
        const p2 = document.getElementById('confirm_password').value;
        if (p1 && p1 === p2) {
            fetch('/profile/password', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ password: p1 })
            })
            .then(r => r.json())
            .then(res => {
                const toast = document.getElementById('profileToast');
                const msg = document.getElementById('toastMsg');
                toast.style.display = 'block';
                
                if (res.success) {
                    msg.innerHTML = '<i class=\"fas fa-check-circle\" style=\"color:#10b981; margin-right:8px;\"></i> Password updated!';
                    pwdSection.style.display = 'none';
                    document.getElementById('new_password').value = '';
                    document.getElementById('confirm_password').value = '';
                } else {
                    msg.innerHTML = '<i class=\"fas fa-times-circle\" style=\"color:#ef4444; margin-right:8px;\"></i> Error updating password.';
                }
                
                setTimeout(() => toast.style.opacity = '1', 10);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.style.display = 'none', 300);
                }, 3000);
            });
        } else {
            const toast = document.getElementById('profileToast');
            const msg = document.getElementById('toastMsg');
            toast.style.display = 'block';
            msg.innerHTML = '<i class=\"fas fa-exclamation-triangle\" style=\"color:#f59e0b; margin-right:8px;\"></i> Passwords do not match.';
            setTimeout(() => toast.style.opacity = '1', 10);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.style.display = 'none', 300);
            }, 3000);
        }
    });
});
</script>
<script src=\"/assets.php?f=js/main.js\"></script>
</body>
</html>






", "front/users.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\users.html.twig");
    }
}
