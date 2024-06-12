<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\DifferentIds;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\TagRequest;
use App\Http\Requests\ExtraRequest;
use App\Http\Requests\ComponentRequest;
use App\Http\Requests\SingleTagRequest;
use App\Http\Requests\SingleExtraRequest;
use App\Http\Requests\SingleComponentRequest;
use App\Http\Requests\ProprietaryRequest;
use App\Http\Requests\ContributionRequest;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Proprietary;
use App\Models\Extra;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Section;
use App\Models\ItemComponent;
use App\Models\Contribution;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();
        $query->where('validation', true);
        $order = $request->order;
        $sectionName = '';
        $section_id = $request->section;

        if (!$order)
            $order= 1;

        if (!$section_id)
            $section_id = request()->input('section');

        if ($section_id)
            $query->where('section_id', $section_id);

        if (isset($request->search) && ($request->search != null))
            $query->where('name', 'LIKE', "%{$request->search}%");

        if (isset($request->category) && ($request->category != null))
        {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('category_id', $request->category)
                        ->where('tag_item.validation', true);
            });
        }

        if (isset($request->tag) && ($request->tag != null))
        {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('tag_id', $request->tag)
                        ->where('tag_item.validation', true);
            });
        }

        switch ($order) {
            case 1:
                $query->orderBy('date', 'asc');
                break;
            case 2:
                $query->orderBy('date', 'desc');
                break;
            case 3:
                $query->orderBy('name', 'asc');
                break;
            case 4:
                $query->orderBy('name', 'desc');
                break;
        }

        if ($section_id)
            $sectionName = Section::find($section_id)->name;

        $items = $query->paginate(24)->withQueryString()->appends(['section' => $section_id]);

        $sections = self::loadSections();
        $categories = self::loadCategories();

        return view('items/index', compact('items', 'sections', 'categories', 'sectionName'));
    }

    public function create()
    {
        $categories = category::all();
        $sections = section::all();

        return view('items/create', compact('categories', 'sections'));
    }

    public function store(request $request)
    {
        $proprietaryRequest = new ProprietaryRequest();
        $itemRequest = new StoreItemRequest();
        $tagRequest = new TagRequest();
        $extraRequest = new ExtraRequest();
        $componentRequest = new ComponentRequest();

        $proprietaryData = $request->validate($proprietaryRequest->rules(), $proprietaryRequest->messages());
        $itemData = $request->validate($itemRequest->rules(), $itemRequest->messages());
        $tagData = $request->validate($tagRequest->rules(), $tagRequest->messages());
        $extraData = $request->validate($extraRequest->rules(), $extraRequest->messages());
        $componentData = $request->validate($componentRequest->rules(), $componentRequest->messages());

        $proprietary = Proprietary::where('contact', '=', $proprietaryData['contact'])->first();

        if (!$proprietary)
            $proprietary = self::storeProprietary($proprietaryData);

        if ($request->image) {
            $path = $request->image->store('items');
            $itemData['image'] = Storage::disk('s3')->url($path);
        }

        $item = self::storeItem($itemData, $proprietary);

        self::storeMultipleTag($request, $item);

        self::storeMultipleExtra($request, $item, $proprietary);

        self::storeMultipleComponent($request, $item, $componentData);

        return redirect()->route('items.create')->with('success', 'Agradecemos pelo seu tempo! Analisaremos sua contribuição antes de adicionarmos ao nosso museu.');
    }

    public function show($id)
    {
        $item = Item::find($id);
        $sections = Section::get();
        $categories = Category::get();

        return view('items.show', compact('item', 'sections', 'categories'));
    }

    public function edit(item $item)
    {
        //
    }

    public function storeProprietary($proprietaryData)
    {
        $proprietary = Proprietary::create($proprietaryData);

        return $proprietary;
    }

    public function storeItem($itemData, $proprietary)
    {
        $itemData['proprietary_id'] = $proprietary->id;
        $itemData['identification_code'] = '000';

        $item = DB::transaction(function () use ($itemData){

            $item = Item::create($itemData);

            $itemData['identification_code'] = self::createIdentificationCode($item);

            $item->update($itemData);

            return $item;
        });

        return $item;
    }

    public function storeMultipleTag($request, $item)
    {
        foreach((array) $request->tags as $key => $data) {
            $tag = Tag::where('category_id', '=', $data['category_id'])->where('name', '=', $data['name'])->first();

            if (is_null($tag))
                $tag = Tag::create($data);

            $item->tags()->attach($tag->id);
        }
    }

    public function storeMultipleExtra($request, $item, $proprietary)
    {
        foreach((array) $request->extras as $key => $data) {
            $data['proprietary_id'] = $proprietary->id;
            $data['item_id'] = $item->id;

            $extra = Extra::create($data);
        }
    }

    public function storeMultipleComponent($request, $item, $componentData)
    {
        foreach((array) $request->components as $key => $data) {
            $component = Item::where('section_id', '=', $data['category_id'])
                            ->where('name', '=', $data['name'])
                            ->first();

            $data['component_id'] = $component->id;
            $data['item_id'] = $item->id;

            $extra = ItemComponent::create($data);
        }
    }

    public function loadCategories()
    {
        $data = Category::orderBy('name', 'asc')->get();

        return $data;
    }

    public function loadTags($category)
    {
        $data = Tag::where('validation', true)->where('category_id', $category)->orderBy('name', 'asc')->get();

        return $data;
    }

    public function loadSections()
    {
        $data = Section::orderBy('name', 'asc')->get();

        return $data;
    }

    public function storeSingleTag(SingleTagRequest $request)
    {
        $data = $request->validated();

        $tag = Tag::where('category_id', '=', $data['category_id'])->where('name', '=', $data['name'])->first();

        if (is_null($tag))
            $tag = Tag::create($data);

        $item = Item::find($request->item_id);

        $item->tags()->attach($tag->id);

        return back()->with('success', 'Nova associação com etiqueta enviada com sucesso! Agradecemos pelo seu tempo, analisaremos sua proposta antes de adicionarmos ao nosso museu.');
    }

    public function storeSingleExtra(SingleExtraRequest $request)
    {
        $proprietaryRequest = new ProprietaryRequest();
        $proprietaryData = $request->validate($proprietaryRequest->rules(), $proprietaryRequest->messages());

        $data = $request->validated();
        $data['validation'] = 0;

        $proprietary = Proprietary::where('contact', $proprietaryData['contact'])->first();

        if (!$proprietary)
            $proprietary = self::storeProprietary($proprietary);

        $data['proprietary_id'] = $proprietary->id;

        $extra = Extra::create($data);
        return back()->with('success', 'Curiosidade extra enviada com sucesso! Agradecemos pelo seu tempo, analisaremos sua proposta antes de adicionarmos ao nosso museu.');
    }

    public function storeSingleComponent(SingleComponentRequest $request)
    {
        $data = $request->validated();

        $component = Item::where('section_id', '=', $request->section_id)
                            ->where('name', '=', $request->component_name)
                            ->first();

        $validator = Validator::make(['component_id' => $component->id], [
            'component_id' => [
                'integer',
                'numeric',
                'exists:items,id',
                new DifferentIds([$component->id, $data['item_id']])
            ]
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $data['validation'] = 0;
        $data['component_id'] = $component->id;

        $component = ItemComponent::create($data);
        return back()->with('success', 'Nova associação com componente enviada com sucesso! Agradecemos pelo seu tempo, analisaremos sua proposta antes de adicionarmos ao nosso museu.');
    }

    public function storeContribution(ContributionRequest $request)
    {
        $proprietaryRequest = new ProprietaryRequest();
        $proprietaryData = $request->validate($proprietaryRequest->rules(), $proprietaryRequest->messages());

        $data = $request->validated();
        $data['validation'] = 0;

        $proprietary = Proprietary::where('contact', $proprietaryData['contact'])->first();

        if (!$proprietary)
            $proprietary = self::storeProprietary($proprietaryData);

        $data['proprietary_id'] = $proprietary->id;

        $contribution = Contribution::create($data);
        return back()->with('success', 'Contribuição enviada com sucesso! Agradecemos pelo seu tempo, analisaremos sua proposta antes de adicionarmos ao nosso museu.');
    }

    public function createIdentificationCode(Item $item)
    {
        $section = Section::find($item->section_id)->name;

        $proprietaryCode = 'PREX';

        $sectionCode = strtoupper(substr($section, 0, 2));
        $sectionCode .= strtoupper(substr($section, -2));

        return $proprietaryCode . '_' . $sectionCode . '_' . $item->id;
    }
}
