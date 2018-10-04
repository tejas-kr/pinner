<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pin;
use Auth;

class PinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::where('user_id', Auth::user()->id)
                    ->orderBy('updated_at', 'desc')
                    ->paginate(10);
        return view('pins.index')->with('pins', $pins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pins.create');      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'url' => 'required'
        ]);
        $pin = new Pin();
        $pin->title = $request->input('title');
        $pin->url = $request->input('url');
        $pin->user_id = Auth::user()->id;

        $pin->save();
        echo json_encode(['success' => 1, 'id' => $pin->id]);
    }

    /**
     * Store the thumbnail data
     * scraped from web.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function save_link_data(Request $request)
    {
        ignore_user_abort();
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->input('id');
        $pin = Pin::where('id', $id);
        $data = scrape_webpage($pin->url);
        $pin->text = $data['text'];
        $pin->img = $data['img'];
        $pin->save();

        echo 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
