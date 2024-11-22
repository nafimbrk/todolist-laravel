<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoPriorityModel extends Model
{
    use HasFactory;
    protected $table = "todo_pry";
    protected $fillable = ["task_pry", "is_done", "due_date", "category_id"];
    protected $casts = [
        'due_date' => 'date',
    ];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
