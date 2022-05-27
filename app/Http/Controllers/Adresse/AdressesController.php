<?php

namespace App\Http\Controllers\Adresse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Adress;
use Illuminate\Http\Request;

class AdressesController extends Controller
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
            $adresses = Adress::where('address', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $adresses = Adress::latest()->paginate($perPage);
        }

        return view('adresses.index', compact('adresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('adresses.create');
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
        
        Adress::create($requestData);

        return redirect('adresses')->with('flash_message', 'Adress added!');
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
        $adress = Adress::findOrFail($id);

        return view('adresses.show', compact('adress'));
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
        $adress = Adress::findOrFail($id);

        return view('adresses.edit', compact('adress'));
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
        
        $adress = Adress::findOrFail($id);
        $adress->update($requestData);

        return redirect('adresses')->with('flash_message', 'Adress updated!');
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
        Adress::destroy($id);

        return redirect('adresses')->with('flash_message', 'Adress deleted!');
    }
}
