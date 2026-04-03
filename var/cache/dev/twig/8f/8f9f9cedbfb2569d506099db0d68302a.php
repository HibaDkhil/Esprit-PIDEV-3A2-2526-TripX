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

/* admin/user_edit.html.twig */
class __TwigTemplate_b6a4ceed1181b4b035051695ab6b3185 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/user_edit.html.twig"));

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

        yield "Edit User — TripX Admin";
        
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
  <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" class=\"crumb\">Users</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">Edit ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 9, $this->source); })()), "firstName", [], "any", false, false, false, 9), "html", null, true);
        yield "</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 12
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 13
        yield "<div class=\"reveal\">
  ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "flashes", ["error"], "method", false, false, false, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 15
            yield "    <div style=\"margin-bottom:14px;padding:10px 12px;border-radius:8px;border:1px solid #ef4444;background:rgba(239,68,68,0.12);color:#ef4444\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        yield "  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Edit User</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Modify user details below.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 600px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 24, $this->source); })()), "userId", [], "any", false, false, false, 24)]), "html", null, true);
        yield "\" novalidate>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">First Name</label>
          <input type=\"text\" name=\"firstName\" value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 28, $this->source); })()), "firstName", [], "any", false, false, false, 28), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>

        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Last Name</label>
          <input type=\"text\" name=\"lastName\" value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 33, $this->source); })()), "lastName", [], "any", false, false, false, 33), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>

        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Email</label>
          <input type=\"email\" name=\"email\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 38, $this->source); })()), "email", [], "any", false, false, false, 38), "html", null, true);
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Role</label>
          <select name=\"role\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
            <option value=\"user\" ";
        // line 44
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 44, $this->source); })()), "role", [], "any", false, false, false, 44) == "user")) {
            yield "selected";
        }
        yield ">User</option>
            <option value=\"admin\" ";
        // line 45
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 45, $this->source); })()), "role", [], "any", false, false, false, 45) == "admin")) {
            yield "selected";
        }
        yield ">Super Admin</option>
            <option value=\"adminDestination\" ";
        // line 46
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 46, $this->source); })()), "role", [], "any", false, false, false, 46) == "adminDestination")) {
            yield "selected";
        }
        yield ">Destinations Admin</option>
            <option value=\"adminAccomodation\" ";
        // line 47
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 47, $this->source); })()), "role", [], "any", false, false, false, 47) == "adminAccomodation")) {
            yield "selected";
        }
        yield ">Accommodations Admin</option>
            <option value=\"adminOffers\" ";
        // line 48
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 48, $this->source); })()), "role", [], "any", false, false, false, 48) == "adminOffers")) {
            yield "selected";
        }
        yield ">Offers Admin</option>
            <option value=\"adminBlog\" ";
        // line 49
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 49, $this->source); })()), "role", [], "any", false, false, false, 49) == "adminBlog")) {
            yield "selected";
        }
        yield ">Blog Admin</option>
            <option value=\"adminTransport\" ";
        // line 50
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_user"]) || array_key_exists("target_user", $context) ? $context["target_user"] : (function () { throw new RuntimeError('Variable "target_user" does not exist.', 50, $this->source); })()), "role", [], "any", false, false, false, 50) == "adminTransport")) {
            yield "selected";
        }
        yield ">Transport Admin</option>
          </select>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Changes</button>
          <a href=\"";
        // line 56
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" class=\"btn btn-secondary\" style=\"flex:1; text-align:center;\">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function (el) {
    el.addEventListener('invalid', function () {
      if (el.validity.valueMissing) el.setCustomValidity('Please fill out this field.');
      else if (el.validity.typeMismatch) el.setCustomValidity('Please enter a valid value.');
    });
    el.addEventListener('input', function () { el.setCustomValidity(''); });
  });
});
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/user_edit.html.twig";
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
        return array (  221 => 56,  210 => 50,  204 => 49,  198 => 48,  192 => 47,  186 => 46,  180 => 45,  174 => 44,  165 => 38,  157 => 33,  149 => 28,  142 => 24,  133 => 17,  124 => 15,  120 => 14,  117 => 13,  107 => 12,  97 => 9,  92 => 7,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}Edit User — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <a href=\"{{ path('admin_users') }}\" class=\"crumb\">Users</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">Edit {{ target_user.firstName }}</span>
{% endblock %}

{% block content %}
<div class=\"reveal\">
  {% for message in app.flashes('error') %}
    <div style=\"margin-bottom:14px;padding:10px 12px;border-radius:8px;border:1px solid #ef4444;background:rgba(239,68,68,0.12);color:#ef4444\">{{ message }}</div>
  {% endfor %}
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Edit User</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Modify user details below.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 600px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"{{ path('admin_user_edit', {id: target_user.userId}) }}\" novalidate>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">First Name</label>
          <input type=\"text\" name=\"firstName\" value=\"{{ target_user.firstName }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>

        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Last Name</label>
          <input type=\"text\" name=\"lastName\" value=\"{{ target_user.lastName }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>

        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Email</label>
          <input type=\"email\" name=\"email\" value=\"{{ target_user.email }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Role</label>
          <select name=\"role\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
            <option value=\"user\" {% if target_user.role == 'user' %}selected{% endif %}>User</option>
            <option value=\"admin\" {% if target_user.role == 'admin' %}selected{% endif %}>Super Admin</option>
            <option value=\"adminDestination\" {% if target_user.role == 'adminDestination' %}selected{% endif %}>Destinations Admin</option>
            <option value=\"adminAccomodation\" {% if target_user.role == 'adminAccomodation' %}selected{% endif %}>Accommodations Admin</option>
            <option value=\"adminOffers\" {% if target_user.role == 'adminOffers' %}selected{% endif %}>Offers Admin</option>
            <option value=\"adminBlog\" {% if target_user.role == 'adminBlog' %}selected{% endif %}>Blog Admin</option>
            <option value=\"adminTransport\" {% if target_user.role == 'adminTransport' %}selected{% endif %}>Transport Admin</option>
          </select>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Changes</button>
          <a href=\"{{ path('admin_users') }}\" class=\"btn btn-secondary\" style=\"flex:1; text-align:center;\">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function (el) {
    el.addEventListener('invalid', function () {
      if (el.validity.valueMissing) el.setCustomValidity('Please fill out this field.');
      else if (el.validity.typeMismatch) el.setCustomValidity('Please enter a valid value.');
    });
    el.addEventListener('input', function () { el.setCustomValidity(''); });
  });
});
</script>
{% endblock %}
", "admin/user_edit.html.twig", "C:\\Sym\\templates\\admin\\user_edit.html.twig");
    }
}
