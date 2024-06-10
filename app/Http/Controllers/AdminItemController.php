<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Requests\StoreItemRequest;

use App\Models\Item;
use App\Models\Section;
use App\Models\Proprietary;
use App\Models\Category;

class AdminItemController extends Controller
{
    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;

        $query = Item::query();
        $query->leftJoin('proprietaries', 'items.proprietary_id', '=', 'proprietaries.id');
        $query->leftJoin('sections', 'items.section_id', '=', 'sections.id');
        $query->select(['items.*', 'items.name AS item_name', 'items.created_at AS item_created', 'items.updated_at AS item_updated', 'items.validation AS item_validation']);

        if ($searchColumn == 'proprietary_id')
            $query->where('proprietaries.contact', 'LIKE', "%{$search}%");

        elseif ($searchColumn == 'section_id')
            $query->where('sections.name', 'LIKE', "%{search}%");

        elseif ($searchColumn && $search) {
            if ($search == 'sim')
                $query->where('items.' . $searchColumn, true);
            elseif ($search == 'não' || $search == 'nao')
                $query->where('items.' . $searchColumn, false);
            else
                $query->where('items.' . $searchColumn, 'LIKE', "%{$search}%");
        }

        if ($sort && $order) {
            if ($order == 'asc') {
                if ($sort == 'proprietary_id')
                    $query->orderBy('proprietaries.contact', 'desc');
                elseif ($sort == 'section_id')
                    $query->orderBy('sections.name', 'desc');
                else
                    $query->orderBy('items.' . $sort, 'desc');
            } else {
                if ($sort == 'proprietary_id')
                    $query->orderBy('proprietaries.contact', 'asc');
                elseif ($sort == 'section_id')
                    $query->orderBy('sections.name', 'asc');
                else
                    $query->orderBy('items.' . $sort, 'asc');
            }
        }

        $items = $query->paginate(50)->withQueryString();

        return view('admin.items.index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::find($id);

        return view('admin.items.show', compact('item'));
    }

    public function create()
    {
        $sections = Section::orderBy('name')->get();
        $proprietaries = Proprietary::orderBy('full_name')->get();

        return view('admin.items.create', compact('proprietaries', 'sections'));
    }

    public function store(StoreItemRequest $request)
    {
        $rules = [
            'proprietary_id' => 'required|integer|numeric|exists:proprietaries,id',
            'validation' => 'required|boolean'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        if ($request->image)
            $data['image'] = $request->image->store('items');

        $data['identification_code'] = '000';
        $item = Item::create($data);

        return redirect()->route('admin.items.show', $item)->with('success', 'Item adicionado com sucesso.');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $sections = Section::orderBy('name')->get();
        $proprietaries = Proprietary::orderBy('full_name')->get();

        return view('admin.items.edit', compact('item', 'sections', 'proprietaries'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $data = $request->validated();

        if ($request->image) {
            $data['image'] = $request->image->store('items');
        } else {
            unset($data['image']);
        }

        $item->update($data);

        return redirect()->route('admin.items.show', $item)->with('success', 'Item atualizado com sucesso.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item excluído com sucesso.');
    }
}
