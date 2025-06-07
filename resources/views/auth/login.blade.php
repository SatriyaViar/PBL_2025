<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accreditation System - Login</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: rgba(74, 85, 104, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 380px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 5px 0;
        }

        .logo-container img {
            width: 130px;
            height: 130px;
            border-radius: 20%;
            object-fit: contain;
        }

        .login-title {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            background: rgba(45, 55, 72, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            color: #ffffff;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            background: rgba(45, 55, 72, 0.9);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 400;
        }

        .form-control.is-invalid {
            border-color: #fc8181 !important;
        }

        .invalid-feedback {
            color: #fc8181;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: block;
        }

        .custom-control {
            position: relative;
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            width: 1rem;
            height: 1.25rem;
            opacity: 0;
        }

        .custom-control-label {
            position: relative;
            margin-bottom: 0;
            vertical-align: top;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
        }

        .custom-control-label::before {
            position: absolute;
            top: 0.25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            pointer-events: none;
            content: "";
            background-color: rgba(45, 55, 72, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.25rem;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: rgba(45, 55, 72, 0.9);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .custom-control-input:checked~.custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='m6.564.75-3.59 3.612-1.538-1.55L0 4.26l2.974 2.99L8 2.193z'/%3e%3c/svg%3e");
        }

        .custom-control-label::after {
            position: absolute;
            top: 0.25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background: no-repeat 50%/50% 50%;
        }

        .btn-login {
            width: 100%;
            background: rgba(45, 55, 72, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            cursor: pointer;
            outline: none;
        }

        .btn-login:hover {
            background: rgba(45, 55, 72, 1);
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .btn-home {
            width: 100%;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            cursor: pointer;
        }

        .btn-home:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
            text-decoration: none;
        }

        .copyright {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            font-weight: 400;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 1.5rem;
            padding: 0.75rem 1rem;
        }

        .alert ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        .alert li:last-child {
            margin-bottom: 0;
        }

        .alert-danger {
            background: rgba(245, 101, 101, 0.2);
            color: #fc8181;
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.2);
            color: #68d391;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .login-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="polinema.png"
                onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'><circle cx=\'50\' cy=\'50\' r=\'45\' fill=\'%234a5568\'/><text x=\'50\' y=\'55\' text-anchor=\'middle\' fill=\'white\' font-size=\'20\' font-family=\'Arial\'>P</text></svg>'"
                width="70" height="70" alt="Polinema Logo">
        </div>

        <!-- Title -->
        <h2 class="login-title">Accreditation</h2>

        <!-- Alert Messages (Demo) -->
        <div class="alert alert-success" style="display: none;">
            Login successful!
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- Login Form -->
        <form method="POST" action="{{ url('login') }}" id="form-login">
            @csrf
            <!-- Username Field -->
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                    value="" required autofocus>
                <div class="invalid-feedback" style="display: none;">
                    Username is required.
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                <div class="invalid-feedback" style="display: none;">
                    Password is required.
                </div>
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                    <label class="custom-control-label" for="remember">Remember Me</label>
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <!-- Back to Home Button -->
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-home"></i> Back to Home Page
        </a>

        <!-- Copyright -->
        <div class="copyright">
            © Polinema Student 2025
        </div>
    </div>

   <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else { // jika error
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
