/**
 * APR GROUP OF COMPANY - Smart Plot Price Calculator
 * Centralised rates & verified business logic
 */

const APR_PROJECTS = [
  {
    id: 'rajpura-phase-1',
    name: 'Rajpura Phase 1',
    location: 'Siddhi Vinayak Colony, Rajpura, Bhadohi',
    rate: 2500,
    url: 'rajpura-phase-1.html',
    image: 'assets/images/projects/rajpura-1.jpg'
  },
  {
    id: 'ugapur',
    name: 'Ugapur, Bhadohi',
    location: 'Ugapur, Bhadohi, UP',
    rate: 1300,
    url: 'ugapur.html',
    image: 'assets/images/projects/ugapur-1.jpg'
  },
  {
    id: 'kanshraipur',
    name: 'Kanshraipur',
    location: 'Kanshraipur, Bhadohi, UP',
    rate: 2300,
    url: 'kanshraipur.html',
    image: 'assets/images/projects/kanshraipur-1.jpg'
  },
  {
    id: 'chauri-bazar',
    name: 'Chauri Bazar',
    location: 'Chauri Bazar, Bhadohi, UP',
    rate: 1300,
    url: 'chauri-bazar.html',
    image: 'assets/images/projects/chauri-1.jpg'
  },
  {
    id: 'gosai-bazar',
    name: 'Gosai Bazar, Gyanpur',
    location: 'Gosai Bazar, Gyanpur, UP',
    rate: 1000,
    url: 'gosai-bazar.html',
    image: 'assets/images/projects/gosai-1.jpg'
  },
  {
    id: 'parjapatpur',
    name: 'Parjapatpur, Bhadohi',
    location: 'Parjapatpur, Bhadohi, UP',
    rate: 1200,
    url: 'parjapatpur.html',
    image: 'assets/images/projects/parjapatpur-1.jpg'
  }
];

const STANDARD_PLOT_SIZES = [500, 600, 800, 1000, 1200, 1500, 1800, 2000, 2400, 3000];

const BUDGET_OPTIONS = [
  { value: 300000, label: '₹3 Lakh' },
  { value: 500000, label: '₹5 Lakh' },
  { value: 700000, label: '₹7 Lakh' },
  { value: 1000000, label: '₹10 Lakh' },
  { value: 1500000, label: '₹15 Lakh' },
  { value: 2000000, label: '₹20 Lakh' },
  { value: 3000000, label: '₹30 Lakh' },
  { value: 5000000, label: '₹50 Lakh' }
];

function formatINR(amount) {
  if (isNaN(amount)) return '₹0';
  return '₹' + Math.round(amount).toLocaleString('en-IN');
}

function initCalculator() {
  const locSelect = document.getElementById('calc-location');
  const sizeSelect = document.getElementById('calc-size');
  const budgetSelect = document.getElementById('calc-budget-1');
  const budgetOnlySelect = document.getElementById('calc-budget-2');
  
  if (locSelect) {
    locSelect.innerHTML = '<option value="">-- Choose Project Location --</option>';
    APR_PROJECTS.forEach((p, idx) => {
      const opt = document.createElement('option');
      opt.value = idx;
      opt.textContent = `${p.name} (₹${p.rate.toLocaleString('en-IN')}/Sq. Ft.)`;
      locSelect.appendChild(opt);
    });
  }

  if (sizeSelect) {
    sizeSelect.innerHTML = '<option value="">-- Choose Plot Size --</option>';
    STANDARD_PLOT_SIZES.forEach(s => {
      const opt = document.createElement('option');
      opt.value = s;
      opt.textContent = `${s.toLocaleString('en-IN')} Sq. Ft.`;
      sizeSelect.appendChild(opt);
    });
  }

  if (budgetSelect) {
    budgetSelect.innerHTML = '<option value="">-- Select Your Budget --</option>';
    BUDGET_OPTIONS.forEach(b => {
      const opt = document.createElement('option');
      opt.value = b.value;
      opt.textContent = `Up to ${b.label}`;
      budgetSelect.appendChild(opt);
    });
  }

  if (budgetOnlySelect) {
    budgetOnlySelect.innerHTML = '<option value="">-- Select Your Total Budget --</option>';
    BUDGET_OPTIONS.forEach(b => {
      const opt = document.createElement('option');
      opt.value = b.value;
      opt.textContent = b.label;
      budgetOnlySelect.appendChild(opt);
    });
  }

  // Tabs toggle
  const tabBtns = document.querySelectorAll('.calc-tab');
  const modeLoc = document.getElementById('mode-location');
  const modeBud = document.getElementById('mode-budget');
  const resBox = document.getElementById('calc-result');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const mode = btn.getAttribute('data-mode');
      if (mode === 'location') {
        if (modeLoc) modeLoc.style.display = 'block';
        if (modeBud) modeBud.style.display = 'none';
      } else {
        if (modeLoc) modeLoc.style.display = 'none';
        if (modeBud) modeBud.style.display = 'block';
      }
      if (resBox) resBox.style.display = 'none';
    });
  });

  // Calculate Mode 1: Location & Size
  const btnCalcLoc = document.getElementById('btn-calc-location');
  if (btnCalcLoc) {
    btnCalcLoc.addEventListener('click', () => {
      const projIdx = locSelect.value;
      const sizeVal = parseFloat(sizeSelect.value);
      const budgetVal = parseFloat(budgetSelect.value);

      if (projIdx === '' || isNaN(sizeVal) || isNaN(budgetVal)) {
        alert('Please select project location, plot size, and your budget to calculate.');
        return;
      }

      const proj = APR_PROJECTS[projIdx];
      const totalPrice = sizeVal * proj.rate;
      const isWithinBudget = totalPrice <= budgetVal;
      const diff = Math.abs(totalPrice - budgetVal);

      let budgetMsgHtml = '';
      if (isWithinBudget) {
        budgetMsgHtml = `
          <div class="calc-budget-status within">
            <strong>✓ Within Your Budget:</strong> This estimated plot price is comfortably within your selected budget limit of ${formatINR(budgetVal)}.
          </div>
        `;
      } else {
        budgetMsgHtml = `
          <div class="calc-budget-status above">
            <strong>Notice:</strong> This plot exceeds your selected budget by ${formatINR(diff)}. You can consider choosing a smaller plot size or exploring projects with different per-sq-ft rates.
          </div>
        `;
      }

      const waMsg = encodeURIComponent(
        `Hello APR Group, I calculated an estimate for ${proj.name}.\nPlot Area: ${sizeVal} Sq. Ft.\nRate: ₹${proj.rate}/Sq. Ft.\nEstimated Price: ${formatINR(totalPrice)}.\nPlease share availability and booking details.`
      );

      resBox.innerHTML = `
        <h3>Your Estimated Plot Price</h3>
        <div class="calc-res-grid">
          <div class="calc-res-card">
            <small>Selected Project</small>
            <strong>${proj.name}</strong>
          </div>
          <div class="calc-res-card">
            <small>Plot Area</small>
            <strong>${sizeVal.toLocaleString('en-IN')} Sq. Ft.</strong>
          </div>
          <div class="calc-res-card">
            <small>Listed Rate</small>
            <strong>₹${proj.rate.toLocaleString('en-IN')} / Sq. Ft.</strong>
          </div>
          <div class="calc-res-card">
            <small>Total Estimated Price</small>
            <strong class="green">${formatINR(totalPrice)}</strong>
          </div>
        </div>
        ${budgetMsgHtml}
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:18px;">
          <a class="btn btn-green" target="_blank" rel="noopener" href="https://wa.me/916392199296?text=${waMsg}">
            Enquire on WhatsApp
          </a>
          <a class="btn btn-blue" href="${proj.url}">
            View ${proj.name} Details →
          </a>
          <a class="btn btn-outline-navy" href="tel:+916392199296">
            Call Office: +91 63921 99296
          </a>
        </div>
        <p class="calc-disclaimer">
          <strong>Important Disclaimer:</strong> All prices and estimates shown are indicative based on the listed rate per square foot. Final price, boundary confirmation, registration, documentation and any applicable additional charges must be verified directly with APR GROUP OF COMPANY.
        </p>
      `;
      resBox.style.display = 'block';
      resBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  }

  // Calculate Mode 2: Budget
  const btnCalcBud = document.getElementById('btn-calc-budget');
  if (btnCalcBud) {
    btnCalcBud.addEventListener('click', () => {
      const budgetVal = parseFloat(budgetOnlySelect.value);
      if (isNaN(budgetVal) || budgetVal <= 0) {
        alert('Please choose your total budget.');
        return;
      }

      let cardsHtml = '';
      APR_PROJECTS.forEach(p => {
        const estArea = (budgetVal / p.rate).toFixed(1);
        const waMsg = encodeURIComponent(
          `Hello APR Group, with a budget of ${formatINR(budgetVal)}, I am interested in ${p.name} (Estimated Area: ~${estArea} Sq. Ft. @ ₹${p.rate}/Sq. Ft.). Please share availability.`
        );

        cardsHtml += `
          <div class="budget-project-item">
            <h4>${p.name}</h4>
            <span class="rate">Rate: ₹${p.rate.toLocaleString('en-IN')} / Sq. Ft.</span>
            <div class="area">~${parseFloat(estArea).toLocaleString('en-IN')} Sq. Ft.</div>
            <small>Estimated Land Area</small>
            <div style="margin-top:auto;display:flex;gap:8px;flex-direction:column;">
              <a href="${p.url}" class="btn btn-outline-blue btn-sm">View Details</a>
              <a href="https://wa.me/916392199296?text=${waMsg}" target="_blank" rel="noopener" class="btn btn-green btn-sm">WhatsApp Enquiry</a>
            </div>
          </div>
        `;
      });

      resBox.innerHTML = `
        <h3>Estimated Land Area Across All Projects for ${formatINR(budgetVal)}</h3>
        <p style="font-size:0.9rem;margin-bottom:18px;">
          Calculated using: <em>Estimated Area = Total Budget ÷ Rate per Square Foot</em>
        </p>
        <div class="calc-budget-results-grid">
          ${cardsHtml}
        </div>
        <p class="calc-disclaimer" style="margin-top:20px;">
          <strong>Important Disclaimer:</strong> All prices and estimates shown are indicative based on the listed rate per square foot. Final price, boundary confirmation, registration, documentation and any applicable additional charges must be verified directly with APR GROUP OF COMPANY.
        </p>
      `;
      resBox.style.display = 'block';
      resBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  }
}

// Single Project Page Live Calculator
function initSingleProjectCalculator(ratePerSqFt, projectName) {
  const sizeInput = document.getElementById('single-calc-size');
  const calcBtn = document.getElementById('btn-single-calc');
  const resDiv = document.getElementById('single-calc-result');

  if (!calcBtn || !sizeInput || !resDiv) return;

  function doCalc() {
    const size = parseFloat(sizeInput.value);
    if (isNaN(size) || size <= 0) {
      alert('Please enter a valid plot area in square feet.');
      return;
    }
    const total = size * ratePerSqFt;
    const waMsg = encodeURIComponent(
      `Hello APR Group, I calculated an estimate for ${projectName}.\nPlot Area: ${size} Sq. Ft.\nRate: ₹${ratePerSqFt}/Sq. Ft.\nEstimated Price: ${formatINR(total)}.\nPlease share availability.`
    );

    resDiv.innerHTML = `
      <div style="background:var(--brand-green-light);border:1px solid rgba(21,149,104,0.3);border-radius:var(--radius-sm);padding:16px;margin-top:14px;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
          <div>
            <small style="display:block;color:var(--brand-navy);font-weight:700;text-transform:uppercase;font-size:0.75rem;">Estimated Total Price (${size} Sq. Ft.)</small>
            <div style="font-size:1.6rem;font-weight:800;color:var(--brand-green);">${formatINR(total)}</div>
          </div>
          <a class="btn btn-green btn-sm" target="_blank" rel="noopener" href="https://wa.me/916392199296?text=${waMsg}">
            Enquire on WhatsApp
          </a>
        </div>
      </div>
    `;
    resDiv.style.display = 'block';
  }

  calcBtn.addEventListener('click', doCalc);
  sizeInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      doCalc();
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('calc-location')) {
    initCalculator();
  }
});
