<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;

class FAQCategoryController extends Controller
{
    public function index()
    {
        $categories = FAQCategory::all();
        return view('faq-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('faq-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        $category = new FAQCategory;
        $category->name = $validated['name'];
        $category->save();    
    
        return redirect()->route('faq-categories.index')->with('status', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = FAQCategory::findOrFail($id);
        return view('faq-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = FAQCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('faq-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = FAQCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('faq-categories.index')->with('success', 'Category deleted successfully.');
    }
}
