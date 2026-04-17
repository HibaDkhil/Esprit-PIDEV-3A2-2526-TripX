/**
 * face-login.js  –  Face Login page
 * Place at: public/js/face-login.js
 * Depends on: face-camera.js  (loaded first in the twig template)
 */
(function () {
  'use strict';

  var loginBtn = document.getElementById('flLoginBtn');
  var video    = document.getElementById('flVideo');
  var canvas   = document.getElementById('flCanvas');
  var busy     = false;

  /* ── Init camera ── */
  FaceCamera.setStatus('Starting camera…', 'busy');
  FaceCamera.init(
    video, canvas,
    function onReady() {
      // Enable button immediately
      if (loginBtn) loginBtn.disabled = false;
      FaceCamera.setStatus('Align your face in the oval, then click Login', 'ready');

      // Guidance = advisory, drives the hint pill and oval colour
      FaceCamera.startGuidance(function(guidance) {
        if (busy) return;
        FaceCamera.setStatus(guidance.message, guidance.status);

        // Drive the guidance hint pill
        var hint = document.getElementById('flGuidanceHint');
        var oval = document.getElementById('flFaceOval');
        if (hint) {
          if (guidance.status !== 'ready') {
            hint.style.display = 'block';
            hint.textContent   = '⚠ ' + guidance.message;
          } else {
            hint.style.display = 'block';
            hint.textContent   = '✓ Good position — click Login!';
            hint.style.background = 'rgba(15,216,80,0.08)';
            hint.style.borderColor = 'rgba(15,216,80,0.3)';
            hint.style.color = '#0fd850';
          }
        }
        // Colour the oval based on position quality
        if (oval) {
          oval.style.borderColor = guidance.position === 'good'
            ? 'rgba(15,216,80,0.8)'
            : 'rgba(34,211,238,0.8)';
        }
        // Button stays enabled
      });
    },
    function onError(msg) {
      FaceCamera.setStatus(msg, 'error');
      FaceCamera.showOverlay('Error');
      var errEl = document.getElementById('flErrorMsg');
      if (errEl) errEl.textContent = msg;
    }
  );

  /* ── Manual login button ── */
  if (loginBtn) {
    loginBtn.addEventListener('click', function () {
      if (!busy) attemptLogin();
    });
  }

  /* ── Login attempt ── */
  function attemptLogin() {
    if (busy) return;
    busy = true;
    if (loginBtn) loginBtn.disabled = true;
    FaceCamera.stopGuidance();

    FaceCamera.setStatus('Scanning… Hold still 🔍', 'busy');
    FaceCamera.showOverlay('Load');
    FaceCamera.startScan();

    FaceCamera.getDescriptor()
      .then(function (descriptor) {
        if (!descriptor) throw new Error('No face detected. Please look directly at the camera.');
        return FaceCamera.post(window.TRIPX_FACE.loginUrl, { descriptor: descriptor });
      })
      .then(function (data) {
        if (data.success) {
          FaceCamera.stopScan();
          FaceCamera.showOverlay('Success');
          var msgEl = document.getElementById('flSuccessMsg');
          if (msgEl) msgEl.textContent = data.message || 'Authenticated ✨';
          if (data.confidence) FaceCamera.showConfidence(data.confidence);
          FaceCamera.setStatus('Authenticated ✓', 'ready');
          FaceCamera.stop();
          setTimeout(function () {
            window.location.href = data.redirect || window.TRIPX_FACE.homeUrl;
          }, 1600);
        } else {
          handleFailure(data.message || 'Not recognised. Please try again.');
        }
      })
      .catch(function (err) {
        if (err.status === 429) {
          handleFailure("Security Lockout: Too many attempts. Please wait.");
        } else {
          handleFailure(err.message || 'Network error');
        }
      });
  }

  function handleFailure(msg) {
    FaceCamera.stopScan();
    FaceCamera.showOverlay('Error');
    var errEl = document.getElementById('flErrorMsg');
    if (errEl) errEl.textContent = msg;
    FaceCamera.setStatus(msg, 'error');

    setTimeout(function () {
      FaceCamera.hideOverlays();
      busy = false;
      if (loginBtn) loginBtn.disabled = false;
      FaceCamera.setStatus('Try again — look at the camera', 'ready');
      FaceCamera.startGuidance(function(guidance) {
        if (busy) return;
        FaceCamera.setStatus(guidance.message, guidance.status);
      });
    }, 2500);
  }

})();
