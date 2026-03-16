<!DOCTYPE html>
<html>

<head>
    <title>IQ Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

        .sidebar-section {
            color: #94a3b8;
            padding: 20px 20px 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: bold;
        }

        .sidebar .submenu-item {
            padding-left: 40px;
            font-size: 0.9rem;
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

        .collapse-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .collapse-toggle::after {
            content: "\F282";
            font-family: "bootstrap-icons";
            transition: transform 0.3s;
            font-size: 0.8rem;
        }

        .collapse-toggle:not(.collapsed)::after {
            transform: rotate(180deg);
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

        <!-- <div class="sidebar-section">Menu</div> -->

        <a href="#iqChallengeSubmenu" data-bs-toggle="collapse" class="collapse-toggle {{ request()->is('questions*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('questions*') ? 'true' : 'false' }}">
            IQ Challenges
        </a>

        <div class="collapse {{ request()->is('questions*') ? 'show' : '' }}" id="iqChallengeSubmenu">
            <a href="{{ route('questions.create') }}" class="submenu-item {{ request()->routeIs('questions.create') ? 'active' : '' }}">
                Add IQ Question
            </a>
            <a href="{{ route('questions.index') }}" class="submenu-item {{ request()->routeIs('questions.index') ? 'active' : '' }}">
                View IQ Questions
            </a>
        </div>
        <!-- Add this after the IQ Challenges section or wherever appropriate -->
<a href="#mathSubmenu" data-bs-toggle="collapse" class="collapse-toggle {{ request()->is('math*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('math*') ? 'true' : 'false' }}">
    Math Questions
</a>

<div class="collapse {{ request()->is('math*') ? 'show' : '' }}" id="mathSubmenu">
    <a href="{{ route('math.create') }}" class="submenu-item {{ request()->routeIs('math.create') ? 'active' : '' }}">
        Add Math Question
    </a>
    <a href="{{ route('math.index') }}" class="submenu-item {{ request()->routeIs('math.index') ? 'active' : '' }}">
        View Math Questions
    </a>
</div>
<!-- Add this after the Math Questions section -->
<a href="#questionsManageSubmenu" data-bs-toggle="collapse" class="collapse-toggle {{ request()->is('questions-manage*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('questions-manage*') ? 'true' : 'false' }}">
    Question Bank
</a>

<div class="collapse {{ request()->is('questions-manage*') ? 'show' : '' }}" id="questionsManageSubmenu">
    <a href="{{ route('questions-manage.create') }}" class="submenu-item {{ request()->routeIs('questions-manage.create') ? 'active' : '' }}">
        Add Question
    </a>
    <a href="{{ route('questions-manage.index') }}" class="submenu-item {{ request()->routeIs('questions-manage.index') ? 'active' : '' }}">
        View All Questions
    </a>
</div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
