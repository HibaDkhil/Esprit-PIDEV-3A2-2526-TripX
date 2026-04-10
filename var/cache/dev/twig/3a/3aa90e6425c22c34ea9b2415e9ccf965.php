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

/* front/blog/show.html.twig */
class __TwigTemplate_790113cf2b2fbeaea8f66ce754d5ac7d extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/show.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 2, $this->source); })()), "title", [], "any", false, false, false, 2), "html", null, true);
        yield " — TripX Blog";
        
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
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
<link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Montserrat:wght@400;500;600;700&display=swap\" rel=\"stylesheet\">
<style>
.post-show-shell {
    max-width: 960px;
    margin: 0 auto;
    padding: 50px 16px 72px;
}

.post-show-panel {
    background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 18px 38px rgba(15, 23, 42, 0.08);
}

.back-link {
    color: #1d4ed8;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 18px;
}

.back-link:hover {
    color: #0f172a;
}

.flash-success,
.flash-error {
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
}

.flash-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
}

.flash-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.show-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.avatar-lg {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #22c55e);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 800;
    color: #ffffff;
    flex-shrink: 0;
}

.show-author {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}

.show-date {
    font-size: 12px;
    color: #64748b;
}

.type-badge {
    margin-left: auto;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge-inquiry { background: #dbeafe; color: #1e40af; }
.badge-story { background: #d1fae5; color: #065f46; }
.badge-travel_story { background: #e0f2fe; color: #155e75; }
.badge-review { background: #fef3c7; color: #92400e; }
.badge-advice { background: #ede9fe; color: #5b21b6; }
.badge-other { background: #f1f5f9; color: #334155; }

.owner-actions {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
}

.btn-edit,
.btn-delete {
    border-radius: 999px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 700;
}

.btn-edit {
    border: 1px solid #93c5fd;
    background: #eff6ff;
    color: #1d4ed8;
    text-decoration: none;
}

.btn-delete {
    border: 1px solid #fda4af;
    background: #fff1f2;
    color: #be123c;
    cursor: pointer;
}

h1.show-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.9rem, 3vw, 2.7rem);
    font-weight: 800;
    line-height: 1.2;
    margin: 0 0 20px;
    color: #0f172a;
}

.show-image {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    border-radius: 18px;
    margin-bottom: 20px;
}

.show-images-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    margin-bottom: 20px;
}

.show-images-grid .show-image {
    margin-bottom: 0;
    height: 260px;
    max-height: 260px;
}

.show-body {
    font-size: 16px;
    line-height: 1.85;
    color: #1e293b;
    white-space: pre-line;
    margin-bottom: 8px;
}

.reactions-bar {
    margin: 26px 0;
    padding: 14px 0;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.reaction-wrapper { position: relative; display: inline-block; }
.reaction-wrapper::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 100%;
    width: 100%;
    height: 14px;
}

.react-main-btn {
    padding: 8px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    background: #f8fafc;
    font-size: 14px;
    font-weight: 700;
    color: #334155;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.react-main-btn.active {
    background: #1d4ed8;
    border-color: #1d4ed8;
    color: #ffffff;
}

.reaction-picker {
    position: absolute;
    left: 0;
    bottom: calc(100% + 10px);
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    padding: 6px 8px;
    display: flex;
    gap: 4px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.14);
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: all .2s;
    z-index: 60;
    pointer-events: none;
}

.reaction-wrapper:hover .reaction-picker {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.reaction-picker form { margin: 0; }

.reaction-emoji {
    background: transparent;
    border: none;
    font-size: 21px;
    cursor: pointer;
    padding: 3px 6px;
    border-radius: 10px;
}

.reaction-emoji:hover {
    background: #f1f5f9;
    transform: scale(1.15);
}

.counts-row {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 13px;
    color: #475569;
}

.comments-section {
    margin-top: 34px;
}

.comments-section h2 {
    margin: 0 0 18px;
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
}

.comment-item {
    display: flex;
    gap: 12px;
    margin-bottom: 14px;
}

.comment-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: #ffffff;
    flex-shrink: 0;
}

.comment-bubble {
    flex: 1;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 14px;
}

.comment-author {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
}

.comment-body {
    margin-top: 4px;
    color: #334155;
    font-size: 14px;
    line-height: 1.7;
    white-space: pre-line;
}

.comment-footer {
    margin-top: 8px;
    display: flex;
    gap: 12px;
    align-items: center;
    color: #94a3b8;
    font-size: 12px;
}

.comment-delete-btn {
    border: none;
    background: none;
    color: #dc2626;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    padding: 0;
}

.comment-form-wrap {
    margin-top: 20px;
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    background: #f8fafc;
}

.comment-form-wrap h3 {
    margin: 0 0 10px;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
}

.comment-form-wrap textarea {
    width: 100%;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    min-height: 110px;
    padding: 11px 13px;
    font-size: 14px;
    font-family: 'Montserrat', sans-serif;
    resize: vertical;
}

.comment-form-wrap textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
}

.comment-form-wrap button {
    margin-top: 10px;
    border: none;
    border-radius: 999px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    cursor: pointer;
}

.empty-comments {
    color: #64748b;
    margin: 0;
    font-size: 14px;
}

@media (max-width: 768px) {
    .post-show-panel {
        padding: 18px;
        border-radius: 18px;
    }

    .show-meta {
        flex-wrap: wrap;
    }

    .type-badge {
        margin-left: 0;
    }

    .owner-actions {
        flex-wrap: wrap;
    }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 412
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 413
        $context["typeKey"] = Twig\Extension\CoreExtension::lower($this->env->getCharset(), (((CoreExtension::getAttribute($this->env, $this->source, ($context["post"] ?? null), "type", [], "any", true, true, false, 413) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 413, $this->source); })()), "type", [], "any", false, false, false, 413)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 413, $this->source); })()), "type", [], "any", false, false, false, 413)) : ("other")));
        // line 414
        $context["badgeClass"] = ((CoreExtension::inFilter((isset($context["typeKey"]) || array_key_exists("typeKey", $context) ? $context["typeKey"] : (function () { throw new RuntimeError('Variable "typeKey" does not exist.', 414, $this->source); })()), ["inquiry", "story", "travel_story", "review", "advice"])) ? ((isset($context["typeKey"]) || array_key_exists("typeKey", $context) ? $context["typeKey"] : (function () { throw new RuntimeError('Variable "typeKey" does not exist.', 414, $this->source); })())) : ("other"));
        // line 415
        yield "<div class=\"post-show-shell\">
    <div class=\"post-show-panel\">

        <a href=\"";
        // line 418
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"back-link\">← Back to Blog</a>

    ";
        // line 421
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 421, $this->source); })()), "flashes", ["success"], "method", false, false, false, 421));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 422
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 422, $this->source); })()), "flashes", ["error"], "method", false, false, false, 422));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-error\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 423
        yield "
    ";
        // line 425
        yield "    ";
        $context["authorName"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["authors"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 425, $this->source); })()), "userId", [], "any", false, false, false, 425), [], "array", true, true, false, 425) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 425, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 425, $this->source); })()), "userId", [], "any", false, false, false, 425), [], "array", false, false, false, 425)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 425, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 425, $this->source); })()), "userId", [], "any", false, false, false, 425), [], "array", false, false, false, 425)) : ("Anonymous"));
        // line 426
        yield "    <div class=\"show-meta\">
        <div class=\"avatar-lg\">";
        // line 427
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 427, $this->source); })()))), "html", null, true);
        yield "</div>
        <div>
            <div class=\"show-author\">";
        // line 429
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 429, $this->source); })()), "html", null, true);
        yield "</div>
            ";
        // line 430
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 430, $this->source); })()), "createdAt", [], "any", false, false, false, 430)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 431
            yield "                <div class=\"show-date\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 431, $this->source); })()), "createdAt", [], "any", false, false, false, 431), "d M Y · H:i"), "html", null, true);
            yield "</div>
            ";
        }
        // line 433
        yield "        </div>
        <span class=\"type-badge badge-";
        // line 434
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["badgeClass"]) || array_key_exists("badgeClass", $context) ? $context["badgeClass"] : (function () { throw new RuntimeError('Variable "badgeClass" does not exist.', 434, $this->source); })()), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace((isset($context["typeKey"]) || array_key_exists("typeKey", $context) ? $context["typeKey"] : (function () { throw new RuntimeError('Variable "typeKey" does not exist.', 434, $this->source); })()), ["_" => " "])), "html", null, true);
        yield "</span>
    </div>

    ";
        // line 438
        yield "    ";
        $context["isOwner"] = ( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 438, $this->source); })()), "user", [], "any", false, false, false, 438)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 438, $this->source); })()), "user", [], "any", false, false, false, 438), "id", [], "any", false, false, false, 438) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 438, $this->source); })()), "userId", [], "any", false, false, false, 438)));
        // line 439
        yield "    ";
        if ((($tmp = (isset($context["isOwner"]) || array_key_exists("isOwner", $context) ? $context["isOwner"] : (function () { throw new RuntimeError('Variable "isOwner" does not exist.', 439, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 440
            yield "        <div class=\"owner-actions\">
            <a href=\"";
            // line 441
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 441, $this->source); })()), "id", [], "any", false, false, false, 441)]), "html", null, true);
            yield "\" class=\"btn-edit\">Edit</a>
            <form method=\"post\" action=\"";
            // line 442
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 442, $this->source); })()), "id", [], "any", false, false, false, 442)]), "html", null, true);
            yield "\"
                  onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 444
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 444, $this->source); })()), "id", [], "any", false, false, false, 444))), "html", null, true);
            yield "\">
                <button type=\"submit\" class=\"btn-delete\">Delete</button>
            </form>
        </div>
    ";
        }
        // line 449
        yield "
    <h1 class=\"show-title\">";
        // line 450
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 450, $this->source); })()), "title", [], "any", false, false, false, 450), "html", null, true);
        yield "</h1>

    ";
        // line 452
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 452, $this->source); })()), "imageUrl", [], "any", false, false, false, 452)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 453
            yield "        ";
            $context["imageUrls"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 453, $this->source); })()), "imageUrl", [], "any", false, false, false, 453), ",");
            // line 454
            yield "        ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["imageUrls"]) || array_key_exists("imageUrls", $context) ? $context["imageUrls"] : (function () { throw new RuntimeError('Variable "imageUrls" does not exist.', 454, $this->source); })())) > 1)) {
                // line 455
                yield "            <div class=\"show-images-grid\">
                ";
                // line 456
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["imageUrls"]) || array_key_exists("imageUrls", $context) ? $context["imageUrls"] : (function () { throw new RuntimeError('Variable "imageUrls" does not exist.', 456, $this->source); })()));
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
                foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                    // line 457
                    yield "                    ";
                    $context["cleanImg"] = Twig\Extension\CoreExtension::trim($context["img"]);
                    // line 458
                    yield "                    ";
                    if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["cleanImg"]) || array_key_exists("cleanImg", $context) ? $context["cleanImg"] : (function () { throw new RuntimeError('Variable "cleanImg" does not exist.', 458, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 459
                        yield "                        <img src=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["cleanImg"]) || array_key_exists("cleanImg", $context) ? $context["cleanImg"] : (function () { throw new RuntimeError('Variable "cleanImg" does not exist.', 459, $this->source); })()), "html", null, true);
                        yield "\" class=\"show-image\" alt=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 459, $this->source); })()), "title", [], "any", false, false, false, 459), "html", null, true);
                        yield " image ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 459), "html", null, true);
                        yield "\">
                    ";
                    }
                    // line 461
                    yield "                ";
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
                unset($context['_seq'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 462
                yield "            </div>
        ";
            } else {
                // line 464
                yield "            <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, (isset($context["imageUrls"]) || array_key_exists("imageUrls", $context) ? $context["imageUrls"] : (function () { throw new RuntimeError('Variable "imageUrls" does not exist.', 464, $this->source); })()), 0, [], "array", false, false, false, 464)), "html", null, true);
                yield "\" class=\"show-image\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 464, $this->source); })()), "title", [], "any", false, false, false, 464), "html", null, true);
                yield "\">
        ";
            }
            // line 466
            yield "    ";
        }
        // line 467
        yield "
    <div class=\"show-body\">";
        // line 468
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 468, $this->source); })()), "body", [], "any", false, false, false, 468), "html", null, true);
        yield "</div>

    ";
        // line 471
        yield "    <div class=\"reactions-bar\">
        ";
        // line 472
        $context["icons"] = ["like" => "👍", "love" => "❤️", "haha" => "😂", "wow" => "😮", "sad" => "😢", "angry" => "😡"];
        // line 473
        yield "        <div class=\"reaction-wrapper\">
            <button type=\"button\" class=\"react-main-btn ";
        // line 474
        if ((($tmp = (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 474, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "active";
        }
        yield "\">
                ";
        // line 475
        if (((isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 475, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, ($context["icons"] ?? null), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 475, $this->source); })()), [], "array", true, true, false, 475))) {
            // line 476
            yield "                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 476, $this->source); })()), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 476, $this->source); })()), [], "array", false, false, false, 476), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 476, $this->source); })())), "html", null, true);
            yield "
                ";
        } else {
            // line 478
            yield "                    🙂 React
                ";
        }
        // line 480
        yield "            </button>
            <div class=\"reaction-picker\">
                ";
        // line 482
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 482, $this->source); })()));
        foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
            // line 483
            yield "                    <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_react", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 483, $this->source); })()), "id", [], "any", false, false, false, 483), "type" => $context["rtype"]]), "html", null, true);
            yield "\">
                        <button type=\"submit\" class=\"reaction-emoji\" aria-label=\"React ";
            // line 484
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["rtype"]), "html", null, true);
            yield "\" title=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["rtype"]), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
            yield "</button>
                    </form>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 487
        yield "            </div>
        </div>
        <div class=\"counts-row\">
            ";
        // line 490
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 490, $this->source); })()));
        foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
            // line 491
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["reactionMap"] ?? null), $context["rtype"], [], "array", true, true, false, 491) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionMap"]) || array_key_exists("reactionMap", $context) ? $context["reactionMap"] : (function () { throw new RuntimeError('Variable "reactionMap" does not exist.', 491, $this->source); })()), $context["rtype"], [], "array", false, false, false, 491) > 0))) {
                // line 492
                yield "                    <span>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionMap"]) || array_key_exists("reactionMap", $context) ? $context["reactionMap"] : (function () { throw new RuntimeError('Variable "reactionMap" does not exist.', 492, $this->source); })()), $context["rtype"], [], "array", false, false, false, 492), "html", null, true);
                yield "</span>
                ";
            }
            // line 494
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 495
        yield "        </div>
    </div>

    ";
        // line 499
        yield "    <div class=\"comments-section\">
        <h2>Comments (";
        // line 500
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 500, $this->source); })()), "comments", [], "any", false, false, false, 500)), "html", null, true);
        yield ")</h2>

        ";
        // line 502
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 502, $this->source); })()), "comments", [], "any", false, false, false, 502)) > 0)) {
            // line 503
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 503, $this->source); })()), "comments", [], "any", false, false, false, 503));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 504
                yield "                ";
                $context["cAuthor"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authors"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 504), [], "array", true, true, false, 504) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 504, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 504), [], "array", false, false, false, 504)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 504, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 504), [], "array", false, false, false, 504)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 504));
                // line 505
                yield "                <div class=\"comment-item\">
                    <div class=\"comment-avatar\">";
                // line 506
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["cAuthor"]) || array_key_exists("cAuthor", $context) ? $context["cAuthor"] : (function () { throw new RuntimeError('Variable "cAuthor" does not exist.', 506, $this->source); })()))), "html", null, true);
                yield "</div>
                    <div class=\"comment-bubble\">
                        <div class=\"comment-author\">";
                // line 508
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["cAuthor"]) || array_key_exists("cAuthor", $context) ? $context["cAuthor"] : (function () { throw new RuntimeError('Variable "cAuthor" does not exist.', 508, $this->source); })()), "html", null, true);
                yield "</div>
                        <div class=\"comment-body\">";
                // line 509
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 509), "html", null, true);
                yield "</div>
                        <div class=\"comment-footer\">
                            ";
                // line 511
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 511)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 512
                    yield "                                <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 512), "d M Y H:i"), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 514
                yield "                            ";
                // line 515
                yield "                            ";
                if (( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 515, $this->source); })()), "user", [], "any", false, false, false, 515)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 515, $this->source); })()), "user", [], "any", false, false, false, 515), "id", [], "any", false, false, false, 515) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 515)))) {
                    // line 516
                    yield "                                <form method=\"post\" action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 516)]), "html", null, true);
                    yield "\"
                                      onsubmit=\"return confirm('Delete this comment?');\" style=\"margin:0;\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"";
                    // line 519
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 519))), "html", null, true);
                    yield "\">
                                    <button type=\"submit\" class=\"comment-delete-btn\">
                                        Delete
                                    </button>
                                </form>
                            ";
                }
                // line 525
                yield "                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 529
            yield "        ";
        } else {
            // line 530
            yield "            <p class=\"empty-comments\">No comments yet. Be the first to comment.</p>
        ";
        }
        // line 532
        yield "
        ";
        // line 534
        yield "        <div class=\"comment-form-wrap\">
            <h3>Leave a comment</h3>
            <form method=\"post\" action=\"";
        // line 536
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 536, $this->source); })()), "id", [], "any", false, false, false, 536)]), "html", null, true);
        yield "\">
                <textarea name=\"body\" placeholder=\"Share your thoughts…\" required></textarea>
                <br>
                <button type=\"submit\">Post Comment</button>
            </form>
        </div>
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
        return "front/blog/show.html.twig";
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
        return array (  873 => 536,  869 => 534,  866 => 532,  862 => 530,  859 => 529,  850 => 525,  841 => 519,  834 => 516,  831 => 515,  829 => 514,  823 => 512,  821 => 511,  816 => 509,  812 => 508,  807 => 506,  804 => 505,  801 => 504,  796 => 503,  794 => 502,  789 => 500,  786 => 499,  781 => 495,  775 => 494,  767 => 492,  764 => 491,  760 => 490,  755 => 487,  742 => 484,  737 => 483,  733 => 482,  729 => 480,  725 => 478,  717 => 476,  715 => 475,  709 => 474,  706 => 473,  704 => 472,  701 => 471,  696 => 468,  693 => 467,  690 => 466,  682 => 464,  678 => 462,  664 => 461,  654 => 459,  651 => 458,  648 => 457,  631 => 456,  628 => 455,  625 => 454,  622 => 453,  620 => 452,  615 => 450,  612 => 449,  604 => 444,  599 => 442,  595 => 441,  592 => 440,  589 => 439,  586 => 438,  578 => 434,  575 => 433,  569 => 431,  567 => 430,  563 => 429,  558 => 427,  555 => 426,  552 => 425,  549 => 423,  537 => 422,  525 => 421,  520 => 418,  515 => 415,  513 => 414,  511 => 413,  501 => 412,  87 => 5,  77 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}{{ post.title }} — TripX Blog{% endblock %}

{% block stylesheets %}
{{ parent() }}
<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
<link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Montserrat:wght@400;500;600;700&display=swap\" rel=\"stylesheet\">
<style>
.post-show-shell {
    max-width: 960px;
    margin: 0 auto;
    padding: 50px 16px 72px;
}

.post-show-panel {
    background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 18px 38px rgba(15, 23, 42, 0.08);
}

.back-link {
    color: #1d4ed8;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 18px;
}

.back-link:hover {
    color: #0f172a;
}

.flash-success,
.flash-error {
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
}

.flash-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
}

.flash-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.show-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.avatar-lg {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #22c55e);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 800;
    color: #ffffff;
    flex-shrink: 0;
}

.show-author {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}

.show-date {
    font-size: 12px;
    color: #64748b;
}

.type-badge {
    margin-left: auto;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge-inquiry { background: #dbeafe; color: #1e40af; }
.badge-story { background: #d1fae5; color: #065f46; }
.badge-travel_story { background: #e0f2fe; color: #155e75; }
.badge-review { background: #fef3c7; color: #92400e; }
.badge-advice { background: #ede9fe; color: #5b21b6; }
.badge-other { background: #f1f5f9; color: #334155; }

.owner-actions {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
}

.btn-edit,
.btn-delete {
    border-radius: 999px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 700;
}

.btn-edit {
    border: 1px solid #93c5fd;
    background: #eff6ff;
    color: #1d4ed8;
    text-decoration: none;
}

.btn-delete {
    border: 1px solid #fda4af;
    background: #fff1f2;
    color: #be123c;
    cursor: pointer;
}

h1.show-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.9rem, 3vw, 2.7rem);
    font-weight: 800;
    line-height: 1.2;
    margin: 0 0 20px;
    color: #0f172a;
}

.show-image {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    border-radius: 18px;
    margin-bottom: 20px;
}

.show-images-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    margin-bottom: 20px;
}

.show-images-grid .show-image {
    margin-bottom: 0;
    height: 260px;
    max-height: 260px;
}

.show-body {
    font-size: 16px;
    line-height: 1.85;
    color: #1e293b;
    white-space: pre-line;
    margin-bottom: 8px;
}

.reactions-bar {
    margin: 26px 0;
    padding: 14px 0;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.reaction-wrapper { position: relative; display: inline-block; }
.reaction-wrapper::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 100%;
    width: 100%;
    height: 14px;
}

.react-main-btn {
    padding: 8px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    background: #f8fafc;
    font-size: 14px;
    font-weight: 700;
    color: #334155;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.react-main-btn.active {
    background: #1d4ed8;
    border-color: #1d4ed8;
    color: #ffffff;
}

.reaction-picker {
    position: absolute;
    left: 0;
    bottom: calc(100% + 10px);
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    padding: 6px 8px;
    display: flex;
    gap: 4px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.14);
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: all .2s;
    z-index: 60;
    pointer-events: none;
}

.reaction-wrapper:hover .reaction-picker {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.reaction-picker form { margin: 0; }

.reaction-emoji {
    background: transparent;
    border: none;
    font-size: 21px;
    cursor: pointer;
    padding: 3px 6px;
    border-radius: 10px;
}

.reaction-emoji:hover {
    background: #f1f5f9;
    transform: scale(1.15);
}

.counts-row {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 13px;
    color: #475569;
}

.comments-section {
    margin-top: 34px;
}

.comments-section h2 {
    margin: 0 0 18px;
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
}

.comment-item {
    display: flex;
    gap: 12px;
    margin-bottom: 14px;
}

.comment-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: #ffffff;
    flex-shrink: 0;
}

.comment-bubble {
    flex: 1;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 14px;
}

.comment-author {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
}

.comment-body {
    margin-top: 4px;
    color: #334155;
    font-size: 14px;
    line-height: 1.7;
    white-space: pre-line;
}

.comment-footer {
    margin-top: 8px;
    display: flex;
    gap: 12px;
    align-items: center;
    color: #94a3b8;
    font-size: 12px;
}

.comment-delete-btn {
    border: none;
    background: none;
    color: #dc2626;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    padding: 0;
}

.comment-form-wrap {
    margin-top: 20px;
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    background: #f8fafc;
}

.comment-form-wrap h3 {
    margin: 0 0 10px;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
}

.comment-form-wrap textarea {
    width: 100%;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    min-height: 110px;
    padding: 11px 13px;
    font-size: 14px;
    font-family: 'Montserrat', sans-serif;
    resize: vertical;
}

.comment-form-wrap textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
}

.comment-form-wrap button {
    margin-top: 10px;
    border: none;
    border-radius: 999px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    cursor: pointer;
}

.empty-comments {
    color: #64748b;
    margin: 0;
    font-size: 14px;
}

@media (max-width: 768px) {
    .post-show-panel {
        padding: 18px;
        border-radius: 18px;
    }

    .show-meta {
        flex-wrap: wrap;
    }

    .type-badge {
        margin-left: 0;
    }

    .owner-actions {
        flex-wrap: wrap;
    }
}
</style>
{% endblock %}

{% block body %}
{% set typeKey = (post.type ?? 'other')|lower %}
{% set badgeClass = typeKey in ['inquiry', 'story', 'travel_story', 'review', 'advice'] ? typeKey : 'other' %}
<div class=\"post-show-shell\">
    <div class=\"post-show-panel\">

        <a href=\"{{ path('blog') }}\" class=\"back-link\">← Back to Blog</a>

    {# Flash #}
        {% for msg in app.flashes('success') %}<div class=\"flash-success\">{{ msg }}</div>{% endfor %}
        {% for msg in app.flashes('error') %}<div class=\"flash-error\">{{ msg }}</div>{% endfor %}

    {# ── Post header ── #}
    {% set authorName = authors[post.userId] ?? 'Anonymous' %}
    <div class=\"show-meta\">
        <div class=\"avatar-lg\">{{ authorName|first|upper }}</div>
        <div>
            <div class=\"show-author\">{{ authorName }}</div>
            {% if post.createdAt %}
                <div class=\"show-date\">{{ post.createdAt|date('d M Y · H:i') }}</div>
            {% endif %}
        </div>
        <span class=\"type-badge badge-{{ badgeClass }}\">{{ typeKey|replace({'_': ' '})|capitalize }}</span>
    </div>

    {# Owner controls #}
    {% set isOwner = (app.user is not null and app.user.id == post.userId) %}
    {% if isOwner %}
        <div class=\"owner-actions\">
            <a href=\"{{ path('post_edit', {id: post.id}) }}\" class=\"btn-edit\">Edit</a>
            <form method=\"post\" action=\"{{ path('post_delete', {id: post.id}) }}\"
                  onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_post_' ~ post.id) }}\">
                <button type=\"submit\" class=\"btn-delete\">Delete</button>
            </form>
        </div>
    {% endif %}

    <h1 class=\"show-title\">{{ post.title }}</h1>

    {% if post.imageUrl %}
        {% set imageUrls = post.imageUrl|split(',') %}
        {% if imageUrls|length > 1 %}
            <div class=\"show-images-grid\">
                {% for img in imageUrls %}
                    {% set cleanImg = img|trim %}
                    {% if cleanImg is not empty %}
                        <img src=\"{{ cleanImg }}\" class=\"show-image\" alt=\"{{ post.title }} image {{ loop.index }}\">
                    {% endif %}
                {% endfor %}
            </div>
        {% else %}
            <img src=\"{{ imageUrls[0]|trim }}\" class=\"show-image\" alt=\"{{ post.title }}\">
        {% endif %}
    {% endif %}

    <div class=\"show-body\">{{ post.body }}</div>

    {# ── Reactions ── #}
    <div class=\"reactions-bar\">
        {% set icons = {like:'👍',love:'❤️',haha:'😂',wow:'😮',sad:'😢',angry:'😡'} %}
        <div class=\"reaction-wrapper\">
            <button type=\"button\" class=\"react-main-btn {% if userReaction %}active{% endif %}\">
                {% if userReaction and icons[userReaction] is defined %}
                    {{ icons[userReaction] }} {{ userReaction|capitalize }}
                {% else %}
                    🙂 React
                {% endif %}
            </button>
            <div class=\"reaction-picker\">
                {% for rtype, emoji in icons %}
                    <form method=\"post\" action=\"{{ path('post_react', {id: post.id, type: rtype}) }}\">
                        <button type=\"submit\" class=\"reaction-emoji\" aria-label=\"React {{ rtype|capitalize }}\" title=\"{{ rtype|capitalize }}\">{{ emoji }}</button>
                    </form>
                {% endfor %}
            </div>
        </div>
        <div class=\"counts-row\">
            {% for rtype, emoji in icons %}
                {% if reactionMap[rtype] is defined and reactionMap[rtype] > 0 %}
                    <span>{{ emoji }} {{ reactionMap[rtype] }}</span>
                {% endif %}
            {% endfor %}
        </div>
    </div>

    {# ── Comments ── #}
    <div class=\"comments-section\">
        <h2>Comments ({{ post.comments|length }})</h2>

        {% if post.comments|length > 0 %}
            {% for comment in post.comments %}
                {% set cAuthor = authors[comment.userId] ?? 'User #' ~ comment.userId %}
                <div class=\"comment-item\">
                    <div class=\"comment-avatar\">{{ cAuthor|first|upper }}</div>
                    <div class=\"comment-bubble\">
                        <div class=\"comment-author\">{{ cAuthor }}</div>
                        <div class=\"comment-body\">{{ comment.body }}</div>
                        <div class=\"comment-footer\">
                            {% if comment.createdAt %}
                                <span>{{ comment.createdAt|date('d M Y H:i') }}</span>
                            {% endif %}
                            {# Delete own comment #}
                            {% if app.user is not null and app.user.id == comment.userId %}
                                <form method=\"post\" action=\"{{ path('comment_delete', {id: comment.id}) }}\"
                                      onsubmit=\"return confirm('Delete this comment?');\" style=\"margin:0;\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"{{ csrf_token('delete_comment_' ~ comment.id) }}\">
                                    <button type=\"submit\" class=\"comment-delete-btn\">
                                        Delete
                                    </button>
                                </form>
                            {% endif %}
                        </div>
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <p class=\"empty-comments\">No comments yet. Be the first to comment.</p>
        {% endif %}

        {# ── Add comment form ── #}
        <div class=\"comment-form-wrap\">
            <h3>Leave a comment</h3>
            <form method=\"post\" action=\"{{ path('comment_create', {id: post.id}) }}\">
                <textarea name=\"body\" placeholder=\"Share your thoughts…\" required></textarea>
                <br>
                <button type=\"submit\">Post Comment</button>
            </form>
        </div>
    </div>

    </div>
</div>
{% endblock %}
", "front/blog/show.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\blog\\show.html.twig");
    }
}
