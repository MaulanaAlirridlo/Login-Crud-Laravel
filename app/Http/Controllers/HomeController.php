<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kebun = Kebun::all();
        return view('home', compact('kebun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'luas' => 'required|numeric',
        ]);

        Kebun::create($request->all());
        return redirect()->back();
    }

    public function edit(Kebun $kebun)
    {
        return json_encode($kebun);
    }

    public function update(Request $request, Kebun $kebun)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'luas' => 'required|numeric',
        ]);
        Kebun::where('kode', $kebun->kode)->update($request->except(['_token', '_method']));
        return redirect()->back();
    }

    public function destroy(Kebun $kebun)
    {
        Kebun::destroy($kebun->kode);
        return redirect()->back();
    }
}
