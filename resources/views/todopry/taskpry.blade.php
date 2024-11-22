









{{-- <x-layout judul="task prority">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-end mb-3">
                    <a href="{{ route('todopry.create') }}" class="btn btn-primary text-end">Tambah</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card mb-3" style="display: inline-flex;">
                    <div class="card-body">
                        <table class="table table-bordered border-dark">
                            <thead class="table-dark">
                                <tr>
                                    <th>Minggu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jum'at</th>
                                    <th>Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tgl1 = 1;
                                    $tgl = 1;
                                    $tglakhir = 31;
                                    $hari_pertama = 2; // Minggu
                                    $currentDate = \Carbon\Carbon::now()->toDateString();
                                @endphp
                                <tr>
                                    @for ($j = 1; $j < $hari_pertama; $j++)
                                        <td></td>
                                    @endfor
                                    @for ($j = $hari_pertama; $j <= 7; $j++)
                                        <td>
                                            @if ($tgl <= $tglakhir)
                                                <b>{{ $tgl }}</b>
                                                @if (isset($tasksPryByDate[$tgl]))
                                                    <div id="carouselExampleControls{{ $tgl }}" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach ($tasksPryByDate[$tgl] as $index => $taskPry)
                                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                    <div class="task-item d-flex justify-content-between {{ $taskPry->due_date < $currentDate ? 'overdue-task' : '' }}">
                                                                        <div>
                                                                            <b style="{{ $taskPry->is_done ? 'text-decoration: line-through;' : '' }}">{{ htmlspecialchars($taskPry->task_pry) }}</b><br>
                                                                            @if ($taskPry->category)
                                                                                <small>
                                                                                    <a href="{{ route('tasks.by.category', ['id' => $taskPry->category->id]) }}" class="text-decoration-none">
                                                                                        {{ htmlspecialchars($taskPry->category->name) }}
                                                                                    </a>
                                                                                </small>
                                                                            @endif
                                                                        </div>
                                                                        <div class="btn-group-vertical">
                                                                            <a href="{{ route('todopry.edit', $taskPry->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                                                            <form action="{{ route('todopry.delete', $taskPry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                @php $tgl++; @endphp
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                                @while ($tgl <= $tglakhir)
                                    <tr>
                                        @for ($j = 1; $j <= 7; $j++)
                                            <td>
                                                @if ($tgl <= $tglakhir)
                                                    <b>{{ $tgl }}</b>
                                                    @if (isset($tasksPryByDate[$tgl]))
                                                        <div id="carouselExampleControls{{ $tgl }}" class="carousel slide" data-bs-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach ($tasksPryByDate[$tgl] as $index => $taskPry)
                                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                        <div class="task-item d-flex justify-content-between {{ $taskPry->due_date < $currentDate ? 'overdue-task' : '' }}">
                                                                            <div>
                                                                                <b style="{{ $taskPry->is_done ? 'text-decoration: line-through;' : '' }}">{{ htmlspecialchars($taskPry->task_pry) }}</b><br>
                                                                                @if ($taskPry->category)
                                                                                    <small>
                                                                                        <a href="{{ route('tasks.by.category', ['id' => $taskPry->category->id]) }}" class="text-decoration-none">
                                                                                            {{ htmlspecialchars($taskPry->category->name) }}
                                                                                        </a>
                                                                                    </small>
                                                                                @endif
                                                                            </div>
                                                                            <div class="btn-group-vertical">
                                                                                <a href="{{ route('todopry.edit', $taskPry->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                                                                <form action="{{ route('todopry.delete', $taskPry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini?')">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @php $tgl++; @endphp
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endwhile
                                @php
                                    $sisa_kolom = ($tgl - 1 + $hari_pertama - 1) % 7;
                                @endphp
                                @if ($sisa_kolom > 0 && $sisa_kolom < 7)
                                    @for ($j = $sisa_kolom; $j < 7; $j++)
                                        <td></td>
                                    @endfor
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<!-- Tambahkan Bootstrap CSS dan JS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .task-item > div:first-child {
        margin-right: 15px;
        flex: 1;
    }
    .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .overdue-task {
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style> --}}













<x-layout judul="task priority">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-end mb-3">
                    <a href="{{ route('todopry.create') }}" class="btn btn-primary text-end">Tambah</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- <div class="card mb-3" style="display: inline-flex;">
                    <div class="card-body"> --}}
                        <table class="table table-bordered border-dark">
                            <thead class="table-dark">
                                <tr>
                                    <th>Minggu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jum'at</th>
                                    <th>Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tgl = 1;
                                    $tglakhir = 31;
                                    $hari_pertama = 2; // 1 untuk Senin, 2 untuk Minggu, dll.
                                    $currentDate = \Carbon\Carbon::now()->toDateString();
                                @endphp
                                
                                @for ($week = 0; $week < 6; $week++) <!-- Maksimal 6 minggu dalam sebulan -->
                                    <tr>
                                        @for ($day = 0; $day < 7; $day++)
                                            <td class="text-truncate">
                                                @if ($week === 0 && $day < $hari_pertama - 1)
                                                    <!-- Kosongkan sel sampai ke hari pertama -->
                                                    &nbsp;
                                                @elseif ($tgl <= $tglakhir)
                                                    <b>{{ $tgl }}</b>
                                                    @if (isset($tasksPryByDate[$tgl]))
                                                        <div id="carouselExampleControls{{ $tgl }}" class="carousel slide" data-bs-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach ($tasksPryByDate[$tgl] as $index => $taskPry)
                                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                        <div class="task-item d-flex justify-content-between {{ $taskPry->due_date < $currentDate ? 'overdue-task' : '' }}">
                                                                            <div>
                                                                                <b style="{{ $taskPry->is_done ? 'text-decoration: line-through;' : '' }}">{{ htmlspecialchars($taskPry->task_pry) }}</b><br>
                                                                                @if ($taskPry->category)
                                                                                    <small>
                                                                                        <a href="{{ route('tasks.by.category', ['id' => $taskPry->category->id]) }}" class="text-decoration-none">
                                                                                            {{ htmlspecialchars($taskPry->category->name) }}
                                                                                        </a>
                                                                                    </small>
                                                                                @endif
                                                                            </div>
                                                                            <div class="btn-group-vertical">
                                                                                <a href="{{ route('todopry.edit', $taskPry->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                                                                <form action="{{ route('todopry.delete', $taskPry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('yakin akan menghapus data ini?')">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{ $tgl }}" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @php $tgl++; @endphp
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                    @if ($tgl > $tglakhir)
                                        @break
                                    @endif
                                @endfor
                            </tbody>
                        </table>
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>
</x-layout>

<!-- Tambahkan Bootstrap CSS dan JS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-width: 100%; /* Ensure task-item does not exceed its container */
    }
    .task-item > div:first-child {
        margin-right: 15px;
        flex: 1;
        min-width: 0; /* Ensures flex item respects its container width */
    }
    .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .overdue-task {
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    td {
        max-width: 150px;
        word-wrap: break-word;
    }
    .carousel-inner {
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>






































































































