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

/* admin/admin_base.html.twig */
class __TwigTemplate_326dfc6e0658ddbdad9d01a254cec847 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'page_styles' => [$this, 'block_page_styles'],
            'body' => [$this, 'block_body'],
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
            'page_scripts' => [$this, 'block_page_scripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_base.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Admin — TripX";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    /* ── Hide user navbar ── */
    nav.nav#main-nav { display: none !important; }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      background-color: var(--bg-surface);
      padding-top: 0 !important;
      margin-top: 0 !important;
      overflow: hidden;
    }

    /* ══════════════════════════════════════
       LAYOUT SHELL
    ══════════════════════════════════════ */
    .admin-shell {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    /* ══════════════════════════════════════
       SIDEBAR
    ══════════════════════════════════════ */
    .sidebar {
      width: 260px;
      min-width: 260px;
      background: var(--bg-card);
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      transition: width 0.35s cubic-bezier(.4,0,.2,1), min-width 0.35s cubic-bezier(.4,0,.2,1);
      overflow: hidden;
      position: relative;
      z-index: 100;
    }
    .sidebar.collapsed {
      width: 68px;
      min-width: 68px;
    }

    /* Brand */
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 24px 16px 20px;
      border-bottom: 1px solid var(--border-color);
      white-space: nowrap;
      overflow: hidden;
      min-height: 72px;
      flex-shrink: 0;
      position: relative;
    }
    .sidebar-brand img {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      flex-shrink: 0;
      object-fit: contain;
    }
    .sidebar-brand .brand-text {
      font-family: var(--font-display);
      font-size: 20px;
      font-weight: 700;
      opacity: 1;
      transition: opacity 0.2s ease, width 0.2s ease;
      overflow: hidden;
      white-space: nowrap;
      flex: 1;
    }
    .sidebar-brand .brand-text span { color: var(--accent-primary); }
    .sidebar.collapsed .brand-text { opacity: 0; width: 0; }

    /* Toggle button */
    .sidebar-toggle {
      width: 32px;
      height: 32px;
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 4px;
      transition: background 0.2s, border-color 0.2s;
      flex-shrink: 0;
      position: relative;
      z-index: 10;
    }
    .sidebar-toggle:hover { background: var(--accent-primary); border-color: var(--accent-primary); }
    .sidebar-toggle:hover .bar { background: #fff; }
    .bar {
      display: block;
      width: 14px;
      height: 2px;
      background: var(--text-muted);
      border-radius: 2px;
      transition: background 0.2s;
    }

    /* When collapsed, center the toggle inside the brand row */
    .sidebar.collapsed .sidebar-brand {
      justify-content: center;
      padding: 20px 0;
    }
    .sidebar.collapsed .sidebar-brand img { display: none; }

    /* Nav scroll area */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 16px 10px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      scroll-behavior: smooth;
    }
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

    /* Section labels */
    .nav-section-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      padding: 12px 10px 6px;
      opacity: 1;
      transition: opacity 0.2s ease, height 0.2s ease, padding 0.2s ease;
      white-space: nowrap;
      overflow: hidden;
    }
    .sidebar.collapsed .nav-section-label { opacity: 0; height: 0; padding: 0; }

    /* Nav items */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 10px;
      text-decoration: none;
      color: var(--text-muted);
      font-size: 14px;
      font-weight: 500;
      transition: background 0.2s, color 0.2s, padding 0.35s cubic-bezier(.4,0,.2,1);
      white-space: nowrap;
      overflow: hidden;
      position: relative;
      cursor: pointer;
    }
    .nav-item:hover {
      background: rgba(0,166,237,0.08);
      color: var(--accent-primary);
    }
    .nav-item.active {
      background: rgba(0,166,237,0.12);
      color: var(--accent-primary);
      font-weight: 600;
    }
    .nav-item.active::before {
      content: '';
      position: absolute;
      left: 0; top: 20%; bottom: 20%;
      width: 3px;
      background: var(--accent-primary);
      border-radius: 0 3px 3px 0;
    }
    .nav-icon {
      font-size: 18px;
      flex-shrink: 0;
      width: 22px;
      text-align: center;
    }
    .nav-label {
      opacity: 1;
      transition: opacity 0.2s ease;
      overflow: hidden;
    }
    .sidebar.collapsed .nav-label { opacity: 0; width: 0; }
    .sidebar.collapsed .nav-item { padding: 10px 14px; justify-content: center; }

    /* Tooltip on collapsed */
    .sidebar.collapsed .nav-item::after {
      content: attr(data-label);
      position: absolute;
      left: calc(100% + 12px);
      top: 50%;
      transform: translateY(-50%);
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      color: var(--text-primary, #fff);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 500;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.15s ease;
      z-index: 999;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .sidebar.collapsed .nav-item:hover::after { opacity: 1; }

    /* Sidebar footer */
    .sidebar-footer {
      padding: 16px 10px;
      border-top: 1px solid var(--border-color);
      flex-shrink: 0;
    }

    /* ══════════════════════════════════════
       RIGHT COLUMN
    ══════════════════════════════════════ */
    .admin-right {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      min-width: 0;
    }

    /* ══════════════════════════════════════
       TOP BAR
    ══════════════════════════════════════ */
    .topbar {
      height: 64px;
      min-height: 64px;
      background: var(--bg-card);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      gap: 16px;
      flex-shrink: 0;
    }
    .breadcrumbs {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--text-muted);
    }
    .breadcrumbs .crumb { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
    .breadcrumbs .crumb:hover { color: var(--accent-primary); }
    .breadcrumbs .crumb.active { color: var(--accent-primary); font-weight: 600; }
    .breadcrumbs .sep { opacity: 0.4; font-size: 11px; }
    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .topbar-btn {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: transparent;
      border: 1px solid var(--border-color);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      color: var(--text-muted);
      transition: background 0.2s, color 0.2s, border-color 0.2s;
      text-decoration: none;
    }
    .topbar-btn:hover {
      background: rgba(0,166,237,0.1);
      color: var(--accent-primary);
      border-color: var(--accent-primary);
    }
    .topbar-divider { width: 1px; height: 28px; background: var(--border-color); margin: 0 4px; }
    .profile-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 6px 14px 6px 8px;
      background: rgba(0,166,237,0.08);
      border: 1px solid rgba(0,166,237,0.25);
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s, border-color 0.2s;
    }
    .profile-btn:hover { background: rgba(0,166,237,0.15); border-color: var(--accent-primary); }
    .profile-avatar {
      width: 30px; height: 30px;
      border-radius: 8px;
      background: var(--accent-primary);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .profile-name { font-size: 13px; font-weight: 600; color: var(--accent-primary); }
    .profile-role { font-size: 11px; color: var(--text-muted); }
    .logout-btn {
      display: flex; align-items: center; gap: 7px;
      padding: 7px 14px;
      border-radius: 10px;
      background: rgba(239,68,68,0.08);
      border: 1px solid rgba(239,68,68,0.2);
      color: #ef4444; font-size: 13px; font-weight: 500;
      cursor: pointer; text-decoration: none;
      transition: background 0.2s, border-color 0.2s;
    }
    .logout-btn:hover { background: rgba(239,68,68,0.15); border-color: #ef4444; }

    /* ══════════════════════════════════════
       MAIN CONTENT AREA
    ══════════════════════════════════════ */
    .admin-main {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 36px 40px;
      scroll-behavior: smooth;
    }
    .admin-main::-webkit-scrollbar { width: 6px; }
    .admin-main::-webkit-scrollbar-track { background: transparent; }
    .admin-main::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .admin-main::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

    ";
        // line 340
        yield from $this->unwrap()->yieldBlock('page_styles', $context, $blocks);
        // line 341
        yield "  </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 340
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_styles"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 344
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 345
        yield "<div class=\"admin-shell\">

  <!-- ════════ SIDEBAR ════════ -->
  <aside class=\"sidebar\" id=\"admin-sidebar\">

    <div class=\"sidebar-brand\">
      <img src=\"/images/tripx-logo.png\" alt=\"TripX Logo\"
           onerror=\"this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 34 34%22><rect width=%2234%22 height=%2234%22 rx=%228%22 fill=%22%2300a6ed%22/><text x=%2217%22 y=%2223%22 text-anchor=%22middle%22 font-size=%2216%22 font-weight=%22bold%22 fill=%22white%22 font-family=%22sans-serif%22>TX</text></svg>'\">
      <span class=\"brand-text\"><span>Trip</span>X Admin</span>
      <button class=\"sidebar-toggle\" id=\"sidebar-toggle\" title=\"Toggle sidebar\">
        <span class=\"bar\"></span>
        <span class=\"bar\"></span>
        <span class=\"bar\"></span>
      </button>
    </div>

    <nav class=\"sidebar-nav\">
      <span class=\"nav-section-label\">Main</span>
      <a href=\"";
        // line 363
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"nav-item ";
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 363, $this->source); })()), "request", [], "any", false, false, false, 363), "get", ["_route"], "method", false, false, false, 363) == "admin_dashboard")) {
            yield "active";
        }
        yield "\" data-label=\"Overview\">
        <span class=\"nav-icon\">📊</span><span class=\"nav-label\">Overview</span>
      </a>
      ";
        // line 366
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 367
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 367, $this->source); })()), "request", [], "any", false, false, false, 367), "get", ["_route"], "method", false, false, false, 367) == "admin_users")) {
                yield "active";
            }
            yield "\" data-label=\"Users\">
        <span class=\"nav-icon\">👥</span><span class=\"nav-label\">Users</span>
      </a>
      ";
        }
        // line 371
        yield "
      <span class=\"nav-section-label\">Content</span>
      ";
        // line 373
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_DESTINATION"))) {
            // line 374
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destinations");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 374, $this->source); })()), "request", [], "any", false, false, false, 374), "get", ["_route"], "method", false, false, false, 374) == "admin_destinations")) {
                yield "active";
            }
            yield "\" data-label=\"Destinations\">
        <span class=\"nav-icon\">🌍</span><span class=\"nav-label\">Destinations</span>
      </a>
      <a href=\"";
            // line 377
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_activities");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 377, $this->source); })()), "request", [], "any", false, false, false, 377), "get", ["_route"], "method", false, false, false, 377) == "admin_activities")) {
                yield "active";
            }
            yield "\" data-label=\"Activities\">
        <span class=\"nav-icon\">🧗</span><span class=\"nav-label\">Activities</span>
      </a>
      ";
        }
        // line 381
        yield "
      ";
        // line 382
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_ACCOMODATION"))) {
            // line 383
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_accommodations");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 383, $this->source); })()), "request", [], "any", false, false, false, 383), "get", ["_route"], "method", false, false, false, 383) == "admin_accommodations")) {
                yield "active";
            }
            yield "\" data-label=\"Accommodations\">
        <span class=\"nav-icon\">🏨</span><span class=\"nav-label\">Accommodations</span>
      </a>
      ";
        }
        // line 387
        yield "
      ";
        // line 388
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_TRANSPORT"))) {
            // line 389
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_transport");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 389, $this->source); })()), "request", [], "any", false, false, false, 389), "get", ["_route"], "method", false, false, false, 389) == "admin_transport")) {
                yield "active";
            }
            yield "\" data-label=\"Transport\">
        <span class=\"nav-icon\">✈️</span><span class=\"nav-label\">Transport</span>
      </a>
      ";
        }
        // line 393
        yield "
      <span class=\"nav-section-label\">Marketing</span>
      ";
        // line 395
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_OFFERS"))) {
            // line 396
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_offers");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 396, $this->source); })()), "request", [], "any", false, false, false, 396), "get", ["_route"], "method", false, false, false, 396) == "admin_offers")) {
                yield "active";
            }
            yield "\" data-label=\"Offers\">
        <span class=\"nav-icon\">🎟️</span><span class=\"nav-label\">Offers</span>
      </a>
      ";
        }
        // line 400
        yield "
      ";
        // line 401
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_BLOG"))) {
            // line 402
            yield "      <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_blog");
            yield "\" class=\"nav-item ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 402, $this->source); })()), "request", [], "any", false, false, false, 402), "get", ["_route"], "method", false, false, false, 402) == "admin_blog")) {
                yield "active";
            }
            yield "\" data-label=\"Blog\">
        <span class=\"nav-icon\">📝</span><span class=\"nav-label\">Blog</span>
      </a>
      ";
        }
        // line 406
        yield "    </nav>

    <div class=\"sidebar-footer\">
      <button class=\"nav-item\" id=\"theme-toggle-dash\" data-label=\"Toggle Theme\" style=\"width:100%;background:none;border:none;text-align:left;\">
        <span class=\"nav-icon\">🌙</span>
        <span class=\"nav-label\">Toggle Theme</span>
      </button>
    </div>
  </aside>

  <!-- ════════ RIGHT COLUMN ════════ -->
  <div class=\"admin-right\">

    <!-- TOP BAR -->
    <header class=\"topbar\">
      <nav class=\"breadcrumbs\" aria-label=\"breadcrumb\">
        <a href=\"";
        // line 422
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"crumb\">🏠 Home</a>
        <span class=\"sep\">›</span>
        ";
        // line 424
        yield from $this->unwrap()->yieldBlock('breadcrumbs', $context, $blocks);
        // line 427
        yield "      </nav>
      <div class=\"topbar-actions\">
        <a href=\"#\" class=\"topbar-btn\" title=\"Settings\">⚙️</a>
        <a href=\"#\" class=\"topbar-btn\" title=\"Notifications\">🔔</a>
        <div class=\"topbar-divider\"></div>
        <a href=\"";
        // line 432
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile");
        yield "\" class=\"profile-btn\" style=\"text-decoration:none; color:inherit;\">
          <div class=\"profile-avatar\">";
        // line 433
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 433, $this->source); })()), "user", [], "any", false, false, false, 433), "firstName", [], "any", false, false, false, 433))), "html", null, true);
        yield "</div>
          <div>
            <div class=\"profile-name\">";
        // line 435
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 435, $this->source); })()), "user", [], "any", false, false, false, 435), "firstName", [], "any", false, false, false, 435), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 435, $this->source); })()), "user", [], "any", false, false, false, 435), "lastName", [], "any", false, false, false, 435), "html", null, true);
        yield "</div>
            <div class=\"profile-role\">
              ";
        // line 437
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "Super Admin
              ";
        } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_DESTINATION")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 438
            yield "Destinations Admin
              ";
        } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_ACCOMODATION")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 439
            yield "Accommodations Admin
              ";
        } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_OFFERS")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 440
            yield "Offers Admin
              ";
        } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_BLOG")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 441
            yield "Blog Admin
              ";
        } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN_TRANSPORT")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 442
            yield "Transport Admin
              ";
        } else {
            // line 443
            yield "User
              ";
        }
        // line 445
        yield "            </div>
          </div>
        </a>
        <a href=\"";
        // line 448
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
          <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
          <div class=\"text\">Logout</div>
        </a>
      </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class=\"admin-main\">
      ";
        // line 457
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 457, $this->source); })()), "flashes", [], "any", false, false, false, 457));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 458
            yield "          <div class=\"flash-container\">
              ";
            // line 459
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 460
                yield "                  <div class=\"flash-message ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">
                      ";
                // line 461
                if (($context["label"] == "success")) {
                    yield "✅";
                } else {
                    yield "❌";
                }
                // line 462
                yield "                      ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                  </div>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 465
            yield "          </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 467
        yield "      ";
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 468
        yield "    </main>

  </div>
</div>

<script src=\"/assets.php?f=js/main.js\"></script>
<script>
  const sidebar   = document.getElementById('admin-sidebar');
  const toggleBtn = document.getElementById('sidebar-toggle');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
  });

  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
  }

  const themeBtn = document.getElementById('theme-toggle-dash');
  themeBtn?.addEventListener('click', () => {
    const html = document.documentElement;
    const isLight = html.getAttribute('data-theme') === 'light';
    html.setAttribute('data-theme', isLight ? 'dark' : 'light');
    themeBtn.querySelector('.nav-icon').textContent = isLight ? '☀️' : '🌙';
  });

  // ─── Instant Search ───
  const searchInput = document.querySelector('.input-search');
  const tableRows = document.querySelectorAll('.dest-table tbody tr');
  
  if (searchInput && tableRows.length > 0) {
    searchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      tableRows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(q) ? '' : 'none';
      });
    });
  }

  // ─── Table Sorting ───
  document.querySelectorAll('.dest-table th').forEach((th, index) => {
    if (th.innerText === 'Actions') return;
    th.style.cursor = 'pointer';
    th.title = 'Click to sort';
    th.addEventListener('click', () => {
      const table = th.closest('table');
      const tbody = table.querySelector('tbody');
      const rows = Array.from(tbody.querySelectorAll('tr'));
      const isAsc = th.classList.contains('sort-asc');
      
      rows.sort((a, b) => {
        const aVal = a.cells[index].innerText.trim();
        const bVal = b.cells[index].innerText.trim();
        return isAsc ? bVal.localeCompare(aVal, undefined, {numeric: true}) : aVal.localeCompare(bVal, undefined, {numeric: true});
      });
      
      th.classList.toggle('sort-asc', !isAsc);
      th.classList.toggle('sort-desc', isAsc);
      rows.forEach(row => tbody.appendChild(row));
    });
  });
</script>
";
        // line 532
        yield from $this->unwrap()->yieldBlock('page_scripts', $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 424
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 425
        yield "          <span class=\"crumb active\">Dashboard</span>
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 467
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 532
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_scripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_scripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/admin_base.html.twig";
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
        return array (  849 => 532,  833 => 467,  824 => 425,  814 => 424,  806 => 532,  740 => 468,  737 => 467,  730 => 465,  720 => 462,  714 => 461,  709 => 460,  705 => 459,  702 => 458,  698 => 457,  686 => 448,  681 => 445,  677 => 443,  673 => 442,  669 => 441,  665 => 440,  661 => 439,  657 => 438,  652 => 437,  645 => 435,  640 => 433,  636 => 432,  629 => 427,  627 => 424,  622 => 422,  604 => 406,  592 => 402,  590 => 401,  587 => 400,  575 => 396,  573 => 395,  569 => 393,  557 => 389,  555 => 388,  552 => 387,  540 => 383,  538 => 382,  535 => 381,  524 => 377,  513 => 374,  511 => 373,  507 => 371,  495 => 367,  493 => 366,  483 => 363,  463 => 345,  453 => 344,  437 => 340,  428 => 341,  426 => 340,  90 => 6,  80 => 5,  63 => 3,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Admin — TripX{% endblock %}

{% block stylesheets %}
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    /* ── Hide user navbar ── */
    nav.nav#main-nav { display: none !important; }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      background-color: var(--bg-surface);
      padding-top: 0 !important;
      margin-top: 0 !important;
      overflow: hidden;
    }

    /* ══════════════════════════════════════
       LAYOUT SHELL
    ══════════════════════════════════════ */
    .admin-shell {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    /* ══════════════════════════════════════
       SIDEBAR
    ══════════════════════════════════════ */
    .sidebar {
      width: 260px;
      min-width: 260px;
      background: var(--bg-card);
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      transition: width 0.35s cubic-bezier(.4,0,.2,1), min-width 0.35s cubic-bezier(.4,0,.2,1);
      overflow: hidden;
      position: relative;
      z-index: 100;
    }
    .sidebar.collapsed {
      width: 68px;
      min-width: 68px;
    }

    /* Brand */
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 24px 16px 20px;
      border-bottom: 1px solid var(--border-color);
      white-space: nowrap;
      overflow: hidden;
      min-height: 72px;
      flex-shrink: 0;
      position: relative;
    }
    .sidebar-brand img {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      flex-shrink: 0;
      object-fit: contain;
    }
    .sidebar-brand .brand-text {
      font-family: var(--font-display);
      font-size: 20px;
      font-weight: 700;
      opacity: 1;
      transition: opacity 0.2s ease, width 0.2s ease;
      overflow: hidden;
      white-space: nowrap;
      flex: 1;
    }
    .sidebar-brand .brand-text span { color: var(--accent-primary); }
    .sidebar.collapsed .brand-text { opacity: 0; width: 0; }

    /* Toggle button */
    .sidebar-toggle {
      width: 32px;
      height: 32px;
      background: var(--bg-surface);
      border: 1px solid var(--border-color);
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 4px;
      transition: background 0.2s, border-color 0.2s;
      flex-shrink: 0;
      position: relative;
      z-index: 10;
    }
    .sidebar-toggle:hover { background: var(--accent-primary); border-color: var(--accent-primary); }
    .sidebar-toggle:hover .bar { background: #fff; }
    .bar {
      display: block;
      width: 14px;
      height: 2px;
      background: var(--text-muted);
      border-radius: 2px;
      transition: background 0.2s;
    }

    /* When collapsed, center the toggle inside the brand row */
    .sidebar.collapsed .sidebar-brand {
      justify-content: center;
      padding: 20px 0;
    }
    .sidebar.collapsed .sidebar-brand img { display: none; }

    /* Nav scroll area */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 16px 10px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      scroll-behavior: smooth;
    }
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

    /* Section labels */
    .nav-section-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      padding: 12px 10px 6px;
      opacity: 1;
      transition: opacity 0.2s ease, height 0.2s ease, padding 0.2s ease;
      white-space: nowrap;
      overflow: hidden;
    }
    .sidebar.collapsed .nav-section-label { opacity: 0; height: 0; padding: 0; }

    /* Nav items */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 10px;
      text-decoration: none;
      color: var(--text-muted);
      font-size: 14px;
      font-weight: 500;
      transition: background 0.2s, color 0.2s, padding 0.35s cubic-bezier(.4,0,.2,1);
      white-space: nowrap;
      overflow: hidden;
      position: relative;
      cursor: pointer;
    }
    .nav-item:hover {
      background: rgba(0,166,237,0.08);
      color: var(--accent-primary);
    }
    .nav-item.active {
      background: rgba(0,166,237,0.12);
      color: var(--accent-primary);
      font-weight: 600;
    }
    .nav-item.active::before {
      content: '';
      position: absolute;
      left: 0; top: 20%; bottom: 20%;
      width: 3px;
      background: var(--accent-primary);
      border-radius: 0 3px 3px 0;
    }
    .nav-icon {
      font-size: 18px;
      flex-shrink: 0;
      width: 22px;
      text-align: center;
    }
    .nav-label {
      opacity: 1;
      transition: opacity 0.2s ease;
      overflow: hidden;
    }
    .sidebar.collapsed .nav-label { opacity: 0; width: 0; }
    .sidebar.collapsed .nav-item { padding: 10px 14px; justify-content: center; }

    /* Tooltip on collapsed */
    .sidebar.collapsed .nav-item::after {
      content: attr(data-label);
      position: absolute;
      left: calc(100% + 12px);
      top: 50%;
      transform: translateY(-50%);
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      color: var(--text-primary, #fff);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 500;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.15s ease;
      z-index: 999;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .sidebar.collapsed .nav-item:hover::after { opacity: 1; }

    /* Sidebar footer */
    .sidebar-footer {
      padding: 16px 10px;
      border-top: 1px solid var(--border-color);
      flex-shrink: 0;
    }

    /* ══════════════════════════════════════
       RIGHT COLUMN
    ══════════════════════════════════════ */
    .admin-right {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      min-width: 0;
    }

    /* ══════════════════════════════════════
       TOP BAR
    ══════════════════════════════════════ */
    .topbar {
      height: 64px;
      min-height: 64px;
      background: var(--bg-card);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      gap: 16px;
      flex-shrink: 0;
    }
    .breadcrumbs {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--text-muted);
    }
    .breadcrumbs .crumb { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
    .breadcrumbs .crumb:hover { color: var(--accent-primary); }
    .breadcrumbs .crumb.active { color: var(--accent-primary); font-weight: 600; }
    .breadcrumbs .sep { opacity: 0.4; font-size: 11px; }
    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .topbar-btn {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: transparent;
      border: 1px solid var(--border-color);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      color: var(--text-muted);
      transition: background 0.2s, color 0.2s, border-color 0.2s;
      text-decoration: none;
    }
    .topbar-btn:hover {
      background: rgba(0,166,237,0.1);
      color: var(--accent-primary);
      border-color: var(--accent-primary);
    }
    .topbar-divider { width: 1px; height: 28px; background: var(--border-color); margin: 0 4px; }
    .profile-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 6px 14px 6px 8px;
      background: rgba(0,166,237,0.08);
      border: 1px solid rgba(0,166,237,0.25);
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s, border-color 0.2s;
    }
    .profile-btn:hover { background: rgba(0,166,237,0.15); border-color: var(--accent-primary); }
    .profile-avatar {
      width: 30px; height: 30px;
      border-radius: 8px;
      background: var(--accent-primary);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .profile-name { font-size: 13px; font-weight: 600; color: var(--accent-primary); }
    .profile-role { font-size: 11px; color: var(--text-muted); }
    .logout-btn {
      display: flex; align-items: center; gap: 7px;
      padding: 7px 14px;
      border-radius: 10px;
      background: rgba(239,68,68,0.08);
      border: 1px solid rgba(239,68,68,0.2);
      color: #ef4444; font-size: 13px; font-weight: 500;
      cursor: pointer; text-decoration: none;
      transition: background 0.2s, border-color 0.2s;
    }
    .logout-btn:hover { background: rgba(239,68,68,0.15); border-color: #ef4444; }

    /* ══════════════════════════════════════
       MAIN CONTENT AREA
    ══════════════════════════════════════ */
    .admin-main {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 36px 40px;
      scroll-behavior: smooth;
    }
    .admin-main::-webkit-scrollbar { width: 6px; }
    .admin-main::-webkit-scrollbar-track { background: transparent; }
    .admin-main::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
    .admin-main::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

    {% block page_styles %}{% endblock %}
  </style>
{% endblock %}

{% block body %}
<div class=\"admin-shell\">

  <!-- ════════ SIDEBAR ════════ -->
  <aside class=\"sidebar\" id=\"admin-sidebar\">

    <div class=\"sidebar-brand\">
      <img src=\"/images/tripx-logo.png\" alt=\"TripX Logo\"
           onerror=\"this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 34 34%22><rect width=%2234%22 height=%2234%22 rx=%228%22 fill=%22%2300a6ed%22/><text x=%2217%22 y=%2223%22 text-anchor=%22middle%22 font-size=%2216%22 font-weight=%22bold%22 fill=%22white%22 font-family=%22sans-serif%22>TX</text></svg>'\">
      <span class=\"brand-text\"><span>Trip</span>X Admin</span>
      <button class=\"sidebar-toggle\" id=\"sidebar-toggle\" title=\"Toggle sidebar\">
        <span class=\"bar\"></span>
        <span class=\"bar\"></span>
        <span class=\"bar\"></span>
      </button>
    </div>

    <nav class=\"sidebar-nav\">
      <span class=\"nav-section-label\">Main</span>
      <a href=\"{{ path('admin_dashboard') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_dashboard' %}active{% endif %}\" data-label=\"Overview\">
        <span class=\"nav-icon\">📊</span><span class=\"nav-label\">Overview</span>
      </a>
      {% if is_granted('ROLE_ADMIN') %}
      <a href=\"{{ path('admin_users') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_users' %}active{% endif %}\" data-label=\"Users\">
        <span class=\"nav-icon\">👥</span><span class=\"nav-label\">Users</span>
      </a>
      {% endif %}

      <span class=\"nav-section-label\">Content</span>
      {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION') %}
      <a href=\"{{ path('admin_destinations') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_destinations' %}active{% endif %}\" data-label=\"Destinations\">
        <span class=\"nav-icon\">🌍</span><span class=\"nav-label\">Destinations</span>
      </a>
      <a href=\"{{ path('admin_activities') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_activities' %}active{% endif %}\" data-label=\"Activities\">
        <span class=\"nav-icon\">🧗</span><span class=\"nav-label\">Activities</span>
      </a>
      {% endif %}

      {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_ACCOMODATION') %}
      <a href=\"{{ path('admin_accommodations') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_accommodations' %}active{% endif %}\" data-label=\"Accommodations\">
        <span class=\"nav-icon\">🏨</span><span class=\"nav-label\">Accommodations</span>
      </a>
      {% endif %}

      {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_TRANSPORT') %}
      <a href=\"{{ path('admin_transport') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_transport' %}active{% endif %}\" data-label=\"Transport\">
        <span class=\"nav-icon\">✈️</span><span class=\"nav-label\">Transport</span>
      </a>
      {% endif %}

      <span class=\"nav-section-label\">Marketing</span>
      {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_OFFERS') %}
      <a href=\"{{ path('admin_offers') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_offers' %}active{% endif %}\" data-label=\"Offers\">
        <span class=\"nav-icon\">🎟️</span><span class=\"nav-label\">Offers</span>
      </a>
      {% endif %}

      {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_BLOG') %}
      <a href=\"{{ path('admin_blog') }}\" class=\"nav-item {% if app.request.get('_route') == 'admin_blog' %}active{% endif %}\" data-label=\"Blog\">
        <span class=\"nav-icon\">📝</span><span class=\"nav-label\">Blog</span>
      </a>
      {% endif %}
    </nav>

    <div class=\"sidebar-footer\">
      <button class=\"nav-item\" id=\"theme-toggle-dash\" data-label=\"Toggle Theme\" style=\"width:100%;background:none;border:none;text-align:left;\">
        <span class=\"nav-icon\">🌙</span>
        <span class=\"nav-label\">Toggle Theme</span>
      </button>
    </div>
  </aside>

  <!-- ════════ RIGHT COLUMN ════════ -->
  <div class=\"admin-right\">

    <!-- TOP BAR -->
    <header class=\"topbar\">
      <nav class=\"breadcrumbs\" aria-label=\"breadcrumb\">
        <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">🏠 Home</a>
        <span class=\"sep\">›</span>
        {% block breadcrumbs %}
          <span class=\"crumb active\">Dashboard</span>
        {% endblock %}
      </nav>
      <div class=\"topbar-actions\">
        <a href=\"#\" class=\"topbar-btn\" title=\"Settings\">⚙️</a>
        <a href=\"#\" class=\"topbar-btn\" title=\"Notifications\">🔔</a>
        <div class=\"topbar-divider\"></div>
        <a href=\"{{ path('admin_profile') }}\" class=\"profile-btn\" style=\"text-decoration:none; color:inherit;\">
          <div class=\"profile-avatar\">{{ app.user.firstName|first|upper }}</div>
          <div>
            <div class=\"profile-name\">{{ app.user.firstName }} {{ app.user.lastName }}</div>
            <div class=\"profile-role\">
              {% if is_granted('ROLE_ADMIN') %}Super Admin
              {% elseif is_granted('ROLE_ADMIN_DESTINATION') %}Destinations Admin
              {% elseif is_granted('ROLE_ADMIN_ACCOMODATION') %}Accommodations Admin
              {% elseif is_granted('ROLE_ADMIN_OFFERS') %}Offers Admin
              {% elseif is_granted('ROLE_ADMIN_BLOG') %}Blog Admin
              {% elseif is_granted('ROLE_ADMIN_TRANSPORT') %}Transport Admin
              {% else %}User
              {% endif %}
            </div>
          </div>
        </a>
        <a href=\"{{ path('app_logout') }}\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
          <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
          <div class=\"text\">Logout</div>
        </a>
      </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class=\"admin-main\">
      {% for label, messages in app.flashes %}
          <div class=\"flash-container\">
              {% for message in messages %}
                  <div class=\"flash-message {{ label }}\">
                      {% if label == 'success' %}✅{% else %}❌{% endif %}
                      {{ message }}
                  </div>
              {% endfor %}
          </div>
      {% endfor %}
      {% block content %}{% endblock %}
    </main>

  </div>
</div>

<script src=\"/assets.php?f=js/main.js\"></script>
<script>
  const sidebar   = document.getElementById('admin-sidebar');
  const toggleBtn = document.getElementById('sidebar-toggle');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
  });

  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
  }

  const themeBtn = document.getElementById('theme-toggle-dash');
  themeBtn?.addEventListener('click', () => {
    const html = document.documentElement;
    const isLight = html.getAttribute('data-theme') === 'light';
    html.setAttribute('data-theme', isLight ? 'dark' : 'light');
    themeBtn.querySelector('.nav-icon').textContent = isLight ? '☀️' : '🌙';
  });

  // ─── Instant Search ───
  const searchInput = document.querySelector('.input-search');
  const tableRows = document.querySelectorAll('.dest-table tbody tr');
  
  if (searchInput && tableRows.length > 0) {
    searchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      tableRows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(q) ? '' : 'none';
      });
    });
  }

  // ─── Table Sorting ───
  document.querySelectorAll('.dest-table th').forEach((th, index) => {
    if (th.innerText === 'Actions') return;
    th.style.cursor = 'pointer';
    th.title = 'Click to sort';
    th.addEventListener('click', () => {
      const table = th.closest('table');
      const tbody = table.querySelector('tbody');
      const rows = Array.from(tbody.querySelectorAll('tr'));
      const isAsc = th.classList.contains('sort-asc');
      
      rows.sort((a, b) => {
        const aVal = a.cells[index].innerText.trim();
        const bVal = b.cells[index].innerText.trim();
        return isAsc ? bVal.localeCompare(aVal, undefined, {numeric: true}) : aVal.localeCompare(bVal, undefined, {numeric: true});
      });
      
      th.classList.toggle('sort-asc', !isAsc);
      th.classList.toggle('sort-desc', isAsc);
      rows.forEach(row => tbody.appendChild(row));
    });
  });
</script>
{% block page_scripts %}{% endblock %}
{% endblock %}
", "admin/admin_base.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\admin\\admin_base.html.twig");
    }
}
