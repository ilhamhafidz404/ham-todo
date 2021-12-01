<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class TodoList extends Component
{
  public $task, $taskId, $priority, $note;
  public $edit = false;
  public $tasks = [];
  public function render() {
    $this->tasks = Task::latest()->get();
    return view('livewire.todo-list');
  }
  public function store() {
    Task::create([
      'task' => $this->task,
      'slug' => Str::slug($this->task),
      "priority" => $this->priority,
      "note" => $this->note
    ]);

    $this->task = null;
    $this->priority = null;
    $this->note = null;

    session()->flash('success', 'Berhasil Menambah Tugas');
  }

  public function destroy($id) {
    Task::find($id)->delete();
  }

  public function edit($tugas, $id, $priority, $note) {
    $this->edit = true;
    $this->task = $tugas;
    $this->taskId = $id;
    $this->priority= $priority;
    $this->note= $note;
  }

  public function cancelEdit(){
    $this->edit= false;
    $this->taskId= null;
    $this->task= null;
    $this->priority= null;
    $this->note= null;
  }

  public function resetSetting(){
    $this->priority= null;
    $this->note= null;;
  }

  public function update() {
    $task = Task::find($this->taskId);

    $task->update([
      "task" => $this->task,
      "slug" => Str::slug($this->task),
      "note" => $this->note
    ]);

    if($this->priority){
      $task->update([
        "priority" => $this->priority,
      ]);
    }

    $this->edit= false;
    $this->taskId= null;
    $this->task= null;
    $this->priority= null;
    $this->note= null;
  }
}