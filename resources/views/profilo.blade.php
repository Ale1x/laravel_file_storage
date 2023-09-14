<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profilo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 py-20">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-8">
        <h1 class="text-2xl mb-6 text-center">Aggiorna il tuo Profilo</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <form action="{{ route('profilo.update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="github_token" class="block text-sm font-medium text-gray-600">Token Github</label>
                <input type="text" id="github_token" name="github_token" class="mt-1 p-2 w-full rounded-md border" value="{{ $user->github_token }}" required>
            </div>

            <div class="mb-4">
                <label for="commiter_name" class="block text-sm font-medium text-gray-600">Nome Commitente</label>
                <input type="text" id="commiter_name" name="commiter_name" class="mt-1 p-2 w-full rounded-md border" value="{{ $user->commiter_name }}" required>
            </div>

            <div class="mb-4">
                <label for="repository_name" class="block text-sm font-medium text-gray-600">Nome Repository</label>
                <input type="text" id="repository_name" name="repository_name" class="mt-1 p-2 w-full rounded-md border" value="{{ $user->repository_name }}" required>
            </div>

            <div class="mb-4">
                <label for="commit_message" class="block text-sm font-medium text-gray-600">Messaggio Commit</label>
                <input type="text" id="commit_message" name="commit_message" class="mt-1 p-2 w-full rounded-md border" value="{{ $user->commit_message }}" required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="/upload" class="bg-gray-400 text-white p-3 rounded-md hover:bg-gray-500">
                    Annulla
                </a>
                <button type="submit" class="bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600">
                    Aggiorna Profilo
                </button>
            </div>
        </form>
    </div>
</body>
</html>
