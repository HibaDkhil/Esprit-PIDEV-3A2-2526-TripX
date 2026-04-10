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

/* front/onboarding.html.twig */
class __TwigTemplate_0049b159a16596b04d04b016cdb64e61 extends Template
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
            'extra_css' => [$this, 'block_extra_css'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/onboarding.html.twig"));

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

        yield "Set Your Preferences";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_css(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_css"));

        // line 5
        yield "<style>
  /* Island background for onboarding */
  body {
    background: url('/images/island.jpg') center/cover no-repeat fixed;
    overflow: hidden;
  }
  body::before {
    content: '';
    position: fixed; inset: 0;
    background: rgba(15,27,45,.65);
    z-index: 0;
  }
  .bg-shape { display: none; }
  #onboarding-page { position: relative; z-index: 1; }
  
  /* Slide styles from FXML */
  .ob-card {
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
    width: 90%;
    max-width: 1000px;
    height: 700px;
    margin: 40px auto;
    display: flex;
    flex-direction: column;
  }
  
  .ob-slides-wrap {
    flex: 1;
    position: relative;
    overflow: hidden;
  }

  .ob-slide {
    position: absolute;
    inset: 0;
    padding: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    transition: transform 0.6s cubic-bezier(0.77,0,0.18,1), opacity 0.4s;
    opacity: 0;
    pointer-events: none;
  }

  .ob-slide.active {
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
  }

  /* Slide White vs Blue from FXML */
  .slide-white { background: #fff; color: #1e3a8a; }
  .slide-blue { background: #1e3a8a; color: #fff; }

  .label-blue { color: #1e3a8a; font-size: 32px; font-weight: 800; margin-bottom: 8px; font-family: var(--font-display); }
  .sub-label-blue { color: #4b5563; font-size: 1.1rem; margin-bottom: 30px; }
  
  .label-white { color: #fff; font-size: 32px; font-weight: 800; margin-bottom: 8px; font-family: var(--font-display); }
  .sub-label-white { color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-bottom: 30px; }

  /* Option Cards (ToggleButtons) */
  .option-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; width: 100%; max-width: 800px; }
  .option-card {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    color: inherit;
  }
  .slide-white .option-card { background: #f8fafc; border-color: #e2e8f0; }
  .slide-white .option-card:hover { border-color: #1e3a8a; background: #eff6ff; }
  .slide-white .option-card.selected { background: #1e3a8a; color: #fff; border-color: #1e3a8a; transform: translateY(-4px); }
  
  .slide-blue .option-card:hover { background: rgba(255,255,255,0.2); border-color: #fff; }
  .slide-blue .option-card.selected { background: #fff; color: #1e3a8a; border-color: #fff; transform: translateY(-4px); }

  .option-icon { font-size: 32px; }

  /* Navigation Footer */
  .ob-footer {
    padding: 30px 60px;
    background: rgba(0,0,0,0.02);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(0,0,0,0.05);
  }

  .ob-progress-bar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: rgba(0,0,0,0.05);
  }
  .ob-progress-fill {
    height: 100%;
    background: linear-gradient(to right, #1e3a8a, #3b82f6);
    width: 0%;
    transition: width 0.4s ease;
  }
  
  /* Dots Indicator */
  .ob-dots {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 20px 0;
  }
  .ob-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(0,0,0,0.1);
    transition: all 0.3s;
  }
  .ob-dot.active {
    background: #1e3a8a;
    transform: scale(1.3);
  }
  .slide-blue ~ .ob-footer .ob-dot.active {
    background: #fff;
  }

  /* Specific widgets */
  .budget-slider-wrap { width: 100%; max-width: 600px; padding: 20px; }
  .birth-year-input { 
    background: transparent; border: none; border-bottom: 2px solid currentColor;
    color: inherit; font-size: 48px; font-weight: 800; text-align: center; width: 200px;
    outline: none;
  }

  .action-button {
    background: #1e3a8a;
    color: #fff;
    border: none;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    display: flex; align-items: center; gap: 8px;
  }
  .action-button:hover {
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(30,58,138,0.2);
  }
  .secondary-button {
    background: transparent;
    color: #4b5563;
    border: 1px solid #e2e8f0;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
  }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 176
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 177
        yield "<div id=\"onboarding-page\">
  <div class=\"ob-card\">
    <div class=\"ob-progress-bar\">
      <div class=\"ob-progress-fill\" id=\"progressFill\"></div>
    </div>

    <div class=\"ob-slides-wrap\" id=\"obSlidesWrap\">
      ";
        // line 185
        yield "      <div class=\"ob-slide slide-white active\" data-slide=\"0\">
        <div class=\"label-blue\">Tell us about yourself</div>
        <div class=\"sub-label-blue\">Select your gender to help us personalize your experience.</div>
        <div class=\"option-grid\">
          <div class=\"option-card\" data-val=\"Male\" data-field=\"gender\" style=\"flex:1\">
            <div class=\"option-icon\">👨</div>
            <span>Male</span>
          </div>
          <div class=\"option-card\" data-val=\"Female\" data-field=\"gender\" style=\"flex:1\">
            <div class=\"option-icon\">👩</div>
            <span>Female</span>
          </div>
        </div>
      </div>

      ";
        // line 201
        yield "      <div class=\"ob-slide slide-blue\" data-slide=\"1\">
        <div class=\"label-white\">In which interval were you born?</div>
        <div class=\"sub-label-white\">Select your birth year range.</div>
        <div class=\"option-grid\" data-group=\"birth_year\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"1970-1980\">1970 - 1980</div>
          <div class=\"option-card\" data-val=\"1980-1990\">1980 - 1990</div>
          <div class=\"option-card\" data-val=\"1990-2000\">1990 - 2000</div>
          <div class=\"option-card\" data-val=\"2000-2010\">2000 - 2010</div>
          <div class=\"option-card\" data-val=\"2010-Now\">2010 - Now</div>
        </div>
      </div>

      ";
        // line 214
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"2\">
        <div class=\"label-blue\">What matters most?</div>
        <div class=\"sub-label-blue\">Select your top travel priorities.</div>
        <div class=\"option-grid\" data-group=\"priorities\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Minimalist\"><span>🏙</span> Minimalist</div>
          <div class=\"option-card\" data-val=\"Mediterranean\"><span>☀️</span> Mediterranean</div>
          <div class=\"option-card\" data-val=\"Classic\"><span>🏛</span> Classic</div>
          <div class=\"option-card\" data-val=\"Vintage\"><span>🎞</span> Vintage</div>
        </div>
      </div>

      ";
        // line 226
        yield "      <div class=\"ob-slide slide-blue\" data-slide=\"3\">
        <div class=\"label-white\">Preferred Climate</div>
        <div class=\"sub-label-white\">What kind of weather do you enjoy?</div>
        <div class=\"option-grid\" data-group=\"preferred_climate\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Tropical\"><span>🌴</span> Tropical</div>
          <div class=\"option-card\" data-val=\"Oceanic\"><span>🌊</span> Oceanic</div>
          <div class=\"option-card\" data-val=\"Temperate\"><span>🌤️</span> Temperate</div>
          <div class=\"option-card\" data-val=\"Desert\"><span>🌵</span> Desert</div>
          <div class=\"option-card\" data-val=\"Mountain\"><span>⛰</span> Mountain</div>
          <div class=\"option-card\" data-val=\"Oceanic cold\"><span>🧊</span> Oceanic cold</div>
        </div>
      </div>

      ";
        // line 240
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"4\">
        <div class=\"label-blue\">What is your budget?</div>
        <div class=\"sub-label-blue\">Estimated nightly budget for your stays.</div>
        <div class=\"option-grid\" data-group=\"budget_tier\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Backpacker\" data-min=\"0\" data-max=\"100\">
            <div class=\"option-icon\">🎒</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Backpacker</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">Affordable adventures</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$0 - \$100 / night</div>
          </div>
          <div class=\"option-card\" data-val=\"Explorer\" data-min=\"100\" data-max=\"300\">
            <div class=\"option-icon\">🗺️</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Explorer</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">Comfort & quality</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$100 - \$300 / night</div>
          </div>
          <div class=\"option-card\" data-val=\"Luxury\" data-min=\"300\" data-max=\"2000\">
            <div class=\"option-icon\">💎</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Luxury</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">First-class stays</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$300+ / night</div>
          </div>
        </div>
      </div>

      ";
        // line 266
        yield "      <div class=\"ob-slide slide-blue\" data-slide=\"5\">
        <div class=\"label-white\">Preferred Location</div>
        <div class=\"sub-label-white\">Where do you prefer to stay?</div>
        <div class=\"option-grid\" data-group=\"location_preferences\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"City Center\"><span>🏙</span> City Center</div>
          <div class=\"option-card\" data-val=\"Beachfront\"><span>🏖</span> Beach</div>
          <div class=\"option-card\" data-val=\"Countryside\"><span>🌾</span> Rural</div>
          <div class=\"option-card\" data-val=\"Historic District\"><span>🏯</span> Historic</div>
        </div>
      </div>

      ";
        // line 278
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"6\">
        <div class=\"label-blue\">Accommodation Type</div>
        <div class=\"sub-label-blue\">Select your preferred places to stay.</div>
        <div class=\"option-grid\" data-group=\"accommodation_types\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Hotel\"><span>🏨</span> Hotel</div>
          <div class=\"option-card\" data-val=\"Villa\"><span>🏡</span> Villa</div>
          <div class=\"option-card\" data-val=\"Hostel\"><span>🛏</span> Hostel</div>
          <div class=\"option-card\" data-val=\"Cabin\"><span>🪵</span> Cabin</div>
        </div>
      </div>

      ";
        // line 290
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"7\">
        <div class=\"label-blue\">Travel Style</div>
        <div class=\"sub-label-blue\">What fits your vibe?</div>
        <div class=\"option-grid\" data-group=\"style_preferences\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Luxury\"><span>💎</span> Luxury</div>
          <div class=\"option-card\" data-val=\"Budget\"><span>🎒</span> Budget</div>
          <div class=\"option-card\" data-val=\"Local\"><span>🌍</span> Local</div>
          <div class=\"option-card\" data-val=\"Business\"><span>💼</span> Business</div>
        </div>
      </div>

      ";
        // line 302
        yield "      <div class=\"ob-slide slide-blue\" data-slide=\"8\">
        <div class=\"label-white\">Dietary Restrictions</div>
        <div class=\"sub-label-white\">Any food preferences we should know?</div>
        <div class=\"option-grid\" data-group=\"dietary_restrictions\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Vegetarian\"><span>🥗</span> Veg</div>
          <div class=\"option-card\" data-val=\"Vegan\"><span>🌱</span> Vegan</div>
          <div class=\"option-card\" data-val=\"Gluten-Free\"><span>🌾</span> GF</div>
          <div class=\"option-card\" data-val=\"None\"><span>🍴</span> None</div>
        </div>
      </div>

      ";
        // line 314
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"9\">
        <div class=\"label-blue\">Travel Pace</div>
        <div class=\"sub-label-blue\">How fast do you like to travel?</div>
        <div class=\"option-grid\" data-group=\"travel_pace\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Relaxed\"><span>🌅</span> Relaxed</div>
          <div class=\"option-card\" data-val=\"Moderate\"><span>🚶</span> Moderate</div>
          <div class=\"option-card\" data-val=\"Fast-paced\"><span>⚡</span> Fast</div>
        </div>
      </div>

      ";
        // line 325
        yield "      <div class=\"ob-slide slide-blue\" data-slide=\"10\">
        <div class=\"label-white\">Who are you with?</div>
        <div class=\"sub-label-white\">Select your group type.</div>
        <div class=\"option-grid\" data-group=\"group_type\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Solo\"><span>🎒</span> Solo</div>
          <div class=\"option-card\" data-val=\"Couple\"><span>💑</span> Couple</div>
          <div class=\"option-card\" data-val=\"Family\"><span>👨‍👩‍👧</span> Family</div>
          <div class=\"option-card\" data-val=\"Friends\"><span>👯</span> Friends</div>
        </div>
      </div>

      ";
        // line 337
        yield "      <div class=\"ob-slide slide-white\" data-slide=\"11\">
        <div class=\"label-blue\">Accessibility</div>
        <div class=\"sub-label-blue\">Do you require any specific assistance?</div>
        <div class=\"option-card\" style=\"max-width:400px\" id=\"accessibilityToggle\">
          <div class=\"option-icon\">♿</div>
          <span>I require accessibility features</span>
        </div>
      </div>

    </div>

    <div class=\"ob-footer\">
      <button class=\"secondary-button\" id=\"obBack\" style=\"visibility:hidden\">Back</button>
      <div class=\"ob-dots\" id=\"dotContainer\"></div>
      <button class=\"action-button\" id=\"obNext\">Continue ➔</button>
    </div>
  </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 357
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_js"));

        // line 358
        yield "<script>
  window.TRIPX = {
    savePrefsUrl: \"";
        // line 360
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_save_preferences");
        yield "\",
    homeUrl: \"";
        // line 361
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        yield "\"
  };
</script>
<script src=\"";
        // line 364
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/onboarding.js"), "html", null, true);
        yield "\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/onboarding.html.twig";
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
        return array (  496 => 364,  490 => 361,  486 => 360,  482 => 358,  472 => 357,  446 => 337,  433 => 325,  421 => 314,  408 => 302,  395 => 290,  382 => 278,  369 => 266,  342 => 240,  327 => 226,  314 => 214,  300 => 201,  283 => 185,  274 => 177,  264 => 176,  87 => 5,  77 => 4,  60 => 2,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'front/base_auth.html.twig' %}
{% block title %}Set Your Preferences{% endblock %}

{% block extra_css %}
<style>
  /* Island background for onboarding */
  body {
    background: url('/images/island.jpg') center/cover no-repeat fixed;
    overflow: hidden;
  }
  body::before {
    content: '';
    position: fixed; inset: 0;
    background: rgba(15,27,45,.65);
    z-index: 0;
  }
  .bg-shape { display: none; }
  #onboarding-page { position: relative; z-index: 1; }
  
  /* Slide styles from FXML */
  .ob-card {
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
    width: 90%;
    max-width: 1000px;
    height: 700px;
    margin: 40px auto;
    display: flex;
    flex-direction: column;
  }
  
  .ob-slides-wrap {
    flex: 1;
    position: relative;
    overflow: hidden;
  }

  .ob-slide {
    position: absolute;
    inset: 0;
    padding: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    transition: transform 0.6s cubic-bezier(0.77,0,0.18,1), opacity 0.4s;
    opacity: 0;
    pointer-events: none;
  }

  .ob-slide.active {
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
  }

  /* Slide White vs Blue from FXML */
  .slide-white { background: #fff; color: #1e3a8a; }
  .slide-blue { background: #1e3a8a; color: #fff; }

  .label-blue { color: #1e3a8a; font-size: 32px; font-weight: 800; margin-bottom: 8px; font-family: var(--font-display); }
  .sub-label-blue { color: #4b5563; font-size: 1.1rem; margin-bottom: 30px; }
  
  .label-white { color: #fff; font-size: 32px; font-weight: 800; margin-bottom: 8px; font-family: var(--font-display); }
  .sub-label-white { color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-bottom: 30px; }

  /* Option Cards (ToggleButtons) */
  .option-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; width: 100%; max-width: 800px; }
  .option-card {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 24px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    color: inherit;
  }
  .slide-white .option-card { background: #f8fafc; border-color: #e2e8f0; }
  .slide-white .option-card:hover { border-color: #1e3a8a; background: #eff6ff; }
  .slide-white .option-card.selected { background: #1e3a8a; color: #fff; border-color: #1e3a8a; transform: translateY(-4px); }
  
  .slide-blue .option-card:hover { background: rgba(255,255,255,0.2); border-color: #fff; }
  .slide-blue .option-card.selected { background: #fff; color: #1e3a8a; border-color: #fff; transform: translateY(-4px); }

  .option-icon { font-size: 32px; }

  /* Navigation Footer */
  .ob-footer {
    padding: 30px 60px;
    background: rgba(0,0,0,0.02);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(0,0,0,0.05);
  }

  .ob-progress-bar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: rgba(0,0,0,0.05);
  }
  .ob-progress-fill {
    height: 100%;
    background: linear-gradient(to right, #1e3a8a, #3b82f6);
    width: 0%;
    transition: width 0.4s ease;
  }
  
  /* Dots Indicator */
  .ob-dots {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 20px 0;
  }
  .ob-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(0,0,0,0.1);
    transition: all 0.3s;
  }
  .ob-dot.active {
    background: #1e3a8a;
    transform: scale(1.3);
  }
  .slide-blue ~ .ob-footer .ob-dot.active {
    background: #fff;
  }

  /* Specific widgets */
  .budget-slider-wrap { width: 100%; max-width: 600px; padding: 20px; }
  .birth-year-input { 
    background: transparent; border: none; border-bottom: 2px solid currentColor;
    color: inherit; font-size: 48px; font-weight: 800; text-align: center; width: 200px;
    outline: none;
  }

  .action-button {
    background: #1e3a8a;
    color: #fff;
    border: none;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    display: flex; align-items: center; gap: 8px;
  }
  .action-button:hover {
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(30,58,138,0.2);
  }
  .secondary-button {
    background: transparent;
    color: #4b5563;
    border: 1px solid #e2e8f0;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
  }
</style>
{% endblock %}

{% block body %}
<div id=\"onboarding-page\">
  <div class=\"ob-card\">
    <div class=\"ob-progress-bar\">
      <div class=\"ob-progress-fill\" id=\"progressFill\"></div>
    </div>

    <div class=\"ob-slides-wrap\" id=\"obSlidesWrap\">
      {# Step 1: Gender (White) #}
      <div class=\"ob-slide slide-white active\" data-slide=\"0\">
        <div class=\"label-blue\">Tell us about yourself</div>
        <div class=\"sub-label-blue\">Select your gender to help us personalize your experience.</div>
        <div class=\"option-grid\">
          <div class=\"option-card\" data-val=\"Male\" data-field=\"gender\" style=\"flex:1\">
            <div class=\"option-icon\">👨</div>
            <span>Male</span>
          </div>
          <div class=\"option-card\" data-val=\"Female\" data-field=\"gender\" style=\"flex:1\">
            <div class=\"option-icon\">👩</div>
            <span>Female</span>
          </div>
        </div>
      </div>

      {# Step 2: Age (Blue) #}
      <div class=\"ob-slide slide-blue\" data-slide=\"1\">
        <div class=\"label-white\">In which interval were you born?</div>
        <div class=\"sub-label-white\">Select your birth year range.</div>
        <div class=\"option-grid\" data-group=\"birth_year\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"1970-1980\">1970 - 1980</div>
          <div class=\"option-card\" data-val=\"1980-1990\">1980 - 1990</div>
          <div class=\"option-card\" data-val=\"1990-2000\">1990 - 2000</div>
          <div class=\"option-card\" data-val=\"2000-2010\">2000 - 2010</div>
          <div class=\"option-card\" data-val=\"2010-Now\">2010 - Now</div>
        </div>
      </div>

      {# Step 3: Priorities (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"2\">
        <div class=\"label-blue\">What matters most?</div>
        <div class=\"sub-label-blue\">Select your top travel priorities.</div>
        <div class=\"option-grid\" data-group=\"priorities\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Minimalist\"><span>🏙</span> Minimalist</div>
          <div class=\"option-card\" data-val=\"Mediterranean\"><span>☀️</span> Mediterranean</div>
          <div class=\"option-card\" data-val=\"Classic\"><span>🏛</span> Classic</div>
          <div class=\"option-card\" data-val=\"Vintage\"><span>🎞</span> Vintage</div>
        </div>
      </div>

      {# Step 4: Preferred Climate (Blue) #}
      <div class=\"ob-slide slide-blue\" data-slide=\"3\">
        <div class=\"label-white\">Preferred Climate</div>
        <div class=\"sub-label-white\">What kind of weather do you enjoy?</div>
        <div class=\"option-grid\" data-group=\"preferred_climate\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Tropical\"><span>🌴</span> Tropical</div>
          <div class=\"option-card\" data-val=\"Oceanic\"><span>🌊</span> Oceanic</div>
          <div class=\"option-card\" data-val=\"Temperate\"><span>🌤️</span> Temperate</div>
          <div class=\"option-card\" data-val=\"Desert\"><span>🌵</span> Desert</div>
          <div class=\"option-card\" data-val=\"Mountain\"><span>⛰</span> Mountain</div>
          <div class=\"option-card\" data-val=\"Oceanic cold\"><span>🧊</span> Oceanic cold</div>
        </div>
      </div>

      {# Step 5: Budget (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"4\">
        <div class=\"label-blue\">What is your budget?</div>
        <div class=\"sub-label-blue\">Estimated nightly budget for your stays.</div>
        <div class=\"option-grid\" data-group=\"budget_tier\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Backpacker\" data-min=\"0\" data-max=\"100\">
            <div class=\"option-icon\">🎒</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Backpacker</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">Affordable adventures</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$0 - \$100 / night</div>
          </div>
          <div class=\"option-card\" data-val=\"Explorer\" data-min=\"100\" data-max=\"300\">
            <div class=\"option-icon\">🗺️</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Explorer</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">Comfort & quality</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$100 - \$300 / night</div>
          </div>
          <div class=\"option-card\" data-val=\"Luxury\" data-min=\"300\" data-max=\"2000\">
            <div class=\"option-icon\">💎</div>
            <div style=\"font-weight:800; font-size:1.1rem\">Luxury</div>
            <div style=\"font-size:0.85rem; opacity:0.7\">First-class stays</div>
            <div style=\"margin-top:8px; font-weight:700; color:#1e3a8a\">\$300+ / night</div>
          </div>
        </div>
      </div>

      {# Step 6: Location Preference (Blue) #}
      <div class=\"ob-slide slide-blue\" data-slide=\"5\">
        <div class=\"label-white\">Preferred Location</div>
        <div class=\"sub-label-white\">Where do you prefer to stay?</div>
        <div class=\"option-grid\" data-group=\"location_preferences\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"City Center\"><span>🏙</span> City Center</div>
          <div class=\"option-card\" data-val=\"Beachfront\"><span>🏖</span> Beach</div>
          <div class=\"option-card\" data-val=\"Countryside\"><span>🌾</span> Rural</div>
          <div class=\"option-card\" data-val=\"Historic District\"><span>🏯</span> Historic</div>
        </div>
      </div>

      {# Step 7: Accommodation Type (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"6\">
        <div class=\"label-blue\">Accommodation Type</div>
        <div class=\"sub-label-blue\">Select your preferred places to stay.</div>
        <div class=\"option-grid\" data-group=\"accommodation_types\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Hotel\"><span>🏨</span> Hotel</div>
          <div class=\"option-card\" data-val=\"Villa\"><span>🏡</span> Villa</div>
          <div class=\"option-card\" data-val=\"Hostel\"><span>🛏</span> Hostel</div>
          <div class=\"option-card\" data-val=\"Cabin\"><span>🪵</span> Cabin</div>
        </div>
      </div>

      {# Step 8: Travel Style (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"7\">
        <div class=\"label-blue\">Travel Style</div>
        <div class=\"sub-label-blue\">What fits your vibe?</div>
        <div class=\"option-grid\" data-group=\"style_preferences\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Luxury\"><span>💎</span> Luxury</div>
          <div class=\"option-card\" data-val=\"Budget\"><span>🎒</span> Budget</div>
          <div class=\"option-card\" data-val=\"Local\"><span>🌍</span> Local</div>
          <div class=\"option-card\" data-val=\"Business\"><span>💼</span> Business</div>
        </div>
      </div>

      {# Step 9: Dietary Restrictions (Blue) #}
      <div class=\"ob-slide slide-blue\" data-slide=\"8\">
        <div class=\"label-white\">Dietary Restrictions</div>
        <div class=\"sub-label-white\">Any food preferences we should know?</div>
        <div class=\"option-grid\" data-group=\"dietary_restrictions\" data-multi=\"true\">
          <div class=\"option-card\" data-val=\"Vegetarian\"><span>🥗</span> Veg</div>
          <div class=\"option-card\" data-val=\"Vegan\"><span>🌱</span> Vegan</div>
          <div class=\"option-card\" data-val=\"Gluten-Free\"><span>🌾</span> GF</div>
          <div class=\"option-card\" data-val=\"None\"><span>🍴</span> None</div>
        </div>
      </div>

      {# Step 10: Travel Pace (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"9\">
        <div class=\"label-blue\">Travel Pace</div>
        <div class=\"sub-label-blue\">How fast do you like to travel?</div>
        <div class=\"option-grid\" data-group=\"travel_pace\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Relaxed\"><span>🌅</span> Relaxed</div>
          <div class=\"option-card\" data-val=\"Moderate\"><span>🚶</span> Moderate</div>
          <div class=\"option-card\" data-val=\"Fast-paced\"><span>⚡</span> Fast</div>
        </div>
      </div>

      {# Step 11: Group Type (Blue) #}
      <div class=\"ob-slide slide-blue\" data-slide=\"10\">
        <div class=\"label-white\">Who are you with?</div>
        <div class=\"sub-label-white\">Select your group type.</div>
        <div class=\"option-grid\" data-group=\"group_type\" data-multi=\"false\">
          <div class=\"option-card\" data-val=\"Solo\"><span>🎒</span> Solo</div>
          <div class=\"option-card\" data-val=\"Couple\"><span>💑</span> Couple</div>
          <div class=\"option-card\" data-val=\"Family\"><span>👨‍👩‍👧</span> Family</div>
          <div class=\"option-card\" data-val=\"Friends\"><span>👯</span> Friends</div>
        </div>
      </div>

      {# Step 12: Accessibility (White) #}
      <div class=\"ob-slide slide-white\" data-slide=\"11\">
        <div class=\"label-blue\">Accessibility</div>
        <div class=\"sub-label-blue\">Do you require any specific assistance?</div>
        <div class=\"option-card\" style=\"max-width:400px\" id=\"accessibilityToggle\">
          <div class=\"option-icon\">♿</div>
          <span>I require accessibility features</span>
        </div>
      </div>

    </div>

    <div class=\"ob-footer\">
      <button class=\"secondary-button\" id=\"obBack\" style=\"visibility:hidden\">Back</button>
      <div class=\"ob-dots\" id=\"dotContainer\"></div>
      <button class=\"action-button\" id=\"obNext\">Continue ➔</button>
    </div>
  </div>
</div>
{% endblock %}

{% block extra_js %}
<script>
  window.TRIPX = {
    savePrefsUrl: \"{{ path('app_save_preferences') }}\",
    homeUrl: \"{{ path('index') }}\"
  };
</script>
<script src=\"{{ asset('js/onboarding.js') }}\"></script>
{% endblock %}
", "front/onboarding.html.twig", "C:\\Users\\nmour\\Downloads\\Sym - Copy\\templates\\front\\onboarding.html.twig");
    }
}
