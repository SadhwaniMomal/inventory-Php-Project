<?php

namespace App\Http\Controllers;

use App\Models\Cities;
// use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
  public function index()
  {
    $cities = Cities::oldest()->get();
    return view('content.pages.setup.city.index', compact('cities'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'city'    => 'required|string|max:255',
      'country' => 'required|string|max:255',
    ]);

    Cities::create($request->only(['city', 'country']));

    return redirect()->route('setup.city.index')
      ->with('success', 'City created successfully.');
  }

  public function edit(cities $city)
  {
    return view('content.pages.setup.city.edit', compact('city'));
  }

  public function update(Request $request, cities $city)
  {
    $request->validate([
      'city'    => 'required|string|max:255',
      'country' => 'required|string|max:255',
    ]);

    $city->update($request->only(['city', 'country']));

    return redirect()->route('setup.city.index')
      ->with('success', 'City updated successfully.');
  }

  public function destroy(Cities $city)
  {
    $city->delete();

    return redirect()->route('setup.city.index')
      ->with('success', 'City deleted successfully.');
  }
}
