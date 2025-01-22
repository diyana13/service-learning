<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>AssessPro</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
       body {
           font-family: 'Inter', sans-serif;
       }
       
       .hero-section {
           background: linear-gradient(135deg, #d81b60 0%, #c21f3a 100%);
           color: white;
           padding: 120px 0;
           position: relative;
           overflow: hidden;
       }

       .hero-section::after {
           content: '';
           position: absolute;
           bottom: 0;
           left: 0;
           right: 0;
           height: 100px;
           background: linear-gradient(to bottom right, transparent 49%, white 50%);
       }

       .nav-section {
           position: absolute;
           top: 0;
           width: 100%;
           padding: 20px;
           z-index: 100;
       }

       .auth-buttons .btn {
           margin-left: 10px;
       }

       .feature-card {
           background: white;
           padding: 2rem;
           border-radius: 12px;
           box-shadow: 0 10px 30px rgba(0,0,0,0.08);
           transition: transform 0.3s ease;
           height: 100%;
       }

       .feature-card:hover {
           transform: translateY(-5px);
       }

       .icon-wrapper {
           width: 70px;
           height: 70px;
           background: rgba(220, 53, 69, 0.1);
           border-radius: 50%;
           display: flex;
           align-items: center;
           justify-content: center;
           color: #d81b60;
           margin-bottom: 1.5rem;
       }

       .btn-outline-primary {
           border-color: #d81b60;
           color: #d81b60;
       }

       .btn-outline-primary:hover {
           background: #d81b60;
           border-color: #d81b60;
           color: white;
       }

       .footer {
           background: #f8f9fa;
           padding: 20px 0;
           margin-top: 100px;
           text-align: center;
       }
   </style>
</head>
<body>
   <!-- Navigation -->
   <div class="nav-section">
       <div class="container d-flex justify-content-end">
           <div class="auth-buttons">
               <a href="{{ route('login') }}" class="btn btn-outline-light">Log in</a>
               <a href="{{ route('register') }}" class="btn btn-light">Register</a>
           </div>
       </div>
   </div>

   <!-- Hero Section -->
   <div class="hero-section">
       <div class="container">
           <div class="hero-content text-center">
               <h1 class="display-3 fw-bold mb-4">Welcome to AssessPro</h1>
               <p class="lead mb-5">Empowering fair and efficient peer evaluations</p>
               <div class="cta-buttons">
                   <a href="{{ route('login') }}" class="btn btn-light btn-lg me-3">Get Started</a>
               </div>
           </div>
       </div>
   </div>

   <!-- Features Section -->
   <div class="features-section container mt-5">
       <div class="row g-4">
           <div class="col-md-4">
               <div class="feature-card">
                   <div class="icon-wrapper">
                       <i class="fas fa-chalkboard-teacher fa-2x"></i>
                   </div>
                   <h3>Lecturers</h3>
                   <p>Create and manage project evaluations with our intuitive assessment tools.</p>
               </div>
           </div>
           
           <div class="col-md-4">
               <div class="feature-card">
                   <div class="icon-wrapper">
                       <i class="fas fa-users fa-2x"></i>
                   </div>
                   <h3>Students</h3>
                   <p>Participate in peer evaluations and provide meaningful feedback to your teammates.</p>
               </div>
           </div>
           
           <div class="col-md-4">
               <div class="feature-card">
                   <div class="icon-wrapper">
                       <i class="fas fa-clipboard-check fa-2x"></i>
                   </div>
                   <h3>Assessors</h3>
                   <p>Monitor and validate assessment processes with comprehensive evaluation tools.</p>
               </div>
           </div>
       </div>
   </div>

   <!-- Footer -->
   <footer class="footer">
       <div class="container">
           <p class="mb-0">AssessPro™ 2024-2025 | All Rights Reserved</p>
       </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>