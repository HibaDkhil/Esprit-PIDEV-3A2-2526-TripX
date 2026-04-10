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

/* admin/admin_profile.html.twig */
class __TwigTemplate_f7acc917bf238dc909e5ab3b2f05f1d5 extends Template
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
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/admin_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/admin_profile.html.twig"));

        $this->parent = $this->load("admin/admin_base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "My Profile — TripX Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 5
        yield "  <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">My Profile</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 11
        yield "<div class=\"reveal\">
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Admin Profile</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Manage your account settings and credentials.</p>
  </div>

  <div class=\"grid-2\" style=\"gap:24px;\">
    <div class=\"card reveal\" style=\"max-width: 600px;\">
      <div class=\"card-body\">
        <h3 style=\"margin-bottom:20px; font-family:var(--font-display);\">Personal Information</h3>
        <form method=\"post\" action=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile_update");
        yield "\">
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">First Name</label>
            <input type=\"text\" name=\"firstName\" value=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 25, $this->source); })()), "user", [], "any", false, false, false, 25), "firstName", [], "any", false, false, false, 25), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Last Name</label>
            <input type=\"text\" name=\"lastName\" value=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "user", [], "any", false, false, false, 30), "lastName", [], "any", false, false, false, 30), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Email</label>
            <input type=\"email\" name=\"email\" value=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "user", [], "any", false, false, false, 35), "email", [], "any", false, false, false, 35), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <button type=\"submit\" class=\"btn btn-primary\" style=\"margin-top:12px;\">Update Info</button>
        </form>
      </div>
    </div>

    <div class=\"card reveal\" style=\"max-width: 600px;\">
      <div class=\"card-body\">
        <h3 style=\"margin-bottom:20px; font-family:var(--font-display); color:var(--accent-coral);\">Change Password</h3>
        <form method=\"post\" action=\"";
        // line 46
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile_password");
        yield "\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">New Password</label>
            <input type=\"password\" name=\"new_password\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Confirm Password</label>
            <input type=\"password\" name=\"confirm_password\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <button type=\"submit\" class=\"btn btn-primary\" style=\"margin-top:12px;\">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/admin_profile.html.twig";
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
        return array (  158 => 46,  144 => 35,  136 => 30,  128 => 25,  121 => 21,  109 => 11,  99 => 10,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}My Profile — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">My Profile</span>
{% endblock %}

{% block content %}
<div class=\"reveal\">
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Admin Profile</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Manage your account settings and credentials.</p>
  </div>

  <div class=\"grid-2\" style=\"gap:24px;\">
    <div class=\"card reveal\" style=\"max-width: 600px;\">
      <div class=\"card-body\">
        <h3 style=\"margin-bottom:20px; font-family:var(--font-display);\">Personal Information</h3>
        <form method=\"post\" action=\"{{ path('admin_profile_update') }}\">
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">First Name</label>
            <input type=\"text\" name=\"firstName\" value=\"{{ app.user.firstName }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Last Name</label>
            <input type=\"text\" name=\"lastName\" value=\"{{ app.user.lastName }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Email</label>
            <input type=\"email\" name=\"email\" value=\"{{ app.user.email }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <button type=\"submit\" class=\"btn btn-primary\" style=\"margin-top:12px;\">Update Info</button>
        </form>
      </div>
    </div>

    <div class=\"card reveal\" style=\"max-width: 600px;\">
      <div class=\"card-body\">
        <h3 style=\"margin-bottom:20px; font-family:var(--font-display); color:var(--accent-coral);\">Change Password</h3>
        <form method=\"post\" action=\"{{ path('admin_profile_password') }}\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">New Password</label>
            <input type=\"password\" name=\"new_password\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Confirm Password</label>
            <input type=\"password\" name=\"confirm_password\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <button type=\"submit\" class=\"btn btn-primary\" style=\"margin-top:12px;\">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
{% endblock %}
", "admin/admin_profile.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\admin\\admin_profile.html.twig");
    }
}
