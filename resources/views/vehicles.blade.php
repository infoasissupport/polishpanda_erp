@extends('layouts.app')

@section('title', 'Vehicles')

@section('page-id', 'vehicles')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">
@endsection

@section('content')
<section class="view" id="vehicles">
  <div class="view-header">
    <div class="view-title">Vehicles</div>
    <button class="btn" id="vehExportBtn"><i class="ti ti-download"></i>Export</button>
  </div>
  <div class="table-wrap">
    <div class="toolbar">
      <input id="vehSearchInput" aria-label="Search vehicle number" placeholder="Search vehicle number" autocomplete="off">
      <div class="chip active" data-filter="all">All types</div>
      <div class="chip" data-filter="hatchback">HATCHBACK</div>
      <div class="chip" data-filter="sedan">SEDAN/COMPACT SUV</div>
      <div class="chip" data-filter="suv">SUV/XL SEDAN/LUXURY</div>
      <div class="chip" data-filter="scooter">SCOOTER</div>
      <div class="chip" data-filter="bike">BIKE</div>
      <div class="chip" data-filter="bullet">BULLET/PREMIUM BIKE</div>
    </div>
    <div class="table-scroll">
      <table>
        <thead><tr><th class="col-sl">#</th><th>Number</th><th>Brand / model</th><th>Owner</th><th>Colour</th><th>Type</th><th>Fuel</th><th>Last wash</th><th>Next recommended</th><th></th></tr></thead>
        <tbody id="vehTableBody"></tbody>
      </table>
      <div class="dropdown-empty" id="vehEmptyState" style="display:none;">No vehicles match your search.</div>
    </div>
    <div class="table-pagination">
      <span id="vehPageInfo"></span>
      <div class="pagination-btns">
        <button type="button" class="btn" id="vehPrevBtn"><i class="ti ti-chevron-down" style="transform:rotate(90deg);display:inline-block;"></i>Prev</button>
        <button type="button" class="btn" id="vehNextBtn">Next<i class="ti ti-chevron-down" style="transform:rotate(-90deg);display:inline-block;"></i></button>
      </div>
    </div>
  </div>
</section>

<div class="modal-overlay" id="editVehicleModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Vehicle</div>
      <button class="icon-btn" onclick="window.SW.closeModal('editVehicleModal')" aria-label="Close modal"><i class="ti ti-x"></i></button>
    </div>
    <form id="editVehicleForm">
      <div class="modal-body">
        <div class="modal-row">
          <div class="field"><label for="evPlate">Vehicle Number</label><input type="text" id="evPlate" readonly style="background:var(--bg-2);cursor:not-allowed;"></div>
          <div class="field"><label for="evBrand">Brand / Model</label><input type="text" id="evBrand" required placeholder="e.g. Honda City"></div>
        </div>
        <div class="modal-row">
          <div class="field"><label for="evColour">Colour</label><input type="text" id="evColour" required placeholder="e.g. White"></div>
          <div class="field"><label for="evFuel">Fuel</label>
            <select id="evFuel">
              <option value="Petrol">Petrol</option>
              <option value="Diesel">Diesel</option>
              <option value="EV">EV</option>
              <option value="Hybrid">Hybrid</option>
            </select>
          </div>
        </div>
        <div class="field"><label for="evType">Vehicle Type</label>
          <select id="evType">
            <option value="hatchback">HATCHBACK</option>
            <option value="sedan">SEDAN/COMPACT SUV</option>
            <option value="suv">SUV/XL SEDAN/LUXURY</option>
            <option value="scooter">SCOOTER</option>
            <option value="bike">BIKE</option>
            <option value="bullet">BULLET/PREMIUM BIKE</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" onclick="window.SW.closeModal('editVehicleModal')">Cancel</button>
        <button type="submit" class="btn btn-accent" id="saveVehicleBtn"><i class="ti ti-check"></i>Save changes</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('js/vehicles.js') }}?v={{ filemtime(public_path('js/vehicles.js')) }}"></script>
@endsection
