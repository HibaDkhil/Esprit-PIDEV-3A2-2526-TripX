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
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 5
        yield "<style>
.show-wrap        { max-width: 780px; margin: 40px auto; padding: 0 16px 60px; }
.back-link        { color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 600;
                     display: inline-flex; align-items: center; gap: 6px; margin-bottom: 24px; }
.back-link:hover  { text-decoration: underline; }

/* ── Post header ── */
.show-meta        { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
.avatar-lg        { width: 50px; height: 50px; border-radius: 50%;
                     background: linear-gradient(135deg,#2563eb,#7c3aed);
                     display: flex; align-items: center; justify-content: center;
                     font-size: 20px; font-weight: 800; color: #fff; flex-shrink: 0; }
.show-author      { font-weight: 700; font-size: 16px; color: #111; }
.show-date        { font-size: 13px; color: #888; }
.type-badge       { margin-left: auto; padding: 5px 12px; border-radius: 50px;
                     font-size: 12px; font-weight: 700; text-transform: uppercase; }
.badge-inquiry    { background:#dbeafe; color:#1d4ed8; }
.badge-story      { background:#d1fae5; color:#065f46; }
.badge-review     { background:#fef3c7; color:#92400e; }
.badge-advice     { background:#ede9fe; color:#5b21b6; }
.badge-other      { background:#f3f4f6; color:#374151; }

h1.show-title     { font-size: 32px; font-weight: 900; color: #111; margin: 0 0 20px; line-height: 1.25; }
.show-image       { width: 100%; max-height: 450px; object-fit: cover; border-radius: 16px; margin-bottom: 24px; }
.show-body        { font-size: 16px; line-height: 1.8; color: #333; white-space: pre-line; }

/* ── Reactions ── */
.reactions-bar    { display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
                     margin: 28px 0; padding: 16px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
.reaction-wrapper { position: relative; display: inline-block; }
.reaction-wrapper::before { content:''; position:absolute; left:0; bottom:100%; width:100%; height:14px; }
.reaction-picker  { position:absolute; left:0; bottom:calc(100% + 10px); background:#fff;
                     border:1px solid #e0e0e0; border-radius:40px; padding:6px 10px;
                     display:flex; gap:4px; box-shadow:0 8px 24px rgba(0,0,0,.12);
                     opacity:0; visibility:hidden; transform:translateY(8px);
                     transition:all .2s; z-index:200; pointer-events:none; }
.reaction-wrapper:hover .reaction-picker { opacity:1; visibility:visible; transform:translateY(0); pointer-events:auto; }
.reaction-picker form { margin:0; }
.reaction-emoji   { background:transparent; border:none; font-size:22px; cursor:pointer;
                     padding:3px 5px; transition:transform .15s; }
.reaction-emoji:hover { transform: scale(1.35); }
.react-main-btn   { padding:9px 18px; border:1px solid #ddd; border-radius:50px; background:#f9f9f9;
                     font-size:15px; font-weight:700; color:#333; cursor:pointer;
                     display:inline-flex; align-items:center; gap:7px; }
.react-main-btn.active { background:#2563eb; border-color:#2563eb; color:#fff; }
.counts-row       { display:inline-flex; gap:8px; flex-wrap:wrap; font-size:14px; color:#666; }

/* ── Owner actions ── */
.owner-actions    { display:flex; gap:10px; margin-bottom:24px; }
.btn-edit         { padding:9px 18px; border:1px solid #93c5fd; background:#eff6ff; color:#1d4ed8;
                     border-radius:50px; font-weight:700; font-size:14px; text-decoration:none; }
.btn-delete       { padding:9px 18px; border:1px solid #fca5a5; background:#fff1f2; color:#dc2626;
                     border-radius:50px; font-weight:700; font-size:14px; cursor:pointer; }

/* ── Comments ── */
.comments-section { margin-top: 40px; }
.comments-section h2 { font-size:22px; font-weight:800; margin-bottom:20px; }
.comment-item     { display:flex; gap:12px; margin-bottom:16px; }
.comment-avatar   { width:36px; height:36px; border-radius:50%;
                     background:linear-gradient(135deg,#f59e0b,#ef4444);
                     display:flex; align-items:center; justify-content:center;
                     font-size:14px; font-weight:700; color:#fff; flex-shrink:0; }
.comment-bubble   { flex:1; background:#f8f9fa; border-radius:14px; padding:12px 16px; }
.comment-author   { font-weight:700; font-size:14px; color:#111; }
.comment-body     { font-size:14px; color:#444; margin-top:4px; line-height:1.6; }
.comment-footer   { font-size:12px; color:#aaa; margin-top:6px; display:flex; gap:12px; }

/* ── Comment form ── */
.comment-form-wrap { margin-top:28px; }
.comment-form-wrap h3 { font-size:18px; font-weight:700; margin-bottom:14px; }
.comment-form-wrap textarea { width:100%; padding:12px 16px; border:1px solid #ddd;
                                border-radius:14px; font-size:14px; min-height:100px; resize:vertical; }
.comment-form-wrap button  { margin-top:10px; padding:11px 24px; background:#2563eb;
                               color:#fff; border:none; border-radius:50px; font-weight:700; cursor:pointer; }

.flash-success { background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:10px; margin-bottom:16px; }
.flash-error   { background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom:16px; }
</style>

<div class=\"show-wrap\">

    <a href=\"";
        // line 86
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"back-link\">← Back to Blog</a>

    ";
        // line 89
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 89, $this->source); })()), "flashes", ["success"], "method", false, false, false, 89));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-success\">✅ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 90
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 90, $this->source); })()), "flashes", ["error"], "method", false, false, false, 90));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-error\">❌ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        yield "
    ";
        // line 93
        yield "    ";
        $context["authorName"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["authors"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 93, $this->source); })()), "userId", [], "any", false, false, false, 93), [], "array", true, true, false, 93) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 93, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 93, $this->source); })()), "userId", [], "any", false, false, false, 93), [], "array", false, false, false, 93)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 93, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 93, $this->source); })()), "userId", [], "any", false, false, false, 93), [], "array", false, false, false, 93)) : ("Anonymous"));
        // line 94
        yield "    <div class=\"show-meta\">
        <div class=\"avatar-lg\">";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 95, $this->source); })()))), "html", null, true);
        yield "</div>
        <div>
            <div class=\"show-author\">";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["authorName"]) || array_key_exists("authorName", $context) ? $context["authorName"] : (function () { throw new RuntimeError('Variable "authorName" does not exist.', 97, $this->source); })()), "html", null, true);
        yield "</div>
            ";
        // line 98
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 98, $this->source); })()), "createdAt", [], "any", false, false, false, 98)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 99
            yield "                <div class=\"show-date\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 99, $this->source); })()), "createdAt", [], "any", false, false, false, 99), "d M Y · H:i"), "html", null, true);
            yield "</div>
            ";
        }
        // line 101
        yield "        </div>
        <span class=\"type-badge badge-";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 102, $this->source); })()), "type", [], "any", false, false, false, 102), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 102, $this->source); })()), "type", [], "any", false, false, false, 102), "html", null, true);
        yield "</span>
    </div>

    ";
        // line 106
        yield "    ";
        $context["isOwner"] = ( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 106, $this->source); })()), "user", [], "any", false, false, false, 106)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 106, $this->source); })()), "user", [], "any", false, false, false, 106), "id", [], "any", false, false, false, 106) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 106, $this->source); })()), "userId", [], "any", false, false, false, 106)));
        // line 107
        yield "    ";
        if ((($tmp = (isset($context["isOwner"]) || array_key_exists("isOwner", $context) ? $context["isOwner"] : (function () { throw new RuntimeError('Variable "isOwner" does not exist.', 107, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 108
            yield "        <div class=\"owner-actions\">
            <a href=\"";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 109, $this->source); })()), "id", [], "any", false, false, false, 109)]), "html", null, true);
            yield "\" class=\"btn-edit\">✏️ Edit</a>
            <form method=\"post\" action=\"";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 110, $this->source); })()), "id", [], "any", false, false, false, 110)]), "html", null, true);
            yield "\"
                  onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_post_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 112, $this->source); })()), "id", [], "any", false, false, false, 112))), "html", null, true);
            yield "\">
                <button type=\"submit\" class=\"btn-delete\">🗑 Delete</button>
            </form>
        </div>
    ";
        }
        // line 117
        yield "
    <h1 class=\"show-title\">";
        // line 118
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 118, $this->source); })()), "title", [], "any", false, false, false, 118), "html", null, true);
        yield "</h1>

    ";
        // line 120
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 120, $this->source); })()), "imageUrl", [], "any", false, false, false, 120)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 121
            yield "        <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 121, $this->source); })()), "imageUrl", [], "any", false, false, false, 121), "html", null, true);
            yield "\" class=\"show-image\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 121, $this->source); })()), "title", [], "any", false, false, false, 121), "html", null, true);
            yield "\">
    ";
        }
        // line 123
        yield "
    <div class=\"show-body\">";
        // line 124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 124, $this->source); })()), "body", [], "any", false, false, false, 124), "html", null, true);
        yield "</div>

    ";
        // line 127
        yield "    <div class=\"reactions-bar\">
        ";
        // line 128
        $context["icons"] = ["like" => "👍", "love" => "❤️", "haha" => "😂", "wow" => "😮", "sad" => "😢", "angry" => "😡"];
        // line 129
        yield "        <div class=\"reaction-wrapper\">
            <button type=\"button\" class=\"react-main-btn ";
        // line 130
        if ((($tmp = (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 130, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "active";
        }
        yield "\">
                ";
        // line 131
        if (((isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 131, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, ($context["icons"] ?? null), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 131, $this->source); })()), [], "array", true, true, false, 131))) {
            // line 132
            yield "                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 132, $this->source); })()), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 132, $this->source); })()), [], "array", false, false, false, 132), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), (isset($context["userReaction"]) || array_key_exists("userReaction", $context) ? $context["userReaction"] : (function () { throw new RuntimeError('Variable "userReaction" does not exist.', 132, $this->source); })())), "html", null, true);
            yield "
                ";
        } else {
            // line 134
            yield "                    🙂 React
                ";
        }
        // line 136
        yield "            </button>
            <div class=\"reaction-picker\">
                ";
        // line 138
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 138, $this->source); })()));
        foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
            // line 139
            yield "                    <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_react", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 139, $this->source); })()), "id", [], "any", false, false, false, 139), "type" => $context["rtype"]]), "html", null, true);
            yield "\">
                        <button type=\"submit\" class=\"reaction-emoji\" title=\"";
            // line 140
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
        // line 143
        yield "            </div>
        </div>
        <div class=\"counts-row\">
            ";
        // line 146
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["icons"]) || array_key_exists("icons", $context) ? $context["icons"] : (function () { throw new RuntimeError('Variable "icons" does not exist.', 146, $this->source); })()));
        foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
            // line 147
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["reactionMap"] ?? null), $context["rtype"], [], "array", true, true, false, 147) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionMap"]) || array_key_exists("reactionMap", $context) ? $context["reactionMap"] : (function () { throw new RuntimeError('Variable "reactionMap" does not exist.', 147, $this->source); })()), $context["rtype"], [], "array", false, false, false, 147) > 0))) {
                // line 148
                yield "                    <span>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionMap"]) || array_key_exists("reactionMap", $context) ? $context["reactionMap"] : (function () { throw new RuntimeError('Variable "reactionMap" does not exist.', 148, $this->source); })()), $context["rtype"], [], "array", false, false, false, 148), "html", null, true);
                yield "</span>
                ";
            }
            // line 150
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        yield "        </div>
    </div>

    ";
        // line 155
        yield "    <div class=\"comments-section\">
        <h2>💬 Comments (";
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 156, $this->source); })()), "comments", [], "any", false, false, false, 156)), "html", null, true);
        yield ")</h2>

        ";
        // line 158
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 158, $this->source); })()), "comments", [], "any", false, false, false, 158)) > 0)) {
            // line 159
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 159, $this->source); })()), "comments", [], "any", false, false, false, 159));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 160
                yield "                ";
                $context["cAuthor"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authors"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 160), [], "array", true, true, false, 160) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 160, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 160), [], "array", false, false, false, 160)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authors"]) || array_key_exists("authors", $context) ? $context["authors"] : (function () { throw new RuntimeError('Variable "authors" does not exist.', 160, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 160), [], "array", false, false, false, 160)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 160));
                // line 161
                yield "                <div class=\"comment-item\">
                    <div class=\"comment-avatar\">";
                // line 162
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["cAuthor"]) || array_key_exists("cAuthor", $context) ? $context["cAuthor"] : (function () { throw new RuntimeError('Variable "cAuthor" does not exist.', 162, $this->source); })()))), "html", null, true);
                yield "</div>
                    <div class=\"comment-bubble\">
                        <div class=\"comment-author\">";
                // line 164
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["cAuthor"]) || array_key_exists("cAuthor", $context) ? $context["cAuthor"] : (function () { throw new RuntimeError('Variable "cAuthor" does not exist.', 164, $this->source); })()), "html", null, true);
                yield "</div>
                        <div class=\"comment-body\">";
                // line 165
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 165), "html", null, true);
                yield "</div>
                        <div class=\"comment-footer\">
                            ";
                // line 167
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 167)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 168
                    yield "                                <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 168), "d M Y H:i"), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 170
                yield "                            ";
                // line 171
                yield "                            ";
                if (( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 171, $this->source); })()), "user", [], "any", false, false, false, 171)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 171, $this->source); })()), "user", [], "any", false, false, false, 171), "id", [], "any", false, false, false, 171) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 171)))) {
                    // line 172
                    yield "                                <form method=\"post\" action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 172)]), "html", null, true);
                    yield "\"
                                      onsubmit=\"return confirm('Delete this comment?');\" style=\"margin:0;\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"";
                    // line 175
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 175))), "html", null, true);
                    yield "\">
                                    <button type=\"submit\"
                                            style=\"background:none;border:none;color:#dc2626;font-size:12px;cursor:pointer;padding:0;\">
                                        Delete
                                    </button>
                                </form>
                            ";
                }
                // line 182
                yield "                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 186
            yield "        ";
        } else {
            // line 187
            yield "            <p style=\"color:#aaa;\">No comments yet. Be the first to comment!</p>
        ";
        }
        // line 189
        yield "
        ";
        // line 191
        yield "        <div class=\"comment-form-wrap\">
            <h3>Leave a comment</h3>
            <form method=\"post\" action=\"";
        // line 193
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 193, $this->source); })()), "id", [], "any", false, false, false, 193)]), "html", null, true);
        yield "\">
                <textarea name=\"body\" placeholder=\"Share your thoughts…\" required></textarea>
                <br>
                <button type=\"submit\">Post Comment</button>
            </form>
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
        return array (  458 => 193,  454 => 191,  451 => 189,  447 => 187,  444 => 186,  435 => 182,  425 => 175,  418 => 172,  415 => 171,  413 => 170,  407 => 168,  405 => 167,  400 => 165,  396 => 164,  391 => 162,  388 => 161,  385 => 160,  380 => 159,  378 => 158,  373 => 156,  370 => 155,  365 => 151,  359 => 150,  351 => 148,  348 => 147,  344 => 146,  339 => 143,  328 => 140,  323 => 139,  319 => 138,  315 => 136,  311 => 134,  303 => 132,  301 => 131,  295 => 130,  292 => 129,  290 => 128,  287 => 127,  282 => 124,  279 => 123,  271 => 121,  269 => 120,  264 => 118,  261 => 117,  253 => 112,  248 => 110,  244 => 109,  241 => 108,  238 => 107,  235 => 106,  227 => 102,  224 => 101,  218 => 99,  216 => 98,  212 => 97,  207 => 95,  204 => 94,  201 => 93,  198 => 91,  186 => 90,  174 => 89,  169 => 86,  86 => 5,  76 => 4,  58 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}{{ post.title }} — TripX Blog{% endblock %}

{% block body %}
<style>
.show-wrap        { max-width: 780px; margin: 40px auto; padding: 0 16px 60px; }
.back-link        { color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 600;
                     display: inline-flex; align-items: center; gap: 6px; margin-bottom: 24px; }
.back-link:hover  { text-decoration: underline; }

/* ── Post header ── */
.show-meta        { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
.avatar-lg        { width: 50px; height: 50px; border-radius: 50%;
                     background: linear-gradient(135deg,#2563eb,#7c3aed);
                     display: flex; align-items: center; justify-content: center;
                     font-size: 20px; font-weight: 800; color: #fff; flex-shrink: 0; }
.show-author      { font-weight: 700; font-size: 16px; color: #111; }
.show-date        { font-size: 13px; color: #888; }
.type-badge       { margin-left: auto; padding: 5px 12px; border-radius: 50px;
                     font-size: 12px; font-weight: 700; text-transform: uppercase; }
.badge-inquiry    { background:#dbeafe; color:#1d4ed8; }
.badge-story      { background:#d1fae5; color:#065f46; }
.badge-review     { background:#fef3c7; color:#92400e; }
.badge-advice     { background:#ede9fe; color:#5b21b6; }
.badge-other      { background:#f3f4f6; color:#374151; }

h1.show-title     { font-size: 32px; font-weight: 900; color: #111; margin: 0 0 20px; line-height: 1.25; }
.show-image       { width: 100%; max-height: 450px; object-fit: cover; border-radius: 16px; margin-bottom: 24px; }
.show-body        { font-size: 16px; line-height: 1.8; color: #333; white-space: pre-line; }

/* ── Reactions ── */
.reactions-bar    { display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
                     margin: 28px 0; padding: 16px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
.reaction-wrapper { position: relative; display: inline-block; }
.reaction-wrapper::before { content:''; position:absolute; left:0; bottom:100%; width:100%; height:14px; }
.reaction-picker  { position:absolute; left:0; bottom:calc(100% + 10px); background:#fff;
                     border:1px solid #e0e0e0; border-radius:40px; padding:6px 10px;
                     display:flex; gap:4px; box-shadow:0 8px 24px rgba(0,0,0,.12);
                     opacity:0; visibility:hidden; transform:translateY(8px);
                     transition:all .2s; z-index:200; pointer-events:none; }
.reaction-wrapper:hover .reaction-picker { opacity:1; visibility:visible; transform:translateY(0); pointer-events:auto; }
.reaction-picker form { margin:0; }
.reaction-emoji   { background:transparent; border:none; font-size:22px; cursor:pointer;
                     padding:3px 5px; transition:transform .15s; }
.reaction-emoji:hover { transform: scale(1.35); }
.react-main-btn   { padding:9px 18px; border:1px solid #ddd; border-radius:50px; background:#f9f9f9;
                     font-size:15px; font-weight:700; color:#333; cursor:pointer;
                     display:inline-flex; align-items:center; gap:7px; }
.react-main-btn.active { background:#2563eb; border-color:#2563eb; color:#fff; }
.counts-row       { display:inline-flex; gap:8px; flex-wrap:wrap; font-size:14px; color:#666; }

/* ── Owner actions ── */
.owner-actions    { display:flex; gap:10px; margin-bottom:24px; }
.btn-edit         { padding:9px 18px; border:1px solid #93c5fd; background:#eff6ff; color:#1d4ed8;
                     border-radius:50px; font-weight:700; font-size:14px; text-decoration:none; }
.btn-delete       { padding:9px 18px; border:1px solid #fca5a5; background:#fff1f2; color:#dc2626;
                     border-radius:50px; font-weight:700; font-size:14px; cursor:pointer; }

/* ── Comments ── */
.comments-section { margin-top: 40px; }
.comments-section h2 { font-size:22px; font-weight:800; margin-bottom:20px; }
.comment-item     { display:flex; gap:12px; margin-bottom:16px; }
.comment-avatar   { width:36px; height:36px; border-radius:50%;
                     background:linear-gradient(135deg,#f59e0b,#ef4444);
                     display:flex; align-items:center; justify-content:center;
                     font-size:14px; font-weight:700; color:#fff; flex-shrink:0; }
.comment-bubble   { flex:1; background:#f8f9fa; border-radius:14px; padding:12px 16px; }
.comment-author   { font-weight:700; font-size:14px; color:#111; }
.comment-body     { font-size:14px; color:#444; margin-top:4px; line-height:1.6; }
.comment-footer   { font-size:12px; color:#aaa; margin-top:6px; display:flex; gap:12px; }

/* ── Comment form ── */
.comment-form-wrap { margin-top:28px; }
.comment-form-wrap h3 { font-size:18px; font-weight:700; margin-bottom:14px; }
.comment-form-wrap textarea { width:100%; padding:12px 16px; border:1px solid #ddd;
                                border-radius:14px; font-size:14px; min-height:100px; resize:vertical; }
.comment-form-wrap button  { margin-top:10px; padding:11px 24px; background:#2563eb;
                               color:#fff; border:none; border-radius:50px; font-weight:700; cursor:pointer; }

.flash-success { background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:10px; margin-bottom:16px; }
.flash-error   { background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:10px; margin-bottom:16px; }
</style>

<div class=\"show-wrap\">

    <a href=\"{{ path('blog') }}\" class=\"back-link\">← Back to Blog</a>

    {# Flash #}
    {% for msg in app.flashes('success') %}<div class=\"flash-success\">✅ {{ msg }}</div>{% endfor %}
    {% for msg in app.flashes('error') %}<div class=\"flash-error\">❌ {{ msg }}</div>{% endfor %}

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
        <span class=\"type-badge badge-{{ post.type }}\">{{ post.type }}</span>
    </div>

    {# Owner controls #}
    {% set isOwner = (app.user is not null and app.user.id == post.userId) %}
    {% if isOwner %}
        <div class=\"owner-actions\">
            <a href=\"{{ path('post_edit', {id: post.id}) }}\" class=\"btn-edit\">✏️ Edit</a>
            <form method=\"post\" action=\"{{ path('post_delete', {id: post.id}) }}\"
                  onsubmit=\"return confirm('Delete this post?');\">
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_post_' ~ post.id) }}\">
                <button type=\"submit\" class=\"btn-delete\">🗑 Delete</button>
            </form>
        </div>
    {% endif %}

    <h1 class=\"show-title\">{{ post.title }}</h1>

    {% if post.imageUrl %}
        <img src=\"{{ post.imageUrl }}\" class=\"show-image\" alt=\"{{ post.title }}\">
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
                        <button type=\"submit\" class=\"reaction-emoji\" title=\"{{ rtype|capitalize }}\">{{ emoji }}</button>
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
        <h2>💬 Comments ({{ post.comments|length }})</h2>

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
                                    <button type=\"submit\"
                                            style=\"background:none;border:none;color:#dc2626;font-size:12px;cursor:pointer;padding:0;\">
                                        Delete
                                    </button>
                                </form>
                            {% endif %}
                        </div>
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <p style=\"color:#aaa;\">No comments yet. Be the first to comment!</p>
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
{% endblock %}
", "front/blog/show.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\show.html.twig");
    }
}
