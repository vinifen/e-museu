<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;

use App\Models\Section;

class AdminSectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Section::query();

        if ($request->search_column && $request->search)
            $query->where($request->search_column, 'LIKE', "%{$request->search}%");

        if ($request->sort && $request->order) {
            if ($request->order == 'asc')
                $query->orderBy($request->sort, 'desc');
            else
                $query->orderBy($request->sort, 'asc');
        }

        $sections = $query->paginate(50)->withQueryString();;

        return view('admin.sections.index', compact('sections'));
    }

    public function show($id)
    {
        $section = Section::find($id);

        return view('admin.sections.show', compact('section'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(SectionRequest $request)
    {
        $data = $request->validated();
        $section = Section::create($data);

        return redirect()->route('admin.sections.show', $section)->with('success', 'Seção adicionada com sucesso.');
    }

    public function edit($id)
    {
        $section = Section::find($id);

        return view('admin.sections.edit', compact('section'));
    }

    public function update(SectionRequest $request, Section $section)
    {
        $data = $request->validated();

        $section->update($data);

        return redirect()->route('admin.sections.show', $section)->with('success', 'Seção atualizada com sucesso.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Seção excluída com sucesso.');
    }
}
