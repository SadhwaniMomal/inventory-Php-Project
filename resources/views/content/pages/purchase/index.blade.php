@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'payment Voucher - Finance')

@section('content')
  <div class="card mb-6">
    <h5 class="card-header">Purchase </h5>

    <form class="card-body" id="purchaseForm">

  <div class="row g-3">
    <div class="col-md-2">
      <label class="form-label">Ganerative #</label>
      <input type="text" class="form-control" readonly value="AUTO123" />
    </div>
    <div class="col-md-2">
      <label class="form-label">Invoice #</label>
      <input type="text" class="form-control" placeholder="Enter invoice #" />
    </div>
    <div class="col-md-2">
      <label class="form-label">Date</label>
      <input type="date" class="form-control" />
    </div>
    <div class="col-md-3">
      <label class="form-label">Supplier</label>
      <select class="form-select">
        <option value="">Select</option>
        <option value="1">ABC Traders</option>
      </select>
    </div>
    
  </div>

  <hr />

  <!-- Item Rows -->
  <div id="itemRows">
    <div class="row g-3 mt-1 align-items-end item-row">
      <div class="col-md-3">
        <label class="form-label">Item</label>
        <select class="form-select" name="item[]">
          <option value="">Select</option>
          <option value="1">Plywood Sheet</option>
        </select>
      </div>
      <div class="col-md-1">
        <label class="form-label">Size</label>
        <input type="text" name="size[]" class="form-control" placeholder="4x8" />
      </div>
      <div class="col-md-1">
        <label class="form-label">Sheets</label>
        <input type="number" name="sheets[]" class="form-control" />
      </div>
      <div class="col-md-1">
        <label class="form-label">Sqft</label>
        <input type="number" name="sqft[]" class="form-control" />
      </div>
      <div class="col-md-1">
        <label class="form-label">Rate/Sqft</label>
        <input type="number" name="rate_sqft[]" class="form-control" />
      </div>
      <div class="col-md-2">
        <label class="form-label">Damage Size</label>
        <input type="number" name="rate_sqft[]" class="form-control" />
      </div>
      <div class="col-md-2">
        <label class="form-label">Damage Rate</label>
        <input type="number" name="rate_sqft[]" class="form-control" />
      </div>
      <div class="col-md-1 d-flex">
        <button style="padding: 9px" type="button" class="btn btn-primary btn-sm addRow w-100">Add</button>
      </div>
    </div>
  </div>

   <hr />

     <div class="row g-3">
    <div class="col-md-2">
      <label class="form-label">Machine Design</label>
      <input type="number" class="form-control"   placeholder="123"/>
    </div>
    <div class="col-md-2">
      <label class="form-label">Design Amount </label>
      <input type="number" class="form-control"   placeholder="123"/>
    </div>
    <div class="col-md-2">
      <label class="form-label">Transport Amount</label>
      <input type="number" class="form-control"   placeholder="123"/>
    </div>
    <div class="col-md-2">
      <label class="form-label">Other Amount</label>
      <input type="number" class="form-control"   placeholder="123"/>
    </div>
    <div class="col-md-2">
      <label class="form-label">Grand Total</label>
      <input type="number" class="form-control" placeholder="123" />
    </div>
    
    
  </div>
   
   <div class="pt-6">
        <button type="submit" class="btn btn-primary me-4">Submit</button>
        <button type="reset" class="btn btn-label-secondary">Cancel</button>
      </div>
</form>


  </div>



@endsection


@section('page-script')
  <script>
document.addEventListener('DOMContentLoaded', function() {
  // Add new row
  $(document).on('click', '.addRow', function() {
    let row = $(this).closest('.item-row').clone(); // clone current row
    row.find('input, select').val(''); // clear values
    row.find('.addRow')
        .removeClass('btn-primary addRow')
        .addClass('btn-danger removeRow')
        .text('Remove'); // change button

    $('#itemRows').append(row);
  });

  // Remove row
  $(document).on('click', '.removeRow', function() {
    $(this).closest('.item-row').remove();
  });
  });
</script>
@endsection
