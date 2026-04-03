/**
 * auth.js  –  Login ↔ Signup panel animation + particles + helpers
 * Place at: public/js/auth.js
 */
(function () {
  'use strict';

  /* ── Particles canvas ── */
  const canvas = document.getElementById('particles-canvas');
  if (canvas) {
    const ctx = canvas.getContext('2d');
    const particles = [];
    const COLORS = ['#f4b942', '#0fd850', '#162236', '#e0ddd7', '#ffd580'];

    function resize() {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    for (let i = 0; i < 22; i++) {
      particles.push({
        x: Math.random() * window.innerWidth,
        y: Math.random() * window.innerHeight,
        r: Math.random() * 5 + 2,
        dx: (Math.random() - 0.5) * 0.4,
        dy: -(Math.random() * 0.5 + 0.2),
        alpha: Math.random() * 0.3 + 0.1,
        color: COLORS[Math.floor(Math.random() * COLORS.length)],
      });
    }

    function drawParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = p.color;
        ctx.globalAlpha = p.alpha;
        ctx.fill();
        p.x += p.dx;
        p.y += p.dy;
        if (p.y < -10) { p.y = canvas.height + 10; p.x = Math.random() * canvas.width; }
        if (p.x < -10) p.x = canvas.width + 10;
        if (p.x > canvas.width + 10) p.x = -10;
      });
      ctx.globalAlpha = 1;
      requestAnimationFrame(drawParticles);
    }
    drawParticles();
  }

  /* ── Auth panel toggle ── */
  const authCard   = document.getElementById('authCard');
  const goSignup   = document.getElementById('goSignup');
  const goLogin    = document.getElementById('goLogin');

  if (goSignup) {
    goSignup.addEventListener('click', () => {
      authCard.classList.add('show-signup');
    });
  }
  if (goLogin) {
    goLogin.addEventListener('click', () => {
      authCard.classList.remove('show-signup');
      // Clean up URL if possible
      const url = new URL(window.location);
      url.searchParams.delete('signup');
      window.history.replaceState({}, '', url);
    });
  }

  /* ── Auto-show signup if errors or URL param ── */
  const urlParams = new URLSearchParams(window.location.search);
  const hasSignupError = document.querySelector('.panel-signup .alert-error') || document.querySelector('.panel-signup .form-control.error');
  if (urlParams.has('signup') || hasSignupError) {
    authCard.classList.add('show-signup');
  }

  /* ── Password visibility toggle ── */
  document.querySelectorAll('.toggle-pw').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.dataset.target;
      const input = document.getElementById(targetId);
      if (!input) return;
      const isText = input.type === 'text';
      input.type = isText ? 'password' : 'text';
      const icon = btn.querySelector('i');
      icon.className = isText ? 'far fa-eye' : 'far fa-eye-slash';
    });
  });

  /* ── Password strength meter ── */
  const regPass = document.getElementById('reg_password');
  const pwBar   = document.querySelector('.pw-bar');
  if (regPass && pwBar) {
    regPass.addEventListener('input', () => {
      const val = regPass.value;
      let strength = 0;
      if (val.length >= 8) strength++;
      if (/[A-Z]/.test(val)) strength++;
      if (/[0-9]/.test(val)) strength++;
      if (/[^A-Za-z0-9]/.test(val)) strength++;
      const pct  = (strength / 4) * 100;
      const colors = ['#e74c3c', '#e67e22', '#f1c40f', '#0fd850'];
      pwBar.style.width = pct + '%';
      pwBar.style.background = colors[strength - 1] || 'transparent';
    });
  }

  /* ── Client-side signup form validation ── */
  const signupForm = document.getElementById('signupForm');
  if (signupForm) {
    signupForm.addEventListener('submit', (e) => {
      const first = document.getElementById('reg_first').value.trim();
      const last  = document.getElementById('reg_last').value.trim();
      const email = document.getElementById('reg_email').value.trim();
      const pass  = document.getElementById('reg_password').value;

      if (!first || !last || !email || !pass) {
        e.preventDefault();
        showToast('Please fill all required fields 📋');
        return;
      }
      if (pass.length < 8) {
        e.preventDefault();
        showToast('Password must be at least 8 characters 🔒');
        return;
      }
      // Valid – allow POST to Symfony controller
    });
  }

  /* ── Toast helper ── */
  window.showToast = function(msg, duration = 2800) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), duration);
  };

})();
