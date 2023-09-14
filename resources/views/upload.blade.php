<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
                <form id="upload-form" action="/upload" method="post" enctype="multipart/form-data" class="text-center">
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
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-teal-600 bg-teal-200">
                        % Caricamento
                        </span>
                    </div>
                    <div class="text-right">
                        <span id="progress-text" class="text-xs font-semibold inline-block text-teal-600">
                        0%
                        </span>
                    </div>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-teal-200">
                    <div id="progress-bar" style="width:0%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-500"></div>
                    </div>
                </div>

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

<script>
    $(document).ready(function () {
        $("#upload-form").on("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener(
                "progress",
                function (e) {
                    if (e.lengthComputable) {
                    let percentComplete = (e.loaded / e.total) * 100;
                    $("#progress-bar").width(percentComplete + "%");
                    $("#progress-text").text(percentComplete + "%");
                    }
                },
                false
                );
                return xhr;
            },
            type: "POST",
            url: "/upload", // Sostituisci con il tuo URL di caricamento
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                // Qui puoi gestire la risposta del server
            },
            error: function (error) {
                console.log(error);
                // Qui puoi gestire gli errori
            },
            });
        });
    });
</script>
