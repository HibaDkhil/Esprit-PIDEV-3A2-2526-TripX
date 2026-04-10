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

/* front/blog/travel_story_show.html.twig */
class __TwigTemplate_4b2addd079d0c67ea66a3cfad1baa25d extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/travel_story_show.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 3, $this->source); })()), "title", [], "any", false, false, false, 3), "html", null, true);
        yield " | Travel Story";
        
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
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
<link href=\"https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Sora:wght@400;500;600;700;800&display=swap\" rel=\"stylesheet\">
<style>
.travel-story-page {
    --story-bg: #f6fbff;
    --story-panel: #ffffff;
    --story-panel-soft: #f8fbff;
    --story-text: #0f172a;
    --story-muted: #64748b;
    --story-border: #dbeafe;
    --story-primary: #2563eb;
    --story-primary-strong: #1d4ed8;
    --story-accent: #38bdf8;
    max-width: 1180px;
    margin: 0 auto;
    padding: 44px 18px 72px;
    color: var(--story-text);
    font-family: 'Sora', 'Segoe UI', sans-serif;
}

.story-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    color: var(--story-primary-strong);
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.story-back:hover {
    color: #0b3f3c;
}

.story-flash {
    border-radius: 16px;
    padding: 14px 16px;
    margin-bottom: 14px;
    font-size: 14px;
    font-weight: 600;
}

.story-flash.success {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
}

.story-flash.error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.story-shell {
    display: grid;
    gap: 22px;
}

.story-hero {
    position: relative;
    overflow: hidden;
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
    gap: 0;
    background: linear-gradient(135deg, #eff6ff 0%, #f8fbff 52%, #ecfeff 100%);
    border: 1px solid var(--story-border);
    border-radius: 30px;
    box-shadow: 0 22px 48px rgba(16, 32, 39, 0.08);
}

.story-hero::before,
.story-hero::after {
    content: '';
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
}

.story-hero::before {
    width: 260px;
    height: 260px;
    left: -110px;
    top: -120px;
    background: radial-gradient(circle at center, rgba(37, 99, 235, 0.18), rgba(37, 99, 235, 0));
}

.story-hero::after {
    width: 220px;
    height: 220px;
    right: -80px;
    bottom: -100px;
    background: radial-gradient(circle at center, rgba(56, 189, 248, 0.24), rgba(56, 189, 248, 0));
}

.story-hero-content {
    position: relative;
    z-index: 1;
    padding: 34px 34px 32px;
}

.story-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(37, 99, 235, 0.1);
    color: var(--story-primary-strong);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.story-title {
    margin: 0 0 14px;
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: clamp(2.3rem, 4vw, 4.2rem);
    line-height: 0.98;
    font-weight: 400;
}

.story-subtitle {
    margin: 0 0 18px;
    max-width: 58ch;
    color: var(--story-muted);
    line-height: 1.75;
    font-size: 14px;
}

.story-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 18px;
}

.story-pill {
    display: inline-flex;
    align-items: center;
    min-height: 38px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.82);
    border: 1px solid rgba(37, 99, 235, 0.14);
    color: var(--story-text);
    font-size: 12px;
    font-weight: 700;
}

.story-author-line {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    align-items: center;
    margin-bottom: 24px;
}

.story-author-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #38bdf8);
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    flex-shrink: 0;
}

.story-author-name {
    display: block;
    font-size: 16px;
    font-weight: 700;
}

.story-author-date {
    display: block;
    margin-top: 3px;
    color: var(--story-muted);
    font-size: 12px;
}

.story-owner-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 2px;
}

.story-action,
.story-action-danger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 11px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.story-action {
    border: 1px solid var(--story-primary);
    background: var(--story-primary);
    color: #ffffff;
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.18);
}

.story-action:hover {
    transform: translateY(-1px);
    background: var(--story-primary-strong);
}

.story-action-danger {
    border: 1px solid #f4b7be;
    background: #fff1f2;
    color: #be123c;
}

.story-action-danger:hover {
    transform: translateY(-1px);
    background: #ffe4e6;
}

.story-hero-media {
    position: relative;
    min-height: 100%;
    border-left: 1px solid rgba(37, 99, 235, 0.08);
}

.story-hero-image {
    width: 100%;
    height: 100%;
    min-height: 430px;
    object-fit: cover;
    display: block;
}

.story-hero-placeholder {
    min-height: 430px;
    height: 100%;
    display: grid;
    place-items: center;
    background:
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.82), rgba(255,255,255,0) 36%),
        linear-gradient(135deg, #dbeafe 0%, #f8fbff 55%, #e0f2fe 100%);
    color: #2563eb;
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: clamp(2.2rem, 5vw, 4.6rem);
}

.story-hero-overlay {
    position: absolute;
    left: 18px;
    right: 18px;
    bottom: 18px;
    display: grid;
    gap: 10px;
}

.story-fact-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.story-fact {
    background: rgba(15, 23, 42, 0.62);
    color: #ffffff;
    backdrop-filter: blur(10px);
    border-radius: 18px;
    padding: 13px 14px;
}

.story-fact-label {
    display: block;
    margin-bottom: 4px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
}

.story-fact-value {
    display: block;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
}

.story-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(290px, 0.85fr);
    gap: 22px;
    align-items: start;
}

.story-main,
.story-sidebar {
    display: grid;
    gap: 22px;
}

.story-card {
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 14px 34px rgba(16, 32, 39, 0.05);
}

.story-card.soft {
    background: var(--story-panel-soft);
}

.story-section-title {
    margin: 0 0 14px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--story-primary-strong);
}

.story-summary-text,
.story-copy {
    margin: 0;
    color: #15313a;
    line-height: 1.9;
    font-size: 15px;
}

.story-chip-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.story-chip {
    display: inline-flex;
    align-items: center;
    padding: 9px 12px;
    border-radius: 999px;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: var(--story-primary-strong);
    font-size: 12px;
    font-weight: 700;
}

.story-list-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
}

.story-list-block {
    border: 1px solid var(--story-border);
    border-radius: 20px;
    padding: 18px;
    background: #ffffff;
}

.story-list-block h3 {
    margin: 0 0 12px;
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
}

.story-bullet-list {
    margin: 0;
    padding-left: 18px;
    color: #26404a;
    line-height: 1.8;
    font-size: 14px;
}

.story-budget-grid {
    display: grid;
    gap: 12px;
}

.story-budget-item {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 12px 14px;
    border-radius: 16px;
    background: #f8fbfb;
    border: 1px solid var(--story-border);
    font-size: 14px;
}

.story-budget-key {
    color: var(--story-muted);
    font-weight: 700;
    text-transform: capitalize;
}

.story-budget-value {
    color: var(--story-text);
    font-weight: 800;
    text-align: right;
}

.story-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 12px;
}

.story-gallery img {
    width: 100%;
    height: 210px;
    object-fit: cover;
    display: block;
    border-radius: 18px;
    border: 1px solid var(--story-border);
}

.story-sidebar .story-card {
    padding: 20px;
}

.story-detail-stack {
    display: grid;
    gap: 14px;
}

.story-detail {
    display: grid;
    gap: 5px;
    padding-bottom: 14px;
    border-bottom: 1px solid #e7f0ee;
}

.story-detail:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.story-detail-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--story-muted);
}

.story-detail-value {
    font-size: 15px;
    font-weight: 700;
    color: var(--story-text);
    line-height: 1.5;
}

.story-badge-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.story-badge {
    min-height: 52px;
    padding: 10px 14px;
    border-radius: 18px;
    background: #f8fbfb;
    border: 1px solid var(--story-border);
}

.story-badge strong {
    display: block;
    margin-bottom: 3px;
    font-size: 11px;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--story-muted);
}

.story-badge span {
    font-size: 15px;
    font-weight: 800;
    color: var(--story-text);
}

.story-empty-note {
    margin: 0;
    color: var(--story-muted);
    line-height: 1.7;
    font-size: 14px;
}

@media (max-width: 980px) {
    .story-hero,
    .story-layout {
        grid-template-columns: 1fr;
    }

    .story-hero-media {
        border-left: none;
        border-top: 1px solid rgba(15, 118, 110, 0.08);
    }
}

@media (max-width: 640px) {
    .travel-story-page {
        padding: 28px 12px 52px;
    }

    .story-hero-content,
    .story-card {
        padding: 20px;
    }

    .story-fact-grid {
        grid-template-columns: 1fr;
    }

    .story-title {
        font-size: 2.4rem;
    }

    .story-gallery {
        grid-template-columns: 1fr;
    }

    .story-gallery img {
        height: 230px;
    }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 554
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 555
        $context["heroImage"] = ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 555, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 555)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 555, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 555)) : ((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 555, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 555))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 555, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 555))) : (null))));
        // line 556
        yield "
<div class=\"travel-story-page\">
    <a href=\"";
        // line 558
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"story-back\">Back to travel stories</a>

    ";
        // line 560
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 560, $this->source); })()), "flashes", ["success"], "method", false, false, false, 560));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 561
            yield "        <div class=\"story-flash success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 563
        yield "
    ";
        // line 564
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 564, $this->source); })()), "flashes", ["error"], "method", false, false, false, 564));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 565
            yield "        <div class=\"story-flash error\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 567
        yield "
    <div class=\"story-shell\">
        <section class=\"story-hero\">
            <div class=\"story-hero-content\">
                <span class=\"story-kicker\">Travel Story</span>

                <h1 class=\"story-title\">";
        // line 573
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 573, $this->source); })()), "title", [], "any", false, false, false, 573), "html", null, true);
        yield "</h1>

                ";
        // line 575
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 575, $this->source); })()), "summary", [], "any", false, false, false, 575)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 576
            yield "                    <p class=\"story-subtitle\">
                        ";
            // line 577
            yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 577, $this->source); })()), "summary", [], "any", false, false, false, 577)) > 220)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 577, $this->source); })()), "summary", [], "any", false, false, false, 577), 0, 220) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 577, $this->source); })()), "summary", [], "any", false, false, false, 577), "html", null, true)));
            yield "
                    </p>
                ";
        } else {
            // line 580
            yield "                    <p class=\"story-subtitle\">A traveler log with practical notes, highlights, and personal recommendations.</p>
                ";
        }
        // line 582
        yield "
                <div class=\"story-meta-row\">
                    ";
        // line 584
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 584, $this->source); })()), "destination", [], "any", false, false, false, 584)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 585
            yield "                        <span class=\"story-pill\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 585, $this->source); })()), "destination", [], "any", false, false, false, 585), "html", null, true);
            yield "</span>
                    ";
        }
        // line 587
        yield "                    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 587, $this->source); })()), "travelType", [], "any", false, false, false, 587)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 588
            yield "                        <span class=\"story-pill\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 588, $this->source); })()), "travelType", [], "any", false, false, false, 588), ["_" => " "])), "html", null, true);
            yield "</span>
                    ";
        }
        // line 590
        yield "                    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 590, $this->source); })()), "travelStyle", [], "any", false, false, false, 590)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 591
            yield "                        <span class=\"story-pill\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 591, $this->source); })()), "travelStyle", [], "any", false, false, false, 591), ["_" => " "])), "html", null, true);
            yield "</span>
                    ";
        }
        // line 593
        yield "                    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 593, $this->source); })()), "overallRating", [], "any", false, false, false, 593)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 594
            yield "                        <span class=\"story-pill\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 594, $this->source); })()), "overallRating", [], "any", false, false, false, 594), "html", null, true);
            yield "/5 rating</span>
                    ";
        }
        // line 596
        yield "                </div>

                <div class=\"story-author-line\">
                    <span class=\"story-author-avatar\">";
        // line 599
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 599, $this->source); })()))), "html", null, true);
        yield "</span>
                    <div>
                        <span class=\"story-author-name\">";
        // line 601
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 601, $this->source); })()), "html", null, true);
        yield "</span>
                        <span class=\"story-author-date\">
                            ";
        // line 603
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 603, $this->source); })()), "createdAt", [], "any", false, false, false, 603)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 604
            yield "                                Published ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 604, $this->source); })()), "createdAt", [], "any", false, false, false, 604), "M d, Y"), "html", null, true);
            yield "
                            ";
        } else {
            // line 606
            yield "                                Shared recently
                            ";
        }
        // line 608
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 608, $this->source); })()), "updatedAt", [], "any", false, false, false, 608) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 608, $this->source); })()), "updatedAt", [], "any", false, false, false, 608) != CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 608, $this->source); })()), "createdAt", [], "any", false, false, false, 608)))) {
            // line 609
            yield "                                | Updated ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 609, $this->source); })()), "updatedAt", [], "any", false, false, false, 609), "M d, Y"), "html", null, true);
            yield "
                            ";
        }
        // line 611
        yield "                        </span>
                    </div>
                </div>

                ";
        // line 615
        if ((($tmp = (isset($context["canManageStory"]) || array_key_exists("canManageStory", $context) ? $context["canManageStory"] : (function () { throw new RuntimeError('Variable "canManageStory" does not exist.', 615, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 616
            yield "                    <div class=\"story-owner-actions\">
                        <a href=\"";
            // line 617
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 617, $this->source); })()), "id", [], "any", false, false, false, 617)]), "html", null, true);
            yield "\" class=\"story-action\">Edit story</a>
                        <form method=\"post\" action=\"";
            // line 618
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 618, $this->source); })()), "id", [], "any", false, false, false, 618)]), "html", null, true);
            yield "\" onsubmit=\"return confirm('Delete this travel story?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 619
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_travel_story_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 619, $this->source); })()), "id", [], "any", false, false, false, 619))), "html", null, true);
            yield "\">
                            <button type=\"submit\" class=\"story-action-danger\">Delete story</button>
                        </form>
                    </div>
                ";
        }
        // line 624
        yield "            </div>

            <div class=\"story-hero-media\">
                ";
        // line 627
        if ((($tmp = (isset($context["heroImage"]) || array_key_exists("heroImage", $context) ? $context["heroImage"] : (function () { throw new RuntimeError('Variable "heroImage" does not exist.', 627, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 628
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["heroImage"]) || array_key_exists("heroImage", $context) ? $context["heroImage"] : (function () { throw new RuntimeError('Variable "heroImage" does not exist.', 628, $this->source); })()), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 628, $this->source); })()), "title", [], "any", false, false, false, 628), "html", null, true);
            yield "\" class=\"story-hero-image\">
                ";
        } else {
            // line 630
            yield "                    <div class=\"story-hero-placeholder\">";
            yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 630, $this->source); })()), "destination", [], "any", false, false, false, 630)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 630, $this->source); })()), "destination", [], "any", false, false, false, 630), "html", null, true)) : ("Trip"));
            yield "</div>
                ";
        }
        // line 632
        yield "
                <div class=\"story-hero-overlay\">
                    <div class=\"story-fact-grid\">
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Trip window</span>
                            <span class=\"story-fact-value\">
                                ";
        // line 638
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 638, $this->source); })()), "startDate", [], "any", false, false, false, 638) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 638, $this->source); })()), "endDate", [], "any", false, false, false, 638))) {
            // line 639
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 639, $this->source); })()), "startDate", [], "any", false, false, false, 639), "M d, Y"), "html", null, true);
            yield " to ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 639, $this->source); })()), "endDate", [], "any", false, false, false, 639), "M d, Y"), "html", null, true);
            yield "
                                ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 640
(isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 640, $this->source); })()), "startDate", [], "any", false, false, false, 640)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 641
            yield "                                    From ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 641, $this->source); })()), "startDate", [], "any", false, false, false, 641), "M d, Y"), "html", null, true);
            yield "
                                ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 642
(isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 642, $this->source); })()), "endDate", [], "any", false, false, false, 642)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 643
            yield "                                    Until ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 643, $this->source); })()), "endDate", [], "any", false, false, false, 643), "M d, Y"), "html", null, true);
            yield "
                                ";
        } else {
            // line 645
            yield "                                    Dates not specified
                                ";
        }
        // line 647
        yield "                            </span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Trip length</span>
                            <span class=\"story-fact-value\">
                                ";
        // line 652
        if ((($tmp = (isset($context["tripLengthDays"]) || array_key_exists("tripLengthDays", $context) ? $context["tripLengthDays"] : (function () { throw new RuntimeError('Variable "tripLengthDays" does not exist.', 652, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 653
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["tripLengthDays"]) || array_key_exists("tripLengthDays", $context) ? $context["tripLengthDays"] : (function () { throw new RuntimeError('Variable "tripLengthDays" does not exist.', 653, $this->source); })()), "html", null, true);
            yield " day";
            yield ((((isset($context["tripLengthDays"]) || array_key_exists("tripLengthDays", $context) ? $context["tripLengthDays"] : (function () { throw new RuntimeError('Variable "tripLengthDays" does not exist.', 653, $this->source); })()) > 1)) ? ("s") : (""));
            yield "
                                ";
        } else {
            // line 655
            yield "                                    Flexible
                                ";
        }
        // line 657
        yield "                            </span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Would recommend</span>
                            <span class=\"story-fact-value\">";
        // line 661
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 661, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 661)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Would go again</span>
                            <span class=\"story-fact-value\">";
        // line 665
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 665, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 665)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class=\"story-layout\">
            <div class=\"story-main\">
                ";
        // line 674
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 674, $this->source); })()), "summary", [], "any", false, false, false, 674)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 675
            yield "                    <section class=\"story-card soft\">
                        <h2 class=\"story-section-title\">Story Summary</h2>
                        <p class=\"story-summary-text\">";
            // line 677
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 677, $this->source); })()), "summary", [], "any", false, false, false, 677), "html", null, true));
            yield "</p>
                    </section>
                ";
        }
        // line 680
        yield "
                ";
        // line 681
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 681, $this->source); })()), "tips", [], "any", false, false, false, 681)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 682
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Tips From The Traveler</h2>
                        <p class=\"story-copy\">";
            // line 684
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 684, $this->source); })()), "tips", [], "any", false, false, false, 684), "html", null, true));
            yield "</p>
                    </section>
                ";
        }
        // line 687
        yield "
                ";
        // line 688
        if (((( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 688, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 688)) ||  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 688, $this->source); })()), "mustDoJson", [], "any", false, false, false, 688))) ||  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 688, $this->source); })()), "mustTryJson", [], "any", false, false, false, 688))) ||  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 688, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 688)))) {
            // line 689
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Highlights And Recommendations</h2>
                        <div class=\"story-list-grid\">
                            ";
            // line 692
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 692, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 692))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 693
                yield "                                <div class=\"story-list-block\">
                                    <h3>Must Visit</h3>
                                    <ul class=\"story-bullet-list\">
                                        ";
                // line 696
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 696, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 696));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 697
                    yield "                                            ";
                    if ((($tmp = $context["item"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 698
                        yield "                                                <li>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                        yield "</li>
                                            ";
                    }
                    // line 700
                    yield "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 701
                yield "                                    </ul>
                                </div>
                            ";
            }
            // line 704
            yield "
                            ";
            // line 705
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 705, $this->source); })()), "mustDoJson", [], "any", false, false, false, 705))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 706
                yield "                                <div class=\"story-list-block\">
                                    <h3>Must Do</h3>
                                    <ul class=\"story-bullet-list\">
                                        ";
                // line 709
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 709, $this->source); })()), "mustDoJson", [], "any", false, false, false, 709));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 710
                    yield "                                            ";
                    if ((($tmp = $context["item"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 711
                        yield "                                                <li>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                        yield "</li>
                                            ";
                    }
                    // line 713
                    yield "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 714
                yield "                                    </ul>
                                </div>
                            ";
            }
            // line 717
            yield "
                            ";
            // line 718
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 718, $this->source); })()), "mustTryJson", [], "any", false, false, false, 718))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 719
                yield "                                <div class=\"story-list-block\">
                                    <h3>Must Try</h3>
                                    <ul class=\"story-bullet-list\">
                                        ";
                // line 722
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 722, $this->source); })()), "mustTryJson", [], "any", false, false, false, 722));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 723
                    yield "                                            ";
                    if ((($tmp = $context["item"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 724
                        yield "                                                <li>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                        yield "</li>
                                            ";
                    }
                    // line 726
                    yield "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 727
                yield "                                    </ul>
                                </div>
                            ";
            }
            // line 730
            yield "
                            ";
            // line 731
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 731, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 731))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 732
                yield "                                <div class=\"story-list-block\">
                                    <h3>Favorite Places</h3>
                                    <ul class=\"story-bullet-list\">
                                        ";
                // line 735
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 735, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 735));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 736
                    yield "                                            ";
                    if ((($tmp = $context["item"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 737
                        yield "                                                <li>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                        yield "</li>
                                            ";
                    }
                    // line 739
                    yield "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 740
                yield "                                    </ul>
                                </div>
                            ";
            }
            // line 743
            yield "                        </div>
                    </section>
                ";
        }
        // line 746
        yield "
                ";
        // line 747
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 747, $this->source); })()), "budgetJson", [], "any", false, false, false, 747))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 748
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Budget Breakdown</h2>
                        <div class=\"story-budget-grid\">
                            ";
            // line 751
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 751, $this->source); })()), "budgetJson", [], "any", false, false, false, 751));
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 752
                yield "                                <div class=\"story-budget-item\">
                                    <span class=\"story-budget-key\">";
                // line 753
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace($context["key"], ["_" => " "])), "html", null, true);
                yield "</span>
                                    <span class=\"story-budget-value\">
                                        ";
                // line 755
                if (is_iterable($context["value"])) {
                    // line 756
                    yield "                                            ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode($context["value"]), "html", null, true);
                    yield "
                                        ";
                } else {
                    // line 758
                    yield "                                            ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
                    yield "
                                        ";
                }
                // line 760
                yield "                                    </span>
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 763
            yield "                        </div>
                    </section>
                ";
        }
        // line 766
        yield "
                ";
        // line 767
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 767, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 767))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 768
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Photo Gallery</h2>
                        <div class=\"story-gallery\">
                            ";
            // line 771
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 771, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 771));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 772
                yield "                                ";
                if ((($tmp = $context["image"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 773
                    yield "                                    <img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                    yield "\" alt=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 773, $this->source); })()), "title", [], "any", false, false, false, 773), "html", null, true);
                    yield " image ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 773), "html", null, true);
                    yield "\">
                                ";
                }
                // line 775
                yield "                            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 776
            yield "                        </div>
                    </section>
                ";
        }
        // line 779
        yield "            </div>

            <aside class=\"story-sidebar\">
                <section class=\"story-card\">
                    <h2 class=\"story-section-title\">Quick Details</h2>
                    <div class=\"story-detail-stack\">
                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Destination</span>
                            <span class=\"story-detail-value\">";
        // line 787
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 787, $this->source); })()), "destination", [], "any", false, false, false, 787)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 787, $this->source); })()), "destination", [], "any", false, false, false, 787), "html", null, true)) : ("Not specified"));
        yield "</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Travel Type</span>
                            <span class=\"story-detail-value\">";
        // line 792
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 792, $this->source); })()), "travelType", [], "any", false, false, false, 792)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 792, $this->source); })()), "travelType", [], "any", false, false, false, 792), ["_" => " "])), "html", null, true)) : ("Not specified"));
        yield "</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Travel Style</span>
                            <span class=\"story-detail-value\">";
        // line 797
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 797, $this->source); })()), "travelStyle", [], "any", false, false, false, 797)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 797, $this->source); })()), "travelStyle", [], "any", false, false, false, 797), ["_" => " "])), "html", null, true)) : ("Not specified"));
        yield "</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Overall Rating</span>
                            <span class=\"story-detail-value\">";
        // line 802
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 802, $this->source); })()), "overallRating", [], "any", false, false, false, 802)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 802, $this->source); })()), "overallRating", [], "any", false, false, false, 802) . "/5"), "html", null, true)) : ("Not rated"));
        yield "</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Budget</span>
                            <span class=\"story-detail-value\">
                                ";
        // line 808
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 808, $this->source); })()), "totalBudget", [], "any", false, false, false, 808)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 809
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 809, $this->source); })()), "totalBudget", [], "any", false, false, false, 809), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 809, $this->source); })()), "currency", [], "any", false, false, false, 809), "html", null, true);
            yield "
                                ";
        } else {
            // line 811
            yield "                                    Not shared
                                ";
        }
        // line 813
        yield "                            </span>
                        </div>
                    </div>
                </section>

                <section class=\"story-card\">
                    <h2 class=\"story-section-title\">Traveler Verdict</h2>
                    <div class=\"story-badge-row\">
                        <div class=\"story-badge\">
                            <strong>Recommend</strong>
                            <span>";
        // line 823
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 823, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 823)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</span>
                        </div>
                        <div class=\"story-badge\">
                            <strong>Return Trip</strong>
                            <span>";
        // line 827
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 827, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 827)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</span>
                        </div>
                    </div>
                </section>

                ";
        // line 832
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 832, $this->source); })()), "tagsJson", [], "any", false, false, false, 832))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 833
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Tags</h2>
                        <div class=\"story-chip-list\">
                            ";
            // line 836
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 836, $this->source); })()), "tagsJson", [], "any", false, false, false, 836));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 837
                yield "                                ";
                if ((($tmp = $context["tag"]) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 838
                    yield "                                    <span class=\"story-chip\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["tag"], "html", null, true);
                    yield "</span>
                                ";
                }
                // line 840
                yield "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 841
            yield "                        </div>
                    </section>
                ";
        }
        // line 844
        yield "
                ";
        // line 845
        if (((((((Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "summary", [], "any", false, false, false, 845)) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "tips", [], "any", false, false, false, 845))) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 845))) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "mustDoJson", [], "any", false, false, false, 845))) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "mustTryJson", [], "any", false, false, false, 845))) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 845))) && Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 845, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 845)))) {
            // line 846
            yield "                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Notes</h2>
                        <p class=\"story-empty-note\">This story is live, but the traveler kept the write-up concise. More details can still be added later from the edit screen.</p>
                    </section>
                ";
        }
        // line 851
        yield "            </aside>
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
        return "front/blog/travel_story_show.html.twig";
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
        return array (  1335 => 851,  1328 => 846,  1326 => 845,  1323 => 844,  1318 => 841,  1312 => 840,  1306 => 838,  1303 => 837,  1299 => 836,  1294 => 833,  1292 => 832,  1284 => 827,  1277 => 823,  1265 => 813,  1261 => 811,  1253 => 809,  1251 => 808,  1242 => 802,  1234 => 797,  1226 => 792,  1218 => 787,  1208 => 779,  1203 => 776,  1189 => 775,  1179 => 773,  1176 => 772,  1159 => 771,  1154 => 768,  1152 => 767,  1149 => 766,  1144 => 763,  1136 => 760,  1130 => 758,  1124 => 756,  1122 => 755,  1117 => 753,  1114 => 752,  1110 => 751,  1105 => 748,  1103 => 747,  1100 => 746,  1095 => 743,  1090 => 740,  1084 => 739,  1078 => 737,  1075 => 736,  1071 => 735,  1066 => 732,  1064 => 731,  1061 => 730,  1056 => 727,  1050 => 726,  1044 => 724,  1041 => 723,  1037 => 722,  1032 => 719,  1030 => 718,  1027 => 717,  1022 => 714,  1016 => 713,  1010 => 711,  1007 => 710,  1003 => 709,  998 => 706,  996 => 705,  993 => 704,  988 => 701,  982 => 700,  976 => 698,  973 => 697,  969 => 696,  964 => 693,  962 => 692,  957 => 689,  955 => 688,  952 => 687,  946 => 684,  942 => 682,  940 => 681,  937 => 680,  931 => 677,  927 => 675,  925 => 674,  913 => 665,  906 => 661,  900 => 657,  896 => 655,  888 => 653,  886 => 652,  879 => 647,  875 => 645,  869 => 643,  867 => 642,  862 => 641,  860 => 640,  853 => 639,  851 => 638,  843 => 632,  837 => 630,  829 => 628,  827 => 627,  822 => 624,  814 => 619,  810 => 618,  806 => 617,  803 => 616,  801 => 615,  795 => 611,  789 => 609,  786 => 608,  782 => 606,  776 => 604,  774 => 603,  769 => 601,  764 => 599,  759 => 596,  753 => 594,  750 => 593,  744 => 591,  741 => 590,  735 => 588,  732 => 587,  726 => 585,  724 => 584,  720 => 582,  716 => 580,  710 => 577,  707 => 576,  705 => 575,  700 => 573,  692 => 567,  683 => 565,  679 => 564,  676 => 563,  667 => 561,  663 => 560,  658 => 558,  654 => 556,  652 => 555,  642 => 554,  87 => 6,  77 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ story.title }} | Travel Story{% endblock %}

{% block stylesheets %}
{{ parent() }}
<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
<link href=\"https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Sora:wght@400;500;600;700;800&display=swap\" rel=\"stylesheet\">
<style>
.travel-story-page {
    --story-bg: #f6fbff;
    --story-panel: #ffffff;
    --story-panel-soft: #f8fbff;
    --story-text: #0f172a;
    --story-muted: #64748b;
    --story-border: #dbeafe;
    --story-primary: #2563eb;
    --story-primary-strong: #1d4ed8;
    --story-accent: #38bdf8;
    max-width: 1180px;
    margin: 0 auto;
    padding: 44px 18px 72px;
    color: var(--story-text);
    font-family: 'Sora', 'Segoe UI', sans-serif;
}

.story-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    color: var(--story-primary-strong);
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.story-back:hover {
    color: #0b3f3c;
}

.story-flash {
    border-radius: 16px;
    padding: 14px 16px;
    margin-bottom: 14px;
    font-size: 14px;
    font-weight: 600;
}

.story-flash.success {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
}

.story-flash.error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.story-shell {
    display: grid;
    gap: 22px;
}

.story-hero {
    position: relative;
    overflow: hidden;
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
    gap: 0;
    background: linear-gradient(135deg, #eff6ff 0%, #f8fbff 52%, #ecfeff 100%);
    border: 1px solid var(--story-border);
    border-radius: 30px;
    box-shadow: 0 22px 48px rgba(16, 32, 39, 0.08);
}

.story-hero::before,
.story-hero::after {
    content: '';
    position: absolute;
    border-radius: 999px;
    pointer-events: none;
}

.story-hero::before {
    width: 260px;
    height: 260px;
    left: -110px;
    top: -120px;
    background: radial-gradient(circle at center, rgba(37, 99, 235, 0.18), rgba(37, 99, 235, 0));
}

.story-hero::after {
    width: 220px;
    height: 220px;
    right: -80px;
    bottom: -100px;
    background: radial-gradient(circle at center, rgba(56, 189, 248, 0.24), rgba(56, 189, 248, 0));
}

.story-hero-content {
    position: relative;
    z-index: 1;
    padding: 34px 34px 32px;
}

.story-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(37, 99, 235, 0.1);
    color: var(--story-primary-strong);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.story-title {
    margin: 0 0 14px;
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: clamp(2.3rem, 4vw, 4.2rem);
    line-height: 0.98;
    font-weight: 400;
}

.story-subtitle {
    margin: 0 0 18px;
    max-width: 58ch;
    color: var(--story-muted);
    line-height: 1.75;
    font-size: 14px;
}

.story-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 18px;
}

.story-pill {
    display: inline-flex;
    align-items: center;
    min-height: 38px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.82);
    border: 1px solid rgba(37, 99, 235, 0.14);
    color: var(--story-text);
    font-size: 12px;
    font-weight: 700;
}

.story-author-line {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    align-items: center;
    margin-bottom: 24px;
}

.story-author-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #38bdf8);
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    flex-shrink: 0;
}

.story-author-name {
    display: block;
    font-size: 16px;
    font-weight: 700;
}

.story-author-date {
    display: block;
    margin-top: 3px;
    color: var(--story-muted);
    font-size: 12px;
}

.story-owner-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 2px;
}

.story-action,
.story-action-danger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 11px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.story-action {
    border: 1px solid var(--story-primary);
    background: var(--story-primary);
    color: #ffffff;
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.18);
}

.story-action:hover {
    transform: translateY(-1px);
    background: var(--story-primary-strong);
}

.story-action-danger {
    border: 1px solid #f4b7be;
    background: #fff1f2;
    color: #be123c;
}

.story-action-danger:hover {
    transform: translateY(-1px);
    background: #ffe4e6;
}

.story-hero-media {
    position: relative;
    min-height: 100%;
    border-left: 1px solid rgba(37, 99, 235, 0.08);
}

.story-hero-image {
    width: 100%;
    height: 100%;
    min-height: 430px;
    object-fit: cover;
    display: block;
}

.story-hero-placeholder {
    min-height: 430px;
    height: 100%;
    display: grid;
    place-items: center;
    background:
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.82), rgba(255,255,255,0) 36%),
        linear-gradient(135deg, #dbeafe 0%, #f8fbff 55%, #e0f2fe 100%);
    color: #2563eb;
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: clamp(2.2rem, 5vw, 4.6rem);
}

.story-hero-overlay {
    position: absolute;
    left: 18px;
    right: 18px;
    bottom: 18px;
    display: grid;
    gap: 10px;
}

.story-fact-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.story-fact {
    background: rgba(15, 23, 42, 0.62);
    color: #ffffff;
    backdrop-filter: blur(10px);
    border-radius: 18px;
    padding: 13px 14px;
}

.story-fact-label {
    display: block;
    margin-bottom: 4px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
}

.story-fact-value {
    display: block;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
}

.story-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(290px, 0.85fr);
    gap: 22px;
    align-items: start;
}

.story-main,
.story-sidebar {
    display: grid;
    gap: 22px;
}

.story-card {
    background: var(--story-panel);
    border: 1px solid var(--story-border);
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 14px 34px rgba(16, 32, 39, 0.05);
}

.story-card.soft {
    background: var(--story-panel-soft);
}

.story-section-title {
    margin: 0 0 14px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--story-primary-strong);
}

.story-summary-text,
.story-copy {
    margin: 0;
    color: #15313a;
    line-height: 1.9;
    font-size: 15px;
}

.story-chip-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.story-chip {
    display: inline-flex;
    align-items: center;
    padding: 9px 12px;
    border-radius: 999px;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: var(--story-primary-strong);
    font-size: 12px;
    font-weight: 700;
}

.story-list-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
}

.story-list-block {
    border: 1px solid var(--story-border);
    border-radius: 20px;
    padding: 18px;
    background: #ffffff;
}

.story-list-block h3 {
    margin: 0 0 12px;
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
}

.story-bullet-list {
    margin: 0;
    padding-left: 18px;
    color: #26404a;
    line-height: 1.8;
    font-size: 14px;
}

.story-budget-grid {
    display: grid;
    gap: 12px;
}

.story-budget-item {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 12px 14px;
    border-radius: 16px;
    background: #f8fbfb;
    border: 1px solid var(--story-border);
    font-size: 14px;
}

.story-budget-key {
    color: var(--story-muted);
    font-weight: 700;
    text-transform: capitalize;
}

.story-budget-value {
    color: var(--story-text);
    font-weight: 800;
    text-align: right;
}

.story-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 12px;
}

.story-gallery img {
    width: 100%;
    height: 210px;
    object-fit: cover;
    display: block;
    border-radius: 18px;
    border: 1px solid var(--story-border);
}

.story-sidebar .story-card {
    padding: 20px;
}

.story-detail-stack {
    display: grid;
    gap: 14px;
}

.story-detail {
    display: grid;
    gap: 5px;
    padding-bottom: 14px;
    border-bottom: 1px solid #e7f0ee;
}

.story-detail:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.story-detail-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--story-muted);
}

.story-detail-value {
    font-size: 15px;
    font-weight: 700;
    color: var(--story-text);
    line-height: 1.5;
}

.story-badge-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.story-badge {
    min-height: 52px;
    padding: 10px 14px;
    border-radius: 18px;
    background: #f8fbfb;
    border: 1px solid var(--story-border);
}

.story-badge strong {
    display: block;
    margin-bottom: 3px;
    font-size: 11px;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--story-muted);
}

.story-badge span {
    font-size: 15px;
    font-weight: 800;
    color: var(--story-text);
}

.story-empty-note {
    margin: 0;
    color: var(--story-muted);
    line-height: 1.7;
    font-size: 14px;
}

@media (max-width: 980px) {
    .story-hero,
    .story-layout {
        grid-template-columns: 1fr;
    }

    .story-hero-media {
        border-left: none;
        border-top: 1px solid rgba(15, 118, 110, 0.08);
    }
}

@media (max-width: 640px) {
    .travel-story-page {
        padding: 28px 12px 52px;
    }

    .story-hero-content,
    .story-card {
        padding: 20px;
    }

    .story-fact-grid {
        grid-template-columns: 1fr;
    }

    .story-title {
        font-size: 2.4rem;
    }

    .story-gallery {
        grid-template-columns: 1fr;
    }

    .story-gallery img {
        height: 230px;
    }
}
</style>
{% endblock %}

{% block body %}
{% set heroImage = story.coverImageUrl ?: (story.imageUrlsJson is not empty ? story.imageUrlsJson|first : null) %}

<div class=\"travel-story-page\">
    <a href=\"{{ path('blog') }}\" class=\"story-back\">Back to travel stories</a>

    {% for msg in app.flashes('success') %}
        <div class=\"story-flash success\">{{ msg }}</div>
    {% endfor %}

    {% for msg in app.flashes('error') %}
        <div class=\"story-flash error\">{{ msg }}</div>
    {% endfor %}

    <div class=\"story-shell\">
        <section class=\"story-hero\">
            <div class=\"story-hero-content\">
                <span class=\"story-kicker\">Travel Story</span>

                <h1 class=\"story-title\">{{ story.title }}</h1>

                {% if story.summary %}
                    <p class=\"story-subtitle\">
                        {{ story.summary|length > 220 ? story.summary|slice(0, 220) ~ '...' : story.summary }}
                    </p>
                {% else %}
                    <p class=\"story-subtitle\">A traveler log with practical notes, highlights, and personal recommendations.</p>
                {% endif %}

                <div class=\"story-meta-row\">
                    {% if story.destination %}
                        <span class=\"story-pill\">{{ story.destination }}</span>
                    {% endif %}
                    {% if story.travelType %}
                        <span class=\"story-pill\">{{ story.travelType|replace({'_': ' '})|title }}</span>
                    {% endif %}
                    {% if story.travelStyle %}
                        <span class=\"story-pill\">{{ story.travelStyle|replace({'_': ' '})|title }}</span>
                    {% endif %}
                    {% if story.overallRating %}
                        <span class=\"story-pill\">{{ story.overallRating }}/5 rating</span>
                    {% endif %}
                </div>

                <div class=\"story-author-line\">
                    <span class=\"story-author-avatar\">{{ authorName|first|upper }}</span>
                    <div>
                        <span class=\"story-author-name\">{{ authorName }}</span>
                        <span class=\"story-author-date\">
                            {% if story.createdAt %}
                                Published {{ story.createdAt|date('M d, Y') }}
                            {% else %}
                                Shared recently
                            {% endif %}
                            {% if story.updatedAt and story.updatedAt != story.createdAt %}
                                | Updated {{ story.updatedAt|date('M d, Y') }}
                            {% endif %}
                        </span>
                    </div>
                </div>

                {% if canManageStory %}
                    <div class=\"story-owner-actions\">
                        <a href=\"{{ path('travel_story_edit', {id: story.id}) }}\" class=\"story-action\">Edit story</a>
                        <form method=\"post\" action=\"{{ path('travel_story_delete', {id: story.id}) }}\" onsubmit=\"return confirm('Delete this travel story?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_travel_story_' ~ story.id) }}\">
                            <button type=\"submit\" class=\"story-action-danger\">Delete story</button>
                        </form>
                    </div>
                {% endif %}
            </div>

            <div class=\"story-hero-media\">
                {% if heroImage %}
                    <img src=\"{{ heroImage }}\" alt=\"{{ story.title }}\" class=\"story-hero-image\">
                {% else %}
                    <div class=\"story-hero-placeholder\">{{ story.destination ?: 'Trip' }}</div>
                {% endif %}

                <div class=\"story-hero-overlay\">
                    <div class=\"story-fact-grid\">
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Trip window</span>
                            <span class=\"story-fact-value\">
                                {% if story.startDate and story.endDate %}
                                    {{ story.startDate|date('M d, Y') }} to {{ story.endDate|date('M d, Y') }}
                                {% elseif story.startDate %}
                                    From {{ story.startDate|date('M d, Y') }}
                                {% elseif story.endDate %}
                                    Until {{ story.endDate|date('M d, Y') }}
                                {% else %}
                                    Dates not specified
                                {% endif %}
                            </span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Trip length</span>
                            <span class=\"story-fact-value\">
                                {% if tripLengthDays %}
                                    {{ tripLengthDays }} day{{ tripLengthDays > 1 ? 's' : '' }}
                                {% else %}
                                    Flexible
                                {% endif %}
                            </span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Would recommend</span>
                            <span class=\"story-fact-value\">{{ story.wouldRecommend ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class=\"story-fact\">
                            <span class=\"story-fact-label\">Would go again</span>
                            <span class=\"story-fact-value\">{{ story.wouldGoAgain ? 'Yes' : 'No' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class=\"story-layout\">
            <div class=\"story-main\">
                {% if story.summary %}
                    <section class=\"story-card soft\">
                        <h2 class=\"story-section-title\">Story Summary</h2>
                        <p class=\"story-summary-text\">{{ story.summary|nl2br }}</p>
                    </section>
                {% endif %}

                {% if story.tips %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Tips From The Traveler</h2>
                        <p class=\"story-copy\">{{ story.tips|nl2br }}</p>
                    </section>
                {% endif %}

                {% if story.mustVisitJson is not empty or story.mustDoJson is not empty or story.mustTryJson is not empty or story.favoritePlacesJson is not empty %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Highlights And Recommendations</h2>
                        <div class=\"story-list-grid\">
                            {% if story.mustVisitJson is not empty %}
                                <div class=\"story-list-block\">
                                    <h3>Must Visit</h3>
                                    <ul class=\"story-bullet-list\">
                                        {% for item in story.mustVisitJson %}
                                            {% if item %}
                                                <li>{{ item }}</li>
                                            {% endif %}
                                        {% endfor %}
                                    </ul>
                                </div>
                            {% endif %}

                            {% if story.mustDoJson is not empty %}
                                <div class=\"story-list-block\">
                                    <h3>Must Do</h3>
                                    <ul class=\"story-bullet-list\">
                                        {% for item in story.mustDoJson %}
                                            {% if item %}
                                                <li>{{ item }}</li>
                                            {% endif %}
                                        {% endfor %}
                                    </ul>
                                </div>
                            {% endif %}

                            {% if story.mustTryJson is not empty %}
                                <div class=\"story-list-block\">
                                    <h3>Must Try</h3>
                                    <ul class=\"story-bullet-list\">
                                        {% for item in story.mustTryJson %}
                                            {% if item %}
                                                <li>{{ item }}</li>
                                            {% endif %}
                                        {% endfor %}
                                    </ul>
                                </div>
                            {% endif %}

                            {% if story.favoritePlacesJson is not empty %}
                                <div class=\"story-list-block\">
                                    <h3>Favorite Places</h3>
                                    <ul class=\"story-bullet-list\">
                                        {% for item in story.favoritePlacesJson %}
                                            {% if item %}
                                                <li>{{ item }}</li>
                                            {% endif %}
                                        {% endfor %}
                                    </ul>
                                </div>
                            {% endif %}
                        </div>
                    </section>
                {% endif %}

                {% if story.budgetJson is not empty %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Budget Breakdown</h2>
                        <div class=\"story-budget-grid\">
                            {% for key, value in story.budgetJson %}
                                <div class=\"story-budget-item\">
                                    <span class=\"story-budget-key\">{{ key|replace({'_': ' '})|title }}</span>
                                    <span class=\"story-budget-value\">
                                        {% if value is iterable %}
                                            {{ value|json_encode }}
                                        {% else %}
                                            {{ value }}
                                        {% endif %}
                                    </span>
                                </div>
                            {% endfor %}
                        </div>
                    </section>
                {% endif %}

                {% if story.imageUrlsJson is not empty %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Photo Gallery</h2>
                        <div class=\"story-gallery\">
                            {% for image in story.imageUrlsJson %}
                                {% if image %}
                                    <img src=\"{{ image }}\" alt=\"{{ story.title }} image {{ loop.index }}\">
                                {% endif %}
                            {% endfor %}
                        </div>
                    </section>
                {% endif %}
            </div>

            <aside class=\"story-sidebar\">
                <section class=\"story-card\">
                    <h2 class=\"story-section-title\">Quick Details</h2>
                    <div class=\"story-detail-stack\">
                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Destination</span>
                            <span class=\"story-detail-value\">{{ story.destination ?: 'Not specified' }}</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Travel Type</span>
                            <span class=\"story-detail-value\">{{ story.travelType ? story.travelType|replace({'_': ' '})|title : 'Not specified' }}</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Travel Style</span>
                            <span class=\"story-detail-value\">{{ story.travelStyle ? story.travelStyle|replace({'_': ' '})|title : 'Not specified' }}</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Overall Rating</span>
                            <span class=\"story-detail-value\">{{ story.overallRating ? story.overallRating ~ '/5' : 'Not rated' }}</span>
                        </div>

                        <div class=\"story-detail\">
                            <span class=\"story-detail-label\">Budget</span>
                            <span class=\"story-detail-value\">
                                {% if story.totalBudget %}
                                    {{ story.totalBudget }} {{ story.currency }}
                                {% else %}
                                    Not shared
                                {% endif %}
                            </span>
                        </div>
                    </div>
                </section>

                <section class=\"story-card\">
                    <h2 class=\"story-section-title\">Traveler Verdict</h2>
                    <div class=\"story-badge-row\">
                        <div class=\"story-badge\">
                            <strong>Recommend</strong>
                            <span>{{ story.wouldRecommend ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class=\"story-badge\">
                            <strong>Return Trip</strong>
                            <span>{{ story.wouldGoAgain ? 'Yes' : 'No' }}</span>
                        </div>
                    </div>
                </section>

                {% if story.tagsJson is not empty %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Tags</h2>
                        <div class=\"story-chip-list\">
                            {% for tag in story.tagsJson %}
                                {% if tag %}
                                    <span class=\"story-chip\">{{ tag }}</span>
                                {% endif %}
                            {% endfor %}
                        </div>
                    </section>
                {% endif %}

                {% if story.summary is empty and story.tips is empty and story.mustVisitJson is empty and story.mustDoJson is empty and story.mustTryJson is empty and story.favoritePlacesJson is empty and story.imageUrlsJson is empty %}
                    <section class=\"story-card\">
                        <h2 class=\"story-section-title\">Notes</h2>
                        <p class=\"story-empty-note\">This story is live, but the traveler kept the write-up concise. More details can still be added later from the edit screen.</p>
                    </section>
                {% endif %}
            </aside>
        </div>
    </div>
</div>
{% endblock %}
", "front/blog/travel_story_show.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\blog\\travel_story_show.html.twig");
    }
}
