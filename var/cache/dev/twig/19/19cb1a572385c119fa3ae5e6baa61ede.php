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

/* front/login.html.twig */
class __TwigTemplate_e7f5cfccdd60e77b2a2e28688b0c4809 extends Template
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
            'extra_js' => [$this, 'block_extra_js'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "front/base_auth.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/login.html.twig"));

        $this->parent = $this->load("front/base_auth.html.twig", 1);
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

        yield "Login";
        
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
        yield "<div id=\"app\">
  <div class=\"auth-card\" id=\"authCard\">

    ";
        // line 9
        yield "    <div class=\"auth-forms\">

      ";
        // line 12
        yield "      <div class=\"form-panel panel-login\" id=\"panelLogin\">
        <div class=\"form-title\">Welcome back <span class=\"sparkle\">✦</span></div>
        <div class=\"form-sub\">Sign in and pick up where you left off</div>

        <div class=\"social-row\">
          <a href=\"#\" class=\"social-btn social-btn--circle\">
            <img src=\"https://www.svgrepo.com/show/475656/google-color.svg\" alt=\"G\"/>
          </a>
          <a href=\"#\" class=\"social-btn social-btn--circle\">
            <i class=\"fab fa-linkedin\" style=\"color:#0a66c2; font-size: 1.5rem;\"></i>
          </a>
        </div>

        <div class=\"divider\"><span>or continue with email</span></div>

        ";
        // line 27
        $context["error_flashes"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 27, $this->source); })()), "flashes", ["error"], "method", false, false, false, 27);
        // line 28
        yield "        ";
        $context["success_flashes"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "flashes", ["success"], "method", false, false, false, 28);
        // line 29
        yield "        ";
        // line 30
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["error_flashes"]) || array_key_exists("error_flashes", $context) ? $context["error_flashes"] : (function () { throw new RuntimeError('Variable "error_flashes" does not exist.', 30, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 31
            yield "          <div class=\"alert alert-error\"><i class=\"fas fa-exclamation-circle\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["success_flashes"]) || array_key_exists("success_flashes", $context) ? $context["success_flashes"] : (function () { throw new RuntimeError('Variable "success_flashes" does not exist.', 33, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 34
            yield "          <div class=\"alert alert-success\"><i class=\"fas fa-check-circle\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "
        ";
        // line 38
        yield "        ";
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 38, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 39
            yield "          <div class=\"alert alert-error\">
            <i class=\"fas fa-exclamation-circle\"></i> ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 40, $this->source); })()), "messageKey", [], "any", false, false, false, 40), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 40, $this->source); })()), "messageData", [], "any", false, false, false, 40), "security"), "html", null, true);
            yield "
          </div>
        ";
        }
        // line 43
        yield "
        <form method=\"POST\" action=\"";
        // line 44
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" id=\"loginForm\">
          <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\"/>

          <div class=\"form-control ";
        // line 47
        yield (((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 47, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"email\" id=\"login_email\" name=\"_username\"
                   value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 49, $this->source); })()), "html", null, true);
        yield "\"
                   autocomplete=\"email\" required/>
            <label for=\"login_email\">
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control ";
        // line 57
        yield (((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 57, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"password\" id=\"login_password\" name=\"_password\"
                   autocomplete=\"current-password\" required/>
            <label for=\"login_password\">
              <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
            </label>
            <span class=\"field-icon toggle-pw\" data-target=\"login_password\">
              <i class=\"far fa-eye\"></i>
            </span>
          </div>

          <div class=\"forgot\">
            <a href=\"#\">Forgot password?</a>
          </div>

          <div class=\"btn-row\">
            <button type=\"button\" class=\"btn-secondary\" id=\"goSignup\">Create account</button>
            <button type=\"submit\" class=\"btn-primary\">Login</button>
          </div>
        </form>
      </div>

      ";
        // line 80
        yield "<div class=\"form-panel panel-signup\" id=\"panelSignup\">
    <div class=\"form-title\">Join TripX <span class=\"sparkle\">✈</span></div>
    <div class=\"form-sub\">Create your account — it only takes a minute</div>

    ";
        // line 84
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 84, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register"), "method" => "POST", "attr" => ["id" => "signupForm", "novalidate" => "novalidate"]]);
        yield "

    ";
        // line 87
        yield "    <div class=\"name-row\">
        <div class=\"form-control ";
        // line 88
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "firstName", [], "any", false, true, false, 88), "vars", [], "any", false, true, false, 88), "valid", [], "any", true, true, false, 88) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), "firstName", [], "any", false, false, false, 88), "vars", [], "any", false, false, false, 88), "valid", [], "any", false, false, false, 88))) ? ("error") : (""));
        yield "\">
            ";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 89, $this->source); })()), "firstName", [], "any", false, false, false, 89), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
            <label for=\"";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "firstName", [], "any", false, false, false, 90), "vars", [], "any", false, false, false, 90), "id", [], "any", false, false, false, 90), "html", null, true);
        yield "\">
              <span style=\"transition-delay:0ms\">F</span><span style=\"transition-delay:50ms\">i</span><span style=\"transition-delay:100ms\">r</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">t</span>
            </label>
            ";
        // line 93
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 93, $this->source); })()), "firstName", [], "any", false, false, false, 93), 'errors');
        yield "
        </div>
        <div class=\"form-control ";
        // line 95
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastName", [], "any", false, true, false, 95), "vars", [], "any", false, true, false, 95), "valid", [], "any", true, true, false, 95) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 95, $this->source); })()), "lastName", [], "any", false, false, false, 95), "vars", [], "any", false, false, false, 95), "valid", [], "any", false, false, false, 95))) ? ("error") : (""));
        yield "\">
            ";
        // line 96
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 96, $this->source); })()), "lastName", [], "any", false, false, false, 96), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
            <label for=\"";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 97, $this->source); })()), "lastName", [], "any", false, false, false, 97), "vars", [], "any", false, false, false, 97), "id", [], "any", false, false, false, 97), "html", null, true);
        yield "\">
              <span style=\"transition-delay:0ms\">L</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">t</span>
            </label>
            ";
        // line 100
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 100, $this->source); })()), "lastName", [], "any", false, false, false, 100), 'errors');
        yield "
        </div>
    </div>

    ";
        // line 105
        yield "    <div class=\"form-control ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "email", [], "any", false, true, false, 105), "vars", [], "any", false, true, false, 105), "valid", [], "any", true, true, false, 105) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 105, $this->source); })()), "email", [], "any", false, false, false, 105), "vars", [], "any", false, false, false, 105), "valid", [], "any", false, false, false, 105))) ? ("error") : (""));
        yield "\">
        ";
        // line 106
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 106, $this->source); })()), "email", [], "any", false, false, false, 106), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
        <label for=\"";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "email", [], "any", false, false, false, 107), "vars", [], "any", false, false, false, 107), "id", [], "any", false, false, false, 107), "html", null, true);
        yield "\">
          <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
        </label>
        <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
        ";
        // line 111
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 111, $this->source); })()), "email", [], "any", false, false, false, 111), 'errors');
        yield "
    </div>

    ";
        // line 115
        yield "    <div class=\"form-control ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "plainPassword", [], "any", false, true, false, 115), "first", [], "any", false, true, false, 115), "vars", [], "any", false, true, false, 115), "valid", [], "any", true, true, false, 115) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 115, $this->source); })()), "plainPassword", [], "any", false, false, false, 115), "first", [], "any", false, false, false, 115), "vars", [], "any", false, false, false, 115), "valid", [], "any", false, false, false, 115))) ? ("error") : (""));
        yield "\">
        ";
        // line 116
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 116, $this->source); })()), "plainPassword", [], "any", false, false, false, 116), "first", [], "any", false, false, false, 116), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
        <label for=\"";
        // line 117
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 117, $this->source); })()), "plainPassword", [], "any", false, false, false, 117), "first", [], "any", false, false, false, 117), "vars", [], "any", false, false, false, 117), "id", [], "any", false, false, false, 117), "html", null, true);
        yield "\">
          <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
        </label>
        <span class=\"field-icon toggle-pw\" data-target=\"";
        // line 120
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 120, $this->source); })()), "plainPassword", [], "any", false, false, false, 120), "first", [], "any", false, false, false, 120), "vars", [], "any", false, false, false, 120), "id", [], "any", false, false, false, 120), "html", null, true);
        yield "\"><i class=\"far fa-eye\"></i></span>
        ";
        // line 121
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 121, $this->source); })()), "plainPassword", [], "any", false, false, false, 121), "first", [], "any", false, false, false, 121), 'errors');
        yield "
    </div>

    ";
        // line 125
        yield "    <div class=\"form-control ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "plainPassword", [], "any", false, true, false, 125), "second", [], "any", false, true, false, 125), "vars", [], "any", false, true, false, 125), "valid", [], "any", true, true, false, 125) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 125, $this->source); })()), "plainPassword", [], "any", false, false, false, 125), "second", [], "any", false, false, false, 125), "vars", [], "any", false, false, false, 125), "valid", [], "any", false, false, false, 125))) ? ("error") : (""));
        yield "\">
        ";
        // line 126
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 126, $this->source); })()), "plainPassword", [], "any", false, false, false, 126), "second", [], "any", false, false, false, 126), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
        <label for=\"";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 127, $this->source); })()), "plainPassword", [], "any", false, false, false, 127), "second", [], "any", false, false, false, 127), "vars", [], "any", false, false, false, 127), "id", [], "any", false, false, false, 127), "html", null, true);
        yield "\">
          <span style=\"transition-delay:0ms\">C</span><span style=\"transition-delay:50ms\">o</span><span style=\"transition-delay:100ms\">n</span><span style=\"transition-delay:150ms\">f</span><span style=\"transition-delay:200ms\">i</span><span style=\"transition-delay:250ms\">r</span><span style=\"transition-delay:300ms\">m</span>
        </label>
        ";
        // line 130
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 130, $this->source); })()), "plainPassword", [], "any", false, false, false, 130), "second", [], "any", false, false, false, 130), 'errors');
        yield "
    </div>

    ";
        // line 134
        yield "    <div class=\"form-control\">
        ";
        // line 135
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 135, $this->source); })()), "phoneNumber", [], "any", false, false, false, 135), 'widget', ["attr" => ["placeholder" => " "]]);
        yield "
        <label for=\"";
        // line 136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 136, $this->source); })()), "phoneNumber", [], "any", false, false, false, 136), "vars", [], "any", false, false, false, 136), "id", [], "any", false, false, false, 136), "html", null, true);
        yield "\">
          <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">h</span><span style=\"transition-delay:100ms\">o</span><span style=\"transition-delay:150ms\">n</span><span style=\"transition-delay:200ms\">e</span>
          <span style=\"transition-delay:250ms; font-size:12px; opacity:.7\"> (optional)</span>
        </label>
    </div>

    <div class=\"btn-row\" style=\"margin-top:20px\">
        <button type=\"button\" class=\"btn-secondary\" id=\"goLogin\">Back to login</button>
        ";
        // line 144
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 144, $this->source); })()), "save", [], "any", false, false, false, 144), 'widget');
        yield "
    </div>

    ";
        // line 147
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 147, $this->source); })()), 'rest');
        yield "
    ";
        // line 148
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 148, $this->source); })()), 'form_end');
        yield "
</div>

    </div>";
        // line 152
        yield "
    ";
        // line 154
        yield "    <div class=\"auth-image\" id=\"authImage\">
      <img src=\"";
        // line 155
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/traveLogin.jpg"), "html", null, true);
        yield "\"
           alt=\"Adventure awaits\" loading=\"eager\"/>
      <div class=\"auth-image-overlay\"></div>
      <div class=\"logo-badge\">
        <svg viewBox=\"0 0 38 38\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
          <circle cx=\"19\" cy=\"19\" r=\"19\" fill=\"white\" fill-opacity=\".18\"/>
          <text x=\"7\" y=\"26\" font-size=\"18\" font-family=\"serif\" fill=\"white\">✈</text>
        </svg>
        <span>TripX</span>
      </div>
      <div class=\"auth-image-text\">
        <div class=\"tagline\">Your Next<br/>Adventure,</div>
        <div class=\"sub\">Instantly</div>
      </div>
    </div>

  </div>";
        // line 172
        yield "</div>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 175
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_js"));

        // line 176
        yield "<script>
  window.TRIPX = {
    registerUrl: \"";
        // line 178
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\",
    onboardingUrl: \"";
        // line 179
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_onboarding");
        yield "\"
  };

  document.addEventListener('DOMContentLoaded', function () {

    /* ── Login form: guard against empty submission (prevents NULL error) ── */
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
      loginForm.addEventListener('submit', function (e) {
        var email = document.getElementById('login_email').value.trim();
        var pwd   = document.getElementById('login_password').value;
        if (!email || !pwd) {
          e.preventDefault();
          if (window.showToast) {
            showToast('Please enter your email and password 🔑');
          }
          return;
        }
      });
    }

    /* ── Animated label: lift label when input already has a value (e.g. last_username) ── */
    document.querySelectorAll('.form-control input').forEach(function (input) {
      function checkFilled() {
        if (input.value && input.value.trim() !== '') {
          input.classList.add('has-value');
        } else {
          input.classList.remove('has-value');
        }
      }
      checkFilled();
      input.addEventListener('input', checkFilled);
      input.addEventListener('change', checkFilled);
    });

    /* ── Browser validation custom messages ── */
    document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function (el) {
      el.addEventListener('invalid', function () {
        if (el.validity.valueMissing) el.setCustomValidity('Please fill out this field.');
        else if (el.validity.typeMismatch) el.setCustomValidity('Please enter a valid email address.');
        else el.setCustomValidity('Please enter a valid value.');
      });
      el.addEventListener('input', function () { el.setCustomValidity(''); });
    });
  });
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
        return "front/login.html.twig";
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
        return array (  422 => 179,  418 => 178,  414 => 176,  404 => 175,  396 => 172,  377 => 155,  374 => 154,  371 => 152,  365 => 148,  361 => 147,  355 => 144,  344 => 136,  340 => 135,  337 => 134,  331 => 130,  325 => 127,  321 => 126,  316 => 125,  310 => 121,  306 => 120,  300 => 117,  296 => 116,  291 => 115,  285 => 111,  278 => 107,  274 => 106,  269 => 105,  262 => 100,  256 => 97,  252 => 96,  248 => 95,  243 => 93,  237 => 90,  233 => 89,  229 => 88,  226 => 87,  221 => 84,  215 => 80,  190 => 57,  179 => 49,  174 => 47,  169 => 45,  165 => 44,  162 => 43,  156 => 40,  153 => 39,  150 => 38,  147 => 36,  138 => 34,  133 => 33,  124 => 31,  119 => 30,  117 => 29,  114 => 28,  112 => 27,  95 => 12,  91 => 9,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'front/base_auth.html.twig' %}
{% block title %}Login{% endblock %}

{% block body %}
<div id=\"app\">
  <div class=\"auth-card\" id=\"authCard\">

    {# ── Forms container (behind image) ── #}
    <div class=\"auth-forms\">

      {# LOGIN PANEL #}
      <div class=\"form-panel panel-login\" id=\"panelLogin\">
        <div class=\"form-title\">Welcome back <span class=\"sparkle\">✦</span></div>
        <div class=\"form-sub\">Sign in and pick up where you left off</div>

        <div class=\"social-row\">
          <a href=\"#\" class=\"social-btn social-btn--circle\">
            <img src=\"https://www.svgrepo.com/show/475656/google-color.svg\" alt=\"G\"/>
          </a>
          <a href=\"#\" class=\"social-btn social-btn--circle\">
            <i class=\"fab fa-linkedin\" style=\"color:#0a66c2; font-size: 1.5rem;\"></i>
          </a>
        </div>

        <div class=\"divider\"><span>or continue with email</span></div>

        {% set error_flashes = app.flashes('error') %}
        {% set success_flashes = app.flashes('success') %}
        {# Flash messages #}
        {% for message in error_flashes %}
          <div class=\"alert alert-error\"><i class=\"fas fa-exclamation-circle\"></i> {{ message }}</div>
        {% endfor %}
        {% for message in success_flashes %}
          <div class=\"alert alert-success\"><i class=\"fas fa-check-circle\"></i> {{ message }}</div>
        {% endfor %}

        {# Symfony Authentication Error #}
        {% if error %}
          <div class=\"alert alert-error\">
            <i class=\"fas fa-exclamation-circle\"></i> {{ error.messageKey|trans(error.messageData, 'security') }}
          </div>
        {% endif %}

        <form method=\"POST\" action=\"{{ path('app_login') }}\" id=\"loginForm\">
          <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\"/>

          <div class=\"form-control {{ error ? 'error' : '' }}\">
            <input type=\"email\" id=\"login_email\" name=\"_username\"
                   value=\"{{ last_username }}\"
                   autocomplete=\"email\" required/>
            <label for=\"login_email\">
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control {{ error ? 'error' : '' }}\">
            <input type=\"password\" id=\"login_password\" name=\"_password\"
                   autocomplete=\"current-password\" required/>
            <label for=\"login_password\">
              <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
            </label>
            <span class=\"field-icon toggle-pw\" data-target=\"login_password\">
              <i class=\"far fa-eye\"></i>
            </span>
          </div>

          <div class=\"forgot\">
            <a href=\"#\">Forgot password?</a>
          </div>

          <div class=\"btn-row\">
            <button type=\"button\" class=\"btn-secondary\" id=\"goSignup\">Create account</button>
            <button type=\"submit\" class=\"btn-primary\">Login</button>
          </div>
        </form>
      </div>

      {# SIGNUP PANEL #}
<div class=\"form-panel panel-signup\" id=\"panelSignup\">
    <div class=\"form-title\">Join TripX <span class=\"sparkle\">✈</span></div>
    <div class=\"form-sub\">Create your account — it only takes a minute</div>

    {{ form_start(form, {'action': path('app_register'), 'method': 'POST', 'attr': {'id': 'signupForm', 'novalidate': 'novalidate'}}) }}

    {# ── Name row ── #}
    <div class=\"name-row\">
        <div class=\"form-control {{ form.firstName.vars.valid is defined and not form.firstName.vars.valid ? 'error' : '' }}\">
            {{ form_widget(form.firstName, {'attr': {'placeholder': ' '}}) }}
            <label for=\"{{ form.firstName.vars.id }}\">
              <span style=\"transition-delay:0ms\">F</span><span style=\"transition-delay:50ms\">i</span><span style=\"transition-delay:100ms\">r</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">t</span>
            </label>
            {{ form_errors(form.firstName) }}
        </div>
        <div class=\"form-control {{ form.lastName.vars.valid is defined and not form.lastName.vars.valid ? 'error' : '' }}\">
            {{ form_widget(form.lastName, {'attr': {'placeholder': ' '}}) }}
            <label for=\"{{ form.lastName.vars.id }}\">
              <span style=\"transition-delay:0ms\">L</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">t</span>
            </label>
            {{ form_errors(form.lastName) }}
        </div>
    </div>

    {# ── Email ── #}
    <div class=\"form-control {{ form.email.vars.valid is defined and not form.email.vars.valid ? 'error' : '' }}\">
        {{ form_widget(form.email, {'attr': {'placeholder': ' '}}) }}
        <label for=\"{{ form.email.vars.id }}\">
          <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
        </label>
        <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
        {{ form_errors(form.email) }}
    </div>

    {# ── Password ── #}
    <div class=\"form-control {{ form.plainPassword.first.vars.valid is defined and not form.plainPassword.first.vars.valid ? 'error' : '' }}\">
        {{ form_widget(form.plainPassword.first, {'attr': {'placeholder': ' '}}) }}
        <label for=\"{{ form.plainPassword.first.vars.id }}\">
          <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
        </label>
        <span class=\"field-icon toggle-pw\" data-target=\"{{ form.plainPassword.first.vars.id }}\"><i class=\"far fa-eye\"></i></span>
        {{ form_errors(form.plainPassword.first) }}
    </div>

    {# ── Confirm Password ── #}
    <div class=\"form-control {{ form.plainPassword.second.vars.valid is defined and not form.plainPassword.second.vars.valid ? 'error' : '' }}\">
        {{ form_widget(form.plainPassword.second, {'attr': {'placeholder': ' '}}) }}
        <label for=\"{{ form.plainPassword.second.vars.id }}\">
          <span style=\"transition-delay:0ms\">C</span><span style=\"transition-delay:50ms\">o</span><span style=\"transition-delay:100ms\">n</span><span style=\"transition-delay:150ms\">f</span><span style=\"transition-delay:200ms\">i</span><span style=\"transition-delay:250ms\">r</span><span style=\"transition-delay:300ms\">m</span>
        </label>
        {{ form_errors(form.plainPassword.second) }}
    </div>

    {# ── Phone (optional) ── #}
    <div class=\"form-control\">
        {{ form_widget(form.phoneNumber, {'attr': {'placeholder': ' '}}) }}
        <label for=\"{{ form.phoneNumber.vars.id }}\">
          <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">h</span><span style=\"transition-delay:100ms\">o</span><span style=\"transition-delay:150ms\">n</span><span style=\"transition-delay:200ms\">e</span>
          <span style=\"transition-delay:250ms; font-size:12px; opacity:.7\"> (optional)</span>
        </label>
    </div>

    <div class=\"btn-row\" style=\"margin-top:20px\">
        <button type=\"button\" class=\"btn-secondary\" id=\"goLogin\">Back to login</button>
        {{ form_widget(form.save) }}
    </div>

    {{ form_rest(form) }}
    {{ form_end(form) }}
</div>

    </div>{# /auth-forms #}

    {# Image panel – slides right on signup #}
    <div class=\"auth-image\" id=\"authImage\">
      <img src=\"{{ asset('images/traveLogin.jpg') }}\"
           alt=\"Adventure awaits\" loading=\"eager\"/>
      <div class=\"auth-image-overlay\"></div>
      <div class=\"logo-badge\">
        <svg viewBox=\"0 0 38 38\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
          <circle cx=\"19\" cy=\"19\" r=\"19\" fill=\"white\" fill-opacity=\".18\"/>
          <text x=\"7\" y=\"26\" font-size=\"18\" font-family=\"serif\" fill=\"white\">✈</text>
        </svg>
        <span>TripX</span>
      </div>
      <div class=\"auth-image-text\">
        <div class=\"tagline\">Your Next<br/>Adventure,</div>
        <div class=\"sub\">Instantly</div>
      </div>
    </div>

  </div>{# /auth-card #}
</div>{# /app #}
{% endblock %}

{% block extra_js %}
<script>
  window.TRIPX = {
    registerUrl: \"{{ path('app_register') }}\",
    onboardingUrl: \"{{ path('app_onboarding') }}\"
  };

  document.addEventListener('DOMContentLoaded', function () {

    /* ── Login form: guard against empty submission (prevents NULL error) ── */
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
      loginForm.addEventListener('submit', function (e) {
        var email = document.getElementById('login_email').value.trim();
        var pwd   = document.getElementById('login_password').value;
        if (!email || !pwd) {
          e.preventDefault();
          if (window.showToast) {
            showToast('Please enter your email and password 🔑');
          }
          return;
        }
      });
    }

    /* ── Animated label: lift label when input already has a value (e.g. last_username) ── */
    document.querySelectorAll('.form-control input').forEach(function (input) {
      function checkFilled() {
        if (input.value && input.value.trim() !== '') {
          input.classList.add('has-value');
        } else {
          input.classList.remove('has-value');
        }
      }
      checkFilled();
      input.addEventListener('input', checkFilled);
      input.addEventListener('change', checkFilled);
    });

    /* ── Browser validation custom messages ── */
    document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function (el) {
      el.addEventListener('invalid', function () {
        if (el.validity.valueMissing) el.setCustomValidity('Please fill out this field.');
        else if (el.validity.typeMismatch) el.setCustomValidity('Please enter a valid email address.');
        else el.setCustomValidity('Please enter a valid value.');
      });
      el.addEventListener('input', function () { el.setCustomValidity(''); });
    });
  });
</script>
{% endblock %}
", "front/login.html.twig", "C:\\Sym\\templates\\front\\login.html.twig");
    }
}
