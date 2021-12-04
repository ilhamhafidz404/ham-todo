<div class="w-96 md:w-1/2 mx-auto mt-10">


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
    @elseif($addHastagSetting)
      @if ($searchSetting)
        <div class="form-control absolute right-0 top-0 p-3 rounded-box bg-gray-200 rounded-r-none rounded-t-none">
          <label class="cursor-pointer label">
            <div class="inline-flex items-center">
              <span class="label-text mr-2">Search Hastag</span> 
              <input type="checkbox" checked="checked" class="toggle" value="on" wire:model="addSetting">
              <span class="label-text ml-2">Add Hastag</span> 
            </div>
          </label>
        </div>
      @endif
      @if ($searchSetting && !$addSetting)
        <div class="form-control">
          <label class="label" for="task">
            <span class="label-text font-bold tracking-wide">Search Hastag: </span>
          </label>
          <div class="relative">
            <input placeholder="Search" class="w-full pr-16 input input-primary input-bordered text-gray-800" type="text" wire:model="searchTask"> 
            <button class="absolute top-0 right-0 rounded-l-none btn btn-ghost text-gray-500">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      @endif
      <form wire:submit.prevent="hastagStore()">
        <div class="form-control">
          <label class="label" for="hastag">
            <span class="label-text">Add Hastag</span>
          </label> 
          <div class="relative">
            <input type="text" placeholder="Search" class="w-full pr-16 input input-primary input-bordered text-gray-800" id="hastag" wire:model="hastag"> 
            <button class="absolute top-0 right-0 rounded-l-none btn btn-primary">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div> 
        {{ $hastag }}
      </form>
    @else
      @if ($searchSetting)
        <div class="form-control absolute right-0 top-0 p-3 rounded-box bg-gray-200 rounded-r-none rounded-t-none">
          <label class="cursor-pointer label">
            <div class="inline-flex items-center">
              <span class="label-text mr-2">Search Task</span> 
              <input type="checkbox" checked="checked" class="toggle" value="on" wire:model="addSetting">
              <span class="label-text ml-2">Add Task</span> 
            </div>
          </label>
        </div>
      @endif
      @if ($addSetting)   
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
                    <div class="form-group mt-3">
                      <div class="form-control w-full">
                        <label class="label">
                          <span class="label-text">Hastag Task</span>
                          <a href="#" class="label-text-alt">Add Hastag</a> 
                        </label> 
                        <select class="select select-bordered w-full text-black" multiple wire:model="hastags">
                          @foreach ($myHastags as $hastag)
                              <option value="{{ $hastag->id }}">{{ $hastag->name }}</option>
                          @endforeach
                        </select>
                      </div> 
                    </div>
                    <div class="form-group mt-4">
                      <label class="label" for="note">
                        <span class="label-text text-md">Note :</span>
                      </label>
                      <textarea id="note" class="textarea h-24 textarea-bordered w-full text-gray-800" wire:model="note"></textarea>
                    </div>
                    {{-- {{ $hastags }} --}}
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
      @if ($searchSetting && !$addSetting)
        <div class="form-control">
          <label class="label" for="task">
            <span class="label-text font-bold tracking-wide">Search Task: </span>
          </label>
          <div class="relative">
            <input placeholder="Search" class="w-full pr-16 input input-primary input-bordered text-gray-800" type="text" wire:model="searchTask"> 
            <button class="absolute top-0 right-0 rounded-l-none btn btn-ghost text-gray-500">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      @endif
    @endif
  </div> 

  @if ($addHastagSetting)
    <div class="card mt-10 text-black bg-white">
      <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($myHastags as $index => $hastag)
              {{-- @if ($task->id == $taskId)
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
                    <div class="flex items-center text-center space-x-3 md:ml-36 ml-0">
                      <div>
                        <div class="font-light">
                          <span id="typed"></span>
                          <script>
                            var typed = new Typed('#typed', {
                              stringsElement: '#typed-strings',
                              strings: ['Editing Task', 'Editing Task.', 'Editing Task..', 'Editing Task...', 'Editing Task....', 'Editing Task....'],
                              loop: true
                            });
                          </script>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @else
              @endif --}}
              <tr class="hover">
                <th>
                  <label>
                    <input type="checkbox" class="checkbox">
                  </label>
                </th>
                <th style="padding: 0px !important">
                  {{ $hastag->name }}
                </th>
              </tr>
            @empty
            <tr>
              <th colspan="5" class="text-center">
                @if ($searchTask)
                  Tidak ada tugas {{ $searchTask }}
                @else
                    Tidak Ada Tugas Hari ini
                @endif
              </th>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @else
    <div class="card mt-10 text-black bg-white">
      <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
          <thead>
            <tr>
              <th style="padding-right: 0px !important"></th>
              <th></th>
              <th>Name</th>
              <th>
                <div class="md:block hidden">
                  Job
                </div>
              </th>
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
                    <div class="flex items-center text-center space-x-3 md:ml-36 ml-0">
                      <div>
                        <div class="font-light">
                          <span id="typed"></span>
                          <script>
                            var typed = new Typed('#typed', {
                              stringsElement: '#typed-strings',
                              strings: ['Editing Task', 'Editing Task.', 'Editing Task..', 'Editing Task...', 'Editing Task....', 'Editing Task....'],
                              loop: true
                            });
                          </script>
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
                          @foreach($task->hastag as $hastag)
                          {{ $hastag->name }}
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </td>
                  <th>
                    <div class="md:block h-full hidden">
                      <button class="btn btn-ghost btn-xs">
                        details
                      </button>
                    </div>
                  </th>
                  <td>
                    <div class="md:hidden block">
                      <div class="dropdown dropdown-end">
                        <div tabindex="0" class="m-1 btn btn-sm btn-info">
                          <i class="fas fa-cog"></i>
                        </div> 
                        <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                          <li>
                            <a style="padding: 0 !important">
                              <button wire:click="edit('{{$task->task}}','{{$task->id}}', '{{$task->priority}}', '{{$task->note}}')" class="w-full p-3">
                                Edit
                              </button>
                            </a>
                          </li> 
                          <li>
                            <a style="padding: 0 !important">
                              <button wire:click="edit('{{$task->task}}','{{$task->id}}', '{{$task->priority}}', '{{$task->note}}')" class="w-full p-3">
                                Edit
                              </button>
                            </a>
                          </li> 
                          <li>
                            <a style="padding: 0 !important">
                              <button wire:click="destroy({{$task->id}})" class="w-full p-3">
                                Hapus
                              </button>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="hidden md:block">
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
                    </div>
                  </td>
                </tr>
              @endif
            @empty
            <tr>
              <th colspan="5" class="text-center">
                @if ($searchTask)
                  Tidak ada tugas {{ $searchTask }}
                @else
                    Tidak Ada Tugas Hari ini
                @endif
              </th>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @endif

  @if ($filterPrioritySetting)
  <div class="card absolute bg-white rounded-box right-28 top-10">
    <div class="card-header bg-success p-3 text-center">
      <h6>Filter Priority</h6>
    </div>
    <div class="card-body p-3">
      <ul class="menu max-h-48 overflow-y-auto">
        <li>
          <button wire:click="filterPriority(null)" class="btn btn-ghost text-gray-800">All</button>
        </li>
        <li>
          <button wire:click="filterPriority(null)" class="btn btn-ghost text-gray-800">Not Priority</button>
        </li>
        <li>
          <button wire:click="filterPriority('low')" class="btn btn-ghost text-gray-800">! Low Priority</button>
        </li>
        <li>
          <button wire:click="filterPriority('medium')" class="btn btn-ghost text-gray-800">!! Medium Priority</button>
        </li>
        <li>
          <button wire:click="filterPriority('hard')" class="btn btn-ghost text-gray-800">!!! Hard Priority</button>
        </li>
      </ul>
    </div>
  </div>
  @endif
  @if ($filterHastagSetting)
  <div class="card absolute bg-white rounded-box right-28 @if ($filterPrioritySetting)
                                                              top-80
                                                            @else
                                                              top-10
                                                            @endif
  ">
    <div class="card-header bg-error p-3 text-center w-48">
      <h6>Filter Tag</h6>
    </div>
    <div class="card-body p-3">
      <ul class="menu max-h-52 overflow-y-auto">
        @forelse ($myHastags as $hastag)
          <li>
            <button wire:click="filterPriority(null)" class="btn btn-ghost text-gray-800">
              {{$hastag->name}}
            </button>
          </li>
        @empty
        <li>
          kefibew
        </li>
        @endforelse
      </ul>
    </div>
  </div>
  @endif

  <div class="mb-20 mt-10">
    {{ $myTasks->links() }}
  </div>

  <div id="overlay" class="z-10 fixed top-0 left-0 bottom-0 bg-black opacity-50"></div>
  <div class="bg-white w-80 fixed -left-80 top-0 bottom-0 z-20 transition duration-500" id="drawer">
    <div class="drawer-side">
      <form wire:submit.prevent="todoSetting()">
        <ul class="menu p-4 overflow-y-auto text-base-content">
          <li>
            <div class="flex items-center">
              <input type="checkbox" class="checkbox checkbox-md mr-2" wire:model.defer='filterPrioritySetting' value="on" id="filterPrioritySetting">
              <label for="filterPrioritySetting" class="label">Filter Priority</label>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <input type="checkbox" class="checkbox checkbox-md mr-2" wire:model.defer='filterHastagSetting' value="on" id="filterHastagSetting">
              <label for="filterHastagSetting" class="label">Filter Hastag</label>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <input type="checkbox" class="checkbox checkbox-md mr-2" wire:model.defer='searchSetting' value="on" id="searchSetting">
              <label for="searchSetting" class="label">Search</label>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <input type="checkbox" class="checkbox checkbox-md mr-2" wire:model.defer='addHastagSetting' value="on" id="addHastagSetting">
              <label for="addHastagSetting" class="label">Add Hastag</label>
            </div>
          </li>
          <li class="mt-20">
            <button class="btn btn-primary">Save Setting</button>
          </li>
        </ul>

      </form>
    </div>
  </div>

  <script>
    const showDrawer = ()=> {
      const drawer = document.querySelector('#drawer');
      const overlay = document.querySelector('#overlay');
      const drawerToggler = document.querySelector('#drawerToggler');
      const drawerButtonIcon = document.querySelector('#drawerButtonIcon');
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