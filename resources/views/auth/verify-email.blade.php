<!DOCTYPE html>
<html lang="id">
<head>
    <title>Verifikasi Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md text-center">
        <h2 class="text-2xl font-bold mb-4">Verifikasi Email Anda</h2>
        <p class="text-gray-600 mb-6">
            Terima kasih telah mendaftar! Kami telah mengirimkan tautan verifikasi ke email Anda. 
            Silakan klik tautan tersebut untuk melanjutkan.
        </p>

        <!-- Form untuk kirim ulang email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kirim Ulang Email Verifikasi
            </button>
        </form>
    </div>
</body>
</html>