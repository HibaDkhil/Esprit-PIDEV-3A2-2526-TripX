/**
 * TripX Experience Lab — Main JavaScript
 * File: public/js/experience-lab.js
 */

/* ─── State ─────────────────────────────────────────────────────────── */
const LAB = {
  currentStep:   1,
  totalSteps:    6,
  answers:       {},
  selectedInterests: [],
  lastPlan:      null,
  lastLiveData:  null,
  cart:          { destinations: [], accommodations: [], activities: [], offers: [] },
};

const typeMap = {
  'results-destinations': 'destinations',
  'results-accommodations': 'accommodations',
  'results-activities': 'activities',
  'results-offers': 'offers',
};

/* ─── Init ──────────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  initStarCanvas();
  initOptionCards();
  initTabButtons();
  updateProgress();
  fetchSavedPlans();
  initSelectionPlanner();
});

/* ─── Star / particle canvas ─────────────────────────────────────────── */
function initStarCanvas() {
  const canvas = document.getElementById('star-canvas');
  if (!canvas) return;
  const ctx    = canvas.getContext('2d');
  let   mouse  = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
  const stars  = [];
  const STAR_COUNT = 180;

  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);
  window.addEventListener('mousemove', e => { mouse.x = e.clientX; mouse.y = e.clientY; });

  for (let i = 0; i < STAR_COUNT; i++) {
    stars.push({
      x:    Math.random() * window.innerWidth,
      y:    Math.random() * window.innerHeight,
      r:    Math.random() * 1.8 + 0.2,
      vx:   (Math.random() - 0.5) * 0.2,
      vy:   (Math.random() - 0.5) * 0.2,
      alpha: Math.random() * 0.7 + 0.2,
      hue:  Math.random() * 60 + 220, // blue-purple range
    });
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    stars.forEach(s => {
      // mouse parallax
      const dx = (mouse.x - canvas.width / 2)  * 0.005;
      const dy = (mouse.y - canvas.height / 2) * 0.005;
      s.x += s.vx + dx * s.r * 0.3;
      s.y += s.vy + dy * s.r * 0.3;

      // wrap
      if (s.x < 0) s.x = canvas.width;
      if (s.x > canvas.width) s.x = 0;
      if (s.y < 0) s.y = canvas.height;
      if (s.y > canvas.height) s.y = 0;

      // twinkle
      s.alpha += (Math.random() - 0.5) * 0.03;
      s.alpha  = Math.max(0.1, Math.min(0.9, s.alpha));

      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `hsla(${s.hue}, 80%, 75%, ${s.alpha})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  draw();
}

/* ─── Floating rectangle particles (homepage) ───────────────────────── */
function initFloatParticles(canvasId) {
  const canvas = document.getElementById(canvasId);
  if (!canvas) return;
  const ctx    = canvas.getContext('2d');
  const particles = [];

  function resize() {
    canvas.width  = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
  }
  resize();

  for (let i = 0; i < 55; i++) {
    particles.push({
      x:     Math.random() * canvas.width,
      y:     Math.random() * canvas.height,
      r:     Math.random() * 2 + 0.5,
      vx:    (Math.random() - 0.5) * 0.4,
      vy:    -Math.random() * 0.5 - 0.2,
      alpha: Math.random() * 0.6 + 0.2,
      hue:   Math.random() * 80 + 200,
    });
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
      p.x += p.vx;
      p.y += p.vy;
      if (p.y < 0) { p.y = canvas.height; p.x = Math.random() * canvas.width; }
      if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `hsla(${p.hue}, 85%, 70%, ${p.alpha})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  draw();
}

/* ─── Option card clicks ─────────────────────────────────────────────── */
function initOptionCards() {
  // Single-select cards
  document.querySelectorAll('.option-card:not(.interest-card)').forEach(card => {
    card.addEventListener('click', () => {
      const key   = card.dataset.key;
      const value = card.dataset.value;
      // Deselect siblings
      document.querySelectorAll(`.option-card[data-key="${key}"]`).forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
      LAB.answers[key] = value;

      // Auto-advance after short delay
      setTimeout(() => advanceStep(), 350);
    });
  });

  // Multi-select interest cards (max 3)
  document.querySelectorAll('.interest-card').forEach(card => {
    card.addEventListener('click', () => {
      const value = card.dataset.value;
      if (card.classList.contains('selected')) {
        card.classList.remove('selected');
        LAB.selectedInterests = LAB.selectedInterests.filter(v => v !== value);
      } else {
        if (LAB.selectedInterests.length >= 3) {
          shakeHint();
          return;
        }
        card.classList.add('selected');
        LAB.selectedInterests.push(value);
      }
      LAB.answers.interests = [...LAB.selectedInterests];
      updateInterestHint();
      fetchLiveResults();
    });
  });

  // Interest step: add a "Continue" button
  const step5 = document.getElementById('step-5');
  if (step5) {
    const continueBtn = document.createElement('button');
    continueBtn.className = 'float-cta';
    continueBtn.style.marginTop = '1rem';
    continueBtn.textContent = 'Continue →';
    continueBtn.addEventListener('click', advanceStep);
    step5.appendChild(continueBtn);
  }
}

function updateInterestHint() {
  const hint = document.getElementById('interest-hint');
  if (!hint) return;
  const n = LAB.selectedInterests.length;
  if (n === 0) hint.textContent = 'Select up to 3 interests';
  else if (n === 3) hint.textContent = '✓ Maximum selected! Click Continue to proceed.';
  else hint.textContent = `${n}/3 selected — choose ${3 - n} more`;
}

function shakeHint() {
  const hint = document.getElementById('interest-hint');
  if (!hint) return;
  hint.style.color = '#ec4899';
  hint.textContent = '⚠️ Max 3 interests allowed!';
  hint.animate([{transform:'translateX(-4px)'},{transform:'translateX(4px)'},{transform:'translateX(0)'}], {duration:300, iterations:2});
  setTimeout(() => updateInterestHint(), 1500);
}

/* ─── Step navigation ────────────────────────────────────────────────── */
function advanceStep() {
  const currentAnswerKey = getStepKey(LAB.currentStep);
  if (currentAnswerKey !== 'interests' && !LAB.answers[currentAnswerKey]) return;

  // Hide current, show next
  const currentEl = document.getElementById(`step-${LAB.currentStep}`);
  if (currentEl) currentEl.classList.remove('active');

  LAB.currentStep++;
  updateProgress();

  if (LAB.currentStep <= LAB.totalSteps) {
    const nextEl = document.getElementById(`step-${LAB.currentStep}`);
    if (nextEl) nextEl.classList.add('active');
    fetchLiveResults();
  } else {
    // All answered — show generate button & results panel
    showGenerateButton();
  }
}

function getStepKey(step) {
  const map = { 1:'weather', 2:'group', 3:'climate', 4:'budget', 5:'interests', 6:'duration' };
  return map[step] || '';
}

function updateProgress() {
  const fill = document.getElementById('progress-fill');
  const pct  = Math.min(100, ((LAB.currentStep - 1) / LAB.totalSteps) * 100);
  if (fill) fill.style.width = pct + '%';

  for (let i = 1; i <= LAB.totalSteps; i++) {
    const dot = document.getElementById(`dot-${i}`);
    if (!dot) continue;
    dot.classList.remove('active', 'done');
    if (i < LAB.currentStep)  dot.classList.add('done');
    if (i === LAB.currentStep) dot.classList.add('active');
  }
}

function showGenerateButton() {
  const panel = document.getElementById('generate-plan-section');
  if (panel) panel.style.display = 'block';

  const btn = document.getElementById('generate-btn');
  if (btn) {
    btn.addEventListener('click', generateFinalPlan);
    btn.style.animation = 'pulse-ring 2s ease-in-out infinite';
  }

  // Scroll results into view
  const livePanel = document.getElementById('live-results-panel');
  if (livePanel) livePanel.scrollIntoView({ behavior: 'smooth' });
}

/* ─── Tabs ───────────────────────────────────────────────────────────── */
function initTabButtons() {
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const tab = btn.dataset.tab;
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById(`tab-${tab}`)?.classList.add('active');
    });
  });
}

/* ─── Live results fetch ─────────────────────────────────────────────── */
let fetchTimeout = null;
function fetchLiveResults() {
  clearTimeout(fetchTimeout);
  fetchTimeout = setTimeout(_doFetch, 400);
}

async function _doFetch() {
  if (Object.keys(LAB.answers).length === 0) return;
  showAriaTyping();
  try {
    const res  = await fetch(LIVE_RESULTS_URL, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body:    JSON.stringify(LAB.answers),
    });
    const data = await res.json();
    LAB.lastLiveData = data;
    renderLiveResults(data);
    renderDestinationRadar(data);
    addAriaMessage(data.ariaComment || '✨ Looking great! Keep going!');
    updateStats(data);
    showResultsPanel();
  } catch (e) {
    console.error('Live results error:', e);
    addAriaMessage("🔧 I'm refreshing my data... just a moment!");
  } finally {
    hideAriaTyping();
  }
}

/* ─── Render live results ────────────────────────────────────────────── */
function renderLiveResults(data) {
  renderGrid('results-destinations', data.destinations || [], renderDestCard);
  renderGrid('results-accommodations', data.accommodations || [], renderAccCard);
  renderGrid('results-activities', data.activities || [], renderActCard);
  renderGrid('results-offers', data.offers || [], renderOfferCard);
}

function renderDestinationRadar(data) {
  const list = document.getElementById('aria-destination-list');
  const advice = document.getElementById('aria-destination-advice');
  const destinations = (data.destinations || []).slice(0, 3);

  if (advice) {
    advice.textContent = data.destinationAdvice || data.ariaComment || 'ARIA is reading your choices and watching for the strongest destination match.';
  }

  if (!list) return;
  list.innerHTML = '';

  if (!destinations.length) {
    const empty = document.createElement('div');
    empty.className = 'aria-radar-empty';
    empty.textContent = 'Answer a few questions to unlock live destination advice.';
    list.appendChild(empty);
    return;
  }

  destinations.forEach((dest) => {
    const item = document.createElement('button');
    item.type = 'button';
    item.className = 'aria-radar-item';
    item.onclick = () => {
      addToSelection('destinations', dest);
      document.getElementById('planner-section')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    const name = document.createElement('span');
    name.className = 'aria-radar-name';
    name.textContent = dest.name || 'Destination';

    const meta = document.createElement('span');
    meta.className = 'aria-radar-meta';
    meta.textContent = `${dest.country || 'TripX pick'} - ${dest.matchScore || 90}% match`;

    item.append(name, meta);
    list.appendChild(item);
  });
}

function renderGrid(id, items, renderFn) {
  const el = document.getElementById(id);
  const type = typeMap[id];
  if (!el) return;
  if (!items.length) {
    el.innerHTML = '<div class="results-placeholder">No results yet — keep answering!</div>';
    return;
  }
  el.innerHTML = '';
  items.forEach((item, i) => {
    const card = renderFn(item);
    card.style.animationDelay = `${i * 0.05}s`;
    
    // Add "Add to Plan" button
    const addBtn = document.createElement('button');
    addBtn.className = 'add-to-plan-btn';
    
    const isSelected = LAB.cart[type].some(i => i.id === item.id);
    addBtn.innerHTML = isSelected ? '✓' : '➕';
    addBtn.style.cssText = `position:absolute; top:8px; left:8px; background:${isSelected ? 'var(--neon-green)' : 'var(--neon-purple)'}; border:none; color:white; border-radius:50%; width:28px; height:28px; cursor:pointer; font-size:14px; z-index:10; display:flex; align-items:center; justify-content:center; box-shadow:0 0 15px rgba(0,0,0,0.6); transition:all 0.3s;`;
    
    if (isSelected) card.style.border = '2px solid var(--neon-green)';

    addBtn.onclick = (e) => {
        e.stopPropagation();
        if (isSelected) {
            removeFromSelection(type, item.id);
            addBtn.innerHTML = '➕';
            addBtn.style.background = 'var(--neon-purple)';
            card.style.border = '';
        } else {
            addToSelection(type, item);
            addBtn.innerHTML = '✓';
            addBtn.style.background = 'var(--neon-green)';
            card.style.border = '2px solid var(--neon-green)';
        }
    };
    card.appendChild(addBtn);
    
    el.appendChild(card);
  });
}

function matchClass(score) {
  if (score >= 80) return 'match-high';
  if (score >= 60) return 'match-medium';
  return '';
}

function renderDestCard(d) {
  const card = document.createElement('div');
  card.className = 'result-card';
  card.innerHTML = `
    <div class="match-badge ${matchClass(d.matchScore)}">${d.matchScore}%</div>
    ${d.image
      ? `<img src="${d.image}" alt="${d.name}" class="result-image" onerror="this.style.display='none'">`
      : `<div class="result-no-image">🗺️</div>`}
    <div class="result-name">${d.name}</div>
    <div class="result-sub">${d.country || ''}</div>
  `;
  return card;
}

function renderAccCard(a) {
  const card = document.createElement('div');
  card.className = 'result-card';
  const stars = '⭐'.repeat(Math.min(5, a.stars || 3));
  card.innerHTML = `
    <div class="match-badge ${matchClass(a.matchScore)}">${a.matchScore}%</div>
    ${a.image
      ? `<img src="${a.image}" alt="${a.name}" class="result-image" onerror="this.style.display='none'">`
      : `<div class="result-no-image">🏨</div>`}
    <div class="result-name">${a.name}</div>
    <div class="result-sub">${stars} · $${a.price}/night</div>
  `;
  return card;
}

function renderActCard(a) {
  const card = document.createElement('div');
  card.className = 'result-card';
  card.innerHTML = `
    <div class="match-badge ${matchClass(a.matchScore)}">${a.matchScore}%</div>
    ${a.image
      ? `<img src="${a.image}" alt="${a.name}" class="result-image" onerror="this.style.display='none'">`
      : `<div class="result-no-image">🎯</div>`}
    <div class="result-name">${a.name}</div>
    <div class="result-sub">${a.category || ''} ${a.price ? '· $'+a.price : ''}</div>
  `;
  return card;
}

function renderOfferCard(o) {
  const card = document.createElement('div');
  card.className = 'result-card offer-card';
  card.innerHTML = `
    <div class="match-badge ${matchClass(o.matchScore)}">${o.matchScore}%</div>
    <div class="offer-discount">${o.discount}% OFF</div>
    <div class="result-name" style="margin-top:0.3rem">${o.name}</div>
    <div class="result-sub">${o.type === 'offer' ? '🎫 Offer' : '📦 Pack'} ${o.validUntil ? '· Until '+o.validUntil : ''}</div>
  `;
  return card;
}

function showResultsPanel() {
  const panel = document.getElementById('live-results-panel');
  if (panel) panel.style.display = 'block';
}

function updateStats(data) {
  const statsEl = document.getElementById('aria-stats');
  if (statsEl) statsEl.style.display = 'flex';
  setText('stat-destinations', (data.destinations || []).length);
  setText('stat-activities',   (data.activities   || []).length);
  setText('stat-offers',       (data.offers        || []).length);
  
  // Show planner once we have results
  const planner = document.getElementById('planner-section');
  if (planner) planner.style.display = 'block';
}

/* ─── Selection Planner ─────────────────────────────────────────────── */
function initSelectionPlanner() {
    const validateBtn = document.getElementById('validate-selection-btn');
    if (validateBtn) {
        validateBtn.onclick = () => validateTripPlan();
    }
    updatePlannerUI();
}

function getTripDays() {
    const duration = LAB.answers.duration || '5-7 days';
    if (duration === 'weekend') return 3;
    if (duration === '10-14 days') return 12;
    if (duration === '2+ weeks') return 18;
    return 6;
}

function getTravelerCount() {
    const group = LAB.answers.group || 'solo';
    if (group === 'couple') return 2;
    if (group === 'family') return 4;
    if (group === 'friends') return 3;
    return 1;
}

function calculateTripStats() {
    const days = getTripDays();
    const nights = Math.max(1, days - 1);
    const travelers = getTravelerCount();
    const lodgingNightly = LAB.cart.accommodations.reduce((sum, item) => sum + Number(item.price || 0), 0);
    const activities = LAB.cart.activities.reduce((sum, item) => sum + Number(item.price || 0), 0) * travelers;
    const packs = LAB.cart.offers.filter(item => Number(item.price || 0) > 0).reduce((sum, item) => sum + Number(item.price || 0), 0);
    const transport = LAB.cart.destinations.length ? 300 * travelers * LAB.cart.destinations.length : 0;
    const lodging = lodgingNightly * nights;
    const subtotal = lodging + activities + packs + transport;
    const discountRate = Math.min(60, LAB.cart.offers.reduce((sum, item) => sum + Number(item.discount || 0), 0));
    const savings = Math.round(subtotal * (discountRate / 100));
    const total = Math.max(0, subtotal - savings);
    const perPerson = travelers ? Math.round(total / travelers) : total;

    return { days, nights, travelers, lodging, activities, packs, transport, discountRate, savings, total, perPerson };
}

function formatMoney(value) {
    return '$' + Math.round(Number(value || 0)).toLocaleString();
}

function pluralCartType(type) {
    return type === 'activity' ? 'activities' : `${type}s`;
}

function addToSelection(type, item) {
    if (LAB.cart[type].some(i => i.id === item.id)) {
        addAriaMessage(`✨ You already added **${item.name}**! Choose something else too!`);
        return;
    }
    LAB.cart[type].push(item);
    updatePlannerUI();
    
    // Show simulation button if at least 1 destination and 1 other item selected
    const simBtn = document.getElementById('open-simulation-btn');
    const totalSelected = LAB.cart.destinations.length + LAB.cart.accommodations.length + LAB.cart.activities.length;
    if (simBtn && totalSelected >= 2) {
        simBtn.style.display = 'block';
        simBtn.classList.add('pulse-animation');
    }

    // Dynamic ARIA advice in the right panel
    addAriaMessage(`🎯 Excellent choice! **${item.name}** perfectly aligns with your journey. I'm updating your budget and plan analysis right now...`);
    
    // Also trigger the "Analysis" box update
    analyzeSelectionDynamically();
}

async function analyzeSelectionDynamically() {
    const adviceBox = document.getElementById('aria-planner-advice');
    const adviceText = document.getElementById('planner-advice-text');
    if (!adviceBox || !adviceText) return;

    if (LAB.cart.destinations.length === 0) {
        adviceBox.style.display = 'none';
        return;
    }

    adviceBox.style.display = 'block';
    adviceText.textContent = 'ARIA is analyzing...';

    try {
        const res = await fetch(GENERATE_PLAN_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ answers: LAB.answers, cart: LAB.cart })
        });
        const plan = await res.json();
        adviceText.textContent = plan.ariaFinalPitch || "This combination looks great! I've calculated a specialized budget for you.";
    } catch (e) {
        adviceText.textContent = "I'm loving these choices! Keep adding items to refine your plan.";
    }
}

function removeFromSelection(type, id) {
    LAB.cart[type] = LAB.cart[type].filter(i => i.id !== id);
    updatePlannerUI();
    
    const simBtn = document.getElementById('open-simulation-btn');
    const totalSelected = LAB.cart.destinations.length + LAB.cart.accommodations.length + LAB.cart.activities.length;
    if (simBtn && totalSelected < 2) simBtn.style.display = 'none';
}

function updatePlannerUI() {
    const summary = document.getElementById('selection-summary');
    const totalEl = document.getElementById('planner-total');
    if (!summary || !totalEl) return;

    summary.innerHTML = '';
    const stats = calculateTripStats();

    const allItems = [
        ...LAB.cart.destinations.map(i => ({...i, type: 'destination', icon: '🗺️'})),
        ...LAB.cart.accommodations.map(i => ({...i, type: 'accommodation', icon: '🏨'})),
        ...LAB.cart.activities.map(i => ({...i, type: 'activity', icon: '🎯'})),
        ...LAB.cart.offers.map(i => ({...i, type: 'offer', icon: '🔥'}))
    ];

    if (allItems.length === 0) {
        summary.innerHTML = '<div class="empty-selection" style="color:var(--text-muted); font-size:0.85rem; text-align:center;">Select items from recommendations to build your plan</div>';
        totalEl.textContent = '$0.00';
        updatePlannerStats(stats);
        return;
    }

    allItems.forEach(item => {
        const itemPrice = item.price || 0;

        const div = document.createElement('div');
        div.style.cssText = 'display:flex; justify-content:space-between; align-items:center; background:rgba(255,255,255,0.05); padding:0.5rem 0.8rem; border-radius:0.5rem; border:1px solid rgba(139,92,246,0.2);';
        div.innerHTML = `
            <div style="font-size:0.85rem; display:flex; align-items:center; gap:0.5rem;">
                <span>${item.icon}</span>
                <span>${item.name}</span>
            </div>
            <div style="display:flex; align-items:center; gap:1rem;">
                <span style="font-size:0.8rem; color:var(--neon-gold); font-weight:700;">${itemPrice > 0 ? '$' + itemPrice : 'FREE'}</span>
                <button onclick="removeFromSelection('${pluralCartType(item.type)}', ${item.id})" style="background:transparent; border:none; color:var(--neon-pink); cursor:pointer; font-size:1.1rem;">&times;</button>
            </div>
        `;
        summary.appendChild(div);
    });

    totalEl.textContent = formatMoney(stats.total);
    updatePlannerStats(stats);
}

function updatePlannerStats(stats) {
    setText('planner-days', stats.days);
    setText('planner-travelers', stats.travelers);
    setText('planner-savings', formatMoney(stats.savings));
    setText('planner-per-person', formatMoney(stats.perPerson));
    setText('planner-lodging', formatMoney(stats.lodging));
    setText('planner-activities', formatMoney(stats.activities));
    setText('planner-transport', formatMoney(stats.transport));
    setText('planner-discount', stats.discountRate ? `${stats.discountRate}%` : '0%');
}

async function validateTripPlan() {
    if (LAB.cart.destinations.length === 0) {
        addAriaMessage("🔍 Please pick at least one destination first!");
        return;
    }
    
    addAriaMessage("🤖 Analyzing your selection and calculating the real-time budget... just a second!");
    showAriaTyping();
    
    try {
        const res = await fetch(GENERATE_PLAN_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ answers: LAB.answers, cart: LAB.cart })
        });
        const plan = await res.json();
        LAB.lastPlan = plan;
        renderFinalPlan(plan);
        addAriaMessage("✨ I've analyzed your custom trip! The budget looks solid and I've added some advice in the final plan overlay!");
    } catch (e) {
        console.error(e);
    } finally {
        hideAriaTyping();
    }
}

/* ─── Saved Plans Logic ─────────────────────────────────────────────── */
async function fetchSavedPlans() {
    try {
        const res = await fetch(typeof MY_PLANS_URL !== 'undefined' ? MY_PLANS_URL : '/experience-lab/my-plans');
        const plans = await res.json();
        renderSavedPlans(plans);
    } catch (e) {
        console.error('Fetch plans error:', e);
    }
}

function renderSavedPlans(plans) {
    const list = document.getElementById('saved-plans-list');
    if (!list) return;

    if (!plans || plans.length === 0) {
        list.innerHTML = '<div style="font-size:0.75rem; color:var(--text-muted); text-align:center;">No saved plans yet</div>';
        return;
    }

    list.innerHTML = '';
    plans.forEach(plan => {
        const div = document.createElement('div');
        div.style.cssText = 'background:rgba(255,255,255,0.03); border:1px solid rgba(139,92,246,0.15); border-radius:0.8rem; padding:0.8rem; cursor:pointer; transition:all 0.2s; position:relative;';
        div.innerHTML = `
            <div style="font-size:0.85rem; font-weight:700; color:var(--text-primary); margin-bottom:0.2rem;">${plan.title}</div>
            <div style="font-size:0.7rem; color:var(--text-muted);">${plan.date}</div>
            <button class="delete-plan-btn" style="position:absolute; top:0.5rem; right:0.5rem; background:transparent; border:none; color:rgba(236,72,153,0.4); cursor:pointer;">&times;</button>
        `;
        div.onclick = () => {
            LAB.lastPlan = plan.data;
            renderFinalPlan(plan.data);
        };
        const delBtn = div.querySelector('.delete-plan-btn');
        delBtn.onclick = (e) => {
            e.stopPropagation();
            deleteSavedPlan(plan.id, div);
        };
        list.appendChild(div);
    });
}

async function deleteSavedPlan(id, el) {
    if (!confirm('Are you sure you want to delete this trip plan?')) return;
    try {
        await fetch(`/experience-lab/delete-plan/${id}`, { method: 'DELETE' });
        el.style.opacity = '0';
        el.style.transform = 'scale(0.9)';
        setTimeout(() => el.remove(), 300);
    } catch (e) { console.error(e); }
}

/* ─── ARIA messages ──────────────────────────────────────────────────── */
function addAriaMessage(text) {
  const feed = document.getElementById('aria-chat-feed');
  const panel = document.querySelector('.aria-panel');
  if (!feed) return;

  // Add a glow to the panel to show ARIA is talking
  if (panel) {
      panel.style.boxShadow = '0 0 30px var(--neon-purple)';
      setTimeout(() => { panel.style.boxShadow = ''; }, 2000);
  }

  const msg = document.createElement('div');
  msg.className = 'aria-message';
  const bubble = document.createElement('div');
  bubble.className = 'aria-bubble';
  bubble.textContent = text;
  const timestamp = document.createElement('div');
  timestamp.className = 'aria-timestamp';
  timestamp.textContent = new Date().toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'});
  msg.append(bubble, timestamp);
  feed.appendChild(msg);
  feed.scrollTop = feed.scrollHeight;
}

function showAriaTyping() {
  const el = document.getElementById('aria-typing');
  if (el) el.style.display = 'flex';
}
function hideAriaTyping() {
  const el = document.getElementById('aria-typing');
  if (el) el.style.display = 'none';
}

/* ─── Generate final plan ────────────────────────────────────────────── */
async function generateFinalPlan() {
  const btn = document.getElementById('generate-btn');
  if (btn) {
    btn.disabled = true;
    btn.querySelector('.generate-btn-inner').textContent = '⏳ Crafting your perfect trip...';
  }
  showAriaTyping();

  try {
    const res  = await fetch(GENERATE_PLAN_URL, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body:    JSON.stringify({ answers: LAB.answers, cart: LAB.cart }),
    });
    const plan = await res.json();
    LAB.lastPlan = plan;
    renderFinalPlan(plan);
  } catch (e) {
    console.error('Generate plan error:', e);
    addAriaMessage("😅 Hmm, something went wrong generating your plan. Let me try again!");
  } finally {
    hideAriaTyping();
    if (btn) { btn.disabled = false; btn.querySelector('.generate-btn-inner').textContent = '✨ GENERATE MY PERFECT TRIP ✨'; }
  }
}

function renderFinalPlan(plan) {
  const overlay = document.getElementById('final-plan-overlay');
  if (!overlay) return;

  // Subtitle
  setText('plan-subtitle', plan.destination
    ? `Your dream trip to ${plan.destination.name}${plan.destination.country ? ', '+plan.destination.country : ''}`
    : 'Your personalised travel plan is ready!');

  // Body
  const body = document.getElementById('plan-body');
  if (body) {
    body.innerHTML = '';

    // Destination
    const destSection = document.createElement('div');
    destSection.innerHTML = `
      <div class="plan-section-title">🗺️ Top Destination</div>
      <div class="plan-dest-card">
        <div class="plan-dest-name">${plan.destination?.name || 'TBD'}</div>
        <div class="plan-dest-country">${plan.destination?.country || ''}</div>
        ${plan.destination?.description ? `<p style="font-size:0.78rem;color:var(--text-muted);margin-top:0.5rem">${plan.destination.description}</p>` : ''}
        <div style="margin-top:0.8rem"><span class="match-badge match-high" style="position:static;display:inline">${plan.destination?.matchScore || 95}% Match</span></div>
      </div>
    `;
    body.appendChild(destSection);

    // Activities
    const actSection = document.createElement('div');
    actSection.innerHTML = `<div class="plan-section-title">🎯 Daily Activities</div>`;
    const actList = document.createElement('ul');
    actList.className = 'plan-list';
    (plan.activities || []).forEach((act, i) => {
      const li = document.createElement('li');
      li.style.cursor = 'pointer';
      li.onclick = () => window.location.href = BOOKING_URL;
      li.innerHTML = `
        <div>
          <div class="item-name">Day ${i+1}: ${act.name}</div>
          <div class="item-meta">${act.category || ''} ${act.duration ? '· '+act.duration : ''}</div>
        </div>
        <div style="text-align:right">
          <div class="item-match">${act.matchScore}%</div>
          <div style="font-size:0.65rem;color:var(--neon-cyan);margin-top:0.2rem">Click to Book ↗</div>
        </div>
      `;
      actList.appendChild(li);
    });
    actSection.appendChild(actList);
    body.appendChild(actSection);

    // Accommodations
    const accSection = document.createElement('div');
    accSection.innerHTML = `<div class="plan-section-title">🏨 Top Stays</div>`;
    const accList = document.createElement('ul');
    accList.className = 'plan-list';
    (plan.accommodations || []).forEach(acc => {
      const li = document.createElement('li');
      li.style.cursor = 'pointer';
      li.onclick = () => window.location.href = BOOKING_URL;
      li.innerHTML = `
        <div>
          <div class="item-name">${acc.name}</div>
          <div class="item-meta">${acc.type || ''} · $${acc.price}/night</div>
        </div>
        <div style="text-align:right">
          <div class="item-match">${acc.matchScore}%</div>
          <div style="font-size:0.65rem;color:var(--neon-cyan);margin-top:0.2rem">Click to Book ↗</div>
        </div>
      `;
      accList.appendChild(li);
    });
    accSection.appendChild(accList);
    body.appendChild(accSection);

    // Offer
    if (plan.offer) {
      const offerSection = document.createElement('div');
      offerSection.innerHTML = `
        <div class="plan-section-title">🔥 Exclusive Offer</div>
        <div class="plan-dest-card" style="border-color:rgba(245,158,11,0.4);background:rgba(245,158,11,0.07)">
          <div style="color:var(--neon-gold);font-size:1.5rem;font-weight:900;margin-bottom:0.3rem">${plan.offer.discount}% OFF</div>
          <div class="plan-dest-name">${plan.offer.name}</div>
          <div class="plan-dest-country">${plan.offer.description || ''}</div>
          ${plan.offer.validUntil ? `<div style="margin-top:0.5rem;font-size:0.75rem;color:var(--neon-pink)">⏰ Valid until ${plan.offer.validUntil}</div>` : ''}
        </div>
      `;
      body.appendChild(offerSection);
    }
  }

  // ARIA pitch
  setText('plan-aria-pitch', plan.ariaFinalPitch || '✨ Your dream trip awaits! Book now before prices change!');

  // Budget
  const budgetSection = document.getElementById('plan-budget-section');
  if (budgetSection) {
    const stats = plan.budgetStats || calculateTripStats();
    budgetSection.innerHTML = `
      <div>
        <div class="budget-label">Estimated Total</div>
        <div class="budget-total">$${(plan.estimatedBudget || 0).toLocaleString()}</div>
        ${plan.savings > 0 ? `<div class="budget-savings">You save $${plan.savings.toLocaleString()} with your offer! 🎉</div>` : ''}
      </div>
      <div style="text-align:right">
        <div class="budget-expiry">⏰ Price valid for 48 hours</div>
        ${plan.transport ? `<div class="budget-label" style="margin-top:0.3rem">✈️ ${plan.transport.name} included</div>` : ''}
      </div>
    `;
  }

  // Book now button
  const bookBtn = document.getElementById('btn-book');
  if (bookBtn) {
    bookBtn.onclick = () => { window.location.href = BOOKING_URL; };
  }

  // Show overlay
  overlay.style.display = 'flex';

  // ARIA final message
  addAriaMessage(plan.ariaFinalPitch || '🎉 Your perfect trip plan is READY! This is going to be INCREDIBLE!');
}

/* ─── Save plan ──────────────────────────────────────────────────────── */
async function savePlan() {
  if (!LAB.lastPlan) return;
  try {
    await fetch(SAVE_PLAN_URL, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body:    JSON.stringify(LAB.lastPlan),
    });
    const btn = document.getElementById('btn-save');
    if (btn) { btn.textContent = '✅ SAVED!'; btn.disabled = true; }
    addAriaMessage("💾 Saved! Your dream trip is safely stored. Come back anytime to book it! 🌟");
  } catch (e) {
    console.error('Save error:', e);
  }
}

/* ─── Close / restart ────────────────────────────────────────────────── */
function closeLab() {
  const lab = document.getElementById('experience-lab');
  if (lab) {
    lab.style.animation = 'fade-in 0.3s ease reverse';
    setTimeout(() => { window.history.back(); }, 300);
  }
}

function restartLab() {
  LAB.currentStep        = 1;
  LAB.answers            = {};
  LAB.selectedInterests  = [];
  LAB.lastPlan           = null;
  LAB.lastLiveData       = null;
  LAB.cart               = { destinations: [], accommodations: [], activities: [], offers: [] };

  document.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
  document.querySelectorAll('.question-step').forEach(s => s.classList.remove('active'));
  document.getElementById('step-1')?.classList.add('active');
  document.getElementById('final-plan-overlay').style.display = 'none';
  document.getElementById('generate-plan-section').style.display = 'none';
  document.getElementById('aria-stats').style.display = 'none';
  document.getElementById('aria-chat-feed').innerHTML = `
    <div class="aria-message aria-intro">
      <div class="aria-bubble">Starting fresh! Let's find you the perfect trip 🌍✨</div>
      <div class="aria-timestamp">Just now</div>
    </div>`;

  updateProgress();
  updateInterestHint();
  updatePlannerUI();
  renderDestinationRadar({ destinations: [], destinationAdvice: 'ARIA will give destination advice here as your choices update.' });
}

/* ─── Homepage floating section opener ──────────────────────────────── */
function openExperienceLab() {
  window.location.href = typeof LAB_URL !== 'undefined' ? LAB_URL : '/experience-lab/';
}

/* ─── Utility ────────────────────────────────────────────────────────── */
/* ─── Simulation ─────────────────────────────────────────────────────── */
async function openSimulation() {
    if (!LAB.lastPlan && LAB.cart.destinations.length === 0) return;
    
    const overlay = document.getElementById('simulation-overlay');
    const narrative = document.getElementById('simulation-narrative');
    const list = document.getElementById('simulation-list');
    const budget = document.getElementById('simulation-budget-details');

    if (!overlay || !narrative) return;

    overlay.style.display = 'flex';
    narrative.innerHTML = '<div class="typing-dots"><span></span><span></span><span></span></div><p>ARIA is deep-diving into your journey simulation... hold on!</p>';
    
    // Populate list
    list.innerHTML = '';
    const allItems = [...LAB.cart.destinations, ...LAB.cart.accommodations, ...LAB.cart.activities];
    allItems.forEach(item => {
        const div = document.createElement('div');
        div.style.color = 'white';
        div.innerHTML = `• ${item.name}`;
        list.appendChild(div);
    });

    // Populate budget
    const stats = calculateTripStats();
    budget.innerHTML = `
        <div style="color:var(--neon-gold)">Estimated Total: ${formatMoney(stats.total)}</div>
        <div style="font-size:0.9rem; color:var(--text-muted); margin-top:0.5rem;">
            ${stats.days} days, ${stats.travelers} traveler(s), ${formatMoney(stats.perPerson)} per person
        </div>
        <div style="font-size:0.85rem; color:var(--neon-green); margin-top:0.4rem;">Savings: ${formatMoney(stats.savings)}</div>
    `;

    try {
        const res = await fetch(SIMULATE_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ destination: LAB.cart.destinations[0], accommodations: LAB.cart.accommodations, activities: LAB.cart.activities, offers: LAB.cart.offers, stats })
        });
        const data = await res.json();
        
        // Format narrative with paragraphs
        const formatted = data.narrative.replace(/\n/g, '<br>');
        narrative.innerHTML = `<div style="animation: fade-in 1s ease;">${formatted}</div>`;
    } catch (e) {
        narrative.innerHTML = "✨ Your journey simulation is ready! The magic is in the air. This trip will be legendary.";
    }
}

function closeSimulation() {
    const overlay = document.getElementById('simulation-overlay');
    if (overlay) overlay.style.display = 'none';
}

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}

// Add event listener for simulation button
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('open-simulation-btn');
    if (btn) btn.onclick = openSimulation;
});
