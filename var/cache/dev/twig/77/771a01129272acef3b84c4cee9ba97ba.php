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

/* admin/dashboard.html.twig */
class __TwigTemplate_e37c252a24ef31bd5377bd18157e53f7 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard.html.twig"));

        $this->parent = $this->load("admin/admin_base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Admin Dashboard — TripX";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 7
        yield "  <span class=\"crumb active\">Dashboard</span>
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
        yield "  .stat-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 36px;
  }
  .stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    padding: 24px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    transition: transform 0.25s ease, border-color 0.25s ease;
  }
  .stat-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent-primary);
  }
  .stat-value {
    font-family: var(--font-display);
    font-size: 34px;
    color: var(--accent-primary);
    line-height: 1;
    margin-top: 10px;
  }
  .stat-label {
    font-size: 0.8rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.07em;
  }
  .dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 28px;
  }
  .panel {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: 28px;
  }
  .panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 14px;
  }
  .activity-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px dashed var(--border-color);
  }
  .activity-row:last-child { border-bottom: none; }
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 71
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 72
        yield "  <div class=\"stat-cards stagger\">
    <div class=\"stat-card\">
      <div class=\"stat-label\">Total Users</div>
      <div class=\"stat-value text-teal\">";
        // line 75
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 75, $this->source); })()), "html", null, true);
        yield "</div>
      <div style=\"color:#10b981;font-size:12px;margin-top:8px;\">Live Platform Count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Gender (Male)</div>
      <div class=\"stat-value text-teal\">";
        // line 80
        yield ((((isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 80, $this->source); })()) > 0)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((((isset($context["males"]) || array_key_exists("males", $context) ? $context["males"] : (function () { throw new RuntimeError('Variable "males" does not exist.', 80, $this->source); })()) / (isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 80, $this->source); })())) * 100)), "html", null, true)) : (0));
        yield "%</div>
      <div style=\"color:var(--accent-primary);font-size:12px;margin-top:8px;\">";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["males"]) || array_key_exists("males", $context) ? $context["males"] : (function () { throw new RuntimeError('Variable "males" does not exist.', 81, $this->source); })()), "html", null, true);
        yield " absolute count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Gender (Female)</div>
      <div class=\"stat-value text-teal\">";
        // line 85
        yield ((((isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 85, $this->source); })()) > 0)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((((isset($context["females"]) || array_key_exists("females", $context) ? $context["females"] : (function () { throw new RuntimeError('Variable "females" does not exist.', 85, $this->source); })()) / (isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 85, $this->source); })())) * 100)), "html", null, true)) : (0));
        yield "%</div>
      <div style=\"color:var(--accent-primary);font-size:12px;margin-top:8px;\">";
        // line 86
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["females"]) || array_key_exists("females", $context) ? $context["females"] : (function () { throw new RuntimeError('Variable "females" does not exist.', 86, $this->source); })()), "html", null, true);
        yield " absolute count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Global Activity</div>
      <div class=\"stat-value text-teal\">";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalLogs"]) || array_key_exists("totalLogs", $context) ? $context["totalLogs"] : (function () { throw new RuntimeError('Variable "totalLogs" does not exist.', 90, $this->source); })()), "html", null, true);
        yield "</div>
      <div style=\"color:#10b981;font-size:12px;margin-top:8px;\">Logs tracked</div>
    </div>
  </div>

  <div class=\"reveal stagger\" style=\"margin-top: 40px;\">
    <div class=\"panel\" style=\"text-align: center;\">
      <h2 style=\"font-family:var(--font-display);font-size:18px;margin-bottom:20px;\">System Overview</h2>
      <p class=\"text-muted\">Welcome to the central command. Use the sidebar to manage specific modules.</p>
    </div>
  </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 103
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 104
        yield "<script>
document.addEventListener('DOMContentLoaded', function() {
    // PDF Export
    const exportBtn = document.getElementById('exportPDF');
    if (exportBtn) {
        exportBtn.addEventListener('click', () => {
            window.print();
        });
    }
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
        return "admin/dashboard.html.twig";
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
        return array (  248 => 104,  238 => 103,  218 => 90,  211 => 86,  207 => 85,  200 => 81,  196 => 80,  188 => 75,  183 => 72,  173 => 71,  107 => 11,  97 => 10,  88 => 7,  78 => 6,  61 => 4,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}


{% block title %}Admin Dashboard — TripX{% endblock %}

{% block breadcrumbs %}
  <span class=\"crumb active\">Dashboard</span>
{% endblock %}

{% block page_styles %}
  .stat-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 36px;
  }
  .stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    padding: 24px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    transition: transform 0.25s ease, border-color 0.25s ease;
  }
  .stat-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent-primary);
  }
  .stat-value {
    font-family: var(--font-display);
    font-size: 34px;
    color: var(--accent-primary);
    line-height: 1;
    margin-top: 10px;
  }
  .stat-label {
    font-size: 0.8rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.07em;
  }
  .dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 28px;
  }
  .panel {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: 28px;
  }
  .panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 14px;
  }
  .activity-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px dashed var(--border-color);
  }
  .activity-row:last-child { border-bottom: none; }
{% endblock %}

{% block content %}
  <div class=\"stat-cards stagger\">
    <div class=\"stat-card\">
      <div class=\"stat-label\">Total Users</div>
      <div class=\"stat-value text-teal\">{{ totalUsers }}</div>
      <div style=\"color:#10b981;font-size:12px;margin-top:8px;\">Live Platform Count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Gender (Male)</div>
      <div class=\"stat-value text-teal\">{{ totalUsers > 0 ? ((males / totalUsers) * 100)|round : 0 }}%</div>
      <div style=\"color:var(--accent-primary);font-size:12px;margin-top:8px;\">{{ males }} absolute count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Gender (Female)</div>
      <div class=\"stat-value text-teal\">{{ totalUsers > 0 ? ((females / totalUsers) * 100)|round : 0 }}%</div>
      <div style=\"color:var(--accent-primary);font-size:12px;margin-top:8px;\">{{ females }} absolute count</div>
    </div>
    <div class=\"stat-card\">
      <div class=\"stat-label\">Global Activity</div>
      <div class=\"stat-value text-teal\">{{ totalLogs }}</div>
      <div style=\"color:#10b981;font-size:12px;margin-top:8px;\">Logs tracked</div>
    </div>
  </div>

  <div class=\"reveal stagger\" style=\"margin-top: 40px;\">
    <div class=\"panel\" style=\"text-align: center;\">
      <h2 style=\"font-family:var(--font-display);font-size:18px;margin-bottom:20px;\">System Overview</h2>
      <p class=\"text-muted\">Welcome to the central command. Use the sidebar to manage specific modules.</p>
    </div>
  </div>
{% endblock %}

{% block javascripts %}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // PDF Export
    const exportBtn = document.getElementById('exportPDF');
    if (exportBtn) {
        exportBtn.addEventListener('click', () => {
            window.print();
        });
    }
});
</script>
{% endblock %}
", "admin/dashboard.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\admin\\dashboard.html.twig");
    }
}
