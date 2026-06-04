<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ChartOfAccountController extends Controller
{
  public function index()
  {
    return view('content.pages.cart-of-account.list');
  }

  public function getAccounts(Request $request)
  {
    return DataTables::eloquent(ChartOfAccount::with('parent')->oldest())
      ->addIndexColumn()
      ->addColumn('account_code',         fn($r) => '<code>' . $r->account_code . '</code>')
      ->addColumn('account_type',         fn($r) => '<span class="badge bg-label-primary text-capitalize">' . $r->account_type . '</span>')
      ->addColumn('nature_account',       fn($r) => $r->nature_account === 'debit'
        ? '<span class="badge bg-label-warning">Debit</span>'
        : '<span class="badge bg-label-success">Credit</span>')
      ->addColumn('parent',               fn($r) => $r->parent
        ? '<code>' . $r->parent->account_code . '</code> ' . $r->parent->account_name
        : '<span class="text-muted">—</span>')
      ->addColumn('current_balance',      fn($r) => number_format($r->current_balance, 2))
      ->addColumn('financial_date',       fn($r) => $r->financial_date
        ? \Carbon\Carbon::createFromFormat('Y-m', $r->financial_date)->format('M Y')
        : '—')
      ->addColumn('opening_account_date', fn($r) => $r->opening_account_date ?? '—')
      ->rawColumns(['account_code', 'account_type', 'nature_account', 'parent'])
      ->make(true);
  }

  public function create()
  {
    return view('content.pages.cart-of-account.create', [
      'parentAccounts' => ChartOfAccount::all(),
      'previewCode'    => 'XXXXXX',
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'account_name'         => 'required|string|max:255',
      'account_type'         => 'required|in:assets,liability,equity,revenue,expense',
      'nature_account'       => 'required|in:debit,credit',
      'parent_id'            => 'nullable|exists:chart_of_accounts,id',
      'financial_date'       => 'nullable|date_format:Y-m',
      'opening_account_date' => 'nullable|date',
    ]);

    $parentId    = $request->parent_id ?: null;
    $accountCode = ChartOfAccount::generateAccountCode($parentId, $request->account_type);

    ChartOfAccount::create([
      'account_code'         => $accountCode,
      'account_name'         => $request->account_name,
      'account_type'         => $request->account_type,
      'nature_account'       => $request->nature_account,
      'parent_id'            => $parentId,
      'financial_date'       => $request->financial_date ?: null,
      'opening_account_date' => $request->opening_account_date ?: null,
      'current_balance'      => 0,
    ]);

    return redirect()
      ->route('chart-of-accounts.index')
      ->with('success', "Account [{$accountCode}] created successfully.");
  }
}
