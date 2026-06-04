<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;

class UnitController extends Controller
{
  public function index()
  {
    $units = Units::oldest()->get();
    return view('content.pages.setup.unit.index', compact('units'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name'       => 'required|string|max:255',
      'size'       => 'nullable|string|max:255',
      'conversion' => 'nullable|string|max:255',
    ]);

    Units::create($request->only(['name', 'size', 'conversion']));

    return redirect()->route('setup.unit.index')
      ->with('success', 'Unit created successfully.');
  }

  public function edit(Units $unit)
  {
    return view('content.pages.setup.unit.edit', compact('unit'));
  }

  public function update(Request $request, Units $unit)
  {
    $request->validate([
      'name'       => 'required|string|max:255',
      'size'       => 'nullable|string|max:255',
      'conversion' => 'nullable|string|max:255',
    ]);

    $unit->update($request->only(['name', 'size', 'conversion']));

    return redirect()->route('setup.unit.index')
      ->with('success', 'Unit updated successfully.');
  }

  public function destroy(Units $unit)
  {
    $unit->delete();

    return redirect()->route('setup.unit.index')
      ->with('success', 'Unit deleted successfully.');
  }
}
