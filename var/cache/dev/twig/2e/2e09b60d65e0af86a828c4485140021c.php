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
        padding: calc(var(--nav-height, 70px) + 24px) 12px 50px;
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

    // line 336
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 337
        yield "<div class=\"cp-wrap\">
    <span class=\"cp-label\">🧳 Create</span>

    ";
        // line 340
        if ((array_key_exists("story", $context) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 340, $this->source); })()), "id", [], "any", false, false, false, 340))) {
            // line 341
            yield "        <h1 class=\"cp-title\">Edit <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Update your travel experience, recommendations, photos, and practical tips.
        </p>
    ";
        } else {
            // line 346
            yield "        <h1 class=\"cp-title\">Write a <span>Travel Story</span></h1>
        <p class=\"cp-subtitle\">
            Share a complete travel experience with photos, recommendations, tips, and useful details for other travelers.
        </p>
    ";
        }
        // line 351
        yield "
    ";
        // line 352
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 352, $this->source); })()), "flashes", ["error"], "method", false, false, false, 352));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 353
            yield "        <div style=\"background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#b91c1c;font-size:14px;\">❌ ";
            // line 355
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 357
        yield "
    ";
        // line 358
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 358, $this->source); })()), "flashes", ["success"], "method", false, false, false, 358));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 359
            yield "        <div style=\"background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#166534;font-size:14px;\">✅ ";
            // line 361
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 363
        yield "
    <div class=\"cp-card\">
        <div class=\"cp-notice\">
            ℹ️ Your travel story should be clear, helpful, and based on a real travel experience.
        </div>

        ";
        // line 369
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 369, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate", "enctype" => "multipart/form-data"]]);
        // line 374
        yield "

            ";
        // line 376
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 376, $this->source); })()), 'errors');
        yield "

            <div class=\"cp-grid\">
                <div class=\"cp-field cp-span-2\">
                    ";
        // line 380
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 380, $this->source); })()), "title", [], "any", false, false, false, 380), 'label', ["label" => "Title"]);
        yield "
                    ";
        // line 381
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 381, $this->source); })()), "title", [], "any", false, false, false, 381), 'widget', ["attr" => ["class" => "story-title-input", "placeholder" => "Give your travel story a clear, catchy title…"]]);
        // line 384
        yield "
                    ";
        // line 385
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 385, $this->source); })()), "title", [], "any", false, false, false, 385), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 389
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 389, $this->source); })()), "destination", [], "any", false, false, false, 389), 'label', ["label" => "Destination"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 391
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 391, $this->source); })()), "destination", [], "any", false, false, false, 391), 'widget');
        yield "
                    </div>
                    ";
        // line 393
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 393, $this->source); })()), "destination", [], "any", false, false, false, 393), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 397
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 397, $this->source); })()), "travelType", [], "any", false, false, false, 397), 'label', ["label" => "Travel Type"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 399
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 399, $this->source); })()), "travelType", [], "any", false, false, false, 399), 'widget');
        yield "
                    </div>
                    ";
        // line 401
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 401, $this->source); })()), "travelType", [], "any", false, false, false, 401), 'errors');
        yield "
                </div>

                <div class=\"cp-field cp-span-2\">
                    ";
        // line 405
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 405, $this->source); })()), "summary", [], "any", false, false, false, 405), 'label', ["label" => "Summary"]);
        yield "
                    ";
        // line 406
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 406, $this->source); })()), "summary", [], "any", false, false, false, 406), 'widget', ["attr" => ["class" => "story-summary", "placeholder" => "Tell the story of your trip, what stood out, what readers should know…"]]);
        // line 409
        yield "
                    ";
        // line 410
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 410, $this->source); })()), "summary", [], "any", false, false, false, 410), 'errors');
        yield "
                </div>

                <div class=\"cp-field cp-span-2\">
                    ";
        // line 414
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 414, $this->source); })()), "tips", [], "any", false, false, false, 414), 'label', ["label" => "Tips"]);
        yield "
                    ";
        // line 415
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 415, $this->source); })()), "tips", [], "any", false, false, false, 415), 'widget', ["attr" => ["class" => "story-tips", "placeholder" => "Practical advice, things to avoid, budget tips, best times, local recommendations…"]]);
        // line 418
        yield "
                    ";
        // line 419
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 419, $this->source); })()), "tips", [], "any", false, false, false, 419), 'errors');
        yield "
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">🖼️ Images (optional — up to 5)</span>

                ";
        // line 426
        $context["fileInputId"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 426, $this->source); })()), "imageFile", [], "any", false, false, false, 426), "vars", [], "any", false, false, false, 426), "id", [], "any", false, false, false, 426);
        // line 427
        yield "
                <div style=\"position:absolute;width:0;height:0;overflow:hidden;\">
                    ";
        // line 429
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 429, $this->source); })()), "imageFile", [], "any", false, false, false, 429), 'widget', ["attr" => ["multiple" => "multiple"]]);
        yield "
                </div>
                ";
        // line 431
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 431, $this->source); })()), "imageFile", [], "any", false, false, false, 431), 'errors');
        yield "

                <label for=\"";
        // line 433
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fileInputId"]) || array_key_exists("fileInputId", $context) ? $context["fileInputId"] : (function () { throw new RuntimeError('Variable "fileInputId" does not exist.', 433, $this->source); })()), "html", null, true);
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
        // line 445
        if ((array_key_exists("story", $context) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 445, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 445)))) {
            // line 446
            yield "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 446, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 446));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 447
                yield "                            <div class=\"preview-item existing-image\">
                                <img src=\"";
                // line 448
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" alt=\"Travel story image\">
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 451
            yield "                    ";
        }
        // line 452
        yield "                </div>
            </div>

            <div class=\"cp-grid\">
                <div class=\"cp-field\">
                    ";
        // line 457
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 457, $this->source); })()), "startDate", [], "any", false, false, false, 457), 'label', ["label" => "Start Date"]);
        yield "
                    ";
        // line 458
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 458, $this->source); })()), "startDate", [], "any", false, false, false, 458), 'widget');
        yield "
                    ";
        // line 459
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 459, $this->source); })()), "startDate", [], "any", false, false, false, 459), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 463
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 463, $this->source); })()), "endDate", [], "any", false, false, false, 463), 'label', ["label" => "End Date"]);
        yield "
                    ";
        // line 464
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 464, $this->source); })()), "endDate", [], "any", false, false, false, 464), 'widget');
        yield "
                    ";
        // line 465
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 465, $this->source); })()), "endDate", [], "any", false, false, false, 465), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 469
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 469, $this->source); })()), "travelStyle", [], "any", false, false, false, 469), 'label', ["label" => "Travel Style"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 471
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 471, $this->source); })()), "travelStyle", [], "any", false, false, false, 471), 'widget');
        yield "
                    </div>
                    ";
        // line 473
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 473, $this->source); })()), "travelStyle", [], "any", false, false, false, 473), 'errors');
        yield "
                </div>

                <div class=\"cp-field\">
                    ";
        // line 477
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 477, $this->source); })()), "overallRating", [], "any", false, false, false, 477), 'label', ["label" => "Rating"]);
        yield "
                    <div class=\"select-wrap\">
                        ";
        // line 479
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 479, $this->source); })()), "overallRating", [], "any", false, false, false, 479), 'widget');
        yield "
                    </div>
                    ";
        // line 481
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 481, $this->source); })()), "overallRating", [], "any", false, false, false, 481), 'errors');
        yield "
                </div>
            </div>

            <div class=\"cp-field\">
                <span class=\"cp-field-label\">Recommendation</span>
                <div class=\"cp-inline-checks\">
                    <label class=\"cp-inline-check\">
                        ";
        // line 489
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 489, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 489), 'widget');
        yield "
                        <span>Would recommend</span>
                    </label>

                    <label class=\"cp-inline-check\">
                        ";
        // line 494
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 494, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 494), 'widget');
        yield "
                        <span>Would go again</span>
                    </label>
                </div>
                ";
        // line 498
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 498, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 498), 'errors');
        yield "
                ";
        // line 499
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 499, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 499), 'errors');
        yield "
            </div>

            <span class=\"cp-advanced-toggle\" onclick=\"toggleAdvancedFields(this)\">Advanced fields</span>

            <div class=\"cp-advanced-box\" id=\"advanced-fields\">
                <div class=\"cp-grid\">
                    <div class=\"cp-field\">
                        ";
        // line 507
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 507, $this->source); })()), "currency", [], "any", false, false, false, 507), 'label', ["label" => "Currency"]);
        yield "
                        ";
        // line 508
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 508, $this->source); })()), "currency", [], "any", false, false, false, 508), 'widget', ["attr" => ["placeholder" => "TND"]]);
        yield "
                        ";
        // line 509
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 509, $this->source); })()), "currency", [], "any", false, false, false, 509), 'errors');
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 513
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 513, $this->source); })()), "totalBudget", [], "any", false, false, false, 513), 'label', ["label" => "Total Budget"]);
        yield "
                        ";
        // line 514
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 514, $this->source); })()), "totalBudget", [], "any", false, false, false, 514), 'widget', ["attr" => ["placeholder" => "0.00"]]);
        yield "
                        ";
        // line 515
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 515, $this->source); })()), "totalBudget", [], "any", false, false, false, 515), 'errors');
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 519
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 519, $this->source); })()), "tagsText", [], "any", false, false, false, 519), 'label', ["label" => "Tags"]);
        yield "
                        ";
        // line 520
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 520, $this->source); })()), "tagsText", [], "any", false, false, false, 520), 'widget', ["attr" => ["rows" => 2, "placeholder" => "beach, food, city, adventure"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 524
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 524, $this->source); })()), "favoritePlacesText", [], "any", false, false, false, 524), 'label', ["label" => "Favorite Places"]);
        yield "
                        ";
        // line 525
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 525, $this->source); })()), "favoritePlacesText", [], "any", false, false, false, 525), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 529
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 529, $this->source); })()), "mustVisitText", [], "any", false, false, false, 529), 'label', ["label" => "Must Visit"]);
        yield "
                        ";
        // line 530
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 530, $this->source); })()), "mustVisitText", [], "any", false, false, false, 530), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 534
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 534, $this->source); })()), "mustDoText", [], "any", false, false, false, 534), 'label', ["label" => "Must Do"]);
        yield "
                        ";
        // line 535
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 535, $this->source); })()), "mustDoText", [], "any", false, false, false, 535), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 539
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 539, $this->source); })()), "mustTryText", [], "any", false, false, false, 539), 'label', ["label" => "Must Try"]);
        yield "
                        ";
        // line 540
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 540, $this->source); })()), "mustTryText", [], "any", false, false, false, 540), 'widget', ["attr" => ["rows" => 2, "placeholder" => "comma separated"]]);
        yield "
                    </div>

                    <div class=\"cp-field\">
                        ";
        // line 544
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 544, $this->source); })()), "budgetText", [], "any", false, false, false, 544), 'label', ["label" => "Detailed Budget JSON"]);
        yield "
                        ";
        // line 545
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 545, $this->source); })()), "budgetText", [], "any", false, false, false, 545), 'widget', ["attr" => ["rows" => 3, "placeholder" => "{\"hotel\":200,\"food\":120,\"transport\":80}"]]);
        yield "
                    </div>
                </div>
            </div>

            <div class=\"cp-actions\">
                <button type=\"submit\" class=\"cp-submit\">
                    ";
        // line 552
        if ((array_key_exists("story", $context) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 552, $this->source); })()), "id", [], "any", false, false, false, 552))) {
            // line 553
            yield "                        💾 Update Story
                    ";
        } else {
            // line 555
            yield "                        🚀 Save Story
                    ";
        }
        // line 557
        yield "                </button>
                <a href=\"";
        // line 558
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"cp-back\">← Back to blog</a>
            </div>

        ";
        // line 561
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 561, $this->source); })()), 'form_end');
        yield "
    </div>
</div>

<script>
const fileInput = document.querySelector('input[type=\"file\"][multiple]');
const previewGrid = document.getElementById('preview-grid');
const uploadZone = document.getElementById('upload-zone');
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
        return array (  874 => 561,  868 => 558,  865 => 557,  861 => 555,  857 => 553,  855 => 552,  845 => 545,  841 => 544,  834 => 540,  830 => 539,  823 => 535,  819 => 534,  812 => 530,  808 => 529,  801 => 525,  797 => 524,  790 => 520,  786 => 519,  779 => 515,  775 => 514,  771 => 513,  764 => 509,  760 => 508,  756 => 507,  745 => 499,  741 => 498,  734 => 494,  726 => 489,  715 => 481,  710 => 479,  705 => 477,  698 => 473,  693 => 471,  688 => 469,  681 => 465,  677 => 464,  673 => 463,  666 => 459,  662 => 458,  658 => 457,  651 => 452,  648 => 451,  639 => 448,  636 => 447,  631 => 446,  629 => 445,  614 => 433,  609 => 431,  604 => 429,  600 => 427,  598 => 426,  588 => 419,  585 => 418,  583 => 415,  579 => 414,  572 => 410,  569 => 409,  567 => 406,  563 => 405,  556 => 401,  551 => 399,  546 => 397,  539 => 393,  534 => 391,  529 => 389,  522 => 385,  519 => 384,  517 => 381,  513 => 380,  506 => 376,  502 => 374,  500 => 369,  492 => 363,  484 => 361,  480 => 359,  476 => 358,  473 => 357,  465 => 355,  461 => 353,  457 => 352,  454 => 351,  447 => 346,  440 => 341,  438 => 340,  433 => 337,  423 => 336,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
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
        padding: calc(var(--nav-height, 70px) + 24px) 12px 50px;
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
                    {{ form_widget(form.startDate) }}
                    {{ form_errors(form.startDate) }}
                </div>

                <div class=\"cp-field\">
                    {{ form_label(form.endDate, 'End Date') }}
                    {{ form_widget(form.endDate) }}
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
</script>
{% endblock %}", "front/blog/travel_story_new.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\travel_story_new.html.twig");
    }
}
