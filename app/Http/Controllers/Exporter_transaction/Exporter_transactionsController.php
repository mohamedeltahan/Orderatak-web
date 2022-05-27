<?php

namespace App\Http\Controllers\Exporter_transaction;

use App\Export;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Exporter_transaction;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Exporter_transactionsController extends Controller
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
            $exporter_transactions = Exporter_transaction::where('receipt_id', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('paid_at', 'LIKE', "%$keyword%")
                ->orWhere('details', 'LIKE', "%$keyword%")
                ->orWhere('export_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('method', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $exporter_transactions = Exporter_transaction::latest()->paginate($perPage);
        }

        return view('exporter_transactions.index', compact('exporter_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('exporter_transactions.create');
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
       /* if($request->paid>Export::find($request->export_id)->rest()){
            return redirect()->back()->withErrors("المبلغ المدفوع اكبر من المبلغ المطلوب !!");
        }
*/
       $requestData["user_id"] = Auth::id();

        Exporter_transaction::create($requestData);
        $payment=new Payment();
        $payment->method="نقدي";
        $payment->receipt_id=$request->receipt_id;
        $payment->paid_at=$request->date;
        $payment->paid=$request->paid;

        $payment->details=$request->details;
        $payment->exporter_id=Export::find($request->export_id)->exporter_id;
        $payment->save();

        return redirect()->back();
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
        $export=Export::find($id);

        return view("exporter_transactions.index",compact("export"));
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
        $exporter_transaction = Exporter_transaction::findOrFail($id);

        return view('exporter_transactions.edit', compact('exporter_transaction'));
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

        $exporter_transaction = Exporter_transaction::findOrFail($id);
        $exporter_transaction->update($requestData);

        return redirect('exporter_transactions')->with('flash_message', 'Exporter_transaction updated!');
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
        Exporter_transaction::destroy($id);

        return redirect('exporter_transactions')->with('flash_message', 'Exporter_transaction deleted!');
    }
}
