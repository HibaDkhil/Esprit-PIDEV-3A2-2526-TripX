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

/* front/blog/create_post.html.twig */
class __TwigTemplate_c0fba530dd958b1881ab76d9559d151b extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/create_post.html.twig"));

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

        yield "Create a Post — TripX";
        
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
    max-width: 780px;
    margin: 0 auto;
    padding: calc(var(--nav-height, 70px) + 40px) 16px 80px;
}
.cp-label {
    font-family: var(--font-mono, 'Space Mono');
    font-size: 11px; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--accent-primary);
    margin-bottom: 10px; display: block;
}
.cp-title {
    font-family: var(--font-display, 'Playfair Display');
    font-size: 36px; font-weight: 900;
    color: var(--text-primary); margin: 0 0 8px; line-height: 1.15;
}
.cp-title span { color: var(--accent-primary); }
.cp-subtitle {
    font-size: 15px; color: var(--text-muted);
    margin: 0 0 32px; line-height: 1.6;
}
.cp-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 24px; padding: 36px 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
    animation: fadeUp .45s cubic-bezier(.22,1,.36,1) both;
}
.cp-card label, .cp-field-label {
    display: block; font-weight: 700; font-size: 12px;
    color: var(--text-muted); margin-bottom: 7px;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase; letter-spacing: .06em;
}
.cp-card input[type=\"text\"],
.cp-card textarea,
.cp-card select {
    width: 100%; padding: 13px 16px;
    border: 1px solid var(--border-color); border-radius: 14px;
    background: var(--bg-surface); color: var(--text-primary);
    font-size: 14px; font-family: inherit;
    transition: border-color .2s, box-shadow .2s;
    appearance: none;
}
.cp-card input:focus, .cp-card textarea:focus, .cp-card select:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
}
.cp-card input::placeholder, .cp-card textarea::placeholder { color: var(--text-muted); }
.cp-card textarea { min-height: 200px; resize: vertical; line-height: 1.7; }
.select-wrap { position: relative; }
.select-wrap::after {
    content: '▾'; position: absolute; right: 16px; top: 50%;
    transform: translateY(-50%); pointer-events: none;
    color: var(--text-muted); font-size: 14px;
}
.select-wrap select { padding-right: 40px; cursor: pointer; }
.cp-field { margin-bottom: 22px; }
.cp-card ul { padding: 0; margin: 6px 0 0; list-style: none; }
.cp-card ul li { color: #ef4444; font-size: 13px; }

/* ── Image upload zone ── */
.upload-zone {
    display: block;                       /* label needs display:block */
    border: 2px dashed var(--border-color);
    border-radius: 16px; padding: 36px 20px;
    text-align: center; cursor: pointer;
    transition: border-color .2s, background .2s;
    user-select: none;
}
.upload-zone:hover, .upload-zone.dragover {
    border-color: var(--accent-primary);
    background: rgba(99,102,241,.04);
}
.upload-icon {
    font-size: 46px; display: block; margin-bottom: 12px;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1);
}
.upload-zone:hover .upload-icon { transform: scale(1.18) translateY(-5px); }
.upload-zone-text {
    font-size: 15px; font-weight: 700; color: var(--text-primary); margin-bottom: 5px;
}
.upload-zone-sub {
    font-size: 12px; color: var(--text-muted);
    font-family: var(--font-mono, 'Space Mono');
}

/* ── Image preview grid ── */
.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px; margin-top: 14px;
}
.preview-item {
    position: relative; border-radius: 12px; overflow: hidden;
    aspect-ratio: 1; border: 1px solid var(--border-color);
    animation: fadeUp .3s cubic-bezier(.22,1,.36,1) both;
}
.preview-item img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.preview-remove {
    position: absolute; top: 5px; right: 5px;
    background: rgba(0,0,0,.65); color: #fff; border: none;
    width: 22px; height: 22px; border-radius: 50%; cursor: pointer;
    font-size: 13px; display: flex; align-items: center; justify-content: center;
    transition: background .15s;
}
.preview-remove:hover { background: #ef4444; }

/* ── Notice & actions ── */
.cp-notice {
    display: flex; align-items: flex-start; gap: 10px;
    background: rgba(245,158,11,.09); border: 1px solid rgba(245,158,11,.28);
    border-radius: 14px; padding: 13px 16px;
    font-size: 13px; color: #92400e; margin-bottom: 26px; line-height: 1.5;
}
.cp-actions {
    display: flex; gap: 14px; align-items: center;
    margin-top: 32px; padding-top: 24px;
    border-top: 1px solid var(--border-color);
}
.cp-submit {
    padding: 13px 32px;
    background: linear-gradient(135deg, var(--accent-primary,#6366f1), #a855f7);
    color: #fff; border: none; border-radius: 50px;
    font-size: 15px; font-weight: 700; cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(99,102,241,.3);
}
.cp-submit:hover { transform: translateY(-2px); box-shadow: 0 7px 22px rgba(99,102,241,.42); }
.cp-back {
    text-decoration: none; color: var(--text-muted);
    font-weight: 600; font-size: 14px; transition: color .18s;
}
.cp-back:hover { color: var(--text-primary); }

@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 150
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 151
        yield "<div class=\"cp-wrap\">
    <span class=\"cp-label\">✍️ Create</span>
    <h1 class=\"cp-title\">Share your <span>Travel Story</span></h1>
    <p class=\"cp-subtitle\">
        Post a story, review, tip or question with the TripX community.
        All posts are reviewed before going live.
    </p>

    ";
        // line 159
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 159, $this->source); })()), "flashes", ["error"], "method", false, false, false, 159));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 160
            yield "        <div style=\"background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#b91c1c;font-size:14px;\">❌ ";
            // line 162
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        yield "
    <div class=\"cp-card\">
        <div class=\"cp-notice\">
            ℹ️ Your post will be reviewed by an admin before appearing publicly.
        </div>

        ";
        // line 170
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 170, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate", "enctype" => "multipart/form-data"]]);
        // line 175
        yield "

            ";
        // line 177
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 177, $this->source); })()), 'errors');
        yield "

            ";
        // line 180
        yield "            <div class=\"cp-field\">
                ";
        // line 181
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 181, $this->source); })()), "title", [], "any", false, false, false, 181), 'label', ["label" => "Post Title"]);
        yield "
                ";
        // line 182
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 182, $this->source); })()), "title", [], "any", false, false, false, 182), 'widget', ["attr" => ["placeholder" => "Give your post a clear, catchy title…"]]);
        yield "
                ";
        // line 183
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 183, $this->source); })()), "title", [], "any", false, false, false, 183), 'errors');
        yield "
            </div>

            ";
        // line 187
        yield "            <div class=\"cp-field\">
                ";
        // line 188
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 188, $this->source); })()), "body", [], "any", false, false, false, 188), 'label', ["label" => "Content"]);
        yield "
                ";
        // line 189
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 189, $this->source); })()), "body", [], "any", false, false, false, 189), 'widget', ["attr" => ["placeholder" => "Tell your story, share your experience, ask your question…"]]);
        yield "
                ";
        // line 190
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 190, $this->source); })()), "body", [], "any", false, false, false, 190), 'errors');
        yield "
            </div>

            ";
        // line 194
        yield "            <div class=\"cp-field\">
                ";
        // line 195
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 195, $this->source); })()), "type", [], "any", false, false, false, 195), 'label', ["label" => "Post Type"]);
        yield "
                <div class=\"select-wrap\">
                    ";
        // line 197
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 197, $this->source); })()), "type", [], "any", false, false, false, 197), 'widget');
        yield "
                </div>
                ";
        // line 199
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 199, $this->source); })()), "type", [], "any", false, false, false, 199), 'errors');
        yield "
            </div>

            ";
        // line 203
        yield "            <div class=\"cp-field\">
                <span class=\"cp-field-label\">🖼️ Images (optional — up to 5)</span>

                ";
        // line 207
        yield "                ";
        // line 208
        yield "                ";
        $context["fileInputId"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 208, $this->source); })()), "imageFile", [], "any", false, false, false, 208), "vars", [], "any", false, false, false, 208), "id", [], "any", false, false, false, 208);
        // line 209
        yield "
                <div style=\"position:absolute;width:0;height:0;overflow:hidden;\">
                    ";
        // line 211
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 211, $this->source); })()), "imageFile", [], "any", false, false, false, 211), 'widget', ["attr" => ["multiple" => "multiple"]]);
        yield "
                </div>
                ";
        // line 213
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 213, $this->source); })()), "imageFile", [], "any", false, false, false, 213), 'errors');
        yield "

                ";
        // line 216
        yield "                <label for=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fileInputId"]) || array_key_exists("fileInputId", $context) ? $context["fileInputId"] : (function () { throw new RuntimeError('Variable "fileInputId" does not exist.', 216, $this->source); })()), "html", null, true);
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

                <div class=\"preview-grid\" id=\"preview-grid\"></div>
            </div>

            <div class=\"cp-actions\">
                <button type=\"submit\" class=\"cp-submit\">🚀 Publish Post</button>
                <a href=\"";
        // line 232
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"cp-back\">← Back to blog</a>
            </div>

        ";
        // line 235
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 235, $this->source); })()), 'form_end');
        yield "
    </div>
</div>

<script>
const fileInput  = document.querySelector('input[type=\"file\"][multiple]');
const previewGrid = document.getElementById('preview-grid');
const uploadZone  = document.getElementById('upload-zone');
let selectedFiles = [];

// ── Sync our selectedFiles array to the real input ──────────────────
function syncFilesToInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

// ── Render preview grid ──────────────────────────────────────────────
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
    selectedFiles = [...selectedFiles, ...arr].slice(0, 5); // max 5
    syncFilesToInput();
    renderPreviews();
}

// ── File input change ────────────────────────────────────────────────
fileInput.addEventListener('change', () => {
    addFiles(fileInput.files);
});

// ── Drag & drop ──────────────────────────────────────────────────────
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
        return "front/blog/create_post.html.twig";
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
        return array (  395 => 235,  389 => 232,  369 => 216,  364 => 213,  359 => 211,  355 => 209,  352 => 208,  350 => 207,  345 => 203,  339 => 199,  334 => 197,  329 => 195,  326 => 194,  320 => 190,  316 => 189,  312 => 188,  309 => 187,  303 => 183,  299 => 182,  295 => 181,  292 => 180,  287 => 177,  283 => 175,  281 => 170,  273 => 164,  265 => 162,  261 => 160,  257 => 159,  247 => 151,  237 => 150,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Create a Post — TripX{% endblock %}

{% block stylesheets %}
<style>
.cp-wrap {
    max-width: 780px;
    margin: 0 auto;
    padding: calc(var(--nav-height, 70px) + 40px) 16px 80px;
}
.cp-label {
    font-family: var(--font-mono, 'Space Mono');
    font-size: 11px; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--accent-primary);
    margin-bottom: 10px; display: block;
}
.cp-title {
    font-family: var(--font-display, 'Playfair Display');
    font-size: 36px; font-weight: 900;
    color: var(--text-primary); margin: 0 0 8px; line-height: 1.15;
}
.cp-title span { color: var(--accent-primary); }
.cp-subtitle {
    font-size: 15px; color: var(--text-muted);
    margin: 0 0 32px; line-height: 1.6;
}
.cp-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 24px; padding: 36px 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
    animation: fadeUp .45s cubic-bezier(.22,1,.36,1) both;
}
.cp-card label, .cp-field-label {
    display: block; font-weight: 700; font-size: 12px;
    color: var(--text-muted); margin-bottom: 7px;
    font-family: var(--font-mono, 'Space Mono');
    text-transform: uppercase; letter-spacing: .06em;
}
.cp-card input[type=\"text\"],
.cp-card textarea,
.cp-card select {
    width: 100%; padding: 13px 16px;
    border: 1px solid var(--border-color); border-radius: 14px;
    background: var(--bg-surface); color: var(--text-primary);
    font-size: 14px; font-family: inherit;
    transition: border-color .2s, box-shadow .2s;
    appearance: none;
}
.cp-card input:focus, .cp-card textarea:focus, .cp-card select:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
}
.cp-card input::placeholder, .cp-card textarea::placeholder { color: var(--text-muted); }
.cp-card textarea { min-height: 200px; resize: vertical; line-height: 1.7; }
.select-wrap { position: relative; }
.select-wrap::after {
    content: '▾'; position: absolute; right: 16px; top: 50%;
    transform: translateY(-50%); pointer-events: none;
    color: var(--text-muted); font-size: 14px;
}
.select-wrap select { padding-right: 40px; cursor: pointer; }
.cp-field { margin-bottom: 22px; }
.cp-card ul { padding: 0; margin: 6px 0 0; list-style: none; }
.cp-card ul li { color: #ef4444; font-size: 13px; }

/* ── Image upload zone ── */
.upload-zone {
    display: block;                       /* label needs display:block */
    border: 2px dashed var(--border-color);
    border-radius: 16px; padding: 36px 20px;
    text-align: center; cursor: pointer;
    transition: border-color .2s, background .2s;
    user-select: none;
}
.upload-zone:hover, .upload-zone.dragover {
    border-color: var(--accent-primary);
    background: rgba(99,102,241,.04);
}
.upload-icon {
    font-size: 46px; display: block; margin-bottom: 12px;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1);
}
.upload-zone:hover .upload-icon { transform: scale(1.18) translateY(-5px); }
.upload-zone-text {
    font-size: 15px; font-weight: 700; color: var(--text-primary); margin-bottom: 5px;
}
.upload-zone-sub {
    font-size: 12px; color: var(--text-muted);
    font-family: var(--font-mono, 'Space Mono');
}

/* ── Image preview grid ── */
.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px; margin-top: 14px;
}
.preview-item {
    position: relative; border-radius: 12px; overflow: hidden;
    aspect-ratio: 1; border: 1px solid var(--border-color);
    animation: fadeUp .3s cubic-bezier(.22,1,.36,1) both;
}
.preview-item img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.preview-remove {
    position: absolute; top: 5px; right: 5px;
    background: rgba(0,0,0,.65); color: #fff; border: none;
    width: 22px; height: 22px; border-radius: 50%; cursor: pointer;
    font-size: 13px; display: flex; align-items: center; justify-content: center;
    transition: background .15s;
}
.preview-remove:hover { background: #ef4444; }

/* ── Notice & actions ── */
.cp-notice {
    display: flex; align-items: flex-start; gap: 10px;
    background: rgba(245,158,11,.09); border: 1px solid rgba(245,158,11,.28);
    border-radius: 14px; padding: 13px 16px;
    font-size: 13px; color: #92400e; margin-bottom: 26px; line-height: 1.5;
}
.cp-actions {
    display: flex; gap: 14px; align-items: center;
    margin-top: 32px; padding-top: 24px;
    border-top: 1px solid var(--border-color);
}
.cp-submit {
    padding: 13px 32px;
    background: linear-gradient(135deg, var(--accent-primary,#6366f1), #a855f7);
    color: #fff; border: none; border-radius: 50px;
    font-size: 15px; font-weight: 700; cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(99,102,241,.3);
}
.cp-submit:hover { transform: translateY(-2px); box-shadow: 0 7px 22px rgba(99,102,241,.42); }
.cp-back {
    text-decoration: none; color: var(--text-muted);
    font-weight: 600; font-size: 14px; transition: color .18s;
}
.cp-back:hover { color: var(--text-primary); }

@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
{% endblock %}

{% block body %}
<div class=\"cp-wrap\">
    <span class=\"cp-label\">✍️ Create</span>
    <h1 class=\"cp-title\">Share your <span>Travel Story</span></h1>
    <p class=\"cp-subtitle\">
        Post a story, review, tip or question with the TripX community.
        All posts are reviewed before going live.
    </p>

    {% for msg in app.flashes('error') %}
        <div style=\"background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);
                    border-radius:14px;padding:14px 18px;margin-bottom:20px;
                    color:#b91c1c;font-size:14px;\">❌ {{ msg }}</div>
    {% endfor %}

    <div class=\"cp-card\">
        <div class=\"cp-notice\">
            ℹ️ Your post will be reviewed by an admin before appearing publicly.
        </div>

        {{ form_start(form, {
            'attr': {
                'novalidate': 'novalidate',
                'enctype': 'multipart/form-data'
            }
        }) }}

            {{ form_errors(form) }}

            {# Title #}
            <div class=\"cp-field\">
                {{ form_label(form.title, 'Post Title') }}
                {{ form_widget(form.title, {'attr': {'placeholder': 'Give your post a clear, catchy title…'}}) }}
                {{ form_errors(form.title) }}
            </div>

            {# Body #}
            <div class=\"cp-field\">
                {{ form_label(form.body, 'Content') }}
                {{ form_widget(form.body, {'attr': {'placeholder': 'Tell your story, share your experience, ask your question…'}}) }}
                {{ form_errors(form.body) }}
            </div>

            {# Type #}
            <div class=\"cp-field\">
                {{ form_label(form.type, 'Post Type') }}
                <div class=\"select-wrap\">
                    {{ form_widget(form.type) }}
                </div>
                {{ form_errors(form.type) }}
            </div>

            {# Image Upload #}
            <div class=\"cp-field\">
                <span class=\"cp-field-label\">🖼️ Images (optional — up to 5)</span>

                {# Render the Symfony file widget — hidden visually but fully clickable via its label #}
                {# We capture the real Symfony-generated ID so our <label for=\"...\"> matches exactly #}
                {% set fileInputId = form.imageFile.vars.id %}

                <div style=\"position:absolute;width:0;height:0;overflow:hidden;\">
                    {{ form_widget(form.imageFile, {'attr': {'multiple': 'multiple'}}) }}
                </div>
                {{ form_errors(form.imageFile) }}

                {# <label for=\"...\"> natively triggers the input on click — zero JS needed #}
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

                <div class=\"preview-grid\" id=\"preview-grid\"></div>
            </div>

            <div class=\"cp-actions\">
                <button type=\"submit\" class=\"cp-submit\">🚀 Publish Post</button>
                <a href=\"{{ path('blog') }}\" class=\"cp-back\">← Back to blog</a>
            </div>

        {{ form_end(form) }}
    </div>
</div>

<script>
const fileInput  = document.querySelector('input[type=\"file\"][multiple]');
const previewGrid = document.getElementById('preview-grid');
const uploadZone  = document.getElementById('upload-zone');
let selectedFiles = [];

// ── Sync our selectedFiles array to the real input ──────────────────
function syncFilesToInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

// ── Render preview grid ──────────────────────────────────────────────
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
    selectedFiles = [...selectedFiles, ...arr].slice(0, 5); // max 5
    syncFilesToInput();
    renderPreviews();
}

// ── File input change ────────────────────────────────────────────────
fileInput.addEventListener('change', () => {
    addFiles(fileInput.files);
});

// ── Drag & drop ──────────────────────────────────────────────────────
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
</script>
{% endblock %}
", "front/blog/create_post.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\create_post.html.twig");
    }
}
