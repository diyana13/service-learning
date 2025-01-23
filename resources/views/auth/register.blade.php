<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssessPro - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 33rem;
            margin: 50px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-weight: 600;
            color: #dc3545;
        }

        .login-form .form-control {
            border-color: #ced4da;
        }

        .login-form .is-invalid {
            border-color: #dc3545;
        }

        .login-form .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

        .login-form .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .login-form .btn-primary:hover {
            background-color: #c21f3a;
            border-color: #c21f3a;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
        }

        .login-footer a {
            color: #6c757d;
            text-decoration: none;
        }

        .login-footer a:hover {
            color: #495057;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('img') }}/logo.JPEG" style="height: 4rem; margin-bottom: 1rem;">
            {{-- <h1>AssessPro</h1> --}}
            <p class="text-muted">Welcome new user !</p>
        </div>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter your name">
                
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter your email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="new-password" placeholder="Enter your password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    autocomplete="new-password" placeholder="Confirm your password">

                @error('confrim')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>

                <select name="role" class="form-control" required autocomplete="role">
                    <option value="">-- Select Your Role --</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                    <option value="assessor">Assessor</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign up</button>
        </form>
        <div class="login-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
