<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-200 py-20 relative">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden text-center relative">
        <div class="absolute top-4 right-4">
            <a href="/profilo" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-user-circle fa-2x"></i>
            </a>
        </div>
        <div class="md:flex">
            <div class="md:flex-shrink-0 p-8 mx-auto">
                <h3 class="text-lg font-semibold text-center mb-4">File Upload</h3>
                <form action="/upload" method="post" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <!-- Centra il file selector -->
                    <div class="mt-4 text-center">
                        <!-- Nascondi il selettore di file standard -->
                        <input type="file" name="file" id="file" class="hidden" required>
                        <!-- Label personalizzata -->
                        <label for="file" class="px-4 py-2 text-white bg-red-500 rounded cursor-pointer">
                            Scegli un file
                        </label>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">
                            Upload
                        </button>
                    </div>
                </form>

                @if (session('status'))
                <div class="mt-4 p-4 text-white text-center rounded {{ session('status') === 'File Caricato con successo!' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
