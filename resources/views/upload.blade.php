<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>File Upload</title>
</head>
<body class="bg-gray-200 py-20">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:flex-shrink-0 p-8">
                <h3 class="text-lg font-semibold">File Upload</h3>
                <form action="/upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <input type="file" name="file" id="file" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
