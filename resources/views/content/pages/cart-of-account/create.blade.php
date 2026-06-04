@php $configData = Helper::appClasses(); @endphp
@extends('layouts/layoutMaster')
@section('title', 'Add - Chart of Account')

@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-4" role="alert">
      <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card mb-6">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add Chart of Account</h5>
      <a href="{{ route('chart-of-accounts.index') }}" class="btn btn-sm btn-label-secondary">
        <i class="bx bx-list-ul me-1"></i> View List
      </a>
    </div>
    <form class="card-body" action="{{ route('chart-of-accounts.store') }}" method="POST">
      @csrf
      <div class="row g-6">

        {{-- Account Code --}}
        <div class="col-md-4">
          <label class="form-label">Account Code</label>
          <input type="text" class="form-control bg-light" value="{{ $previewCode }}" readonly />
          <small class="text-muted">Auto-generated on save</small>
        </div>

        {{-- Account Name --}}
        <div class="col-md-4">
          <label class="form-label" for="account-name">Account Name</label>
          <input type="text" id="account-name" name="account_name"
            class="form-control @error('account_name') is-invalid @enderror" placeholder="e.g. Cash in Hand"
            value="{{ old('account_name') }}" />
          @error('account_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Account Type --}}
        <div class="col-md-4">
          <label class="form-label" for="account-type">Account Type</label>
          <select id="account-type" name="account_type"
            class="select2 form-select @error('account_type') is-invalid @enderror" data-allow-clear="true">
            <option value="">Select</option>
            <option value="assets" {{ old('account_type') == 'assets' ? 'selected' : '' }}>Assets</option>
            <option value="liability" {{ old('account_type') == 'liability' ? 'selected' : '' }}>Liability</option>
            <option value="equity" {{ old('account_type') == 'equity' ? 'selected' : '' }}>Equity</option>
            <option value="revenue" {{ old('account_type') == 'revenue' ? 'selected' : '' }}>Revenue</option>
            <option value="expense" {{ old('account_type') == 'expense' ? 'selected' : '' }}>Expense</option>
          </select>
          @error('account_type')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Nature Account --}}
        <div class="col-md-4">
          <label class="form-label" for="nature-account">Nature Account (Balance Type)</label>
          <select id="nature-account" name="nature_account"
            class="select2 form-select @error('nature_account') is-invalid @enderror" data-allow-clear="true">
            <option value="">Select</option>
            <option value="debit" {{ old('nature_account') == 'debit' ? 'selected' : '' }}>Debit</option>
            <option value="credit" {{ old('nature_account') == 'credit' ? 'selected' : '' }}>Credit</option>
          </select>
          @error('nature_account')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Parent Account --}}
        <div class="col-md-4">
          <label class="form-label" for="parent-id">Parent Account</label>
          <select id="parent-id" name="parent_id" class="select2 form-select" data-allow-clear="true">
            <option value="">--Select-- (Optional)</option>
            @foreach ($parentAccounts as $parent)
              <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                [{{ $parent->account_code }}] {{ $parent->account_name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Financial Date --}}
        <div class="col-md-4">
          <label class="form-label" for="financial-date">Financial Date</label>
          <input type="month" id="financial-date" name="financial_date"
            class="form-control @error('financial_date') is-invalid @enderror" value="{{ old('financial_date') }}" />
          @error('financial_date')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Opening Account Date --}}
        <div class="col-md-4">
          <label class="form-label" for="opening-date">Opening Account Date</label>
          <input type="date" id="opening-date" name="opening_account_date"
            class="form-control @error('opening_account_date') is-invalid @enderror"
            value="{{ old('opening_account_date') }}" />
          @error('opening_account_date')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

      </div>{{-- end row --}}

      <div class="pt-6">
        <button type="submit" class="btn btn-primary me-4">
          <i class="bx bx-save me-1"></i> Save Account
        </button>
        <a href="{{ route('chart-of-accounts.index') }}" class="btn btn-label-secondary">
          Cancel
        </a>
      </div>

    </form>
  </div>

@endsection
