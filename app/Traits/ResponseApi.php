<?php 

namespace App\Traits;

trait ResponseApi
{
    
    protected $msg = [
        'errorother'             => 'Maaf ada kesalahan yang tidak terdeteksi',
        'errorfind'         => 'Tidak dapat menemukan data ',
        'succshow'          => 'Berhasil mengambil data',
        'succstore'         => 'Data berhasil disimpan',
        'succupdate'        => 'Data berhasil diperbarui',
        'succdestroy'       => 'Data berhasil dihapus',
        'errorforeignkey'   => 'Maaf data tidak dapat dihapus, karena terdapat data yang berhubungan dengan data ini'
    ];

    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        if(!$message){
            return response(['message' => 'Message is required'], 500);
        }

        if($isSuccess){
            return response([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'data' => $data,
            ], $statusCode);
        } 

        return response([
            'message' => $message,
            'error' => true,
            'code' => $statusCode,
        ], $statusCode);
    }

    public function responseSuccess($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    public function responseError($message = null, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}