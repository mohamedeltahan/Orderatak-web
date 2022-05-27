<?php

namespace App\Http\Controllers\Unavailable_alert;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Unavailable_alert;
use Illuminate\Http\Request;

class Unavailable_alertsController extends Controller
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
            $unavailable_alerts = Unavailable_alert::where('state', 'LIKE', "%$keyword%")
                ->orWhere('order_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('item_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $unavailable_alerts = Unavailable_alert::latest()->paginate($perPage);
        }

        return view('unavailable_alerts.index', compact('unavailable_alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('unavailable_alerts.create');
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
        
        Unavailable_alert::create($requestData);

        return redirect('unavailable_alerts')->with('flash_message', 'Unavailable_alert added!');
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
        $unavailable_alert = Unavailable_alert::findOrFail($id);

        return view('unavailable_alerts.show', compact('unavailable_alert'));
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
        $unavailable_alert = Unavailable_alert::findOrFail($id);

        return view('unavailable_alerts.edit', compact('unavailable_alert'));
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
        
        $unavailable_alert = Unavailable_alert::findOrFail($id);
        $unavailable_alert->update($requestData);

        return redirect('unavailable_alerts')->with('flash_message', 'Unavailable_alert updated!');
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
        Unavailable_alert::destroy($id);

        return redirect('unavailable_alerts')->with('flash_message', 'Unavailable_alert deleted!');
    }
}
