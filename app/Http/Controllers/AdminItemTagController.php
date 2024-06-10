<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ItemTagRequest;

use App\Models\TagItem;
use App\Models\Category;
use App\Models\Section;

class AdminItemTagController extends Controller
{
    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;

        $query = TagItem::query();
        $query->leftJoin('items', 'tag_item.item_id', '=', 'items.id');
        $query->leftJoin('tags', 'tag_item.tag_id', '=', 'tags.id');
        $query->select(['tag_item.*', 'tag_item.created_at AS tag_item_created', 'tag_item.updated_at AS tag_item_updated', 'tag_item.validation AS tag_item_validation']);

        if ($searchColumn == 'item_id')
            $query->where('items.name', 'LIKE', "%{$search}%");

        elseif ($searchColumn == 'tag_id')
            $query->where('tags.name', 'LIKE', "%{search}%");

        elseif ($searchColumn && $search) {
            if ($search == 'sim')
                $query->where('tag_item.' . $searchColumn, true);
            elseif ($search == 'não' || $search == 'nao')
                $query->where('tag_item.' . $searchColumn, false);
            else
                $query->where('tag_item.' . $searchColumn, 'LIKE', "%{$search}%");
        }

        if ($sort && $order) {
            if ($order == 'asc') {
                if ($sort == 'item_id')
                    $query->orderBy('items.name', 'desc');
                elseif ($sort == 'tag_id')
                    $query->orderBy('tags.name', 'desc');
                else
                    $query->orderBy('tag_item.' . $sort, 'desc');
            } else {
                if ($sort == 'item_id')
                    $query->orderBy('items.name', 'asc');
                elseif ($sort == 'tag_id')
                    $query->orderBy('tags.name', 'asc');
                else
                    $query->orderBy('tag_item.' . $sort, 'asc');
            }
        }

        $itemTags = $query->paginate(50)->withQueryString();

        return view('admin.item-tags.index', compact('itemTags'));
    }

    public function show($id)
    {
        $itemTag = TagItem::find($id);

        return view('admin.item-tags.show', compact('itemTag'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $sections = Section::orderBy('name', 'asc')->get();

        return view('admin.item-tags.create', compact('categories', 'sections'));
    }

    public function store(ItemTagRequest $request)
    {
        $data = $request->validated();
        $itemTag = TagItem::create($data);

        return redirect()->route('admin.item-tags.show', $itemTag)->with('success', 'Relacionamento adicionado com sucesso.');
    }

    public function edit($id)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $sections = Section::orderBy('name', 'asc')->get();
        $itemTag = TagItem::find($id);

        return view('admin.item-tags.edit', compact('itemTag', 'categories', 'sections'));
    }

    public function update(Request $request, TagItem $itemTag)
    {
        $data = $request->all();

        if ($itemTag->validation == true)
            $data['validation'] = false;
        else
            $data['validation'] = true;

        $itemTag->update($data);

        return redirect()->route('admin.item-tags.show', $itemTag)->with('success', 'Relacionamento atualizado com sucesso.');
    }

    public function destroy(TagItem $itemTag)
    {
        $itemTag->delete();
        return redirect()->route('admin.item-tags.index')->with('success', 'Relacionamento excluído com sucesso.');
    }
}
