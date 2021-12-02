<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TodoList extends Component
{

  use WithPagination;

  public $task, $taskId, $priority, $note;
  public $edit = false;
  public $tasks = [];

  public $todoSetting= false, $filterPrioritySetting, $filterTagSetting, $searchSetting, $addSetting= 'on';
  public $filterPriority, $searchTask;
  public function render() {
    if(!$this->filterPriority){
      $myTasks= Task::where('task', 'LIKE', '%'.$this->searchTask.'%')->latest()->paginate(10);
    } else{
      $myTasks= Task::where('priority', 'LIKE', '%'.$this->filterPriority.'%')->where('task', 'LIKE', '%'.$this->searchTask.'%')->latest()->paginate(5);
    }
    // $myTasks= Task::latest()->paginate(10);
    return view('livewire.todo-list', compact('myTasks'));
  }

  public function filterPriority($filterBy){
    $this->filterPriority = $filterBy;
  }

  public function todoSetting(){
    if($this->filterPrioritySetting || $this->filterTagSetting){
      $this->todoSetting= true;
    } else{
      $this->todoSetting= false;
    }
    $this->filterPrioritySetting= $this->filterPrioritySetting;
    $this->searchSetting= $this->searchSetting;
    if($this->todoSetting == null){
      $this->filterPriority= null;
      $this->searchTask= null;
      $this->addSetting= 'on';
    }
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