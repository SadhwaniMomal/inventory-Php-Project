<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GarageController extends Controller
{
  public function index()
  {
    $garages = Garage::oldest()->get();
    return view('content.pages.setup.garage.index', compact('garages'));
  }

  public function getData(Request $request)
  {
    $query = Garage::select(['id', 'label', 'created_at']);
    return DataTables::of($query)->make(true);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'length'     => 'required|string|max:255',
      'is_default' => 'required|string',
    ]);

    $data['label'] = trim($data['length']) . 'mm';

    Garage::create($data);

    return redirect()->route('setup.garage.index')
      ->with('success', 'Garage created successfully.');
  }

  public function update(Request $request, Garage $garage)
  {
    $data = $request->validate([
      'length'     => 'required|string|max:255',
      'is_default' => 'required|string',
    ]);

    $data['label'] = trim($data['length']) . 'mm';

    $garage->update($data);

    return redirect()->route('setup.garage.index')
      ->with('success', 'Garage updated successfully.');
  }

  public function edit(Garage $garage)
  {
    return view('content.pages.setup.garage.edit', compact('garage'));
  }

  public function destroy(Garage $garage)
  {
    $garage->delete();

    return redirect()->route('setup.garage.index')
      ->with('success', 'Garage deleted successfully.');
  }
}
