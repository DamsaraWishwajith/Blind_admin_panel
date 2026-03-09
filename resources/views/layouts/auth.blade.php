<!DOCTYPE html>
<html>

<head>
    <title>IQ Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f0f2f5;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: #1e293b;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #64748b;
        }

        /* Link styling */
        .auth-footer {
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .auth-footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .auth-footer .small {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Teaches Admin Panel</h2>
                <p>Please login to continue</p>
            </div>

            @yield('auth-content')
        </div>
    </div>
</body>

</html>
