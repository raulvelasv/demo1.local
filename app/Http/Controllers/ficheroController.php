<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FileRequest;
use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\GenericProvider;

class FicheroController extends Controller
{
    public function upload(FileRequest $request)
    {
        $url = env('MAYAN_URL');

        Http::withBasicAuth(env('MAYAN_USER'), env('MAYAN_PASSWORD'))
            ->attach(
                'file',
                file_get_contents($request->file('file')->path()),
                $request->file('file')->getClientOriginalName()
            )
            ->post($url, [
                'label' => $request->label,
                'description' => $request->description,
                'document_type_id' => 1,
            ]);
        return redirect()->route('upload.get')->with('message', 'Archivo subido correctamente');
    }
    public function uploadOneDrive(Request $request)
    {
        // Configure your OAuth settings
        $provider = new GenericProvider([
            'clientId'                => '6ffea808-e1ff-4382-9920-97eff3dcffb8',
            'clientSecret'            => '',
            'redirectUri'             => 'https://login.microsoftonline.com/common/oauth2/nativeclient',
            'urlAuthorize'            => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken'          => 'https://login.microsoftonline.com/F8cdef31-a31e-4b4a-93e4-5f571e91255a/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes'                  => 'files.readwrite'
        ]);
        // Obtain an access token
        $accessToken = $provider->getAccessToken('client_credentials');

        // Prepare the file for upload
        $filePath = $request->file('file')->path();
        $fileContent = file_get_contents($filePath);
        $fileName = $request->file('file')->getClientOriginalName();

        // Set up the API request
        $client = new Client();
         $client->request('PUT', "https://graph.microsoft.com/v1.0/me/drive/root:/{$fileName}:/content", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->getToken(),
                'Content-Type'  => 'text/plain',
            ],
            'body' => $fileContent,
        ]);

        return redirect()->route('uploadOnedrive.get')->with('message', 'Archivo subido correctamente');
    }
}

