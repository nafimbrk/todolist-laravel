<x-layout judul="Ubah Task">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Task Priority</h5>

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

                        <form action="{{ route('todopry.update', $todo->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="task" class="form-label">Task</label>
                                <input type="text" class="form-control" id="task" name="task_pry" value="{{ old('task_pry', $todo->task_pry) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                <input type="text" class="form-control flatpickr" id="due_date" name="due_date" value="{{ old('due_date', $todo->due_date) }}">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $todo->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="is_done_0" name="is_done" value="0" {{ $todo->is_done == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_done_0">Belum</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="is_done_1" name="is_done" value="1" {{ $todo->is_done == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_done_1">Selesai</label>
                                    </div>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-primary me-1">Simpan</button>
                    <a href="{{ route('todopry') }}" class="btn btn-info">Kembali</a>
                        </form>
                    </div>
                
            
        </div>
    </div>
</x-layout>