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

/* admin/users.html.twig */
class __TwigTemplate_bea18d68695629a25881d59b135b5139 extends Template
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
            'page_styles' => [$this, 'block_page_styles'],
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/users.html.twig"));

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

        yield "Manage Users — TripX Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_styles"));

        // line 5
        yield "  .user-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
  }
  .user-table th {
    background: rgba(0,166,237,0.05);
    text-align: left;
    padding: 16px 20px;
    font-family: var(--font-display);
    font-size: 14px;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    border-bottom: 2px solid var(--border-color);
  }
  .user-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
  }
  .user-table tr:last-child td { border-bottom: none; }
  .user-table tr:hover { background: rgba(255,255,255,0.02); }
  
  .user-meta { display: flex; align-items: center; gap: 12px; }
  .user-avatar { 
    width: 40px; height: 40px; 
    border-radius: 50%; 
    background: var(--accent-primary); 
    display: flex; align-items: center; justify-content: center; 
    color: #fff; font-weight: 700;
  }
  .search-wrap {
    margin-bottom: 24px;
    display: flex;
    gap: 16px;
  }
  .search-input {
    flex: 1;
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    padding: 12px 20px;
    border-radius: 8px;
    color: var(--text-main);
  }
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
  }
  .stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    padding: 20px;
    border-radius: var(--border-radius-lg);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  .chart-container-small {
    width: 100%;
    height: 180px;
    position: relative;
  }
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 76
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumbs"));

        // line 77
        yield "  <span class=\"crumb active\">Users</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 81
        yield "  <div class=\"reveal\">
    <h1 class=\"display-md\" style=\"margin-bottom:6px;\">Platform <span class=\"text-coral\">Users</span></h1>
    <p class=\"text-muted\" style=\"margin-bottom:36px;\">Manage accounts, permissions, and security status.</p>
  </div>

  <div class=\"stats-grid reveal stagger\">
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">GENDER DISTRIBUTION</div>
      <div class=\"chart-container-small\">
        <canvas id=\"userGenderChart\"></canvas>
      </div>
    </div>
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">USER GROWTH</div>
      <div class=\"chart-container-small\">
        <canvas id=\"userGrowthChart\"></canvas>
      </div>
      <div style=\"margin-top:10px; font-size:24px; font-weight:700;\">";
        // line 98
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 98, $this->source); })()), "totalUsers", [], "any", false, false, false, 98), "html", null, true);
        yield "</div>
      <div style=\"font-size:12px; color:#10b981;\">+12% vs last month</div>
    </div>
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">GLOBAL ACTIVITY</div>
      <div style=\"font-size:48px; margin: 20px 0;\">📊</div>
      <div style=\"font-size:24px; font-weight:700;\">";
        // line 104
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 104, $this->source); })()), "totalLogs", [], "any", false, false, false, 104), "html", null, true);
        yield "</div>
      <div style=\"font-size:12px; color:var(--text-muted);\">Total Events Logged</div>
    </div>
  </div>

  <div class=\"search-wrap reveal\">
    <form method=\"get\" action=\"";
        // line 110
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" style=\"display:flex; width:100%; gap:12px;\">
      <input type=\"text\" name=\"q\" value=\"";
        // line 111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 111, $this->source); })()), "html", null, true);
        yield "\" class=\"search-input\" placeholder=\"Search by name or email...\" style=\"margin-bottom:0;\">
      <button type=\"submit\" class=\"btn btn-primary\">Search</button>
      ";
        // line 113
        if ((($tmp = (isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 113, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 114
            yield "        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
            yield "\" class=\"btn btn-secondary\">Clear</a>
      ";
        }
        // line 116
        yield "    </form>
  </div>

  <div class=\"reveal stagger\">
    <table class=\"user-table\">
      <thead>
        <tr>
          <th>
            <a href=\"";
        // line 124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users", ["q" => (isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 124, $this->source); })()), "sort" => "userId", "order" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 124, $this->source); })()) == "userId") && ((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 124, $this->source); })()) == "ASC"))) ? ("DESC") : ("ASC"))]), "html", null, true);
        yield "\" style=\"color:inherit; text-decoration:none;\">
              ID ";
        // line 125
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 125, $this->source); })()) == "userId")) ? (((((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 125, $this->source); })()) == "ASC")) ? ("↑") : ("↓"))) : (""));
        yield "
            </a>
          </th>
          <th>
            <a href=\"";
        // line 129
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users", ["q" => (isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 129, $this->source); })()), "sort" => "firstName", "order" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 129, $this->source); })()) == "firstName") && ((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 129, $this->source); })()) == "ASC"))) ? ("DESC") : ("ASC"))]), "html", null, true);
        yield "\" style=\"color:inherit; text-decoration:none;\">
              User ";
        // line 130
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 130, $this->source); })()) == "firstName")) ? (((((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 130, $this->source); })()) == "ASC")) ? ("↑") : ("↓"))) : (""));
        yield "
            </a>
          </th>
          <th>
            <a href=\"";
        // line 134
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users", ["q" => (isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 134, $this->source); })()), "sort" => "roles", "order" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 134, $this->source); })()) == "roles") && ((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 134, $this->source); })()) == "ASC"))) ? ("DESC") : ("ASC"))]), "html", null, true);
        yield "\" style=\"color:inherit; text-decoration:none;\">
              Role ";
        // line 135
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 135, $this->source); })()) == "roles")) ? (((((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 135, $this->source); })()) == "ASC")) ? ("↑") : ("↓"))) : (""));
        yield "
            </a>
          </th>
          <th>
            <a href=\"";
        // line 139
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users", ["q" => (isset($context["currentQuery"]) || array_key_exists("currentQuery", $context) ? $context["currentQuery"] : (function () { throw new RuntimeError('Variable "currentQuery" does not exist.', 139, $this->source); })()), "sort" => "status", "order" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 139, $this->source); })()) == "status") && ((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 139, $this->source); })()) == "ASC"))) ? ("DESC") : ("ASC"))]), "html", null, true);
        yield "\" style=\"color:inherit; text-decoration:none;\">
              Status ";
        // line 140
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 140, $this->source); })()) == "status")) ? (((((isset($context["currentOrder"]) || array_key_exists("currentOrder", $context) ? $context["currentOrder"] : (function () { throw new RuntimeError('Variable "currentOrder" does not exist.', 140, $this->source); })()) == "ASC")) ? ("↑") : ("↓"))) : (""));
        yield "
            </a>
          </th>
          <th>Birth Year / Gender</th>
          <th style=\"text-align:right\">Actions</th>
        </tr>
      </thead>
      <tbody>
        ";
        // line 148
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 148, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 149
            yield "        <tr>
          <td>
            <div class=\"user-meta\">
              <div class=\"user-avatar\" style=\"background: ";
            // line 152
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "gender", [], "any", false, false, false, 152) == "Female")) ? ("#ff4d6d") : ("#00a6ed"));
            yield "\">
                ";
            // line 153
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["u"], "firstName", [], "any", false, false, false, 153))), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["u"], "lastName", [], "any", false, false, false, 153))), "html", null, true);
            yield "
              </div>
              <div>
                <div style=\"font-weight:600\">";
            // line 156
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "firstName", [], "any", false, false, false, 156), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "lastName", [], "any", false, false, false, 156), "html", null, true);
            yield "</div>
                <div style=\"font-size:12px; color:var(--text-muted)\">";
            // line 157
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "email", [], "any", false, false, false, 157), "html", null, true);
            yield "</div>
              </div>
            </div>
          </td>
          <td><span class=\"badge ";
            // line 161
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 161) == "admin")) ? ("badge-coral") : ("badge-teal"));
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["u"], "role", [], "any", false, false, false, 161)), "html", null, true);
            yield "</span></td>
          <td>
             <span style=\"display:inline-block; width:8px; height:8px; border-radius:50%; background:";
            // line 163
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 163) == "active")) ? ("#10b981") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 163) == "banned")) ? ("#ef4444") : ("#f59e0b"))));
            yield "; margin-right:6px;\"></span>
             <span style=\"color:";
            // line 164
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 164) == "banned")) ? ("#ef4444") : ("inherit"));
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 164), ["_" => " "])), "html", null, true);
            yield "</span>
          </td>
          <td style=\"font-size:13px;\">";
            // line 166
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "birthYear", [], "any", true, true, false, 166)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "birthYear", [], "any", false, false, false, 166), "N/A")) : ("N/A")), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "gender", [], "any", true, true, false, 166)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "gender", [], "any", false, false, false, 166), "N/A")) : ("N/A")), "html", null, true);
            yield "</td>
          <td style=\"text-align:right\">
            <div style=\"display:flex; justify-content:flex-end; gap:8px;\">
               <a href=\"";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "userId", [], "any", false, false, false, 169)]), "html", null, true);
            yield "\" class=\"btn btn-secondary btn-sm\">Edit</a>
               ";
            // line 170
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 170) != "banned")) {
                // line 171
                yield "                 <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_ban", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "userId", [], "any", false, false, false, 171)]), "html", null, true);
                yield "\" class=\"btn btn-secondary btn-sm\" style=\"color:#ef4444\" onclick=\"return confirm('Ban this user?')\">Ban</a>
               ";
            }
            // line 173
            yield "               <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_user_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["u"], "userId", [], "any", false, false, false, 173)]), "html", null, true);
            yield "\" class=\"btn btn-primary btn-sm\" onclick=\"return confirm('Delete permanently?')\">Delete</a>
            </div>
          </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 178
        yield "      </tbody>
    </table>
  </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 183
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 184
        yield "  <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Gender Distribution Chart
      const ctxGender = document.getElementById('userGenderChart').getContext('2d');
      new Chart(ctxGender, {
        type: 'doughnut',
        data: {
          labels: ['Male', 'Female'],
          datasets: [{
            data: [";
        // line 194
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 194, $this->source); })()), "males", [], "any", false, false, false, 194), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 194, $this->source); })()), "females", [], "any", false, false, false, 194), "html", null, true);
        yield "],
            backgroundColor: ['#00a6ed', '#ff4d6d'],
            borderWidth: 0,
            cutout: '70%'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: 'bottom', labels: { color: '#8898aa', boxWidth: 12 } } }
        }
      });

      // Simple Growth Chart (Mock data for now)
      const ctxGrowth = document.getElementById('userGrowthChart').getContext('2d');
      new Chart(ctxGrowth, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [{
            label: 'New Users',
            data: [12, 19, 30, 25, 45, ";
        // line 215
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 215, $this->source); })()), "totalUsers", [], "any", false, false, false, 215), "html", null, true);
        yield "],
            borderColor: '#00a6ed',
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(0,166,237,0.1)'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: { y: { display: false }, x: { display: false } },
          plugins: { legend: { display: false } }
        }
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
        return "admin/users.html.twig";
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
        return array (  448 => 215,  422 => 194,  410 => 184,  400 => 183,  389 => 178,  377 => 173,  371 => 171,  369 => 170,  365 => 169,  357 => 166,  350 => 164,  346 => 163,  339 => 161,  332 => 157,  326 => 156,  319 => 153,  315 => 152,  310 => 149,  306 => 148,  295 => 140,  291 => 139,  284 => 135,  280 => 134,  273 => 130,  269 => 129,  262 => 125,  258 => 124,  248 => 116,  242 => 114,  240 => 113,  235 => 111,  231 => 110,  222 => 104,  213 => 98,  194 => 81,  184 => 80,  175 => 77,  165 => 76,  88 => 5,  78 => 4,  61 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/admin_base.html.twig' %}
{% block title %}Manage Users — TripX Admin{% endblock %}

{% block page_styles %}
  .user-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
  }
  .user-table th {
    background: rgba(0,166,237,0.05);
    text-align: left;
    padding: 16px 20px;
    font-family: var(--font-display);
    font-size: 14px;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    border-bottom: 2px solid var(--border-color);
  }
  .user-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
  }
  .user-table tr:last-child td { border-bottom: none; }
  .user-table tr:hover { background: rgba(255,255,255,0.02); }
  
  .user-meta { display: flex; align-items: center; gap: 12px; }
  .user-avatar { 
    width: 40px; height: 40px; 
    border-radius: 50%; 
    background: var(--accent-primary); 
    display: flex; align-items: center; justify-content: center; 
    color: #fff; font-weight: 700;
  }
  .search-wrap {
    margin-bottom: 24px;
    display: flex;
    gap: 16px;
  }
  .search-input {
    flex: 1;
    background: var(--bg-surface);
    border: 1px solid var(--border-color);
    padding: 12px 20px;
    border-radius: 8px;
    color: var(--text-main);
  }
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
  }
  .stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    padding: 20px;
    border-radius: var(--border-radius-lg);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  .chart-container-small {
    width: 100%;
    height: 180px;
    position: relative;
  }
{% endblock %}

{% block breadcrumbs %}
  <span class=\"crumb active\">Users</span>
{% endblock %}

{% block content %}
  <div class=\"reveal\">
    <h1 class=\"display-md\" style=\"margin-bottom:6px;\">Platform <span class=\"text-coral\">Users</span></h1>
    <p class=\"text-muted\" style=\"margin-bottom:36px;\">Manage accounts, permissions, and security status.</p>
  </div>

  <div class=\"stats-grid reveal stagger\">
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">GENDER DISTRIBUTION</div>
      <div class=\"chart-container-small\">
        <canvas id=\"userGenderChart\"></canvas>
      </div>
    </div>
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">USER GROWTH</div>
      <div class=\"chart-container-small\">
        <canvas id=\"userGrowthChart\"></canvas>
      </div>
      <div style=\"margin-top:10px; font-size:24px; font-weight:700;\">{{ stats.totalUsers }}</div>
      <div style=\"font-size:12px; color:#10b981;\">+12% vs last month</div>
    </div>
    <div class=\"stat-card\">
      <div style=\"font-family:var(--font-mono); font-size:11px; color:var(--text-muted); margin-bottom:10px;\">GLOBAL ACTIVITY</div>
      <div style=\"font-size:48px; margin: 20px 0;\">📊</div>
      <div style=\"font-size:24px; font-weight:700;\">{{ stats.totalLogs }}</div>
      <div style=\"font-size:12px; color:var(--text-muted);\">Total Events Logged</div>
    </div>
  </div>

  <div class=\"search-wrap reveal\">
    <form method=\"get\" action=\"{{ path('admin_users') }}\" style=\"display:flex; width:100%; gap:12px;\">
      <input type=\"text\" name=\"q\" value=\"{{ currentQuery }}\" class=\"search-input\" placeholder=\"Search by name or email...\" style=\"margin-bottom:0;\">
      <button type=\"submit\" class=\"btn btn-primary\">Search</button>
      {% if currentQuery %}
        <a href=\"{{ path('admin_users') }}\" class=\"btn btn-secondary\">Clear</a>
      {% endif %}
    </form>
  </div>

  <div class=\"reveal stagger\">
    <table class=\"user-table\">
      <thead>
        <tr>
          <th>
            <a href=\"{{ path('admin_users', {q: currentQuery, sort: 'userId', order: currentSort == 'userId' and currentOrder == 'ASC' ? 'DESC' : 'ASC'}) }}\" style=\"color:inherit; text-decoration:none;\">
              ID {{ currentSort == 'userId' ? (currentOrder == 'ASC' ? '↑' : '↓') : '' }}
            </a>
          </th>
          <th>
            <a href=\"{{ path('admin_users', {q: currentQuery, sort: 'firstName', order: currentSort == 'firstName' and currentOrder == 'ASC' ? 'DESC' : 'ASC'}) }}\" style=\"color:inherit; text-decoration:none;\">
              User {{ currentSort == 'firstName' ? (currentOrder == 'ASC' ? '↑' : '↓') : '' }}
            </a>
          </th>
          <th>
            <a href=\"{{ path('admin_users', {q: currentQuery, sort: 'roles', order: currentSort == 'roles' and currentOrder == 'ASC' ? 'DESC' : 'ASC'}) }}\" style=\"color:inherit; text-decoration:none;\">
              Role {{ currentSort == 'roles' ? (currentOrder == 'ASC' ? '↑' : '↓') : '' }}
            </a>
          </th>
          <th>
            <a href=\"{{ path('admin_users', {q: currentQuery, sort: 'status', order: currentSort == 'status' and currentOrder == 'ASC' ? 'DESC' : 'ASC'}) }}\" style=\"color:inherit; text-decoration:none;\">
              Status {{ currentSort == 'status' ? (currentOrder == 'ASC' ? '↑' : '↓') : '' }}
            </a>
          </th>
          <th>Birth Year / Gender</th>
          <th style=\"text-align:right\">Actions</th>
        </tr>
      </thead>
      <tbody>
        {% for u in users %}
        <tr>
          <td>
            <div class=\"user-meta\">
              <div class=\"user-avatar\" style=\"background: {{ u.gender == 'Female' ? '#ff4d6d' : '#00a6ed' }}\">
                {{ u.firstName|first|upper }}{{ u.lastName|first|upper }}
              </div>
              <div>
                <div style=\"font-weight:600\">{{ u.firstName }} {{ u.lastName }}</div>
                <div style=\"font-size:12px; color:var(--text-muted)\">{{ u.email }}</div>
              </div>
            </div>
          </td>
          <td><span class=\"badge {{ u.role == 'admin' ? 'badge-coral' : 'badge-teal' }}\">{{ u.role|upper }}</span></td>
          <td>
             <span style=\"display:inline-block; width:8px; height:8px; border-radius:50%; background:{{ u.status == 'active' ? '#10b981' : (u.status == 'banned' ? '#ef4444' : '#f59e0b') }}; margin-right:6px;\"></span>
             <span style=\"color:{{ u.status == 'banned' ? '#ef4444' : 'inherit' }}\">{{ u.status|replace({'_': ' '})|capitalize }}</span>
          </td>
          <td style=\"font-size:13px;\">{{ u.birthYear|default('N/A') }} / {{ u.gender|default('N/A') }}</td>
          <td style=\"text-align:right\">
            <div style=\"display:flex; justify-content:flex-end; gap:8px;\">
               <a href=\"{{ path('admin_user_edit', {id: u.userId}) }}\" class=\"btn btn-secondary btn-sm\">Edit</a>
               {% if u.status != 'banned' %}
                 <a href=\"{{ path('admin_user_ban', {id: u.userId}) }}\" class=\"btn btn-secondary btn-sm\" style=\"color:#ef4444\" onclick=\"return confirm('Ban this user?')\">Ban</a>
               {% endif %}
               <a href=\"{{ path('admin_user_delete', {id: u.userId}) }}\" class=\"btn btn-primary btn-sm\" onclick=\"return confirm('Delete permanently?')\">Delete</a>
            </div>
          </td>
        </tr>
        {% endfor %}
      </tbody>
    </table>
  </div>
{% endblock %}

{% block javascripts %}
  <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Gender Distribution Chart
      const ctxGender = document.getElementById('userGenderChart').getContext('2d');
      new Chart(ctxGender, {
        type: 'doughnut',
        data: {
          labels: ['Male', 'Female'],
          datasets: [{
            data: [{{ stats.males }}, {{ stats.females }}],
            backgroundColor: ['#00a6ed', '#ff4d6d'],
            borderWidth: 0,
            cutout: '70%'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: 'bottom', labels: { color: '#8898aa', boxWidth: 12 } } }
        }
      });

      // Simple Growth Chart (Mock data for now)
      const ctxGrowth = document.getElementById('userGrowthChart').getContext('2d');
      new Chart(ctxGrowth, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [{
            label: 'New Users',
            data: [12, 19, 30, 25, 45, {{ stats.totalUsers }}],
            borderColor: '#00a6ed',
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(0,166,237,0.1)'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: { y: { display: false }, x: { display: false } },
          plugins: { legend: { display: false } }
        }
      });
    });
  </script>
{% endblock %}
", "admin/users.html.twig", "C:\\Users\\sbent\\Downloads\\composer\\templates\\admin\\users.html.twig");
    }
}
