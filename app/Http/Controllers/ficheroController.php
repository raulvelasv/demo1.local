<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FileRequest;
class FicheroController extends Controller
{
    public function upload(FileRequest $request)
    {
        $url = env('MAYAN_URL');

        Http::withBasicAuth(env('MAYAN_USER'),env('MAYAN_PASSWORD'))
                        ->attach(
                            'file', file_get_contents($request->file('file')->path()), $request->file('file')->getClientOriginalName()
                        )
                        ->post($url, [
                            'label' => $request->label,
                            'description' => $request->description,
                            'document_type_id' => 1,
                        ]);
        return redirect()->route('upload.get')->with('message', 'Archivo subido correctamente');
    }

}
