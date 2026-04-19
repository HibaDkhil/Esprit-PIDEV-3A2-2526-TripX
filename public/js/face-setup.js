/**
 * face-setup.js  –  Face Registration (Setup) page
 * Place at: public/js/face-setup.js
 * Depends on: face-camera.js  (loaded first in the twig template)
 */
(function () {
  'use strict';

  var registerBtn = document.getElementById('flRegisterBtn');
  var unlinkBtn   = document.getElementById('flUnlinkBtn');
  var video       = document.getElementById('flVideo');
  var canvas      = document.getElementById('flCanvas');
  var busy        = false;

  /* ── Step helpers ── */
  function setStep(n) {
    [1, 2, 3].forEach(function (i) {
      var el = document.getElementById('step' + i);
      if (!el) return;
      el.classList.remove('active', 'done');
      if (i < n)  el.classList.add('done');
      if (i === n) el.classList.add('active');
    });
  }

  /* ── Init camera ── */
  setStep(1);
  FaceCamera.setStatus('Requesting camera access…', 'busy');
  FaceCamera.init(
    video, canvas,
    function onReady() {
      setStep(2);
      // Enable button immediately once camera is live — user can always try
      if (registerBtn) registerBtn.disabled = false;
      FaceCamera.setStatus('Camera ready — position your face in the oval', 'ready');

      // Guidance = advisory only, never blocks the button
      FaceCamera.startGuidance(function(guidance) {
        if (busy) return;
        FaceCamera.setStatus(guidance.message, guidance.status);
        var qLight = document.getElementById('qLight');
        var qPos   = document.getElementById('qPos');
        var oval   = document.getElementById('flFaceOval');
        
        if (qLight && guidance.lighting !== 'none') qLight.className = 'fl-qual-item ' + guidance.lighting;
        if (qPos   && guidance.position !== 'none') qPos.className   = 'fl-qual-item ' + guidance.position;
        if (oval) {
          oval.style.borderColor = guidance.position === 'good'
            ? 'rgba(15,216,80,0.8)'
            : 'rgba(34,211,238,0.8)';
        }
      });
    },
    function onError(msg) {
      FaceCamera.setStatus(msg, 'error');
      FaceCamera.showOverlay('Error');
      var errEl = document.getElementById('flErrorMsg');
      if (errEl) errEl.textContent = msg;
    }
  );

  /* ── Register button ── */
  if (registerBtn) {
    registerBtn.addEventListener('click', function () {
      if (!busy) attemptRegister();
    });
  }

  /* ── Unlink button ── */
  if (unlinkBtn) {
    unlinkBtn.addEventListener('click', function () {
      if (!confirm('Remove your face data? You can re-register at any time.')) return;
      fetch(window.TRIPX_FACE.removeUrl, { method: 'POST' })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          if (d.success) { alert('Face data removed.'); window.location.reload(); }
        });
    });
  }

  /* ── Registration attempt ── */
  function attemptRegister() {
    if (busy) return;
    busy = true;
    if (registerBtn) registerBtn.disabled = true;
    FaceCamera.stopGuidance();

    setStep(3);
    FaceCamera.setStatus('Scanning your face… Hold still 🔍', 'busy');
    FaceCamera.showOverlay('Load');
    FaceCamera.startScan();

    FaceCamera.getDescriptor()
      .then(function (descriptor) {
        if (!descriptor) throw new Error('No face detected. Please look directly at the camera.');
        return FaceCamera.post(window.TRIPX_FACE.registerUrl, { descriptor: descriptor });
      })
      .then(function (data) {
        if (data.success) {
          FaceCamera.stopScan();
          FaceCamera.showOverlay('Success');
          var msgEl = document.getElementById('flSuccessMsg');
          if (msgEl) msgEl.textContent = 'Registration Complete! ✨';
          FaceCamera.setStatus('Registered ✓', 'ready');
          FaceCamera.stop();
          setTimeout(function () {
            window.location.href = data.redirect || window.TRIPX_FACE.profileUrl;
          }, 2000);
        } else {
          handleFailure(data.message || 'Registration failed. Please try again.');
        }
      })
      .catch(function (err) { handleFailure(err.message || 'Network error'); });
  }

  function handleFailure(msg) {
    FaceCamera.stopScan();
    FaceCamera.showOverlay('Error');
    var errEl = document.getElementById('flErrorMsg');
    if (errEl) errEl.textContent = msg;
    FaceCamera.setStatus(msg, 'error');
    setStep(2);
    setTimeout(function () {
      FaceCamera.hideOverlays();
      busy = false;
      if (registerBtn) registerBtn.disabled = false;
      FaceCamera.startGuidance(function(guidance) {
        if (busy) return;
        FaceCamera.setStatus(guidance.message, guidance.status);
        var qLight = document.getElementById('qLight');
        var qPos   = document.getElementById('qPos');
        var oval   = document.getElementById('flFaceOval');
        
        if (qLight && guidance.lighting !== 'none') qLight.className = 'fl-qual-item ' + guidance.lighting;
        if (qPos   && guidance.position !== 'none') qPos.className   = 'fl-qual-item ' + guidance.position;
        if (oval) {
          oval.style.borderColor = guidance.position === 'good'
            ? 'rgba(15,216,80,0.8)'
            : 'rgba(34,211,238,0.8)';
        }
      });
    }, 2500);
  }

})();
