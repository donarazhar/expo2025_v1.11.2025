<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                    ->orWhere('jawaban', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status == 'published') {
                $query->where('is_published', true);
            } elseif ($request->status == 'draft') {
                $query->where('is_published', false);
            }
        }

        // Sort
        $sortBy = $request->get('sort_by', 'urutan');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $faqs = $query->paginate(20)->withQueryString();

        // Get unique categories for filter
        $categories = Faq::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    /**
     * Show the form for creating a new FAQ
     */
    public function create()
    {
        // Get existing categories
        $categories = Faq::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        // Get next urutan number
        $nextUrutan = Faq::max('urutan') + 1;

        return view('admin.faqs.create', compact('categories', 'nextUrutan'));
    }

    /**
     * Store a newly created FAQ
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:100',
            'pertanyaan' => 'required|string|max:500',
            'jawaban' => 'required|string',
            'urutan' => 'required|integer|min:0',
            'is_published' => 'boolean',
        ], [
            'kategori.required' => 'Kategori wajib diisi',
            'pertanyaan.required' => 'Pertanyaan wajib diisi',
            'pertanyaan.max' => 'Pertanyaan maksimal 500 karakter',
            'jawaban.required' => 'Jawaban wajib diisi',
            'urutan.required' => 'Urutan wajib diisi',
            'urutan.min' => 'Urutan minimal 0',
        ]);

        // Handle checkbox
        $validated['is_published'] = $request->has('is_published');
        $validated['view_count'] = 0;

        $faq = Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan');
    }

    /**
     * Display the specified FAQ
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified FAQ
     */
    public function edit(Faq $faq)
    {
        // Get existing categories
        $categories = Faq::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    /**
     * Update the specified FAQ
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:100',
            'pertanyaan' => 'required|string|max:500',
            'jawaban' => 'required|string',
            'urutan' => 'required|integer|min:0',
            'is_published' => 'boolean',
        ]);

        // Handle checkbox
        $validated['is_published'] = $request->has('is_published');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diupdate');
    }

    /**
     * Remove the specified FAQ
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus');
    }

    /**
     * Reorder FAQs
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:faqs,id',
            'items.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($validated['items'] as $item) {
            Faq::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan FAQ berhasil diupdate',
        ]);
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Faq $faq)
    {
        $faq->update([
            'is_published' => ! $faq->is_published,
        ]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'Status publikasi FAQ berhasil diubah');
    }

    /**
     * Duplicate FAQ
     */
    public function duplicate(Faq $faq)
    {
        $newFaq = $faq->replicate();
        $newFaq->pertanyaan = $faq->pertanyaan.' (Copy)';
        $newFaq->urutan = Faq::max('urutan') + 1;
        $newFaq->is_published = false;
        $newFaq->view_count = 0;
        $newFaq->save();

        return redirect()->route('admin.faqs.edit', $newFaq)
            ->with('success', 'FAQ berhasil diduplikasi');
    }
}
