<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class TodoList extends Component
{
  public $task;
  public $edit = false;
  public $tasks = [];
  public function render() {
    $this->tasks = Task::latest()->get();
    return view('livewire.todo-list');
  }
  public function store() {
    Task::create([
      'task' => $this->task,
      'slug' => Str::slug($this->task)
    ]);

    $this->task = '';

    session()->flash('success', 'Berhasil Menambah Tugas');
  }

  public function destroy($id) {
    Task::find($id)->delete();
  }

  public function edit($tugas) {
    $this->edit = true;
    $this->task = $tugas;
  }

  public function update() {
    $task = Task::whereTask($this->task)->first();

    $task->update([
      "task" => $this->task,
      "slug" => Str::slug($this->task)
    ]);

    dd($task);
  }
}