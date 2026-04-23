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

  /* ── Validation Helpers ── */
  function showFieldError(input, message) {
    if (!input) return;
    const parent = input.closest('.form-control');
    if (!parent) return;
    
    let err = parent.querySelector('.wavy-error-msg');
    if (!err) {
      err = document.createElement('span');
      err.className = 'wavy-error-msg form-error-message';
      parent.appendChild(err);
    }
    err.textContent = message;
    input.style.borderBottomColor = '#ef4444';
    parent.classList.add('has-error');
  }

  function clearFieldError(input) {
    if (!input) return;
    const parent = input.closest('.form-control');
    if (!parent) return;
    
    const err = parent.querySelector('.wavy-error-msg');
    if (err) err.remove();
    input.style.borderBottomColor = '';
    parent.classList.remove('has-error');
  }

  function showToast(message, duration = 4500) {
    if (!message) return;
    if (typeof window.tripxShowToast === 'function') {
      window.tripxShowToast(message, duration);
      return;
    }

    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(showToast._tid);
    showToast._tid = setTimeout(() => toast.classList.remove('show'), duration);
  }

  function getSignupFeedbackBox() {
    const signupForm = document.getElementById('signupForm');
    if (!signupForm) return null;

    let box = document.getElementById('signupFeedback');
    if (!box) {
      box = document.createElement('div');
      box.id = 'signupFeedback';
      box.className = 'alert';
      box.style.display = 'none';
      signupForm.prepend(box);
    }
    return box;
  }

  function showSignupFeedback(message, type = 'error') {
    const box = getSignupFeedbackBox();
    if (!box) return;

    box.className = `alert ${type === 'success' ? 'alert-success' : 'alert-error'}`;
    box.textContent = message || '';
    box.style.display = message ? 'flex' : 'none';
  }

  function clearSignupFeedback() {
    const box = document.getElementById('signupFeedback');
    if (box) {
      box.textContent = '';
      box.style.display = 'none';
     box.className = 'alert';
    }
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

  const shouldOpenVerificationModal = window.TRIPX?.pendingRegistrationVerification || urlParams.has('verify');
  if (shouldOpenVerificationModal) {
    authCard?.classList.add('show-signup');
    document.getElementById('verifyRegModal')?.classList.add('show');
  }

  /* ── Universal Input Management ── */
  document.querySelectorAll('.form-control input').forEach(function (input) {
    // Label lifting logic
    function checkFilled() {
      input.classList.toggle('has-value', !!(input.value && input.value.trim() !== ''));
    }
    checkFilled();
    input.addEventListener('input', () => {
      checkFilled();
      clearFieldError(input);
    });
    input.addEventListener('change', checkFilled);
    input.addEventListener('blur', checkFilled);
  });

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

  /* ── Throttling & Lock Manager ── */
  function initLoginThrottling() {
    const lockUntil = window.TRIPX?.lockUntil;
    if (!lockUntil) return;

    const loginForm = document.getElementById('loginForm');
    if (!loginForm) return;

    const emailInput = document.getElementById('login_email');
    const passInput  = document.getElementById('login_password');
    const loginBtn   = loginForm.querySelector('.btn-primary');
    
    function updateCountdown() {
      const now = Math.floor(Date.now() / 1000);
      const timeLeft = lockUntil - now;

      if (timeLeft <= 0) {
        location.reload();
        return;
      }

      // Lock
      [emailInput, passInput, loginBtn].forEach(el => {
        if (el) {
          el.disabled = true;
          el.style.opacity = '0.5';
          el.style.cursor = 'not-allowed';
        }
      });

      if (loginBtn) {
        loginBtn.innerHTML = `Locked: ${timeLeft}s <br><span style="font-size:10px; text-decoration:underline; cursor:pointer;" onclick="fetch('/face/dev-reset-lock').then(()=>location.reload())">(Dev Reset)</span>`;
      }
      setTimeout(updateCountdown, 1000);
    }

    updateCountdown();
  }
  initLoginThrottling();

  /* ── Password strength meter ── */
  const regPass = document.getElementById('reg_password');
  const pwBar   = document.querySelector('.pw-bar');
  const pwStatus = document.createElement('div');
  if (regPass) {
    pwStatus.style.fontSize = '11px';
    pwStatus.style.marginTop = '4px';
    regPass.parentElement.appendChild(pwStatus);

    regPass.addEventListener('input', () => {
      const val = regPass.value;
      let strength = 0;
      let items = [];
      
      if (val.length >= 8) strength++; else items.push('8+ characters');
      if (/[A-Z]/.test(val)) strength++; else items.push('uppercase');
      if (/[a-z]/.test(val)) strength++; else items.push('lowercase');
      if (/[0-9]/.test(val)) strength++; else items.push('number');
      
      const pct  = (strength / 4) * 100;
      const colors = ['#ef4444', '#e67e22', '#f1c40f', '#0fd850'];
      
      if (pwBar) {
        pwBar.style.width = pct + '%';
        pwBar.style.background = colors[strength - 1] || 'transparent';
      }

      if (val.length === 0) {
        pwStatus.textContent = '';
      } else if (strength < 4) {
        pwStatus.style.color = '#ef4444';
        pwStatus.textContent = items.join(', ');
      } else {
        pwStatus.style.color = '#0fd850';
        pwStatus.textContent = 'Strong password! ✓';
      }
    });
  }

  /* ── Login form validation ── */
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    const email = document.getElementById('login_email');
    const pass  = document.getElementById('login_password');

    // Real-time format validation
    if (email) {
      email.addEventListener('blur', () => {
        if (email.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
          showFieldError(email, 'Invalid email format');
        }
      });
    }

    loginForm.addEventListener('submit', function (e) {
      let valid = true;
      [email, pass].forEach(f => f && clearFieldError(f));

      if (email && !email.value.trim()) {
        showFieldError(email, 'Email is required');
        valid = false;
      } else if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        showFieldError(email, 'Invalid email format');
        valid = false;
      }

      if (pass && !pass.value) {
        showFieldError(pass, 'Password is required');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
      }
    });
  }

  /* ── Signup form validation ── */
  const signupForm   = document.getElementById('signupForm');
  const doRegisterBtn = document.getElementById('doRegister');

  if (signupForm && doRegisterBtn) {
    doRegisterBtn.addEventListener('click', function() {
      let valid = true;

      const first = document.getElementById('reg_first');
      const last  = document.getElementById('reg_last');
      const email = document.getElementById('reg_email');
      const pass  = document.getElementById('reg_password');
      const pass2 = document.getElementById('reg_confirm');
      const phone = document.getElementById('reg_phone');

      clearSignupFeedback();
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

      if (!valid) {
        showSignupFeedback('Please fix the highlighted fields and try again.');
        return;
      }

      // Use AJAX for registration to show verification modal only after DB + mail succeed
      doRegisterBtn.disabled = true;
      doRegisterBtn.textContent = 'Creating account...';

      const formData = new FormData(signupForm);
      fetch(window.TRIPX.registerUrl, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(async resp => {
        const data = await resp.json();
        return { ok: resp.ok, data };
      })
      .then(({ ok, data }) => {
        if (data.success) {
          showSignupFeedback(data.message || 'Verification code sent.', 'success');
          showToast(data.message || 'Verification code sent.');
          const verifyModal = document.getElementById('verifyRegModal');
          if (verifyModal) verifyModal.classList.add('show');
          return;
        }

        const fieldMap = {
          firstName: first,
          lastName: last,
          email: email,
          plainPassword: pass,
          first: pass,
          second: pass2,
          phoneNumber: phone
        };

        const fieldErrors = data.field_errors || {};
        Object.entries(fieldErrors).forEach(([key, message]) => {
          const input = fieldMap[key];
          if (input && message) {
            showFieldError(input, message);
          }
        });

        const message = data.message || (ok ? 'Registration failed.' : 'Registration request failed.');
        showSignupFeedback(message, 'error');
        showToast(message, 7000);
      })
      .catch(err => {
        console.error('Registration error:', err);
        const message = 'Network error. Please try again.';
        showSignupFeedback(message, 'error');
        showToast(message, 7000);
      })
      .finally(() => {
        doRegisterBtn.disabled = false;
        doRegisterBtn.textContent = 'Create account';
      });
    });

    signupForm.querySelectorAll('input').forEach(function(input) {
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          doRegisterBtn.click();
        }
      });
    });
  }

  /* ── Forgot Password Modal Flow ── */
  const forgotModal = document.getElementById('forgotModal');
  const openForgot  = document.getElementById('openForgot');
  const closeForgot = document.getElementById('closeForgot');
  const btnSendCode = document.getElementById('btnSendCode');
  const btnVerifyCode = document.getElementById('btnVerifyCode');
  const btnResetFinal = document.getElementById('btnResetFinal');

  const stepEmail = document.getElementById('stepEmail');
  const stepCode  = document.getElementById('stepCode');
  const stepReset = document.getElementById('stepReset');

  function switchStep(nextStep) {
    [stepEmail, stepCode, stepReset].forEach(s => s.classList.remove('active'));
    nextStep.classList.add('active');
  }

  if (openForgot) {
    openForgot.addEventListener('click', (e) => {
      e.preventDefault();
      forgotModal.classList.add('show');
      switchStep(stepEmail);
    });
  }

  if (closeForgot) {
    closeForgot.addEventListener('click', () => {
      forgotModal.classList.remove('show');
    });
  }

  // Close on outside click
  forgotModal?.addEventListener('click', (e) => {
    if (e.target === forgotModal) closeForgot.click();
  });

  // Step 1: Send Code
  btnSendCode?.addEventListener('click', async () => {
    const email = document.getElementById('forgot_email').value;
    if (!email) return alert('Please enter your email');
    
    btnSendCode.disabled = true;
    btnSendCode.textContent = 'Sending...';

    const resp = await fetch(window.TRIPX.endpoints.sendCode, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email })
    });

    const data = await resp.json();
    if (data.success) {
      switchStep(stepCode);
    } else {
      alert(data.message || 'Error occurred');
    }
    btnSendCode.disabled = false;
    btnSendCode.textContent = 'Send Code';
  });

  // Step 2: Verify Code
  btnVerifyCode?.addEventListener('click', async () => {
    const code = document.getElementById('forgot_code').value;
    if (code.length < 6) return alert('Enter the 6-digit code');

    const resp = await fetch(window.TRIPX.endpoints.verifyCode, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ code })
    });

    const data = await resp.json();
    if (data.success) {
      switchStep(stepReset);
    } else {
      alert(data.message || 'Invalid code');
    }
  });

  // Step 3: Reset Final
  btnResetFinal?.addEventListener('click', async () => {
    const password = document.getElementById('forgot_password').value;
    const confirm  = document.getElementById('forgot_confirm').value;

    if (password !== confirm) return alert('Passwords do not match');
    if (password.length < 8) return alert('Password must be at least 8 characters');
    if (!/[A-Z]/.test(password)) return alert('Password must contain at least 1 uppercase letter');
    if (!/[a-z]/.test(password)) return alert('Password must contain at least 1 lowercase letter');
    if (!/[0-9]/.test(password)) return alert('Password must contain at least 1 number');

    const resp = await fetch(window.TRIPX.endpoints.resetPassword, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ password })
    });

    const data = await resp.json();
    if (data.success) {
      alert('Password updated successfully! Please login.');
      location.reload();
    } else {
      alert(data.message || 'Error occurred');
    }
  });

  /* ── Registration Verification Modal Logic ── */
  const verifyRegModal = document.getElementById('verifyRegModal');
  const closeVerifyReg  = document.getElementById('closeVerifyReg');
  const btnVerifyReg   = document.getElementById('btnVerifyReg');

  if (closeVerifyReg) {
    closeVerifyReg.addEventListener('click', () => {
      verifyRegModal.classList.remove('show');
    });
  }

  verifyRegModal?.addEventListener('click', (e) => {
    if (e.target === verifyRegModal) closeVerifyReg.click();
  });

  btnVerifyReg?.addEventListener('click', async () => {
    const code = document.getElementById('reg_verify_code').value;
    if (code.length < 6) {
      showToast('Please enter the 6-digit code');
      return;
    }

    btnVerifyReg.disabled = true;
    btnVerifyReg.textContent = 'Verifying...';

    try {
      const resp = await fetch(window.TRIPX.endpoints.verifyRegistration, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ code })
      });

      const contentType = resp.headers.get('content-type') || '';
      if (!contentType.includes('application/json')) {
        const raw = await resp.text();
        throw new Error(`Expected JSON but received ${resp.status}. Response starts with: ${raw.slice(0, 120)}`);
      }

      const data = await resp.json();
      if (data.success) {
        // Success! Go to onboarding
        window.location.href = window.TRIPX.onboardingUrl;
      } else {
        showToast(data.message || 'Invalid code', 7000);
      }
    } catch (e) {
      console.error('Verification error:', e);
      showToast('Verification failed. Please try again.', 7000);
    } finally {
      btnVerifyReg.disabled = false;
      btnVerifyReg.textContent = 'Verify & Continue';
    }
  });

})();
