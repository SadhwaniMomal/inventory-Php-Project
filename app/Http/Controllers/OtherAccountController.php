<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\OtherAccount;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OtherAccountController extends Controller
{

  // ── Page Open ──
  public function index()
  {
    // XX-XX format wale accounts - 01-03 aur 02-01 choro
    $accounts = ChartOfAccount::whereNotNull('parent_id')
      ->whereNotIn('account_code', ['01-03', '02-01'])
      ->get()
      ->filter(function ($account) {
        return preg_match('/^\d{2}-\d{2}$/', $account->account_code);
      })
      ->values();

    $otherAccounts = OtherAccount::with(['account', 'subAccount'])->latest()->get();

    return view('content.pages.cart-of-account.otheraccounts.index', compact('accounts', 'otherAccounts'));
  }


  // ── Account select hone par Sub Accounts load karo ──
  public function getSubAccounts(Request $request)
  {
    $subAccounts = ChartOfAccount::where('parent_id', $request->parent_id)
      ->orderBy('account_code')
      ->get(['id', 'account_name', 'account_code']);

    return response()->json($subAccounts);
  }


  // ── Yajra DataTable ke liye data ──
  public function getOtherAccounts(Request $request)
  {
    $query = OtherAccount::with(['account', 'subAccount'])->latest();

    return DataTables::eloquent($query)
      ->addIndexColumn()
      ->addColumn('parent_account', function ($item) {
        return $item->account ? $item->account->account_name : '—';
      })
      ->addColumn('sub_account', function ($item) {
        return $item->subAccount ? $item->subAccount->account_name : '—';
      })
      ->addColumn('nature_account', function ($item) {
        return ucfirst($item->nature_account ?? '');
      })
      ->addColumn('opening_balance', function ($item) {
        return number_format($item->opening_balance ?? 0, 2);
      })
      ->addColumn('opening_account_date', function ($item) {
        return $item->opening_account_date ?: '—';
      })
      ->make(true);
  }


  // ── OtherAccount Save karo ──
  public function store(Request $request)
  {
    // Validation
    $request->validate([
      'coa_id'               => 'required|exists:chart_of_accounts,id',
      'sub_coa_id'           => 'required|exists:chart_of_accounts,id',
      'name'                 => 'required|string|max:255',
      'nature_account'       => 'required|in:debit,credit',
      'opening_balance'      => 'nullable|numeric|min:0',
      'opening_account_date' => 'nullable|date',
    ]);

    // Sub account ka code lo
    $subAccount = ChartOfAccount::find($request->sub_coa_id);
    $parentCode = $subAccount->account_code;

    // Kitne records hain us sub account mein
    $totalRecords = OtherAccount::where('sub_coa_id', $request->sub_coa_id)->count();

    // Agla number banao - 01, 02, 03
    $nextNumber = str_pad($totalRecords + 1, 2, '0', STR_PAD_LEFT);

    // Final account code - jaise 03-01-01
    $accountCode = $parentCode . '-' . $nextNumber;

    // Database mein save karo
    OtherAccount::create([
      'coa_id'               => $request->coa_id,
      'sub_coa_id'           => $request->sub_coa_id,
      'account_code'         => $accountCode,
      'name'                 => $request->name,
      'opening_account_date' => $request->opening_account_date,
      'nature_account'       => $request->nature_account,
      'opening_balance'      => $request->opening_balance ?? 0,
    ]);

    return redirect()
      ->route('chart-of-accounts.account.other.account.index')
      ->with('success', 'Account saved successfully!');
  }
}
