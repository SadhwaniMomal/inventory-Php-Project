<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CoaContact;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{

  // ── Page Open ──
  public function index()
  {
    // City dropdown ke liye - city table se
    $cities = Cities::orderBy('city')->get();

    // Account dropdown ke liye
    $accounts = ChartOfAccount::whereIn('account_code', ['01-03', '02-01'])
      ->orderBy('account_code')
      ->get();

    // Table ke liye contacts
    $contacts = CoaContact::with('city')->oldest()->get();

    return view('content.pages.cart-of-account.account.contact.list', compact('cities', 'accounts', 'contacts'));
  }


  // ── Account select hone par Sub Accounts load karo ──
  public function getSubAccounts(Request $request)
  {
    $subAccounts = ChartOfAccount::where('parent_id', $request->parent_id)
      ->orderBy('account_code')
      ->get(['id', 'account_name', 'account_code']);

    return response()->json($subAccounts);
  }


  // ── Contact Save karo ──
  public function store(Request $request)
  {
    // Validation
    $request->validate([
      'coa_id'          => 'required|exists:chart_of_accounts,id',
      'sub_coa_id'      => 'required|exists:chart_of_accounts,id',
      'name'            => 'required|string|max:255',
      'phone_number'    => 'required|string|max:20',
      'city_id'         => 'required|exists:cities,id',
      'address'         => 'required|string|max:255',
      'company_name'    => 'nullable|string|max:255',
      'cnic'            => 'nullable|string|max:20',
      'opening_balance' => 'nullable|numeric|min:0',
      'nature_account'  => 'required|in:debit,credit',
    ]);

    // Sub account ka code lo
    $subAccount = ChartOfAccount::find($request->sub_coa_id);
    $parentCode = $subAccount->account_code;

    // Kitne contacts hain us sub account mein
    $totalContacts = CoaContact::where('coa_id', $request->sub_coa_id)->count();

    // Agla number banao - 01, 02, 03
    $nextNumber = str_pad($totalContacts + 1, 2, '0', STR_PAD_LEFT);

    // Final account code - jaise 01-03-01
    $accountCode = $parentCode . '-' . $nextNumber;

    // Contact save karo
    CoaContact::create([
      'coa_id'          => $request->sub_coa_id,
      'account_code'    => $accountCode,
      'name'            => $request->name,
      'company_name'    => $request->company_name,
      'cnic'            => $request->cnic,
      'phone_number'    => $request->phone_number,
      'city_id'         => $request->city_id,
      'address'         => $request->address,
      'opening_balance' => $request->opening_balance ?? 0,
      'current_balance' => $request->opening_balance ?? 0,
      'nature_account'  => $request->nature_account,
    ]);

    return redirect()
      ->route('chart-of-accounts.account.index')
      ->with('success', 'Contact saved successfully!');
  }
}
