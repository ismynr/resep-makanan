<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Http::get(Config::get('app.api_url').'/api/kategori');

        if ($search = $request->query('search')) {
            $response = Http::get(Config::get('app.api_url').'/api/kategori?search='.$search);
        }
        
        return view('data-master.kategori.data', [
            'kategori' => json_decode($response->body())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-master.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(Config::get('app.api_url').'/api/kategori/', $request->all());
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            if ($response->status() == 422) {
                $errors = $resBody->errors;
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('kategori.index')->withSuccess($resBody->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get(Config::get('app.api_url').'/api/kategori/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return view('data-master.kategori.edit', [
            'kategori' => json_decode($response->body())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(Config::get('app.api_url').'/api/kategori/'.$id, $request->all());
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            if ($response->status() == 422) {
                $errors = $resBody->errors;
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('kategori.index')->withSuccess($resBody->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->delete(Config::get('app.api_url').'/api/kategori/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('kategori.index')->withSuccess($resBody->message);
    }
}
