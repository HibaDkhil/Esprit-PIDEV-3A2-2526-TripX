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

/* front/search_results.html.twig */
class __TwigTemplate_95089f054e121e5c97e9df4587057d91 extends Template
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
            'body' => [$this, 'block_body'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/search_results.html.twig"));

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

        yield "Search Results — TripX";
        
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
        yield "<style>
    .search-results-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, rgba(0,166,237,0.05), rgba(255,77,109,0.05));
        text-align: center;
    }
    .results-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }
    .search-meta {
        margin-bottom: 40px;
        font-family: var(--font-mono);
        color: var(--text-muted);
    }
    .mock-result-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .mock-result-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent-primary);
        box-shadow: var(--shadow-lg);
    }
    .result-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: rgba(0,166,237,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 51
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 52
        yield "<section class=\"search-results-hero reveal\">
    <div class=\"container\">
        <h1 class=\"display-md\">Search <span class=\"text-coral\">Results</span></h1>
        <p class=\"search-meta\">
          Showing matches for: \"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("query", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 56, $this->source); })()), "Everything")) : ("Everything")), "html", null, true);
        yield "\"
          ";
        // line 57
        $context["start"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "request", [], "any", false, false, false, 57), "query", [], "any", false, false, false, 57), "get", ["start"], "method", false, false, false, 57);
        // line 58
        yield "          ";
        $context["end"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 58, $this->source); })()), "request", [], "any", false, false, false, 58), "query", [], "any", false, false, false, 58), "get", ["end"], "method", false, false, false, 58);
        // line 59
        yield "          ";
        $context["guests"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 59, $this->source); })()), "request", [], "any", false, false, false, 59), "query", [], "any", false, false, false, 59), "get", ["guests"], "method", false, false, false, 59);
        // line 60
        yield "          ";
        if ((((isset($context["start"]) || array_key_exists("start", $context) ? $context["start"] : (function () { throw new RuntimeError('Variable "start" does not exist.', 60, $this->source); })()) || (isset($context["end"]) || array_key_exists("end", $context) ? $context["end"] : (function () { throw new RuntimeError('Variable "end" does not exist.', 60, $this->source); })())) || (isset($context["guests"]) || array_key_exists("guests", $context) ? $context["guests"] : (function () { throw new RuntimeError('Variable "guests" does not exist.', 60, $this->source); })()))) {
            // line 61
            yield "            <br>
            <span style=\"font-size: 0.9em; opacity: 0.8;\">
              ";
            // line 63
            yield (((($tmp = (isset($context["start"]) || array_key_exists("start", $context) ? $context["start"] : (function () { throw new RuntimeError('Variable "start" does not exist.', 63, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("From " . (isset($context["start"]) || array_key_exists("start", $context) ? $context["start"] : (function () { throw new RuntimeError('Variable "start" does not exist.', 63, $this->source); })())), "html", null, true)) : (""));
            yield " ";
            yield (((($tmp = (isset($context["end"]) || array_key_exists("end", $context) ? $context["end"] : (function () { throw new RuntimeError('Variable "end" does not exist.', 63, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((" to " . (isset($context["end"]) || array_key_exists("end", $context) ? $context["end"] : (function () { throw new RuntimeError('Variable "end" does not exist.', 63, $this->source); })())), "html", null, true)) : (""));
            yield " ";
            yield (((($tmp = (isset($context["guests"]) || array_key_exists("guests", $context) ? $context["guests"] : (function () { throw new RuntimeError('Variable "guests" does not exist.', 63, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((" • " . (isset($context["guests"]) || array_key_exists("guests", $context) ? $context["guests"] : (function () { throw new RuntimeError('Variable "guests" does not exist.', 63, $this->source); })())) . " Guests"), "html", null, true)) : (""));
            yield "
            </span>
          ";
        }
        // line 66
        yield "        </p>
    </div>
</section>

<div class=\"results-container\">
    ";
        // line 71
        $context["mockResults"] = [["title" => "Paris Getaway", "type" => "Destination", "desc" => "Experience the city of light with our exclusive AI-curated itinerary."], ["title" => "Alpine Skiing", "type" => "Activity", "desc" => "Thrilling mountain adventures in the heart of the Swiss Alps."], ["title" => "Oceanic Resort", "type" => "Accommodation", "desc" => "Luxury underwater suites with 360-degree marine views."]];
        // line 76
        yield "
    <div class=\"stagger\">
        ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["mockResults"]) || array_key_exists("mockResults", $context) ? $context["mockResults"] : (function () { throw new RuntimeError('Variable "mockResults" does not exist.', 78, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
            // line 79
            yield "            ";
            if (((CoreExtension::inFilter(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 79, $this->source); })())), Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["result"], "title", [], "any", false, false, false, 79))) || CoreExtension::inFilter(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 79, $this->source); })())), Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["result"], "type", [], "any", false, false, false, 79)))) ||  !(isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 79, $this->source); })()))) {
                // line 80
                yield "                <div class=\"mock-result-card\">
                    <div class=\"result-icon\">
                        ";
                // line 82
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["result"], "type", [], "any", false, false, false, 82) == "Destination")) ? ("🌍") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["result"], "type", [], "any", false, false, false, 82) == "Activity")) ? ("⛷️") : ("🏨"))));
                yield "
                    </div>
                    <div>
                        <span class=\"badge\" style=\"background: rgba(0,166,237,0.1); color: var(--accent-primary); font-size: 10px; margin-bottom: 8px;\">";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["result"], "type", [], "any", false, false, false, 85), "html", null, true);
                yield "</span>
                        <h3 style=\"font-size: 20px; margin-bottom: 4px;\">";
                // line 86
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["result"], "title", [], "any", false, false, false, 86), "html", null, true);
                yield "</h3>
                        <p class=\"text-muted\" style=\"font-size: 14px;\">";
                // line 87
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["result"], "desc", [], "any", false, false, false, 87), "html", null, true);
                yield "</p>
                    </div>
                </div>
            ";
            }
            // line 91
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['result'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        yield "
        ";
        // line 93
        if (((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 93, $this->source); })()) &&  !Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, (isset($context["mockResults"]) || array_key_exists("mockResults", $context) ? $context["mockResults"] : (function () { throw new RuntimeError('Variable "mockResults" does not exist.', 93, $this->source); })()), function ($__r__) use ($context, $macros) { $context["r"] = $__r__; return (CoreExtension::inFilter(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 93, $this->source); })())), Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["r"]) || array_key_exists("r", $context) ? $context["r"] : (function () { throw new RuntimeError('Variable "r" does not exist.', 93, $this->source); })()), "title", [], "any", false, false, false, 93))) || CoreExtension::inFilter(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 93, $this->source); })())), Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["r"]) || array_key_exists("r", $context) ? $context["r"] : (function () { throw new RuntimeError('Variable "r" does not exist.', 93, $this->source); })()), "type", [], "any", false, false, false, 93)))); })))) {
            // line 94
            yield "            <div style=\"text-align: center; padding: 60px;\">
                <p class=\"text-muted\">No direct matches found for \"";
            // line 95
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 95, $this->source); })()), "html", null, true);
            yield "\".</p>
                <a href=\"";
            // line 96
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
            yield "\" class=\"btn-nav-primary\" style=\"display: inline-block; margin-top: 20px;\">Browse All Destinations</a>
            </div>
        ";
        }
        // line 99
        yield "    </div>
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
        return "front/search_results.html.twig";
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
        return array (  251 => 99,  245 => 96,  241 => 95,  238 => 94,  236 => 93,  233 => 92,  227 => 91,  220 => 87,  216 => 86,  212 => 85,  206 => 82,  202 => 80,  199 => 79,  195 => 78,  191 => 76,  189 => 71,  182 => 66,  172 => 63,  168 => 61,  165 => 60,  162 => 59,  159 => 58,  157 => 57,  153 => 56,  147 => 52,  137 => 51,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Search Results — TripX{% endblock %}

{% block stylesheets %}
<style>
    .search-results-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, rgba(0,166,237,0.05), rgba(255,77,109,0.05));
        text-align: center;
    }
    .results-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }
    .search-meta {
        margin-bottom: 40px;
        font-family: var(--font-mono);
        color: var(--text-muted);
    }
    .mock-result-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .mock-result-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent-primary);
        box-shadow: var(--shadow-lg);
    }
    .result-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: rgba(0,166,237,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>
{% endblock %}

{% block body %}
<section class=\"search-results-hero reveal\">
    <div class=\"container\">
        <h1 class=\"display-md\">Search <span class=\"text-coral\">Results</span></h1>
        <p class=\"search-meta\">
          Showing matches for: \"{{ query|default('Everything') }}\"
          {% set start = app.request.query.get('start') %}
          {% set end = app.request.query.get('end') %}
          {% set guests = app.request.query.get('guests') %}
          {% if start or end or guests %}
            <br>
            <span style=\"font-size: 0.9em; opacity: 0.8;\">
              {{ start ? 'From ' ~ start : '' }} {{ end ? ' to ' ~ end : '' }} {{ guests ? ' • ' ~ guests ~ ' Guests' : '' }}
            </span>
          {% endif %}
        </p>
    </div>
</section>

<div class=\"results-container\">
    {% set mockResults = [
        {'title': 'Paris Getaway', 'type': 'Destination', 'desc': 'Experience the city of light with our exclusive AI-curated itinerary.'},
        {'title': 'Alpine Skiing', 'type': 'Activity', 'desc': 'Thrilling mountain adventures in the heart of the Swiss Alps.'},
        {'title': 'Oceanic Resort', 'type': 'Accommodation', 'desc': 'Luxury underwater suites with 360-degree marine views.'}
    ] %}

    <div class=\"stagger\">
        {% for result in mockResults %}
            {% if query|lower in result.title|lower or query|lower in result.type|lower or not query %}
                <div class=\"mock-result-card\">
                    <div class=\"result-icon\">
                        {{ result.type == 'Destination' ? '🌍' : (result.type == 'Activity' ? '⛷️' : '🏨') }}
                    </div>
                    <div>
                        <span class=\"badge\" style=\"background: rgba(0,166,237,0.1); color: var(--accent-primary); font-size: 10px; margin-bottom: 8px;\">{{ result.type }}</span>
                        <h3 style=\"font-size: 20px; margin-bottom: 4px;\">{{ result.title }}</h3>
                        <p class=\"text-muted\" style=\"font-size: 14px;\">{{ result.desc }}</p>
                    </div>
                </div>
            {% endif %}
        {% endfor %}

        {% if query and not (mockResults|filter(r => query|lower in r.title|lower or query|lower in r.type|lower)|length) %}
            <div style=\"text-align: center; padding: 60px;\">
                <p class=\"text-muted\">No direct matches found for \"{{ query }}\".</p>
                <a href=\"{{ path('destinations') }}\" class=\"btn-nav-primary\" style=\"display: inline-block; margin-top: 20px;\">Browse All Destinations</a>
            </div>
        {% endif %}
    </div>
</div>
{% endblock %}
", "front/search_results.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\search_results.html.twig");
    }
}
