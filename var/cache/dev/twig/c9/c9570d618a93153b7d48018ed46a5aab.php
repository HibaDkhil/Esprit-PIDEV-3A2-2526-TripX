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

/* admin/destination_form.html.twig */
class __TwigTemplate_188bd1e613325d3d3380ba5a6cae7f23 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/destination_form.html.twig"));

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

        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 2, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Edit") : ("Add"));
        yield " Destination — TripX Admin";
        
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destinations");
        yield "\" class=\"crumb\">Destinations</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">";
        // line 9
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 9, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("Edit " . CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 9, $this->source); })()), "name", [], "any", false, false, false, 9)), "html", null, true)) : ("Add Destination"));
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
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">";
        // line 15
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 15, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Edit") : ("Add"));
        yield " Destination</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Fill the details for the destination.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 800px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"";
        // line 21
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 21, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destination_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 21, $this->source); })()), "destinationId", [], "any", false, false, false, 21)]), "html", null, true)) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destination_add")));
        yield "\">
        
        <div style=\"display:grid; grid-template-columns:1fr 1fr; gap:20px;\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Name *</label>
            <input type=\"text\" name=\"name\" value=\"";
        // line 26
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 26, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 26, $this->source); })()), "name", [], "any", false, false, false, 26), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Country *</label>
            <input type=\"text\" name=\"country\" value=\"";
        // line 30
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 30, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 30, $this->source); })()), "country", [], "any", false, false, false, 30), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">City</label>
            <input type=\"text\" name=\"city\" value=\"";
        // line 34
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 34, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 34, $this->source); })()), "city", [], "any", false, false, false, 34), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Type *</label>
            <select name=\"type\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              ";
        // line 39
        $context["types"] = ["city", "beach", "mountain", "countryside", "desert", "island", "forest", "cruise", "other"];
        // line 40
        yield "              ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 40, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 41
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["t"], "html", null, true);
            yield "\" ";
            if (((isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 41, $this->source); })()) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 41, $this->source); })()), "type", [], "any", false, false, false, 41) == $context["t"]))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["t"]), "html", null, true);
            yield "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['t'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        yield "            </select>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Best Season *</label>
            <select name=\"bestSeason\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              ";
        // line 48
        $context["seasons"] = ["spring", "summer", "autumn", "winter", "all_year"];
        // line 49
        yield "              ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["seasons"]) || array_key_exists("seasons", $context) ? $context["seasons"] : (function () { throw new RuntimeError('Variable "seasons" does not exist.', 49, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
            // line 50
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["s"], "html", null, true);
            yield "\" ";
            if (((isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 50, $this->source); })()) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 50, $this->source); })()), "bestSeason", [], "any", false, false, false, 50) == $context["s"]))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["s"]), ["_" => " "]), "html", null, true);
            yield "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['s'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        yield "            </select>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Estimated Budget</label>
            <input type=\"number\" step=\"0.01\" name=\"estimatedBudget\" value=\"";
        // line 56
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 56, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 56, $this->source); })()), "estimatedBudget", [], "any", false, false, false, 56), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Image URL</label>
            <input type=\"text\" name=\"imageUrl\" value=\"";
        // line 60
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 60, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 60, $this->source); })()), "imageUrl", [], "any", false, false, false, 60), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Latitude</label>
            <input type=\"number\" step=\"0.00000001\" name=\"latitude\" value=\"";
        // line 64
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 64, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 64, $this->source); })()), "latitude", [], "any", false, false, false, 64), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Longitude</label>
            <input type=\"number\" step=\"0.00000001\" name=\"longitude\" value=\"";
        // line 68
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 68, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 68, $this->source); })()), "longitude", [], "any", false, false, false, 68), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Description</label>
          <textarea name=\"description\" rows=\"4\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">";
        // line 74
        yield (((($tmp = (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 74, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_destination"]) || array_key_exists("target_destination", $context) ? $context["target_destination"] : (function () { throw new RuntimeError('Variable "target_destination" does not exist.', 74, $this->source); })()), "description", [], "any", false, false, false, 74), "html", null, true)) : (""));
        yield "</textarea>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Destination</button>
          <a href=\"";
        // line 79
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destinations");
        yield "\" class=\"btn btn-secondary\" style=\"flex:1; text-align:center;\">Cancel</a>
        </div>
      </form>
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
        return "admin/destination_form.html.twig";
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
        return array (  256 => 79,  248 => 74,  239 => 68,  232 => 64,  225 => 60,  218 => 56,  212 => 52,  197 => 50,  192 => 49,  190 => 48,  183 => 43,  168 => 41,  163 => 40,  161 => 39,  153 => 34,  146 => 30,  139 => 26,  131 => 21,  122 => 15,  118 => 13,  108 => 12,  98 => 9,  93 => 7,  87 => 5,  77 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}{{ target_destination ? 'Edit' : 'Add' }} Destination — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <a href=\"{{ path('admin_destinations') }}\" class=\"crumb\">Destinations</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">{{ target_destination ? 'Edit ' ~ target_destination.name : 'Add Destination' }}</span>
{% endblock %}

{% block content %}
<div class=\"reveal\">
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">{{ target_destination ? 'Edit' : 'Add' }} Destination</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Fill the details for the destination.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 800px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"{{ target_destination ? path('admin_destination_edit', {id: target_destination.destinationId}) : path('admin_destination_add') }}\">
        
        <div style=\"display:grid; grid-template-columns:1fr 1fr; gap:20px;\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Name *</label>
            <input type=\"text\" name=\"name\" value=\"{{ target_destination ? target_destination.name : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Country *</label>
            <input type=\"text\" name=\"country\" value=\"{{ target_destination ? target_destination.country : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">City</label>
            <input type=\"text\" name=\"city\" value=\"{{ target_destination ? target_destination.city : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Type *</label>
            <select name=\"type\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              {% set types = ['city', 'beach', 'mountain', 'countryside', 'desert', 'island', 'forest', 'cruise', 'other'] %}
              {% for t in types %}
                <option value=\"{{ t }}\" {% if target_destination and target_destination.type == t %}selected{% endif %}>{{ t|capitalize }}</option>
              {% endfor %}
            </select>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Best Season *</label>
            <select name=\"bestSeason\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              {% set seasons = ['spring', 'summer', 'autumn', 'winter', 'all_year'] %}
              {% for s in seasons %}
                <option value=\"{{ s }}\" {% if target_destination and target_destination.bestSeason == s %}selected{% endif %}>{{ s|capitalize|replace({'_': ' '}) }}</option>
              {% endfor %}
            </select>
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Estimated Budget</label>
            <input type=\"number\" step=\"0.01\" name=\"estimatedBudget\" value=\"{{ target_destination ? target_destination.estimatedBudget : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Image URL</label>
            <input type=\"text\" name=\"imageUrl\" value=\"{{ target_destination ? target_destination.imageUrl : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Latitude</label>
            <input type=\"number\" step=\"0.00000001\" name=\"latitude\" value=\"{{ target_destination ? target_destination.latitude : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Longitude</label>
            <input type=\"number\" step=\"0.00000001\" name=\"longitude\" value=\"{{ target_destination ? target_destination.longitude : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Description</label>
          <textarea name=\"description\" rows=\"4\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">{{ target_destination ? target_destination.description : '' }}</textarea>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Destination</button>
          <a href=\"{{ path('admin_destinations') }}\" class=\"btn btn-secondary\" style=\"flex:1; text-align:center;\">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
{% endblock %}
", "admin/destination_form.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\admin\\destination_form.html.twig");
    }
}
