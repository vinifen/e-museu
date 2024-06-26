<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SingleComponentRequest;

use App\Models\ItemComponent;
use App\Models\Section;

class AdminComponentController extends Controller
{
    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;
        $count = ItemComponent::count();

        $query = ItemComponent::query();
        $query->leftJoin('items as item', 'item_component.item_id', '=', 'item.id');
        $query->leftJoin('items as component', 'item_component.component_id', '=', 'component.id');
        $query->select([
            'item_component.*',
            'item_component.created_at AS item_component_created',
            'item_component.updated_at AS item_component_updated',
            'item_component.validation AS item_component_validation',
            'item.name AS item_name',
            'component.name AS component_name']);

        if ($searchColumn == 'item_id')
            $query->where('item.name', 'LIKE', "%{$search}%");

        elseif ($searchColumn == 'component_id')
            $query->where('component.name', 'LIKE', "%{$search}%");

        elseif ($searchColumn && $search) {
            if ($search == 'sim')
                $query->where('item_component.' . $searchColumn, true);
            elseif ($search == 'não' || $search == 'nao')
                $query->where('item_component.' . $searchColumn, false);
            else
                $query->where('item_component.' . $searchColumn, 'LIKE', "%{$search}%");
        }

        if ($sort && $order) {
            if ($order == 'asc') {
                if ($sort == 'item_id')
                    $query->orderBy('item.name', 'desc');
                elseif ($sort == 'component_id')
                    $query->orderBy('component.name', 'desc');
                else
                    $query->orderBy('item_component.' . $sort, 'desc');
            } else {
                if ($sort == 'item_id')
                    $query->orderBy('item.name', 'asc');
                elseif ($sort == 'component_id')
                    $query->orderBy('component.name', 'asc');
                else
                    $query->orderBy('item_component.' . $sort, 'asc');
            }
        }

        $components = $query->paginate(30)->withQueryString();

        return view('admin.components.index', compact('components','count'));
    }

    public function show($id)
    {
        $component = ItemComponent::find($id);

        return view('admin.components.show', compact('component'));
    }

    public function create()
    {
        $sections = Section::orderBy('name', 'asc')->get();

        return view('admin.components.create', compact('sections'));
    }

    public function store(SingleComponentRequest $request)
    {
        $data = $request->validated();
        $component = ItemComponent::create($data);

        return redirect()->route('admin.components.show', $component)->with('success', 'Componente adicionada com sucesso.');
    }

    public function edit($id)
    {
        $sections = Section::orderBy('name', 'asc')->get();
        $component = ItemComponent::find($id);

        return view('admin.components.edit', compact('component', 'sections'));
    }

    public function update(Request $request, ItemComponent $component)
    {
        $data = $request->all();

        if ($component->validation == true)
            $data['validation'] = false;
        else
            $data['validation'] = true;

        $component->update($data);

        return redirect()->route('admin.components.show', $component)->with('success', 'Componente atualizado com sucesso.');
    }

    public function destroy(ItemComponent $component)
    {
        $component->delete();
        return redirect()->route('admin.components.index')->with('success', 'Componente excluído com sucesso.');
    }
}
