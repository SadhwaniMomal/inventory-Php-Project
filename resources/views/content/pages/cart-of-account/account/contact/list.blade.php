@php $configData = Helper::appClasses(); @endphp
@extends('layouts/layoutMaster')

@section('title', 'Contacts')

@section('content')

  {{-- Success Message --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-4">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- ═══════════════════════════════ --}}
  {{--         ADD CONTACT FORM        --}}
  {{-- ═══════════════════════════════ --}}
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Add Contact</h5>
    </div>

    <div class="card-body">
      <form id="contactForm" method="POST" action="{{ route('chart-of-accounts.account.store') }}">
        @csrf

        <div class="row g-3">

          {{-- Account Dropdown --}}
          <div class="col-md-4">
            <label>Account</label>
            <select name="coa_id" id="accountName" class="form-select">
              <option value="">Select Account</option>
              @foreach ($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
              @endforeach
            </select>
          </div>

          {{-- Sub Account Dropdown - JS se load hoga --}}
          <div class="col-md-4">
            <label>Sub Account</label>
            <select name="sub_coa_id" id="subAccountName" class="form-select">
              <option value="">Select Sub Account</option>
            </select>
          </div>

          {{-- Name --}}
          <div class="col-md-4">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name">
          </div>

          {{-- Phone --}}
          <div class="col-md-4">
            <label>Phone</label>
            <input type="text" name="phone_number" class="form-control" placeholder="Enter phone">
          </div>

          {{-- City - city table se --}}
          <div class="col-md-4">
            <label>City</label>
            <select name="city_id" class="form-select">
              <option value="">Select City</option>
              @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->city }}</option>
              @endforeach
            </select>
          </div>

          {{-- Address --}}
          <div class="col-md-4">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address">
          </div>

          {{-- Balance Type --}}
          <div class="col-md-4">
            <label>Balance Type</label>
            <select name="nature_account" class="form-select">
              <option value="debit">Debit</option>
              <option value="credit">Credit</option>
            </select>
          </div>

          {{-- Opening Balance --}}
          <div class="col-md-4">
            <label>Opening Balance</label>
            <input type="number" name="opening_balance" class="form-control" value="0">
          </div>

        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Save Contact</button>
        </div>

      </form>
    </div>
  </div>

  {{-- ═══════════════════════════════ --}}
  {{--           CONTACTS TABLE        --}}
  {{-- ═══════════════════════════════ --}}
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Contacts List</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Name</th>
              <th>Phone</th>
              <th>City</th>
              <th>Balance</th>
              <th>Nature</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($contacts as $index => $contact)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $contact->account_code }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone_number }}</td>
                <td>{{ $contact->city?->city ?? '—' }}</td>
                <td>{{ $contact->current_balance ?? 0 }}</td>
                <td>{{ ucfirst($contact->nature_account ?? '') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No contacts found</td>
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
      //  1. Account change - Sub Account load
      // ══════════════════════════════════════
      document.getElementById('accountName').addEventListener('change', function() {

        var parentId = this.value;
        var subSelect = document.getElementById('subAccountName');

        subSelect.innerHTML = '<option value="">Loading...</option>';

        if (!parentId) {
          subSelect.innerHTML = '<option value="">Select Sub Account</option>';
          return;
        }

        fetch('{{ route('chart-of-accounts.sub-accounts') }}?parent_id=' + parentId)
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


      // ══════════════════════════════════════
      //  2. Form Submit
      // ══════════════════════════════════════
      document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
          })
          .then(function(response) {
            if (response.ok) {
              window.location.reload();
            }
          })
          .catch(function() {
            alert('Something went wrong. Please try again.');
          });
      });

    });
  </script>
@endpush
