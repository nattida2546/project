<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการข่าว - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { display: flex; min-height: 100vh; background-color: #f4f7f6; }
        .sidebar { width: 250px; background: #000000; color: #fff; flex-shrink: 0; }
        .sidebar a {
            color: #ecf0f1;
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            transition: background-color 0.2s, padding-left 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover {
            background: #34495e;
            border-left: 3px solid #3498db;
            padding-left: 20px;
        }
        .sidebar a.active {
            background: #34495e;
            border-left: 3px solid #e74c3c;
            font-weight: bold;
        }
        .sidebar h5 { color: #ecf0f1; }
        .btn-pink { background:#ff66a3; color:#fff; font-weight:bold; }
        .btn-pink:hover { background:#e05590; }
        .category-card { border-radius:15px; transition:.2s; cursor:pointer; text-decoration: none; }
        .category-card:hover { transform:scale(1.05); box-shadow:0 4px 12px rgba(0,0,0,0.2); }
        .bg-fuchsia { background-color:#cc33cc!important; }
        .main-content { flex-grow: 1; padding: 2rem; }
    </style>
</head>
<body>

    <div class="sidebar p-3">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" width="80" class="rounded-circle mb-2" alt="Logo">
            <h5>ฝ่ายบริการ</h5>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}"><i class="fas fa-chart-line fa-fw me-2"></i>รายงานภาพรวม</a>
        <a href="{{ route('admin.news.index') }}" class="{{ Request::is('admin/news*') ? 'active' : '' }}"><i class="fas fa-newspaper fa-fw me-2"></i>จัดการข่าวสาร</a>
        <a href="{{ route('admin.employees.index') }}" class="{{ Request::is('admin/employees*') ? 'active' : '' }}"><i class="fas fa-users fa-fw me-2"></i>จัดการเจ้าหน้าที่</a>
        <a href="#"><i class="fas fa-database fa-fw me-2"></i>คลังข้อมูล</a>
        <a href="#"><i class="fas fa-file-alt fa-fw me-2"></i>สรุปข่าว</a>

        <div class="mt-auto">
            {{-- ตัวอย่างปุ่ม Logout --}}
        </div>
    </div>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- เพิ่มบรรทัดนี้เข้าไปครับ --}}
    @stack('scripts')

</body>
</html>
