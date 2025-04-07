<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CategoryServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServices $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): View
    {
        $categories = $this->categoryService->getAll();
        return view('category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->createCategory([
            'name' => $request->input('name')
        ]);

        return redirect()->route('category.index')->with('success', 'Categorie succesvol toegevoegd.');
    }

    public function edit($uuid): View
    {
        $category = $this->categoryService->getCategoryByUuid($uuid);

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $uuid): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryService->getCategoryByUuid($uuid);

        if ($category) {
             $this->categoryService->updateCategory($uuid, [
                'name' => $request->input('name')
            ]);

            return redirect()->route('category.index')->with('success', 'Categorie succesvol aangepast.');
        }

        return redirect()->route('category.index')->with('error', 'Categorie niet gevonden.');
    }

    public function destroy($uuid): RedirectResponse
    {
        $this->categoryService->deleteCategory($uuid);

        return redirect()->route('category.index')->with('success', 'Categorie succesvol verwijderd.');
    }
}
