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

/* admin/activity_form.html.twig */
class __TwigTemplate_d34cd9bf60f51646e7c1da18513c017b extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/activity_form.html.twig"));

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

        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 2, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Edit") : ("Add"));
        yield " Activity — TripX Admin";
        
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_activities");
        yield "\" class=\"crumb\">Activities</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">";
        // line 9
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 9, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("Edit " . CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 9, $this->source); })()), "name", [], "any", false, false, false, 9)), "html", null, true)) : ("Add Activity"));
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
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 15, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Edit") : ("Add"));
        yield " Activity</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Fill the details for the activity.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 800px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"";
        // line 21
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 21, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_activity_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 21, $this->source); })()), "activityId", [], "any", false, false, false, 21)]), "html", null, true)) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_activity_add")));
        yield "\">
        
        <div style=\"display:grid; grid-template-columns:1fr 1fr; gap:20px;\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Name *</label>
            <input type=\"text\" name=\"name\" value=\"";
        // line 26
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 26, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 26, $this->source); })()), "name", [], "any", false, false, false, 26), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Category *</label>
            <select name=\"category\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              ";
        // line 32
        $context["categories"] = ["tour", "adventure", "cultural", "food", "relaxation", "nightlife", "sports", "wellness", "other"];
        // line 33
        yield "              ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 33, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 34
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["c"], "html", null, true);
            yield "\" ";
            if (((isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 34, $this->source); })()) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 34, $this->source); })()), "category", [], "any", false, false, false, 34) == $context["c"]))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["c"]), "html", null, true);
            yield "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['c'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "            </select>
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Price *</label>
            <input type=\"number\" step=\"0.01\" name=\"price\" value=\"";
        // line 41
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 41, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 41, $this->source); })()), "price", [], "any", false, false, false, 41), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Currency</label>
            <input type=\"text\" name=\"currency\" value=\"";
        // line 46
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 46, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 46, $this->source); })()), "currency", [], "any", false, false, false, 46), "html", null, true)) : ("USD"));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Duration (minutes)</label>
            <input type=\"number\" name=\"durationMinutes\" value=\"";
        // line 51
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 51, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 51, $this->source); })()), "durationMinutes", [], "any", false, false, false, 51), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Capacity</label>
            <input type=\"number\" name=\"capacity\" value=\"";
        // line 56
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 56, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 56, $this->source); })()), "capacity", [], "any", false, false, false, 56), "html", null, true)) : (""));
        yield "\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Description</label>
          <textarea name=\"description\" rows=\"4\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">";
        // line 62
        yield (((($tmp = (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 62, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["target_activity"]) || array_key_exists("target_activity", $context) ? $context["target_activity"] : (function () { throw new RuntimeError('Variable "target_activity" does not exist.', 62, $this->source); })()), "description", [], "any", false, false, false, 62), "html", null, true)) : (""));
        yield "</textarea>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Activity</button>
          <a href=\"";
        // line 67
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_activities");
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
        return "admin/activity_form.html.twig";
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
        return array (  218 => 67,  210 => 62,  201 => 56,  193 => 51,  185 => 46,  177 => 41,  170 => 36,  155 => 34,  150 => 33,  148 => 32,  139 => 26,  131 => 21,  122 => 15,  118 => 13,  108 => 12,  98 => 9,  93 => 7,  87 => 5,  77 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}{{ target_activity ? 'Edit' : 'Add' }} Activity — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <a href=\"{{ path('admin_activities') }}\" class=\"crumb\">Activities</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">{{ target_activity ? 'Edit ' ~ target_activity.name : 'Add Activity' }}</span>
{% endblock %}

{% block content %}
<div class=\"reveal\">
  <div style=\"margin-bottom:32px;\">
    <h1 class=\"display-sm\" style=\"margin-bottom:4px\">{{ target_activity ? 'Edit' : 'Add' }} Activity</h1>
    <p class=\"text-muted\" style=\"font-size:14px\">Fill the details for the activity.</p>
  </div>

  <div class=\"card reveal\" style=\"max-width: 800px;\">
    <div class=\"card-body\">
      <form method=\"post\" action=\"{{ target_activity ? path('admin_activity_edit', {id: target_activity.activityId}) : path('admin_activity_add') }}\">
        
        <div style=\"display:grid; grid-template-columns:1fr 1fr; gap:20px;\">
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Name *</label>
            <input type=\"text\" name=\"name\" value=\"{{ target_activity ? target_activity.name : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Category *</label>
            <select name=\"category\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
              {% set categories = ['tour', 'adventure', 'cultural', 'food', 'relaxation', 'nightlife', 'sports', 'wellness', 'other'] %}
              {% for c in categories %}
                <option value=\"{{ c }}\" {% if target_activity and target_activity.category == c %}selected{% endif %}>{{ c|capitalize }}</option>
              {% endfor %}
            </select>
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Price *</label>
            <input type=\"number\" step=\"0.01\" name=\"price\" value=\"{{ target_activity ? target_activity.price : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\" required>
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Currency</label>
            <input type=\"text\" name=\"currency\" value=\"{{ target_activity ? target_activity.currency : 'USD' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
          
          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Duration (minutes)</label>
            <input type=\"number\" name=\"durationMinutes\" value=\"{{ target_activity ? target_activity.durationMinutes : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>

          <div class=\"form-group\" style=\"margin-bottom: 20px;\">
            <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Capacity</label>
            <input type=\"number\" name=\"capacity\" value=\"{{ target_activity ? target_activity.capacity : '' }}\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">
          </div>
        </div>
        
        <div class=\"form-group\" style=\"margin-bottom: 20px;\">
          <label style=\"display:block; margin-bottom:8px; font-weight:600;\">Description</label>
          <textarea name=\"description\" rows=\"4\" class=\"form-control\" style=\"width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);\">{{ target_activity ? target_activity.description : '' }}</textarea>
        </div>

        <div style=\"display:flex; gap:12px; margin-top:32px;\">
          <button type=\"submit\" class=\"btn btn-primary\" style=\"flex:1;\">Save Activity</button>
          <a href=\"{{ path('admin_activities') }}\" class=\"btn btn-secondary\" style=\"flex:1; text-align:center;\">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
{% endblock %}
", "admin/activity_form.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\admin\\activity_form.html.twig");
    }
}
