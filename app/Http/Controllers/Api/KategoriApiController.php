<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriApiController extends Controller
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
            $kategori = Kategori::latest()->with(['resep'])->get();

            if($search = $request->query('search')){
                $kategori = Kategori::where('kategori', 'LIKE', '%'.$search.'%')->latest()->with('resep')->get();
            }
            
            return $this->responseSuccess($this->msg['succshow'], $kategori);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
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
    public function store(KategoriRequest $request)
    {
        try {
            $kategori = Kategori::create($request->validated());
            return $this->responseSuccess($this->msg['succupdate'], $kategori);

        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $kategori = Kategori::where('id', $id)->with('resep')->firstOrFail();
            return $this->responseSuccess($this->msg['succshow'], $kategori);

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
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        try {
            $kategori = Kategori::findOrFail($id)->update($request->validated());
            return $this->responseSuccess($this->msg['succupdate'], $kategori);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id)->delete();
            return $this->responseSuccess($this->msg['succdestroy'], $kategori);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch(QueryException $b) {
            if($b->getCode() === '23000') {
                return $this->responseError($this->msg['errorforeignkey'].', masih terdapat resep yang menggunakan kategori ini', 500);
            } 
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }
}
