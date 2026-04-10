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

/* front/blog/blog.html.twig */
class __TwigTemplate_307c6114b5809a1b73a7771af61e18a3 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/blog/blog.html.twig"));

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

        yield "Travelgram — TripX Community";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "  ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/blog.css"), "html", null, true);
        yield "\">
  <style>
    .ts-destination { color: #6b7280; font-size: .9rem; margin: 4px 0 10px; }
    .ts-meta { display: flex; flex-wrap: wrap; gap: 6px; margin: 10px 0; }
    .ts-tag {
      display: inline-block; padding: 3px 10px; border-radius: 20px;
      font-size: .78rem; font-weight: 600;
      background: #f3f4f6; color: #374151;
    }
    .b-travel_story { background: linear-gradient(135deg,#f59e0b,#ef4444); color:#fff; }
    .ts-card { border-left: 3px solid #f59e0b; }
    #feed-container.loading { opacity: .45; pointer-events: none; transition: opacity .15s; }
    .feed-spinner { display: none; text-align: center; padding: 40px 0; font-size: 1.1rem; color: #9ca3af; }
    .feed-spinner.visible { display: block; }
  </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 26
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 27
        $context["typeFilter"] = ((array_key_exists("typeFilter", $context)) ? ((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 27, $this->source); })())) : (""));
        // line 28
        $context["search"] = ((array_key_exists("search", $context)) ? ((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 28, $this->source); })())) : (""));
        // line 29
        $context["authorMap"] = ((array_key_exists("authorMap", $context)) ? ((isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 29, $this->source); })())) : ([]));
        // line 30
        $context["savedPostIds"] = ((array_key_exists("savedPostIds", $context)) ? ((isset($context["savedPostIds"]) || array_key_exists("savedPostIds", $context) ? $context["savedPostIds"] : (function () { throw new RuntimeError('Variable "savedPostIds" does not exist.', 30, $this->source); })())) : ([]));
        // line 31
        $context["currentUserId"] = ((array_key_exists("currentUserId", $context)) ? ((isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 31, $this->source); })())) : (null));
        // line 32
        $context["reactionSummary"] = ((array_key_exists("reactionSummary", $context)) ? ((isset($context["reactionSummary"]) || array_key_exists("reactionSummary", $context) ? $context["reactionSummary"] : (function () { throw new RuntimeError('Variable "reactionSummary" does not exist.', 32, $this->source); })())) : ([]));
        // line 33
        $context["feed"] = ((array_key_exists("feed", $context)) ? ((isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 33, $this->source); })())) : ([]));
        // line 34
        $context["userReactions"] = ((array_key_exists("userReactions", $context)) ? ((isset($context["userReactions"]) || array_key_exists("userReactions", $context) ? $context["userReactions"] : (function () { throw new RuntimeError('Variable "userReactions" does not exist.', 34, $this->source); })())) : ([]));
        // line 35
        yield "
";
        // line 36
        $context["me"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 36, $this->source); })()), "user", [], "any", false, false, false, 36);
        // line 37
        yield "
<div class=\"tg-shell\">

  <aside class=\"tg-left\">
    <div class=\"profile-card\">
      ";
        // line 42
        if ((($tmp = (isset($context["me"]) || array_key_exists("me", $context) ? $context["me"] : (function () { throw new RuntimeError('Variable "me" does not exist.', 42, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 43
            yield "        <div class=\"profile-avatar\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["me"]) || array_key_exists("me", $context) ? $context["me"] : (function () { throw new RuntimeError('Variable "me" does not exist.', 43, $this->source); })()), "firstName", [], "any", false, false, false, 43))), "html", null, true);
            yield "</div>
        <div class=\"profile-name\">";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["me"]) || array_key_exists("me", $context) ? $context["me"] : (function () { throw new RuntimeError('Variable "me" does not exist.', 44, $this->source); })()), "firstName", [], "any", false, false, false, 44), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["me"]) || array_key_exists("me", $context) ? $context["me"] : (function () { throw new RuntimeError('Variable "me" does not exist.', 44, $this->source); })()), "lastName", [], "any", false, false, false, 44), "html", null, true);
            yield "</div>
        <div class=\"profile-handle\">@user";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["me"]) || array_key_exists("me", $context) ? $context["me"] : (function () { throw new RuntimeError('Variable "me" does not exist.', 45, $this->source); })()), "id", [], "any", false, false, false, 45), "html", null, true);
            yield "</div>
      ";
        } else {
            // line 47
            yield "        <div class=\"profile-avatar\">?</div>
        <div class=\"profile-name\">Traveller</div>
        <div class=\"profile-handle\">@guest</div>
      ";
        }
        // line 51
        yield "      <div class=\"profile-stats\">
        <div class=\"pstat\"><span class=\"pstat-num\">";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 52, $this->source); })())), "html", null, true);
        yield "</span><span class=\"pstat-lbl\">Posts</span></div>
        <div class=\"pstat\"><span class=\"pstat-num\">0</span><span class=\"pstat-lbl\">Followers</span></div>
        <div class=\"pstat\"><span class=\"pstat-num\">0</span><span class=\"pstat-lbl\">Following</span></div>
      </div>
    </div>

    <nav class=\"sidebar-nav\">
      <a href=\"";
        // line 59
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "\" class=\"snav-item ";
        if ((((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 59, $this->source); })()) == "") && ((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 59, $this->source); })()) == ""))) {
            yield "active";
        }
        yield "\"
         data-filter-type=\"\" onclick=\"return feedFilter(event, '')\">
        <span class=\"snav-icon\">🏠</span> Feed
      </a>
      <a href=\"";
        // line 63
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog", ["type" => "travel_story"]);
        yield "\" class=\"snav-item ";
        if (((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 63, $this->source); })()) == "travel_story")) {
            yield "active";
        }
        yield "\"
         data-filter-type=\"travel_story\" onclick=\"return feedFilter(event, 'travel_story')\">
        <span class=\"snav-icon\">🧳</span> Travel Stories
      </a>
      <a href=\"";
        // line 67
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog", ["type" => "story"]);
        yield "\" class=\"snav-item ";
        if (((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 67, $this->source); })()) == "story")) {
            yield "active";
        }
        yield "\"
         data-filter-type=\"story\" onclick=\"return feedFilter(event, 'story')\">
        <span class=\"snav-icon\">🔭</span> Explore
      </a>
      <a href=\"";
        // line 71
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_saved");
        yield "\" class=\"snav-item\">
        <span class=\"snav-icon\">🔖</span> Saved Posts
      </a>
      <a href=\"";
        // line 74
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_create");
        yield "\" class=\"snav-item\">
        <span class=\"snav-icon\">✍️</span> New Post
      </a>
      <a href=\"";
        // line 77
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_new");
        yield "\" class=\"snav-item\">
        <span class=\"snav-icon\">🧳</span> New Travel Story
      </a>
    </nav>
  </aside>

  <main class=\"tg-center\">
    ";
        // line 85
        yield "    <div class=\"feed-topbar\">
      <div class=\"search-wrap\">
        <svg class=\"search-icon\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                d=\"M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z\"/>
        </svg>
        <input type=\"text\" id=\"feed-search\" value=\"";
        // line 91
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 91, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"Search posts or stories…\">
      </div>

      <button type=\"button\" class=\"search-btn\" id=\"feed-search-btn\">Search</button>

      <div class=\"feed-topbar-actions\">
        <a href=\"";
        // line 97
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("post_create");
        yield "\" class=\"create-btn\">+ Create new post</a>
        <a href=\"";
        // line 98
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_new");
        yield "\" class=\"create-btn\">+ Create Travel Story</a>
      </div>
    </div>

    ";
        // line 103
        yield "    <div class=\"type-pills\" id=\"type-pills\">
      <a href=\"#\" class=\"tpill ";
        // line 104
        if (((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 104, $this->source); })()) == "")) {
            yield "active";
        }
        yield "\"
         data-type=\"\" onclick=\"return feedFilter(event, '')\">All</a>
      ";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["inquiry", "story", "review", "advice", "other"]);
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 107
            yield "        <a href=\"#\" class=\"tpill ";
            if (((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 107, $this->source); })()) == $context["t"])) {
                yield "active";
            }
            yield "\"
           data-type=\"";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["t"], "html", null, true);
            yield "\" onclick=\"return feedFilter(event, '";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["t"], "html", null, true);
            yield "')\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["t"]), "html", null, true);
            yield "</a>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['t'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        yield "      <a href=\"#\" class=\"tpill ";
        if (((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 110, $this->source); })()) == "travel_story")) {
            yield "active";
        }
        yield "\"
         data-type=\"travel_story\" onclick=\"return feedFilter(event, 'travel_story')\">🧳 Travel Stories</a>
    </div>

    ";
        // line 115
        yield "    <div class=\"stories-card\">
      <div class=\"stories-head\">
        <h3>Stories</h3>
        <a href=\"#\" class=\"watch-all\">Watch all</a>
      </div>
      <div class=\"stories-row\">
        <div class=\"story-bbl\">
          <div class=\"story-ring add-ring\"><div class=\"story-inner add-in\">+</div></div>
          <span class=\"story-lbl\">Add</span>
        </div>
        ";
        // line 125
        $context["seenAuthors"] = [];
        // line 126
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 126, $this->source); })()), 0, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 127
            yield "          ";
            $context["uid"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, false, 127), "userId", [], "any", false, false, false, 127);
            // line 128
            yield "          ";
            if (!CoreExtension::inFilter((isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 128, $this->source); })()), (isset($context["seenAuthors"]) || array_key_exists("seenAuthors", $context) ? $context["seenAuthors"] : (function () { throw new RuntimeError('Variable "seenAuthors" does not exist.', 128, $this->source); })()))) {
                // line 129
                yield "            ";
                $context["seenAuthors"] = Twig\Extension\CoreExtension::merge((isset($context["seenAuthors"]) || array_key_exists("seenAuthors", $context) ? $context["seenAuthors"] : (function () { throw new RuntimeError('Variable "seenAuthors" does not exist.', 129, $this->source); })()), [(isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 129, $this->source); })())]);
                // line 130
                yield "            ";
                $context["aName"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 130, $this->source); })()), [], "array", true, true, false, 130) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 130, $this->source); })()), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 130, $this->source); })()), [], "array", false, false, false, 130)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 130, $this->source); })()), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 130, $this->source); })()), [], "array", false, false, false, 130)) : ("User #")) . (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 130, $this->source); })()));
                // line 131
                yield "            <div class=\"story-bbl\">
              <div class=\"story-ring\"><div class=\"story-inner\">";
                // line 132
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 132, $this->source); })()))), "html", null, true);
                yield "</div></div>
              <span class=\"story-lbl\">";
                // line 133
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["aName"]) || array_key_exists("aName", $context) ? $context["aName"] : (function () { throw new RuntimeError('Variable "aName" does not exist.', 133, $this->source); })()), " ")), "html", null, true);
                yield "</span>
            </div>
          ";
            }
            // line 136
            yield "          ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["seenAuthors"]) || array_key_exists("seenAuthors", $context) ? $context["seenAuthors"] : (function () { throw new RuntimeError('Variable "seenAuthors" does not exist.', 136, $this->source); })())) >= 7)) {
            }
            // line 137
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        yield "      </div>
    </div>

    ";
        // line 142
        yield "    <div class=\"feed-spinner\" id=\"feed-spinner\">Loading…</div>
    <div id=\"feed-container\">
      ";
        // line 144
        yield from $this->load("front/blog/_feed_items.html.twig", 144)->unwrap()->yield(CoreExtension::merge($context, ["feed" =>         // line 145
(isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 145, $this->source); })()), "authorMap" =>         // line 146
(isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 146, $this->source); })()), "reactionSummary" =>         // line 147
(isset($context["reactionSummary"]) || array_key_exists("reactionSummary", $context) ? $context["reactionSummary"] : (function () { throw new RuntimeError('Variable "reactionSummary" does not exist.', 147, $this->source); })()), "userReactions" =>         // line 148
(isset($context["userReactions"]) || array_key_exists("userReactions", $context) ? $context["userReactions"] : (function () { throw new RuntimeError('Variable "userReactions" does not exist.', 148, $this->source); })()), "savedPostIds" =>         // line 149
(isset($context["savedPostIds"]) || array_key_exists("savedPostIds", $context) ? $context["savedPostIds"] : (function () { throw new RuntimeError('Variable "savedPostIds" does not exist.', 149, $this->source); })()), "currentUserId" =>         // line 150
(isset($context["currentUserId"]) || array_key_exists("currentUserId", $context) ? $context["currentUserId"] : (function () { throw new RuntimeError('Variable "currentUserId" does not exist.', 150, $this->source); })())]));
        // line 152
        yield "    </div>
  </main>

  <aside class=\"tg-right\">
    <div class=\"rcard\">
      <h4>Requests <span class=\"rpill\">2</span></h4>
      <p class=\"placeholder-text\">(placeholder)</p>
    </div>

    <div class=\"rcard\">
      <h4>Suggestions for you</h4>
      ";
        // line 163
        $context["sugColors"] = ["linear-gradient(135deg,#f59e0b,#ef4444)", "linear-gradient(135deg,#10b981,#3b82f6)", "linear-gradient(135deg,#a855f7,#ec4899)"];
        // line 168
        yield "      ";
        $context["seen"] = [];
        // line 169
        yield "      ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["feed"]) || array_key_exists("feed", $context) ? $context["feed"] : (function () { throw new RuntimeError('Variable "feed" does not exist.', 169, $this->source); })()));
        $context['_iterated'] = false;
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 170
            yield "        ";
            $context["uid"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, false, 170), "userId", [], "any", false, false, false, 170);
            // line 171
            yield "        ";
            if ((!CoreExtension::inFilter((isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 171, $this->source); })()), (isset($context["seen"]) || array_key_exists("seen", $context) ? $context["seen"] : (function () { throw new RuntimeError('Variable "seen" does not exist.', 171, $this->source); })())) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["seen"]) || array_key_exists("seen", $context) ? $context["seen"] : (function () { throw new RuntimeError('Variable "seen" does not exist.', 171, $this->source); })())) < 3))) {
                // line 172
                yield "          ";
                $context["seen"] = Twig\Extension\CoreExtension::merge((isset($context["seen"]) || array_key_exists("seen", $context) ? $context["seen"] : (function () { throw new RuntimeError('Variable "seen" does not exist.', 172, $this->source); })()), [(isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 172, $this->source); })())]);
                // line 173
                yield "          ";
                $context["sName"] = ((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 173, $this->source); })()), [], "array", true, true, false, 173) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 173, $this->source); })()), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 173, $this->source); })()), [], "array", false, false, false, 173)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 173, $this->source); })()), (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 173, $this->source); })()), [], "array", false, false, false, 173)) : ("User #")) . (isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 173, $this->source); })()));
                // line 174
                yield "          <div class=\"sug-row\">
            <div class=\"sug-av\" style=\"background:";
                // line 175
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["sugColors"]) || array_key_exists("sugColors", $context) ? $context["sugColors"] : (function () { throw new RuntimeError('Variable "sugColors" does not exist.', 175, $this->source); })()), (CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 175) % 3), [], "array", false, false, false, 175), "html", null, true);
                yield ";\">
              ";
                // line 176
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["sName"]) || array_key_exists("sName", $context) ? $context["sName"] : (function () { throw new RuntimeError('Variable "sName" does not exist.', 176, $this->source); })()))), "html", null, true);
                yield "
            </div>
            <div>
              <div class=\"sug-name\">";
                // line 179
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sName"]) || array_key_exists("sName", $context) ? $context["sName"] : (function () { throw new RuntimeError('Variable "sName" does not exist.', 179, $this->source); })()), "html", null, true);
                yield "</div>
              <div class=\"sug-handle\">@user";
                // line 180
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["uid"]) || array_key_exists("uid", $context) ? $context["uid"] : (function () { throw new RuntimeError('Variable "uid" does not exist.', 180, $this->source); })()), "html", null, true);
                yield "</div>
            </div>
            <button class=\"flw-btn\"
                    onclick=\"this.textContent = this.textContent==='Follow' ? 'Following' : 'Follow';
                             this.classList.toggle('following');\">Follow</button>
          </div>
        ";
            }
            // line 187
            yield "      ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 188
            yield "        <p class=\"placeholder-text\">(placeholder)</p>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 190
        yield "    </div>

    <div class=\"rcard\">
      <div class=\"stat-big\">
        <span class=\"bnum\">184.3K</span>
        <span class=\"blbl\">Followers</span>
        <span class=\"bsub\">Active now on your profile</span>
      </div>
    </div>
  </aside>

</div>

<script>
/* ═══════════════════════════════════════════════════════════
   AJAX feed filtering
   ═══════════════════════════════════════════════════════════ */
let _currentType   = '";
        // line 207
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["typeFilter"]) || array_key_exists("typeFilter", $context) ? $context["typeFilter"] : (function () { throw new RuntimeError('Variable "typeFilter" does not exist.', 207, $this->source); })()), "js"), "html", null, true);
        yield "';
let _currentSearch = '";
        // line 208
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 208, $this->source); })()), "js"), "html", null, true);
        yield "';
let _ajaxCtrl      = null;

function feedFilter(e, type) {
  if (e) e.preventDefault();
  _currentType = type;
  loadFeed();
  document.querySelectorAll('#type-pills .tpill').forEach(el => {
    el.classList.toggle('active', el.dataset.type === type);
  });
  document.querySelectorAll('.sidebar-nav .snav-item[data-filter-type]').forEach(el => {
    el.classList.toggle('active', el.dataset.filterType === type);
  });
  return false;
}

function loadFeed() {
  if (_ajaxCtrl) _ajaxCtrl.abort();
  _ajaxCtrl = new AbortController();

  const params = new URLSearchParams();
  if (_currentSearch) params.set('q', _currentSearch);
  if (_currentType)   params.set('type', _currentType);

  const container = document.getElementById('feed-container');
  const spinner   = document.getElementById('feed-spinner');
  container.classList.add('loading');
  spinner.classList.add('visible');

  const newUrl = '";
        // line 237
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        yield "' + (params.toString() ? '?' + params : '');
  history.replaceState(null, '', newUrl);

  fetch('";
        // line 240
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_filter");
        yield "?' + params.toString(), {
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    signal: _ajaxCtrl.signal,
  })
    .then(r => { if (!r.ok) throw new Error(r.status); return r.text(); })
    .then(html => {
      container.innerHTML = html;
      container.classList.remove('loading');
      spinner.classList.remove('visible');
      hydrateUserNames();
    })
    .catch(err => {
      if (err.name === 'AbortError') return;
      console.error('Feed load error', err);
      container.classList.remove('loading');
      spinner.classList.remove('visible');
    });
}

document.getElementById('feed-search-btn').addEventListener('click', () => {
  _currentSearch = document.getElementById('feed-search').value.trim();
  loadFeed();
});
document.getElementById('feed-search').addEventListener('keydown', e => {
  if (e.key === 'Enter') {
    e.preventDefault();
    _currentSearch = e.target.value.trim();
    loadFeed();
  }
});

/* ═══════════════════════════════════════════════════════════
   Reactions, comments, share, etc.
   ═══════════════════════════════════════════════════════════ */
const RXN_ICONS  = {like:'👍',love:'❤️',haha:'😂',wow:'😮',sad:'😢',angry:'😡'};
const RXN_LABELS = {like:'Like',love:'Love',haha:'Haha',wow:'Wow',sad:'Sad',angry:'Angry'};

async function sendReaction(targetId, type, targetType) {
  const url = targetType === 'post'
    ? `/post/\${targetId}/react/\${type}`
    : `/comment/\${targetId}/react/\${type}`;
  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    if (!res.ok) return;
    const data = await res.json();
    if (targetType === 'post') {
      updatePostReaction(targetId, data.userReaction, data.counts);
    } else {
      updateCommentReaction(targetId, data.userReaction, data.counts);
    }
  } catch(e) { console.error('Reaction error:', e); }
}

function quickReact(targetId, currentReaction, targetType) {
  sendReaction(targetId, currentReaction || 'like', targetType);
}

function updatePostReaction(pid, userReaction, counts) {
  const btn = document.getElementById(`rxnbtn-\${pid}`);
  const iconEl = document.getElementById(`rxnicon-\${pid}`);
  const lblEl = document.getElementById(`rxnlbl-\${pid}`);
  const totalEl = document.getElementById(`rxntotal-\${pid}`);
  if (!btn) return;

  btn.className = btn.className.replace(/reacted-\\w+/g, '').trim();
  if (userReaction) {
    btn.classList.add(`reacted-\${userReaction}`);
    iconEl.textContent = RXN_ICONS[userReaction] || '👍';
    lblEl.textContent  = RXN_LABELS[userReaction] || 'Like';
    btn.dataset.reaction = userReaction;
    btn.setAttribute('onclick', `quickReact(\${pid}, '\${userReaction}', 'post')`);
  } else {
    iconEl.textContent = '👍';
    lblEl.textContent  = 'Like';
    btn.dataset.reaction = '';
    btn.setAttribute('onclick', `quickReact(\${pid}, '', 'post')`);
  }

  Object.keys(RXN_ICONS).forEach(t => {
    const opt = document.getElementById(`rxnopt-\${pid}-\${t}`);
    if (opt) opt.classList.toggle('active-emoji', t === userReaction);
  });

  const total = Object.values(counts).reduce((a, b) => a + b, 0);
  if (total > 0) { totalEl.textContent = total; totalEl.style.display = ''; }
  else { totalEl.style.display = 'none'; }

  const tally = btn.closest('article')?.querySelector('.rxn-tally');
  if (tally) {
    tally.innerHTML = '';
    Object.entries(counts).forEach(([t, n]) => {
      if (n > 0) { const s = document.createElement('span'); s.textContent = `\${RXN_ICONS[t]} \${n}`; tally.appendChild(s); }
    });
  }
}

function updateCommentReaction(cid, userReaction, counts) {
  const btn = document.getElementById(`crxnbtn-\${cid}`);
  const tally = document.getElementById(`crxntally-\${cid}`);
  if (!btn) return;
  if (userReaction) {
    btn.classList.add('c-reacted');
    btn.innerHTML = `\${RXN_ICONS[userReaction]} \${RXN_LABELS[userReaction]}`;
    btn.setAttribute('onclick', `quickReact(\${cid}, '\${userReaction}', 'comment')`);
  } else {
    btn.classList.remove('c-reacted');
    btn.innerHTML = '👍 Like';
    btn.setAttribute('onclick', `quickReact(\${cid}, '', 'comment')`);
  }
  if (tally) {
    const total = Object.values(counts).reduce((a, b) => a + b, 0);
    tally.innerHTML = total > 0
      ? Object.entries(counts).filter(([,n]) => n > 0).map(([t, n]) => `\${RXN_ICONS[t]}\${n}`).join(' ')
      : '';
  }
}

async function sharePost(title, url) {
  if (navigator.share) { try { await navigator.share({ title, url }); return; } catch(e) { return; } }
  try { await navigator.clipboard.writeText(url); showToast('🔗 Link copied to clipboard!'); }
  catch(e) { prompt('Copy this link:', url); }
}

function showToast(msg) {
  let t = document.getElementById('share-toast');
  if (!t) {
    t = document.createElement('div'); t.id = 'share-toast';
    t.style.cssText = `position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(20px);background:#111;color:#fff;padding:12px 22px;border-radius:50px;font-size:14px;font-weight:700;z-index:9999;opacity:0;transition:opacity .25s,transform .25s;white-space:nowrap;box-shadow:0 8px 24px rgba(0,0,0,.25);`;
    document.body.appendChild(t);
  }
  t.textContent = msg; t.style.opacity = '1'; t.style.transform = 'translateX(-50%) translateY(0)';
  clearTimeout(t._timer);
  t._timer = setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(-50%) translateY(20px)'; }, 2800);
}

function hydrateUserNames() {
  const els = document.querySelectorAll('[data-uname],[data-uavatar]');
  const ids = [...new Set([...els].map(el => el.dataset.uname || el.dataset.uavatar).filter(Boolean))];
  if (!ids.length) return;
  fetch('/blog/user-names?ids=' + ids.join(','))
    .then(r => r.ok ? r.json() : {})
    .then(names => {
      document.querySelectorAll('[data-uname]').forEach(el => { const n = names[el.dataset.uname]; if (n) el.textContent = n; });
      document.querySelectorAll('[data-uavatar]').forEach(el => { const n = names[el.dataset.uavatar]; if (n) el.textContent = n.charAt(0).toUpperCase(); });
    }).catch(() => {});
}

document.addEventListener('DOMContentLoaded', () => {
  const hash = window.location.hash;
  if (hash && hash.startsWith('#c')) {
    const box = document.getElementById(hash.slice(1));
    if (box && box.classList.contains('cbox')) {
      box.classList.add('open');
      const pid = hash.slice(2);
      document.querySelectorAll(`[onclick*=\"'c\${pid}'\"]`).forEach(b => {
        if (b.classList.contains('vcbtn')) { const m = b.textContent.match(/\\((\\d+)\\)/); b.textContent = `Hide comments (\${m ? m[1] : 0})`; }
      });
      setTimeout(() => { const rows = box.querySelectorAll('.crow'); (rows.length ? rows[rows.length-1] : box).scrollIntoView({behavior:'smooth',block:'center'}); }, 300);
    }
  }
  hydrateUserNames();
});

function toggleC(id, btn) {
  const box = document.getElementById(id); if (!box) return;
  const isOpen = box.classList.toggle('open');
  const card = btn.closest('article'); if (!card) return;
  card.querySelectorAll('.vcbtn').forEach(b => { const m = b.textContent.match(/\\((\\d+)\\)/); const n = m ? m[1] : 0; b.textContent = isOpen ? `Hide comments (\${n})` : `View comments (\${n})`; });
}

function toggleEditForm(id) {
  const form = document.getElementById(id); if (!form) return;
  form.classList.toggle('open');
  if (form.classList.contains('open')) { const ta = form.querySelector('textarea'); if (ta) { ta.focus(); ta.setSelectionRange(ta.value.length, ta.value.length); } }
}

function toggleReplyForm(id) {
  const form = document.getElementById(id); if (!form) return;
  form.classList.toggle('open');
  if (form.classList.contains('open')) form.querySelector('textarea')?.focus();
}

function toggleReplies(id, btn) {
  const wrap = document.getElementById(id); if (!wrap) return;
  const isOpen = wrap.style.display !== 'none';
  wrap.style.display = isOpen ? 'none' : 'block';
  const arrow = btn.querySelector('span'); if (arrow) arrow.textContent = isOpen ? '▸' : '▾';
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
        return "front/blog/blog.html.twig";
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
        return array (  546 => 240,  540 => 237,  508 => 208,  504 => 207,  485 => 190,  478 => 188,  465 => 187,  455 => 180,  451 => 179,  445 => 176,  441 => 175,  438 => 174,  435 => 173,  432 => 172,  429 => 171,  426 => 170,  407 => 169,  404 => 168,  402 => 163,  389 => 152,  387 => 150,  386 => 149,  385 => 148,  384 => 147,  383 => 146,  382 => 145,  381 => 144,  377 => 142,  372 => 138,  366 => 137,  362 => 136,  356 => 133,  352 => 132,  349 => 131,  346 => 130,  343 => 129,  340 => 128,  337 => 127,  332 => 126,  330 => 125,  318 => 115,  308 => 110,  296 => 108,  289 => 107,  285 => 106,  278 => 104,  275 => 103,  268 => 98,  264 => 97,  255 => 91,  247 => 85,  237 => 77,  231 => 74,  225 => 71,  214 => 67,  203 => 63,  192 => 59,  182 => 52,  179 => 51,  173 => 47,  168 => 45,  162 => 44,  157 => 43,  155 => 42,  148 => 37,  146 => 36,  143 => 35,  141 => 34,  139 => 33,  137 => 32,  135 => 31,  133 => 30,  131 => 29,  129 => 28,  127 => 27,  117 => 26,  93 => 9,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Travelgram — TripX Community{% endblock %}

{% block stylesheets %}
  {{ parent() }}
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"{{ asset('css/blog.css') }}\">
  <style>
    .ts-destination { color: #6b7280; font-size: .9rem; margin: 4px 0 10px; }
    .ts-meta { display: flex; flex-wrap: wrap; gap: 6px; margin: 10px 0; }
    .ts-tag {
      display: inline-block; padding: 3px 10px; border-radius: 20px;
      font-size: .78rem; font-weight: 600;
      background: #f3f4f6; color: #374151;
    }
    .b-travel_story { background: linear-gradient(135deg,#f59e0b,#ef4444); color:#fff; }
    .ts-card { border-left: 3px solid #f59e0b; }
    #feed-container.loading { opacity: .45; pointer-events: none; transition: opacity .15s; }
    .feed-spinner { display: none; text-align: center; padding: 40px 0; font-size: 1.1rem; color: #9ca3af; }
    .feed-spinner.visible { display: block; }
  </style>
{% endblock %}

{% block body %}
{% set typeFilter    = typeFilter    is defined ? typeFilter    : '' %}
{% set search        = search        is defined ? search        : '' %}
{% set authorMap     = authorMap     is defined ? authorMap     : {} %}
{% set savedPostIds  = savedPostIds  is defined ? savedPostIds  : [] %}
{% set currentUserId = currentUserId is defined ? currentUserId : null %}
{% set reactionSummary = reactionSummary is defined ? reactionSummary : {} %}
{% set feed = feed is defined ? feed : [] %}
{% set userReactions = userReactions is defined ? userReactions : {} %}

{% set me = app.user %}

<div class=\"tg-shell\">

  <aside class=\"tg-left\">
    <div class=\"profile-card\">
      {% if me %}
        <div class=\"profile-avatar\">{{ me.firstName|first|upper }}</div>
        <div class=\"profile-name\">{{ me.firstName }} {{ me.lastName }}</div>
        <div class=\"profile-handle\">@user{{ me.id }}</div>
      {% else %}
        <div class=\"profile-avatar\">?</div>
        <div class=\"profile-name\">Traveller</div>
        <div class=\"profile-handle\">@guest</div>
      {% endif %}
      <div class=\"profile-stats\">
        <div class=\"pstat\"><span class=\"pstat-num\">{{ feed|length }}</span><span class=\"pstat-lbl\">Posts</span></div>
        <div class=\"pstat\"><span class=\"pstat-num\">0</span><span class=\"pstat-lbl\">Followers</span></div>
        <div class=\"pstat\"><span class=\"pstat-num\">0</span><span class=\"pstat-lbl\">Following</span></div>
      </div>
    </div>

    <nav class=\"sidebar-nav\">
      <a href=\"{{ path('blog') }}\" class=\"snav-item {% if typeFilter == '' and search == '' %}active{% endif %}\"
         data-filter-type=\"\" onclick=\"return feedFilter(event, '')\">
        <span class=\"snav-icon\">🏠</span> Feed
      </a>
      <a href=\"{{ path('blog', {type:'travel_story'}) }}\" class=\"snav-item {% if typeFilter == 'travel_story' %}active{% endif %}\"
         data-filter-type=\"travel_story\" onclick=\"return feedFilter(event, 'travel_story')\">
        <span class=\"snav-icon\">🧳</span> Travel Stories
      </a>
      <a href=\"{{ path('blog', {type:'story'}) }}\" class=\"snav-item {% if typeFilter == 'story' %}active{% endif %}\"
         data-filter-type=\"story\" onclick=\"return feedFilter(event, 'story')\">
        <span class=\"snav-icon\">🔭</span> Explore
      </a>
      <a href=\"{{ path('blog_saved') }}\" class=\"snav-item\">
        <span class=\"snav-icon\">🔖</span> Saved Posts
      </a>
      <a href=\"{{ path('post_create') }}\" class=\"snav-item\">
        <span class=\"snav-icon\">✍️</span> New Post
      </a>
      <a href=\"{{ path('travel_story_new') }}\" class=\"snav-item\">
        <span class=\"snav-icon\">🧳</span> New Travel Story
      </a>
    </nav>
  </aside>

  <main class=\"tg-center\">
    {# ── Search bar (AJAX-driven) ──────────────────────── #}
    <div class=\"feed-topbar\">
      <div class=\"search-wrap\">
        <svg class=\"search-icon\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                d=\"M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z\"/>
        </svg>
        <input type=\"text\" id=\"feed-search\" value=\"{{ search }}\" placeholder=\"Search posts or stories…\">
      </div>

      <button type=\"button\" class=\"search-btn\" id=\"feed-search-btn\">Search</button>

      <div class=\"feed-topbar-actions\">
        <a href=\"{{ path('post_create') }}\" class=\"create-btn\">+ Create new post</a>
        <a href=\"{{ path('travel_story_new') }}\" class=\"create-btn\">+ Create Travel Story</a>
      </div>
    </div>

    {# ── Type pills (AJAX-driven) ──────────────────────── #}
    <div class=\"type-pills\" id=\"type-pills\">
      <a href=\"#\" class=\"tpill {% if typeFilter == '' %}active{% endif %}\"
         data-type=\"\" onclick=\"return feedFilter(event, '')\">All</a>
      {% for t in ['inquiry','story','review','advice','other'] %}
        <a href=\"#\" class=\"tpill {% if typeFilter == t %}active{% endif %}\"
           data-type=\"{{ t }}\" onclick=\"return feedFilter(event, '{{ t }}')\">{{ t|capitalize }}</a>
      {% endfor %}
      <a href=\"#\" class=\"tpill {% if typeFilter == 'travel_story' %}active{% endif %}\"
         data-type=\"travel_story\" onclick=\"return feedFilter(event, 'travel_story')\">🧳 Travel Stories</a>
    </div>

    {# ── Stories row ───────────────────────────────────── #}
    <div class=\"stories-card\">
      <div class=\"stories-head\">
        <h3>Stories</h3>
        <a href=\"#\" class=\"watch-all\">Watch all</a>
      </div>
      <div class=\"stories-row\">
        <div class=\"story-bbl\">
          <div class=\"story-ring add-ring\"><div class=\"story-inner add-in\">+</div></div>
          <span class=\"story-lbl\">Add</span>
        </div>
        {% set seenAuthors = [] %}
        {% for item in feed|slice(0,14) %}
          {% set uid = item.entity.userId %}
          {% if uid not in seenAuthors %}
            {% set seenAuthors = seenAuthors|merge([uid]) %}
            {% set aName = authorMap[uid] ?? 'User #' ~ uid %}
            <div class=\"story-bbl\">
              <div class=\"story-ring\"><div class=\"story-inner\">{{ aName|first|upper }}</div></div>
              <span class=\"story-lbl\">{{ aName|split(' ')|first }}</span>
            </div>
          {% endif %}
          {% if seenAuthors|length >= 7 %}{% endif %}
        {% endfor %}
      </div>
    </div>

    {# ── Feed container (replaced by AJAX) ─────────────── #}
    <div class=\"feed-spinner\" id=\"feed-spinner\">Loading…</div>
    <div id=\"feed-container\">
      {% include 'front/blog/_feed_items.html.twig' with {
        feed: feed,
        authorMap: authorMap,
        reactionSummary: reactionSummary,
        userReactions: userReactions,
        savedPostIds: savedPostIds,
        currentUserId: currentUserId,
      } %}
    </div>
  </main>

  <aside class=\"tg-right\">
    <div class=\"rcard\">
      <h4>Requests <span class=\"rpill\">2</span></h4>
      <p class=\"placeholder-text\">(placeholder)</p>
    </div>

    <div class=\"rcard\">
      <h4>Suggestions for you</h4>
      {% set sugColors = [
        'linear-gradient(135deg,#f59e0b,#ef4444)',
        'linear-gradient(135deg,#10b981,#3b82f6)',
        'linear-gradient(135deg,#a855f7,#ec4899)'
      ] %}
      {% set seen = [] %}
      {% for item in feed %}
        {% set uid = item.entity.userId %}
        {% if uid not in seen and seen|length < 3 %}
          {% set seen = seen|merge([uid]) %}
          {% set sName = authorMap[uid] ?? 'User #' ~ uid %}
          <div class=\"sug-row\">
            <div class=\"sug-av\" style=\"background:{{ sugColors[loop.index0 % 3] }};\">
              {{ sName|first|upper }}
            </div>
            <div>
              <div class=\"sug-name\">{{ sName }}</div>
              <div class=\"sug-handle\">@user{{ uid }}</div>
            </div>
            <button class=\"flw-btn\"
                    onclick=\"this.textContent = this.textContent==='Follow' ? 'Following' : 'Follow';
                             this.classList.toggle('following');\">Follow</button>
          </div>
        {% endif %}
      {% else %}
        <p class=\"placeholder-text\">(placeholder)</p>
      {% endfor %}
    </div>

    <div class=\"rcard\">
      <div class=\"stat-big\">
        <span class=\"bnum\">184.3K</span>
        <span class=\"blbl\">Followers</span>
        <span class=\"bsub\">Active now on your profile</span>
      </div>
    </div>
  </aside>

</div>

<script>
/* ═══════════════════════════════════════════════════════════
   AJAX feed filtering
   ═══════════════════════════════════════════════════════════ */
let _currentType   = '{{ typeFilter|e('js') }}';
let _currentSearch = '{{ search|e('js') }}';
let _ajaxCtrl      = null;

function feedFilter(e, type) {
  if (e) e.preventDefault();
  _currentType = type;
  loadFeed();
  document.querySelectorAll('#type-pills .tpill').forEach(el => {
    el.classList.toggle('active', el.dataset.type === type);
  });
  document.querySelectorAll('.sidebar-nav .snav-item[data-filter-type]').forEach(el => {
    el.classList.toggle('active', el.dataset.filterType === type);
  });
  return false;
}

function loadFeed() {
  if (_ajaxCtrl) _ajaxCtrl.abort();
  _ajaxCtrl = new AbortController();

  const params = new URLSearchParams();
  if (_currentSearch) params.set('q', _currentSearch);
  if (_currentType)   params.set('type', _currentType);

  const container = document.getElementById('feed-container');
  const spinner   = document.getElementById('feed-spinner');
  container.classList.add('loading');
  spinner.classList.add('visible');

  const newUrl = '{{ path('blog') }}' + (params.toString() ? '?' + params : '');
  history.replaceState(null, '', newUrl);

  fetch('{{ path('blog_filter') }}?' + params.toString(), {
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    signal: _ajaxCtrl.signal,
  })
    .then(r => { if (!r.ok) throw new Error(r.status); return r.text(); })
    .then(html => {
      container.innerHTML = html;
      container.classList.remove('loading');
      spinner.classList.remove('visible');
      hydrateUserNames();
    })
    .catch(err => {
      if (err.name === 'AbortError') return;
      console.error('Feed load error', err);
      container.classList.remove('loading');
      spinner.classList.remove('visible');
    });
}

document.getElementById('feed-search-btn').addEventListener('click', () => {
  _currentSearch = document.getElementById('feed-search').value.trim();
  loadFeed();
});
document.getElementById('feed-search').addEventListener('keydown', e => {
  if (e.key === 'Enter') {
    e.preventDefault();
    _currentSearch = e.target.value.trim();
    loadFeed();
  }
});

/* ═══════════════════════════════════════════════════════════
   Reactions, comments, share, etc.
   ═══════════════════════════════════════════════════════════ */
const RXN_ICONS  = {like:'👍',love:'❤️',haha:'😂',wow:'😮',sad:'😢',angry:'😡'};
const RXN_LABELS = {like:'Like',love:'Love',haha:'Haha',wow:'Wow',sad:'Sad',angry:'Angry'};

async function sendReaction(targetId, type, targetType) {
  const url = targetType === 'post'
    ? `/post/\${targetId}/react/\${type}`
    : `/comment/\${targetId}/react/\${type}`;
  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    if (!res.ok) return;
    const data = await res.json();
    if (targetType === 'post') {
      updatePostReaction(targetId, data.userReaction, data.counts);
    } else {
      updateCommentReaction(targetId, data.userReaction, data.counts);
    }
  } catch(e) { console.error('Reaction error:', e); }
}

function quickReact(targetId, currentReaction, targetType) {
  sendReaction(targetId, currentReaction || 'like', targetType);
}

function updatePostReaction(pid, userReaction, counts) {
  const btn = document.getElementById(`rxnbtn-\${pid}`);
  const iconEl = document.getElementById(`rxnicon-\${pid}`);
  const lblEl = document.getElementById(`rxnlbl-\${pid}`);
  const totalEl = document.getElementById(`rxntotal-\${pid}`);
  if (!btn) return;

  btn.className = btn.className.replace(/reacted-\\w+/g, '').trim();
  if (userReaction) {
    btn.classList.add(`reacted-\${userReaction}`);
    iconEl.textContent = RXN_ICONS[userReaction] || '👍';
    lblEl.textContent  = RXN_LABELS[userReaction] || 'Like';
    btn.dataset.reaction = userReaction;
    btn.setAttribute('onclick', `quickReact(\${pid}, '\${userReaction}', 'post')`);
  } else {
    iconEl.textContent = '👍';
    lblEl.textContent  = 'Like';
    btn.dataset.reaction = '';
    btn.setAttribute('onclick', `quickReact(\${pid}, '', 'post')`);
  }

  Object.keys(RXN_ICONS).forEach(t => {
    const opt = document.getElementById(`rxnopt-\${pid}-\${t}`);
    if (opt) opt.classList.toggle('active-emoji', t === userReaction);
  });

  const total = Object.values(counts).reduce((a, b) => a + b, 0);
  if (total > 0) { totalEl.textContent = total; totalEl.style.display = ''; }
  else { totalEl.style.display = 'none'; }

  const tally = btn.closest('article')?.querySelector('.rxn-tally');
  if (tally) {
    tally.innerHTML = '';
    Object.entries(counts).forEach(([t, n]) => {
      if (n > 0) { const s = document.createElement('span'); s.textContent = `\${RXN_ICONS[t]} \${n}`; tally.appendChild(s); }
    });
  }
}

function updateCommentReaction(cid, userReaction, counts) {
  const btn = document.getElementById(`crxnbtn-\${cid}`);
  const tally = document.getElementById(`crxntally-\${cid}`);
  if (!btn) return;
  if (userReaction) {
    btn.classList.add('c-reacted');
    btn.innerHTML = `\${RXN_ICONS[userReaction]} \${RXN_LABELS[userReaction]}`;
    btn.setAttribute('onclick', `quickReact(\${cid}, '\${userReaction}', 'comment')`);
  } else {
    btn.classList.remove('c-reacted');
    btn.innerHTML = '👍 Like';
    btn.setAttribute('onclick', `quickReact(\${cid}, '', 'comment')`);
  }
  if (tally) {
    const total = Object.values(counts).reduce((a, b) => a + b, 0);
    tally.innerHTML = total > 0
      ? Object.entries(counts).filter(([,n]) => n > 0).map(([t, n]) => `\${RXN_ICONS[t]}\${n}`).join(' ')
      : '';
  }
}

async function sharePost(title, url) {
  if (navigator.share) { try { await navigator.share({ title, url }); return; } catch(e) { return; } }
  try { await navigator.clipboard.writeText(url); showToast('🔗 Link copied to clipboard!'); }
  catch(e) { prompt('Copy this link:', url); }
}

function showToast(msg) {
  let t = document.getElementById('share-toast');
  if (!t) {
    t = document.createElement('div'); t.id = 'share-toast';
    t.style.cssText = `position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(20px);background:#111;color:#fff;padding:12px 22px;border-radius:50px;font-size:14px;font-weight:700;z-index:9999;opacity:0;transition:opacity .25s,transform .25s;white-space:nowrap;box-shadow:0 8px 24px rgba(0,0,0,.25);`;
    document.body.appendChild(t);
  }
  t.textContent = msg; t.style.opacity = '1'; t.style.transform = 'translateX(-50%) translateY(0)';
  clearTimeout(t._timer);
  t._timer = setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(-50%) translateY(20px)'; }, 2800);
}

function hydrateUserNames() {
  const els = document.querySelectorAll('[data-uname],[data-uavatar]');
  const ids = [...new Set([...els].map(el => el.dataset.uname || el.dataset.uavatar).filter(Boolean))];
  if (!ids.length) return;
  fetch('/blog/user-names?ids=' + ids.join(','))
    .then(r => r.ok ? r.json() : {})
    .then(names => {
      document.querySelectorAll('[data-uname]').forEach(el => { const n = names[el.dataset.uname]; if (n) el.textContent = n; });
      document.querySelectorAll('[data-uavatar]').forEach(el => { const n = names[el.dataset.uavatar]; if (n) el.textContent = n.charAt(0).toUpperCase(); });
    }).catch(() => {});
}

document.addEventListener('DOMContentLoaded', () => {
  const hash = window.location.hash;
  if (hash && hash.startsWith('#c')) {
    const box = document.getElementById(hash.slice(1));
    if (box && box.classList.contains('cbox')) {
      box.classList.add('open');
      const pid = hash.slice(2);
      document.querySelectorAll(`[onclick*=\"'c\${pid}'\"]`).forEach(b => {
        if (b.classList.contains('vcbtn')) { const m = b.textContent.match(/\\((\\d+)\\)/); b.textContent = `Hide comments (\${m ? m[1] : 0})`; }
      });
      setTimeout(() => { const rows = box.querySelectorAll('.crow'); (rows.length ? rows[rows.length-1] : box).scrollIntoView({behavior:'smooth',block:'center'}); }, 300);
    }
  }
  hydrateUserNames();
});

function toggleC(id, btn) {
  const box = document.getElementById(id); if (!box) return;
  const isOpen = box.classList.toggle('open');
  const card = btn.closest('article'); if (!card) return;
  card.querySelectorAll('.vcbtn').forEach(b => { const m = b.textContent.match(/\\((\\d+)\\)/); const n = m ? m[1] : 0; b.textContent = isOpen ? `Hide comments (\${n})` : `View comments (\${n})`; });
}

function toggleEditForm(id) {
  const form = document.getElementById(id); if (!form) return;
  form.classList.toggle('open');
  if (form.classList.contains('open')) { const ta = form.querySelector('textarea'); if (ta) { ta.focus(); ta.setSelectionRange(ta.value.length, ta.value.length); } }
}

function toggleReplyForm(id) {
  const form = document.getElementById(id); if (!form) return;
  form.classList.toggle('open');
  if (form.classList.contains('open')) form.querySelector('textarea')?.focus();
}

function toggleReplies(id, btn) {
  const wrap = document.getElementById(id); if (!wrap) return;
  const isOpen = wrap.style.display !== 'none';
  wrap.style.display = isOpen ? 'none' : 'block';
  const arrow = btn.querySelector('span'); if (arrow) arrow.textContent = isOpen ? '▸' : '▾';
}
</script>
{% endblock %}", "front/blog/blog.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\blog\\blog.html.twig");
    }
}
