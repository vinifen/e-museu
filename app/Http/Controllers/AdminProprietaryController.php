<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ProprietaryRequest;
use App\Http\Requests\NewProprietaryRequest;

use App\Models\Proprietary;

class AdminProprietaryController extends Controller
{
    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;

        $query = Proprietary::query();

        if ($searchColumn && $search) {
            if ($search == 'sim')
                $query->where($searchColumn, true);
            elseif ($search == 'não' || $search == 'nao')
                $query->where($searchColumn, false);
            else
                $query->where($searchColumn, 'LIKE', "%{$search}%");
        }

        if ($sort && $order) {
            if ($order == 'asc')
                $query->orderBy($sort, 'desc');
            else
                $query->orderBy($sort, 'asc');
        }

        $proprietaries = $query->paginate(50)->withQueryString();

        return view('admin.proprietaries.index', compact('proprietaries'));
    }

    public function show($id)
    {
        $proprietary = Proprietary::find($id);

        return view('admin.proprietaries.show', compact('proprietary'));
    }

    public function create()
    {
        return view('admin.proprietaries.create');
    }

    public function store(ProprietaryRequest $request)
    {
        $data = $request->validated();
        $proprietary = Proprietary::create($data);

        return redirect()->route('admin.proprietaries.show', $proprietary)->with('success', 'Proprietário adicionado com sucesso.');
    }

    public function edit($id)
    {
        $proprietary = Proprietary::find($id);

        return view('admin.proprietaries.edit', compact('proprietary'));
    }

    public function update(NewProprietaryRequest $request, Proprietary $proprietary)
    {
        $data = $request->validated();

        $proprietary->update($data);

        return redirect()->route('admin.proprietaries.show', $proprietary)->with('success', 'Proprietário atualizado com sucesso.');
    }

    public function destroy(Proprietary $proprietary)
    {
        $proprietary->delete();
        return redirect()->route('admin.proprietaries.index')->with('success', 'Proprietário excluído com sucesso.');
    }
}
