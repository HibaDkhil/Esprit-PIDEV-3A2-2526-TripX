(function () {
  'use strict';

  const TOTAL_STEPS = 12;
  let currentStep = 0;

  const prefs = {
    gender: null,
    birth_year: null,
    priorities: [],
    preferred_climate: [],
    budget_min_per_night: 50,
    budget_max_per_night: 500,
    location_preferences: [],
    accommodation_types: [],
    style_preferences: [],
    dietary_restrictions: [],
    travel_pace: null,
    group_type: null,
    accessibility_needs: false
  };

  const slides = document.querySelectorAll('.ob-slide');
  const nextBtn = document.getElementById('obNext');
  const backBtn = document.getElementById('obBack');
  const progressFill = document.getElementById('progressFill');
  const dotContainer = document.getElementById('dotContainer');

  // Create Dots
  function createDots() {
    dotContainer.innerHTML = '';
    for (let i = 0; i < TOTAL_STEPS; i++) {
      const dot = document.createElement('div');
      dot.className = 'ob-dot' + (i === currentStep ? ' active' : '');
      dot.addEventListener('click', () => {
        // Option to jump to step if already visited (optional)
      });
      dotContainer.appendChild(dot);
    }
  }

  function updateSteps() {
    slides.forEach((slide, index) => {
      slide.classList.toggle('active', index === currentStep);
    });

    backBtn.style.visibility = (currentStep === 0) ? 'hidden' : 'visible';
    progressFill.style.width = `${((currentStep + 1) / TOTAL_STEPS) * 100}%`;
    
    // Update Dots
    const dots = document.querySelectorAll('.ob-dot');
    dots.forEach((dot, idx) => {
      dot.classList.toggle('active', idx === currentStep);
    });

    if (currentStep === TOTAL_STEPS - 1) {
      nextBtn.innerHTML = 'Finish <i class="fas fa-check"></i>';
    } else {
      nextBtn.innerHTML = 'Continue ➔';
    }
  }

  nextBtn.addEventListener('click', () => {
    if (currentStep < TOTAL_STEPS - 1) {
      currentStep++;
      updateSteps();
    } else {
      submitPreferences();
    }
  });

  backBtn.addEventListener('click', () => {
    if (currentStep > 0) {
      currentStep--;
      updateSteps();
    }
  });

  // Generic Card Logic (Supports Single and Multi)
  document.querySelectorAll('.option-card').forEach(card => {
    card.addEventListener('click', () => {
      const field = card.dataset.field;
      const val = card.dataset.val;
      const grid = card.closest('.option-grid');
      const group = (grid && grid.dataset.group) ? grid.dataset.group : field;
      const isMulti = grid ? (grid.dataset.multi === 'true') : false;

      console.log(`Click: group=${group}, val=${val}, isMulti=${isMulti}`);

      if (!group) return;

      if (isMulti) {
        card.classList.toggle('selected');
        
        // Max check
        const maxAllowed = grid.dataset.max ? parseInt(grid.dataset.max, 10) : 999;
        const selectedNodes = [...grid.querySelectorAll('.option-card.selected')];
        if (selectedNodes.length > maxAllowed) {
          card.classList.remove('selected'); // Undo
          alert(`You can only select up to ${maxAllowed} options for this category.`);
          return;
        }

        const selected = selectedNodes.map(c => c.dataset.val);
        prefs[group] = selected;
      } else {
        // For single choice, clear others in same group/grid
        const siblings = grid ? grid.querySelectorAll('.option-card') : document.querySelectorAll(`[data-field="${field}"]`);
        siblings.forEach(s => s.classList.remove('selected'));
        card.classList.add('selected');
        prefs[group] = val;
      }
      console.log("Current Prefs:", prefs);
    });
  });

  // Handle standard inputs (Dual sliders for budget)
  const minBudget = document.getElementById('minBudget');
  const maxBudget = document.getElementById('maxBudget');
  const minDisplay = document.getElementById('minBudgetDisplay');
  const maxDisplay = document.getElementById('maxBudgetDisplay');

  function updateBudgetDisplay() {
    if (minBudget && minDisplay) minDisplay.innerText = '$' + minBudget.value;
    if (maxBudget && maxDisplay) maxDisplay.innerText = '$' + maxBudget.value;
  }

  if (minBudget && maxBudget) {
    minBudget.addEventListener('input', () => {
      if (parseInt(minBudget.value) > parseInt(maxBudget.value)) {
          minBudget.value = maxBudget.value;
      }
      updateBudgetDisplay();
      prefs.budget_min_per_night = parseInt(minBudget.value);
    });
    maxBudget.addEventListener('input', () => {
      if (parseInt(maxBudget.value) < parseInt(minBudget.value)) {
          maxBudget.value = minBudget.value;
      }
      updateBudgetDisplay();
      prefs.budget_max_per_night = parseInt(maxBudget.value);
    });
    // Ensure display matches slider value on load
    updateBudgetDisplay();
  }

  // Step 12: Accessibility
  const accessToggle = document.getElementById('accessibilityToggle');
  if (accessToggle) {
    accessToggle.addEventListener('click', () => {
      accessToggle.classList.toggle('selected');
      prefs.accessibility_needs = accessToggle.classList.contains('selected');
    });
  }

  function submitPreferences() {
    const url = window.TRIPX ? window.TRIPX.savePrefsUrl : '/preferences/save';
    
    // Validate required fields
    if (!prefs.gender || !prefs.birth_year) {
      alert('Please select your gender and birth interval to continue.');
      currentStep = 0;
      updateSteps();
      return;
    }

    fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(prefs)
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        window.location.href = window.TRIPX ? window.TRIPX.homeUrl : '/';
      } else {
        alert('Error saving preferences: ' + (data.message || 'Unknown error'));
      }
    })
    .catch(err => {
      console.error(err);
      alert('Network error. Please verify your connection.');
    });
  }

  // Initialize
  createDots();
  updateSteps();

})();
