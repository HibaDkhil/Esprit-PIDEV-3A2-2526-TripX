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

/* admin/destinations.html.twig */
class __TwigTemplate_1b65dcdcf2ea113b20cafd608976b625 extends Template
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
            'page_styles' => [$this, 'block_page_styles'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/destinations.html.twig"));

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

        yield "Manage Destinations — TripX Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_styles"));

        // line 5
        yield "  .dest-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-lg); overflow: hidden; }
  .dest-table th { background: rgba(0,166,237,0.05); text-align: left; padding: 16px 20px; font-family: var(--font-display); font-size: 14px; }
  .dest-table td { padding: 16px 20px; border-bottom: 1px solid var(--border-color); font-size: 14px; }
  .dest-table tr:last-child td { border-bottom: none; }
  .btn-action { padding: 8px; border-radius: 6px; border: 1px solid var(--border-color); cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; }
  .btn-delete { color: #ef4444; }
  .btn-delete:hover { border-color: #ef4444; background: rgba(239,68,68,0.1); }
  .search-wrap { margin-bottom: 24px; }
  .input-search { flex: 1; padding: 12px 16px; border-radius: 10px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); }
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 17
        yield "  <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">Destinations</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 22
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 23
        yield "<div class=\"reveal\">
  <div style=\"display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;\">
    <div>
      <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Destinations</h1>
      <p class=\"text-muted\" style=\"font-size:14px\">Manage all travel locations across the platform.</p>
    </div>
    <a href=\"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destination_add");
        yield "\" class=\"btn btn-primary ripple-btn\">+ Add New Destination</a>
  </div>

  <div class=\"stats-tab-bar reveal\" style=\"display:flex; gap:16px; margin-bottom:24px; padding:12px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:var(--border-radius-lg); box-shadow:var(--shadow-sm);\">
    <div style=\"flex:1; padding:12px 20px; border-right:1px solid var(--border-color);\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">Total Destinations</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:var(--accent-primary);\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()), "total", [], "any", false, false, false, 35), "html", null, true);
        yield "</div>
    </div>
    <div style=\"flex:1; padding:12px 20px; border-right:1px solid var(--border-color);\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">Platform Avg Rating</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:var(--text-primary);\">";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 39, $this->source); })()), "avg_rating", [], "any", false, false, false, 39), "html", null, true);
        yield " <span style=\"font-size:16px; color:var(--text-muted); font-family:var(--font-sans);\">/ 5.0</span></div>
    </div>
    <div style=\"flex:1; padding:12px 20px;\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">System Hub</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:#10b981;\">Online</div>
    </div>
  </div>

  <div class=\"search-wrap reveal\">
    <form method=\"get\" action=\"";
        // line 48
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destinations");
        yield "\" style=\"display:flex; width:100%; gap:12px;\">
      <input type=\"text\" name=\"q\" value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 49, $this->source); })()), "html", null, true);
        yield "\" class=\"input-search\" placeholder=\"Search by name, country or continent...\">
      <button type=\"submit\" class=\"btn btn-secondary\">Search</button>
    </form>
  </div>

  <div class=\"card reveal\" style=\"padding:0; overflow:hidden;\">
    <table class=\"dest-table\">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Country</th>
          <th>Continent</th>
          <th>Price</th>
          <th>Category</th>
          <th style=\"text-align:right\">Actions</th>
        </tr>
      </thead>
      <tbody>
        ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["items"]) || array_key_exists("items", $context) ? $context["items"] : (function () { throw new RuntimeError('Variable "items" does not exist.', 68, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 69
            yield "        <tr>
          <td style=\"font-family:var(--font-mono); font-size:12px; opacity:0.6\">#";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "destinationId", [], "any", false, false, false, 70), "html", null, true);
            yield "</td>
          <td style=\"font-weight:600\">";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 71), "html", null, true);
            yield "</td>
          <td>";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "country", [], "any", false, false, false, 72), "html", null, true);
            yield "</td>
          <td><span class=\"badge badge-teal\">";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 73)), "html", null, true);
            yield "</span></td>
          <td style=\"color:var(--accent-primary); font-weight:600\">€";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "estimatedBudget", [], "any", true, true, false, 74)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "estimatedBudget", [], "any", false, false, false, 74), 0)) : (0)), 0), "html", null, true);
            yield "</td>
          <td><span class=\"badge badge-teal\">";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "bestSeason", [], "any", true, true, false, 75)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "bestSeason", [], "any", false, false, false, 75), "all_year")) : ("all_year"))), ["_" => " "]), "html", null, true);
            yield "</span></td>
          <td style=\"text-align:right\">
            <div style=\"display:flex; gap:8px; justify-content:flex-end\">
              <a href=\"";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destination_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "destinationId", [], "any", false, false, false, 78)]), "html", null, true);
            yield "\" class=\"btn btn-secondary btn-sm\">Edit</a>
              <a href=\"";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_destination_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "destinationId", [], "any", false, false, false, 79)]), "html", null, true);
            yield "\" class=\"btn btn-primary btn-sm\" onclick=\"return confirm('Delete this destination?')\">Delete</a>
            </div>
          </td>
        </tr>
        ";
            $context['_iterated'] = true;
        }
        // line 83
        if (!$context['_iterated']) {
            // line 84
            yield "        <tr>
          <td colspan=\"7\" style=\"text-align:center; padding:40px; color:var(--text-muted)\">No destinations found matching your criteria.</td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        yield "      </tbody>
    </table>
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
        return "admin/destinations.html.twig";
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
        return array (  257 => 88,  248 => 84,  246 => 83,  237 => 79,  233 => 78,  227 => 75,  223 => 74,  219 => 73,  215 => 72,  211 => 71,  207 => 70,  204 => 69,  199 => 68,  177 => 49,  173 => 48,  161 => 39,  154 => 35,  145 => 29,  137 => 23,  127 => 22,  114 => 17,  104 => 16,  87 => 5,  77 => 4,  60 => 2,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}Manage Destinations — TripX Admin{% endblock %}

{% block page_styles %}
  .dest-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-lg); overflow: hidden; }
  .dest-table th { background: rgba(0,166,237,0.05); text-align: left; padding: 16px 20px; font-family: var(--font-display); font-size: 14px; }
  .dest-table td { padding: 16px 20px; border-bottom: 1px solid var(--border-color); font-size: 14px; }
  .dest-table tr:last-child td { border-bottom: none; }
  .btn-action { padding: 8px; border-radius: 6px; border: 1px solid var(--border-color); cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; }
  .btn-delete { color: #ef4444; }
  .btn-delete:hover { border-color: #ef4444; background: rgba(239,68,68,0.1); }
  .search-wrap { margin-bottom: 24px; }
  .input-search { flex: 1; padding: 12px 16px; border-radius: 10px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); }
{% endblock %}

{% block breadcrumbs %}
  <a href=\"{{ path('admin_dashboard') }}\" class=\"crumb\">Dashboard</a>
  <span class=\"sep\">›</span>
  <span class=\"crumb active\">Destinations</span>
{% endblock %}

{% block content %}
<div class=\"reveal\">
  <div style=\"display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;\">
    <div>
      <h1 class=\"display-sm\" style=\"margin-bottom:4px\">Destinations</h1>
      <p class=\"text-muted\" style=\"font-size:14px\">Manage all travel locations across the platform.</p>
    </div>
    <a href=\"{{ path('admin_destination_add') }}\" class=\"btn btn-primary ripple-btn\">+ Add New Destination</a>
  </div>

  <div class=\"stats-tab-bar reveal\" style=\"display:flex; gap:16px; margin-bottom:24px; padding:12px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:var(--border-radius-lg); box-shadow:var(--shadow-sm);\">
    <div style=\"flex:1; padding:12px 20px; border-right:1px solid var(--border-color);\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">Total Destinations</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:var(--accent-primary);\">{{ stats.total }}</div>
    </div>
    <div style=\"flex:1; padding:12px 20px; border-right:1px solid var(--border-color);\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">Platform Avg Rating</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:var(--text-primary);\">{{ stats.avg_rating }} <span style=\"font-size:16px; color:var(--text-muted); font-family:var(--font-sans);\">/ 5.0</span></div>
    </div>
    <div style=\"flex:1; padding:12px 20px;\">
      <div class=\"text-muted\" style=\"font-size:12px; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px; font-family:var(--font-mono);\">System Hub</div>
      <div style=\"font-family:var(--font-display); font-size:28px; font-weight:700; color:#10b981;\">Online</div>
    </div>
  </div>

  <div class=\"search-wrap reveal\">
    <form method=\"get\" action=\"{{ path('admin_destinations') }}\" style=\"display:flex; width:100%; gap:12px;\">
      <input type=\"text\" name=\"q\" value=\"{{ currentQuery }}\" class=\"input-search\" placeholder=\"Search by name, country or continent...\">
      <button type=\"submit\" class=\"btn btn-secondary\">Search</button>
    </form>
  </div>

  <div class=\"card reveal\" style=\"padding:0; overflow:hidden;\">
    <table class=\"dest-table\">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Country</th>
          <th>Continent</th>
          <th>Price</th>
          <th>Category</th>
          <th style=\"text-align:right\">Actions</th>
        </tr>
      </thead>
      <tbody>
        {% for item in items %}
        <tr>
          <td style=\"font-family:var(--font-mono); font-size:12px; opacity:0.6\">#{{ item.destinationId }}</td>
          <td style=\"font-weight:600\">{{ item.name }}</td>
          <td>{{ item.country }}</td>
          <td><span class=\"badge badge-teal\">{{ item.type|capitalize }}</span></td>
          <td style=\"color:var(--accent-primary); font-weight:600\">€{{ item.estimatedBudget|default(0)|number_format(0) }}</td>
          <td><span class=\"badge badge-teal\">{{ item.bestSeason|default('all_year')|capitalize|replace({'_': ' '}) }}</span></td>
          <td style=\"text-align:right\">
            <div style=\"display:flex; gap:8px; justify-content:flex-end\">
              <a href=\"{{ path('admin_destination_edit', {id: item.destinationId}) }}\" class=\"btn btn-secondary btn-sm\">Edit</a>
              <a href=\"{{ path('admin_destination_delete', {id: item.destinationId}) }}\" class=\"btn btn-primary btn-sm\" onclick=\"return confirm('Delete this destination?')\">Delete</a>
            </div>
          </td>
        </tr>
        {% else %}
        <tr>
          <td colspan=\"7\" style=\"text-align:center; padding:40px; color:var(--text-muted)\">No destinations found matching your criteria.</td>
        </tr>
        {% endfor %}
      </tbody>
    </table>
  </div>
</div>
{% endblock %}
", "admin/destinations.html.twig", "C:\\Sym\\templates\\admin\\destinations.html.twig");
    }
}
