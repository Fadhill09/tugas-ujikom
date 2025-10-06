<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255|unique:categories,kategori',
        ]);

        Category::create([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'kategori' => 'required|string|max:255|unique:categories,kategori,' . $category->id,
        ]);

        $category->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
