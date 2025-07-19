<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – Mock IELTS</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-xl shadow-xl max-w-md w-full text-center">
        <img src="/images/logo.png" class="w-24 mx-auto mb-6" alt="Mock IELTS Logo">

        <h2 class="text-2xl font-bold text-gray-800 mb-4">Login with Google</h2>
        <p class="text-gray-500 mb-8">No passwords. Just sign in securely with your Google account.</p>

        <a href="{{ route('google.redirect') }}"
           class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
            <img src="/images/google-icon.svg" class="w-5 h-5" alt="Google">
            Continue with Google
        </a>
    </div>
</body>
</html>
