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

/* front/blog/saved_posts.html.twig */
class __TwigTemplate_6808843f64a18132316d1a0eebfa9a3d extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/saved_posts.html.twig"));

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

        yield "Saved Posts — TripX";
        
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
.saved-wrap     { max-width:820px; margin:40px auto; padding:0 16px; }
.saved-header   { margin-bottom:28px; }
.saved-header h1 { font-size:28px; font-weight:900; margin:0 0 6px; }
.saved-header p  { color:#666; margin:0; }
.post-card      { background:#fff; border:1px solid #e5e7eb; border-radius:16px;
                   padding:20px 22px; margin-bottom:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); }
.post-title     { font-size:18px; font-weight:800; color:#111; text-decoration:none; display:block; margin-bottom:6px; }
.post-title:hover { color:#2563eb; }
.post-meta      { font-size:13px; color:#888; }
.type-badge     { display:inline-block; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700; margin-left:8px; }
.badge-inquiry  { background:#dbeafe; color:#1d4ed8; }
.badge-story    { background:#d1fae5; color:#065f46; }
.badge-review   { background:#fef3c7; color:#92400e; }
.badge-advice   { background:#ede9fe; color:#5b21b6; }
.badge-other    { background:#f3f4f6; color:#374151; }
.post-body      { font-size:14px; color:#555; line-height:1.6; margin-top:10px;
                   display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.unsave-btn     { margin-top:12px; padding:7px 14px; border:1px solid #fca5a5; background:#fff1f2;
                   color:#dc2626; border-radius:50px; font-size:13px; font-weight:700; cursor:pointer; }
.back-link      { color:#2563eb; text-decoration:none; font-size:14px; font-weight:600; margin-bottom:20px; display:inline-block; }
.empty-state    { text-align:center; padding:60px 0; color:#aaa; }
</style>

<div class=\"saved-wrap\">
    <a href=\"";
        // line 30
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"back-link\">← Back to Blog</a>

    <div class=\"saved-header\">
        <h1>🔖 Saved Posts</h1>
        <p>Posts you've bookmarked for later.</p>
    </div>

    ";
        // line 37
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 37, $this->source); })()))) {
            // line 38
            yield "        <div class=\"empty-state\">
            <p style=\"font-size:48px;\">🔖</p>
            <p style=\"font-size:18px; font-weight:700;\">No saved posts yet.</p>
            <a href=\"";
            // line 41
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
            yield "\" style=\"color:#2563eb;\">Browse the blog</a>
        </div>
    ";
        } else {
            // line 44
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 44, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 45
                yield "            <div class=\"post-card\">
                <div>
                    <a href=\"";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 47)]), "html", null, true);
                yield "\" class=\"post-title\">
                        ";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 48), "html", null, true);
                yield "
                        <span class=\"type-badge badge-";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "type", [], "any", false, false, false, 49), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "type", [], "any", false, false, false, 49), "html", null, true);
                yield "</span>
                    </a>
                    <div class=\"post-meta\">
                        ";
                // line 52
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 52), "d M Y"), "html", null, true);
                }
                // line 53
                yield "                    </div>
                    <div class=\"post-body\">";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "body", [], "any", false, false, false, 54), "html", null, true);
                yield "</div>
                </div>
                <form method=\"post\" action=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_save_toggle", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                yield "\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("save_post_" . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 57))), "html", null, true);
                yield "\">
                    <button type=\"submit\" class=\"unsave-btn\">🗑 Remove from saved</button>
                </form>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['post'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            yield "    ";
        }
        // line 63
        yield "</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/blog/saved_posts.html.twig";
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
        return array (  190 => 63,  187 => 62,  176 => 57,  172 => 56,  167 => 54,  164 => 53,  160 => 52,  152 => 49,  148 => 48,  144 => 47,  140 => 45,  135 => 44,  129 => 41,  124 => 38,  122 => 37,  112 => 30,  85 => 5,  75 => 4,  58 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Saved Posts — TripX{% endblock %}

{% block body %}
<style>
.saved-wrap     { max-width:820px; margin:40px auto; padding:0 16px; }
.saved-header   { margin-bottom:28px; }
.saved-header h1 { font-size:28px; font-weight:900; margin:0 0 6px; }
.saved-header p  { color:#666; margin:0; }
.post-card      { background:#fff; border:1px solid #e5e7eb; border-radius:16px;
                   padding:20px 22px; margin-bottom:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); }
.post-title     { font-size:18px; font-weight:800; color:#111; text-decoration:none; display:block; margin-bottom:6px; }
.post-title:hover { color:#2563eb; }
.post-meta      { font-size:13px; color:#888; }
.type-badge     { display:inline-block; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700; margin-left:8px; }
.badge-inquiry  { background:#dbeafe; color:#1d4ed8; }
.badge-story    { background:#d1fae5; color:#065f46; }
.badge-review   { background:#fef3c7; color:#92400e; }
.badge-advice   { background:#ede9fe; color:#5b21b6; }
.badge-other    { background:#f3f4f6; color:#374151; }
.post-body      { font-size:14px; color:#555; line-height:1.6; margin-top:10px;
                   display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.unsave-btn     { margin-top:12px; padding:7px 14px; border:1px solid #fca5a5; background:#fff1f2;
                   color:#dc2626; border-radius:50px; font-size:13px; font-weight:700; cursor:pointer; }
.back-link      { color:#2563eb; text-decoration:none; font-size:14px; font-weight:600; margin-bottom:20px; display:inline-block; }
.empty-state    { text-align:center; padding:60px 0; color:#aaa; }
</style>

<div class=\"saved-wrap\">
    <a href=\"{{ path('blog') }}\" class=\"back-link\">← Back to Blog</a>

    <div class=\"saved-header\">
        <h1>🔖 Saved Posts</h1>
        <p>Posts you've bookmarked for later.</p>
    </div>

    {% if posts is empty %}
        <div class=\"empty-state\">
            <p style=\"font-size:48px;\">🔖</p>
            <p style=\"font-size:18px; font-weight:700;\">No saved posts yet.</p>
            <a href=\"{{ path('blog') }}\" style=\"color:#2563eb;\">Browse the blog</a>
        </div>
    {% else %}
        {% for post in posts %}
            <div class=\"post-card\">
                <div>
                    <a href=\"{{ path('post_show', {id: post.id}) }}\" class=\"post-title\">
                        {{ post.title }}
                        <span class=\"type-badge badge-{{ post.type }}\">{{ post.type }}</span>
                    </a>
                    <div class=\"post-meta\">
                        {% if post.createdAt %}{{ post.createdAt|date('d M Y') }}{% endif %}
                    </div>
                    <div class=\"post-body\">{{ post.body }}</div>
                </div>
                <form method=\"post\" action=\"{{ path('post_save_toggle', {id: post.id}) }}\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('save_post_' ~ post.id) }}\">
                    <button type=\"submit\" class=\"unsave-btn\">🗑 Remove from saved</button>
                </form>
            </div>
        {% endfor %}
    {% endif %}
</div>
{% endblock %}
", "front/blog/saved_posts.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\front\\blog\\saved_posts.html.twig");
    }
}
