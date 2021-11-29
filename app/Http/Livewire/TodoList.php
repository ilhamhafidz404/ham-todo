<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class TodoList extends Component
{
    public $task;
    public $tasks= [];
    public function render()
    {
        $this->tasks= Task::latest()->get();
        return view('livewire.todo-list');
    }
    public function store(){
        Task::create([
            'task' => $this->task,
            'slug' => Str::slug($this->task)
        ]);

        $this->task= '';

        session()->flash('success', 'Berhasil Menambah Tugas');
    }
}
