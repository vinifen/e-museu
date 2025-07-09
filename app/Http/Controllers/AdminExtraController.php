<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLock;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\SingleExtraRequest;

use App\Models\Extra;
use App\Models\Proprietary;
use App\Models\Section;

class AdminExtraController extends Controller
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
        $count = Extra::count();

        $query = Extra::query();
        $query
        ->leftJoin('proprietaries', 'extras.proprietary_id', '=', 'proprietaries.id')
        ->leftJoin('items', 'extras.item_id', '=', 'items.id')
        ->select([
            'extras.*',
            'items.name AS item_name',
            'proprietaries.contact AS proprietary_contact',
        ]);

        if ($searchColumn == 'proprietary_id')
            $query->where('proprietaries.contact', 'LIKE', "%{$search}%");

        elseif ($searchColumn == 'item_id')
            $query->where('items.name', 'LIKE', "%{$search}%");

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
                elseif ($sort == 'item_id')
                    $query->orderBy('items.name', 'desc');
                else
                    $query->orderBy('extras.' . $sort, 'desc');
            } else {
                if ($sort == 'proprietary_id')
                    $query->orderBy('proprietaries.contact', 'asc');
                elseif ($sort == 'item_id')
                    $query->orderBy('items.name', 'asc');
                else
                    $query->orderBy('extras.' . $sort, 'asc');
            }
        }

        $extras = $query->paginate(30)->withQueryString();

        return view('admin.extras.index', compact('extras', 'count'));
    }

    public function show($id)
    {
        $extra = Extra::find($id);

        return view('admin.extras.show', compact('extra'));
    }

    public function create()
    {
        $sections = Section::orderBy('name', 'asc')->get();
        $proprietaries = Proprietary::orderBy('contact', 'asc')->get();

        return view('admin.extras.create', compact('proprietaries', 'sections'));
    }

    public function store(SingleExtraRequest $request)
    {
        $data = $request->validated();
        $extra = Extra::create($data);

        return redirect()->route('admin.extras.show', $extra)->with('success', 'Curiosidade extra adicionada com sucesso.');
    }

    public function edit($id)
    {
        $extra = Extra::find($id);
        $proprietaries = Proprietary::orderBy('contact', 'asc')->get();
        $sections = Section::orderBy('name', 'asc')->get();

        $this->lock($extra);

        return view('admin.extras.edit', compact('extra', 'sections', 'proprietaries'));
    }

    public function update(SingleExtraRequest $request, Extra $extra)
    {
        $data = $request->validated();

        $extra->update($data);

        $this->unlock($extra);

        return redirect()->route('admin.extras.show', $extra)->with('success', 'Curiosidade extra atualizada com sucesso.');
    }

    public function destroy(Extra $extra)
    {
        $this->unlock($extra);

        $extra->delete();
        return redirect()->route('admin.extras.index')->with('success', 'Curiosidade extra excluída com sucesso.');
    }
}
