<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Http::get(Config::get('app.api_url').'/api/resep');

        if ($search = $request->query('search')) {
            $response = Http::get(Config::get('app.api_url').'/api/resep?search='.$search);
        }
        
        return view('data-resep.data', [
            'resep' => json_decode($response->body())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Http::get(Config::get('app.api_url').'/api/kategori');
        $resBodyKategori = json_decode($kategori->body());
        
        if (!$kategori->successful()) {
            return redirect()->back()->withErrors($resBodyKategori->message??'Error')->withInput();
        }

        return view('data-resep.create', [
            'kategori' => $resBodyKategori
        ]);
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
        ])->post(Config::get('app.api_url').'/api/resep/', $request->all());
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            if ($response->status() == 422) {
                $errors = $resBody->errors;
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('resep.index')->withSuccess($resBody->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get(Config::get('app.api_url').'/api/resep/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return view('data-resep.show', [
            'resep' => json_decode($response->body())
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get(Config::get('app.api_url').'/api/resep/'.$id);
        $resBody = json_decode($response->body());

        $kategori = Http::get(Config::get('app.api_url').'/api/kategori');
        $resBodyKategori = json_decode($kategori->body());

        if (!$response->successful() || !$kategori->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return view('data-resep.edit', [
            'resep' => $resBody,
            'kategori' => $resBodyKategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(Config::get('app.api_url').'/api/resep/'.$id, $request->all());
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            if ($response->status() == 422) {
                $errors = $resBody->errors;
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('resep.index')->withSuccess($resBody->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->delete(Config::get('app.api_url').'/api/resep/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('resep.index')->withSuccess($resBody->message);
    }
}
