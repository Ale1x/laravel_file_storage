<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{

    public function handleUpload(Request $request) {
        try {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            [$subject, $chapter, $actualFileName] = explode('_', $fileName);

            $folderPath = "$subject/$chapter";
            $content = file_get_contents($file);

            Log::info('Tentativo di caricare il file su GitHub');

            GitHub::repo()->contents()->create(
                'username',  // sostituisci con l'username dinamico
                'repository',  // sostituisci con il nome della repository dinamico
                "$folderPath/$actualFileName",
                base64_encode($content),
                'File caricato!'
            );

            Log::info('File caricato con successo');

            return redirect('/upload')->with('status', 'File Caricato con successo!');
        } catch (\Exception $e) {
            Log::error("Errore nel caricamento del file: {$e->getMessage()}");
            return redirect('/upload')->with('status', 'Errore nel caricamento del file');
        }
    }

    
}
