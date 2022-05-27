<?php

namespace App\Http\Controllers\Form;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class FormsController extends Controller
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
            $forms = Form::where('activity', 'LIKE', "%$keyword%")
                ->orWhere('facebook', 'LIKE', "%$keyword%")
                ->orWhere('instagram', 'LIKE', "%$keyword%")
                ->orWhere('souq', 'LIKE', "%$keyword%")
                ->orWhere('twitter', 'LIKE', "%$keyword%")
                ->orWhere('country', 'LIKE', "%$keyword%")
                ->orWhere('range', 'LIKE', "%$keyword%")
                ->orWhere('company', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $forms = Form::latest()->paginate($perPage);
        }

        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forms.create');
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

        Form::create($requestData);

        return json_encode(true);
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
        $form = Form::findOrFail($id);

        return view('forms.show', compact('form'));
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
        $form = Form::findOrFail($id);

        return view('forms.edit', compact('form'));
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

        $form = Form::findOrFail($id);
        $form->update($requestData);

        return redirect('forms')->with('flash_message', 'Form updated!');
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
        Form::destroy($id);

        return redirect('forms')->with('flash_message', 'Form deleted!');
    }
}
