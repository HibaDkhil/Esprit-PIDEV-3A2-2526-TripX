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

/* admin/blog/blog.html.twig */
class __TwigTemplate_392b1d296e1f70e278c23130fa5a031c extends Template
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
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/admin_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/blog/blog.html.twig"));

        $this->parent = $this->load("admin/admin_base.html.twig", 1);
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

        yield "Blog Management — TripX Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 5
        yield "  <span class=\"crumb active\">Blog</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 9
        yield "<style>
.stats-row        { display:flex; gap:16px; flex-wrap:wrap; margin-bottom:28px; }
.stat-card        { flex:1; min-width:140px; background:var(--bg-card); border:1px solid var(--border-color);
                     border-radius:var(--border-radius-md); padding:18px 20px; }
.stat-card .num   { font-size:32px; font-weight:900; color:var(--accent-primary); }
.stat-card .lbl   { font-size:13px; color:var(--text-muted); margin-top:2px; }

.blog-table       { width:100%; border-collapse:collapse; background:var(--bg-card);
                     border-radius:var(--border-radius-md); overflow:hidden;
                     border:1px solid var(--border-color); }
.blog-table th    { background:var(--bg-surface); padding:13px 16px; font-size:12px;
                     font-weight:700; text-transform:uppercase; letter-spacing:.5px;
                     color:var(--text-muted); text-align:left; border-bottom:1px solid var(--border-color); }
.blog-table td    { padding:14px 16px; font-size:14px; border-bottom:1px solid var(--border-color);
                     vertical-align:middle; }
.blog-table tr:last-child td { border-bottom:none; }
.blog-table tr:hover td      { background:var(--bg-surface); }

.badge            { display:inline-block; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700; }
.badge-pending    { background:#fef3c7; color:#92400e; }
.badge-approved   { background:#d1fae5; color:#065f46; }
.type-dot         { display:inline-block; padding:3px 8px; border-radius:50px; font-size:11px; font-weight:600; }
.type-inquiry     { background:#dbeafe; color:#1d4ed8; }
.type-story       { background:#d1fae5; color:#065f46; }
.type-review      { background:#fef3c7; color:#92400e; }
.type-advice      { background:#ede9fe; color:#5b21b6; }
.type-other       { background:#f3f4f6; color:#374151; }
.type-travel      { background:linear-gradient(135deg,#fef3c7,#fee2e2); color:#92400e; }

.actions          { display:flex; gap:6px; flex-wrap:wrap; }
.btn-approve      { padding:5px 12px; background:#d1fae5; color:#065f46; border:1px solid #6ee7b7;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-reject       { padding:5px 12px; background:#fef3c7; color:#92400e; border:1px solid #fcd34d;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-del          { padding:5px 12px; background:#fee2e2; color:#dc2626; border:1px solid #fca5a5;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-view         { padding:5px 12px; background:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; text-decoration:none; }

.post-title-cell  { max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; font-weight:700; }
.flash-success    { background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:10px; margin-bottom:18px; }
.flash-info       { background:#dbeafe; color:#1e40af; padding:12px 16px; border-radius:10px; margin-bottom:18px; }
.empty-state      { text-align:center; padding:50px; color:var(--text-muted); }

/* Tabs */
.admin-tabs       { display:flex; gap:0; margin-bottom:24px; border-bottom:2px solid var(--border-color); }
.admin-tab        { padding:12px 24px; font-size:14px; font-weight:700; cursor:pointer; border:none;
                     background:none; color:var(--text-muted); position:relative; }
.admin-tab.active { color:var(--accent-primary); }
.admin-tab.active::after { content:''; position:absolute; bottom:-2px; left:0; right:0; height:2px;
                     background:var(--accent-primary); }
.admin-tab .tab-count { display:inline-block; margin-left:6px; padding:1px 8px; border-radius:50px;
                     font-size:11px; font-weight:700; background:#f3f4f6; color:#374151; }
.admin-tab.active .tab-count { background:var(--accent-primary); color:#fff; }
.tab-panel        { display:none; }
.tab-panel.active { display:block; }

.story-cover-thumb { width:48px; height:36px; object-fit:cover; border-radius:6px; }
.star-rating      { color:#f59e0b; font-size:13px; }
</style>

";
        // line 71
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 71, $this->source); })()), "flashes", ["success"], "method", false, false, false, 71));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-success\">✅ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 72, $this->source); })()), "flashes", ["info"], "method", false, false, false, 72));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            yield "<div class=\"flash-info\">ℹ️ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        yield "
";
        // line 75
        yield "<div class=\"stats-row\">
    <div class=\"stat-card\">
        <div class=\"num\">";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 77, $this->source); })()), "total", [], "any", false, false, false, 77), "html", null, true);
        yield "</div>
        <div class=\"lbl\">Total Posts</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#f59e0b;\">";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 81, $this->source); })()), "pending", [], "any", false, false, false, 81), "html", null, true);
        yield "</div>
        <div class=\"lbl\">Pending Approval</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#10b981;\">";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 85, $this->source); })()), "approved", [], "any", false, false, false, 85), "html", null, true);
        yield "</div>
        <div class=\"lbl\">Approved</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#ef4444;\">";
        // line 89
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 89, $this->source); })()), "stories", [], "any", false, false, false, 89), "html", null, true);
        yield "</div>
        <div class=\"lbl\">Travel Stories</div>
    </div>
</div>

";
        // line 95
        yield "<div class=\"admin-tabs\">
    <button class=\"admin-tab active\" onclick=\"switchTab('posts', this)\">
        📝 Posts <span class=\"tab-count\">";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 97, $this->source); })())), "html", null, true);
        yield "</span>
    </button>
    <button class=\"admin-tab\" onclick=\"switchTab('stories', this)\">
        🧳 Travel Stories <span class=\"tab-count\">";
        // line 100
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["stories"]) || array_key_exists("stories", $context) ? $context["stories"] : (function () { throw new RuntimeError('Variable "stories" does not exist.', 100, $this->source); })())), "html", null, true);
        yield "</span>
    </button>
</div>

";
        // line 105
        yield "<div class=\"tab-panel active\" id=\"tab-posts\">
    ";
        // line 106
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 106, $this->source); })()))) {
            // line 107
            yield "        <div class=\"empty-state\">
            <p style=\"font-size:42px;\">📭</p>
            <p>No posts yet.</p>
        </div>
    ";
        } else {
            // line 112
            yield "        <table class=\"blog-table\">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 125, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 126
                yield "                    <tr>
                        <td style=\"color:var(--text-muted); font-size:13px;\">";
                // line 127
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 127), "html", null, true);
                yield "</td>
                        <td class=\"post-title-cell\" title=\"";
                // line 128
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 128), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 128), "html", null, true);
                yield "</td>
                        <td>";
                // line 129
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "userId", [], "any", false, false, false, 129), [], "array", true, true, false, 129) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 129, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "userId", [], "any", false, false, false, 129), [], "array", false, false, false, 129)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 129, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "userId", [], "any", false, false, false, 129), [], "array", false, false, false, 129)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "userId", [], "any", false, false, false, 129)), "html", null, true);
                yield "</td>
                        <td>
                            <span class=\"type-dot type-";
                // line 131
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "type", [], "any", false, false, false, 131), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "type", [], "any", false, false, false, 131), "html", null, true);
                yield "</span>
                        </td>
                        <td>
                            ";
                // line 134
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "isConfirmed", [], "any", false, false, false, 134)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 135
                    yield "                                <span class=\"badge badge-approved\">✅ Approved</span>
                            ";
                } else {
                    // line 137
                    yield "                                <span class=\"badge badge-pending\">⏳ Pending</span>
                            ";
                }
                // line 139
                yield "                        </td>
                        <td style=\"font-size:13px; color:var(--text-muted);\">
                            ";
                // line 141
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 141)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 141), "d M Y"), "html", null, true);
                }
                // line 142
                yield "                        </td>
                        <td>
                            <div class=\"actions\">
                                ";
                // line 145
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["post"], "isConfirmed", [], "any", false, false, false, 145)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 146
                    yield "                                    <form method=\"post\"
                                          action=\"";
                    // line 147
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_blog_approve", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 147)]), "html", null, true);
                    yield "\">
                                        <input type=\"hidden\" name=\"_token\"
                                               value=\"";
                    // line 149
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("admin_blog_" . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 149))), "html", null, true);
                    yield "\">
                                        <button type=\"submit\" class=\"btn-approve\">Approve</button>
                                    </form>
                                ";
                }
                // line 153
                yield "
                                ";
                // line 154
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "isConfirmed", [], "any", false, false, false, 154)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 155
                    yield "                                    <form method=\"post\"
                                          action=\"";
                    // line 156
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_blog_reject", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 156)]), "html", null, true);
                    yield "\">
                                        <input type=\"hidden\" name=\"_token\"
                                               value=\"";
                    // line 158
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("admin_blog_" . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 158))), "html", null, true);
                    yield "\">
                                        <button type=\"submit\" class=\"btn-reject\">Reject</button>
                                    </form>
                                ";
                }
                // line 162
                yield "
                                <form method=\"post\"
                                      action=\"";
                // line 164
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_blog_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 164)]), "html", null, true);
                yield "\"
                                      onsubmit=\"return confirm('Delete this post permanently?');\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"";
                // line 167
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("admin_blog_delete_" . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 167))), "html", null, true);
                yield "\">
                                    <button type=\"submit\" class=\"btn-del\">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['post'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 174
            yield "            </tbody>
        </table>
    ";
        }
        // line 177
        yield "</div>

";
        // line 180
        yield "<div class=\"tab-panel\" id=\"tab-stories\">
    ";
        // line 181
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["stories"]) || array_key_exists("stories", $context) ? $context["stories"] : (function () { throw new RuntimeError('Variable "stories" does not exist.', 181, $this->source); })()))) {
            // line 182
            yield "        <div class=\"empty-state\">
            <p style=\"font-size:42px;\">🧳</p>
            <p>No travel stories yet.</p>
        </div>
    ";
        } else {
            // line 187
            yield "        <table class=\"blog-table\">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Destination</th>
                    <th>Type / Style</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 202
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stories"]) || array_key_exists("stories", $context) ? $context["stories"] : (function () { throw new RuntimeError('Variable "stories" does not exist.', 202, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
                // line 203
                yield "                    <tr>
                        <td style=\"color:var(--text-muted); font-size:13px;\">";
                // line 204
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 204), "html", null, true);
                yield "</td>
                        <td>
                            ";
                // line 206
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 206)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 207
                    yield "                                <img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "coverImageUrl", [], "any", false, false, false, 207), "html", null, true);
                    yield "\" alt=\"\" class=\"story-cover-thumb\">
                            ";
                } else {
                    // line 209
                    yield "                                <span style=\"color:var(--text-muted); font-size:12px;\">—</span>
                            ";
                }
                // line 211
                yield "                        </td>
                        <td class=\"post-title-cell\" title=\"";
                // line 212
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 212), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "title", [], "any", false, false, false, 212), "html", null, true);
                yield "</td>
                        <td>";
                // line 213
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((((CoreExtension::getAttribute($this->env, $this->source, ($context["authorMap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "userId", [], "any", false, false, false, 213), [], "array", true, true, false, 213) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 213, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "userId", [], "any", false, false, false, 213), [], "array", false, false, false, 213)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["authorMap"]) || array_key_exists("authorMap", $context) ? $context["authorMap"] : (function () { throw new RuntimeError('Variable "authorMap" does not exist.', 213, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "userId", [], "any", false, false, false, 213), [], "array", false, false, false, 213)) : ("User #")) . CoreExtension::getAttribute($this->env, $this->source, $context["story"], "userId", [], "any", false, false, false, 213)), "html", null, true);
                yield "</td>
                        <td>";
                // line 214
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", true, true, false, 214) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 214)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "destination", [], "any", false, false, false, 214), "html", null, true)) : ("—"));
                yield "</td>
                        <td>
                            ";
                // line 216
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 216)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 217
                    yield "                                <span class=\"type-dot type-travel\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelType", [], "any", false, false, false, 217), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 219
                yield "                            ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 220
                    yield "                                <span class=\"type-dot\" style=\"background:#ede9fe;color:#5b21b6;\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "travelStyle", [], "any", false, false, false, 220), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 222
                yield "                        </td>
                        <td>
                            ";
                // line 224
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 224)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 225
                    yield "                                <span class=\"star-rating\">
                                    ";
                    // line 226
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(range(1, CoreExtension::getAttribute($this->env, $this->source, $context["story"], "overallRating", [], "any", false, false, false, 226)));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        yield "⭐";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 227
                    yield "                                </span>
                            ";
                } else {
                    // line 229
                    yield "                                <span style=\"color:var(--text-muted);\">—</span>
                            ";
                }
                // line 231
                yield "                        </td>
                        <td style=\"font-size:13px; color:var(--text-muted);\">
                            ";
                // line 233
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "createdAt", [], "any", false, false, false, 233)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "createdAt", [], "any", false, false, false, 233), "d M Y"), "html", null, true);
                }
                // line 234
                yield "                        </td>
                        <td>
                            <div class=\"actions\">
                                <a href=\"";
                // line 237
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("travel_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 237)]), "html", null, true);
                yield "\" class=\"btn-view\">View</a>
                                <form method=\"post\"
                                      action=\"";
                // line 239
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_story_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 239)]), "html", null, true);
                yield "\"
                                      onsubmit=\"return confirm('Delete this travel story permanently?');\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"";
                // line 242
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("admin_story_delete_" . CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 242))), "html", null, true);
                yield "\">
                                    <button type=\"submit\" class=\"btn-del\">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['story'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 249
            yield "            </tbody>
        </table>
    ";
        }
        // line 252
        yield "</div>

<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
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
        return "admin/blog/blog.html.twig";
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
        return array (  548 => 252,  543 => 249,  530 => 242,  524 => 239,  519 => 237,  514 => 234,  510 => 233,  506 => 231,  502 => 229,  498 => 227,  489 => 226,  486 => 225,  484 => 224,  480 => 222,  474 => 220,  471 => 219,  465 => 217,  463 => 216,  458 => 214,  454 => 213,  448 => 212,  445 => 211,  441 => 209,  435 => 207,  433 => 206,  428 => 204,  425 => 203,  421 => 202,  404 => 187,  397 => 182,  395 => 181,  392 => 180,  388 => 177,  383 => 174,  370 => 167,  364 => 164,  360 => 162,  353 => 158,  348 => 156,  345 => 155,  343 => 154,  340 => 153,  333 => 149,  328 => 147,  325 => 146,  323 => 145,  318 => 142,  314 => 141,  310 => 139,  306 => 137,  302 => 135,  300 => 134,  292 => 131,  287 => 129,  281 => 128,  277 => 127,  274 => 126,  270 => 125,  255 => 112,  248 => 107,  246 => 106,  243 => 105,  236 => 100,  230 => 97,  226 => 95,  218 => 89,  211 => 85,  204 => 81,  197 => 77,  193 => 75,  190 => 73,  179 => 72,  168 => 71,  105 => 9,  95 => 8,  86 => 5,  76 => 4,  59 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}Blog Management — TripX Admin{% endblock %}

{% block breadcrumbs %}
  <span class=\"crumb active\">Blog</span>
{% endblock %}

{% block content %}
<style>
.stats-row        { display:flex; gap:16px; flex-wrap:wrap; margin-bottom:28px; }
.stat-card        { flex:1; min-width:140px; background:var(--bg-card); border:1px solid var(--border-color);
                     border-radius:var(--border-radius-md); padding:18px 20px; }
.stat-card .num   { font-size:32px; font-weight:900; color:var(--accent-primary); }
.stat-card .lbl   { font-size:13px; color:var(--text-muted); margin-top:2px; }

.blog-table       { width:100%; border-collapse:collapse; background:var(--bg-card);
                     border-radius:var(--border-radius-md); overflow:hidden;
                     border:1px solid var(--border-color); }
.blog-table th    { background:var(--bg-surface); padding:13px 16px; font-size:12px;
                     font-weight:700; text-transform:uppercase; letter-spacing:.5px;
                     color:var(--text-muted); text-align:left; border-bottom:1px solid var(--border-color); }
.blog-table td    { padding:14px 16px; font-size:14px; border-bottom:1px solid var(--border-color);
                     vertical-align:middle; }
.blog-table tr:last-child td { border-bottom:none; }
.blog-table tr:hover td      { background:var(--bg-surface); }

.badge            { display:inline-block; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700; }
.badge-pending    { background:#fef3c7; color:#92400e; }
.badge-approved   { background:#d1fae5; color:#065f46; }
.type-dot         { display:inline-block; padding:3px 8px; border-radius:50px; font-size:11px; font-weight:600; }
.type-inquiry     { background:#dbeafe; color:#1d4ed8; }
.type-story       { background:#d1fae5; color:#065f46; }
.type-review      { background:#fef3c7; color:#92400e; }
.type-advice      { background:#ede9fe; color:#5b21b6; }
.type-other       { background:#f3f4f6; color:#374151; }
.type-travel      { background:linear-gradient(135deg,#fef3c7,#fee2e2); color:#92400e; }

.actions          { display:flex; gap:6px; flex-wrap:wrap; }
.btn-approve      { padding:5px 12px; background:#d1fae5; color:#065f46; border:1px solid #6ee7b7;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-reject       { padding:5px 12px; background:#fef3c7; color:#92400e; border:1px solid #fcd34d;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-del          { padding:5px 12px; background:#fee2e2; color:#dc2626; border:1px solid #fca5a5;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; }
.btn-view         { padding:5px 12px; background:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd;
                     border-radius:50px; font-size:12px; font-weight:700; cursor:pointer; text-decoration:none; }

.post-title-cell  { max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; font-weight:700; }
.flash-success    { background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:10px; margin-bottom:18px; }
.flash-info       { background:#dbeafe; color:#1e40af; padding:12px 16px; border-radius:10px; margin-bottom:18px; }
.empty-state      { text-align:center; padding:50px; color:var(--text-muted); }

/* Tabs */
.admin-tabs       { display:flex; gap:0; margin-bottom:24px; border-bottom:2px solid var(--border-color); }
.admin-tab        { padding:12px 24px; font-size:14px; font-weight:700; cursor:pointer; border:none;
                     background:none; color:var(--text-muted); position:relative; }
.admin-tab.active { color:var(--accent-primary); }
.admin-tab.active::after { content:''; position:absolute; bottom:-2px; left:0; right:0; height:2px;
                     background:var(--accent-primary); }
.admin-tab .tab-count { display:inline-block; margin-left:6px; padding:1px 8px; border-radius:50px;
                     font-size:11px; font-weight:700; background:#f3f4f6; color:#374151; }
.admin-tab.active .tab-count { background:var(--accent-primary); color:#fff; }
.tab-panel        { display:none; }
.tab-panel.active { display:block; }

.story-cover-thumb { width:48px; height:36px; object-fit:cover; border-radius:6px; }
.star-rating      { color:#f59e0b; font-size:13px; }
</style>

{# ── Flash messages ── #}
{% for msg in app.flashes('success') %}<div class=\"flash-success\">✅ {{ msg }}</div>{% endfor %}
{% for msg in app.flashes('info') %}<div class=\"flash-info\">ℹ️ {{ msg }}</div>{% endfor %}

{# ── Stats ── #}
<div class=\"stats-row\">
    <div class=\"stat-card\">
        <div class=\"num\">{{ stats.total }}</div>
        <div class=\"lbl\">Total Posts</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#f59e0b;\">{{ stats.pending }}</div>
        <div class=\"lbl\">Pending Approval</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#10b981;\">{{ stats.approved }}</div>
        <div class=\"lbl\">Approved</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"num\" style=\"color:#ef4444;\">{{ stats.stories }}</div>
        <div class=\"lbl\">Travel Stories</div>
    </div>
</div>

{# ── Tabs ── #}
<div class=\"admin-tabs\">
    <button class=\"admin-tab active\" onclick=\"switchTab('posts', this)\">
        📝 Posts <span class=\"tab-count\">{{ posts|length }}</span>
    </button>
    <button class=\"admin-tab\" onclick=\"switchTab('stories', this)\">
        🧳 Travel Stories <span class=\"tab-count\">{{ stories|length }}</span>
    </button>
</div>

{# ── Posts Tab ── #}
<div class=\"tab-panel active\" id=\"tab-posts\">
    {% if posts is empty %}
        <div class=\"empty-state\">
            <p style=\"font-size:42px;\">📭</p>
            <p>No posts yet.</p>
        </div>
    {% else %}
        <table class=\"blog-table\">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for post in posts %}
                    <tr>
                        <td style=\"color:var(--text-muted); font-size:13px;\">{{ post.id }}</td>
                        <td class=\"post-title-cell\" title=\"{{ post.title }}\">{{ post.title }}</td>
                        <td>{{ authorMap[post.userId] ?? 'User #' ~ post.userId }}</td>
                        <td>
                            <span class=\"type-dot type-{{ post.type }}\">{{ post.type }}</span>
                        </td>
                        <td>
                            {% if post.isConfirmed %}
                                <span class=\"badge badge-approved\">✅ Approved</span>
                            {% else %}
                                <span class=\"badge badge-pending\">⏳ Pending</span>
                            {% endif %}
                        </td>
                        <td style=\"font-size:13px; color:var(--text-muted);\">
                            {% if post.createdAt %}{{ post.createdAt|date('d M Y') }}{% endif %}
                        </td>
                        <td>
                            <div class=\"actions\">
                                {% if not post.isConfirmed %}
                                    <form method=\"post\"
                                          action=\"{{ path('admin_blog_approve', {id: post.id}) }}\">
                                        <input type=\"hidden\" name=\"_token\"
                                               value=\"{{ csrf_token('admin_blog_' ~ post.id) }}\">
                                        <button type=\"submit\" class=\"btn-approve\">Approve</button>
                                    </form>
                                {% endif %}

                                {% if post.isConfirmed %}
                                    <form method=\"post\"
                                          action=\"{{ path('admin_blog_reject', {id: post.id}) }}\">
                                        <input type=\"hidden\" name=\"_token\"
                                               value=\"{{ csrf_token('admin_blog_' ~ post.id) }}\">
                                        <button type=\"submit\" class=\"btn-reject\">Reject</button>
                                    </form>
                                {% endif %}

                                <form method=\"post\"
                                      action=\"{{ path('admin_blog_delete', {id: post.id}) }}\"
                                      onsubmit=\"return confirm('Delete this post permanently?');\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"{{ csrf_token('admin_blog_delete_' ~ post.id) }}\">
                                    <button type=\"submit\" class=\"btn-del\">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    {% endif %}
</div>

{# ── Travel Stories Tab ── #}
<div class=\"tab-panel\" id=\"tab-stories\">
    {% if stories is empty %}
        <div class=\"empty-state\">
            <p style=\"font-size:42px;\">🧳</p>
            <p>No travel stories yet.</p>
        </div>
    {% else %}
        <table class=\"blog-table\">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Destination</th>
                    <th>Type / Style</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for story in stories %}
                    <tr>
                        <td style=\"color:var(--text-muted); font-size:13px;\">{{ story.id }}</td>
                        <td>
                            {% if story.coverImageUrl %}
                                <img src=\"{{ story.coverImageUrl }}\" alt=\"\" class=\"story-cover-thumb\">
                            {% else %}
                                <span style=\"color:var(--text-muted); font-size:12px;\">—</span>
                            {% endif %}
                        </td>
                        <td class=\"post-title-cell\" title=\"{{ story.title }}\">{{ story.title }}</td>
                        <td>{{ authorMap[story.userId] ?? 'User #' ~ story.userId }}</td>
                        <td>{{ story.destination ?? '—' }}</td>
                        <td>
                            {% if story.travelType %}
                                <span class=\"type-dot type-travel\">{{ story.travelType }}</span>
                            {% endif %}
                            {% if story.travelStyle %}
                                <span class=\"type-dot\" style=\"background:#ede9fe;color:#5b21b6;\">{{ story.travelStyle }}</span>
                            {% endif %}
                        </td>
                        <td>
                            {% if story.overallRating %}
                                <span class=\"star-rating\">
                                    {% for i in 1..story.overallRating %}⭐{% endfor %}
                                </span>
                            {% else %}
                                <span style=\"color:var(--text-muted);\">—</span>
                            {% endif %}
                        </td>
                        <td style=\"font-size:13px; color:var(--text-muted);\">
                            {% if story.createdAt %}{{ story.createdAt|date('d M Y') }}{% endif %}
                        </td>
                        <td>
                            <div class=\"actions\">
                                <a href=\"{{ path('travel_story_show', {id: story.id}) }}\" class=\"btn-view\">View</a>
                                <form method=\"post\"
                                      action=\"{{ path('admin_story_delete', {id: story.id}) }}\"
                                      onsubmit=\"return confirm('Delete this travel story permanently?');\">
                                    <input type=\"hidden\" name=\"_token\"
                                           value=\"{{ csrf_token('admin_story_delete_' ~ story.id) }}\">
                                    <button type=\"submit\" class=\"btn-del\">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    {% endif %}
</div>

<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}
</script>

{% endblock %}", "admin/blog/blog.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\admin\\blog\\blog.html.twig");
    }
}
