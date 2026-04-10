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

/* front/blog/travel_story_show.html.twig */
class __TwigTemplate_4b2addd079d0c67ea66a3cfad1baa25d extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/travel_story_show.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 3, $this->source); })()), "title", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container mt-4\">
    <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_index");
        yield "\" class=\"btn btn-outline-secondary mb-4\">← Back</a>

    <div class=\"card shadow-sm\">
        ";
        // line 10
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 10, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 11, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 11), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 11, $this->source); })()), "title", [], "any", false, false, false, 11), "html", null, true);
            yield "\" style=\"width: 100%; max-height: 420px; object-fit: cover;\">
        ";
        }
        // line 13
        yield "
        <div class=\"card-body\">
            <h1 class=\"mb-2\">";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 15, $this->source); })()), "title", [], "any", false, false, false, 15), "html", null, true);
        yield "</h1>
            <p class=\"text-muted\">
                ";
        // line 17
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 17, $this->source); })()), "destination", [], "any", false, false, false, 17)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 17, $this->source); })()), "destination", [], "any", false, false, false, 17), "html", null, true)) : ("Unknown destination"));
        yield "
                ";
        // line 18
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 18, $this->source); })()), "startDate", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 19
            yield "                    | ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 19, $this->source); })()), "startDate", [], "any", false, false, false, 19), "Y-m-d"), "html", null, true);
            yield "
                ";
        }
        // line 21
        yield "                ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 21, $this->source); })()), "endDate", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 22
            yield "                    → ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 22, $this->source); })()), "endDate", [], "any", false, false, false, 22), "Y-m-d"), "html", null, true);
            yield "
                ";
        }
        // line 24
        yield "            </p>

            <div class=\"mb-3\">
                ";
        // line 27
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 27, $this->source); })()), "overallRating", [], "any", false, false, false, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 28
            yield "                    <span class=\"badge bg-warning text-dark\">⭐ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 28, $this->source); })()), "overallRating", [], "any", false, false, false, 28), "html", null, true);
            yield "/5</span>
                ";
        }
        // line 30
        yield "                ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 30, $this->source); })()), "travelType", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 31
            yield "                    <span class=\"badge bg-info text-dark\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 31, $this->source); })()), "travelType", [], "any", false, false, false, 31), "html", null, true);
            yield "</span>
                ";
        }
        // line 33
        yield "                ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 33, $this->source); })()), "travelStyle", [], "any", false, false, false, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 34
            yield "                    <span class=\"badge bg-secondary\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 34, $this->source); })()), "travelStyle", [], "any", false, false, false, 34), "html", null, true);
            yield "</span>
                ";
        }
        // line 36
        yield "            </div>

            <p><strong>Would recommend:</strong> ";
        // line 38
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 38, $this->source); })()), "wouldRecommend", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</p>
            <p><strong>Would go again:</strong> ";
        // line 39
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 39, $this->source); })()), "wouldGoAgain", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</p>

            ";
        // line 41
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 41, $this->source); })()), "summary", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 42
            yield "                <h4>Summary</h4>
                <p>";
            // line 43
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 43, $this->source); })()), "summary", [], "any", false, false, false, 43), "html", null, true));
            yield "</p>
            ";
        }
        // line 45
        yield "
            ";
        // line 46
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 46, $this->source); })()), "tips", [], "any", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 47
            yield "                <h4>Tips</h4>
                <p>";
            // line 48
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 48, $this->source); })()), "tips", [], "any", false, false, false, 48), "html", null, true));
            yield "</p>
            ";
        }
        // line 50
        yield "
            ";
        // line 51
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 51, $this->source); })()), "totalBudget", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 52
            yield "                <h4>Budget</h4>
                <p>";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 53, $this->source); })()), "totalBudget", [], "any", false, false, false, 53), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 53, $this->source); })()), "currency", [], "any", false, false, false, 53), "html", null, true);
            yield "</p>
            ";
        }
        // line 55
        yield "
            ";
        // line 56
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 56, $this->source); })()), "tagsJson", [], "any", false, false, false, 56))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 57
            yield "                <h4>Tags</h4>
                <div class=\"mb-3\">
                    ";
            // line 59
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 59, $this->source); })()), "tagsJson", [], "any", false, false, false, 59));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 60
                yield "                        <span class=\"badge bg-light text-dark border me-1\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["tag"], "html", null, true);
                yield "</span>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            yield "                </div>
            ";
        }
        // line 64
        yield "
            ";
        // line 65
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 65, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 65))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 66
            yield "                <h4>Must Visit</h4>
                <ul>
                    ";
            // line 68
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 68, $this->source); })()), "mustVisitJson", [], "any", false, false, false, 68));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 69
                yield "                        <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                yield "</li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 71
            yield "                </ul>
            ";
        }
        // line 73
        yield "
            ";
        // line 74
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 74, $this->source); })()), "mustDoJson", [], "any", false, false, false, 74))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 75
            yield "                <h4>Must Do</h4>
                <ul>
                    ";
            // line 77
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 77, $this->source); })()), "mustDoJson", [], "any", false, false, false, 77));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 78
                yield "                        <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                yield "</li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            yield "                </ul>
            ";
        }
        // line 82
        yield "
            ";
        // line 83
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 83, $this->source); })()), "mustTryJson", [], "any", false, false, false, 83))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 84
            yield "                <h4>Must Try</h4>
                <ul>
                    ";
            // line 86
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 86, $this->source); })()), "mustTryJson", [], "any", false, false, false, 86));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 87
                yield "                        <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                yield "</li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            yield "                </ul>
            ";
        }
        // line 91
        yield "
            ";
        // line 92
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 92, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 92))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 93
            yield "                <h4>Favorite Places</h4>
                <ul>
                    ";
            // line 95
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 95, $this->source); })()), "favoritePlacesJson", [], "any", false, false, false, 95));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 96
                yield "                        <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                yield "</li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            yield "                </ul>
            ";
        }
        // line 100
        yield "
            ";
        // line 101
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 101, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 101))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 102
            yield "                <h4>Gallery</h4>
                <div class=\"row\">
                    ";
            // line 104
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 104, $this->source); })()), "imageUrlsJson", [], "any", false, false, false, 104));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 105
                yield "                        <div class=\"col-md-4 mb-3\">
                            <img src=\"";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" alt=\"Travel image\" class=\"img-fluid rounded shadow-sm\">
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            yield "                </div>
            ";
        }
        // line 111
        yield "        </div>
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
        return "front/blog/travel_story_show.html.twig";
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
        return array (  375 => 111,  371 => 109,  362 => 106,  359 => 105,  355 => 104,  351 => 102,  349 => 101,  346 => 100,  342 => 98,  333 => 96,  329 => 95,  325 => 93,  323 => 92,  320 => 91,  316 => 89,  307 => 87,  303 => 86,  299 => 84,  297 => 83,  294 => 82,  290 => 80,  281 => 78,  277 => 77,  273 => 75,  271 => 74,  268 => 73,  264 => 71,  255 => 69,  251 => 68,  247 => 66,  245 => 65,  242 => 64,  238 => 62,  229 => 60,  225 => 59,  221 => 57,  219 => 56,  216 => 55,  209 => 53,  206 => 52,  204 => 51,  201 => 50,  196 => 48,  193 => 47,  191 => 46,  188 => 45,  183 => 43,  180 => 42,  178 => 41,  173 => 39,  169 => 38,  165 => 36,  159 => 34,  156 => 33,  150 => 31,  147 => 30,  141 => 28,  139 => 27,  134 => 24,  128 => 22,  125 => 21,  119 => 19,  117 => 18,  113 => 17,  108 => 15,  104 => 13,  96 => 11,  94 => 10,  88 => 7,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ story.title }}{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <a href=\"{{ path('travel_story_index') }}\" class=\"btn btn-outline-secondary mb-4\">← Back</a>

    <div class=\"card shadow-sm\">
        {% if story.coverImageUrl %}
            <img src=\"{{ story.coverImageUrl }}\" alt=\"{{ story.title }}\" style=\"width: 100%; max-height: 420px; object-fit: cover;\">
        {% endif %}

        <div class=\"card-body\">
            <h1 class=\"mb-2\">{{ story.title }}</h1>
            <p class=\"text-muted\">
                {{ story.destination ?: 'Unknown destination' }}
                {% if story.startDate %}
                    | {{ story.startDate|date('Y-m-d') }}
                {% endif %}
                {% if story.endDate %}
                    → {{ story.endDate|date('Y-m-d') }}
                {% endif %}
            </p>

            <div class=\"mb-3\">
                {% if story.overallRating %}
                    <span class=\"badge bg-warning text-dark\">⭐ {{ story.overallRating }}/5</span>
                {% endif %}
                {% if story.travelType %}
                    <span class=\"badge bg-info text-dark\">{{ story.travelType }}</span>
                {% endif %}
                {% if story.travelStyle %}
                    <span class=\"badge bg-secondary\">{{ story.travelStyle }}</span>
                {% endif %}
            </div>

            <p><strong>Would recommend:</strong> {{ story.wouldRecommend ? 'Yes' : 'No' }}</p>
            <p><strong>Would go again:</strong> {{ story.wouldGoAgain ? 'Yes' : 'No' }}</p>

            {% if story.summary %}
                <h4>Summary</h4>
                <p>{{ story.summary|nl2br }}</p>
            {% endif %}

            {% if story.tips %}
                <h4>Tips</h4>
                <p>{{ story.tips|nl2br }}</p>
            {% endif %}

            {% if story.totalBudget %}
                <h4>Budget</h4>
                <p>{{ story.totalBudget }} {{ story.currency }}</p>
            {% endif %}

            {% if story.tagsJson is not empty %}
                <h4>Tags</h4>
                <div class=\"mb-3\">
                    {% for tag in story.tagsJson %}
                        <span class=\"badge bg-light text-dark border me-1\">{{ tag }}</span>
                    {% endfor %}
                </div>
            {% endif %}

            {% if story.mustVisitJson is not empty %}
                <h4>Must Visit</h4>
                <ul>
                    {% for item in story.mustVisitJson %}
                        <li>{{ item }}</li>
                    {% endfor %}
                </ul>
            {% endif %}

            {% if story.mustDoJson is not empty %}
                <h4>Must Do</h4>
                <ul>
                    {% for item in story.mustDoJson %}
                        <li>{{ item }}</li>
                    {% endfor %}
                </ul>
            {% endif %}

            {% if story.mustTryJson is not empty %}
                <h4>Must Try</h4>
                <ul>
                    {% for item in story.mustTryJson %}
                        <li>{{ item }}</li>
                    {% endfor %}
                </ul>
            {% endif %}

            {% if story.favoritePlacesJson is not empty %}
                <h4>Favorite Places</h4>
                <ul>
                    {% for item in story.favoritePlacesJson %}
                        <li>{{ item }}</li>
                    {% endfor %}
                </ul>
            {% endif %}

            {% if story.imageUrlsJson is not empty %}
                <h4>Gallery</h4>
                <div class=\"row\">
                    {% for image in story.imageUrlsJson %}
                        <div class=\"col-md-4 mb-3\">
                            <img src=\"{{ image }}\" alt=\"Travel image\" class=\"img-fluid rounded shadow-sm\">
                        </div>
                    {% endfor %}
                </div>
            {% endif %}
        </div>
    </div>
</div>
{% endblock %}", "front/blog/travel_story_show.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\travel_story_show.html.twig");
    }
}
