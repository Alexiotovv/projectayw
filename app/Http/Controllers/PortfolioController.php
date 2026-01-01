<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
     public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categoria' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $path = $request->file('imagen')->store('portfolios', 'public');

        Portfolio::create([
            'titulo' => $request->titulo,
            'imagen' => $path,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categoria' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('portfolios', 'public');
            $portfolio->imagen = $path;
        }

        $portfolio->update([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted successfully!');
    }
}
