<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    public function manage()
    {
        $faqs = Faq::with('category')->get(); 
        return view('faq.manage', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::all();
        return view('faq.create', compact('categories'));
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = FaqCategory::all();
        return view('faq.edit', compact('faq', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|min:3',
            'answer' => 'required|min:10',
            'category_id' => 'required|exists:faq_categories,id',
        ]);

        $faq = new Faq();
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->category_id = $request->category_id;
        $faq->save();

        return redirect()->route('faq.index')->with('status', 'FAQ created successfully');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|min:3',
            'answer' => 'required|min:10',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->save();

        return redirect()->route('faq.manage')->with('status', 'FAQ updated successfully');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.manage')->with('status', 'FAQ deleted successfully');
    }
}
