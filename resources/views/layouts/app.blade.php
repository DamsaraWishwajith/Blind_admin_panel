<!DOCTYPE html>
<html>

<head>
    <title>IQ Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing styles */
        body {
            margin: 0;
            overflow-x: hidden;
            font-family: Arial, Helvetica, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background: #1e293b;
            padding-top: 20px;
        }

        .sidebar h4 {
            color: white;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #334155;
        }

        .sidebar a.active {
            background: #0d6efd;
        }

        .sidebar-btn {
            width: 100%;
            background: none;
            border: none;
            color: white;
            padding: 12px 20px;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-btn:hover {
            background: #334155;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Teaches Admin Panel</h4>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('questions.create') }}" class="{{ request()->routeIs('questions.create') ? 'active' : '' }}">
            Add IQ Question
        </a>

        <a href="{{ route('questions.index') }}" class="{{ request()->routeIs('questions.index') ? 'active' : '' }}">
            View IQ Questions
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-btn">
                Logout
            </button>
        </form>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="topbar">
            <h5>Admin Panel - Welcome, {{ Auth::user()->name }}!</h5>
        </div>

        <div class="mt-4">
            @yield('content')
        </div>
    </div>

</body>

</html>
