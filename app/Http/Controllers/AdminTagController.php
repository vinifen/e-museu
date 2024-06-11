<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLock;

use Illuminate\Http\Request;
use App\Http\Requests\SingleTagRequest;

use App\Models\Tag;
use App\Models\Category;

class AdminTagController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckLock::class)->only(['edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;
        $count = Tag::count();

        $query = Tag::query();
        $query->leftJoin('categories', 'tags.category_id', '=', 'categories.id');
        $query->select(['tags.*', 'tags.name AS tag_name', 'tags.created_at AS tag_created', 'tags.updated_at AS tag_updated']);

        if ($searchColumn == 'category_id')
            $query->where('categories.name', 'LIKE', "%{$search}%");

        elseif ($searchColumn && $search) {
            if ($search == 'sim')
                $query->where('tags.' . $searchColumn, true);
            elseif ($search == 'não' || $search == 'nao')
                $query->where('tags.' . $searchColumn, false);
            else
                $query->where('tags.' . $searchColumn, 'LIKE', "%{$search}%");
        }

        if ($sort && $order) {
            if ($order == 'asc') {
                if ($sort == 'category_id')
                    $query->orderBy('categories.name', 'desc');
                else
                    $query->orderBy('tags.' . $sort, 'desc');
            } else {
                if ($sort == 'category_id')
                    $query->orderBy('categories.name', 'asc');
                else
                    $query->orderBy('tags.' . $sort, 'asc');
            }
        }

        $tags = $query->paginate(50)->withQueryString();;

        return view('admin.tags.index', compact('tags', 'count'));
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.show', compact('tag'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.tags.create', compact('categories'));
    }

    public function store(SingleTagRequest $request)
    {
        $data = $request->validated();
        $tag = Tag::create($data);

        return redirect()->route('admin.tags.show', $tag)->with('success', 'Etiqueta adicionada com sucesso.');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        $categories = Category::orderBy('name', 'asc')->get();

        $this->lock($tag);

        return view('admin.tags.edit', compact('tag', 'categories'));
    }

    public function update(SingleTagRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $tag->update($data);

        $this->unlock($tag);

        return redirect()->route('admin.tags.show', $tag)->with('success', 'Etiqueta atualizada com sucesso.');
    }

    public function destroy(Tag $tag)
    {
        $this->unlock($tag);

        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta excluída com sucesso.');
    }
}
