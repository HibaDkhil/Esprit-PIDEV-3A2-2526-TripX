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

/* front/blog/travel_story_new.html.twig */
class __TwigTemplate_1dd3bc67e2a81228047e0f617b424e5a extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/travel_story_new.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
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

        yield "Create Travel Story — TripX";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        yield "<style>
.cp-wrap {
    max-width: 880px;
    margin: 0 auto;
    padding: calc(var(--nav-height, 70px) + 40px) 16px 80px;
}
.cp-label {
    font-family: var(--font-mono, 'Space Mono');
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--accent-primary);
    margin-bottom: 10px;
    display: block;
}
.cp-title {
    font-family: var(--font-display, 'Playfair Display');
    font-size: 36px;
    font-weight: 900;
    color: var(--text-primary);
    margin: 0 0 8px;
    line-height: 1.15;
}
.cp-title span {
    color: var(--accent-primary);
}
.cp-subtitle {
    font-size: 15px;
    color: var(--text-muted);
    margin: 0 0 32px;
    line-height: 1.6;
}
.cp-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    padding: 36px 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
    animation: fadeUp .45s cubic-bezier(.22,1,.36,1) both;
}
.cp-card label,
.cp-field-label {
    display: block;
    font-weight: 700;
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 7px;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase;
    letter-spacing: .06em;
}
.cp-card input[type=\"text\"],
.cp-card input[type=\"date\"],
.cp-card input[type=\"number\"],
.cp-card textarea,
.cp-card select {
    width: 100%;
    padding: 13px 16px;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    background: var(--bg-surface);
    color: var(--text-primary);
    font-size: 14px;
    font-family: inherit;
    transition: border-color .2s, box-shadow .2s;
    appearance: none;
    box-sizing: border-box;
}
.cp-card input:focus,
.cp-card textarea:focus,
.cp-card select:focus {
    outline: none;
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
}
.cp-card input::placeholder,
.cp-card textarea::placeholder {
    color: var(--text-muted);
}
.cp-card textarea {
    resize: vertical;
    line-height: 1.7;
}
.cp-card input[type=\"date\"].story-date-input {
    min-height: 48px;
    font-weight: 600;
    letter-spacing: .01em;
    cursor: pointer;
}
.cp-card input[type=\"date\"].story-date-input::-webkit-calendar-picker-indicator {
    cursor: pointer;
    opacity: .7;
}
.cp-card input[type=\"date\"].story-date-input:focus::-webkit-calendar-picker-indicator {
    opacity: 1;
}
.cp-field {
    margin-bottom: 22px;
}
.cp-card ul {
    padding: 0;
    margin: 6px 0 0;
    list-style: none;
}
.cp-card ul li {
    color: #ef4444;
    font-size: 13px;
}

.cp-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px 22px;
}
.cp-span-2 {
    grid-column: 1 / -1;
}

.select-wrap {
    position: relative;
}
.select-wrap::after {
    content: '▾';
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: var(--text-muted);
    font-size: 14px;
}
.select-wrap select {
    padding-right: 40px;
    cursor: pointer;
}

.cp-card .story-title-input {
    font-size: 16px;
    font-weight: 600;
}
.cp-card .story-summary {
    min-height: 170px;
}
.cp-card .story-tips {
    min-height: 120px;
}

.upload-zone {
    display: block;
    border: 2px dashed var(--border-color);
    border-radius: 16px;
    padding: 36px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    user-select: none;
}
.upload-zone:hover,
.upload-zone.dragover {
    border-color: var(--accent-primary);
    background: rgba(99,102,241,.04);
}
.upload-icon {
    font-size: 46px;
    display: block;
    margin-bottom: 12px;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1);
}
.upload-zone:hover .upload-icon {
    transform: scale(1.18) translateY(-5px);
}
.upload-zone-text {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 5px;
}
.upload-zone-sub {
    font-size: 12px;
    color: var(--text-muted);
    font-family: var(--font-mono, 'Space Mono');
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    margin-top: 14px;
}
.preview-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 1;
    border: 1px solid var(--border-color);
    animation: fadeUp .3s cubic-bezier(.22,1,.36,1) both;
}
.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.preview-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,.65);
    color: #fff;
    border: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .15s;
}
.preview-remove:hover {
    background: #ef4444;
}

.cp-inline-checks {
    display: flex;
    flex-wrap: wrap;
    gap: 22px;
    align-items: center;
    padding-top: 4px;
}
.cp-inline-check {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: var(--text-primary);
    font-family: inherit;
    text-transform: none;
    letter-spacing: normal;
    margin-bottom: 0;
}
.cp-inline-check input {
    width: 18px;
    height: 18px;
    margin: 0;
}

.cp-advanced-toggle {
    display: inline-block;
    margin-top: 4px;
    color: var(--accent-primary);
    cursor: pointer;
    font-size: 13px;
    font-weight: 700;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase;
    letter-spacing: .06em;
}
.cp-advanced-box {
    display: none;
    margin-top: 18px;
    padding-top: 22px;
    border-top: 1px solid var(--border-color);
}
.cp-advanced-box.open {
    display: block;
}

.cp-notice {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: rgba(245,158,11,.09);
    border: 1px solid rgba(245,158,11,.28);
    border-radius: 14px;
    padding: 13px 16px;
    font-size: 13px;
    color: #92400e;
    margin-bottom: 26px;
    line-height: 1.5;
}
.cp-actions {
    display: flex;
    gap: 14px;
    align-items: center;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--border-color);
}
.cp-submit {
    padding: 13px 32px;
    background: linear-gradient(135deg, var(--accent-primary,#6366f1), #a855f7);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(99,102,241,.3);
}
.cp-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 22px rgba(99,102,241,.42);
}
.cp-back {
    text-decoration: none;
    color: var(--text-muted);
    font-weight: 600;
    font-size: 14px;
    transition: color .18s;
}
.cp-back:hover {
    color: var(--text-primary);
}

@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}

@media (max-width: 768px) {
    .cp-wrap {
        padding: 50px 12px 50px;
    }
    .cp-card {
        padding: 24px 18px;
    }
    .cp-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .cp-span-2 {
        grid-column: auto;
    }
    .cp-actions {
        flex-wrap: wrap;
    }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 349
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 350
        yield "<div class=\"cp-wrap\">
    <span class=\"cp-label\">🧳 Create</span>

    ";
        // line 353
        if ((array_key_exists("story", $context) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 353, $this->source); })()), "id", [], "any", false, false, false, 353))) {
            // line 354
            yield "        <h1 class=\"cp-title\">Edit <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Update your travel experience, recommendations, photos, and practical tips.
        </p>
    ";
        } else {
            // line 359
            yield "        <h1 class=\"cp-title\">Write a <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Share a complete travel experience with photos, recommendations, tips, and useful details for other travelers.
        </p>
    ";
        }
        // line 364
        yield "
    ";
        // line 365
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 365, $this->source); })()), "flashes", ["error"], "method", false, false, false, 365));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 366
            yield "        <div style=\"background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#b91c1c;font-size:14px;\">❌ ";
            // line 368
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 370
        yield "
    ";
        // line 371
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 371, $this->source); })()), "flashes", ["success"], "method", false, false, false, 371));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 372
            yield "        <div style=\"background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#166534;font-size:14px;\">✅ ";
            // line 374
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 376
        yield "
    <div class=\"cp-card\">
        <div class=\"cp-notice\">
            ℹ️ Your travel story should be clear, helpful, and based on a real travel experience.
        </div>

        ";
        // line 382
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 382, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate", "enctype" => "multipart/form-data"]]);
        // line 387
        yield "

            ";
        // line 389
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 389, $this->source); })()), 'errors');
        yield "

            <div class=\"cp-grid\">
                <div class=\"cp-field cp-span-2\">
                    ";
        // line 393
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 393, $this->source); })()), "title", [], "any", false, false, false, 393), 'label', ["label" => "Title"]);
        yield "
                    ";
        // line 394
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 394, $this->source); })()), "title", [], "any", false, false, false, 394), 'widget', ["attr" => ["class" => "story-title-input", "placeholder" => "Give your travel story a clear, catchy title…"]]);
        // line 397
        yield "
                    ";
        // line 398
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 398, $this->source); })()), "title", [], "any", false, false, false, 398), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 402
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 402, $this->source); })()), "destination", [], "any", false, false, false, 402), 'label', ["label" => "Destination"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 404
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 404, $this->source); })()), "destination", [], "any", false, false, false, 404), 'widget');
        yield "
                    </div>
                    ";
        // line 406
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 406, $this->source); })()), "destination", [], "any", false, false, false, 406), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 410
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 410, $this->source); })()), "travelType", [], "any", false, false, false, 410), 'label', ["label" => "Travel Type"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 412
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 412, $this->source); })()), "travelType", [], "any", false, false, false, 412), 'widget');
        yield "
                    </div>
                    ";
        // line 414
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 414, $this->source); })()), "travelType", [], "any", false, false, false, 414), 'errors');
        yield "
                </div>

                <div class=\"cp-field cp-span-2\">
                    ";
        // line 418
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 418, $this->source); })()), "summary", [], "any", false, false, false, 418), 'label', ["label" => "Summary"]);
        yield "
                    ";
        // line 419
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 419, $this->source); })()), "summary", [], "any", false, false, false, 419), 'widget', ["attr" => ["class" => "story-summary", "placeholder" => "Tell the story of your trip, what stood out, what readers should know…"]]);
        // line 422
        yield "
                    ";
        // line 423
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 423, $this->source); })()), "summary", [], "any", false, false, false, 423), 'errors');
        yield "
                </div>

                <div class=\"cp-field cp-span-2\">
                    ";
        // line 427
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 427, $this->source); })()), "tips", [], "any", false, false, false, 427), 'label', ["label" => "Tips"]);
        yield "
                    ";
        // line 428
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 428, $this->source); })()), "tips", [], "any", false, false, false, 428), 'widget', ["attr" => ["class" => "story-tips", "placeholder" => "Practical advice, things to avoid, budget tips, best times, local recommendations…"]]);
        // line 431
        yield "
                    ";
        // line 432
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 432, $this->source); })()), "tips", [], "any", false, false, false, 432), 'errors');
        yield "
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">🖼️ Images (optional — up to 5)</span>

                ";
        // line 439
        $context["fileInputId"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 439, $this->source); })()), "imageFile", [], "any", false, false, false, 439), "vars", [], "any", false, false, false, 439), "id", [], "any", false, false, false, 439);
        // line 440
        yield "
                <div style=\"position:absolute;width:0;height:0;overflow:hidden;\">
                    ";
        // line 442
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 442, $this->source); })()), "imageFile", [], "any", false, false, false, 442), 'widget', ["attr" => ["multiple" => "multiple"]]);
        yield "
                </div>
                ";
        // line 444
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 444, $this->source); })()), "imageFile", [], "any", false, false, false, 444), 'errors');
        yield "

                <label for=\"";
        // line 446
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fileInputId"]) || array_key_exists("fileInputId", $context) ? $context["fileInputId"] : (function () { throw new RuntimeError('Variable "fileInputId" does not exist.', 446, $this->source); })()), "html", null, true);
        yield "\" class=\"upload-zone\" id=\"upload-zone\"
                       ondragover=\"handleDragOver(event)\"
                       ondragleave=\"handleDragLeave(event)\"
                       ondrop=\"handleDrop(event)\">
                    <span class=\"upload-icon\">📷</span>
                    <div class=\"upload-zone-text\">Click to add photos — or drag & drop here</div>
                    <div class=\"upload-zone-sub\">
                        JPG, PNG, WebP, GIF &nbsp;·&nbsp; max 5 MB each &nbsp;·&nbsp; up to 5 images
                    </div>
                </label>

                <div class=\"preview-grid\" id=\"preview-grid\">
                    ";
        // line 458
        if ((array_key_exists("story", $context) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 458, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 458)))) {
            // line 459
            yield "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 459, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 459));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 460
                yield "                            <div class=\"preview-item existing-image\">
                                <img src=\"";
                // line 461
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" alt=\"Travel story image\">
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 464
            yield "                    ";
        }
        // line 465
        yield "                </div>
            </div>

            <div class=\"cp-grid\">
                <div class=\"cp-field\">
                    ";
        // line 470
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 470, $this->source); })()), "startDate", [], "any", false, false, false, 470), 'label', ["label" => "Start Date"]);
        yield "
                    ";
        // line 471
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 471, $this->source); })()), "startDate", [], "any", false, false, false, 471), 'widget', ["attr" => ["class" => "story-date-input"]]);
        yield "
                    ";
        // line 472
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 472, $this->source); })()), "startDate", [], "any", false, false, false, 472), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 476
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 476, $this->source); })()), "endDate", [], "any", false, false, false, 476), 'label', ["label" => "End Date"]);
        yield "
                    ";
        // line 477
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 477, $this->source); })()), "endDate", [], "any", false, false, false, 477), 'widget', ["attr" => ["class" => "story-date-input"]]);
        yield "
                    ";
        // line 478
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 478, $this->source); })()), "endDate", [], "any", false, false, false, 478), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 482
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 482, $this->source); })()), "travelStyle", [], "any", false, false, false, 482), 'label', ["label" => "Travel Style"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 484
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 484, $this->source); })()), "travelStyle", [], "any", false, false, false, 484), 'widget');
        yield "
                    </div>
                    ";
        // line 486
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 486, $this->source); })()), "travelStyle", [], "any", false, false, false, 486), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 490
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 490, $this->source); })()), "overallRating", [], "any", false, false, false, 490), 'label', ["label" => "Rating"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 492
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 492, $this->source); })()), "overallRating", [], "any", false, false, false, 492), 'widget');
        yield "
                    </div>
                    ";
        // line 494
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 494, $this->source); })()), "overallRating", [], "any", false, false, false, 494), 'errors');
        yield "
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">Recommendation</span>
                <div class=\"cp-inline-checks\">
                    <label class=\"cp-inline-check\">
                        ";
        // line 502
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 502, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 502), 'widget');
        yield "
                        <span>Would recommend</span>
                    </label>

                    <label class=\"cp-inline-check\">
                        ";
        // line 507
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 507, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 507), 'widget');
        yield "
                        <span>Would go again</span>
                    </label>
                </div>
                ";
        // line 511
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 511, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 511), 'errors');
        yield "
                ";
        // line 512
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 512, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 512), 'errors');
        yield "
            </div>

            <span class=\"cp-advanced-toggle\" onclick=\"toggleAdvancedFields(this)\">Advanced fields</span>

            <div class=\"cp-advanced-box\" id=\"advanced-fields\">
                <div class=\"cp-grid\">
                    <div class=\"cp-field\">
                        ";
        // line 520
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 520, $this->source); })()), "currency", [], "any", false, false, false, 520), 'label', ["label" => "Currency"]);
        yield "
                        ";
        // line 521
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 521, $this->source); })()), "currency", [], "any", false, false, false, 521), 'widget', ["attr" => ["placeholder" => "TND"]]);
        yield "
                        ";
        // line 522
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 522, $this->source); })()), "currency", [], "any", false, false, false, 522), 'errors');
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 526
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 526, $this->source); })()), "totalBudget", [], "any", false, false, false, 526), 'label', ["label" => "Total Budget"]);
        yield "
                        ";
        // line 527
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 527, $this->source); })()), "totalBudget", [], "any", false, false, false, 527), 'widget', ["attr" => ["placeholder" => "0.00"]]);
        yield "
                        ";
        // line 528
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 528, $this->source); })()), "totalBudget", [], "any", false, false, false, 528), 'errors');
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 532
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 532, $this->source); })()), "tagsText", [], "any", false, false, false, 532), 'label', ["label" => "Tags"]);
        yield "
                        ";
        // line 533
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 533, $this->source); })()), "tagsText", [], "any", false, false, false, 533), 'widget', ["attr" => ["rows" => 2, "placeholder" => "beach, food, city, adventure"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 537
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 537, $this->source); })()), "favoritePlacesText", [], "any", false, false, false, 537), 'label', ["label" => "Favorite Places"]);
        yield "
                        ";
        // line 538
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 538, $this->source); })()), "favoritePlacesText", [], "any", false, false, false, 538), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 542
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 542, $this->source); })()), "mustVisitText", [], "any", false, false, false, 542), 'label', ["label" => "Must Visit"]);
        yield "
                        ";
        // line 543
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 543, $this->source); })()), "mustVisitText", [], "any", false, false, false, 543), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 547
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 547, $this->source); })()), "mustDoText", [], "any", false, false, false, 547), 'label', ["label" => "Must Do"]);
        yield "
                        ";
        // line 548
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 548, $this->source); })()), "mustDoText", [], "any", false, false, false, 548), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 552
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 552, $this->source); })()), "mustTryText", [], "any", false, false, false, 552), 'label', ["label" => "Must Try"]);
        yield "
                        ";
        // line 553
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 553, $this->source); })()), "mustTryText", [], "any", false, false, false, 553), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 557
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 557, $this->source); })()), "budgetText", [], "any", false, false, false, 557), 'label', ["label" => "Detailed Budget JSON"]);
        yield "
                        ";
        // line 558
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 558, $this->source); })()), "budgetText", [], "any", false, false, false, 558), 'widget', ["attr" => ["rows" => 3, "placeholder" => "{\"hotel\":200,\"food\":120,\"transport\":80}"]]);
        yield "
                    </div>
                </div>
            </div>

            <div class=\"cp-actions\">
                <button type=\"submit\" class=\"cp-submit\">
                    ";
        // line 565
        if ((array_key_exists("story", $context) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 565, $this->source); })()), "id", [], "any", false, false, false, 565))) {
            // line 566
            yield "                        💾 Update Story
                    ";
        } else {
            // line 568
            yield "                        🚀 Save Story
                    ";
        }
        // line 570
        yield "                </button>
                <a href=\"";
        // line 571
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"cp-back\">← Back to blog</a>
            </div>

        ";
        // line 574
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 574, $this->source); })()), 'form_end');
        yield "
    </div>
</div>

<script>
const fileInput = document.querySelector('input[type=\"file\"][multiple]');
const previewGrid = document.getElementById('preview-grid');
const uploadZone = document.getElementById('upload-zone');
const startDateInput = document.getElementById('";
        // line 582
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 582, $this->source); })()), "startDate", [], "any", false, false, false, 582), "vars", [], "any", false, false, false, 582), "id", [], "any", false, false, false, 582), "html", null, true);
        yield "');
const endDateInput = document.getElementById('";
        // line 583
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 583, $this->source); })()), "endDate", [], "any", false, false, false, 583), "vars", [], "any", false, false, false, 583), "id", [], "any", false, false, false, 583), "html", null, true);
        yield "');
let selectedFiles = [];

function syncFilesToInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

function renderPreviews() {
    previewGrid.innerHTML = '';
    selectedFiles.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = e => {
            const item = document.createElement('div');
            item.className = 'preview-item';
            item.style.animationDelay = (idx * 0.06) + 's';
            item.innerHTML = `
                <img src=\"\${e.target.result}\" alt=\"\${file.name}\">
                <button type=\"button\" class=\"preview-remove\" onclick=\"removeFile(\${idx})\" title=\"Remove\">✕</button>
            `;
            previewGrid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

function removeFile(idx) {
    selectedFiles.splice(idx, 1);
    syncFilesToInput();
    renderPreviews();
}

function addFiles(files) {
    const arr = Array.from(files);
    selectedFiles = [...selectedFiles, ...arr].slice(0, 5);
    syncFilesToInput();
    renderPreviews();
}

if (fileInput) {
    fileInput.addEventListener('change', () => {
        addFiles(fileInput.files);
    });
}

function handleDragOver(e) {
    e.preventDefault();
    uploadZone.classList.add('dragover');
}

function handleDragLeave(e) {
    uploadZone.classList.remove('dragover');
}

function handleDrop(e) {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
}

function toggleAdvancedFields(el) {
    const box = document.getElementById('advanced-fields');
    box.classList.toggle('open');
    el.textContent = box.classList.contains('open') ? 'Hide advanced fields' : 'Advanced fields';
}

function setupDateConstraints() {
    if (!startDateInput || !endDateInput) {
        return;
    }

    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayStr = `\${yyyy}-\${mm}-\${dd}`;

    startDateInput.max = todayStr;
    endDateInput.max = todayStr;

    const syncDateBounds = () => {
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
            if (endDateInput.value && endDateInput.value < startDateInput.value) {
                endDateInput.value = startDateInput.value;
            }
        } else {
            endDateInput.removeAttribute('min');
        }

        if (endDateInput.value) {
            startDateInput.max = endDateInput.value < todayStr ? endDateInput.value : todayStr;
            if (startDateInput.value && startDateInput.value > endDateInput.value) {
                startDateInput.value = endDateInput.value;
            }
        } else {
            startDateInput.max = todayStr;
        }
    };

    startDateInput.addEventListener('change', syncDateBounds);
    endDateInput.addEventListener('change', syncDateBounds);
    syncDateBounds();
}

setupDateConstraints();
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
        return "front/blog/travel_story_new.html.twig";
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
        return array (  902 => 583,  898 => 582,  887 => 574,  881 => 571,  878 => 570,  874 => 568,  870 => 566,  868 => 565,  858 => 558,  854 => 557,  847 => 553,  843 => 552,  836 => 548,  832 => 547,  825 => 543,  821 => 542,  814 => 538,  810 => 537,  803 => 533,  799 => 532,  792 => 528,  788 => 527,  784 => 526,  777 => 522,  773 => 521,  769 => 520,  758 => 512,  754 => 511,  747 => 507,  739 => 502,  728 => 494,  723 => 492,  718 => 490,  711 => 486,  706 => 484,  701 => 482,  694 => 478,  690 => 477,  686 => 476,  679 => 472,  675 => 471,  671 => 470,  664 => 465,  661 => 464,  652 => 461,  649 => 460,  644 => 459,  642 => 458,  627 => 446,  622 => 444,  617 => 442,  613 => 440,  611 => 439,  601 => 432,  598 => 431,  596 => 428,  592 => 427,  585 => 423,  582 => 422,  580 => 419,  576 => 418,  569 => 414,  564 => 412,  559 => 410,  552 => 406,  547 => 404,  542 => 402,  535 => 398,  532 => 397,  530 => 394,  526 => 393,  519 => 389,  515 => 387,  513 => 382,  505 => 376,  497 => 374,  493 => 372,  489 => 371,  486 => 370,  478 => 368,  474 => 366,  470 => 365,  467 => 364,  460 => 359,  453 => 354,  451 => 353,  446 => 350,  436 => 349,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Create Travel Story — TripX{% endblock %}

{% block stylesheets %}
<style>
.cp-wrap {
    max-width: 880px;
    margin: 0 auto;
    padding: calc(var(--nav-height, 70px) + 40px) 16px 80px;
}
.cp-label {
    font-family: var(--font-mono, 'Space Mono');
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--accent-primary);
    margin-bottom: 10px;
    display: block;
}
.cp-title {
    font-family: var(--font-display, 'Playfair Display');
    font-size: 36px;
    font-weight: 900;
    color: var(--text-primary);
    margin: 0 0 8px;
    line-height: 1.15;
}
.cp-title span {
    color: var(--accent-primary);
}
.cp-subtitle {
    font-size: 15px;
    color: var(--text-muted);
    margin: 0 0 32px;
    line-height: 1.6;
}
.cp-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    padding: 36px 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
    animation: fadeUp .45s cubic-bezier(.22,1,.36,1) both;
}
.cp-card label,
.cp-field-label {
    display: block;
    font-weight: 700;
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 7px;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase;
    letter-spacing: .06em;
}
.cp-card input[type=\"text\"],
.cp-card input[type=\"date\"],
.cp-card input[type=\"number\"],
.cp-card textarea,
.cp-card select {
    width: 100%;
    padding: 13px 16px;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    background: var(--bg-surface);
    color: var(--text-primary);
    font-size: 14px;
    font-family: inherit;
    transition: border-color .2s, box-shadow .2s;
    appearance: none;
    box-sizing: border-box;
}
.cp-card input:focus,
.cp-card textarea:focus,
.cp-card select:focus {
    outline: none;
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
}
.cp-card input::placeholder,
.cp-card textarea::placeholder {
    color: var(--text-muted);
}
.cp-card textarea {
    resize: vertical;
    line-height: 1.7;
}
.cp-card input[type=\"date\"].story-date-input {
    min-height: 48px;
    font-weight: 600;
    letter-spacing: .01em;
    cursor: pointer;
}
.cp-card input[type=\"date\"].story-date-input::-webkit-calendar-picker-indicator {
    cursor: pointer;
    opacity: .7;
}
.cp-card input[type=\"date\"].story-date-input:focus::-webkit-calendar-picker-indicator {
    opacity: 1;
}
.cp-field {
    margin-bottom: 22px;
}
.cp-card ul {
    padding: 0;
    margin: 6px 0 0;
    list-style: none;
}
.cp-card ul li {
    color: #ef4444;
    font-size: 13px;
}

.cp-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px 22px;
}
.cp-span-2 {
    grid-column: 1 / -1;
}

.select-wrap {
    position: relative;
}
.select-wrap::after {
    content: '▾';
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: var(--text-muted);
    font-size: 14px;
}
.select-wrap select {
    padding-right: 40px;
    cursor: pointer;
}

.cp-card .story-title-input {
    font-size: 16px;
    font-weight: 600;
}
.cp-card .story-summary {
    min-height: 170px;
}
.cp-card .story-tips {
    min-height: 120px;
}

.upload-zone {
    display: block;
    border: 2px dashed var(--border-color);
    border-radius: 16px;
    padding: 36px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    user-select: none;
}
.upload-zone:hover,
.upload-zone.dragover {
    border-color: var(--accent-primary);
    background: rgba(99,102,241,.04);
}
.upload-icon {
    font-size: 46px;
    display: block;
    margin-bottom: 12px;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1);
}
.upload-zone:hover .upload-icon {
    transform: scale(1.18) translateY(-5px);
}
.upload-zone-text {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 5px;
}
.upload-zone-sub {
    font-size: 12px;
    color: var(--text-muted);
    font-family: var(--font-mono, 'Space Mono');
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    margin-top: 14px;
}
.preview-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 1;
    border: 1px solid var(--border-color);
    animation: fadeUp .3s cubic-bezier(.22,1,.36,1) both;
}
.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.preview-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,.65);
    color: #fff;
    border: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .15s;
}
.preview-remove:hover {
    background: #ef4444;
}

.cp-inline-checks {
    display: flex;
    flex-wrap: wrap;
    gap: 22px;
    align-items: center;
    padding-top: 4px;
}
.cp-inline-check {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: var(--text-primary);
    font-family: inherit;
    text-transform: none;
    letter-spacing: normal;
    margin-bottom: 0;
}
.cp-inline-check input {
    width: 18px;
    height: 18px;
    margin: 0;
}

.cp-advanced-toggle {
    display: inline-block;
    margin-top: 4px;
    color: var(--accent-primary);
    cursor: pointer;
    font-size: 13px;
    font-weight: 700;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase;
    letter-spacing: .06em;
}
.cp-advanced-box {
    display: none;
    margin-top: 18px;
    padding-top: 22px;
    border-top: 1px solid var(--border-color);
}
.cp-advanced-box.open {
    display: block;
}

.cp-notice {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: rgba(245,158,11,.09);
    border: 1px solid rgba(245,158,11,.28);
    border-radius: 14px;
    padding: 13px 16px;
    font-size: 13px;
    color: #92400e;
    margin-bottom: 26px;
    line-height: 1.5;
}
.cp-actions {
    display: flex;
    gap: 14px;
    align-items: center;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--border-color);
}
.cp-submit {
    padding: 13px 32px;
    background: linear-gradient(135deg, var(--accent-primary,#6366f1), #a855f7);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(99,102,241,.3);
}
.cp-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 22px rgba(99,102,241,.42);
}
.cp-back {
    text-decoration: none;
    color: var(--text-muted);
    font-weight: 600;
    font-size: 14px;
    transition: color .18s;
}
.cp-back:hover {
    color: var(--text-primary);
}

@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}

@media (max-width: 768px) {
    .cp-wrap {
        padding: 50px 12px 50px;
    }
    .cp-card {
        padding: 24px 18px;
    }
    .cp-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .cp-span-2 {
        grid-column: auto;
    }
    .cp-actions {
        flex-wrap: wrap;
    }
}
</style>
{% endblock %}

{% block body %}
<div class=\"cp-wrap\">
    <span class=\"cp-label\">🧳 Create</span>

    {% if story is defined and story.id %}
        <h1 class=\"cp-title\">Edit <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Update your travel experience, recommendations, photos, and practical tips.
        </p>
    {% else %}
        <h1 class=\"cp-title\">Write a <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Share a complete travel experience with photos, recommendations, tips, and useful details for other travelers.
        </p>
    {% endif %}

    {% for msg in app.flashes('error') %}
        <div style=\"background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#b91c1c;font-size:14px;\">❌ {{ msg }}</div>
    {% endfor %}

    {% for msg in app.flashes('success') %}
        <div style=\"background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#166534;font-size:14px;\">✅ {{ msg }}</div>
    {% endfor %}

    <div class=\"cp-card\">
        <div class=\"cp-notice\">
            ℹ️ Your travel story should be clear, helpful, and based on a real travel experience.
        </div>

        {{ form_start(form, {
            'attr': {
                'novalidate': 'novalidate',
                'enctype': 'multipart/form-data'
            }
        }) }}

            {{ form_errors(form) }}

            <div class=\"cp-grid\">
                <div class=\"cp-field cp-span-2\">
                    {{ form_label(form.title, 'Title') }}
                    {{ form_widget(form.title, {'attr': {
                        'class': 'story-title-input',
                        'placeholder': 'Give your travel story a clear, catchy title…'
                    }}) }}
                    {{ form_errors(form.title) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.destination, 'Destination') }}
                    <div class=\"select-wrap\">
                        {{ form_widget(form.destination) }}
                    </div>
                    {{ form_errors(form.destination) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.travelType, 'Travel Type') }}
                    <div class=\"select-wrap\">
                        {{ form_widget(form.travelType) }}
                    </div>
                    {{ form_errors(form.travelType) }}
                </div>

                <div class=\"cp-field cp-span-2\">
                    {{ form_label(form.summary, 'Summary') }}
                    {{ form_widget(form.summary, {'attr': {
                        'class': 'story-summary',
                        'placeholder': 'Tell the story of your trip, what stood out, what readers should know…'
                    }}) }}
                    {{ form_errors(form.summary) }}
                </div>

                <div class=\"cp-field cp-span-2\">
                    {{ form_label(form.tips, 'Tips') }}
                    {{ form_widget(form.tips, {'attr': {
                        'class': 'story-tips',
                        'placeholder': 'Practical advice, things to avoid, budget tips, best times, local recommendations…'
                    }}) }}
                    {{ form_errors(form.tips) }}
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">🖼️ Images (optional — up to 5)</span>

                {% set fileInputId = form.imageFile.vars.id %}

                <div style=\"position:absolute;width:0;height:0;overflow:hidden;\">
                    {{ form_widget(form.imageFile, {'attr': {'multiple': 'multiple'}}) }}
                </div>
                {{ form_errors(form.imageFile) }}

                <label for=\"{{ fileInputId }}\" class=\"upload-zone\" id=\"upload-zone\"
                       ondragover=\"handleDragOver(event)\"
                       ondragleave=\"handleDragLeave(event)\"
                       ondrop=\"handleDrop(event)\">
                    <span class=\"upload-icon\">📷</span>
                    <div class=\"upload-zone-text\">Click to add photos — or drag & drop here</div>
                    <div class=\"upload-zone-sub\">
                        JPG, PNG, WebP, GIF &nbsp;·&nbsp; max 5 MB each &nbsp;·&nbsp; up to 5 images
                    </div>
                </label>

                <div class=\"preview-grid\" id=\"preview-grid\">
                    {% if story is defined and story.imageUrlsJson is not empty %}
                        {% for image in story.imageUrlsJson %}
                            <div class=\"preview-item existing-image\">
                                <img src=\"{{ image }}\" alt=\"Travel story image\">
                            </div>
                        {% endfor %}
                    {% endif %}
                </div>
            </div>

            <div class=\"cp-grid\">
                <div class=\"cp-field\">
                    {{ form_label(form.startDate, 'Start Date') }}
                    {{ form_widget(form.startDate, {'attr': {'class': 'story-date-input'}}) }}
                    {{ form_errors(form.startDate) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.endDate, 'End Date') }}
                    {{ form_widget(form.endDate, {'attr': {'class': 'story-date-input'}}) }}
                    {{ form_errors(form.endDate) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.travelStyle, 'Travel Style') }}
                    <div class=\"select-wrap\">
                        {{ form_widget(form.travelStyle) }}
                    </div>
                    {{ form_errors(form.travelStyle) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.overallRating, 'Rating') }}
                    <div class=\"select-wrap\">
                        {{ form_widget(form.overallRating) }}
                    </div>
                    {{ form_errors(form.overallRating) }}
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">Recommendation</span>
                <div class=\"cp-inline-checks\">
                    <label class=\"cp-inline-check\">
                        {{ form_widget(form.wouldRecommend) }}
                        <span>Would recommend</span>
                    </label>

                    <label class=\"cp-inline-check\">
                        {{ form_widget(form.wouldGoAgain) }}
                        <span>Would go again</span>
                    </label>
                </div>
                {{ form_errors(form.wouldRecommend) }}
                {{ form_errors(form.wouldGoAgain) }}
            </div>

            <span class=\"cp-advanced-toggle\" onclick=\"toggleAdvancedFields(this)\">Advanced fields</span>

            <div class=\"cp-advanced-box\" id=\"advanced-fields\">
                <div class=\"cp-grid\">
                    <div class=\"cp-field\">
                        {{ form_label(form.currency, 'Currency') }}
                        {{ form_widget(form.currency, {'attr': {'placeholder': 'TND'}}) }}
                        {{ form_errors(form.currency) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.totalBudget, 'Total Budget') }}
                        {{ form_widget(form.totalBudget, {'attr': {'placeholder': '0.00'}}) }}
                        {{ form_errors(form.totalBudget) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.tagsText, 'Tags') }}
                        {{ form_widget(form.tagsText, {'attr': {'rows': 2, 'placeholder': 'beach, food, city, adventure'}}) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.favoritePlacesText, 'Favorite Places') }}
                        {{ form_widget(form.favoritePlacesText, {'attr': {'rows': 2, 'placeholder': 'comma separated'}}) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.mustVisitText, 'Must Visit') }}
                        {{ form_widget(form.mustVisitText, {'attr': {'rows': 2, 'placeholder': 'comma separated'}}) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.mustDoText, 'Must Do') }}
                        {{ form_widget(form.mustDoText, {'attr': {'rows': 2, 'placeholder': 'comma separated'}}) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.mustTryText, 'Must Try') }}
                        {{ form_widget(form.mustTryText, {'attr': {'rows': 2, 'placeholder': 'comma separated'}}) }}
                    </div>

                    <div class=\"cp-field\">
                        {{ form_label(form.budgetText, 'Detailed Budget JSON') }}
                        {{ form_widget(form.budgetText, {'attr': {'rows': 3, 'placeholder': '{\"hotel\":200,\"food\":120,\"transport\":80}'}}) }}
                    </div>
                </div>
            </div>

            <div class=\"cp-actions\">
                <button type=\"submit\" class=\"cp-submit\">
                    {% if story is defined and story.id %}
                        💾 Update Story
                    {% else %}
                        🚀 Save Story
                    {% endif %}
                </button>
                <a href=\"{{ path('blog') }}\" class=\"cp-back\">← Back to blog</a>
            </div>

        {{ form_end(form) }}
    </div>
</div>

<script>
const fileInput = document.querySelector('input[type=\"file\"][multiple]');
const previewGrid = document.getElementById('preview-grid');
const uploadZone = document.getElementById('upload-zone');
const startDateInput = document.getElementById('{{ form.startDate.vars.id }}');
const endDateInput = document.getElementById('{{ form.endDate.vars.id }}');
let selectedFiles = [];

function syncFilesToInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

function renderPreviews() {
    previewGrid.innerHTML = '';
    selectedFiles.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = e => {
            const item = document.createElement('div');
            item.className = 'preview-item';
            item.style.animationDelay = (idx * 0.06) + 's';
            item.innerHTML = `
                <img src=\"\${e.target.result}\" alt=\"\${file.name}\">
                <button type=\"button\" class=\"preview-remove\" onclick=\"removeFile(\${idx})\" title=\"Remove\">✕</button>
            `;
            previewGrid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

function removeFile(idx) {
    selectedFiles.splice(idx, 1);
    syncFilesToInput();
    renderPreviews();
}

function addFiles(files) {
    const arr = Array.from(files);
    selectedFiles = [...selectedFiles, ...arr].slice(0, 5);
    syncFilesToInput();
    renderPreviews();
}

if (fileInput) {
    fileInput.addEventListener('change', () => {
        addFiles(fileInput.files);
    });
}

function handleDragOver(e) {
    e.preventDefault();
    uploadZone.classList.add('dragover');
}

function handleDragLeave(e) {
    uploadZone.classList.remove('dragover');
}

function handleDrop(e) {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
}

function toggleAdvancedFields(el) {
    const box = document.getElementById('advanced-fields');
    box.classList.toggle('open');
    el.textContent = box.classList.contains('open') ? 'Hide advanced fields' : 'Advanced fields';
}

function setupDateConstraints() {
    if (!startDateInput || !endDateInput) {
        return;
    }

    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayStr = `\${yyyy}-\${mm}-\${dd}`;

    startDateInput.max = todayStr;
    endDateInput.max = todayStr;

    const syncDateBounds = () => {
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
            if (endDateInput.value && endDateInput.value < startDateInput.value) {
                endDateInput.value = startDateInput.value;
            }
        } else {
            endDateInput.removeAttribute('min');
        }

        if (endDateInput.value) {
            startDateInput.max = endDateInput.value < todayStr ? endDateInput.value : todayStr;
            if (startDateInput.value && startDateInput.value > endDateInput.value) {
                startDateInput.value = endDateInput.value;
            }
        } else {
            startDateInput.max = todayStr;
        }
    };

    startDateInput.addEventListener('change', syncDateBounds);
    endDateInput.addEventListener('change', syncDateBounds);
    syncDateBounds();
}

setupDateConstraints();
</script>
{% endblock %}", "front/blog/travel_story_new.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\blog\\travel_story_new.html.twig");
    }
}
