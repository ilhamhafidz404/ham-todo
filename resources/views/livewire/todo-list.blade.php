<div class="w-1/2 mx-auto mt-10">

  
  <div class="fixed flex items-center top-0 bottom-0 left-0 z-20 transition duration-500" id="drawerToggler">
    <button type="button" class="btn btn-primary rounded-l-none" onclick="showDrawer()">
      <i class="fas fa-chevron-right" id="drawerButtonIcon"></i>
    </button>
  </div>

  @if (session()->has('success'))
  <div class="alert alert-success fixed right-0 top-0 m-5">
    <div class="flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
      </svg>
      <label>{{ session()->get('success') }}</label>
    </div>
  </div>
  @endif


  <div class="card bg-white p-10">
    @if($edit)
    <form wire:submit.prevent="update()">
      <div class="form-control">
        <label class="label" for="task">
          <span class="label-text font-bold tracking-wide">Edit Task: </span>
        </label>
        <div class="relative flex space-x-2">
          <div data-tip="Kembali" class="tooltip">
            <button class="btn btn-error" wire:click="cancelEdit" type="button">
              <i class="fas fa-backward"></i>
            </button>
          </div>
          <div class="w-full">
            <input type="text" placeholder="Memasak" class="w-full pr-16 pl-5 input input-success input-bordered bg-gray-100 text-gray-800" id="task" wire:model="task">
            <div data-tip="Setting" class="tooltip absolute top-0 right-0" style="margin-right: 40px">
              <label for="setting-task" class="btn btn-info modal-button">
                <i class="fas fa-cog"></i>  
              </label> 
              <input type="checkbox" id="setting-task" class="modal-toggle"> 
              <div class="modal">
                <div class="modal-box text-left">
                  <fieldset class="border p-5 rounded-box">
                    <legend class="text-gray-800 px-3">Change Priority</legend>
                    <div class="flex mt-3 items-center">
                      <div class="form-group text-info mr-3 flex items-center">
                        <input type="radio" value="low" id="low" name="priority" wire:model="priority" class="radio radio-accent radio-xs mr-1">
                        <label for="low">! Low Priority</label>
                      </div>
                      <div class="form-group text-warning mr-3 flex items-center">
                        <input type="radio" value="medium" id="medium" name="priority" wire:model="priority" class="radio radio-primary radio-xs mr-1">
                        <label for="medium">!! Medium Priority</label>
                      </div>
                      <div class="form-group text-error mr-3 flex items-center">
                        <input type="radio" value="hard" id="hard" name="priority" wire:model="priority" class="radio radio-secondary radio-xs mr-1">
                        <label for="hard">!!! Hard Priority</label>
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-group mt-4">
                    <label class="label" for="note">
                      <span class="label-text text-md">Note :</span>
                    </label> 
                    <textarea id="note" class="textarea h-24 textarea-bordered w-full text-gray-800" wire:model="note"></textarea>
                  </div>
                  <div class="modal-action">
                    <label for="setting-task" class="btn btn-primary">Save Setting</label> 
                    <label class="btn" wire:click="resetSetting()">Reset Setting </label>
                  </div>
                </div>
              </div>
            </div>
            <div data-tip="Simpan" class="tooltip absolute top-0 right-0">
              <button class="flex items-center h-full w-full rounded-l-none btn btn-success">
                <i class="fas fa-save"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
    @else
    <form wire:submit.prevent="store()">
      <div class="form-control">
        <label class="label" for="task">
          <span class="label-text font-bold tracking-wide">Tambah Task: </span>
        </label>
        <div class="relative">
          <input type="text" placeholder="Memasak" class="w-full pr-16 input input-primary input-bordered bg-gray-100 text-gray-800" id="task" wire:model="task">
          @if ($task)
            <div data-tip="Setting" class="tooltip absolute top-0 right-0" style="margin-right: 40px">
              <label for="setting-task" class="btn btn-info modal-button">
                <i class="fas fa-cog"></i>  
              </label> 
              <input type="checkbox" id="setting-task" class="modal-toggle"> 
              <div class="modal">
                <div class="modal-box text-left">
                  <fieldset class="border p-5 rounded-box">
                    <legend class="text-gray-800 px-3">Change Priority</legend>
                    <div class="flex mt-3 items-center">
                      <div class="form-group text-info mr-3 flex items-center">
                        <input type="radio" value="low" id="low" name="priority" wire:model="priority" class="radio radio-accent radio-xs mr-1">
                        <label for="low">! Low Priority</label>
                      </div>
                      <div class="form-group text-warning mr-3 flex items-center">
                        <input type="radio" value="medium" id="medium" name="priority" wire:model="priority" class="radio radio-primary radio-xs mr-1">
                        <label for="medium">!! Medium Priority</label>
                      </div>
                      <div class="form-group text-error mr-3 flex items-center">
                        <input type="radio" value="hard" id="hard" name="priority" wire:model="priority" class="radio radio-secondary radio-xs mr-1">
                        <label for="hard">!!! Hard Priority</label>
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-group mt-4">
                    <label class="label" for="note">
                      <span class="label-text text-md">Note :</span>
                    </label> 
                    <textarea id="note" class="textarea h-24 textarea-bordered w-full text-gray-800" wire:model="note"></textarea>
                  </div>
                  <div class="modal-action">
                    <label for="setting-task" class="btn btn-primary">Save Setting</label> 
                    <label for="setting-task" class="btn" wire:click="resetSetting()">Cancel and Close</label>
                  </div>
                </div>
              </div>
            </div>
          @else
            <div></div>
          @endif
          <div data-tip="Tambah" class="tooltip absolute top-0 right-0">
            <button class="flex items-center h-full w-full rounded-l-none btn btn-primary">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </form>
    @endif
  </div>

  <div class="card mt-10 text-black bg-white">
    <div class="overflow-x-auto">
      <table class="table w-full table-zebra">
        <thead>
          <tr>
            <th style="padding-right: 0px !important"></th>
            <th></th>
            <th>Name</th>
            <th>Job</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($myTasks as $index => $task)
            @if ($task->id == $taskId)
              <tr class="hover">
                <th style="padding: 0px !important">
                  <div style="width: 6px; height: 85%; transform: translateY(-50%)" class="bg-green-500 absolute left-0 top-1/5 cursor-pointer rounded">
                    <div data-tip="Editing" class="tooltip w-full h-full tooltip-right">
                    </div>
                  </div>
                </th>
                <th>
                  <label>
                    <input type="checkbox" checked class="checkbox">
                  </label>
                </th>
                <td colspan="3">
                  <div class="flex items-center text-center space-x-3 ml-20">
                    <div>
                      <div class="font-bold">
                        Tugas ini sedang dalam proses edit
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            @else
              <tr class="hover">
                <th style="padding: 0px !important">
                  @if ($task->priority == 'low')
                    <div style="width: 6px; height: 85%; transform: translateY(-50%)" class="bg-blue-500 absolute left-0 top-1/5 cursor-pointer rounded">
                      <div data-tip="! Low" class="tooltip w-full h-full tooltip-right">
                      </div>
                    </div>
                  @elseif($task->priority == 'medium')
                    <div style="width: 6px; height: 85%; transform: translateY(-50%)" class="bg-yellow-500 absolute left-0 top-1/5 cursor-pointer rounded">
                      <div data-tip="!! Medium" class="tooltip w-full h-full tooltip-right">
                      </div>
                    </div>
                  @elseif($task->priority == 'hard')
                    <div style="width: 6px; height: 85%; transform: translateY(-50%)" class="bg-red-500 absolute left-0 top-1/5 cursor-pointer rounded">
                      <div data-tip="!! Medium" class="tooltip w-full h-full tooltip-right">
                      </div>
                    </div>
                  @else
                    <div style="width: 6px; height: 85%; transform: translateY(-50%)" class="bg-gray-500 absolute left-0 top-1/5 cursor-pointer rounded">
                      <div data-tip="Not Priority" class="tooltip w-full h-full tooltip-right">
                      </div>
                    </div>
                  @endif
                </th>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox">
                  </label>
                </th>
                <td>
                  <div class="flex items-center space-x-3">
                    <div>
                      <div class="font-bold">
                        {{ $task->task }}
                      </div>
                      <div class="text-sm opacity-50">
                        United States
                      </div>
                    </div>
                  </div>
                </td>
                <th>
                  <button class="btn btn-ghost btn-xs">details</button>
                </th>
                <td>
                  <div data-tip="Hapus" class="tooltip">
                    <button class="btn btn-error btn-sm" wire:click="destroy({{$task->id}})">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                  <div data-tip="Edit" class="tooltip">
                    <button class="btn btn-info btn-sm" wire:click="edit('{{$task->task}}', {{$task->id}}, '{{ $task->priority }}', '{{ $task->note }}')" value="true">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @endif
          @empty
            <tr>
              <th colspan="5" class="text-center">
                Tidak Ada Tugas Hari Ini
              </th>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  @if ($todoSetting)
  <div class="absolute bg-white p-5 rounded right-10 top-52">
    <ul>
      <li>
        <button wire:click="filterPriority('low')" class="btn btn-primary">! Low Priority</button>
      </li>
      <li>
        <button wire:click="filterPriority('medium')" class="btn btn-primary">!! Medium Priority</button>
      </li>
      <li>
        <button wire:click="filterPriority('hard')" class="btn btn-primary">!!! Hard Priority</button>
      </li>
    </ul>
  </div>
  @endif
  
  <div class="mb-20 mt-10">
    {{ $myTasks->links() }}
    {{ $filterPrioritySetting }}
  </div>

  <div id="overlay" class="z-10 fixed top-0 left-0 bottom-0 bg-black opacity-50"></div>
  <div class="bg-white w-80 fixed -left-80 top-0 bottom-0 z-20 transition duration-500" id="drawer">
    <div class="drawer-side">
      <form wire:submit.prevent="todoSetting()">
        <ul class="menu p-4 overflow-y-auto text-base-content">
          <li>
            <div class="flex items-center">
              <input type="checkbox" checked="checked" class="checkbox checkbox-md mr-2" wire:model.defer='filterPrioritySetting' value="on" id="filterPrioritySetting">
              <label for="filterPrioritySetting" class="label">Filter Priority</label>
            </div>
          </li> 
          <li>
            <a>Menu Item</a>
          </li>
        </ul>

        <button class="btn btn-primary">Save Setting</button>
      </form>
    </div>
  </div>

  <script>
    const showDrawer= ()=>{
      const drawer= document.querySelector('#drawer');
      const overlay= document.querySelector('#overlay');
      const drawerToggler= document.querySelector('#drawerToggler');
      const drawerButtonIcon= document.querySelector('#drawerButtonIcon');
      drawer.classList.toggle('-left-80');
      drawer.classList.toggle('left-0');
      overlay.classList.toggle('right-0');
      drawerToggler.classList.toggle('left-80');
      drawerToggler.classList.toggle('left-0');
      drawerButtonIcon.classList.toggle('fa-chevron-right');
      drawerButtonIcon.classList.toggle('fa-chevron-left');
    }
  </script>

</div>