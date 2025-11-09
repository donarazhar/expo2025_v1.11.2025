
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Check-in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-blue-600 flex items-center justify-center p-4">
    <div class="w-full max-w-2xl" x-data="{ verified: false, id: '' }">
        <div class="bg-white rounded-3xl p-8">
            <h1 class="text-3xl font-bold mb-4">Check-in Pengunjung</h1>
            
            <div x-show="!verified">
                <input type="text" 
                       x-model="id" 
                       placeholder="Masukkan ID (4 karakter)"
                       maxlength="4"
                       class="w-full border-2 p-3 rounded text-center text-2xl uppercase">
                <button @click="verified = true" 
                        class="w-full mt-4 bg-blue-600 text-white py-3 rounded font-bold">
                    Verifikasi
                </button>
            </div>
            
            <div x-show="verified">
                <p class="text-green-600 font-bold mb-4">ID Valid!</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=TEST123"
                     width="300" height="300" class="mx-auto">
                <button @click="verified = false" class="mt-4 text-blue-600">Reset</button>
            </div>
        </div>
    </div>
</body>
</html>