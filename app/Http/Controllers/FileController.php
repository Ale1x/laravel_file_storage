<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function handleUpload(Request $request) {
        try {

            $user = User::where('id', auth()->id())->first();
            
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            [$class, $subject, $chapter, $actualFileName] = explode('_', pathinfo($fileName, PATHINFO_FILENAME)); 

            // Salva il file in una cartella temporanea
            $tempPath = $file->storeAs('temp', $fileName);

            $folderPath = "$class/$subject/$chapter";
            $actualFileNameWithExtension = "$actualFileName.$extension"; 

            // Legge il contenuto del file temporaneo
            $content = base64_encode(Storage::get($tempPath));

            Log::info('Tentativo di caricare il file su GitHub');
            
            $outputContent = base64_decode($content);

            // Configura il token GitHub per l'utente corrente
            config(['github.connections.main.token' => $user->github_token]);

            GitHub::repo()->contents()->create(
                $user->commiter_name,
                $user->repository_name,
                "$folderPath/$actualFileNameWithExtension",
                $outputContent,
                $user->commit_message
            );

            // Rimuove il file temporaneo
            Storage::delete($tempPath);

            Log::info('File caricato con successo');

            return redirect('/upload')->with('status', 'File Caricato con successo!');
        } catch (\Exception $e) {
            Log::error("Errore nel caricamento del file: {$e->getMessage()}");

            Log::info('Token GitHub: ' . $user->github_token);
            Log::info('Commiter Name: ' . $user->commiter_name);
            Log::info('Repository Name: ' . $user->repository_name);

            return redirect('/upload')->with('status', 'Errore nel caricamento del file');
        }
    }
    
}
