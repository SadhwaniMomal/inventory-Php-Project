@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Edit City - Finance')

@section('content')

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Edit City</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('setup.city.update', $city->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

          <div class="col-md-6">
            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
            <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror"
              value="{{ old('city', $city->city) }}" required />
            @error('city')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
            <input type="text" id="country" name="country"
              class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $city->country) }}"
              required />
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Update</button>
          <a href="{{ route('setup.city.index') }}" class="btn btn-label-secondary">Cancel</a>
        </div>

      </form>
    </div>
  </div>

@endsection
