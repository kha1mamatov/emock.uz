<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MockTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\WritingType;
use Illuminate\Validation\Rule;

class MockTestController extends Controller
{
    public function index()
    {
        $tests = MockTest::latest()->get();
        return view('admin.tests.index', compact('tests'));
    }

    public function create()
    {
        return view('admin.tests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prompt' => 'required|string',
            'task_type' => 'required',
            'media' => 'nullable|image|max:2048',
            'writing_type' => ['nullable', Rule::in(WritingType::all())],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string'],
            'model_answer' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'prompt' => $validated['prompt'],
            'task_type' => $validated['task_type'],
            'writing_type' => $validated['writing_type'] ?? null,
            'categories' => $validated['categories'] ?? [],
            'model_answer' => $validated['model_answer'] ?? null,
        ];

        if ($request->hasFile('media')) {
            $data['media_path'] = $request->file('media')->store('writing/media', 'public');
        }

        MockTest::create($data);

        return redirect()->route('admin.tests.index')->with('success', 'Writing test created successfully.');
    }

    public function edit(MockTest $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    public function update(Request $request, MockTest $test)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prompt' => 'required|string',
            'task_type' => 'required',
            'media' => 'nullable|image|max:2048',
            'writing_type' => ['nullable', Rule::in(WritingType::all())],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string'],
            'model_answer' => 'nullable|string',
        ]);

        $test->fill([
            'title' => $validated['title'],
            'prompt' => $validated['prompt'],
            'task_type' => $validated['task_type'],
            'writing_type' => $validated['writing_type'] ?? null,
            'categories' => $validated['categories'] ?? [],
            'model_answer' => $validated['model_answer'] ?? null,
        ]);

        if ($request->hasFile('media')) {
            if ($test->media_path) {
                Storage::disk('public')->delete($test->media_path);
            }
            $test->media_path = $request->file('media')->store('writing/media', 'public');
        }

        $test->save();

        return redirect()->route('admin.tests.index')->with('success', 'Writing test updated successfully.');
    }

    public function destroy(MockTest $test)
    {
        if ($test->media_path) {
            Storage::disk('public')->delete($test->media_path);
        }

        $test->delete();

        return redirect()->route('admin.tests.index')->with('success', 'Writing test deleted successfully.');
    }

    public function show(MockTest $test)
    {
        return view('admin.tests.show', compact('test'));
    }
}
