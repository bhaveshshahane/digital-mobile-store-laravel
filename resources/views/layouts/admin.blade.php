<!DOCTYPE html>
<html>
<head>
<title>@yield('title', 'Admin Dashboard')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body { display:flex; background:#f4f6f9; }

/* ===== SIDEBAR ===== */
.sidebar { width:230px; height:100vh; background:#fff; padding:20px 15px; border-right:1px solid #eee; position:fixed; left:0; top:0; }
.logo { font-size:22px; font-weight:600; color:#ff2e93; margin-bottom:30px; text-align:center; text-decoration:none; display:block; }
.menu { list-style:none; }
.menu li { margin-bottom:12px; }
.menu li a { display:block; padding:12px 15px; border-radius:8px; text-decoration:none; color:#333; font-weight:500; transition:0.3s; }
.menu li a:hover, .menu li.active a { background:linear-gradient(to right,#ff2e63,#ff6a88); color:#fff; }

/* ===== MAIN ===== */
.main { flex:1; margin-left:230px; min-height:100vh; padding:40px; }

/* ===== TOPBAR ===== */
.topbar { background:#fff; padding:15px 25px; border-radius:12px; display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; box-shadow:0 3px 10px rgba(0,0,0,0.05); }
.admin-name { font-weight:500; color:#555; }
.admin-name span { color:#ff2e93; font-weight:600; }
.logout-btn { background: #ff2e93; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-left:10px; }

@yield('styles')
</style>
</head>
<body>

<div class="sidebar">
    <a href="{{ route('home') }}" class="logo">🛒 phoneKART</a>
    <ul class="menu">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}"><a href="{{ route('admin.products.create') }}">Add Product</a></li>
        <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}"><a href="{{ route('admin.products.index') }}">Products</a></li>
        <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">Users</a></li>
        <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
        <h2>@yield('header', 'Admin Panel')</h2>
        <div class="admin-name">
            Hello, <span>{{ auth()->user()->fname }}</span> 👋
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    
    @if(session('success'))
        <div style="background:#28a745; color:white; padding:10px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="background:#dc3545; color:white; padding:10px; border-radius:8px; margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

@yield('scripts')
</body>
</html>
