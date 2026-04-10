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

/* front/blog/edit_post.html.twig */
class __TwigTemplate_2e2b029764eab70abaf56b2e59e0d988 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/edit_post.html.twig"));

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

        yield "Edit Post — TripX";
        
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
.edit-wrap        { max-width: 780px; margin: 40px auto; padding: 0 16px 60px; }
.back-link        { color:#2563eb; text-decoration:none; font-size:14px; font-weight:600;
                     display:inline-flex; align-items:center; gap:6px; margin-bottom:24px; }
.form-card        { background:#fff; border:1px solid #e5e7eb; border-radius:18px;
                     padding:32px; box-shadow:0 2px 12px rgba(0,0,0,.05); }
.form-card h1     { font-size:26px; font-weight:900; margin:0 0 24px; }
.form-card label  { display:block; font-weight:700; font-size:14px; margin-bottom:6px; color:#333; }
.form-card input,
.form-card textarea,
.form-card select { width:100%; padding:11px 14px; border:1px solid #ddd; border-radius:12px;
                     font-size:14px; margin-bottom:18px; background:#fafafa; }
.form-card textarea { min-height:160px; resize:vertical; }
.pending-note     { background:#fef3c7; color:#92400e; padding:10px 14px; border-radius:10px;
                     font-size:13px; margin-bottom:20px; }
.actions-row      { display:flex; gap:12px; align-items:center; margin-top:8px; }
.btn-primary      { padding:11px 24px; background:#2563eb; color:#fff; border:none;
                     border-radius:50px; font-weight:700; cursor:pointer; font-size:15px; }
.btn-secondary    { text-decoration:none; color:#666; font-weight:600; font-size:14px; }
</style>

<div class=\"edit-wrap\">
    <a href=\"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"back-link\">← Back to Blog</a>

    <div class=\"form-card\">
        <h1>✏️ Edit Post</h1>

        <div class=\"pending-note\">
            ⚠️ After editing, your post will be re-submitted for admin approval before it reappears publicly.
        </div>

        ";
        // line 36
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        yield "
            ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), 'errors');
        yield "
            ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "title", [], "any", false, false, false, 38), 'row');
        yield "
            ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "body", [], "any", false, false, false, 39), 'row');
        yield "
            ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "type", [], "any", false, false, false, 40), 'row');
        yield "
            ";
        // line 41
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "image_url", [], "any", false, false, false, 41), 'row');
        yield "

            <div class=\"actions-row\">
                <button type=\"submit\" class=\"btn-primary\">Save Changes</button>
                <a href=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 45, $this->source); })()), "id", [], "any", false, false, false, 45)]), "html", null, true);
        yield "\" class=\"btn-secondary\">Cancel</a>
            </div>
        ";
        // line 47
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 47, $this->source); })()), 'form_end');
        yield "
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
        return "front/blog/edit_post.html.twig";
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
        return array (  153 => 47,  148 => 45,  141 => 41,  137 => 40,  133 => 39,  129 => 38,  125 => 37,  121 => 36,  109 => 27,  85 => 5,  75 => 4,  58 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Edit Post — TripX{% endblock %}

{% block body %}
<style>
.edit-wrap        { max-width: 780px; margin: 40px auto; padding: 0 16px 60px; }
.back-link        { color:#2563eb; text-decoration:none; font-size:14px; font-weight:600;
                     display:inline-flex; align-items:center; gap:6px; margin-bottom:24px; }
.form-card        { background:#fff; border:1px solid #e5e7eb; border-radius:18px;
                     padding:32px; box-shadow:0 2px 12px rgba(0,0,0,.05); }
.form-card h1     { font-size:26px; font-weight:900; margin:0 0 24px; }
.form-card label  { display:block; font-weight:700; font-size:14px; margin-bottom:6px; color:#333; }
.form-card input,
.form-card textarea,
.form-card select { width:100%; padding:11px 14px; border:1px solid #ddd; border-radius:12px;
                     font-size:14px; margin-bottom:18px; background:#fafafa; }
.form-card textarea { min-height:160px; resize:vertical; }
.pending-note     { background:#fef3c7; color:#92400e; padding:10px 14px; border-radius:10px;
                     font-size:13px; margin-bottom:20px; }
.actions-row      { display:flex; gap:12px; align-items:center; margin-top:8px; }
.btn-primary      { padding:11px 24px; background:#2563eb; color:#fff; border:none;
                     border-radius:50px; font-weight:700; cursor:pointer; font-size:15px; }
.btn-secondary    { text-decoration:none; color:#666; font-weight:600; font-size:14px; }
</style>

<div class=\"edit-wrap\">
    <a href=\"{{ path('blog') }}\" class=\"back-link\">← Back to Blog</a>

    <div class=\"form-card\">
        <h1>✏️ Edit Post</h1>

        <div class=\"pending-note\">
            ⚠️ After editing, your post will be re-submitted for admin approval before it reappears publicly.
        </div>

        {{ form_start(form, {'attr': {'novalidate': 'novalidate'}}) }}
            {{ form_errors(form) }}
            {{ form_row(form.title) }}
            {{ form_row(form.body) }}
            {{ form_row(form.type) }}
            {{ form_row(form.image_url) }}

            <div class=\"actions-row\">
                <button type=\"submit\" class=\"btn-primary\">Save Changes</button>
                <a href=\"{{ path('post_show', {id: post.id}) }}\" class=\"btn-secondary\">Cancel</a>
            </div>
        {{ form_end(form) }}
    </div>
</div>
{% endblock %}
", "front/blog/edit_post.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\edit_post.html.twig");
    }
}
