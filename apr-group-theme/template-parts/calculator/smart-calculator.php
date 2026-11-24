<?php
/**
 * Smart Plot Price Calculator Component
 */
?>
<div class="calc-container text-left">
  <div class="calc-tabs">
    <button class="calc-tab active" data-mode="location">Search by Location</button>
    <button class="calc-tab" data-mode="budget">Search by Budget</button>
  </div>

  <!-- Mode 1: Search by Location -->
  <div id="mode-location">
    <div class="calc-form-grid">
      <div class="form-group">
        <label class="form-label" for="calc-location">Select Project Location</label>
        <select id="calc-location" class="form-control">
          <option value="">Loading projects...</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label" for="calc-size">Select Plot Size (Sq. Ft.)</label>
        <select id="calc-size" class="form-control">
          <option value="">Loading sizes...</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label" for="calc-budget-1">Your Target Budget</label>
        <select id="calc-budget-1" class="form-control">
          <option value="">Loading budgets...</option>
        </select>
      </div>
    </div>
    <div class="text-center">
      <button id="btn-calc-location" class="btn btn-blue btn-lg">Calculate Estimated Plot Price</button>
    </div>
  </div>

  <!-- Mode 2: Search by Budget -->
  <div id="mode-budget" style="display:none;">
    <div class="form-group" style="max-width:500px;margin:0 auto 20px;">
      <label class="form-label" for="calc-budget-2">Select Your Total Investment Budget</label>
      <select id="calc-budget-2" class="form-control">
        <option value="">Loading budgets...</option>
      </select>
    </div>
    <div class="text-center">
      <button id="btn-calc-budget" class="btn btn-blue btn-lg">Calculate Land Area Across All 6 Projects</button>
    </div>
  </div>

  <!-- Dynamic Results -->
  <div id="calc-result" class="calc-result-box"></div>
</div>
