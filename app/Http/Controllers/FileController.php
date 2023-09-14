<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{

    public function handleUpload(Request $request) {
        try {

            $user = User::where('id', auth()->id())->first();
            
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            [$class, $subject, $chapter, $actualFileName] = explode('_', pathinfo($fileName, PATHINFO_FILENAME)); 

            $folderPath = "$class/$subject/$chapter";
            $actualFileNameWithExtension = "$actualFileName.$extension"; // aggiunta l'estensione
            $content = base64_encode(file_get_contents($file)); // codifica in base64

            Log::info('Tentativo di caricare il file su GitHub');
            
            $outputContent = base64_decode($content);   
            
            config(['github.connections.main.token' => $user->github_token]);

            GitHub::repo()->contents()->create(
                $user->commiter_name,  
                $user->repository_name,  
                "$folderPath/$actualFileNameWithExtension",
                $outputContent,
                $user->commit_message
            );

            Log::info('File caricato con successo');

            return redirect('/upload')->with('status', 'File Caricato con successo!');
        } catch (\Exception $e) {
            Log::error("Errore nel caricamento del file: {$e->getMessage()}");
            return redirect('/upload')->with('status', 'Errore nel caricamento del file');
        }
    }
    
}
