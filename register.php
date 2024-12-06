<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/Frame 2.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow: auto; /* Membolehkan scroll jika konten lebih besar */
            font-family: 'Poppins', sans-serif; /* Font utama */
        }
        .login-container {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Ukuran maksimum */
            padding-top: 3rem; /* Padding top jika perlu */
            padding-bottom: 3rem; /* Padding bottom jika perlu */
        }
        .login-container h1 {
            color: #ff914d;
            font-family: 'Poppins', sans-serif; /* Font khusus untuk h1 */
            font-weight: 600;
        }
        .login-container p {
            color: #ff914d;
            font-family: 'Poppins', sans-serif; /* Font untuk paragraf */
            font-weight: 400;
        }
        .btn-primary {
            background-color: #ff914d;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e87d3c;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center mb-4">HI!</h1>
        <p class="text-center mb-4">create a new account</p>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" placeholder="Enter your role" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="#" class="text-decoration-none">Sign Up</a></p>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
