<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .hero {
            background-color: #b21919;
            color: white;
            text-align: center;
            padding: 50px 20px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="p-3 bg-white shadow-sm">
        <div class="container d-flex justify-content-end align-items-center">
            {{-- <h2 class="text-danger">Welcome to the Assessment System</h2> --}}
            <!-- Navigation -->
            @if (Route::has('login'))
                <nav class="d-flex align-items-center gap-3">
                    @auth
                        <a href="{{ route('lecturer.home') }}" class="btn btn-Pink">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to AssessPro</h1>
        <p>Streamlining evaluation processes for better learning outcomes</p>
    </section>

    <!-- Main Content -->
    <main class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Lecturers</h5>
                        <p class="card-text">Access tools to assess students and manage evaluations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Students</h5>
                        <p class="card-text">View your assessments and feedback to improve learning.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Assessors</h5>
                        <p class="card-text">Collaborate on evaluations and contribute to the process.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-5 bg-light py-3 text-center">
        <strong>Copyright &copy; 2024-{{ now()->year }} <a href="#">{{config('app.name')}}</a>.</strong> All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>