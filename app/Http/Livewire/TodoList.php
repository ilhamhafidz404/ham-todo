<?php

namespace App\Http\Livewire;

use App\Models\Hastag;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TodoList extends Component
{

  use WithPagination;

  public $task, $taskId, $priority, $note, $hastags= [];
  public $edit = false;
  public $tasks = [];
  public $hastag, $hastagId;
  public $editHastag= false;

  public $searchHastag;

  public $todoSetting= false, $filterPrioritySetting, $filterHastagSetting, $searchSetting, $addSetting= 'on', $addHastagSetting;
  public $filterPriority, $searchTask, $addHastag= true;


  public $checkedTask= [], $checkedHastag= [];


  public function render() {
    if(!$this->filterPriority){
      $myTasks= Task::where('task', 'LIKE', '%'.$this->searchTask.'%')->latest()->paginate(10);
    } else{
      $myTasks= Task::where('priority', 'LIKE', '%'.$this->filterPriority.'%')->where('task', 'LIKE', '%'.$this->searchTask.'%')->latest()->paginate(5);
    }
    if(!$this->searchHastag){
      $myHastags= Hastag::latest()->get();
    }else{
      $myHastags= Hastag::where('name', 'LIKE', '%'.$this->searchHastag.'%')->latest()->get();
    }
    // $myTasks= Task::latest()->paginate(10);
    return view('livewire.todo-list', compact('myTasks', 'myHastags'));
  }

  public function filterPriority($filterBy){
    $this->filterPriority = $filterBy;
  }

  // public function filterHastagSetting($filterBy){
  //   this
  // }

  public function todoSetting(){
    if($this->filterPrioritySetting || $this->filterHastagSetting || $this->addHastagSetting){
      $this->todoSetting= true;
    } else{
      $this->todoSetting= false;
    }
    $this->filterPrioritySetting= $this->filterPrioritySetting;
    $this->searchSetting= $this->searchSetting;
    $this->addHastagSetting= $this->addHastagSetting;
    if($this->todoSetting == null){
      $this->filterPriority= null;
      $this->searchTask= null;
      $this->addHastagSetting= null;
    }
    $this->editHastag= false;
    $this->edit= false;
    $this->searchHastag= null;
    $this->addSetting= 'on';
    $this->addHastag= 'on';

    $this->task= null;
    $this->taskId= null;
    $this->hastag= null;
    $this->hastagId= null;
  }

  public function store() {
    Task::create([
      'task' => $this->task,
      'slug' => Str::slug($this->task),
      "priority" => $this->priority,
      "note" => $this->note
    ])->hastag()->attach($this->hastags);

    $this->task = null;
    $this->priority = null;
    $this->note = null;
    $this->hastags = [];

    session()->flash('success', 'Berhasil Menambah Tugas');
  }

  public function destroy($id) {
    Task::find($id)->delete();
  }

  public function destroyMultiTask(){
    Task::whereKey($this->checkedTask)->delete();
    $this->checkedTask= [];
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

  public function hastagStore(){
    Hastag::create([
      'name' => $this->hastag,
      'slug' => Str::slug($this->hastag)
    ]);

    $this->hastag = null;
  }

  public function hastagDestroy($id){
    Hastag::find($id)->delete();
  }

  public function hastagMultiDestroy(){
    Hastag::whereKey($this->checkedHastag)->delete();
    $this->checkedHastag= [];
  }

  public function hastagEdit($id, $name){
    $this->editHastag = true;
    $this->addHastag = false;
    $this->hastag = $name;
    $this->hastagId = $id;
  }

  public function hastagUpdate(){
    Hastag::find($this->hastagId)->update([
      'name' => $this->hastag,
      'slug' => Str::slug($this->hastag)
    ]);

    $this->editHastag= false;
    $this->addHastag = true;
  }

  public function cancelHastagEdit(){
    $this->hastag= null;
    $this->addHastag = true;
    $this->editHastag= false;
    $this->hastagId= null;
  }
}
