<?php

namespace App\Http\Controllers\Cache;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CachesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $caches=null;
        $date=$request->date;
        $income=null;
        $outcome=null;
        
        $income=Cache::where("type","إيداع")->sum("amount");
        $outcome=Cache::where("type","سحب")->sum("amount");
        $rest=$income-$outcome;

        if($date!=null){
            
        $caches=Cache::where("date",$date)->get();
            
        $income=$caches->where("type","إيداع")->where("date",$date)->sum("amount");
        
        $outcome=$caches->where("type","سحب")->where("date",$date)->sum("amount");
        
        }
        else{
            
        $caches=Cache::all();
        $income=$caches->where("type","إيداع")->sum("amount");
        
        $outcome=$caches->where("type","سحب")->sum("amount");
        }
        
        

        return view('caches.index', compact('caches',"income","outcome","date","rest"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('caches.create');
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
        $requestData["user_id"]=Auth::id();

        Cache::create($requestData);

        return redirect('caches')->with('flash_message', 'Cache added!');
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
        $cache = Cache::findOrFail($id);

        return view('caches.show', compact('cache'));
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
        $cache = Cache::findOrFail($id);

        return view('caches.edit', compact('cache'));
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

        $cache = Cache::findOrFail($id);
        $cache->update($requestData);

        return redirect('caches')->with('flash_message', 'Cache updated!');
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
        Cache::destroy($id);

        return redirect('caches')->with('flash_message', 'Cache deleted!');
    }
}
