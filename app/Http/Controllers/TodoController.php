<?php












namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\TodoModel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class TodoController extends Controller
{
    
    
    public function index(Request $request)
{
    $data = TodoModel::with('category')->get();
    
    $categories = CategoryModel::all();
    
    $tasksByDate = [];
    foreach ($data as $item) {
        $due_date = $item->due_date->format('j');
        $tasksByDate[$due_date][] = $item;
    }


    return view('todo.task', compact('tasksByDate', 'categories', 'data'));
}










public function create() {
    $categories = CategoryModel::all();
    return view('todo.tambah', compact('categories'));
}

    
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        TodoModel::create([
            'task' => $request->task,
            'due_date' => $request->due_date,
            'category_id' => $request->category_id,
            'is_done' => false,
        ]);

        return redirect()->route('todo')->with('success', 'Data berhasil ditambahkan');
    }



    public function edit($id)
{
    $todo = TodoModel::findOrFail($id);
    $categories = CategoryModel::all();

    return view('todo.edit', compact('todo', 'categories'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'is_done' => 'required|boolean',
        ]);

        $todo = TodoModel::findOrFail($id);
        $todo->update([
            'task' => $request->task,
            'due_date' => $request->due_date,
            'category_id' => $request->category_id,
            'is_done' => $request->is_done,
        ]);

        return redirect()->route('todo')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        TodoModel::where('id', $id)->delete();

        return redirect()->route('todo')->with('success', 'Data berhasil dihapus');
    }





public function tasksByCategory($id)
{
    $data = TodoModel::with('category')->where('category_id', $id)->get();

    $tasksByDate = [];
    foreach ($data as $item) {
        $due_date = $item->due_date->format('d');
        $tasksByDate[$due_date][] = $item;
    }

    $selectedCategory = CategoryModel::find($id);

    $category = CategoryModel::with('todos')->findOrFail($id);

    return view('todo.tasks_category', compact('tasksByDate', 'selectedCategory', 'category'));
}



}

















































// namespace App\Http\Controllers\Todo;

// use App\Http\Controllers\Controller;
// use App\Models\Todo;
// use Illuminate\Http\Request;

// class TodoController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         // return view('todo.app');

//         $max_data = 2;

//         if(request('search')) {
//             $data = Todo::where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();
//         } else {
//             $data = Todo::orderBy('task', 'asc')->paginate($max_data);
//         }


//         // $data = Todo::orderBy('task', 'asc')->get();
//         // dd($data);
//         // return view('todo.app', ['data' => $data]);
//         return view('todo.app', compact('data'));

        
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
// {
//     $request->validate([
//         'task' => 'required|min:3|max:25',
//         'due_date' => 'nullable|date'
//     ], [
//         'task.required' => 'isian task wajib diisikan', 
//         'task.min' => 'minimal isian untuk task adalah 3 karakter',
//         'task.max' => 'maximal isian untuk task adalah 25 karakter'
//     ]);

//     $data = [
//         'task' => $request->input('task'),
//         'due_date' => $request->input('due_date')
//     ];

//     Todo::create($data);

//     return redirect()->route('todo')->with('success', 'berhasil simpan data');
// }


   

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
// {
//     $request->validate([
//         'task' => 'required|min:3|max:25',
//         'due_date' => 'nullable|date'
//     ], [
//         'task.required' => 'isian task wajib diisikan', 
//         'task.min' => 'minimal isian untuk task adalah 3 karakter',
//         'task.max' => 'maximal isian untuk task adalah 25 karakter'
//     ]);

//     $data = [
//         'task' => $request->input('task'),
//         'is_done' => $request->input('is_done'),
//         'due_date' => $request->input('due_date')
//     ];

//     Todo::where('id', $id)->update($data);

//     return redirect()->route('todo')->with('success', 'berhasil menyimpan perbaikan data');
// }

   

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         Todo::where('id', $id)->delete();
//         return redirect()->route('todo')->with('success', 'berhasil menghapus data');
//     }
// }
