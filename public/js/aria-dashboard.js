/**
 * ARIA Price Intelligence — dashboard-only (grid, tabs, counters, alerts).
 * Requires price-predictor.js first (provides window.TripXPriceIntel).
 */
(function () {
  'use strict';

  /* ══ ANIMATED GRID CANVAS ══ */
  (function initGrid() {
    var canvas = document.getElementById('aria-grid-canvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    var cols, rows, cellW = 60, cellH = 60;

    function resize() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      cols = Math.ceil(canvas.width / cellW) + 1;
      rows = Math.ceil(canvas.height / cellH) + 1;
    }
    resize();
    window.addEventListener('resize', resize);

    var offset = 0;
    function drawGrid() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      var light = document.documentElement.getAttribute('data-theme') === 'light';
      ctx.strokeStyle = light ? 'rgba(14, 165, 233, 0.2)' : 'rgba(244, 185, 66, 0.18)';
      ctx.lineWidth = 0.5;
      var ox = offset % cellW;
      var oy = offset % cellH;
      for (var x = -ox; x < canvas.width; x += cellW) {
        ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, canvas.height); ctx.stroke();
      }
      for (var y = -oy; y < canvas.height; y += cellH) {
        ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(canvas.width, y); ctx.stroke();
      }
      offset += 0.3;
      requestAnimationFrame(drawGrid);
    }
    drawGrid();
  })();

  /* ══ ANIMATED COUNTERS ══ */
  (function initCounters() {
    var els = document.querySelectorAll('[data-count]');
    els.forEach(function (el) {
      var target = parseInt(el.getAttribute('data-count'), 10);
      var start = 0;
      var dur = 1800;
      var startTime = null;

      function step(ts) {
        if (!startTime) startTime = ts;
        var pct = Math.min((ts - startTime) / dur, 1);
        var ease = 1 - Math.pow(1 - pct, 3);
        el.textContent = Math.floor(ease * target).toLocaleString();
        if (pct < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString();
      }
      if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function (entries) {
          if (entries[0].isIntersecting) {
            requestAnimationFrame(step);
            obs.disconnect();
          }
        }, { threshold: 0.5 });
        obs.observe(el);
      } else {
        requestAnimationFrame(step);
      }
    });
  })();

  /* ══ TAB NAVIGATION ══ */
  (function initTabs() {
    var tabs = document.querySelectorAll('.aria-tab');
    var sections = document.querySelectorAll('.aria-section');

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var target = tab.getAttribute('data-section');

        tabs.forEach(function (t) { t.classList.remove('aria-tab--active'); });
        tab.classList.add('aria-tab--active');

        sections.forEach(function (s) {
          var id = s.id.replace('section-', '');
          if (id === target) {
            s.classList.remove('aria-section--hidden');
            s.querySelectorAll('.aria-card').forEach(function (c, i) {
              c.style.animation = 'none';
              c.offsetHeight;
              c.style.animation = '';
              c.style.animationDelay = (i * 0.06) + 's';
            });
            if (window.TripXPriceIntel) {
              window.TripXPriceIntel.initSparklines(s);
              if (typeof window.TripXPriceIntel.injectWaitButtons === 'function') {
                window.TripXPriceIntel.injectWaitButtons();
              }
            }
          } else {
            s.classList.add('aria-section--hidden');
          }
        });
      });
    });
  })();

  function showToast(msg) {
    if (typeof window.tripxShowToast === 'function') {
      window.tripxShowToast(msg, 4000);
      return;
    }
    var t = document.getElementById('ariaToast');
    if (!t) return;
    t.textContent = msg;
    t.style.color = '#fde68a';
    t.classList.add('show');
    clearTimeout(showToast._tid);
    showToast._tid = setTimeout(function () { t.classList.remove('show'); }, 4000);
  }
  window.ariaShowToast = showToast;

  /* ══ SCROLL REVEAL ══ */
  (function initReveal() {
    if (!('IntersectionObserver' in window)) return;
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.style.opacity = '1';
          e.target.style.transform = 'translateY(0)';
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.aria-side__block, .aria-cta-btn').forEach(function (el) {
      el.style.opacity = '0';
      el.style.transform = 'translateY(16px)';
      el.style.transition = 'opacity .5s ease, transform .5s ease';
      obs.observe(el);
    });
  })();
})();
