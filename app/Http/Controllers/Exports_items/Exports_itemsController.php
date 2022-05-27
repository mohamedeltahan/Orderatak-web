<?php

namespace App\Http\Controllers\Exports_items;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Exports_item;
use Illuminate\Http\Request;

class Exports_itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $exports_items = Exports_item::where('name_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('buying_price', 'LIKE', "%$keyword%")
                ->orWhere('selling_price', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('export_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $exports_items = Exports_item::latest()->paginate($perPage);
        }

        return view('exports_items.index', compact('exports_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('exports_items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Exports_item::create($requestData);

        return redirect('exports_items')->with('flash_message', 'Exports_item added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $exports_item = Exports_item::findOrFail($id);

        return view('exports_items.show', compact('exports_item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $exports_item = Exports_item::findOrFail($id);

        return view('exports_items.edit', compact('exports_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $exports_item = Exports_item::findOrFail($id);
        $exports_item->update($requestData);

        return redirect('exports_items')->with('flash_message', 'Exports_item updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Exports_item::destroy($id);
            
        if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["state"]=1;
            return json_encode(["data"=>$returned_obj],JSON_UNESCAPED_UNICODE);
        }

        return redirect('exports');
    }
}
