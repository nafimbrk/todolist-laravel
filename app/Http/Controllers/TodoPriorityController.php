<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\TodoPriorityModel;
use Illuminate\Http\Request;

class TodoPriorityController extends Controller
{
    

   

    public function index(Request $request)
{
    $data = TodoPriorityModel::with('category')->get();
    
    $categories = CategoryModel::all();
    
    $tasksPryByDate = [];
    foreach ($data as $item) {
        $due_date = $item->due_date->format('j');
        $tasksPryByDate[$due_date][] = $item;
    }


    return view('todopry.taskpry', compact('tasksPryByDate', 'categories', 'data'));
}










public function create() {
    $categories = CategoryModel::all();
    return view('todopry.tambah', compact('categories'));
}
    

    
    public function store(Request $request)
    {
        $request->validate([
            'task_pry' => 'required',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        TodoPriorityModel::create([
            'task_pry' => $request->task_pry,
            'due_date' => $request->due_date,
            'category_id' => $request->category_id,
            'is_done' => false,
        ]);

        return redirect()->route('todopry')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
{
    $todo = TodoPriorityModel::findOrFail($id);
    $categories = CategoryModel::all();

    return view('todopry.edit', compact('todo', 'categories'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_pry' => 'required',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'is_done' => 'required|boolean',
        ]);

        $todo = TodoPriorityModel::findOrFail($id);
        $todo->update([
            'task_pry' => $request->task_pry,
            'due_date' => $request->due_date,
            'category_id' => $request->category_id,
            'is_done' => $request->is_done,
        ]);

        return redirect()->route('todopry')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        TodoPriorityModel::where('id', $id)->delete();

        return redirect()->route('todopry')->with('success', 'Data berhasil dihapus');
    }


    



    
public function tasksPryByCategory($id)
{
    $data = TodoPriorityModel::with('category')->where('category_id', $id)->get();

    $tasksByDate = [];
    foreach ($data as $item) {
        $due_date = $item->due_date->format('d');
        $tasksByDate[$due_date][] = $item;
    }

    $selectedCategory = CategoryModel::find($id);

    $category = CategoryModel::with('todospry')->findOrFail($id);

    return view('todopry.taskspry_category', compact('tasksByDate', 'selectedCategory', 'category'));
}








}