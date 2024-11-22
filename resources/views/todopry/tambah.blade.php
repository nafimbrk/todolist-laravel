
<x-layout judul='tambah task'>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tambah</h5>

                <!-- 02. Form input data -->
                <form id="todo-form" action="{{ route('todopry.post') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="todo-input">Task</label>
                        <input type="text" class="form-control" name="task_pry" id="todo-input" placeholder="Tambah task baru" required value="{{ old('task_pry') }}">
                    </div>
                    <div class="mb-3">
                        <label for="due_date">Batas Waktu</label>
                        <input type="text" class="form-control flatpickr" name="due_date" id="due-date-input" placeholder="Tanggal jatuh tempo" value="{{ old('due_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select class="form-select" name="category_id">
                            <option value="" selected>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary me-1" type="submit">Simpan</button>
            <a href="{{ route('todopry') }}" class="btn btn-info">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
        
        
        
            </div>
        </div>
    </div>
</x-layout>





