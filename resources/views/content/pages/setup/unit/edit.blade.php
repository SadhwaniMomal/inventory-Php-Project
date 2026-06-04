@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit Unit - Finance')

@section('content')

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Edit Unit</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.unit.update', $unit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

          <div class="col-md-4">
            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
            {{-- old('name', $unit->name) → shows old input on fail, otherwise current value --}}
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name', $unit->name) }}" required />
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-4">
            <label class="form-label" for="size">Size</label>
            <input type="text" id="size" name="size" class="form-control"
              value="{{ old('size', $unit->size) }}" />
          </div>

          <div class="col-md-4">
            <label class="form-label" for="conversion">Conversion</label>
            <input type="text" id="conversion" name="conversion" class="form-control"
              value="{{ old('conversion', $unit->conversion) }}" />
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Update</button>
          <a href="{{ route('setup.unit.index') }}" class="btn btn-label-secondary">Cancel</a>
        </div>

      </form>
    </div>
  </div>

@endsection
