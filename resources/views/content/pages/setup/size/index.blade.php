@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Size - Setup')

@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="ri-checkbox-circle-line me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card mb-6">
    <div class="card-header">
      <h5 class="mb-0">Add New Size</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.size.store') }}" method="POST">
        @csrf

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="height">Height</label>
            <input type="text" id="height" name="height" class="form-control" placeholder="e.g. 1040"
              value="{{ old('height') }}" required />
          </div>

          <div class="col-md-6">
            <label class="form-label" for="width">Width</label>
            <input type="text" id="width" name="width" class="form-control" placeholder="e.g. 80"
              value="{{ old('width') }}" required />
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
      <h5 class="mb-0">Size List</h5>
      <span class="badge bg-label-primary">{{ $sizes->count() }} Records</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">

          <thead class="table-light">
            <tr>
              <th style="width:60px">#</th>
              <th>Label</th>
              <th>Height</th>
              <th>Width</th>
              <th class="text-center" style="width:300px">Actions</th>
            </tr>
          </thead>

          <tbody>
            @forelse($sizes as $size)
              <tr>
                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                <td><strong>{{ $size->label }}</strong></td>
                <td>{{ $size->height ?? '—' }}</td>
                <td>{{ $size->width ?? '—' }}</td>
                <td class="text-center">

                  <a href="{{ route('setup.size.edit', $size->id) }}" class="btn btn-sm btn-warning">
                    <i class="ri-edit-line"></i> Edit
                  </a>

                </td>
              </tr>

            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-5">
                  No sizes found. Add one using the form above.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>
    </div>
  </div>

@endsection
