@php $configData = Helper::appClasses(); @endphp
@extends('layouts/layoutMaster')

@section('title', 'Inventory - Stock')

@section('content')

  {{-- Success Message --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-4">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- ADD INVENTORY FORM --}}
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Add Inventory</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('stock.inventory.store') }}">
        @csrf
        <div class="row g-3">

          {{-- Product Dropdown --}}
          <div class="col-md-4">
            <label>Product <span class="text-danger">*</span></label>
            <select name="coa_id" class="form-select @error('coa_id') is-invalid @enderror">
              <option value="">Select Product</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('coa_id') == $product->id ? 'selected' : '' }}>
                  {{ $product->account_name }}
                </option>
              @endforeach
            </select>
            @error('coa_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Product Name --}}
          <div class="col-md-4">
            <label>Product Name <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror"
              placeholder="Enter product name" value="{{ old('product_name') }}">
            @error('product_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Size Dropdown --}}
          <div class="col-md-4">
            <label>Size <span class="text-danger">*</span></label>
            <select name="size_id" class="form-select @error('size_id') is-invalid @enderror">
              <option value="">Select Size</option>
              @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                  {{ $size->label }}
                </option>
              @endforeach
            </select>
            @error('size_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Garage Dropdown --}}
          <div class="col-md-4">
            <label>Garage <span class="text-danger">*</span></label>
            <select name="garage_id" class="form-select @error('garage_id') is-invalid @enderror">
              <option value="">Select Garage</option>
              @foreach ($garages as $garage)
                <option value="{{ $garage->id }}" {{ old('garage_id') == $garage->id ? 'selected' : '' }}>
                  {{ $garage->label }}
                </option>
              @endforeach
            </select>
            @error('garage_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Opening Quantity --}}
          <div class="col-md-4">
            <label>Opening Quantity</label>
            <input type="number" name="opening_quantity" class="form-control" placeholder="0" step="0.01"
              min="0" value="{{ old('opening_quantity', 0) }}">
          </div>

          {{-- Opening Amount --}}
          <div class="col-md-4">
            <label>Opening Amount</label>
            <input type="number" name="opening_amount" class="form-control" placeholder="0.00" step="0.01"
              min="0" value="{{ old('opening_amount', 0) }}">
          </div>

          {{-- Opening Date --}}
          <div class="col-md-4">
            <label>Opening Date</label>
            <input type="date" name="opening_date" class="form-control" value="{{ old('opening_date') }}">
          </div>

        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Save Inventory</button>
          <button type="reset" class="btn btn-secondary ms-2">Cancel</button>
        </div>

      </form>
    </div>
  </div>

  {{-- INVENTORY TABLE --}}
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Inventory List</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Product</th>
              <th>Product Name</th>
              <th>Size</th>
              <th>Garage</th>
              <th>Opening Qty</th>
              <th>Opening Amount</th>
              <th>Opening Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($inventories as $index => $inventory)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inventory->account_code }}</td>
                <td>{{ $inventory->product?->account_name ?? '—' }}</td>
                <td>{{ $inventory->product_name ?? '—' }}</td>
                <td>{{ $inventory->size?->label ?? '—' }}</td>
                <td>{{ $inventory->garage?->label ?? '—' }}</td>
                <td>{{ $inventory->opening_quantity ?? 0 }}</td>
                <td>{{ number_format($inventory->opening_amount ?? 0, 2) }}</td>
                <td>{{ $inventory->opening_date ?? '—' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">No inventory found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
