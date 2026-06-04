@php $configData = Helper::appClasses(); @endphp
@extends('layouts/layoutMaster')

@section('title', 'Other Accounts')

@section('content')

  {{-- Success Message --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-4">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- ═══════════════════════════════ --}}
  {{--       ADD OTHER ACCOUNT FORM    --}}
  {{-- ═══════════════════════════════ --}}
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Add Other Account</h5>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('chart-of-accounts.account.other.account.store') }}">
        @csrf

        <div class="row g-3">

          {{-- Account Dropdown --}}
          <div class="col-md-4">
            <label>Account Name <span class="text-danger">*</span></label>
            <select name="coa_id" id="accountName" class="form-select @error('coa_id') is-invalid @enderror">
              <option value="">Select Account</option>
              @foreach ($accounts as $account)
                <option value="{{ $account->id }}" {{ old('coa_id') == $account->id ? 'selected' : '' }}>
                  {{ $account->account_name }}
                </option>
              @endforeach
            </select>
            @error('coa_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Sub Account - JS se load hoga --}}
          <div class="col-md-4">
            <label>Sub Account <span class="text-danger">*</span></label>
            <select name="sub_coa_id" id="subAccountName" class="form-select @error('sub_coa_id') is-invalid @enderror">
              <option value="">Select Sub Account</option>
            </select>
            @error('sub_coa_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Name --}}
          <div class="col-md-4">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="Enter name" value="{{ old('name') }}">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Opening Date --}}
          <div class="col-md-4">
            <label>Opening Date</label>
            <input type="date" name="opening_account_date" class="form-control"
              value="{{ old('opening_account_date') }}">
          </div>

          {{-- Balance Type --}}
          <div class="col-md-4">
            <label>Balance Type <span class="text-danger">*</span></label>
            <select name="nature_account" class="form-select @error('nature_account') is-invalid @enderror">
              <option value="">Select</option>
              <option value="debit" {{ old('nature_account') == 'debit' ? 'selected' : '' }}>Debit</option>
              <option value="credit" {{ old('nature_account') == 'credit' ? 'selected' : '' }}>Credit</option>
            </select>
            @error('nature_account')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Opening Balance --}}
          <div class="col-md-4">
            <label>Opening Balance</label>
            <input type="number" name="opening_balance" class="form-control" placeholder="0.00" step="0.01"
              min="0" value="{{ old('opening_balance', 0) }}">
          </div>

        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Save Account</button>
          <button type="reset" class="btn btn-secondary ms-2">Cancel</button>
        </div>

      </form>
    </div>
  </div>

  {{-- ═══════════════════════════════ --}}
  {{--         OTHER ACCOUNTS TABLE    --}}
  {{-- ═══════════════════════════════ --}}
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Other Accounts List</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Name</th>
              <th>Account</th>
              <th>Sub Account</th>
              <th>Nature</th>
              <th>Opening Balance</th>
              <th>Opening Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($otherAccounts as $index => $otherAccount)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $otherAccount->account_code }}</td>
                <td>{{ $otherAccount->name }}</td>
                <td>{{ $otherAccount->account?->account_name ?? '—' }}</td>
                <td>{{ $otherAccount->subAccount?->account_name ?? '—' }}</td>
                <td>{{ ucfirst($otherAccount->nature_account ?? '') }}</td>
                <td>{{ number_format($otherAccount->opening_balance ?? 0, 2) }}</td>
                <td>{{ $otherAccount->opening_account_date ?? '—' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center">No accounts found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection


@push('page-scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      // ══════════════════════════════════════
      //  Account change - Sub Account load
      // ══════════════════════════════════════
      document.getElementById('accountName').addEventListener('change', function() {

        var parentId = this.value;
        var subSelect = document.getElementById('subAccountName');

        subSelect.innerHTML = '<option value="">Loading...</option>';

        if (!parentId) {
          subSelect.innerHTML = '<option value="">Select Sub Account</option>';
          return;
        }

        fetch('{{ route('chart-of-accounts.account.other.sub-accounts') }}?parent_id=' + parentId)
          .then(function(response) {
            return response.json();
          })
          .then(function(data) {
            var options = '<option value="">Select Sub Account</option>';
            if (data.length > 0) {
              data.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.account_name + '</option>';
              });
            } else {
              options = '<option value="">No sub accounts found</option>';
            }
            subSelect.innerHTML = options;
          })
          .catch(function() {
            subSelect.innerHTML = '<option value="">Error loading</option>';
          });
      });

    });
  </script>
@endpush
