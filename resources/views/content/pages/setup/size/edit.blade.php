@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Size - Setup')

@section('content')

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Edit Size</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.size.update', $size->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="height">Height</label>
            <input type="text" id="height" name="height" class="form-control"
              value="{{ old('height', $size->height) }}" required />
          </div>

          <div class="col-md-6">
            <label class="form-label" for="width">Width</label>
            <input type="text" id="width" name="width" class="form-control"
              value="{{ old('width', $size->width) }}" required />
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Update</button>
          <a href="{{ route('setup.size.index') }}" class="btn btn-label-secondary">Cancel</a>
        </div>

      </form>
    </div>
  </div>

@endsection
