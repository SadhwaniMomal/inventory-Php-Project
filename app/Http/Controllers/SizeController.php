<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
  public function index()
  {
    $sizes = Size::oldest()->get();
    return view('content.pages.setup.size.index', compact('sizes'));
  }

  public function getData(Request $request)
  {
    $query = Size::select(['id', 'label', 'height', 'width', 'created_at']);
    return DataTables::of($query)->make(true);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'height' => 'required|string|max:255',
      'width'  => 'required|string|max:255',
    ]);

    $data['label'] = trim($data['height']) . ' x ' . trim($data['width']);

    Size::create($data);

    return redirect()->route('setup.size.index')
      ->with('success', 'Size created successfully.');
  }

  public function update(Request $request, Size $size)
  {
    $data = $request->validate([
      'height' => 'required|string|max:255',
      'width'  => 'required|string|max:255',
    ]);

    $data['label'] = trim($data['height']) . ' x ' . trim($data['width']);

    $size->update($data);

    return redirect()->route('setup.size.index')
      ->with('success', 'Size updated successfully.');
  }

  public function edit(Size $size)
  {
    return view('content.pages.setup.size.edit', compact('size'));
  }

  public function destroy(Size $size)
  {
    $size->delete();

    return redirect()->route('setup.size.index')
      ->with('success', 'Size deleted successfully.');
  }
}
