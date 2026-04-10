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

/* front/blog/travel_story_index.html.twig */
class __TwigTemplate_8b45be89a8a5686137001d41f5103d9c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/travel_story_index.html.twig"));

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

        yield "Travel Stories";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container mt-4\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>Travel Stories</h1>
        <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_new");
        yield "\" class=\"btn btn-primary\">Write a Travel Story</a>
    </div>

    <form method=\"get\" class=\"row g-3 mb-4\">
        <div class=\"col-md-3\">
            <input type=\"text\" name=\"keyword\" class=\"form-control\" placeholder=\"Search by keyword\" value=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "request", [], "any", false, false, false, 14), "get", ["keyword"], "method", false, false, false, 14), "html", null, true);
        yield "\">
        </div>
        <div class=\"col-md-2\">
            <input type=\"text\" name=\"destination\" class=\"form-control\" placeholder=\"Destination\" value=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 17, $this->source); })()), "request", [], "any", false, false, false, 17), "get", ["destination"], "method", false, false, false, 17), "html", null, true);
        yield "\">
        </div>
        <div class=\"col-md-2\">
            <select name=\"travelType\" class=\"form-select\">
                <option value=\"\">Travel type</option>
                <option value=\"solo\" ";
        // line 22
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "request", [], "any", false, false, false, 22), "get", ["travelType"], "method", false, false, false, 22) == "solo")) ? ("selected") : (""));
        yield ">Solo</option>
                <option value=\"couple\" ";
        // line 23
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 23, $this->source); })()), "request", [], "any", false, false, false, 23), "get", ["travelType"], "method", false, false, false, 23) == "couple")) ? ("selected") : (""));
        yield ">Couple</option>
                <option value=\"family\" ";
        // line 24
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "request", [], "any", false, false, false, 24), "get", ["travelType"], "method", false, false, false, 24) == "family")) ? ("selected") : (""));
        yield ">Family</option>
                <option value=\"friends\" ";
        // line 25
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 25, $this->source); })()), "request", [], "any", false, false, false, 25), "get", ["travelType"], "method", false, false, false, 25) == "friends")) ? ("selected") : (""));
        yield ">Friends</option>
                <option value=\"business\" ";
        // line 26
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "request", [], "any", false, false, false, 26), "get", ["travelType"], "method", false, false, false, 26) == "business")) ? ("selected") : (""));
        yield ">Business</option>
            </select>
        </div>
        <div class=\"col-md-2\">
            <select name=\"travelStyle\" class=\"form-select\">
                <option value=\"\">Travel style</option>
                <option value=\"luxury\" ";
        // line 32
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 32, $this->source); })()), "request", [], "any", false, false, false, 32), "get", ["travelStyle"], "method", false, false, false, 32) == "luxury")) ? ("selected") : (""));
        yield ">Luxury</option>
                <option value=\"budget\" ";
        // line 33
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 33, $this->source); })()), "request", [], "any", false, false, false, 33), "get", ["travelStyle"], "method", false, false, false, 33) == "budget")) ? ("selected") : (""));
        yield ">Budget</option>
                <option value=\"adventure\" ";
        // line 34
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "request", [], "any", false, false, false, 34), "get", ["travelStyle"], "method", false, false, false, 34) == "adventure")) ? ("selected") : (""));
        yield ">Adventure</option>
                <option value=\"relax\" ";
        // line 35
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "request", [], "any", false, false, false, 35), "get", ["travelStyle"], "method", false, false, false, 35) == "relax")) ? ("selected") : (""));
        yield ">Relax</option>
                <option value=\"cultural\" ";
        // line 36
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 36, $this->source); })()), "request", [], "any", false, false, false, 36), "get", ["travelStyle"], "method", false, false, false, 36) == "cultural")) ? ("selected") : (""));
        yield ">Cultural</option>
                <option value=\"roadtrip\" ";
        // line 37
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 37, $this->source); })()), "request", [], "any", false, false, false, 37), "get", ["travelStyle"], "method", false, false, false, 37) == "roadtrip")) ? ("selected") : (""));
        yield ">Roadtrip</option>
            </select>
        </div>
        <div class=\"col-md-2\">
            <select name=\"rating\" class=\"form-select\">
                <option value=\"\">Min rating</option>
                ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 44
            yield "                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\" ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 44, $this->source); })()), "request", [], "any", false, false, false, 44), "get", ["rating"], "method", false, false, false, 44) == Twig\Extension\CoreExtension::striptags($context["i"]))) ? ("selected") : (""));
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "+</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "            </select>
        </div>
        <div class=\"col-md-1\">
            <button class=\"btn btn-dark w-100\">Go</button>
        </div>
    </form>

    <div class=\"row\">
        ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stories"]) || array_key_exists("stories", $context) ? $context["stories"] : (function () { throw new RuntimeError('Variable "stories" does not exist.', 54, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
            // line 55
            yield "            <div class=\"col-md-6 col-lg-4 mb-4\">
                <div class=\"card h-100 shadow-sm\">
                    ";
            // line 57
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 57)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 58
                yield "                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 58), "html", null, true);
                yield "\" class=\"card-img-top\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 58), "html", null, true);
                yield "\" style=\"height: 220px; object-fit: cover;\">
                    ";
            }
            // line 60
            yield "                    <div class=\"card-body\">
                        <h5 class=\"card-title\">";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 61), "html", null, true);
            yield "</h5>
                        <p class=\"text-muted mb-2\">
                            ";
            // line 63
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 63)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 63), "html", null, true)) : ("Unknown destination"));
            yield "
                        </p>

                        <p class=\"card-text\">
                            ";
            // line 67
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 67)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 67), 0, 140) . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 67)) > 140)) ? ("...") : (""))), "html", null, true)) : ("No summary yet."));
            yield "
                        </p>

                        <div class=\"mb-2\">
                            ";
            // line 71
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 72
                yield "                                <span class=\"badge bg-warning text-dark\">⭐ ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 72), "html", null, true);
                yield "/5</span>
                            ";
            }
            // line 74
            yield "                            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 74)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 75
                yield "                                <span class=\"badge bg-info text-dark\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 75), "html", null, true);
                yield "</span>
                            ";
            }
            // line 77
            yield "                            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 77)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 78
                yield "                                <span class=\"badge bg-secondary\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 78), "html", null, true);
                yield "</span>
                            ";
            }
            // line 80
            yield "                        </div>

                        <div class=\"small text-muted mb-3\">
                            Recommend:
                            <strong>";
            // line 84
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "wouldRecommend", [], "any", false, false, false, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
            yield "</strong>
                            |
                            Go again:
                            <strong>";
            // line 87
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "wouldGoAgain", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
            yield "</strong>
                        </div>

                        <a href=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 90)]), "html", null, true);
            yield "\" class=\"btn btn-outline-primary btn-sm\">Read story</a>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 94
        if (!$context['_iterated']) {
            // line 95
            yield "            <div class=\"col-12\">
                <div class=\"alert alert-info\">No travel stories found.</div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['story'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return "front/blog/travel_story_index.html.twig";
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
        return array (  298 => 99,  289 => 95,  287 => 94,  278 => 90,  272 => 87,  266 => 84,  260 => 80,  254 => 78,  251 => 77,  245 => 75,  242 => 74,  236 => 72,  234 => 71,  227 => 67,  220 => 63,  215 => 61,  212 => 60,  204 => 58,  202 => 57,  198 => 55,  193 => 54,  183 => 46,  170 => 44,  166 => 43,  157 => 37,  153 => 36,  149 => 35,  145 => 34,  141 => 33,  137 => 32,  128 => 26,  124 => 25,  120 => 24,  116 => 23,  112 => 22,  104 => 17,  98 => 14,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Travel Stories{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>Travel Stories</h1>
        <a href=\"{{ path('travel_story_new') }}\" class=\"btn btn-primary\">Write a Travel Story</a>
    </div>

    <form method=\"get\" class=\"row g-3 mb-4\">
        <div class=\"col-md-3\">
            <input type=\"text\" name=\"keyword\" class=\"form-control\" placeholder=\"Search by keyword\" value=\"{{ app.request.get('keyword') }}\">
        </div>
        <div class=\"col-md-2\">
            <input type=\"text\" name=\"destination\" class=\"form-control\" placeholder=\"Destination\" value=\"{{ app.request.get('destination') }}\">
        </div>
        <div class=\"col-md-2\">
            <select name=\"travelType\" class=\"form-select\">
                <option value=\"\">Travel type</option>
                <option value=\"solo\" {{ app.request.get('travelType') == 'solo' ? 'selected' : '' }}>Solo</option>
                <option value=\"couple\" {{ app.request.get('travelType') == 'couple' ? 'selected' : '' }}>Couple</option>
                <option value=\"family\" {{ app.request.get('travelType') == 'family' ? 'selected' : '' }}>Family</option>
                <option value=\"friends\" {{ app.request.get('travelType') == 'friends' ? 'selected' : '' }}>Friends</option>
                <option value=\"business\" {{ app.request.get('travelType') == 'business' ? 'selected' : '' }}>Business</option>
            </select>
        </div>
        <div class=\"col-md-2\">
            <select name=\"travelStyle\" class=\"form-select\">
                <option value=\"\">Travel style</option>
                <option value=\"luxury\" {{ app.request.get('travelStyle') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                <option value=\"budget\" {{ app.request.get('travelStyle') == 'budget' ? 'selected' : '' }}>Budget</option>
                <option value=\"adventure\" {{ app.request.get('travelStyle') == 'adventure' ? 'selected' : '' }}>Adventure</option>
                <option value=\"relax\" {{ app.request.get('travelStyle') == 'relax' ? 'selected' : '' }}>Relax</option>
                <option value=\"cultural\" {{ app.request.get('travelStyle') == 'cultural' ? 'selected' : '' }}>Cultural</option>
                <option value=\"roadtrip\" {{ app.request.get('travelStyle') == 'roadtrip' ? 'selected' : '' }}>Roadtrip</option>
            </select>
        </div>
        <div class=\"col-md-2\">
            <select name=\"rating\" class=\"form-select\">
                <option value=\"\">Min rating</option>
                {% for i in 1..5 %}
                    <option value=\"{{ i }}\" {{ app.request.get('rating') == i|striptags ? 'selected' : '' }}>{{ i }}+</option>
                {% endfor %}
            </select>
        </div>
        <div class=\"col-md-1\">
            <button class=\"btn btn-dark w-100\">Go</button>
        </div>
    </form>

    <div class=\"row\">
        {% for story in stories %}
            <div class=\"col-md-6 col-lg-4 mb-4\">
                <div class=\"card h-100 shadow-sm\">
                    {% if story.coverImageUrl %}
                        <img src=\"{{ story.coverImageUrl }}\" class=\"card-img-top\" alt=\"{{ story.title }}\" style=\"height: 220px; object-fit: cover;\">
                    {% endif %}
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">{{ story.title }}</h5>
                        <p class=\"text-muted mb-2\">
                            {{ story.destination ?: 'Unknown destination' }}
                        </p>

                        <p class=\"card-text\">
                            {{ story.summary ? story.summary|slice(0, 140) ~ (story.summary|length > 140 ? '...' : '') : 'No summary yet.' }}
                        </p>

                        <div class=\"mb-2\">
                            {% if story.overallRating %}
                                <span class=\"badge bg-warning text-dark\">⭐ {{ story.overallRating }}/5</span>
                            {% endif %}
                            {% if story.travelType %}
                                <span class=\"badge bg-info text-dark\">{{ story.travelType }}</span>
                            {% endif %}
                            {% if story.travelStyle %}
                                <span class=\"badge bg-secondary\">{{ story.travelStyle }}</span>
                            {% endif %}
                        </div>

                        <div class=\"small text-muted mb-3\">
                            Recommend:
                            <strong>{{ story.wouldRecommend ? 'Yes' : 'No' }}</strong>
                            |
                            Go again:
                            <strong>{{ story.wouldGoAgain ? 'Yes' : 'No' }}</strong>
                        </div>

                        <a href=\"{{ path('travel_story_show', {id: story.id}) }}\" class=\"btn btn-outline-primary btn-sm\">Read story</a>
                    </div>
                </div>
            </div>
        {% else %}
            <div class=\"col-12\">
                <div class=\"alert alert-info\">No travel stories found.</div>
            </div>
        {% endfor %}
    </div>
</div>
{% endblock %}", "front/blog/travel_story_index.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\travel_story_index.html.twig");
    }
}
