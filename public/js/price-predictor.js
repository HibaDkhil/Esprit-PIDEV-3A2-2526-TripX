/**
 * TripX — Price cards: sparklines + “alert me” (home + dashboard).
 */
(function () {
  'use strict';

  function drawSparkline(container) {
    if (!container) return;
    var raw = container.getAttribute('data-points');
    if (!raw) return;
    var points;
    try { points = JSON.parse(raw); } catch (e) { return; }
    if (!Array.isArray(points) || points.length < 2) return;

    var w = container.clientWidth || 260;
    var h = 48;
    var min = Math.min.apply(null, points);
    var max = Math.max.apply(null, points);
    var pad = (max - min) * 0.15 || 1;
    min -= pad; max += pad;

    var coords = points.map(function (y, i) {
      var x = (i / (points.length - 1)) * w;
      var nv = max === min ? 0.5 : (y - min) / (max - min);
      var py = h - nv * (h - 6) - 3;
      return [x, py];
    });

    var pathD = 'M' + coords.map(function (c) { return c[0] + ',' + c[1]; }).join(' L');
    var isUp = container.getAttribute('data-up') === '1';
    var isFlat = container.getAttribute('data-flat') === '1';
    var stroke = isUp ? '#f87171' : (isFlat ? '#facc15' : '#4ade80');
    var fillId = 'grad-' + Math.random().toString(36).slice(2, 7);

    var areaD = pathD +
      ' L' + coords[coords.length - 1][0] + ',' + h +
      ' L' + coords[0][0] + ',' + h + ' Z';

    container.innerHTML =
      '<svg viewBox="0 0 ' + w + ' ' + h + '" preserveAspectRatio="none">' +
      '<defs>' +
      '<linearGradient id="' + fillId + '" x1="0" y1="0" x2="0" y2="1">' +
      '<stop offset="0%" stop-color="' + stroke + '" stop-opacity=".25"/>' +
      '<stop offset="100%" stop-color="' + stroke + '" stop-opacity="0"/>' +
      '</linearGradient>' +
      '</defs>' +
      '<path d="' + areaD + '" fill="url(#' + fillId + ')"/>' +
      '<path d="' + pathD + '" fill="none" stroke="' + stroke +
      '" stroke-width="2" stroke-linecap="round" vector-effect="non-scaling-stroke"/>' +
      '</svg>';
  }

  function shouldDrawNow(wrap) {
    var block = wrap.closest('.pp-sparkline-block');
    if (!block) return true;
    return block.classList.contains('pp-sparkline-block--open');
  }

  function initAll(root) {
    root = root || document;
    root.querySelectorAll('.pp-sparkline-wrap[data-points]').forEach(function (el) {
      if (!shouldDrawNow(el)) return;
      drawSparkline(el);
    });
  }

  function bindSparklineToggles(root) {
    root = root || document;
    root.querySelectorAll('.pp-sparkline-toggle').forEach(function (btn) {
      if (btn.getAttribute('data-pp-bound') === '1') return;
      btn.setAttribute('data-pp-bound', '1');
      btn.addEventListener('click', function () {
        var block = btn.closest('.pp-sparkline-block');
        if (!block) return;
        var open = !block.classList.contains('pp-sparkline-block--open');
        block.classList.toggle('pp-sparkline-block--open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) {
          var wrap = block.querySelector('.pp-sparkline-wrap');
          requestAnimationFrame(function () {
            requestAnimationFrame(function () {
              drawSparkline(wrap);
            });
          });
        }
      });
    });
  }

  function showToast(msg) {
    if (typeof window.tripxShowToast === 'function') {
      window.tripxShowToast(msg, 4500);
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

  function injectWaitButtons() {
    document.querySelectorAll('.pp-card, .aria-card').forEach(function (card) {
      if (card.classList.contains('aria-card--dest') || card.classList.contains('aria-card--alert')) {
        return;
      }
      var actions = card.querySelector('.aria-card__actions, .pp-card-actions');
      if (!actions || actions.querySelector('.btn-wait-drop')) return;

      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'aria-btn aria-btn--alert btn-wait-drop';
      btn.innerHTML = '<span class="btn-wait-drop__icon" aria-hidden="true">🔔</span><span class="btn-wait-drop__text">Alert me if price drops</span>';
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var aid = card.getAttribute('data-activity-id');
        var name = card.querySelector('.aria-card__name, .pp-card h3');
        var label = name ? name.textContent.trim() : 'this trip';
        if (!aid) {
          showToast('This card has no activity id — open an activity listing to save an alert.');
          return;
        }
        var pred = card.getAttribute('data-predicted-price');
        var target = pred && !isNaN(parseFloat(pred)) ? parseFloat(pred) : null;
        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
        var token = csrfMeta ? csrfMeta.getAttribute('content') : '';
        btn.disabled = true;
        fetch('/api/price-alert', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
          },
          credentials: 'same-origin',
          body: JSON.stringify({
            activityId: aid,
            targetPrice: target,
            _csrf_token: token
          })
        })
          .then(function (r) { return r.json().catch(function () { return {}; }); })
          .then(function (data) {
            btn.disabled = false;
            if (data && data.ok) {
              showToast('Saved. We will show a banner on any TripX page when the listed price hits $' +
                (target != null ? target.toFixed(2) : 'your target') + ' for “' + label + '”.');
            } else {
              showToast((data && data.error) ? String(data.error) : 'Could not save. Try logging in again.');
            }
          })
          .catch(function () {
            btn.disabled = false;
            showToast('Network error — try again.');
          });
      });
      actions.appendChild(btn);
    });
  }

  function boot() {
    bindSparklineToggles(document);
    initAll(document);
    injectWaitButtons();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

  window.TripXPriceIntel = {
    initSparklines: initAll,
    bindSparklineToggles: bindSparklineToggles,
    injectWaitButtons: injectWaitButtons
  };
})();
