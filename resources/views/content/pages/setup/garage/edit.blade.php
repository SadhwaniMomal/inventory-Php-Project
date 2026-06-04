@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Garage - Setup')

@section('content')

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Edit Garage</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.garage.update', $garage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="length">Length</label>
            <input type="text" id="length" name="length" class="form-control"
              value="{{ old('length', $garage->length) }}" required />
          </div>

          <div class="col-md-6">
            <label class="form-label" for="is_default">Unit</label>
            <select id="is_default" name="is_default" class="form-control" required>
              <option value="mm" {{ old('is_default', $garage->is_default) == 'mm' ? 'selected' : '' }}>mm</option>
            </select>
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Update</button>
          <a href="{{ route('setup.garage.index') }}" class="btn btn-label-secondary">Cancel</a>
        </div>

      </form>
    </div>
  </div>

@endsection
