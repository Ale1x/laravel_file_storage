<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['repo', 'write:repo_hook'])->redirect();
    }

    public function handleProviderCallback() {
        $githubUser = Socialite::driver('github')->user();
    
        // Cerca l'utente nel database tramite l'ID di GitHub
        $user = User::where('github_id', $githubUser->id)->first();
    
        // Se l'utente non esiste, crealo
        if (!$user) {
            $user = User::create([
                'github_id' => $githubUser->id,
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'username' => $githubUser->nickname,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
                'commiter_name' => $githubUser->nickname,
                'repository_name' => 'appunti-scuola',
                'commit_message' => "Aggiunto nuovo file!",
                'password' => Hash::make(Str::random(24)),
            ]);
        }
    
        // Effettua il login dell'utente
        Auth::login($user);
    
        return redirect('/upload');
    }
    

    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        return view('profilo', compact('user'));
    }

    public function update(Request $request)
    {
        // Regole di validazione
        $rules = [
            'github_token' => 'required|string',
            'commiter_name' => 'required|string',
            'repository_name' => 'required|string',
            'commit_message' => 'required|string'
        ];

        // Validazione del form di input
        $request->validate($rules);

        // Recupera o crea un nuovo profilo per l'utente corrente
        $user = User::firstOrNew(['id' => Auth::id()]);

        // Aggiorna le informazioni del profilo
        $user->github_token = $request->input('github_token');
        $user->commiter_name = $request->input('commiter_name');
        $user->repository_name = $request->input('repository_name');
        $user->commit_message = $request->input('commit_message');

        // Salva le informazioni del profilo
        $user->save();

        // Reindirizza alla pagina del profilo con un messaggio di successo
        return redirect('/profilo')->with('status', 'Profilo aggiornato con successo!');
    }
    
}
