@php $configData = Helper::appClasses(); @endphp
@extends('layouts/layoutMaster')
@section('title', 'List - Chart of Account')

@section('vendor-style')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('vendor-script')
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" defer></script>
@endsection

@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Chart of Accounts</h5>
      <a href="{{ route('chart-of-accounts.create') }}" class="btn btn-primary btn-sm">
        <i class="bx bx-plus me-1"></i> Add Account
      </a>
    </div>
    <div class="table-responsive p-3">
      <table id="accounts-table" class="table table-hover w-100">
        <thead class="table-light">
          <tr>
            <th>S#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Nature</th>
            <th>Parent</th>
            <th>Financial Date</th>
            <th>Opening Date</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
@endsection

@section('page-script')
  <script>
    window.addEventListener('load', function() {
      $('#accounts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{ route('chart-of-accounts.data') }}',
          type: 'GET',
          error: function(xhr) {
            console.log('AJAX Error:', xhr.responseText);
          }
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'account_code',
            name: 'account_code'
          },
          {
            data: 'account_name',
            name: 'account_name'
          },
          {
            data: 'account_type',
            name: 'account_type'
          },
          {
            data: 'nature_account',
            name: 'nature_account'
          },
          {
            data: 'parent',
            name: 'parent.account_name',
            orderable: false
          },

          {
            data: 'financial_date',
            name: 'financial_date'
          },
          {
            data: 'opening_account_date',
            name: 'opening_account_date'
          },
        ]
      });
    });
  </script>
@endsection
