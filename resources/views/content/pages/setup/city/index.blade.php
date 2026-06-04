@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Payment Vouncher - Finance')

@section('content')

  {{-- SUCCESS ALERT --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="ri-checkbox-circle-line me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif


  {{-- CREATE FORM --}}
  <div class="card mb-6">
    <div class="card-header">
      <h5 class="mb-0">Add New City</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.city.store') }}" method="POST">
        @csrf

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
            <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror"
              placeholder="e.g. Karachi" value="{{ old('city') }}" />
            @error('city')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
            <input type="text" id="country" name="country"
              class="form-control @error('country') is-invalid @enderror" placeholder="e.g. Pakistan"
              value="{{ old('country') }}" />
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>

      </form>
    </div>
  </div>


  {{-- DATA TABLE --}}
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">City List</h5>
      <span class="badge bg-label-primary">{{ $cities->count() }} Records</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">

          <thead class="table-light">
            <tr>
              <th style="width:60px">#</th>
              <th>City</th>
              <th>Country</th>
              <th class="text-center" style="width:300px">Actions</th>
            </tr>
          </thead>

          <tbody>
            @forelse($cities as $city)
              <tr>
                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                <td><strong>{{ $city->city }}</strong></td>
                <td>{{ $city->country }}</td>
                <td class="text-center">

                  <a href="{{ route('setup.city.edit', $city->id) }}" class="btn btn-sm btn-warning me-1">
                    <i class="ri-edit-line"></i> Edit
                  </a>

                  <form action="{{ route('setup.city.destroy', $city->id) }}" method="POST" style="display:inline"
                    onsubmit="return confirm('Delete this city?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="ri-delete-bin-line">Delete</i>
                    </button>
                  </form>

                </td>
              </tr>

            @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-5">
                  No cities found. Add one using the form above.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>
    </div>
  </div>

@endsection
