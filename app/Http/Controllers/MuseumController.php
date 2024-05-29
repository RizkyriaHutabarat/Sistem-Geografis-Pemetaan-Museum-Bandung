<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use App\Models\Museum;

class MuseumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $museums = Museum::all();
        return view('museums.index', [
            'museums' => $museums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('museums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "<script>console.log('Debug Objects: " . $request->namamuseum . "' );</script>";
        $museum = new Museum();
        $museum->namamuseum = $request->namamuseum;
        $museum->alamat = $request->alamat;
        $museum->longitude = $request->longitude;
        $museum->latitude = $request->latitude;
        $museum->jambuka = $request->jambuka;
        $museum->jamtutup = $request->jamtutup;
        $museum->biayamasuk = $request->biayamasuk;
        $museum->save();

        return redirect()->route('museums.index')->with('success', 'Data Museum Berhasil Ditambahkan');
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
        $museum = Museum::findOrFail($id);
        return view('museums.show', [
            'museum' => $museum
        ]);
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
        $museum = Museum::findOrFail($id);
        return view('museums.edit', [
            'museum' => $museum
        ]);
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

        $museum = Museum::findOrFail($id);
        $museum->namamuseum = $request->namamuseum;
        $museum->alamat = $request->alamat;
        $museum->longitude = $request->longitude;
        $museum->latitude = $request->latitude;
        $museum->jambuka = $request->jambuka;
        $museum->jamtutup = $request->jamtutup;
        $museum->biayamasuk = $request->biayamasuk;
        $museum->save();

        return redirect()->route('museums.index')->with('success', 'Data museum berhasil diupdate.');
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

        $museum = Museum::findOrFail($id);
        $museum->delete();

        return redirect()->route('museums.index')->with('success', 'Data museum berhasil dihapus.');
    }


    public function welcome()
    {
       $museums = Museum::all();
       return view('welcome', [
           'museums' => $museums
       ]);
    }
    
}