<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResepRequest;
use App\Models\Resep;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResepApiController extends Controller
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
            $resep = Resep::latest()->with(['kategori', 'bahan'])->get();

            if($search = $request->query('search')){
                $resep = Resep::where('nama', 'LIKE', '%'.$search.'%')->latest()->with(['kategori', 'bahan'])->get();
            }
            
            return $this->responseSuccess($this->msg['succshow'], $resep);

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
    public function store(ResepRequest $request)
    {
        try {
            $resep = Resep::create($request->validated());
            $resep->bahan()->attach($request->bahan);
            return $this->responseSuccess($this->msg['succupdate'], $resep);

        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $resep = Resep::where('id', $id)->with(['kategori', 'bahan'])->firstOrFail();
            return $this->responseSuccess($this->msg['succshow'], $resep);

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
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(ResepRequest $request, $id)
    {
        try {
            $resep = Resep::findOrFail($id);
            $resep->bahan()->sync($request->bahan);
            $resep->update($request->validated());
            return $this->responseSuccess($this->msg['succupdate'], $resep);

        } catch (ModelNotFoundException $a) {
            return $this->responseError($this->msg['errorfind'], 404);
        } catch (Exception $e) {
            return $this->responseError($this->msg['errorother'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $resep = Resep::findOrFail($id);
            $resep->bahan()->detach();
            $resep->delete();
            return $this->responseSuccess($this->msg['succdestroy'], $resep);

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
