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
        // line 28
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "flashes", ["error"], "method", false, false, false, 28));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 29
            yield "          <div class=\"alert alert-error\"><i class=\"fas fa-exclamation-circle\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 31, $this->source); })()), "flashes", ["success"], "method", false, false, false, 31));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 32
            yield "          <div class=\"alert alert-success\"><i class=\"fas fa-check-circle\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        yield "
        ";
        // line 36
        yield "        ";
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 36, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 37
            yield "          <div class=\"alert alert-error\">
            <i class=\"fas fa-exclamation-circle\"></i> ";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 38, $this->source); })()), "messageKey", [], "any", false, false, false, 38), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 38, $this->source); })()), "messageData", [], "any", false, false, false, 38), "security"), "html", null, true);
            yield "
          </div>
        ";
        }
        // line 41
        yield "
        <form method=\"POST\" action=\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" id=\"loginForm\" novalidate>
          <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\"/>

          <div class=\"form-control ";
        // line 45
        yield (((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 45, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"email\" id=\"login_email\" name=\"_username\"
                   value=\"";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 47, $this->source); })()), "html", null, true);
        yield "\"
                   autocomplete=\"email\" required/>
            <label>
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control ";
        // line 55
        yield (((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 55, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"password\" id=\"login_password\" name=\"_password\"
                   autocomplete=\"current-password\" required/>
            <label>
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
        // line 78
        yield "      <div class=\"form-panel panel-signup\" id=\"panelSignup\">
        <div class=\"form-title\">Join TripX <span class=\"sparkle\">✈</span></div>
        <div class=\"form-sub\">Create your account 
         it only takes a minute</div>

        <form method=\"POST\" action=\"";
        // line 83
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" id=\"signupForm\" novalidate>
          <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("register"), "html", null, true);
        yield "\"/>

          ";
        // line 86
        $context["has_signup_error"] = (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 86, $this->source); })()), "flashes", ["error"], "method", false, false, false, 86)) > 0);
        // line 87
        yield "
          <div class=\"name-row\">
            <div class=\"form-control ";
        // line 89
        yield (((($tmp = (isset($context["has_signup_error"]) || array_key_exists("has_signup_error", $context) ? $context["has_signup_error"] : (function () { throw new RuntimeError('Variable "has_signup_error" does not exist.', 89, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
              <input type=\"text\" id=\"reg_first\" name=\"first_name\" autocomplete=\"given-name\" required/>
              <label>
                <span style=\"transition-delay:0ms\">F</span><span style=\"transition-delay:50ms\">i</span><span style=\"transition-delay:100ms\">r</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">t</span><span style=\"transition-delay:250ms\">&nbsp;</span><span style=\"transition-delay:300ms\">N</span><span style=\"transition-delay:350ms\">a</span><span style=\"transition-delay:400ms\">m</span><span style=\"transition-delay:450ms\">e</span>
              </label>
            </div>
            <div class=\"form-control ";
        // line 95
        yield (((($tmp = (isset($context["has_signup_error"]) || array_key_exists("has_signup_error", $context) ? $context["has_signup_error"] : (function () { throw new RuntimeError('Variable "has_signup_error" does not exist.', 95, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
              <input type=\"text\" id=\"reg_last\" name=\"last_name\" autocomplete=\"family-name\" required/>
              <label>
                <span style=\"transition-delay:0ms\">L</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">t</span><span style=\"transition-delay:200ms\">&nbsp;</span><span style=\"transition-delay:250ms\">N</span><span style=\"transition-delay:300ms\">a</span><span style=\"transition-delay:350ms\">m</span><span style=\"transition-delay:400ms\">e</span>
              </label>
            </div>
          </div>

          <div class=\"form-control ";
        // line 103
        yield (((($tmp = (isset($context["has_signup_error"]) || array_key_exists("has_signup_error", $context) ? $context["has_signup_error"] : (function () { throw new RuntimeError('Variable "has_signup_error" does not exist.', 103, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"email\" id=\"reg_email\" name=\"email\" autocomplete=\"email\" required/>
            <label>
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control ";
        // line 111
        yield (((($tmp = (isset($context["has_signup_error"]) || array_key_exists("has_signup_error", $context) ? $context["has_signup_error"] : (function () { throw new RuntimeError('Variable "has_signup_error" does not exist.', 111, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"password\" id=\"reg_password\" name=\"password\" autocomplete=\"new-password\" required/>
            <label>
              <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
            </label>
            <span class=\"field-icon toggle-pw\" data-target=\"reg_password\">
              <i class=\"far fa-eye\"></i>
            </span>
          </div>

          <div class=\"form-control ";
        // line 121
        yield (((($tmp = (isset($context["has_signup_error"]) || array_key_exists("has_signup_error", $context) ? $context["has_signup_error"] : (function () { throw new RuntimeError('Variable "has_signup_error" does not exist.', 121, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("error") : (""));
        yield "\">
            <input type=\"password\" id=\"reg_confirm\" name=\"confirm_password\" autocomplete=\"new-password\" required/>
            <label>
              <span style=\"transition-delay:0ms\">C</span><span style=\"transition-delay:50ms\">o</span><span style=\"transition-delay:100ms\">n</span><span style=\"transition-delay:150ms\">f</span><span style=\"transition-delay:200ms\">i</span><span style=\"transition-delay:250ms\">r</span><span style=\"transition-delay:300ms\">m</span><span style=\"transition-delay:350ms\">&nbsp;</span><span style=\"transition-delay:400ms\">P</span><span style=\"transition-delay:450ms\">a</span><span style=\"transition-delay:500ms\">s</span><span style=\"transition-delay:550ms\">s</span><span style=\"transition-delay:600ms\">w</span><span style=\"transition-delay:650ms\">o</span><span style=\"transition-delay:700ms\">r</span><span style=\"transition-delay:750ms\">d</span>
            </label>
          </div>

          <div class=\"btn-row\" style=\"margin-top:20px\">
            <button type=\"button\" class=\"btn-secondary\" id=\"goLogin\">Back to login</button>
            <button type=\"submit\" class=\"btn-primary\">Create account</button>
          </div>
        </form>
      </div>

    </div>";
        // line 136
        yield "
    ";
        // line 138
        yield "    <div class=\"auth-image\" id=\"authImage\">
      <img src=\"";
        // line 139
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
        // line 156
        yield "</div>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 159
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_js"));

        // line 160
        yield "<script>
  window.TRIPX = {
    registerUrl: \"";
        // line 162
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\",
    onboardingUrl: \"";
        // line 163
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_onboarding");
        yield "\"
  };
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
        return array (  342 => 163,  338 => 162,  334 => 160,  324 => 159,  316 => 156,  297 => 139,  294 => 138,  291 => 136,  274 => 121,  261 => 111,  250 => 103,  239 => 95,  230 => 89,  226 => 87,  224 => 86,  219 => 84,  215 => 83,  208 => 78,  183 => 55,  172 => 47,  167 => 45,  162 => 43,  158 => 42,  155 => 41,  149 => 38,  146 => 37,  143 => 36,  140 => 34,  131 => 32,  126 => 31,  117 => 29,  112 => 28,  95 => 12,  91 => 9,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
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

        {# Flash messages #}
        {% for message in app.flashes('error') %}
          <div class=\"alert alert-error\"><i class=\"fas fa-exclamation-circle\"></i> {{ message }}</div>
        {% endfor %}
        {% for message in app.flashes('success') %}
          <div class=\"alert alert-success\"><i class=\"fas fa-check-circle\"></i> {{ message }}</div>
        {% endfor %}

        {# Symfony Authentication Error #}
        {% if error %}
          <div class=\"alert alert-error\">
            <i class=\"fas fa-exclamation-circle\"></i> {{ error.messageKey|trans(error.messageData, 'security') }}
          </div>
        {% endif %}

        <form method=\"POST\" action=\"{{ path('app_login') }}\" id=\"loginForm\" novalidate>
          <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\"/>

          <div class=\"form-control {{ error ? 'error' : '' }}\">
            <input type=\"email\" id=\"login_email\" name=\"_username\"
                   value=\"{{ last_username }}\"
                   autocomplete=\"email\" required/>
            <label>
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control {{ error ? 'error' : '' }}\">
            <input type=\"password\" id=\"login_password\" name=\"_password\"
                   autocomplete=\"current-password\" required/>
            <label>
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
        <div class=\"form-sub\">Create your account 
         it only takes a minute</div>

        <form method=\"POST\" action=\"{{ path('app_register') }}\" id=\"signupForm\" novalidate>
          <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('register') }}\"/>

          {% set has_signup_error = app.flashes('error')|length > 0 %}

          <div class=\"name-row\">
            <div class=\"form-control {{ has_signup_error ? 'error' : '' }}\">
              <input type=\"text\" id=\"reg_first\" name=\"first_name\" autocomplete=\"given-name\" required/>
              <label>
                <span style=\"transition-delay:0ms\">F</span><span style=\"transition-delay:50ms\">i</span><span style=\"transition-delay:100ms\">r</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">t</span><span style=\"transition-delay:250ms\">&nbsp;</span><span style=\"transition-delay:300ms\">N</span><span style=\"transition-delay:350ms\">a</span><span style=\"transition-delay:400ms\">m</span><span style=\"transition-delay:450ms\">e</span>
              </label>
            </div>
            <div class=\"form-control {{ has_signup_error ? 'error' : '' }}\">
              <input type=\"text\" id=\"reg_last\" name=\"last_name\" autocomplete=\"family-name\" required/>
              <label>
                <span style=\"transition-delay:0ms\">L</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">t</span><span style=\"transition-delay:200ms\">&nbsp;</span><span style=\"transition-delay:250ms\">N</span><span style=\"transition-delay:300ms\">a</span><span style=\"transition-delay:350ms\">m</span><span style=\"transition-delay:400ms\">e</span>
              </label>
            </div>
          </div>

          <div class=\"form-control {{ has_signup_error ? 'error' : '' }}\">
            <input type=\"email\" id=\"reg_email\" name=\"email\" autocomplete=\"email\" required/>
            <label>
              <span style=\"transition-delay:0ms\">E</span><span style=\"transition-delay:50ms\">m</span><span style=\"transition-delay:100ms\">a</span><span style=\"transition-delay:150ms\">i</span><span style=\"transition-delay:200ms\">l</span>
            </label>
            <span class=\"field-icon\"><i class=\"far fa-envelope\"></i></span>
          </div>

          <div class=\"form-control {{ has_signup_error ? 'error' : '' }}\">
            <input type=\"password\" id=\"reg_password\" name=\"password\" autocomplete=\"new-password\" required/>
            <label>
              <span style=\"transition-delay:0ms\">P</span><span style=\"transition-delay:50ms\">a</span><span style=\"transition-delay:100ms\">s</span><span style=\"transition-delay:150ms\">s</span><span style=\"transition-delay:200ms\">w</span><span style=\"transition-delay:250ms\">o</span><span style=\"transition-delay:300ms\">r</span><span style=\"transition-delay:350ms\">d</span>
            </label>
            <span class=\"field-icon toggle-pw\" data-target=\"reg_password\">
              <i class=\"far fa-eye\"></i>
            </span>
          </div>

          <div class=\"form-control {{ has_signup_error ? 'error' : '' }}\">
            <input type=\"password\" id=\"reg_confirm\" name=\"confirm_password\" autocomplete=\"new-password\" required/>
            <label>
              <span style=\"transition-delay:0ms\">C</span><span style=\"transition-delay:50ms\">o</span><span style=\"transition-delay:100ms\">n</span><span style=\"transition-delay:150ms\">f</span><span style=\"transition-delay:200ms\">i</span><span style=\"transition-delay:250ms\">r</span><span style=\"transition-delay:300ms\">m</span><span style=\"transition-delay:350ms\">&nbsp;</span><span style=\"transition-delay:400ms\">P</span><span style=\"transition-delay:450ms\">a</span><span style=\"transition-delay:500ms\">s</span><span style=\"transition-delay:550ms\">s</span><span style=\"transition-delay:600ms\">w</span><span style=\"transition-delay:650ms\">o</span><span style=\"transition-delay:700ms\">r</span><span style=\"transition-delay:750ms\">d</span>
            </label>
          </div>

          <div class=\"btn-row\" style=\"margin-top:20px\">
            <button type=\"button\" class=\"btn-secondary\" id=\"goLogin\">Back to login</button>
            <button type=\"submit\" class=\"btn-primary\">Create account</button>
          </div>
        </form>
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
</script>
{% endblock %}
", "front/login.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\login.html.twig");
    }
}
