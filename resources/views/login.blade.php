<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Polinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#213448] flex items-center justify-center min-h-screen">
  <div class="bg-[#547792] shadow-lg rounded-xl px-10 py-8 w-full max-w-sm text-center text-white">
    <!-- Accreditation Text -->
    <p class="text-white font-medium text-xl mb-6">Accreditation</p>

    <!-- Polinema Logo - Diperbesar -->
    <img src="/poltek.png" alt="Polinema Logo" class="mx-auto mb-8 w-40" />

    <!-- Username -->
    <div class="mb-4 text-left">
      <label class="block text-white mb-1">Username</label>
      <input
        type="text"
        class="w-full px-4 py-2 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

    <!-- Password -->
    <div class="mb-6 text-left">
      <label class="block text-white mb-1">Password</label>
      <input
        type="password"
        class="w-full px-4 py-2 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

    <!-- Login Button (ke dashboard) -->
    <a href="/dashboard" class="block w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200 mb-3 text-center">
      Login
    </a>

    <!-- Back to Home Button (ke landing page) -->
    <a href="/" class="block w-full bg-gray-500 text-white font-semibold py-2 rounded-md hover:bg-gray-600 transition duration-200 text-center">
      Back to Home Page
    </a>

    <!-- Footer -->
    <p class="mt-6 text-gray-300 text-sm">© Polinema Student 2025</p>
  </div>
</body>
</html>
