@extends('layouts.dean')

@section('content')
    <div class="d-flex">

        <!-- Sidebar -->
        <aside class="d-flex flex-column justify-content-between bg-danger text-white p-3"
            style="width: 250px; min-height: 100vh;">
            <div>
                <div class="text-center mb-4">
                    <img src="https://via.placeholder.com/80" alt="avatar" class="rounded-circle mb-3">
                    <h4 class="fw-bold">รองคณบดี</h4>
                </div>
                <nav>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active">คำร้อง</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="text-center">
                <button class="btn btn-outline-light w-100">ออกจากระบบ</button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4 bg-light">
            <h2 class="fw-bold mb-4">คำร้องส่งถึงคณบดี</h2>

            <div class="table-responsive shadow-sm rounded bg-white p-3">
                <table class="table table-bordered table-striped text-center align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>ลำดับ</th>
                            <th>วันที่</th>
                            <th>หัวข้อ</th>
                            <th>รายละเอียด</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($req->date ? \Carbon\Carbon::parse($req->date) : null)->format('d/m/Y') }}</td>
                                <td>{{ $req->title }}</td>
                                <td>{!! nl2br(e($req->detail)) !!}</td>
                                <td>{{ $req->name }} {{ $req->surname }}</td>
                                <td>{{ $req->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">ไม่มีคำร้อง</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
@endsection
