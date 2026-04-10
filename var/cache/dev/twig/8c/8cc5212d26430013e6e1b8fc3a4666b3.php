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
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Sora:wght@400;500;600;700;800&display=swap');

.story-index-page {
    --story-bg-soft: #eef8f7;
    --story-panel: #ffffff;
    --story-text: #102027;
    --story-muted: #56757f;
    --story-border: #d4e7e5;
    --story-primary: #0f766e;
    --story-primary-strong: #115e59;
    --story-highlight: #f59e0b;
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 18px 72px;
    font-family: 'Sora', 'Segoe UI', sans-serif;
    color: var(--story-text);
}

.story-hero {
    position: relative;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 18px;
    background: linear-gradient(135deg, #e8f4f3 0%, #f7faf8 50%, #fff6e6 100%);
    border: 1px solid var(--story-border);
    border-radius: 26px;
    padding: 28px 28px 24px;
    margin-bottom: 22px;
}

.story-hero::before,
.story-hero::after {
    content: '';
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
}

.story-hero::before {
    width: 220px;
    height: 220px;
    right: -70px;
    top: -90px;
    background: radial-gradient(circle at center, rgba(21, 128, 119, 0.24), rgba(21, 128, 119, 0));
}

.story-hero::after {
    width: 170px;
    height: 170px;
    left: -50px;
    bottom: -85px;
    background: radial-gradient(circle at center, rgba(245, 158, 11, 0.24), rgba(245, 158, 11, 0));
}

.story-hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
}

.story-hero-label {
    display: inline-block;
    margin-bottom: 12px;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    color: var(--story-primary-strong);
}

.story-hero h1 {
    margin: 0;
    line-height: 1.08;
    font-size: clamp(34px, 5vw, 56px);
    font-family: 'DM Serif Display', Georgia, serif;
    font-weight: 400;
}

.story-hero p {
    margin: 12px 0 0;
    max-width: 60ch;
    color: var(--story-muted);
    line-height: 1.7;
    font-size: 14px;
}

.story-hero-actions {
    position: relative;
    z-index: 1;
    align-self: flex-end;
}

.story-hero-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 999px;
    border: 1px solid var(--story-primary);
    background: var(--story-primary);
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    padding: 12px 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    box-shadow: 0 10px 26px rgba(15, 118, 110, 0.22);
}

.story-hero-button:hover {
    transform: translateY(-2px);
    background: var(--story-primary-strong);
    box-shadow: 0 14px 30px rgba(17, 94, 89, 0.28);
}

.story-filter {
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 22px;
    padding: 20px;
    margin-bottom: 28px;
    box-shadow: 0 12px 28px rgba(16, 32, 39, 0.05);
}

.story-filter-grid {
    display: grid;
    grid-template-columns: repeat(12, minmax(0, 1fr));
    gap: 12px;
}

.story-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.story-field label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 700;
    color: var(--story-muted);
}

.story-field input,
.story-field select {
    width: 100%;
    border: 1px solid var(--story-border);
    border-radius: 12px;
    padding: 11px 12px;
    background: #fcfefe;
    font-size: 13px;
    font-family: inherit;
    color: var(--story-text);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.story-field input:focus,
.story-field select:focus {
    outline: none;
    border-color: #59b5a8;
    box-shadow: 0 0 0 3px rgba(89, 181, 168, 0.16);
}

.story-field.keyword { grid-column: span 3; }
.story-field.destination { grid-column: span 2; }
.story-field.type { grid-column: span 2; }
.story-field.style { grid-column: span 2; }
.story-field.rating { grid-column: span 2; }

.story-filter-actions {
    grid-column: span 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 8px;
}

.story-filter-submit,
.story-filter-reset {
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    border: 1px solid transparent;
}

.story-filter-submit {
    background: #111827;
    color: #ffffff;
}

.story-filter-submit:hover {
    background: #000000;
}

.story-filter-reset {
    border-color: var(--story-border);
    color: var(--story-muted);
    background: #ffffff;
}

.story-filter-reset:hover {
    border-color: #bcd7d4;
    color: var(--story-text);
}

.story-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    gap: 18px;
}

.story-card {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 20px;
    box-shadow: 0 10px 24px rgba(16, 32, 39, 0.06);
    animation: cardIn 0.45s cubic-bezier(0.22, 1, 0.36, 1) both;
    transition: transform 0.22s ease, box-shadow 0.22s ease;
}

.story-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 36px rgba(16, 32, 39, 0.12);
}

.story-card-media {
    height: 210px;
    overflow: hidden;
    background: linear-gradient(135deg, #d7f2ee 0%, #ecf7f6 100%);
}

.story-card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.story-card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 16px;
}

.story-card-location {
    margin: 0;
    font-size: 12px;
    color: var(--story-muted);
}

.story-card-title {
    margin: 6px 0 10px;
    line-height: 1.35;
    font-size: 19px;
    font-weight: 700;
}

.story-card-title a {
    color: inherit;
    text-decoration: none;
}

.story-card-title a:hover {
    color: var(--story-primary-strong);
}

.story-card-text {
    margin: 0;
    color: #3e5a62;
    line-height: 1.65;
    font-size: 13px;
}

.story-card-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin: 14px 0 12px;
}

.story-chip {
    font-size: 11px;
    border-radius: 999px;
    padding: 5px 10px;
    font-weight: 700;
    border: 1px solid transparent;
}

.story-chip.rating {
    background: #fff6df;
    border-color: #f4dd9e;
    color: #8a5a00;
}

.story-chip.type {
    background: #e0f4f2;
    border-color: #a5ddd7;
    color: #0f5b57;
}

.story-chip.style {
    background: #ecf2f7;
    border-color: #cbd8e4;
    color: #304a63;
}

.story-card-flags {
    margin-top: auto;
    padding-top: 10px;
    border-top: 1px dashed #d8e8e6;
    font-size: 12px;
    color: var(--story-muted);
    line-height: 1.6;
}

.story-card-flags strong {
    color: #173b45;
}

.story-card-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 11px;
    border: 1px solid var(--story-primary);
    color: var(--story-primary-strong);
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.story-card-link:hover {
    background: #e8f5f3;
}

.story-empty {
    background: var(--story-panel);
    border: 1px dashed #bfded9;
    border-radius: 20px;
    padding: 34px;
    text-align: center;
    color: var(--story-muted);
    line-height: 1.7;
}

.story-empty strong {
    color: var(--story-text);
}

@keyframes cardIn {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 1024px) {
    .story-field.keyword { grid-column: span 4; }
    .story-field.destination { grid-column: span 4; }
    .story-field.type { grid-column: span 4; }
    .story-field.style { grid-column: span 4; }
    .story-field.rating { grid-column: span 4; }
    .story-filter-actions {
        grid-column: 1 / -1;
        flex-direction: row;
    }
}

@media (max-width: 768px) {
    .story-index-page {
        padding: calc(var(--nav-height, 70px) + 16px) 12px 48px;
    }

    .story-hero {
        border-radius: 18px;
        padding: 22px 16px;
    }

    .story-field.keyword,
    .story-field.destination,
    .story-field.type,
    .story-field.style,
    .story-field.rating {
        grid-column: span 12;
    }

    .story-filter {
        border-radius: 16px;
        padding: 14px;
    }

    .story-filter-actions {
        flex-direction: column;
    }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 421
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 422
        yield "<div class=\"story-index-page\">
    <section class=\"story-hero\">
        <div class=\"story-hero-content\">
            <span class=\"story-hero-label\">TripX Journal</span>
            <h1>Travel stories from real explorers.</h1>
            <p>
                Discover routes, practical tips, and honest recommendations from travelers.
                Filter by destination, style, and rating to find the stories that match your next trip.
            </p>
        </div>
        <div class=\"story-hero-actions\">
            <a href=\"";
        // line 433
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_new");
        yield "\" class=\"story-hero-button\">Write your story</a>
        </div>
    </section>

    <form method=\"get\" class=\"story-filter\">
        <div class=\"story-filter-grid\">
            <div class=\"story-field keyword\">
                <label for=\"story_keyword\">Keyword</label>
                <input id=\"story_keyword\" type=\"text\" name=\"keyword\" placeholder=\"Beach, city, food...\" value=\"";
        // line 441
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 441, $this->source); })()), "request", [], "any", false, false, false, 441), "get", ["keyword"], "method", false, false, false, 441), "html", null, true);
        yield "\">
            </div>

            <div class=\"story-field destination\">
                <label for=\"story_destination\">Destination</label>
                <input id=\"story_destination\" type=\"text\" name=\"destination\" placeholder=\"Tunisia, Rome...\" value=\"";
        // line 446
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 446, $this->source); })()), "request", [], "any", false, false, false, 446), "get", ["destination"], "method", false, false, false, 446), "html", null, true);
        yield "\">
            </div>

            <div class=\"story-field type\">
                <label for=\"story_travel_type\">Travel type</label>
                <select id=\"story_travel_type\" name=\"travelType\">
                    <option value=\"\">Any type</option>
                    <option value=\"solo\" ";
        // line 453
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 453, $this->source); })()), "request", [], "any", false, false, false, 453), "get", ["travelType"], "method", false, false, false, 453) == "solo")) ? ("selected") : (""));
        yield ">Solo</option>
                    <option value=\"couple\" ";
        // line 454
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 454, $this->source); })()), "request", [], "any", false, false, false, 454), "get", ["travelType"], "method", false, false, false, 454) == "couple")) ? ("selected") : (""));
        yield ">Couple</option>
                    <option value=\"family\" ";
        // line 455
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 455, $this->source); })()), "request", [], "any", false, false, false, 455), "get", ["travelType"], "method", false, false, false, 455) == "family")) ? ("selected") : (""));
        yield ">Family</option>
                    <option value=\"friends\" ";
        // line 456
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 456, $this->source); })()), "request", [], "any", false, false, false, 456), "get", ["travelType"], "method", false, false, false, 456) == "friends")) ? ("selected") : (""));
        yield ">Friends</option>
                    <option value=\"business\" ";
        // line 457
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 457, $this->source); })()), "request", [], "any", false, false, false, 457), "get", ["travelType"], "method", false, false, false, 457) == "business")) ? ("selected") : (""));
        yield ">Business</option>
                </select>
            </div>

            <div class=\"story-field style\">
                <label for=\"story_travel_style\">Travel style</label>
                <select id=\"story_travel_style\" name=\"travelStyle\">
                    <option value=\"\">Any style</option>
                    <option value=\"luxury\" ";
        // line 465
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 465, $this->source); })()), "request", [], "any", false, false, false, 465), "get", ["travelStyle"], "method", false, false, false, 465) == "luxury")) ? ("selected") : (""));
        yield ">Luxury</option>
                    <option value=\"budget\" ";
        // line 466
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 466, $this->source); })()), "request", [], "any", false, false, false, 466), "get", ["travelStyle"], "method", false, false, false, 466) == "budget")) ? ("selected") : (""));
        yield ">Budget</option>
                    <option value=\"adventure\" ";
        // line 467
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 467, $this->source); })()), "request", [], "any", false, false, false, 467), "get", ["travelStyle"], "method", false, false, false, 467) == "adventure")) ? ("selected") : (""));
        yield ">Adventure</option>
                    <option value=\"relax\" ";
        // line 468
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 468, $this->source); })()), "request", [], "any", false, false, false, 468), "get", ["travelStyle"], "method", false, false, false, 468) == "relax")) ? ("selected") : (""));
        yield ">Relax</option>
                    <option value=\"cultural\" ";
        // line 469
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 469, $this->source); })()), "request", [], "any", false, false, false, 469), "get", ["travelStyle"], "method", false, false, false, 469) == "cultural")) ? ("selected") : (""));
        yield ">Cultural</option>
                    <option value=\"roadtrip\" ";
        // line 470
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 470, $this->source); })()), "request", [], "any", false, false, false, 470), "get", ["travelStyle"], "method", false, false, false, 470) == "roadtrip")) ? ("selected") : (""));
        yield ">Roadtrip</option>
                </select>
            </div>

            <div class=\"story-field rating\">
                <label for=\"story_rating\">Minimum rating</label>
                <select id=\"story_rating\" name=\"rating\">
                    <option value=\"\">Any rating</option>
                    ";
        // line 478
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 479
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\" ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 479, $this->source); })()), "request", [], "any", false, false, false, 479), "get", ["rating"], "method", false, false, false, 479) == Twig\Extension\CoreExtension::striptags($context["i"]))) ? ("selected") : (""));
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "+</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 481
        yield "                </select>
            </div>

            <div class=\"story-filter-actions\">
                <button class=\"story-filter-submit\" type=\"submit\">Apply</button>
                <a href=\"";
        // line 486
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_index");
        yield "\" class=\"story-filter-reset\">Reset</a>
            </div>
        </div>
    </form>

    <div class=\"story-grid\">
        ";
        // line 492
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stories"]) || array_key_exists("stories", $context) ? $context["stories"] : (function () { throw new RuntimeError('Variable "stories" does not exist.', 492, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
            // line 493
            yield "            <article class=\"story-card\">
                <div class=\"story-card-media\">
                    ";
            // line 495
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 495)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 496
                yield "                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 496), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 496), "html", null, true);
                yield "\">
                    ";
            }
            // line 498
            yield "                </div>

                <div class=\"story-card-body\">
                    <p class=\"story-card-location\">";
            // line 501
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 501)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 501), "html", null, true)) : ("Unknown destination"));
            yield "</p>
                    <h2 class=\"story-card-title\">
                        <a href=\"";
            // line 503
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 503)]), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 503), "html", null, true);
            yield "</a>
                    </h2>

                    <p class=\"story-card-text\">
                        ";
            // line 507
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 507)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 507), 0, 140) . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "summary", [], "any", false, false, false, 507)) > 140)) ? ("...") : (""))), "html", null, true)) : ("No summary yet."));
            yield "
                    </p>

                    <div class=\"story-card-chips\">
                        ";
            // line 511
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 511)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 512
                yield "                            <span class=\"story-chip rating\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 512), "html", null, true);
                yield "/5 rating</span>
                        ";
            }
            // line 514
            yield "                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 514)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 515
                yield "                            <span class=\"story-chip type\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 515)), "html", null, true);
                yield "</span>
                        ";
            }
            // line 517
            yield "                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 517)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 518
                yield "                            <span class=\"story-chip style\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 518)), "html", null, true);
                yield "</span>
                        ";
            }
            // line 520
            yield "                    </div>

                    <div class=\"story-card-flags\">
                        Recommend: <strong>";
            // line 523
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "wouldRecommend", [], "any", false, false, false, 523)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
            yield "</strong><br>
                        Go again: <strong>";
            // line 524
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "wouldGoAgain", [], "any", false, false, false, 524)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
            yield "</strong>
                    </div>

                    <a href=\"";
            // line 527
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 527)]), "html", null, true);
            yield "\" class=\"story-card-link\">Read story</a>
                </div>
            </article>
        ";
            $context['_iterated'] = true;
        }
        // line 530
        if (!$context['_iterated']) {
            // line 531
            yield "            <div class=\"story-empty\">
                <strong>No travel stories found.</strong><br>
                Try broader filters or be the first to share a new experience.
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['story'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 536
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
        return array (  756 => 536,  746 => 531,  744 => 530,  736 => 527,  730 => 524,  726 => 523,  721 => 520,  715 => 518,  712 => 517,  706 => 515,  703 => 514,  697 => 512,  695 => 511,  688 => 507,  679 => 503,  674 => 501,  669 => 498,  661 => 496,  659 => 495,  655 => 493,  650 => 492,  641 => 486,  634 => 481,  621 => 479,  617 => 478,  606 => 470,  602 => 469,  598 => 468,  594 => 467,  590 => 466,  586 => 465,  575 => 457,  571 => 456,  567 => 455,  563 => 454,  559 => 453,  549 => 446,  541 => 441,  530 => 433,  517 => 422,  507 => 421,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Travel Stories{% endblock %}

{% block stylesheets %}
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Sora:wght@400;500;600;700;800&display=swap');

.story-index-page {
    --story-bg-soft: #eef8f7;
    --story-panel: #ffffff;
    --story-text: #102027;
    --story-muted: #56757f;
    --story-border: #d4e7e5;
    --story-primary: #0f766e;
    --story-primary-strong: #115e59;
    --story-highlight: #f59e0b;
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 18px 72px;
    font-family: 'Sora', 'Segoe UI', sans-serif;
    color: var(--story-text);
}

.story-hero {
    position: relative;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 18px;
    background: linear-gradient(135deg, #e8f4f3 0%, #f7faf8 50%, #fff6e6 100%);
    border: 1px solid var(--story-border);
    border-radius: 26px;
    padding: 28px 28px 24px;
    margin-bottom: 22px;
}

.story-hero::before,
.story-hero::after {
    content: '';
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
}

.story-hero::before {
    width: 220px;
    height: 220px;
    right: -70px;
    top: -90px;
    background: radial-gradient(circle at center, rgba(21, 128, 119, 0.24), rgba(21, 128, 119, 0));
}

.story-hero::after {
    width: 170px;
    height: 170px;
    left: -50px;
    bottom: -85px;
    background: radial-gradient(circle at center, rgba(245, 158, 11, 0.24), rgba(245, 158, 11, 0));
}

.story-hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
}

.story-hero-label {
    display: inline-block;
    margin-bottom: 12px;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    color: var(--story-primary-strong);
}

.story-hero h1 {
    margin: 0;
    line-height: 1.08;
    font-size: clamp(34px, 5vw, 56px);
    font-family: 'DM Serif Display', Georgia, serif;
    font-weight: 400;
}

.story-hero p {
    margin: 12px 0 0;
    max-width: 60ch;
    color: var(--story-muted);
    line-height: 1.7;
    font-size: 14px;
}

.story-hero-actions {
    position: relative;
    z-index: 1;
    align-self: flex-end;
}

.story-hero-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 999px;
    border: 1px solid var(--story-primary);
    background: var(--story-primary);
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    padding: 12px 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    box-shadow: 0 10px 26px rgba(15, 118, 110, 0.22);
}

.story-hero-button:hover {
    transform: translateY(-2px);
    background: var(--story-primary-strong);
    box-shadow: 0 14px 30px rgba(17, 94, 89, 0.28);
}

.story-filter {
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 22px;
    padding: 20px;
    margin-bottom: 28px;
    box-shadow: 0 12px 28px rgba(16, 32, 39, 0.05);
}

.story-filter-grid {
    display: grid;
    grid-template-columns: repeat(12, minmax(0, 1fr));
    gap: 12px;
}

.story-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.story-field label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 700;
    color: var(--story-muted);
}

.story-field input,
.story-field select {
    width: 100%;
    border: 1px solid var(--story-border);
    border-radius: 12px;
    padding: 11px 12px;
    background: #fcfefe;
    font-size: 13px;
    font-family: inherit;
    color: var(--story-text);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.story-field input:focus,
.story-field select:focus {
    outline: none;
    border-color: #59b5a8;
    box-shadow: 0 0 0 3px rgba(89, 181, 168, 0.16);
}

.story-field.keyword { grid-column: span 3; }
.story-field.destination { grid-column: span 2; }
.story-field.type { grid-column: span 2; }
.story-field.style { grid-column: span 2; }
.story-field.rating { grid-column: span 2; }

.story-filter-actions {
    grid-column: span 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 8px;
}

.story-filter-submit,
.story-filter-reset {
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    border: 1px solid transparent;
}

.story-filter-submit {
    background: #111827;
    color: #ffffff;
}

.story-filter-submit:hover {
    background: #000000;
}

.story-filter-reset {
    border-color: var(--story-border);
    color: var(--story-muted);
    background: #ffffff;
}

.story-filter-reset:hover {
    border-color: #bcd7d4;
    color: var(--story-text);
}

.story-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    gap: 18px;
}

.story-card {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 20px;
    box-shadow: 0 10px 24px rgba(16, 32, 39, 0.06);
    animation: cardIn 0.45s cubic-bezier(0.22, 1, 0.36, 1) both;
    transition: transform 0.22s ease, box-shadow 0.22s ease;
}

.story-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 36px rgba(16, 32, 39, 0.12);
}

.story-card-media {
    height: 210px;
    overflow: hidden;
    background: linear-gradient(135deg, #d7f2ee 0%, #ecf7f6 100%);
}

.story-card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.story-card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 16px;
}

.story-card-location {
    margin: 0;
    font-size: 12px;
    color: var(--story-muted);
}

.story-card-title {
    margin: 6px 0 10px;
    line-height: 1.35;
    font-size: 19px;
    font-weight: 700;
}

.story-card-title a {
    color: inherit;
    text-decoration: none;
}

.story-card-title a:hover {
    color: var(--story-primary-strong);
}

.story-card-text {
    margin: 0;
    color: #3e5a62;
    line-height: 1.65;
    font-size: 13px;
}

.story-card-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin: 14px 0 12px;
}

.story-chip {
    font-size: 11px;
    border-radius: 999px;
    padding: 5px 10px;
    font-weight: 700;
    border: 1px solid transparent;
}

.story-chip.rating {
    background: #fff6df;
    border-color: #f4dd9e;
    color: #8a5a00;
}

.story-chip.type {
    background: #e0f4f2;
    border-color: #a5ddd7;
    color: #0f5b57;
}

.story-chip.style {
    background: #ecf2f7;
    border-color: #cbd8e4;
    color: #304a63;
}

.story-card-flags {
    margin-top: auto;
    padding-top: 10px;
    border-top: 1px dashed #d8e8e6;
    font-size: 12px;
    color: var(--story-muted);
    line-height: 1.6;
}

.story-card-flags strong {
    color: #173b45;
}

.story-card-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 11px;
    border: 1px solid var(--story-primary);
    color: var(--story-primary-strong);
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.story-card-link:hover {
    background: #e8f5f3;
}

.story-empty {
    background: var(--story-panel);
    border: 1px dashed #bfded9;
    border-radius: 20px;
    padding: 34px;
    text-align: center;
    color: var(--story-muted);
    line-height: 1.7;
}

.story-empty strong {
    color: var(--story-text);
}

@keyframes cardIn {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 1024px) {
    .story-field.keyword { grid-column: span 4; }
    .story-field.destination { grid-column: span 4; }
    .story-field.type { grid-column: span 4; }
    .story-field.style { grid-column: span 4; }
    .story-field.rating { grid-column: span 4; }
    .story-filter-actions {
        grid-column: 1 / -1;
        flex-direction: row;
    }
}

@media (max-width: 768px) {
    .story-index-page {
        padding: calc(var(--nav-height, 70px) + 16px) 12px 48px;
    }

    .story-hero {
        border-radius: 18px;
        padding: 22px 16px;
    }

    .story-field.keyword,
    .story-field.destination,
    .story-field.type,
    .story-field.style,
    .story-field.rating {
        grid-column: span 12;
    }

    .story-filter {
        border-radius: 16px;
        padding: 14px;
    }

    .story-filter-actions {
        flex-direction: column;
    }
}
</style>
{% endblock %}

{% block body %}
<div class=\"story-index-page\">
    <section class=\"story-hero\">
        <div class=\"story-hero-content\">
            <span class=\"story-hero-label\">TripX Journal</span>
            <h1>Travel stories from real explorers.</h1>
            <p>
                Discover routes, practical tips, and honest recommendations from travelers.
                Filter by destination, style, and rating to find the stories that match your next trip.
            </p>
        </div>
        <div class=\"story-hero-actions\">
            <a href=\"{{ path('travel_story_new') }}\" class=\"story-hero-button\">Write your story</a>
        </div>
    </section>

    <form method=\"get\" class=\"story-filter\">
        <div class=\"story-filter-grid\">
            <div class=\"story-field keyword\">
                <label for=\"story_keyword\">Keyword</label>
                <input id=\"story_keyword\" type=\"text\" name=\"keyword\" placeholder=\"Beach, city, food...\" value=\"{{ app.request.get('keyword') }}\">
            </div>

            <div class=\"story-field destination\">
                <label for=\"story_destination\">Destination</label>
                <input id=\"story_destination\" type=\"text\" name=\"destination\" placeholder=\"Tunisia, Rome...\" value=\"{{ app.request.get('destination') }}\">
            </div>

            <div class=\"story-field type\">
                <label for=\"story_travel_type\">Travel type</label>
                <select id=\"story_travel_type\" name=\"travelType\">
                    <option value=\"\">Any type</option>
                    <option value=\"solo\" {{ app.request.get('travelType') == 'solo' ? 'selected' : '' }}>Solo</option>
                    <option value=\"couple\" {{ app.request.get('travelType') == 'couple' ? 'selected' : '' }}>Couple</option>
                    <option value=\"family\" {{ app.request.get('travelType') == 'family' ? 'selected' : '' }}>Family</option>
                    <option value=\"friends\" {{ app.request.get('travelType') == 'friends' ? 'selected' : '' }}>Friends</option>
                    <option value=\"business\" {{ app.request.get('travelType') == 'business' ? 'selected' : '' }}>Business</option>
                </select>
            </div>

            <div class=\"story-field style\">
                <label for=\"story_travel_style\">Travel style</label>
                <select id=\"story_travel_style\" name=\"travelStyle\">
                    <option value=\"\">Any style</option>
                    <option value=\"luxury\" {{ app.request.get('travelStyle') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                    <option value=\"budget\" {{ app.request.get('travelStyle') == 'budget' ? 'selected' : '' }}>Budget</option>
                    <option value=\"adventure\" {{ app.request.get('travelStyle') == 'adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value=\"relax\" {{ app.request.get('travelStyle') == 'relax' ? 'selected' : '' }}>Relax</option>
                    <option value=\"cultural\" {{ app.request.get('travelStyle') == 'cultural' ? 'selected' : '' }}>Cultural</option>
                    <option value=\"roadtrip\" {{ app.request.get('travelStyle') == 'roadtrip' ? 'selected' : '' }}>Roadtrip</option>
                </select>
            </div>

            <div class=\"story-field rating\">
                <label for=\"story_rating\">Minimum rating</label>
                <select id=\"story_rating\" name=\"rating\">
                    <option value=\"\">Any rating</option>
                    {% for i in 1..5 %}
                        <option value=\"{{ i }}\" {{ app.request.get('rating') == i|striptags ? 'selected' : '' }}>{{ i }}+</option>
                    {% endfor %}
                </select>
            </div>

            <div class=\"story-filter-actions\">
                <button class=\"story-filter-submit\" type=\"submit\">Apply</button>
                <a href=\"{{ path('travel_story_index') }}\" class=\"story-filter-reset\">Reset</a>
            </div>
        </div>
    </form>

    <div class=\"story-grid\">
        {% for story in stories %}
            <article class=\"story-card\">
                <div class=\"story-card-media\">
                    {% if story.coverImageUrl %}
                        <img src=\"{{ story.coverImageUrl }}\" alt=\"{{ story.title }}\">
                    {% endif %}
                </div>

                <div class=\"story-card-body\">
                    <p class=\"story-card-location\">{{ story.destination ?: 'Unknown destination' }}</p>
                    <h2 class=\"story-card-title\">
                        <a href=\"{{ path('travel_story_show', {id: story.id}) }}\">{{ story.title }}</a>
                    </h2>

                    <p class=\"story-card-text\">
                        {{ story.summary ? story.summary|slice(0, 140) ~ (story.summary|length > 140 ? '...' : '') : 'No summary yet.' }}
                    </p>

                    <div class=\"story-card-chips\">
                        {% if story.overallRating %}
                            <span class=\"story-chip rating\">{{ story.overallRating }}/5 rating</span>
                        {% endif %}
                        {% if story.travelType %}
                            <span class=\"story-chip type\">{{ story.travelType|capitalize }}</span>
                        {% endif %}
                        {% if story.travelStyle %}
                            <span class=\"story-chip style\">{{ story.travelStyle|capitalize }}</span>
                        {% endif %}
                    </div>

                    <div class=\"story-card-flags\">
                        Recommend: <strong>{{ story.wouldRecommend ? 'Yes' : 'No' }}</strong><br>
                        Go again: <strong>{{ story.wouldGoAgain ? 'Yes' : 'No' }}</strong>
                    </div>

                    <a href=\"{{ path('travel_story_show', {id: story.id}) }}\" class=\"story-card-link\">Read story</a>
                </div>
            </article>
        {% else %}
            <div class=\"story-empty\">
                <strong>No travel stories found.</strong><br>
                Try broader filters or be the first to share a new experience.
            </div>
        {% endfor %}
    </div>
</div>
{% endblock %}", "front/blog/travel_story_index.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\blog\\travel_story_index.html.twig");
    }
}
