<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**Librerias para conversion**/
use App\Models\media;
use App\Libreria\VoiceRSS;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Response;
/****************************/

class textovozController extends Controller
{
    //
    public function inicio()
    {
        return view('inicio');
    }
    //Funcion convertir texto
    public function convertir(Request $request)
    {	

    $request->validate([
        'text' => 'required|string|max:500',
        "lan" => "required",		    
    ]);

     DB::beginTransaction();

     try {		
         
         $tts = new VoiceRSS;
         $voice = $tts->speech([
             'key' => env('VOICE_RSS_API_KEY'),
             'hl' =>  $request->lan,
             'src' => $request->text,
             'r' => '0',
             'c' => 'mp3',
             'f' => '44khz_16bit_stereo',
             'ssml' => 'false',
             'b64' => 'false'
         ]);	
             
         $filename = Str::uuid().'.mp3';
         if( empty($voice["error"]) ) {		

             $rawData = $voice["response"];	
             
             if (!File::exists(public_path('media')))
             {
                 Storage::makeDirectory(public_path('media'));
             }

             Storage::disk('audio')->put($filename, $rawData);
             $speechFilelink =  asset('media/'.$filename);							   		                 
                $urls["play-url"] = $speechFilelink;		   	
                $urls["download-file"] = $filename;	
                
                //Guardar datos en Tabla
                $tabla = new media;
                $tabla->descripcion = $request->text;
                $tabla->media = $filename;
                $tabla->save();

                DB::commit();

             $data = array('status' => 200, 'responseText' => $urls);
             return response()->json($data);		
         }

            $data = array('status' => 400, 'responseText' => "Por favor, intente de Nuevo!");

        return response()->json($data);     

     } 
     catch (SitemapParserException $e) {
        $data = array('status' => 400, 'responseText' => $e->getMessage());
        return response()->json($data);
     }                     
    }

    public function listado(Request $request)
    {
		$response['success']  = 'true';
		$response['data']  = media::orderby('id','DESC')->get()->toArray();
		return Response::json($response, 200);
    }
}
