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

/* front/blog/_feed_items.html.twig */
class __TwigTemplate_4d582ebf615a9cd3013698f92d3848b2 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/_feed_items.html.twig"));

        // line 1
        $context["authorMap"] = ((array_key_exists("authorMap", $context)) ? ((isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 1, $this->source); })())) : ([]));
        // line 2
        $context["savedPostIds"] = ((array_key_exists("savedPostIds", $context)) ? ((isset($context["savedPostIds"]) || array_key_exists("savedPostIds", $context) ? $context["savedPostIds"] : (function () { throw new RuntimeError('Variable "savedPostIds" does not exist.', 2, $this->source); })())) : ([]));
        // line 3
        $context["currentUserId"] = ((array_key_exists("currentUserId", $context)) ? ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 3, $this->source); })())) : (null));
        // line 4
        $context["reactionSummary"] = ((array_key_exists("reactionSummary", $context)) ? ((isset($context["reactionSummary"]) || array_key_exists("reactionSummary", $context) ? $context["reactionSummary"] : (function () { throw new RuntimeError('Variable "reactionSummary" does not exist.', 4, $this->source); })())) : ([]));
        // line 5
        $context["userReactions"] = ((array_key_exists("userReactions", $context)) ? ((isset($context["userReactions"]) || array_key_exists("userReactions", $context) ? $context["userReactions"] : (function () { throw new RuntimeError('Variable "userReactions" does not exist.', 5, $this->source); })())) : ([]));
        // line 6
        $context["feed"] = ((array_key_exists("feed", $context)) ? ((isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 6, $this->source); })())) : ([]));
        // line 7
        yield "
";
        // line 8
        $context["rxnIcons"] = ["like" => "👍", "love" => "❤️", "haha" => "😂", "wow" => "😮", "sad" => "😢", "angry" => "😡"];
        // line 9
        $context["rxnLabels"] = ["like" => "Like", "love" => "Love", "haha" => "Haha", "wow" => "Wow", "sad" => "Sad", "angry" => "Angry"];
        // line 10
        yield "
";
        // line 11
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 11, $this->source); })()))) {
            // line 12
            yield "  <div class=\"empty-state\">
    <span class=\"ei\">✈️</span>
    <h3>No posts found</h3>
    <p>
      <a href=\"";
            // line 16
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
            yield "\" class=\"tpill-link\" data-type=\"\" data-search=\"\">Clear filters</a> or
      <a href=\"";
            // line 17
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_create");
            yield "\">create the first post!</a>
    </p>
  </div>
";
        } else {
            // line 21
            yield "  ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 21, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 22
                yield "    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "feedType", [], "any", false, false, false, 22) == "post")) {
                    // line 23
                    yield "      ";
                    // line 24
                    yield "      ";
                    $context["post"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, false, 24);
                    // line 25
                    yield "      ";
                    $context["pid"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 25, $this->source); })()), "id", [], "any", false, false, false, 25);
                    // line 26
                    yield "      ";
                    $context["aName"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 26, $this->source); })()), "userId", [], "any", false, false, false, 26), [], "array", true, true, false, 26) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 26, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 26, $this->source); })()), "userId", [], "any", false, false, false, 26), [], "array", false, false, false, 26)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 26, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 26, $this->source); })()), "userId", [], "any", false, false, false, 26), [], "array", false, false, false, 26)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 26, $this->source); })()), "userId", [], "any", false, false, false, 26));
                    // line 27
                    yield "      ";
                    $context["isOwner"] = ( !(null === (isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 27, $this->source); })())) && ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 27, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 27, $this->source); })()), "userId", [], "any", false, false, false, 27)));
                    // line 28
                    yield "      ";
                    $context["isSaved"] = CoreExtension::inFilter((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 28, $this->source); })()), (isset($context["savedPostIds"]) || array_key_exists("savedPostIds", $context) ? $context["savedPostIds"] : (function () { throw new RuntimeError('Variable "savedPostIds" does not exist.', 28, $this->source); })()));
                    // line 29
                    yield "      ";
                    $context["counts"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["reactionSummary"] ?? null), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 29, $this->source); })()), [], "array", true, true, false, 29) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionSummary"]) || array_key_exists("reactionSummary", $context) ? $context["reactionSummary"] : (function () { throw new RuntimeError('Variable "reactionSummary" does not exist.', 29, $this->source); })()), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 29, $this->source); })()), [], "array", false, false, false, 29)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["reactionSummary"]) || array_key_exists("reactionSummary", $context) ? $context["reactionSummary"] : (function () { throw new RuntimeError('Variable "reactionSummary" does not exist.', 29, $this->source); })()), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 29, $this->source); })()), [], "array", false, false, false, 29)) : (["like" => 0, "love" => 0, "haha" => 0, "wow" => 0, "sad" => 0, "angry" => 0]));
                    // line 30
                    yield "      ";
                    $context["myRxn"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["userReactions"] ?? null), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 30, $this->source); })()), [], "array", true, true, false, 30) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["userReactions"]) || array_key_exists("userReactions", $context) ? $context["userReactions"] : (function () { throw new RuntimeError('Variable "userReactions" does not exist.', 30, $this->source); })()), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 30, $this->source); })()), [], "array", false, false, false, 30)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["userReactions"]) || array_key_exists("userReactions", $context) ? $context["userReactions"] : (function () { throw new RuntimeError('Variable "userReactions" does not exist.', 30, $this->source); })()), (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 30, $this->source); })()), [], "array", false, false, false, 30)) : (""));
                    // line 31
                    yield "      ";
                    $context["total"] = (((((CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "like", [], "any", false, false, false, 31) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "love", [], "any", false, false, false, 31)) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "haha", [], "any", false, false, false, 31)) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "wow", [], "any", false, false, false, 31)) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "sad", [], "any", false, false, false, 31)) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 31, $this->source); })()), "angry", [], "any", false, false, false, 31));
                    // line 32
                    yield "      ";
                    $context["comments"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["post"] ?? null), "comments", [], "any", true, true, false, 32)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 32, $this->source); })()), "comments", [], "any", false, false, false, 32), [])) : ([]));
                    // line 33
                    yield "      ";
                    $context["nc"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["comments"]) || array_key_exists("comments", $context) ? $context["comments"] : (function () { throw new RuntimeError('Variable "comments" does not exist.', 33, $this->source); })()));
                    // line 34
                    yield "
      <article class=\"post-card\" data-feed-type=\"post\">
        <div class=\"pc-head\">
          <div class=\"pc-avatar\" data-uavatar=\"";
                    // line 37
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 37, $this->source); })()), "userId", [], "any", false, false, false, 37), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 37, $this->source); })()))), "html", null, true);
                    yield "</div>
          <div class=\"pc-head-main\">
            <div class=\"pc-name\" data-uname=\"";
                    // line 39
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 39, $this->source); })()), "userId", [], "any", false, false, false, 39), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 39, $this->source); })()), "html", null, true);
                    yield "</div>
            <div class=\"pc-date\">";
                    // line 40
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 40, $this->source); })()), "createdAt", [], "any", false, false, false, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 40, $this->source); })()), "createdAt", [], "any", false, false, false, 40), "M d, Y H:i"), "html", null, true);
                    }
                    yield "</div>
          </div>
          <span class=\"pc-badge b-";
                    // line 42
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 42, $this->source); })()), "type", [], "any", false, false, false, 42), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 42, $this->source); })()), "type", [], "any", false, false, false, 42), "html", null, true);
                    yield "</span>
          ";
                    // line 43
                    if ((($tmp = (isset($context["isOwner"]) || array_key_exists("isOwner", $context) ? $context["isOwner"] : (function () { throw new RuntimeError('Variable "isOwner" does not exist.', 43, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 44
                        yield "            <a href=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_edit", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 44, $this->source); })())]), "html", null, true);
                        yield "\" class=\"head-action-btn\" title=\"Edit post\">✏️</a>
            <form method=\"post\" action=\"";
                        // line 45
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_delete", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 45, $this->source); })())]), "html", null, true);
                        yield "\" class=\"inline-form\"
                  onsubmit=\"return confirm('Delete this post?');\">
              <input type=\"hidden\" name=\"_token\" value=\"";
                        // line 47
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_post_" . (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 47, $this->source); })()))), "html", null, true);
                        yield "\">
              <button type=\"submit\" class=\"head-action-btn head-danger\" title=\"Delete post\">🗑</button>
            </form>
          ";
                    }
                    // line 51
                    yield "        </div>

        <a href=\"";
                    // line 53
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 53, $this->source); })())]), "html", null, true);
                    yield "\" class=\"pc-title\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 53, $this->source); })()), "title", [], "any", false, false, false, 53), "html", null, true);
                    yield "</a>

        ";
                    // line 55
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 55, $this->source); })()), "imageUrl", [], "any", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 56
                        yield "          ";
                        $context["imgUrls"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 56, $this->source); })()), "imageUrl", [], "any", false, false, false, 56), ",");
                        // line 57
                        yield "          ";
                        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["imgUrls"]) || array_key_exists("imgUrls", $context) ? $context["imgUrls"] : (function () { throw new RuntimeError('Variable "imgUrls" does not exist.', 57, $this->source); })())) == 1)) {
                            // line 58
                            yield "            <div class=\"pc-imgwrap\">
              <img src=\"";
                            // line 59
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, (isset($context["imgUrls"]) || array_key_exists("imgUrls", $context) ? $context["imgUrls"] : (function () { throw new RuntimeError('Variable "imgUrls" does not exist.', 59, $this->source); })()), 0, [], "array", false, false, false, 59)), "html", null, true);
                            yield "\" class=\"pc-img\" alt=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 59, $this->source); })()), "title", [], "any", false, false, false, 59), "html", null, true);
                            yield "\"
                   loading=\"lazy\" onerror=\"this.parentElement.style.display='none'\">
            </div>
          ";
                        } else {
                            // line 63
                            yield "            <div class=\"pc-gridimgs cols-";
                            yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["imgUrls"]) || array_key_exists("imgUrls", $context) ? $context["imgUrls"] : (function () { throw new RuntimeError('Variable "imgUrls" does not exist.', 63, $this->source); })())) > 2)) ? (3) : (2));
                            yield "\">
              ";
                            // line 64
                            $context['_parent'] = $context;
                            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["imgUrls"]) || array_key_exists("imgUrls", $context) ? $context["imgUrls"] : (function () { throw new RuntimeError('Variable "imgUrls" does not exist.', 64, $this->source); })()), 0, 4));
                            foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                                // line 65
                                yield "                <img src=\"";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim($context["img"]), "html", null, true);
                                yield "\" alt=\"";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 65, $this->source); })()), "title", [], "any", false, false, false, 65), "html", null, true);
                                yield "\"
                     class=\"pc-gridimg\"
                     loading=\"lazy\" onerror=\"this.style.display='none'\">
              ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_key'], $context['img'], $context['_parent']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 69
                            yield "            </div>
          ";
                        }
                        // line 71
                        yield "        ";
                    }
                    // line 72
                    yield "
        <div class=\"pc-body\">";
                    // line 73
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 73, $this->source); })()), "body", [], "any", false, false, false, 73), "html", null, true);
                    yield "</div>
        <a href=\"";
                    // line 74
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_show", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 74, $this->source); })())]), "html", null, true);
                    yield "\" class=\"pc-read\">Read more →</a>

        <div class=\"pc-actions\">
          <div class=\"rxn-wrap\" id=\"rxnwrap-";
                    // line 77
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 77, $this->source); })()), "html", null, true);
                    yield "\">
            <button type=\"button\"
                    class=\"rxn-btn ";
                    // line 79
                    if ((($tmp = (isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 79, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield "reacted-";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 79, $this->source); })()), "html", null, true);
                    }
                    yield "\"
                    id=\"rxnbtn-";
                    // line 80
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 80, $this->source); })()), "html", null, true);
                    yield "\"
                    onclick=\"quickReact(";
                    // line 81
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 81, $this->source); })()), "html", null, true);
                    yield ", '";
                    yield (((isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 81, $this->source); })())) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["myRxn"], "html", null, true)) : (""));
                    yield "', 'post')\">
              <span id=\"rxnicon-";
                    // line 82
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 82, $this->source); })()), "html", null, true);
                    yield "\">
                ";
                    // line 83
                    if (((isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 83, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, ($context["rxnIcons"] ?? null), (isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 83, $this->source); })()), [], "array", true, true, false, 83))) {
                        // line 84
                        yield "                  ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rxnIcons"]) || array_key_exists("rxnIcons", $context) ? $context["rxnIcons"] : (function () { throw new RuntimeError('Variable "rxnIcons" does not exist.', 84, $this->source); })()), (isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 84, $this->source); })()), [], "array", false, false, false, 84), "html", null, true);
                        yield "
                ";
                    } else {
                        // line 85
                        yield "👍";
                    }
                    // line 86
                    yield "              </span>
              <span id=\"rxnlbl-";
                    // line 87
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 87, $this->source); })()), "html", null, true);
                    yield "\">
                ";
                    // line 88
                    if (((isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 88, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, ($context["rxnLabels"] ?? null), (isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 88, $this->source); })()), [], "array", true, true, false, 88))) {
                        // line 89
                        yield "                  ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rxnLabels"]) || array_key_exists("rxnLabels", $context) ? $context["rxnLabels"] : (function () { throw new RuntimeError('Variable "rxnLabels" does not exist.', 89, $this->source); })()), (isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 89, $this->source); })()), [], "array", false, false, false, 89), "html", null, true);
                        yield "
                ";
                    } else {
                        // line 90
                        yield "Like";
                    }
                    // line 91
                    yield "              </span>
              ";
                    // line 92
                    if (((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 92, $this->source); })()) > 0)) {
                        // line 93
                        yield "                <span class=\"rxn-count\" id=\"rxntotal-";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 93, $this->source); })()), "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 93, $this->source); })()), "html", null, true);
                        yield "</span>
              ";
                    } else {
                        // line 95
                        yield "                <span class=\"rxn-count\" id=\"rxntotal-";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 95, $this->source); })()), "html", null, true);
                        yield "\" style=\"display:none;\">0</span>
              ";
                    }
                    // line 97
                    yield "            </button>
            <div class=\"rxn-picker\">
              ";
                    // line 99
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rxnIcons"]) || array_key_exists("rxnIcons", $context) ? $context["rxnIcons"] : (function () { throw new RuntimeError('Variable "rxnIcons" does not exist.', 99, $this->source); })()));
                    foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
                        // line 100
                        yield "                <button type=\"button\"
                        class=\"emoji-btn ";
                        // line 101
                        if (((isset($context["myRxn"]) || array_key_exists("myRxn", $context) ? $context["myRxn"] : (function () { throw new RuntimeError('Variable "myRxn" does not exist.', 101, $this->source); })()) == $context["rtype"])) {
                            yield "active-emoji";
                        }
                        yield "\"
                        id=\"rxnopt-";
                        // line 102
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 102, $this->source); })()), "html", null, true);
                        yield "-";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["rtype"], "html", null, true);
                        yield "\"
                        onclick=\"sendReaction(";
                        // line 103
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 103, $this->source); })()), "html", null, true);
                        yield ", '";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["rtype"], "html", null, true);
                        yield "', 'post')\">
                  <span class=\"e\">";
                        // line 104
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                        yield "</span>
                  <span class=\"el\">";
                        // line 105
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rxnLabels"]) || array_key_exists("rxnLabels", $context) ? $context["rxnLabels"] : (function () { throw new RuntimeError('Variable "rxnLabels" does not exist.', 105, $this->source); })()), $context["rtype"], [], "array", false, false, false, 105), "html", null, true);
                        yield "</span>
                </button>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 108
                    yield "            </div>
          </div>

          <button type=\"button\" class=\"act-btn\" onclick=\"toggleC('c";
                    // line 111
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 111, $this->source); })()), "html", null, true);
                    yield "', this)\">
            💬 Comment
          </button>

          <form method=\"post\" action=\"";
                    // line 115
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_save_toggle", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 115, $this->source); })())]), "html", null, true);
                    yield "\" class=\"inline-form\">
            <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 116
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("save_post_" . (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 116, $this->source); })()))), "html", null, true);
                    yield "\">
            <button type=\"submit\" class=\"act-btn ";
                    // line 117
                    if ((($tmp = (isset($context["isSaved"]) || array_key_exists("isSaved", $context) ? $context["isSaved"] : (function () { throw new RuntimeError('Variable "isSaved" does not exist.', 117, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield "saved";
                    }
                    yield "\">
              🔖 ";
                    // line 118
                    yield (((($tmp = (isset($context["isSaved"]) || array_key_exists("isSaved", $context) ? $context["isSaved"] : (function () { throw new RuntimeError('Variable "isSaved" does not exist.', 118, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Saved") : ("Save"));
                    yield "
            </button>
          </form>

          <button type=\"button\" class=\"act-btn\"
                  onclick=\"sharePost('";
                    // line 123
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 123, $this->source); })()), "title", [], "any", false, false, false, 123), "js"), "html", null, true);
                    yield "', '";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("post_show", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 123, $this->source); })())]), "html", null, true);
                    yield "')\">
            🔗 Share
          </button>
        </div>

        ";
                    // line 128
                    if (((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 128, $this->source); })()) > 0)) {
                        // line 129
                        yield "          <div class=\"rxn-tally\">
            ";
                        // line 130
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rxnIcons"]) || array_key_exists("rxnIcons", $context) ? $context["rxnIcons"] : (function () { throw new RuntimeError('Variable "rxnIcons" does not exist.', 130, $this->source); })()));
                        foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
                            // line 131
                            yield "              ";
                            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["counts"] ?? null), $context["rtype"], [], "array", true, true, false, 131) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 131, $this->source); })()), $context["rtype"], [], "array", false, false, false, 131) > 0))) {
                                // line 132
                                yield "                <span>";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                                yield " ";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 132, $this->source); })()), $context["rtype"], [], "array", false, false, false, 132), "html", null, true);
                                yield "</span>
              ";
                            }
                            // line 134
                            yield "            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 135
                        yield "          </div>
        ";
                    }
                    // line 137
                    yield "
        <button type=\"button\" class=\"vcbtn\" onclick=\"toggleC('c";
                    // line 138
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 138, $this->source); })()), "html", null, true);
                    yield "', this)\">
          View comments (";
                    // line 139
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["nc"]) || array_key_exists("nc", $context) ? $context["nc"] : (function () { throw new RuntimeError('Variable "nc" does not exist.', 139, $this->source); })()), "html", null, true);
                    yield ")
        </button>

        <div id=\"c";
                    // line 142
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 142, $this->source); })()), "html", null, true);
                    yield "\" class=\"cbox\">
          <div class=\"cbox-inner\">

            ";
                    // line 145
                    $context["topComments"] = Twig\Extension\CoreExtension::filter($this->env, (isset($context["comments"]) || array_key_exists("comments", $context) ? $context["comments"] : (function () { throw new RuntimeError('Variable "comments" does not exist.', 145, $this->source); })()), function ($__c__) use ($context, $macros) { $context["c"] = $__c__; return ((null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["c"]) || array_key_exists("c", $context) ? $context["c"] : (function () { throw new RuntimeError('Variable "c" does not exist.', 145, $this->source); })()), "parentCommentId", [], "any", false, false, false, 145)) || (CoreExtension::getAttribute($this->env, $this->source, (isset($context["c"]) || array_key_exists("c", $context) ? $context["c"] : (function () { throw new RuntimeError('Variable "c" does not exist.', 145, $this->source); })()), "parentCommentId", [], "any", false, false, false, 145) == 0)); });
                    // line 146
                    yield "            ";
                    $context["allReplies"] = Twig\Extension\CoreExtension::filter($this->env, (isset($context["comments"]) || array_key_exists("comments", $context) ? $context["comments"] : (function () { throw new RuntimeError('Variable "comments" does not exist.', 146, $this->source); })()), function ($__c__) use ($context, $macros) { $context["c"] = $__c__; return ( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["c"]) || array_key_exists("c", $context) ? $context["c"] : (function () { throw new RuntimeError('Variable "c" does not exist.', 146, $this->source); })()), "parentCommentId", [], "any", false, false, false, 146)) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["c"]) || array_key_exists("c", $context) ? $context["c"] : (function () { throw new RuntimeError('Variable "c" does not exist.', 146, $this->source); })()), "parentCommentId", [], "any", false, false, false, 146) != 0)); });
                    // line 147
                    yield "
            ";
                    // line 148
                    if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["topComments"]) || array_key_exists("topComments", $context) ? $context["topComments"] : (function () { throw new RuntimeError('Variable "topComments" does not exist.', 148, $this->source); })())) > 0)) {
                        // line 149
                        yield "              ";
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["topComments"]) || array_key_exists("topComments", $context) ? $context["topComments"] : (function () { throw new RuntimeError('Variable "topComments" does not exist.', 149, $this->source); })()));
                        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                            // line 150
                            yield "                ";
                            $context["cn"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 150), [], "array", true, true, false, 150) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 150, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 150), [], "array", false, false, false, 150)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 150, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 150), [], "array", false, false, false, 150)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 150));
                            // line 151
                            yield "                ";
                            $context["commentReplies"] = Twig\Extension\CoreExtension::filter($this->env, (isset($context["allReplies"]) || array_key_exists("allReplies", $context) ? $context["allReplies"] : (function () { throw new RuntimeError('Variable "allReplies" does not exist.', 151, $this->source); })()), function ($__r__) use ($context, $macros) { $context["r"] = $__r__; return (CoreExtension::getAttribute($this->env, $this->source, (isset($context["r"]) || array_key_exists("r", $context) ? $context["r"] : (function () { throw new RuntimeError('Variable "r" does not exist.', 151, $this->source); })()), "parentCommentId", [], "any", false, false, false, 151) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 151)); });
                            // line 152
                            yield "
                <div class=\"crow\" id=\"comment-";
                            // line 153
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 153), "html", null, true);
                            yield "\">
                  <div class=\"cav\">";
                            // line 154
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["cn"]) || array_key_exists("cn", $context) ? $context["cn"] : (function () { throw new RuntimeError('Variable "cn" does not exist.', 154, $this->source); })()))), "html", null, true);
                            yield "</div>
                  <div class=\"cbubble\">
                    <div class=\"cn\" data-uname=\"";
                            // line 156
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 156), "html", null, true);
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["cn"]) || array_key_exists("cn", $context) ? $context["cn"] : (function () { throw new RuntimeError('Variable "cn" does not exist.', 156, $this->source); })()), "html", null, true);
                            yield "</div>
                    <div class=\"cb\" id=\"cbody-";
                            // line 157
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 157), "html", null, true);
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 157), "html", null, true);
                            yield "</div>

                    <div class=\"edit-form\" id=\"edit-";
                            // line 159
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 159), "html", null, true);
                            yield "\">
                      <form method=\"post\" action=\"";
                            // line 160
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 160)]), "html", null, true);
                            yield "\"
                            class=\"edit-inline-form\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
                            // line 162
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("edit_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 162))), "html", null, true);
                            yield "\">
                        <textarea name=\"body\" rows=\"1\"
                                  oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\">";
                            // line 164
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "body", [], "any", false, false, false, 164), "html", null, true);
                            yield "</textarea>
                        <button type=\"submit\" class=\"edit-send\">Save</button>
                        <button type=\"button\" class=\"edit-cancel\"
                                onclick=\"toggleEditForm('edit-";
                            // line 167
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 167), "html", null, true);
                            yield "')\">✕</button>
                      </form>
                    </div>

                    <div class=\"comment-actions\">
                      <div class=\"c-rxn-wrap\">
                        <button type=\"button\" class=\"ca-btn\" id=\"crxnbtn-";
                            // line 173
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 173), "html", null, true);
                            yield "\"
                                onclick=\"quickReact(";
                            // line 174
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 174), "html", null, true);
                            yield ", '', 'comment')\">👍 Like</button>
                        <div class=\"c-rxn-picker\">
                          ";
                            // line 176
                            $context['_parent'] = $context;
                            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rxnIcons"]) || array_key_exists("rxnIcons", $context) ? $context["rxnIcons"] : (function () { throw new RuntimeError('Variable "rxnIcons" does not exist.', 176, $this->source); })()));
                            foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
                                // line 177
                                yield "                            <button type=\"button\" class=\"c-emoji-btn\"
                                    onclick=\"sendReaction(";
                                // line 178
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 178), "html", null, true);
                                yield ", '";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["rtype"], "html", null, true);
                                yield "', 'comment')\"
                                    title=\"";
                                // line 179
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rxnLabels"]) || array_key_exists("rxnLabels", $context) ? $context["rxnLabels"] : (function () { throw new RuntimeError('Variable "rxnLabels" does not exist.', 179, $this->source); })()), $context["rtype"], [], "array", false, false, false, 179), "html", null, true);
                                yield "\">";
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                                yield "</button>
                          ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 181
                            yield "                        </div>
                      </div>
                      <span class=\"c-rxn-tally\" id=\"crxntally-";
                            // line 183
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 183), "html", null, true);
                            yield "\"></span>
                      <span class=\"ca-sep\">·</span>

                      <button type=\"button\" class=\"ca-btn\"
                              onclick=\"toggleReplyForm('reply-";
                            // line 187
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 187), "html", null, true);
                            yield "')\">💬 Reply</button>
                      <span class=\"ca-sep\">·</span>

                      <span class=\"comment-time\">
                        ";
                            // line 191
                            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 191)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 191), "M d · H:i"), "html", null, true);
                            }
                            // line 192
                            yield "                      </span>

                      ";
                            // line 194
                            if ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 194, $this->source); })()), "user", [], "any", false, false, false, 194)) &&  !(null === (isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 194, $this->source); })()))) && ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 194, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 194)))) {
                                // line 195
                                yield "                        <span class=\"ca-sep\">·</span>
                        <button type=\"button\" class=\"ca-btn\"
                                onclick=\"toggleEditForm('edit-";
                                // line 197
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 197), "html", null, true);
                                yield "')\">✏️ Edit</button>
                      ";
                            }
                            // line 199
                            yield "
                      ";
                            // line 200
                            if ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 200, $this->source); })()), "user", [], "any", false, false, false, 200)) &&  !(null === (isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 200, $this->source); })()))) && (((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 200, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "userId", [], "any", false, false, false, 200)) || ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 200, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 200, $this->source); })()), "userId", [], "any", false, false, false, 200))))) {
                                // line 201
                                yield "                        <span class=\"ca-sep\">·</span>
                        <form method=\"post\" action=\"";
                                // line 202
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 202)]), "html", null, true);
                                yield "\"
                              class=\"inline-form\" onsubmit=\"return confirm('Delete this comment and its replies?');\">
                          <input type=\"hidden\" name=\"_token\"
                                 value=\"";
                                // line 205
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 205))), "html", null, true);
                                yield "\">
                          <button type=\"submit\" class=\"ca-btn danger\">🗑 Delete</button>
                        </form>
                      ";
                            }
                            // line 209
                            yield "                    </div>
                  </div>
                </div>

                <div class=\"reply-form\" id=\"reply-";
                            // line 213
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 213), "html", null, true);
                            yield "\">
                  <form method=\"post\" action=\"";
                            // line 214
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 214, $this->source); })())]), "html", null, true);
                            yield "\">
                    <input type=\"hidden\" name=\"parent_comment_id\" value=\"";
                            // line 215
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 215), "html", null, true);
                            yield "\">
                    <div class=\"reply-form-inner\">
                      <textarea name=\"body\" rows=\"1\" required
                                placeholder=\"Reply to ";
                            // line 218
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["cn"]) || array_key_exists("cn", $context) ? $context["cn"] : (function () { throw new RuntimeError('Variable "cn" does not exist.', 218, $this->source); })()), " ")), "html", null, true);
                            yield "…\"
                                oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                      <button type=\"submit\" class=\"reply-send\">Reply</button>
                      <button type=\"button\" class=\"reply-cancel\"
                              onclick=\"toggleReplyForm('reply-";
                            // line 222
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 222), "html", null, true);
                            yield "')\">✕</button>
                    </div>
                  </form>
                </div>

                ";
                            // line 227
                            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["commentReplies"]) || array_key_exists("commentReplies", $context) ? $context["commentReplies"] : (function () { throw new RuntimeError('Variable "commentReplies" does not exist.', 227, $this->source); })())) > 0)) {
                                // line 228
                                yield "                  <button type=\"button\" class=\"replies-toggle\"
                          onclick=\"toggleReplies('replies-";
                                // line 229
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 229), "html", null, true);
                                yield "', this)\">
                    <span>▸</span> ";
                                // line 230
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["commentReplies"]) || array_key_exists("commentReplies", $context) ? $context["commentReplies"] : (function () { throw new RuntimeError('Variable "commentReplies" does not exist.', 230, $this->source); })())), "html", null, true);
                                yield " ";
                                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["commentReplies"]) || array_key_exists("commentReplies", $context) ? $context["commentReplies"] : (function () { throw new RuntimeError('Variable "commentReplies" does not exist.', 230, $this->source); })())) == 1)) ? ("reply") : ("replies"));
                                yield "
                  </button>
                  <div class=\"replies-wrap\" id=\"replies-";
                                // line 232
                                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 232), "html", null, true);
                                yield "\" style=\"display:none;\">
                    ";
                                // line 233
                                $context['_parent'] = $context;
                                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["commentReplies"]) || array_key_exists("commentReplies", $context) ? $context["commentReplies"] : (function () { throw new RuntimeError('Variable "commentReplies" does not exist.', 233, $this->source); })()));
                                foreach ($context['_seq'] as $context["_key"] => $context["reply"]) {
                                    // line 234
                                    yield "                      ";
                                    $context["rn"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 234), [], "array", true, true, false, 234) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 234, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 234), [], "array", false, false, false, 234)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 234, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 234), [], "array", false, false, false, 234)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 234));
                                    // line 235
                                    yield "
                      <div class=\"crow crow-reply\" id=\"comment-";
                                    // line 236
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 236), "html", null, true);
                                    yield "\">
                        <div class=\"cav cav-small\">";
                                    // line 237
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["rn"]) || array_key_exists("rn", $context) ? $context["rn"] : (function () { throw new RuntimeError('Variable "rn" does not exist.', 237, $this->source); })()))), "html", null, true);
                                    yield "</div>
                        <div class=\"cbubble\">
                          <div class=\"cn\" data-uname=\"";
                                    // line 239
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 239), "html", null, true);
                                    yield "\">";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["rn"]) || array_key_exists("rn", $context) ? $context["rn"] : (function () { throw new RuntimeError('Variable "rn" does not exist.', 239, $this->source); })()), "html", null, true);
                                    yield "</div>
                          <div class=\"cb\" id=\"cbody-";
                                    // line 240
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 240), "html", null, true);
                                    yield "\">";
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "body", [], "any", false, false, false, 240), "html", null, true);
                                    yield "</div>

                          <div class=\"edit-form\" id=\"edit-";
                                    // line 242
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 242), "html", null, true);
                                    yield "\">
                            <form method=\"post\" action=\"";
                                    // line 243
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 243)]), "html", null, true);
                                    yield "\"
                                  class=\"edit-inline-form\">
                              <input type=\"hidden\" name=\"_token\" value=\"";
                                    // line 245
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("edit_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 245))), "html", null, true);
                                    yield "\">
                              <textarea name=\"body\" rows=\"1\"
                                        oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\">";
                                    // line 247
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "body", [], "any", false, false, false, 247), "html", null, true);
                                    yield "</textarea>
                              <button type=\"submit\" class=\"edit-send\">Save</button>
                              <button type=\"button\" class=\"edit-cancel\"
                                      onclick=\"toggleEditForm('edit-";
                                    // line 250
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 250), "html", null, true);
                                    yield "')\">✕</button>
                            </form>
                          </div>

                          <div class=\"comment-actions\">
                            <div class=\"c-rxn-wrap\">
                              <button type=\"button\" class=\"ca-btn\" id=\"crxnbtn-";
                                    // line 256
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 256), "html", null, true);
                                    yield "\"
                                      onclick=\"quickReact(";
                                    // line 257
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 257), "html", null, true);
                                    yield ", '', 'comment')\">👍 Like</button>
                              <div class=\"c-rxn-picker\">
                                ";
                                    // line 259
                                    $context['_parent'] = $context;
                                    $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rxnIcons"]) || array_key_exists("rxnIcons", $context) ? $context["rxnIcons"] : (function () { throw new RuntimeError('Variable "rxnIcons" does not exist.', 259, $this->source); })()));
                                    foreach ($context['_seq'] as $context["rtype"] => $context["emoji"]) {
                                        // line 260
                                        yield "                                  <button type=\"button\" class=\"c-emoji-btn\"
                                          onclick=\"sendReaction(";
                                        // line 261
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 261), "html", null, true);
                                        yield ", '";
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["rtype"], "html", null, true);
                                        yield "', 'comment')\"
                                          title=\"";
                                        // line 262
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rxnLabels"]) || array_key_exists("rxnLabels", $context) ? $context["rxnLabels"] : (function () { throw new RuntimeError('Variable "rxnLabels" does not exist.', 262, $this->source); })()), $context["rtype"], [], "array", false, false, false, 262), "html", null, true);
                                        yield "\">";
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                                        yield "</button>
                                ";
                                    }
                                    $_parent = $context['_parent'];
                                    unset($context['_seq'], $context['rtype'], $context['emoji'], $context['_parent']);
                                    $context = array_intersect_key($context, $_parent) + $_parent;
                                    // line 264
                                    yield "                              </div>
                            </div>
                            <span class=\"c-rxn-tally\" id=\"crxntally-";
                                    // line 266
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 266), "html", null, true);
                                    yield "\"></span>
                            <span class=\"ca-sep\">·</span>

                            <button type=\"button\" class=\"ca-btn\"
                                    onclick=\"toggleReplyForm('reply-";
                                    // line 270
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 270), "html", null, true);
                                    yield "')\">💬 Reply</button>
                            <span class=\"ca-sep\">·</span>

                            <span class=\"comment-time\">
                              ";
                                    // line 274
                                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "createdAt", [], "any", false, false, false, 274)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "createdAt", [], "any", false, false, false, 274), "M d · H:i"), "html", null, true);
                                    }
                                    // line 275
                                    yield "                            </span>

                            ";
                                    // line 277
                                    if ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 277, $this->source); })()), "user", [], "any", false, false, false, 277)) &&  !(null === (isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 277, $this->source); })()))) && ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 277, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 277)))) {
                                        // line 278
                                        yield "                              <span class=\"ca-sep\">·</span>
                              <button type=\"button\" class=\"ca-btn\"
                                      onclick=\"toggleEditForm('edit-";
                                        // line 280
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 280), "html", null, true);
                                        yield "')\">✏️ Edit</button>
                            ";
                                    }
                                    // line 282
                                    yield "
                            ";
                                    // line 283
                                    if ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 283, $this->source); })()), "user", [], "any", false, false, false, 283)) &&  !(null === (isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 283, $this->source); })()))) && (((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 283, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "userId", [], "any", false, false, false, 283)) || ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 283, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 283, $this->source); })()), "userId", [], "any", false, false, false, 283))))) {
                                        // line 284
                                        yield "                              <span class=\"ca-sep\">·</span>
                              <form method=\"post\" action=\"";
                                        // line 285
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 285)]), "html", null, true);
                                        yield "\"
                                    class=\"inline-form\" onsubmit=\"return confirm('Delete this reply?');\">
                                <input type=\"hidden\" name=\"_token\"
                                       value=\"";
                                        // line 288
                                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_comment_" . CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 288))), "html", null, true);
                                        yield "\">
                                <button type=\"submit\" class=\"ca-btn danger\">🗑 Delete</button>
                              </form>
                            ";
                                    }
                                    // line 292
                                    yield "                          </div>
                        </div>
                      </div>

                      <div class=\"reply-form reply-form-nested\" id=\"reply-";
                                    // line 296
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 296), "html", null, true);
                                    yield "\">
                        <form method=\"post\" action=\"";
                                    // line 297
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 297, $this->source); })())]), "html", null, true);
                                    yield "\">
                          <input type=\"hidden\" name=\"parent_comment_id\" value=\"";
                                    // line 298
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 298), "html", null, true);
                                    yield "\">
                          <div class=\"reply-form-inner\">
                            <textarea name=\"body\" rows=\"1\" required
                                      placeholder=\"Reply to ";
                                    // line 301
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["rn"]) || array_key_exists("rn", $context) ? $context["rn"] : (function () { throw new RuntimeError('Variable "rn" does not exist.', 301, $this->source); })()), " ")), "html", null, true);
                                    yield "…\"
                                      oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                            <button type=\"submit\" class=\"reply-send\">Reply</button>
                            <button type=\"button\" class=\"reply-cancel\"
                                    onclick=\"toggleReplyForm('reply-";
                                    // line 305
                                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 305), "html", null, true);
                                    yield "')\">✕</button>
                          </div>
                        </form>
                      </div>
                    ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_key'], $context['reply'], $context['_parent']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 310
                                yield "                  </div>
                ";
                            }
                            // line 312
                            yield "              ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 313
                        yield "            ";
                    } else {
                        // line 314
                        yield "              <p class=\"no-comments\">
                No comments yet — start the conversation!
              </p>
            ";
                    }
                    // line 318
                    yield "
            <form method=\"post\" action=\"";
                    // line 319
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_create", ["id" => (isset($context["pid"]) || array_key_exists("pid", $context) ? $context["pid"] : (function () { throw new RuntimeError('Variable "pid" does not exist.', 319, $this->source); })())]), "html", null, true);
                    yield "\">
              <div class=\"cform-row\">
                <textarea name=\"body\" rows=\"1\" placeholder=\"Write a comment…\" required
                          oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                <button type=\"submit\" class=\"csend\">Post</button>
              </div>
            </form>

          </div>
        </div>
      </article>

    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 331
$context["item"], "feedType", [], "any", false, false, false, 331) == "travel_story")) {
                    // line 332
                    yield "      ";
                    // line 333
                    yield "      ";
                    $context["story"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, false, 333);
                    // line 334
                    yield "      ";
                    $context["aName"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 334, $this->source); })()), "userId", [], "any", false, false, false, 334), [], "array", true, true, false, 334) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 334, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 334, $this->source); })()), "userId", [], "any", false, false, false, 334), [], "array", false, false, false, 334)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 334, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 334, $this->source); })()), "userId", [], "any", false, false, false, 334), [], "array", false, false, false, 334)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 334, $this->source); })()), "userId", [], "any", false, false, false, 334));
                    // line 335
                    yield "
      <article class=\"post-card ts-card\" data-feed-type=\"travel_story\">
        <div class=\"pc-head\">
          <div class=\"pc-avatar\" data-uavatar=\"";
                    // line 338
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 338, $this->source); })()), "userId", [], "any", false, false, false, 338), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 338, $this->source); })()))), "html", null, true);
                    yield "</div>
          <div class=\"pc-head-main\">
            <div class=\"pc-name\" data-uname=\"";
                    // line 340
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 340, $this->source); })()), "userId", [], "any", false, false, false, 340), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 340, $this->source); })()), "html", null, true);
                    yield "</div>
            <div class=\"pc-date\">";
                    // line 341
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 341, $this->source); })()), "createdAt", [], "any", false, false, false, 341)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 341, $this->source); })()), "createdAt", [], "any", false, false, false, 341), "M d, Y H:i"), "html", null, true);
                    }
                    yield "</div>
          </div>
          <span class=\"pc-badge b-travel_story\">🧳 Travel Story</span>
        </div>

        <a href=\"";
                    // line 346
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 346, $this->source); })()), "id", [], "any", false, false, false, 346)]), "html", null, true);
                    yield "\" class=\"pc-title\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 346, $this->source); })()), "title", [], "any", false, false, false, 346), "html", null, true);
                    yield "</a>

        ";
                    // line 348
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 348, $this->source); })()), "destination", [], "any", false, false, false, 348)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 349
                        yield "          <div class=\"ts-destination\">📍 ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 349, $this->source); })()), "destination", [], "any", false, false, false, 349), "html", null, true);
                        yield "</div>
        ";
                    }
                    // line 351
                    yield "
        ";
                    // line 352
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 352, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 352)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 353
                        yield "          <div class=\"pc-imgwrap\">
            <img src=\"";
                        // line 354
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 354, $this->source); })()), "coverImageUrl", [], "any", false, false, false, 354), "html", null, true);
                        yield "\" class=\"pc-img\" alt=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 354, $this->source); })()), "title", [], "any", false, false, false, 354), "html", null, true);
                        yield "\"
                 loading=\"lazy\" onerror=\"this.parentElement.style.display='none'\">
          </div>
        ";
                    }
                    // line 358
                    yield "
        ";
                    // line 359
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 359, $this->source); })()), "summary", [], "any", false, false, false, 359)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 360
                        yield "          <div class=\"pc-body\">";
                        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 360, $this->source); })()), "summary", [], "any", false, false, false, 360)) > 300)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 360, $this->source); })()), "summary", [], "any", false, false, false, 360), 0, 300) . "…"), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 360, $this->source); })()), "summary", [], "any", false, false, false, 360), "html", null, true)));
                        yield "</div>
        ";
                    }
                    // line 362
                    yield "
        <div class=\"ts-meta\">
          ";
                    // line 364
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 364, $this->source); })()), "overallRating", [], "any", false, false, false, 364)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 365
                        yield "            <span class=\"ts-tag\">⭐ ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 365, $this->source); })()), "overallRating", [], "any", false, false, false, 365), "html", null, true);
                        yield "/5</span>
          ";
                    }
                    // line 367
                    yield "          ";
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 367, $this->source); })()), "travelType", [], "any", false, false, false, 367)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 368
                        yield "            <span class=\"ts-tag\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 368, $this->source); })()), "travelType", [], "any", false, false, false, 368)), "html", null, true);
                        yield "</span>
          ";
                    }
                    // line 370
                    yield "          ";
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 370, $this->source); })()), "travelStyle", [], "any", false, false, false, 370)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 371
                        yield "            <span class=\"ts-tag\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 371, $this->source); })()), "travelStyle", [], "any", false, false, false, 371)), "html", null, true);
                        yield "</span>
          ";
                    }
                    // line 373
                    yield "          ";
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 373, $this->source); })()), "totalBudget", [], "any", false, false, false, 373)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 374
                        yield "            <span class=\"ts-tag\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 374, $this->source); })()), "currency", [], "any", false, false, false, 374), "html", null, true);
                        yield " ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 374, $this->source); })()), "totalBudget", [], "any", false, false, false, 374), "html", null, true);
                        yield "</span>
          ";
                    }
                    // line 376
                    yield "        </div>

        <a href=\"";
                    // line 378
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 378, $this->source); })()), "id", [], "any", false, false, false, 378)]), "html", null, true);
                    yield "\" class=\"pc-read\">Read full story →</a>

        <div class=\"pc-actions\">
          <button type=\"button\" class=\"act-btn\"
                  onclick=\"sharePost('";
                    // line 382
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 382, $this->source); })()), "title", [], "any", false, false, false, 382), "js"), "html", null, true);
                    yield "', '";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["story"]) || array_key_exists("story", $context) ? $context["story"] : (function () { throw new RuntimeError('Variable "story" does not exist.', 382, $this->source); })()), "id", [], "any", false, false, false, 382)]), "html", null, true);
                    yield "')\">
            🔗 Share
          </button>
        </div>
      </article>
    ";
                }
                // line 388
                yield "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/blog/_feed_items.html.twig";
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
        return array (  1048 => 388,  1037 => 382,  1030 => 378,  1026 => 376,  1018 => 374,  1015 => 373,  1009 => 371,  1006 => 370,  1000 => 368,  997 => 367,  991 => 365,  989 => 364,  985 => 362,  979 => 360,  977 => 359,  974 => 358,  965 => 354,  962 => 353,  960 => 352,  957 => 351,  951 => 349,  949 => 348,  942 => 346,  932 => 341,  926 => 340,  919 => 338,  914 => 335,  911 => 334,  908 => 333,  906 => 332,  904 => 331,  889 => 319,  886 => 318,  880 => 314,  877 => 313,  871 => 312,  867 => 310,  856 => 305,  849 => 301,  843 => 298,  839 => 297,  835 => 296,  829 => 292,  822 => 288,  816 => 285,  813 => 284,  811 => 283,  808 => 282,  803 => 280,  799 => 278,  797 => 277,  793 => 275,  789 => 274,  782 => 270,  775 => 266,  771 => 264,  761 => 262,  755 => 261,  752 => 260,  748 => 259,  743 => 257,  739 => 256,  730 => 250,  724 => 247,  719 => 245,  714 => 243,  710 => 242,  703 => 240,  697 => 239,  692 => 237,  688 => 236,  685 => 235,  682 => 234,  678 => 233,  674 => 232,  667 => 230,  663 => 229,  660 => 228,  658 => 227,  650 => 222,  643 => 218,  637 => 215,  633 => 214,  629 => 213,  623 => 209,  616 => 205,  610 => 202,  607 => 201,  605 => 200,  602 => 199,  597 => 197,  593 => 195,  591 => 194,  587 => 192,  583 => 191,  576 => 187,  569 => 183,  565 => 181,  555 => 179,  549 => 178,  546 => 177,  542 => 176,  537 => 174,  533 => 173,  524 => 167,  518 => 164,  513 => 162,  508 => 160,  504 => 159,  497 => 157,  491 => 156,  486 => 154,  482 => 153,  479 => 152,  476 => 151,  473 => 150,  468 => 149,  466 => 148,  463 => 147,  460 => 146,  458 => 145,  452 => 142,  446 => 139,  442 => 138,  439 => 137,  435 => 135,  429 => 134,  421 => 132,  418 => 131,  414 => 130,  411 => 129,  409 => 128,  399 => 123,  391 => 118,  385 => 117,  381 => 116,  377 => 115,  370 => 111,  365 => 108,  356 => 105,  352 => 104,  346 => 103,  340 => 102,  334 => 101,  331 => 100,  327 => 99,  323 => 97,  317 => 95,  309 => 93,  307 => 92,  304 => 91,  301 => 90,  295 => 89,  293 => 88,  289 => 87,  286 => 86,  283 => 85,  277 => 84,  275 => 83,  271 => 82,  265 => 81,  261 => 80,  254 => 79,  249 => 77,  243 => 74,  239 => 73,  236 => 72,  233 => 71,  229 => 69,  216 => 65,  212 => 64,  207 => 63,  198 => 59,  195 => 58,  192 => 57,  189 => 56,  187 => 55,  180 => 53,  176 => 51,  169 => 47,  164 => 45,  159 => 44,  157 => 43,  151 => 42,  144 => 40,  138 => 39,  131 => 37,  126 => 34,  123 => 33,  120 => 32,  117 => 31,  114 => 30,  111 => 29,  108 => 28,  105 => 27,  102 => 26,  99 => 25,  96 => 24,  94 => 23,  91 => 22,  86 => 21,  79 => 17,  75 => 16,  69 => 12,  67 => 11,  64 => 10,  62 => 9,  60 => 8,  57 => 7,  55 => 6,  53 => 5,  51 => 4,  49 => 3,  47 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% set authorMap       = authorMap       is defined ? authorMap       : {} %}
{% set savedPostIds    = savedPostIds    is defined ? savedPostIds    : [] %}
{% set currentUserId   = currentUserId   is defined ? currentUserId   : null %}
{% set reactionSummary = reactionSummary is defined ? reactionSummary : {} %}
{% set userReactions   = userReactions   is defined ? userReactions   : {} %}
{% set feed            = feed            is defined ? feed            : [] %}

{% set rxnIcons  = {like:'👍',love:'❤️',haha:'😂',wow:'😮',sad:'😢',angry:'😡'} %}
{% set rxnLabels = {like:'Like',love:'Love',haha:'Haha',wow:'Wow',sad:'Sad',angry:'Angry'} %}

{% if feed is empty %}
  <div class=\"empty-state\">
    <span class=\"ei\">✈️</span>
    <h3>No posts found</h3>
    <p>
      <a href=\"{{ path('blog') }}\" class=\"tpill-link\" data-type=\"\" data-search=\"\">Clear filters</a> or
      <a href=\"{{ path('post_create') }}\">create the first post!</a>
    </p>
  </div>
{% else %}
  {% for item in feed %}
    {% if item.feedType == 'post' %}
      {# ─── POST CARD ─────────────────────────────────────── #}
      {% set post   = item.entity %}
      {% set pid    = post.id %}
      {% set aName  = authorMap[post.userId] ?? 'User #' ~ post.userId %}
      {% set isOwner = (currentUserId is not null and currentUserId == post.userId) %}
      {% set isSaved = pid in savedPostIds %}
      {% set counts = reactionSummary[pid] ?? {like:0,love:0,haha:0,wow:0,sad:0,angry:0} %}
      {% set myRxn  = userReactions[pid] ?? '' %}
      {% set total  = counts.like + counts.love + counts.haha + counts.wow + counts.sad + counts.angry %}
      {% set comments = post.comments|default([]) %}
      {% set nc = comments|length %}

      <article class=\"post-card\" data-feed-type=\"post\">
        <div class=\"pc-head\">
          <div class=\"pc-avatar\" data-uavatar=\"{{ post.userId }}\">{{ aName|first|upper }}</div>
          <div class=\"pc-head-main\">
            <div class=\"pc-name\" data-uname=\"{{ post.userId }}\">{{ aName }}</div>
            <div class=\"pc-date\">{% if post.createdAt %}{{ post.createdAt|date('M d, Y H:i') }}{% endif %}</div>
          </div>
          <span class=\"pc-badge b-{{ post.type }}\">{{ post.type }}</span>
          {% if isOwner %}
            <a href=\"{{ path('post_edit', {id: pid}) }}\" class=\"head-action-btn\" title=\"Edit post\">✏️</a>
            <form method=\"post\" action=\"{{ path('post_delete', {id: pid}) }}\" class=\"inline-form\"
                  onsubmit=\"return confirm('Delete this post?');\">
              <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_post_' ~ pid) }}\">
              <button type=\"submit\" class=\"head-action-btn head-danger\" title=\"Delete post\">🗑</button>
            </form>
          {% endif %}
        </div>

        <a href=\"{{ path('post_show', {id: pid}) }}\" class=\"pc-title\">{{ post.title }}</a>

        {% if post.imageUrl %}
          {% set imgUrls = post.imageUrl|split(',') %}
          {% if imgUrls|length == 1 %}
            <div class=\"pc-imgwrap\">
              <img src=\"{{ imgUrls[0]|trim }}\" class=\"pc-img\" alt=\"{{ post.title }}\"
                   loading=\"lazy\" onerror=\"this.parentElement.style.display='none'\">
            </div>
          {% else %}
            <div class=\"pc-gridimgs cols-{{ imgUrls|length > 2 ? 3 : 2 }}\">
              {% for img in imgUrls|slice(0,4) %}
                <img src=\"{{ img|trim }}\" alt=\"{{ post.title }}\"
                     class=\"pc-gridimg\"
                     loading=\"lazy\" onerror=\"this.style.display='none'\">
              {% endfor %}
            </div>
          {% endif %}
        {% endif %}

        <div class=\"pc-body\">{{ post.body }}</div>
        <a href=\"{{ path('post_show', {id: pid}) }}\" class=\"pc-read\">Read more →</a>

        <div class=\"pc-actions\">
          <div class=\"rxn-wrap\" id=\"rxnwrap-{{ pid }}\">
            <button type=\"button\"
                    class=\"rxn-btn {% if myRxn %}reacted-{{ myRxn }}{% endif %}\"
                    id=\"rxnbtn-{{ pid }}\"
                    onclick=\"quickReact({{ pid }}, '{{ myRxn ?: '' }}', 'post')\">
              <span id=\"rxnicon-{{ pid }}\">
                {% if myRxn and rxnIcons[myRxn] is defined %}
                  {{ rxnIcons[myRxn] }}
                {% else %}👍{% endif %}
              </span>
              <span id=\"rxnlbl-{{ pid }}\">
                {% if myRxn and rxnLabels[myRxn] is defined %}
                  {{ rxnLabels[myRxn] }}
                {% else %}Like{% endif %}
              </span>
              {% if total > 0 %}
                <span class=\"rxn-count\" id=\"rxntotal-{{ pid }}\">{{ total }}</span>
              {% else %}
                <span class=\"rxn-count\" id=\"rxntotal-{{ pid }}\" style=\"display:none;\">0</span>
              {% endif %}
            </button>
            <div class=\"rxn-picker\">
              {% for rtype, emoji in rxnIcons %}
                <button type=\"button\"
                        class=\"emoji-btn {% if myRxn == rtype %}active-emoji{% endif %}\"
                        id=\"rxnopt-{{ pid }}-{{ rtype }}\"
                        onclick=\"sendReaction({{ pid }}, '{{ rtype }}', 'post')\">
                  <span class=\"e\">{{ emoji }}</span>
                  <span class=\"el\">{{ rxnLabels[rtype] }}</span>
                </button>
              {% endfor %}
            </div>
          </div>

          <button type=\"button\" class=\"act-btn\" onclick=\"toggleC('c{{ pid }}', this)\">
            💬 Comment
          </button>

          <form method=\"post\" action=\"{{ path('post_save_toggle', {id: pid}) }}\" class=\"inline-form\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('save_post_' ~ pid) }}\">
            <button type=\"submit\" class=\"act-btn {% if isSaved %}saved{% endif %}\">
              🔖 {{ isSaved ? 'Saved' : 'Save' }}
            </button>
          </form>

          <button type=\"button\" class=\"act-btn\"
                  onclick=\"sharePost('{{ post.title|e('js') }}', '{{ url('post_show', {id: pid}) }}')\">
            🔗 Share
          </button>
        </div>

        {% if total > 0 %}
          <div class=\"rxn-tally\">
            {% for rtype, emoji in rxnIcons %}
              {% if counts[rtype] is defined and counts[rtype] > 0 %}
                <span>{{ emoji }} {{ counts[rtype] }}</span>
              {% endif %}
            {% endfor %}
          </div>
        {% endif %}

        <button type=\"button\" class=\"vcbtn\" onclick=\"toggleC('c{{ pid }}', this)\">
          View comments ({{ nc }})
        </button>

        <div id=\"c{{ pid }}\" class=\"cbox\">
          <div class=\"cbox-inner\">

            {% set topComments = comments|filter(c => c.parentCommentId is null or c.parentCommentId == 0) %}
            {% set allReplies  = comments|filter(c => c.parentCommentId is not null and c.parentCommentId != 0) %}

            {% if topComments|length > 0 %}
              {% for comment in topComments %}
                {% set cn = authorMap[comment.userId] ?? 'User #' ~ comment.userId %}
                {% set commentReplies = allReplies|filter(r => r.parentCommentId == comment.id) %}

                <div class=\"crow\" id=\"comment-{{ comment.id }}\">
                  <div class=\"cav\">{{ cn|first|upper }}</div>
                  <div class=\"cbubble\">
                    <div class=\"cn\" data-uname=\"{{ comment.userId }}\">{{ cn }}</div>
                    <div class=\"cb\" id=\"cbody-{{ comment.id }}\">{{ comment.body }}</div>

                    <div class=\"edit-form\" id=\"edit-{{ comment.id }}\">
                      <form method=\"post\" action=\"{{ path('comment_edit', {id: comment.id}) }}\"
                            class=\"edit-inline-form\">
                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('edit_comment_' ~ comment.id) }}\">
                        <textarea name=\"body\" rows=\"1\"
                                  oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\">{{ comment.body }}</textarea>
                        <button type=\"submit\" class=\"edit-send\">Save</button>
                        <button type=\"button\" class=\"edit-cancel\"
                                onclick=\"toggleEditForm('edit-{{ comment.id }}')\">✕</button>
                      </form>
                    </div>

                    <div class=\"comment-actions\">
                      <div class=\"c-rxn-wrap\">
                        <button type=\"button\" class=\"ca-btn\" id=\"crxnbtn-{{ comment.id }}\"
                                onclick=\"quickReact({{ comment.id }}, '', 'comment')\">👍 Like</button>
                        <div class=\"c-rxn-picker\">
                          {% for rtype, emoji in rxnIcons %}
                            <button type=\"button\" class=\"c-emoji-btn\"
                                    onclick=\"sendReaction({{ comment.id }}, '{{ rtype }}', 'comment')\"
                                    title=\"{{ rxnLabels[rtype] }}\">{{ emoji }}</button>
                          {% endfor %}
                        </div>
                      </div>
                      <span class=\"c-rxn-tally\" id=\"crxntally-{{ comment.id }}\"></span>
                      <span class=\"ca-sep\">·</span>

                      <button type=\"button\" class=\"ca-btn\"
                              onclick=\"toggleReplyForm('reply-{{ comment.id }}')\">💬 Reply</button>
                      <span class=\"ca-sep\">·</span>

                      <span class=\"comment-time\">
                        {% if comment.createdAt %}{{ comment.createdAt|date('M d · H:i') }}{% endif %}
                      </span>

                      {% if app.user is not null and currentUserId is not null and currentUserId == comment.userId %}
                        <span class=\"ca-sep\">·</span>
                        <button type=\"button\" class=\"ca-btn\"
                                onclick=\"toggleEditForm('edit-{{ comment.id }}')\">✏️ Edit</button>
                      {% endif %}

                      {% if app.user is not null and currentUserId is not null and (currentUserId == comment.userId or currentUserId == post.userId) %}
                        <span class=\"ca-sep\">·</span>
                        <form method=\"post\" action=\"{{ path('comment_delete', {id: comment.id}) }}\"
                              class=\"inline-form\" onsubmit=\"return confirm('Delete this comment and its replies?');\">
                          <input type=\"hidden\" name=\"_token\"
                                 value=\"{{ csrf_token('delete_comment_' ~ comment.id) }}\">
                          <button type=\"submit\" class=\"ca-btn danger\">🗑 Delete</button>
                        </form>
                      {% endif %}
                    </div>
                  </div>
                </div>

                <div class=\"reply-form\" id=\"reply-{{ comment.id }}\">
                  <form method=\"post\" action=\"{{ path('comment_create', {id: pid}) }}\">
                    <input type=\"hidden\" name=\"parent_comment_id\" value=\"{{ comment.id }}\">
                    <div class=\"reply-form-inner\">
                      <textarea name=\"body\" rows=\"1\" required
                                placeholder=\"Reply to {{ cn|split(' ')|first }}…\"
                                oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                      <button type=\"submit\" class=\"reply-send\">Reply</button>
                      <button type=\"button\" class=\"reply-cancel\"
                              onclick=\"toggleReplyForm('reply-{{ comment.id }}')\">✕</button>
                    </div>
                  </form>
                </div>

                {% if commentReplies|length > 0 %}
                  <button type=\"button\" class=\"replies-toggle\"
                          onclick=\"toggleReplies('replies-{{ comment.id }}', this)\">
                    <span>▸</span> {{ commentReplies|length }} {{ commentReplies|length == 1 ? 'reply' : 'replies' }}
                  </button>
                  <div class=\"replies-wrap\" id=\"replies-{{ comment.id }}\" style=\"display:none;\">
                    {% for reply in commentReplies %}
                      {% set rn = authorMap[reply.userId] ?? 'User #' ~ reply.userId %}

                      <div class=\"crow crow-reply\" id=\"comment-{{ reply.id }}\">
                        <div class=\"cav cav-small\">{{ rn|first|upper }}</div>
                        <div class=\"cbubble\">
                          <div class=\"cn\" data-uname=\"{{ reply.userId }}\">{{ rn }}</div>
                          <div class=\"cb\" id=\"cbody-{{ reply.id }}\">{{ reply.body }}</div>

                          <div class=\"edit-form\" id=\"edit-{{ reply.id }}\">
                            <form method=\"post\" action=\"{{ path('comment_edit', {id: reply.id}) }}\"
                                  class=\"edit-inline-form\">
                              <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('edit_comment_' ~ reply.id) }}\">
                              <textarea name=\"body\" rows=\"1\"
                                        oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\">{{ reply.body }}</textarea>
                              <button type=\"submit\" class=\"edit-send\">Save</button>
                              <button type=\"button\" class=\"edit-cancel\"
                                      onclick=\"toggleEditForm('edit-{{ reply.id }}')\">✕</button>
                            </form>
                          </div>

                          <div class=\"comment-actions\">
                            <div class=\"c-rxn-wrap\">
                              <button type=\"button\" class=\"ca-btn\" id=\"crxnbtn-{{ reply.id }}\"
                                      onclick=\"quickReact({{ reply.id }}, '', 'comment')\">👍 Like</button>
                              <div class=\"c-rxn-picker\">
                                {% for rtype, emoji in rxnIcons %}
                                  <button type=\"button\" class=\"c-emoji-btn\"
                                          onclick=\"sendReaction({{ reply.id }}, '{{ rtype }}', 'comment')\"
                                          title=\"{{ rxnLabels[rtype] }}\">{{ emoji }}</button>
                                {% endfor %}
                              </div>
                            </div>
                            <span class=\"c-rxn-tally\" id=\"crxntally-{{ reply.id }}\"></span>
                            <span class=\"ca-sep\">·</span>

                            <button type=\"button\" class=\"ca-btn\"
                                    onclick=\"toggleReplyForm('reply-{{ reply.id }}')\">💬 Reply</button>
                            <span class=\"ca-sep\">·</span>

                            <span class=\"comment-time\">
                              {% if reply.createdAt %}{{ reply.createdAt|date('M d · H:i') }}{% endif %}
                            </span>

                            {% if app.user is not null and currentUserId is not null and currentUserId == reply.userId %}
                              <span class=\"ca-sep\">·</span>
                              <button type=\"button\" class=\"ca-btn\"
                                      onclick=\"toggleEditForm('edit-{{ reply.id }}')\">✏️ Edit</button>
                            {% endif %}

                            {% if app.user is not null and currentUserId is not null and (currentUserId == reply.userId or currentUserId == post.userId) %}
                              <span class=\"ca-sep\">·</span>
                              <form method=\"post\" action=\"{{ path('comment_delete', {id: reply.id}) }}\"
                                    class=\"inline-form\" onsubmit=\"return confirm('Delete this reply?');\">
                                <input type=\"hidden\" name=\"_token\"
                                       value=\"{{ csrf_token('delete_comment_' ~ reply.id) }}\">
                                <button type=\"submit\" class=\"ca-btn danger\">🗑 Delete</button>
                              </form>
                            {% endif %}
                          </div>
                        </div>
                      </div>

                      <div class=\"reply-form reply-form-nested\" id=\"reply-{{ reply.id }}\">
                        <form method=\"post\" action=\"{{ path('comment_create', {id: pid}) }}\">
                          <input type=\"hidden\" name=\"parent_comment_id\" value=\"{{ reply.id }}\">
                          <div class=\"reply-form-inner\">
                            <textarea name=\"body\" rows=\"1\" required
                                      placeholder=\"Reply to {{ rn|split(' ')|first }}…\"
                                      oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                            <button type=\"submit\" class=\"reply-send\">Reply</button>
                            <button type=\"button\" class=\"reply-cancel\"
                                    onclick=\"toggleReplyForm('reply-{{ reply.id }}')\">✕</button>
                          </div>
                        </form>
                      </div>
                    {% endfor %}
                  </div>
                {% endif %}
              {% endfor %}
            {% else %}
              <p class=\"no-comments\">
                No comments yet — start the conversation!
              </p>
            {% endif %}

            <form method=\"post\" action=\"{{ path('comment_create', {id: pid}) }}\">
              <div class=\"cform-row\">
                <textarea name=\"body\" rows=\"1\" placeholder=\"Write a comment…\" required
                          oninput=\"this.style.height='auto';this.style.height=this.scrollHeight+'px'\"></textarea>
                <button type=\"submit\" class=\"csend\">Post</button>
              </div>
            </form>

          </div>
        </div>
      </article>

    {% elseif item.feedType == 'travel_story' %}
      {# ─── TRAVEL STORY CARD ────────────────────────────── #}
      {% set story = item.entity %}
      {% set aName = authorMap[story.userId] ?? 'User #' ~ story.userId %}

      <article class=\"post-card ts-card\" data-feed-type=\"travel_story\">
        <div class=\"pc-head\">
          <div class=\"pc-avatar\" data-uavatar=\"{{ story.userId }}\">{{ aName|first|upper }}</div>
          <div class=\"pc-head-main\">
            <div class=\"pc-name\" data-uname=\"{{ story.userId }}\">{{ aName }}</div>
            <div class=\"pc-date\">{% if story.createdAt %}{{ story.createdAt|date('M d, Y H:i') }}{% endif %}</div>
          </div>
          <span class=\"pc-badge b-travel_story\">🧳 Travel Story</span>
        </div>

        <a href=\"{{ path('travel_story_show', {id: story.id}) }}\" class=\"pc-title\">{{ story.title }}</a>

        {% if story.destination %}
          <div class=\"ts-destination\">📍 {{ story.destination }}</div>
        {% endif %}

        {% if story.coverImageUrl %}
          <div class=\"pc-imgwrap\">
            <img src=\"{{ story.coverImageUrl }}\" class=\"pc-img\" alt=\"{{ story.title }}\"
                 loading=\"lazy\" onerror=\"this.parentElement.style.display='none'\">
          </div>
        {% endif %}

        {% if story.summary %}
          <div class=\"pc-body\">{{ story.summary|length > 300 ? story.summary|slice(0,300) ~ '…' : story.summary }}</div>
        {% endif %}

        <div class=\"ts-meta\">
          {% if story.overallRating %}
            <span class=\"ts-tag\">⭐ {{ story.overallRating }}/5</span>
          {% endif %}
          {% if story.travelType %}
            <span class=\"ts-tag\">{{ story.travelType|capitalize }}</span>
          {% endif %}
          {% if story.travelStyle %}
            <span class=\"ts-tag\">{{ story.travelStyle|capitalize }}</span>
          {% endif %}
          {% if story.totalBudget %}
            <span class=\"ts-tag\">{{ story.currency }} {{ story.totalBudget }}</span>
          {% endif %}
        </div>

        <a href=\"{{ path('travel_story_show', {id: story.id}) }}\" class=\"pc-read\">Read full story →</a>

        <div class=\"pc-actions\">
          <button type=\"button\" class=\"act-btn\"
                  onclick=\"sharePost('{{ story.title|e('js') }}', '{{ url('travel_story_show', {id: story.id}) }}')\">
            🔗 Share
          </button>
        </div>
      </article>
    {% endif %}
  {% endfor %}
{% endif %}", "front/blog/_feed_items.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\_feed_items.html.twig");
    }
}
