@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Unit - Finance')

@section('content')

  {{-- ==================== SUCCESS ALERT ==================== --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="ri-checkbox-circle-line me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif


  {{-- ==================== CREATE FORM ==================== --}}
  <div class="card mb-6">
    <div class="card-header">
      <h5 class="mb-0">Add New Unit</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.unit.store') }}" method="POST">
        @csrf

        <div class="row g-4">

          <div class="col-md-4">
            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="e.g. Kilogram" value="{{ old('name') }}" />
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-4">
            <label class="form-label" for="size">Size</label>
            <input type="text" id="size" name="size" class="form-control" placeholder="e.g. Large"
              value="{{ old('size') }}" />
          </div>

          <div class="col-md-4">
            <label class="form-label" for="conversion">Conversion</label>
            <input type="text" id="conversion" name="conversion" class="form-control" placeholder="e.g. 1000"
              value="{{ old('conversion') }}" />
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>

      </form>
    </div>
  </div>


  {{-- ==================== DATA TABLE ==================== --}}
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Unit List</h5>
      <span class="badge bg-label-primary">{{ $units->count() }} Records</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">

          <thead class="table-light">
            <tr>
              <th style="width:60px">#</th>
              <th>Name</th>
              <th>Size</th>
              <th>Conversion</th>
              <th class="text-center" style="width:300px">Actions</th>
            </tr>
          </thead>

          <tbody>
            @forelse($units as $unit)
              <tr>
                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                <td><strong>{{ $unit->name }}</strong></td>
                <td>{{ $unit->size ?? '—' }}</td>
                <td>{{ $unit->conversion ?? '—' }}</td>
                <td class="text-center">

                  {{-- Edit: goes to edit.blade.php --}}
                  <a href="{{ route('setup.unit.edit', $unit->id) }}" class="btn btn-sm btn-warning me-1">
                    <i class="ri-edit-line"></i> Edit
                  </a>

                  {{-- Delete --}}
                  <form action="{{ route('setup.unit.destroy', $unit->id) }}" method="POST" style="display:inline"
                    onsubmit="return confirm('Delete this unit?')">
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
                <td colspan="5" class="text-center text-muted py-5">
                  No units found. Add one using the form above.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>
    </div>
  </div>

@endsection
