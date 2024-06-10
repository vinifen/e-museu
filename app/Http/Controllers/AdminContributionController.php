<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ContributionRequest;

use App\Models\Contribution;
use App\Models\Proprietary;
use App\Models\Section;

class AdminContributionController extends Controller
{
    public function index(Request $request)
    {
        $searchColumn = $request->search_column;
        $search = $request->search;
        $sort = $request->sort;
        $order = $request->order;

        $query = Contribution::query();
        $query->leftJoin('proprietaries', 'contributions.proprietary_id', '=', 'proprietaries.id');
        $query->leftJoin('items', 'contributions.item_id', '=', 'items.id');
        $query->select(['contributions.*', 'contributions.created_at AS contribution_created', 'contributions.updated_at AS contribution_updated', 'contributions.validation AS contribution_validation']);

        if ($searchColumn == 'proprietary_id')
            $query->where('proprietaries.contact', 'LIKE', "%{$search}%");

        elseif ($searchColumn == 'item_id')
            $query->where('items.name', 'LIKE', "%{search}%");

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
                    $query->orderBy('contributions.' . $sort, 'desc');
            } else {
                if ($sort == 'proprietary_id')
                    $query->orderBy('proprietaries.contact', 'asc');
                elseif ($sort == 'item_id')
                    $query->orderBy('items.name', 'asc');
                else
                    $query->orderBy('contributions.' . $sort, 'asc');
            }
        }

        $contributions = $query->paginate(50)->withQueryString();

        return view('admin.contributions.index', compact('contributions'));
    }

    public function show($id)
    {
        $contribution = Contribution::find($id);

        return view('admin.contributions.show', compact('contribution'));
    }

    public function create()
    {
        $sections = Section::orderBy('name', 'asc')->get();
        $proprietaries = Proprietary::orderBy('contact', 'asc')->get();

        return view('admin.contributions.create', compact('proprietaries', 'sections'));
    }

    public function store(ContributionRequest $request)
    {
        $data = $request->validated();
        $contribution = Contribution::create($data);

        return redirect()->route('admin.contributions.show', $contribution)->with('success', 'Contribuição adicionada com sucesso.');
    }

    public function edit($id)
    {
        $contribution = Contribution::find($id);
        $proprietaries = Proprietary::orderBy('contact', 'asc')->get();
        $sections = Section::orderBy('name', 'asc')->get();

        return view('admin.contributions.edit', compact('contribution', 'sections', 'proprietaries'));
    }

    public function update(ContributionRequest $request, Contribution $contribution)
    {
        $data = $request->validated();

        $contribution->update($data);

        return redirect()->route('admin.contributions.show', $contribution)->with('success', 'Contribuição atualizada com sucesso.');
    }

    public function destroy(Contribution $contribution)
    {
        $contribution->delete();
        return redirect()->route('admin.contributions.index', $contribution)->with('success', 'Contribuição adicionada com sucesso.');
    }
}
