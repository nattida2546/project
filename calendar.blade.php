@extends('layouts.public')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- ปฏิทินด้านซ้าย -->
            <div class="col-md-7">
                <div class="card shadow-sm border-dark rounded-4">
                    <div class="card-header bg-dark text-white fw-bold d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-calendar3"></i> ปฏิทินข่าวสาร</span>
                        <div>
                            <select id="yearSelect" class="form-select form-select-sm d-inline-block w-auto me-2">
                                @for ($y = now()->year; $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                            <select id="monthSelect" class="form-select form-select-sm d-inline-block w-auto">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center align-middle" id="calendarTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>อา</th>
                                    <th>จ</th>
                                    <th>อ</th>
                                    <th>พ</th>
                                    <th>พฤ</th>
                                    <th>ศ</th>
                                    <th>ส</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody">
                                <!-- จะสร้างด้วย JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ตารางข่าวสารด้านขวา -->
            <div class="col-md-5">
                <div class="card shadow-sm border-dark rounded-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="bi bi-megaphone"></i> สรุปข่าวสาร
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="newsTable" class="table table-striped table-bordered text-center align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อข่าว</th>
                                        <th>วันที่ลงประกาศ</th>
                                    </tr>
                                </thead>
                                <tbody id="newsTableBody">
                                    @foreach ($news as $index => $item)
                                        <tr data-date="{{ \Carbon\Carbon::parse($item->published_at)->format('Y-m-d') }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const calendarBody = document.getElementById("calendarBody");
            const yearSelect = document.getElementById("yearSelect");
            const monthSelect = document.getElementById("monthSelect");
            const rows = document.querySelectorAll("#newsTableBody tr");

            function renderCalendar(year, month) {
                calendarBody.innerHTML = "";
                const firstDay = new Date(year, month - 1, 1);
                const lastDay = new Date(year, month, 0);
                let startDay = firstDay.getDay();
                let totalDays = lastDay.getDate();
                let date = 1;

                for (let i = 0; i < 6; i++) {
                    let row = document.createElement("tr");
                    for (let j = 0; j < 7; j++) {
                        let cell = document.createElement("td");
                        if (i === 0 && j < startDay) {
                            cell.innerHTML = "";
                        } else if (date > totalDays) {
                            cell.innerHTML = "";
                        } else {
                            let fullDate =
                                `${year}-${String(month).padStart(2,'0')}-${String(date).padStart(2,'0')}`;
                            cell.innerHTML = `<button class="btn btn-sm w-100 calendar-date" data-date="${fullDate}">
                            ${date}
                        </button>`;
                            date++;
                        }
                        row.appendChild(cell);
                    }
                    calendarBody.appendChild(row);
                }

                attachEvents();
            }

            function attachEvents() {
                const buttons = document.querySelectorAll(".calendar-date");
                buttons.forEach(btn => {
                    btn.addEventListener("click", () => {
                        buttons.forEach(b => b.classList.remove("btn-dark"));
                        btn.classList.add("btn-dark");

                        const selectedDate = btn.dataset.date;
                        rows.forEach(row => {
                            row.style.display = row.dataset.date === selectedDate ? "" :
                                "none";
                        });
                    });
                });
            }

            yearSelect.addEventListener("change", () => renderCalendar(yearSelect.value, monthSelect.value));
            monthSelect.addEventListener("change", () => renderCalendar(yearSelect.value, monthSelect.value));

            renderCalendar(yearSelect.value, monthSelect.value);
        });
    </script>
@endsection
