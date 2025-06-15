<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Polinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-[#213448] flex items-center justify-center min-h-screen">
  <div class="bg-[#547792] shadow-lg rounded-xl px-10 py-8 w-full max-w-sm text-center text-white">
    <p class="text-white font-medium text-xl mb-6">Accreditation</p>
    <img src="/poltek.png" alt="Polinema Logo" class="mx-auto mb-8 w-40" />

    <!-- Alert Box -->
    <div id="alert" class="hidden mb-4 p-3 rounded text-sm font-semibold"></div>

    <!-- Login Form -->
    <form id="loginForm">
      <div class="mb-4 text-left">
        <label class="block text-white mb-1">Username</label>
        <input type="text" id="username" name="username" required
          class="w-full px-4 py-2 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div class="mb-6 text-left">
        <label class="block text-white mb-1">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <button type="submit"
        class="block w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200 mb-3">
        Login
      </button>
    </form>

    <a href="/" class="block w-full bg-gray-500 text-white font-semibold py-2 rounded-md hover:bg-gray-600 transition duration-200 text-center">
      Back to Home Page
    </a>

    <p class="mt-6 text-gray-300 text-sm">© Polinema Student 2025</p>
  </div>

  <script>
    $('#loginForm').on('submit', function(e) {
      e.preventDefault();

      let username = $('#username').val();
      let password = $('#password').val();
      let alertBox = $('#alert');

      // Clear alert
      alertBox.removeClass().addClass('hidden').text('');

      $.ajax({
        url: '/login',
        type: 'POST',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          username: username,
          password: password
        },
        success: function(response) {
          alertBox
            .removeClass()
            .addClass('mb-4 p-3 rounded bg-green-500 text-white')
            .text('Login berhasil! Mengarahkan...');
          setTimeout(() => {
            window.location.href = '/dashboard';
          }, 1500);
        },
        error: function(xhr) {
          let errorMsg = 'Login gagal. Cek username/password.';

          if (xhr.status === 422) {
            const errors = xhr.responseJSON.errors;
            if (errors) {
              errorMsg = Object.values(errors)
                .map(msgs => msgs.join(', '))
                .join(', ');
            }
          } else if (xhr.responseJSON?.message) {
            errorMsg = xhr.responseJSON.message;
          }

          alertBox
            .removeClass()
            .addClass('mb-4 p-3 rounded bg-red-500 text-white')
            .text(errorMsg);
        }
      });
    });
  </script>
</body>
</html>
