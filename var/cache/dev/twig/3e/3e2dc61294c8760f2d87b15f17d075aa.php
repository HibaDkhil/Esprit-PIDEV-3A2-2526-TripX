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

/* front/index.html.twig */
class __TwigTemplate_43694d5bfea270697ee851b23eec597e extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/index.html.twig"));

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

        yield "TripX — Discover the Future of Travel";
        
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
        yield "  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    :root {
      --nav-height: 80px;
    }
    #particle-canvas {
      position: absolute;
      inset: 0;
      z-index: 2;
      pointer-events: none;
    }
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: #020816;
    }
    .hero-bg-img {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.5s ease;
      z-index: 1;
      pointer-events: none;
    }
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at center, rgba(2,8,22,0.4) 0%, rgba(2,8,22,0.85) 100%);
      z-index: 3;
    }
    .hero-content {
      position: relative;
      z-index: 5;
      max-width: var(--container-max);
      margin-inline: auto;
      padding: 40px 32px;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      gap: 40px;
    }
    .hero-headline {
      font-family: var(--font-display);
      font-size: clamp(40px, 8vw, 110px);
      line-height: 0.95;
      font-weight: 800;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: -0.02em;
    }
    .hero-headline span {
      display: inline-block;
      animation: fade-in-up 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) both;
    }
    .search-bar-container {
      width: 100%;
      max-width: 900px;
      animation: fade-in-up 1s ease 0.5s both;
    }
  </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 78
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 79
        yield "<!-- Hero Section -->
<section class=\"hero\">
  <canvas id=\"particle-canvas\"></canvas>
  <div class=\"hero-bg-img\" style=\"background-image: url('/images/view1.jpg'); opacity: 1;\"></div>
  <div class=\"hero-overlay\"></div>

  <div class=\"hero-content\">
    <div class=\"reveal\">
      <h1 class=\"hero-headline\">Discover the<br><span class=\"gradient-text\">Future of Travel</span></h1>
      <p class=\"hero-subtitle\" style=\"color: rgba(255,255,255,0.7); font-size: 1.2rem; margin-top: 20px;\">AI-Powered curated experiences for the modern explorer.</p>
    </div>

    <div class=\"search-bar-container\">
      <form action=\"";
        // line 92
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("search");
        yield "\" method=\"GET\" class=\"search-bar\">
        <input type=\"text\" name=\"q\" id=\"search-destination\" class=\"search-input\" style=\"flex:2;\" placeholder=\"Where to next? (e.g. Mars, Bali, Paris)\">
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">Start</span>
          <input type=\"date\" name=\"start\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none; max-width:110px;\">
        </div>
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">End</span>
          <input type=\"date\" name=\"end\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none; max-width:110px;\">
        </div>
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">Guests</span>
          <select name=\"guests\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none;\">
            <option value=\"1\">1 Adult</option>
            <option value=\"2\" selected>2 Adults</option>
            <option value=\"3\">3 Adults</option>
            <option value=\"4+\">4+ Adults</option>
          </select>
        </div>
        <button type=\"submit\" class=\"btn-primary ripple-btn\" style=\"padding: 12px 28px; border-radius: 12px; margin-left: 8px;\">Explore</button>
      </form>
    </div>
  </div>
</section>

<!-- Trending Section -->
<section class=\"section container\">
  <div class=\"section-label\"><span>Trending Destinations</span></div>
  <h2 class=\"section-title\">Popular This Week</h2>
  <div class=\"trending-scroll stagger\">
    ";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Bali", "Paris", "Tokyo", "Switzerland", "New York"]);
        foreach ($context['_seq'] as $context["_key"] => $context["dest"]) {
            // line 126
            yield "    <div class=\"trending-item ripple-btn\">
      <img src=\"/images/destinations/";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["dest"], "html", null, true);
            yield ".jfif\" class=\"trending-bg\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["dest"], "html", null, true);
            yield "\">
      <div class=\"trending-overlay\"></div>
      <div class=\"trending-info\">
        <div class=\"trending-name\">";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["dest"], "html", null, true);
            yield "</div>
        <div class=\"ai-badge\">98% Match</div>
      </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['dest'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 135
        yield "  </div>
</section>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">🤖</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">🤖</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Travel Assistant</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);background:none;border:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hello! I can suggest destinations, accommodations, and activities from TripX data.</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA anything...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>

<script src=\"/assets.php?f=js/main.js\"></script>
<script>
  // Particle Background Logic
  const canvas = document.getElementById('particle-canvas');
  if (canvas) {
    const ctx = canvas.getContext('2d');
    let pts = [];
    function init() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      pts = [];
      for(let i=0; i<80; i++) pts.push({x: Math.random()*canvas.width, y: Math.random()*canvas.height, s: Math.random()*2+1, vx: (Math.random()-0.5)*0.5, vy: (Math.random()-0.5)*0.5});
    }
    function anim() {
      ctx.clearRect(0,0,canvas.width,canvas.height);
      ctx.fillStyle = 'rgba(14,165,255,0.4)';
      pts.forEach(p => {
        p.x += p.vx; p.y += p.vy;
        if(p.x<0) p.x=canvas.width; if(p.x>canvas.width) p.x=0;
        if(p.y<0) p.y=canvas.height; if(p.y>canvas.height) p.y=0;
        ctx.beginPath(); ctx.arc(p.x, p.y, p.s, 0, Math.PI*2); ctx.fill();
      });
      requestAnimationFrame(anim);
    }
    window.addEventListener('resize', init);
    init(); anim();
  }
</script>

<!-- Accommodations Section -->
<section class=\"section bg-light\" style=\"padding-top:80px; padding-bottom:80px;\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>Where to Stay</span></div>
    <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Curated Accommodations</h2>
    <div class=\"grid-3 stagger\" style=\"margin-top:40px;\">
      <div class=\"card interactive\">
        <img src=\"/assets.php?f=images/accomodations/hotel1.jfif\" style=\"width:100%; height:200px; object-fit:cover; border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0;\" alt=\"Hotel\">
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">The Glass Cabins</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Northern Lights views from your bed.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€350/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
      <div class=\"card interactive\">
        <div style=\"width:100%; height:200px; background:linear-gradient(45deg,#0ea5e9,#0284c7); border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0; display:flex; align-items:center; justify-content:center; color:white; font-size:40px;\">🌴</div>
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">Oceanfront Villa</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Private infinity pool in Bali.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€820/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
      <div class=\"card interactive\">
        <div style=\"width:100%; height:200px; background:linear-gradient(45deg,#f43f5e,#e11d48); border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0; display:flex; align-items:center; justify-content:center; color:white; font-size:40px;\">🗼</div>
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">Parisian Flat</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Wake up to the Eiffel Tower.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€210/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Offers Section -->
<section class=\"section container\">
  <div class=\"section-label reveal\"><span>Exclusive Deals</span></div>
  <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Unlock the World</h2>
  <div class=\"grid-2 stagger\" style=\"margin-top:40px;\">
    <div style=\"background:var(--bg-card); border-radius:var(--border-radius-lg); padding:32px; display:flex; gap:24px; align-items:center; border:1px solid var(--border-color);\">
      <div style=\"font-size:48px;\">✈️</div>
      <div>
        <h3 style=\"font-family: var(--font-display);\">Europe Summer Pass</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Unlimited train travel for 30 days.</p>
        <span class=\"badge badge-primary\" style=\"margin-top:12px; display:inline-block;\">Save 25%</span>
      </div>
    </div>
    <div style=\"background:var(--bg-card); border-radius:var(--border-radius-lg); padding:32px; display:flex; gap:24px; align-items:center; border:1px solid var(--border-color);\">
      <div style=\"font-size:48px;\">🎒</div>
      <div>
        <h3 style=\"font-family: var(--font-display);\">Backpacker Bundle</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Hostels + Flights combo across SE Asia.</p>
        <span class=\"badge badge-teal\" style=\"margin-top:12px; display:inline-block;\">Hot Deal</span>
      </div>
    </div>
  </div>
</section>

<!-- AI Tools Section -->
<section class=\"section bg-light\" style=\"padding-top:80px; padding-bottom:120px;\">
  <div class=\"container text-center\">
    <div class=\"section-label reveal\" style=\"justify-content:center;\"><span>AI Features</span></div>
    <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Travel, Powered by Intelligence</h2>
    <p class=\"text-muted reveal\" style=\"max-width:600px; margin:0 auto 40px auto;\">TripX's proprietary AI models understand your precise traveling style to build itineraries you'll love.</p>
    
    <div class=\"grid-3 stagger\">
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">🤖</div>
        <h3 style=\"font-family: var(--font-display);\">ARIA Assistant</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Chat with your personal travel concierge 24/7. Open ARIA in the corner to begin.</p>
      </div>
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">🧬</div>
        <h3 style=\"font-family: var(--font-display);\">Travel DNA</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Our AI learns your personality combining Adventure, Culture, and Culinary preferences.</p>
      </div>
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">⚡</div>
        <h3 style=\"font-family: var(--font-display);\">Live Itineraries</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Dynamic routing that actively adjusts due to weather, traffic, or mood.</p>
      </div>
    </div>
  </div>
</section>
<!-- JavaScript -->
<script src=\"/assets.php?f=js/main.js\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/index.html.twig";
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
        return array (  251 => 135,  240 => 130,  232 => 127,  229 => 126,  225 => 125,  189 => 92,  174 => 79,  164 => 78,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}TripX — Discover the Future of Travel{% endblock %}

{% block stylesheets %}
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/main.css\">
  <link rel=\"stylesheet\" href=\"/assets.php?f=css/animations.css\">
  <style>
    :root {
      --nav-height: 80px;
    }
    #particle-canvas {
      position: absolute;
      inset: 0;
      z-index: 2;
      pointer-events: none;
    }
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: #020816;
    }
    .hero-bg-img {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.5s ease;
      z-index: 1;
      pointer-events: none;
    }
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at center, rgba(2,8,22,0.4) 0%, rgba(2,8,22,0.85) 100%);
      z-index: 3;
    }
    .hero-content {
      position: relative;
      z-index: 5;
      max-width: var(--container-max);
      margin-inline: auto;
      padding: 40px 32px;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      gap: 40px;
    }
    .hero-headline {
      font-family: var(--font-display);
      font-size: clamp(40px, 8vw, 110px);
      line-height: 0.95;
      font-weight: 800;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: -0.02em;
    }
    .hero-headline span {
      display: inline-block;
      animation: fade-in-up 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) both;
    }
    .search-bar-container {
      width: 100%;
      max-width: 900px;
      animation: fade-in-up 1s ease 0.5s both;
    }
  </style>
{% endblock %}

{% block body %}
<!-- Hero Section -->
<section class=\"hero\">
  <canvas id=\"particle-canvas\"></canvas>
  <div class=\"hero-bg-img\" style=\"background-image: url('/images/view1.jpg'); opacity: 1;\"></div>
  <div class=\"hero-overlay\"></div>

  <div class=\"hero-content\">
    <div class=\"reveal\">
      <h1 class=\"hero-headline\">Discover the<br><span class=\"gradient-text\">Future of Travel</span></h1>
      <p class=\"hero-subtitle\" style=\"color: rgba(255,255,255,0.7); font-size: 1.2rem; margin-top: 20px;\">AI-Powered curated experiences for the modern explorer.</p>
    </div>

    <div class=\"search-bar-container\">
      <form action=\"{{ path('search') }}\" method=\"GET\" class=\"search-bar\">
        <input type=\"text\" name=\"q\" id=\"search-destination\" class=\"search-input\" style=\"flex:2;\" placeholder=\"Where to next? (e.g. Mars, Bali, Paris)\">
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">Start</span>
          <input type=\"date\" name=\"start\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none; max-width:110px;\">
        </div>
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">End</span>
          <input type=\"date\" name=\"end\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none; max-width:110px;\">
        </div>
        <div class=\"search-divider\"></div>
        <div class=\"search-field\">
          <span class=\"search-field-label\">Guests</span>
          <select name=\"guests\" class=\"search-field-val\" style=\"background:transparent; border:none; color:inherit; font-size:0.9rem; outline:none;\">
            <option value=\"1\">1 Adult</option>
            <option value=\"2\" selected>2 Adults</option>
            <option value=\"3\">3 Adults</option>
            <option value=\"4+\">4+ Adults</option>
          </select>
        </div>
        <button type=\"submit\" class=\"btn-primary ripple-btn\" style=\"padding: 12px 28px; border-radius: 12px; margin-left: 8px;\">Explore</button>
      </form>
    </div>
  </div>
</section>

<!-- Trending Section -->
<section class=\"section container\">
  <div class=\"section-label\"><span>Trending Destinations</span></div>
  <h2 class=\"section-title\">Popular This Week</h2>
  <div class=\"trending-scroll stagger\">
    {% for dest in ['Bali', 'Paris', 'Tokyo', 'Switzerland', 'New York'] %}
    <div class=\"trending-item ripple-btn\">
      <img src=\"/images/destinations/{{ dest }}.jfif\" class=\"trending-bg\" alt=\"{{ dest }}\">
      <div class=\"trending-overlay\"></div>
      <div class=\"trending-info\">
        <div class=\"trending-name\">{{ dest }}</div>
        <div class=\"ai-badge\">98% Match</div>
      </div>
    </div>
    {% endfor %}
  </div>
</section>

<button class=\"aria-orb\" id=\"aria-orb\" aria-label=\"Open ARIA\">🤖</button>
<div class=\"aria-panel\" id=\"aria-panel\">
  <div class=\"aria-header\">
    <div class=\"aria-avatar\">🤖</div>
    <div><span class=\"aria-name\">ARIA</span><span class=\"aria-status\">AI Travel Assistant</span></div>
    <button id=\"aria-close\" style=\"margin-left:auto;font-size:18px;color:var(--text-muted);background:none;border:none\">✕</button>
  </div>
  <div class=\"aria-messages\" id=\"aria-messages\">
    <div class=\"aria-msg bot\"><div class=\"aria-bubble\">Hello! I can suggest destinations, accommodations, and activities from TripX data.</div></div>
  </div>
  <div class=\"aria-input-row\">
    <input class=\"aria-input\" id=\"aria-input\" type=\"text\" placeholder=\"Ask ARIA anything...\">
    <button class=\"aria-send\" id=\"aria-send\">➤</button>
  </div>
</div>

<script src=\"/assets.php?f=js/main.js\"></script>
<script>
  // Particle Background Logic
  const canvas = document.getElementById('particle-canvas');
  if (canvas) {
    const ctx = canvas.getContext('2d');
    let pts = [];
    function init() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      pts = [];
      for(let i=0; i<80; i++) pts.push({x: Math.random()*canvas.width, y: Math.random()*canvas.height, s: Math.random()*2+1, vx: (Math.random()-0.5)*0.5, vy: (Math.random()-0.5)*0.5});
    }
    function anim() {
      ctx.clearRect(0,0,canvas.width,canvas.height);
      ctx.fillStyle = 'rgba(14,165,255,0.4)';
      pts.forEach(p => {
        p.x += p.vx; p.y += p.vy;
        if(p.x<0) p.x=canvas.width; if(p.x>canvas.width) p.x=0;
        if(p.y<0) p.y=canvas.height; if(p.y>canvas.height) p.y=0;
        ctx.beginPath(); ctx.arc(p.x, p.y, p.s, 0, Math.PI*2); ctx.fill();
      });
      requestAnimationFrame(anim);
    }
    window.addEventListener('resize', init);
    init(); anim();
  }
</script>

<!-- Accommodations Section -->
<section class=\"section bg-light\" style=\"padding-top:80px; padding-bottom:80px;\">
  <div class=\"container\">
    <div class=\"section-label reveal\"><span>Where to Stay</span></div>
    <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Curated Accommodations</h2>
    <div class=\"grid-3 stagger\" style=\"margin-top:40px;\">
      <div class=\"card interactive\">
        <img src=\"/assets.php?f=images/accomodations/hotel1.jfif\" style=\"width:100%; height:200px; object-fit:cover; border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0;\" alt=\"Hotel\">
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">The Glass Cabins</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Northern Lights views from your bed.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€350/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
      <div class=\"card interactive\">
        <div style=\"width:100%; height:200px; background:linear-gradient(45deg,#0ea5e9,#0284c7); border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0; display:flex; align-items:center; justify-content:center; color:white; font-size:40px;\">🌴</div>
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">Oceanfront Villa</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Private infinity pool in Bali.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€820/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
      <div class=\"card interactive\">
        <div style=\"width:100%; height:200px; background:linear-gradient(45deg,#f43f5e,#e11d48); border-radius:var(--border-radius-sm) var(--border-radius-sm) 0 0; display:flex; align-items:center; justify-content:center; color:white; font-size:40px;\">🗼</div>
        <div class=\"card-body\">
          <h3 style=\"font-family: var(--font-display); font-size:1.2rem;\">Parisian Flat</h3>
          <p class=\"text-muted\" style=\"font-size:0.9rem;\">Wake up to the Eiffel Tower.</p>
          <div style=\"margin-top:16px; display:flex; justify-content:space-between; align-items:center;\">
            <span class=\"text-primary font-bold\">€210/night</span>
            <button class=\"btn btn-primary btn-sm\">View</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Offers Section -->
<section class=\"section container\">
  <div class=\"section-label reveal\"><span>Exclusive Deals</span></div>
  <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Unlock the World</h2>
  <div class=\"grid-2 stagger\" style=\"margin-top:40px;\">
    <div style=\"background:var(--bg-card); border-radius:var(--border-radius-lg); padding:32px; display:flex; gap:24px; align-items:center; border:1px solid var(--border-color);\">
      <div style=\"font-size:48px;\">✈️</div>
      <div>
        <h3 style=\"font-family: var(--font-display);\">Europe Summer Pass</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Unlimited train travel for 30 days.</p>
        <span class=\"badge badge-primary\" style=\"margin-top:12px; display:inline-block;\">Save 25%</span>
      </div>
    </div>
    <div style=\"background:var(--bg-card); border-radius:var(--border-radius-lg); padding:32px; display:flex; gap:24px; align-items:center; border:1px solid var(--border-color);\">
      <div style=\"font-size:48px;\">🎒</div>
      <div>
        <h3 style=\"font-family: var(--font-display);\">Backpacker Bundle</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Hostels + Flights combo across SE Asia.</p>
        <span class=\"badge badge-teal\" style=\"margin-top:12px; display:inline-block;\">Hot Deal</span>
      </div>
    </div>
  </div>
</section>

<!-- AI Tools Section -->
<section class=\"section bg-light\" style=\"padding-top:80px; padding-bottom:120px;\">
  <div class=\"container text-center\">
    <div class=\"section-label reveal\" style=\"justify-content:center;\"><span>AI Features</span></div>
    <h2 class=\"section-title reveal\" style=\"font-family: var(--font-display);\">Travel, Powered by Intelligence</h2>
    <p class=\"text-muted reveal\" style=\"max-width:600px; margin:0 auto 40px auto;\">TripX's proprietary AI models understand your precise traveling style to build itineraries you'll love.</p>
    
    <div class=\"grid-3 stagger\">
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">🤖</div>
        <h3 style=\"font-family: var(--font-display);\">ARIA Assistant</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Chat with your personal travel concierge 24/7. Open ARIA in the corner to begin.</p>
      </div>
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">🧬</div>
        <h3 style=\"font-family: var(--font-display);\">Travel DNA</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Our AI learns your personality combining Adventure, Culture, and Culinary preferences.</p>
      </div>
      <div class=\"card\" style=\"padding:40px 24px;\">
        <div style=\"font-size:48px; margin-bottom:16px;\">⚡</div>
        <h3 style=\"font-family: var(--font-display);\">Live Itineraries</h3>
        <p class=\"text-muted\" style=\"font-size:0.9rem;\">Dynamic routing that actively adjusts due to weather, traffic, or mood.</p>
      </div>
    </div>
  </div>
</section>
<!-- JavaScript -->
<script src=\"/assets.php?f=js/main.js\"></script>
{% endblock %}






", "front/index.html.twig", "C:\\Sym\\templates\\front\\index.html.twig");
    }
}
