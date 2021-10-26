<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BahanRequest;
use App\Models\Bahan;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BahanApiController extends Controller
{
    use ResponseApi;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $bahan = Bahan::latest()->with('resep')->get();

            if($search = $request->query('search')){
                $bahan = Bahan::where('bahan', 'LIKE', '%'.$search.'%')->latest()->with('resep')->get();
            }

            return $this->responseSuccess($this->msg['succshow'], $bahan);

        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BahanRequest $request)
    {
        try {
            $bahan = Bahan::create($request->validated());
            return $this->responseSuccess($this->msg['succstore'], $bahan);

        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $bahan = Bahan::where('id', $id)->with('resep')->firstOrFail();
            return $this->responseSuccess($this->msg['succshow'], $bahan);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function update(BahanRequest $request, $id)
    {
        try {
            $bahan = Bahan::findOrFail($id)->update($request->validated());
            return $this->responseSuccess($this->msg['succupdate'], $bahan);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $bahan = Bahan::findOrFail($id)->delete();
            return $this->responseSuccess($this->msg['succdestroy'], $bahan);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch(QueryException $b) {
            if($b->getCode() === '23000') {
                return $this->responseError($this->msg['errorforeignkey'].', masih terdapat resep yang menggunakan bahan ini', 500);
            } 
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }
}
