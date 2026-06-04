@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Garage - Setup')

@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="ri-checkbox-circle-line me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card mb-6">
    <div class="card-header">
      <h5 class="mb-0">Add New Garage</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.garage.store') }}" method="POST">
        @csrf

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="length">Length</label>
            <input type="text" id="length" name="length" class="form-control" placeholder="e.g. 88"
              value="{{ old('length') }}" required />
          </div>

          <div class="col-md-6">
            <label class="form-label" for="is_default">Unit</label>
            <select id="is_default" name="is_default" class="form-control" required>
              <option value="mm" selected>mm</option>
            </select>
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>

      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Garage List</h5>
      <span class="badge bg-label-primary">{{ $garages->count() }} Records</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">

          <thead class="table-light">
            <tr>
              <th style="width:60px">#</th>
              <th>Label</th>
              <th class="text-center" style="width:300px">Actions</th>
            </tr>
          </thead>

          <tbody>
            @forelse($garages as $garage)
              <tr>
                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                <td><strong>{{ $garage->label }}</strong></td>
                <td class="text-center">
                  <a href="{{ route('setup.garage.edit', $garage->id) }}" class="btn btn-sm btn-warning">
                    <i class="ri-edit-line"></i> Edit
                  </a>
                </td>
              </tr>

            @empty
              <tr>
                <td colspan="3" class="text-center text-muted py-5">
                  No garages found. Add one using the form above.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>
    </div>
  </div>

@endsection
