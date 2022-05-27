<?php

namespace App\Http\Controllers\Order_items;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order_item;
use Illuminate\Http\Request;

class Order_itemsController extends Controller
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
            $order_items = Order_item::where('name_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('selling_price', 'LIKE', "%$keyword%")
                ->orWhere('buying_price', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('order_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $order_items = Order_item::latest()->paginate($perPage);
        }

        return view('order_items.index', compact('order_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order_items.create');
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
        
        Order_item::create($requestData);

        return redirect('order_items')->with('flash_message', 'Order_item added!');
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
        $order_item = Order_item::findOrFail($id);

        return view('order_items.show', compact('order_item'));
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
        $order_item = Order_item::findOrFail($id);

        return view('order_items.edit', compact('order_item'));
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
        
        $order_item = Order_item::findOrFail($id);
        $order_item->update($requestData);

        return redirect('order_items')->with('flash_message', 'Order_item updated!');
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
        Order_item::destroy($id);

        return redirect('order_items')->with('flash_message', 'Order_item deleted!');
    }
}
