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

/* base.html.twig */
class __TwigTemplate_bda810712c938f9a723d977fdc22ddce extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
    <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
    ";
        // line 8
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 9
        yield "</head>
<body class=\"page-wipe-container\">
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>
    <div id=\"cursor-halo\"></div>

    <nav class=\"nav\" id=\"main-nav\" style=\"position: relative; z-index: 1000;\">
        <div class=\"nav-inner\">
            <a href=\"";
        // line 16
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-logo\">
                <img src=\"/images/tripx-logo.png\" alt=\"TripX\" style=\"height: 38px;\" onerror=\"this.style.display='none'\">
                Trip<span>X</span>
            </a>
            
            <div class=\"nav-links\">
                <a href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\" class=\"nav-link\">Home</a>
                <a href=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("destinations");
        yield "\" class=\"nav-link\">Destinations</a>
                <a href=\"";
        // line 24
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("activities");
        yield "\" class=\"nav-link\">Activities</a>
                <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("accommodations");
        yield "\" class=\"nav-link\">Accommodations</a>
                <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("transport");
        yield "\" class=\"nav-link\">Transport</a>
                <a href=\"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("offers");
        yield "\" class=\"nav-link\">Offers</a>
                <a href=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"nav-link\">Blog</a>
            </div>

            <div class=\"nav-actions\">
                <button id=\"theme-toggle\" class=\"nav-link\" style=\"font-size: 1.2rem; cursor: pointer; background: none; border: none; padding: 0 10px;\">🌓</button>
                <a href=\"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("users");
        yield "\" class=\"nav-link\">My Bookings</a>
                <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("users");
        yield "\" class=\"btn-nav-primary ripple-btn\">Profile</a>
                <a href=\"";
        // line 35
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
                  <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
                  <div class=\"text\">Logout</div>
                </a>
            </div>
        </div>
    </nav>

    <main>
        ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 44, $this->source); })()), "flashes", [], "any", false, false, false, 44));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 45
            yield "            <div class=\"flash-container\">
                ";
            // line 46
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 47
                yield "                    <div class=\"flash-message ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">
                        ";
                // line 48
                if (($context["label"] == "success")) {
                    yield "✅";
                } else {
                    yield "❌";
                }
                // line 49
                yield "                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            yield "            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        yield "        ";
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 55
        yield "    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.flash-message').forEach(el => {
                    el.classList.add('fade-out');
                    setTimeout(() => el.remove(), 500);
                });
            }, 4000);
        });
    </script>

    <script src=\"/assets.php?f=js/main.js\"></script>
    <script src=\"/js/tracker.js\"></script>
    ";
        // line 70
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 71
        yield "</body>
</html>





";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "TripX — Future of Travel";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 54
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 70
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  258 => 70,  242 => 54,  226 => 8,  209 => 5,  194 => 71,  192 => 70,  175 => 55,  172 => 54,  165 => 52,  155 => 49,  149 => 48,  144 => 47,  140 => 46,  137 => 45,  133 => 44,  121 => 35,  117 => 34,  113 => 33,  105 => 28,  101 => 27,  97 => 26,  93 => 25,  89 => 24,  85 => 23,  81 => 22,  72 => 16,  63 => 9,  61 => 8,  55 => 5,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-theme=\"light\">
<head>
    <meta charset=\"UTF-8\">
    <title>{% block title %}TripX — Future of Travel{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
    <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
    {% block stylesheets %}{% endblock %}
</head>
<body class=\"page-wipe-container\">
    <div id=\"cursor-dot\"></div><div id=\"cursor-halo\"></div>
    <div id=\"cursor-halo\"></div>

    <nav class=\"nav\" id=\"main-nav\" style=\"position: relative; z-index: 1000;\">
        <div class=\"nav-inner\">
            <a href=\"{{ path('index') }}\" class=\"nav-logo\">
                <img src=\"/images/tripx-logo.png\" alt=\"TripX\" style=\"height: 38px;\" onerror=\"this.style.display='none'\">
                Trip<span>X</span>
            </a>
            
            <div class=\"nav-links\">
                <a href=\"{{ path('index') }}\" class=\"nav-link\">Home</a>
                <a href=\"{{ path('destinations') }}\" class=\"nav-link\">Destinations</a>
                <a href=\"{{ path('activities') }}\" class=\"nav-link\">Activities</a>
                <a href=\"{{ path('accommodations') }}\" class=\"nav-link\">Accommodations</a>
                <a href=\"{{ path('transport') }}\" class=\"nav-link\">Transport</a>
                <a href=\"{{ path('offers') }}\" class=\"nav-link\">Offers</a>
                <a href=\"{{ path('blog') }}\" class=\"nav-link\">Blog</a>
            </div>

            <div class=\"nav-actions\">
                <button id=\"theme-toggle\" class=\"nav-link\" style=\"font-size: 1.2rem; cursor: pointer; background: none; border: none; padding: 0 10px;\">🌓</button>
                <a href=\"{{ path('users') }}\" class=\"nav-link\">My Bookings</a>
                <a href=\"{{ path('users') }}\" class=\"btn-nav-primary ripple-btn\">Profile</a>
                <a href=\"{{ path('app_logout') }}\" class=\"Btn-logout\" style=\"margin-left: 8px;\">
                  <div class=\"sign\"><svg viewBox=\"0 0 512 512\"><path d=\"M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z\" /></svg></div>
                  <div class=\"text\">Logout</div>
                </a>
            </div>
        </div>
    </nav>

    <main>
        {% for label, messages in app.flashes %}
            <div class=\"flash-container\">
                {% for message in messages %}
                    <div class=\"flash-message {{ label }}\">
                        {% if label == 'success' %}✅{% else %}❌{% endif %}
                        {{ message }}
                    </div>
                {% endfor %}
            </div>
        {% endfor %}
        {% block body %}{% endblock %}
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.flash-message').forEach(el => {
                    el.classList.add('fade-out');
                    setTimeout(() => el.remove(), 500);
                });
            }, 4000);
        });
    </script>

    <script src=\"/assets.php?f=js/main.js\"></script>
    <script src=\"/js/tracker.js\"></script>
    {% block javascripts %}{% endblock %}
</body>
</html>





", "base.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\base.html.twig");
    }
}
