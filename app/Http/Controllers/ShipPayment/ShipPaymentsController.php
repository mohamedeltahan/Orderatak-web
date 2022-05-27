<?php

namespace App\Http\Controllers\ShipPayment;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\ShipPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipPaymentsController extends Controller
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
            $shippayments = ShipPayment::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('ship_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('method', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('deserved_amount', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $shippayments = ShipPayment::latest()->paginate($perPage);
        }

        return view('ship-payments.index', compact('shippayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('ship-payments.create');
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

        try {    
            $requestData = $request->all();
            $requestData["user_id"]=Auth::id();
            $payment=ShipPayment::create($requestData);
            $payment=ShipPayment::find($payment->id);

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["payment"]=$payment;
                return json_encode(["data"=>$payment,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("ship_orders",["id"=>$request->ship_id,"tag"=>"ship-payments-tab"]);
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        }
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
        $shippayment = ShipPayment::findOrFail($id);

        return view('ship-payments.show', compact('shippayment'));
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
        $shippayment = ShipPayment::findOrFail($id);

        return view('ship-payments.edit', compact('shippayment'));
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
        
        $shippayment = ShipPayment::findOrFail($id);
        $shippayment->update($requestData);

        return redirect('ship-payments')->with('flash_message', 'ShipPayment updated!');
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
        try {
            ShipPayment::destroy($id);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["state"]=1;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }


            return redirect()->back();
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
