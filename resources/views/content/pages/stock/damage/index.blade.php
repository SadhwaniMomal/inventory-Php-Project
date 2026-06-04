@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'payment Voucher - Finance')

@section('content')

<div class="card mb-6">
    <h5 class="card-header">Inventory </h5>

    <form class="card-body">


      <div class="row g-6">

        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Code</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Product</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Size</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
        </div>









        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Quantity</label>
          <input type="text" id="multicol-username" class="form-control" placeholder="123" />
        </div>

        <div class="col-md-4">
          <label class="form-label" for="multicol-username">Date</label>
          <input type="date" id="multicol-username" class="form-control" placeholder="123" />
        </div>
        








      </div>
      <div class="pt-6">
        <button type="submit" class="btn btn-primary me-4">Submit</button>
        <button type="reset" class="btn btn-label-secondary">Cancel</button>
      </div>
    </form>


  </div>

@endsection
