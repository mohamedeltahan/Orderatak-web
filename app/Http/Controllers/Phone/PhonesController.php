<?php

namespace App\Http\Controllers\Phone;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Phone;

use App\Customer;
use App\Adress;
use Illuminate\Http\Request;

class PhonesController extends Controller
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
            $phones = Phone::where('phone', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $phones = Phone::latest()->paginate($perPage);
        }

        return view('phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('phones.create');
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
        
        Phone::create($requestData);

        return redirect('phones')->with('flash_message', 'Phone added!');
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
        $phone = Phone::findOrFail($id);

        return view('phones.show', compact('phone'));
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
        $phone = Phone::findOrFail($id);

        return view('phones.edit', compact('phone'));
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
        
        $phone = Phone::findOrFail($id);
        $phone->update($requestData);

        return redirect('phones')->with('flash_message', 'Phone updated!');
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
        Phone::destroy($id);

        return redirect('phones')->with('flash_message', 'Phone deleted!');
    }
    
    public function get_all_phone_numbers(Request $request)
    {
        return Phone::where("phone","like","%".$request->phone."%")->pluck("phone")->values();
    }
    
    public function get_phone_details(Request $request)
    {
        $phone=Phone::where("phone",$request->phone)->first();
        $customer=Customer::find($phone->customer_id);
        $customer->addresses=Adress::where("customer_id",$customer->id)->get();
        return $customer;
        
        
    }
    
}
