@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'payment Voucher - Finance')

@section('content')
  <div class="card mb-6">
    <h5 class="card-header">Post Dated Cheque </h5>

    <form class="card-body">


      <div class="row g-6">

        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Issue Date</label>
          <input type="Date" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Clearance Date</label>
          <input type="Date" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>


        <div class="col-md-4">
          <label class="form-label" for="multicol-country">Type</label>
          <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
            <option value="">Select</option>
            <option value="Australia">Assets</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-country">Status</label>
          <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
            <option value="">Select</option>
            <option value="Australia">Assets</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-country">Contact</label>
          <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
            <option value="">Select</option>
            <option value="Australia">Assets</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-country">Bank</label>
          <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
            <option value="">Select</option>
            <option value="Australia">Assets</option>
          </select>
        </div>


        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Amount</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Cheque No</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>


        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Narration</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>



















      </div>
      <div class="pt-6">
        <button type="submit" class="btn btn-primary me-4">Submit</button>
        <button type="reset" class="btn btn-label-secondary">Cancel</button>
      </div>
    </form>


  </div>
@endsection
