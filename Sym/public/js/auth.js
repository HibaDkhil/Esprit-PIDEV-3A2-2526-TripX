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

  /* ── Auto-show signup if server returned errors or URL param ── */
  const urlParams = new URLSearchParams(window.location.search);
  const hasSignupError = document.querySelector('#panelSignup .has-error') ||
                         document.querySelector('#panelSignup .form-error-message');
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

  /* ── Signup form validation – button is type=button so page NEVER submits unless valid ── */
  const signupForm   = document.getElementById('signupForm');
  const doRegisterBtn = document.getElementById('doRegister');

  if (signupForm && doRegisterBtn) {
    function showFieldError(input, message) {
      if (!input) return;
      const existing = input.parentNode.querySelector('.wavy-error-msg');
      if (existing) existing.remove();
      const err = document.createElement('span');
      err.className = 'wavy-error-msg form-error-message';
      err.textContent = message;
      input.parentNode.appendChild(err);
      input.style.borderBottomColor = '#ef4444';
      input.parentNode.classList.add('has-error');
    }
    function clearFieldError(input) {
      if (!input) return;
      const existing = input.parentNode.querySelector('.wavy-error-msg');
      if (existing) existing.remove();
      input.style.borderBottomColor = '';
      input.parentNode.classList.remove('has-error');
    }

    doRegisterBtn.addEventListener('click', function() {
      let valid = true;

      const first = document.getElementById('registration_form_firstName');
      const last  = document.getElementById('registration_form_lastName');
      const email = document.getElementById('registration_form_email');
      const pass  = document.getElementById('registration_form_plainPassword_first');
      const pass2 = document.getElementById('registration_form_plainPassword_second');
      const phone = document.getElementById('registration_form_phoneNumber');

      [first, last, email, pass, pass2, phone].forEach(f => f && clearFieldError(f));

      if (first && !first.value.trim()) { showFieldError(first, 'First name is required'); valid = false; }
      if (last  && !last.value.trim())  { showFieldError(last,  'Last name is required');  valid = false; }
      if (email) {
        if (!email.value.trim()) { showFieldError(email, 'Email is required'); valid = false; }
        else if (!email.value.includes('@') || !email.value.includes('.')) { showFieldError(email, 'Please enter a valid email'); valid = false; }
      }
      if (pass) {
        if (!pass.value) { showFieldError(pass, 'Password is required'); valid = false; }
        else if (pass.value.length < 8) { showFieldError(pass, 'Password must be at least 8 characters'); valid = false; }
      }
      if (pass && pass2 && pass.value && pass.value !== pass2.value) {
        showFieldError(pass2, 'Passwords do not match'); valid = false;
      }
      if (phone && phone.value.trim() && !/^\d{8}$/.test(phone.value.trim())) {
        showFieldError(phone, 'Phone must be exactly 8 digits'); valid = false;
      }

      if (valid) {
        // All good – submit the form to Symfony
        signupForm.submit();
      }
      // If invalid: errors are shown above, panel stays exactly where it is
    });

    // Clear errors when user types + Enter key triggers validation
    signupForm.querySelectorAll('input').forEach(function(input) {
      input.addEventListener('input', function() { clearFieldError(input); });
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          doRegisterBtn.click();
        }
      });
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
