<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Stockinventory;
use App\Models\ChartOfAccount;
use App\Models\Size;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
  // ── Page Open ──
  public function index()
  {
    $products = ChartOfAccount::whereIn('account_code', ['01-02-01', '01-02-03'])->get();
    $sizes    = Size::orderBy('label')->get();
    $garages  = Garage::orderBy('label')->get();

    $inventories = Stockinventory::with(['product', 'size', 'garage'])->latest()->get();

    return view('content.pages.stock.inventory.index', compact('products', 'sizes', 'garages', 'inventories'));
  }

  // ── Inventory Save ──
  public function store(Request $request)
  {
    $request->validate([
      'coa_id'           => 'required|exists:chart_of_accounts,id',
      'product_name'     => 'required|string|max:255',
      'size_id'          => 'required|exists:sizes,id',
      'garage_id'        => 'required|exists:garages,id',
      'opening_quantity' => 'nullable|numeric|min:0',
      'opening_amount'   => 'nullable|numeric|min:0',
      'opening_date'     => 'nullable|date',
    ]);

    // Get product from chart_of_accounts
    $product     = ChartOfAccount::find($request->coa_id);
    $productCode = $product->account_code;

    // Count existing records for this product
    $totalRecords = Stockinventory::where('coa_id', $request->coa_id)->count();

    // Generate account code e.g. 01-02-01-01
    $nextNumber  = str_pad($totalRecords + 1, 2, '0', STR_PAD_LEFT);
    $accountCode = $productCode . '-' . $nextNumber;

    Stockinventory::create([
      'account_code'     => $accountCode,
      'coa_id'           => $request->coa_id,
      'product_name'     => $request->product_name,
      'size_id'          => $request->size_id,
      'garage_id'        => $request->garage_id,
      'opening_quantity' => $request->opening_quantity ?? 0,
      'opening_amount'   => $request->opening_amount ?? 0,
      'opening_date'     => $request->opening_date,
    ]);

    return redirect()
      ->route('stock.inventory.index')
      ->with('success', 'Inventory saved successfully!');
  }
}
