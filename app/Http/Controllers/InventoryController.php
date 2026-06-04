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
    // chart_of_accounts se RAW aur FINISH
    $products = ChartOfAccount::whereIn('account_code', ['01-02-01', '01-02-03'])->get();

    $sizes    = Size::orderBy('label')->get();
    $garages  = Garage::orderBy('label')->get();

    $inventories = Stockinventory::with(['product', 'size', 'garage'])->latest()->get();

    return view('content.pages.stock.inventory.index', compact('products', 'sizes', 'garages', 'inventories'));
  }


  // ── Inventory Save karo ──
  public function store(Request $request)
  {
    $request->validate([
      'product_id'       => 'required|exists:chart_of_accounts,id',
      'product_name'     => 'required|string|max:255',
      'size_id'          => 'required|exists:sizes,id',
      'garage_id'        => 'required|exists:garages,id',
      'opening_quantity' => 'nullable|numeric|min:0',
      'opening_amount'   => 'nullable|numeric|min:0',
      'opening_date'     => 'nullable|date',
    ]);

    // chart_of_accounts se product lo
    $product     = ChartOfAccount::find($request->product_id);
    $productCode = $product->account_code;

    // Kitne records hain us product mein
    $totalRecords = Stockinventory::where('product_id', $request->product_id)->count();

    // 4th generation - 01, 02, 03
    $nextNumber  = str_pad($totalRecords + 1, 2, '0', STR_PAD_LEFT);
    $accountCode = $productCode . '-' . $nextNumber;

    Stockinventory::create([
      'account_code'     => $accountCode,
      'product_id'       => $request->product_id,
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
