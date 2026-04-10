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

/* admin/profile.html.twig */
class __TwigTemplate_28c5730c4ddcd42846b238bf44ae4706 extends Template
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
            'page_styles' => [$this, 'block_page_styles'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/profile.html.twig"));

        $this->parent = $this->load("admin/admin_base.html.twig", 1);
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

        yield "My Profile — TripX Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 6
        yield "  <span class=\"crumb\">Dashboard</span>
  <span class=\"crumb active\">My Profile</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_styles"));

        // line 11
        yield "  .profile-container {
    max-width: 800px;
    margin: 0 auto;
  }
  .profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: 40px;
    box-shadow: var(--shadow-xl);
    position: relative;
    overflow: hidden;
  }
  .profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
  }
  .form-group {
    margin-bottom: 24px;
  }
  .form-label {
    display: block;
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--text-muted);
    text-transform: uppercase;
    margin-bottom: 8px;
    letter-spacing: 0.05em;
  }
  .form-input {
    width: 100%;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 12px 16px;
    color: var(--text-primary);
    font-family: inherit;
    transition: all 0.3s ease;
  }
  .form-input:focus {
    outline: none;
    border-color: var(--accent-primary);
    background: rgba(255,255,255,0.05);
    box-shadow: 0 0 0 4px rgba(0,166,237,0.1);
  }
  .profile-header {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 40px;
  }
  .profile-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 40px;
    color: white;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 82
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 83
        yield "<div class=\"profile-container reveal\">
  <div class=\"profile-card\">
    <div class=\"profile-header\">
      <div class=\"profile-avatar-large\">
        ";
        // line 87
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 87, $this->source); })()), "firstName", [], "any", false, false, false, 87))), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 87, $this->source); })()), "lastName", [], "any", false, false, false, 87))), "html", null, true);
        yield "
      </div>
      <div>
        <h1 class=\"display-sm\" style=\"margin-bottom:4px;\">";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 90, $this->source); })()), "firstName", [], "any", false, false, false, 90), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 90, $this->source); })()), "lastName", [], "any", false, false, false, 90), "html", null, true);
        yield "</h1>
        <p class=\"text-muted\">";
        // line 91
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 91, $this->source); })()), "email", [], "any", false, false, false, 91), "html", null, true);
        yield " • <span class=\"text-teal\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 91, $this->source); })()), "role", [], "any", false, false, false, 91)), "html", null, true);
        yield "</span></p>
      </div>
    </div>

    <form action=\"";
        // line 95
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile_update");
        yield "\" method=\"POST\" class=\"stagger\">
      <div class=\"grid-2\">
        <div class=\"form-group\">
          <label class=\"form-label\">First Name</label>
          <input type=\"text\" name=\"firstName\" value=\"";
        // line 99
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 99, $this->source); })()), "firstName", [], "any", false, false, false, 99), "html", null, true);
        yield "\" class=\"form-input\" required>
        </div>
        <div class=\"form-group\">
          <label class=\"form-label\">Last Name</label>
          <input type=\"text\" name=\"lastName\" value=\"";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 103, $this->source); })()), "lastName", [], "any", false, false, false, 103), "html", null, true);
        yield "\" class=\"form-input\" required>
        </div>
      </div>

      <div class=\"form-group\">
        <label class=\"form-label\">Email Address (Read-only)</label>
        <input type=\"email\" value=\"";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 109, $this->source); })()), "email", [], "any", false, false, false, 109), "html", null, true);
        yield "\" class=\"form-input\" disabled style=\"opacity:0.6; cursor:not-allowed;\">
      </div>

      <div class=\"form-group\" style=\"margin-top:40px;\">
        <h3 style=\"font-family:var(--font-display); font-size:18px; margin-bottom:20px;\">Security</h3>
        <label class=\"form-label\">New Password</label>
        <input type=\"password\" name=\"password\" placeholder=\"Leave blank to keep current password\" class=\"form-input\">
        <p style=\"font-size:11px; color:var(--text-muted); margin-top:8px;\">Min. 8 characters with a mix of letters and numbers.</p>
      </div>

      <div style=\"margin-top:40px; display:flex; gap:16px;\">
        <button type=\"submit\" class=\"btn btn-teal\">Save Changes</button>
        <a href=\"";
        // line 121
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"btn btn-secondary\">Cancel</a>
      </div>
    </form>
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
        return "admin/profile.html.twig";
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
        return array (  260 => 121,  245 => 109,  236 => 103,  229 => 99,  222 => 95,  213 => 91,  207 => 90,  200 => 87,  194 => 83,  184 => 82,  107 => 11,  97 => 10,  87 => 6,  77 => 5,  60 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}

{% block title %}My Profile — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <span class=\"crumb\">Dashboard</span>
  <span class=\"crumb active\">My Profile</span>
{% endblock %}

{% block page_styles %}
  .profile-container {
    max-width: 800px;
    margin: 0 auto;
  }
  .profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: 40px;
    box-shadow: var(--shadow-xl);
    position: relative;
    overflow: hidden;
  }
  .profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
  }
  .form-group {
    margin-bottom: 24px;
  }
  .form-label {
    display: block;
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--text-muted);
    text-transform: uppercase;
    margin-bottom: 8px;
    letter-spacing: 0.05em;
  }
  .form-input {
    width: 100%;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 12px 16px;
    color: var(--text-primary);
    font-family: inherit;
    transition: all 0.3s ease;
  }
  .form-input:focus {
    outline: none;
    border-color: var(--accent-primary);
    background: rgba(255,255,255,0.05);
    box-shadow: 0 0 0 4px rgba(0,166,237,0.1);
  }
  .profile-header {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 40px;
  }
  .profile-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 40px;
    color: white;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }
{% endblock %}

{% block content %}
<div class=\"profile-container reveal\">
  <div class=\"profile-card\">
    <div class=\"profile-header\">
      <div class=\"profile-avatar-large\">
        {{ user.firstName|first|upper }}{{ user.lastName|first|upper }}
      </div>
      <div>
        <h1 class=\"display-sm\" style=\"margin-bottom:4px;\">{{ user.firstName }} {{ user.lastName }}</h1>
        <p class=\"text-muted\">{{ user.email }} • <span class=\"text-teal\">{{ user.role|upper }}</span></p>
      </div>
    </div>

    <form action=\"{{ path('admin_profile_update') }}\" method=\"POST\" class=\"stagger\">
      <div class=\"grid-2\">
        <div class=\"form-group\">
          <label class=\"form-label\">First Name</label>
          <input type=\"text\" name=\"firstName\" value=\"{{ user.firstName }}\" class=\"form-input\" required>
        </div>
        <div class=\"form-group\">
          <label class=\"form-label\">Last Name</label>
          <input type=\"text\" name=\"lastName\" value=\"{{ user.lastName }}\" class=\"form-input\" required>
        </div>
      </div>

      <div class=\"form-group\">
        <label class=\"form-label\">Email Address (Read-only)</label>
        <input type=\"email\" value=\"{{ user.email }}\" class=\"form-input\" disabled style=\"opacity:0.6; cursor:not-allowed;\">
      </div>

      <div class=\"form-group\" style=\"margin-top:40px;\">
        <h3 style=\"font-family:var(--font-display); font-size:18px; margin-bottom:20px;\">Security</h3>
        <label class=\"form-label\">New Password</label>
        <input type=\"password\" name=\"password\" placeholder=\"Leave blank to keep current password\" class=\"form-input\">
        <p style=\"font-size:11px; color:var(--text-muted); margin-top:8px;\">Min. 8 characters with a mix of letters and numbers.</p>
      </div>

      <div style=\"margin-top:40px; display:flex; gap:16px;\">
        <button type=\"submit\" class=\"btn btn-teal\">Save Changes</button>
        <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-secondary\">Cancel</a>
      </div>
    </form>
  </div>
</div>
{% endblock %}
", "admin/profile.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\admin\\profile.html.twig");
    }
}
