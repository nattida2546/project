<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCIENQ NEWS - ข่าวสารและบริการวิชาการ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background-color: #fff; }
        .top-header {
            /* แก้ไข: เปลี่ยนสีพื้นหลัง */
            background-color: #F7A9A5;
            border-bottom: 1px solid #dee2e6;
        }
        /* เพิ่ม: กำหนดสีตัวอักษรและไอคอน */
        .top-header .h1, .top-header .calendar-icon {
            color: #650000 !important;
        }
        .main-nav {
            border-bottom: 1px solid #dee2e6;
        }
        .main-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 1rem;
        }
        .main-nav .nav-link:hover {
            color: #ff69b4;
        }
        .news-card-sm {
            border: 1px solid #eee;
            border-radius: 0.5rem;
            transition: box-shadow .2s;
        }
        .news-card-sm:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header>
        <div class="top-header py-2">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    {{-- แก้ไข: เพิ่ม class h1 เพื่อให้ CSS จับได้ง่าย --}}
                    <h1 class="h4 mb-0 fw-bold h1">SCIENQ NEWS</h1>
                    <small class="text-muted">ข่าวสารและบริการวิชาการ</small>
                </div>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-2">
                        <input class="form-control form-control-sm" type="search" placeholder="ค้นหา..." aria-label="Search">
                        <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    {{-- แก้ไข: เพิ่ม class calendar-icon --}}
                    <a href="#" class="btn btn-light btn-sm calendar-icon"><i class="fas fa-calendar-alt"></i></a>
                </div>
            </div>
        </div>
        <nav class="main-nav navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('public.news.index') }}">หน้าแรก</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">ประชาสัมพันธ์</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">งานวิจัย</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">บริการวิชาการ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">นวัตกรรม</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">กิจกรรม</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">ติดต่อเรา</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="text-center bg-dark text-white py-3 mt-auto">
        <p class="mb-0">&copy; {{ date('Y') }} SCIENQ NEWS. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
