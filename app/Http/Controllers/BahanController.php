<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Http::get(Config::get('app.api_url').'/api/bahan');

        if ($search = $request->query('search')) {
            $response = Http::get(Config::get('app.api_url').'/api/bahan?search='.$search);
        }
        
        return view('data-master.bahan.data', [
            'bahan' => json_decode($response->body())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get(Config::get('app.api_url').'/api/bahan/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return view('data-master.bahan.edit', [
            'bahan' => json_decode($response->body())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(Config::get('app.api_url').'/api/bahan/'.$id, $request->all());
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            if ($response->status() == 422) {
                $errors = $resBody->errors;
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('bahan.index')->withSuccess($resBody->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->delete(Config::get('app.api_url').'/api/bahan/'.$id);
        $resBody = json_decode($response->body());

        if (!$response->successful()) {
            return redirect()->back()->withErrors($resBody->message??'Error')->withInput();
        }

        return redirect()->route('bahan.index')->withSuccess($resBody->message);
    }
}
