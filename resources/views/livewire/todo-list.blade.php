<div class="w-1/2 mx-auto mt-20">

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
        <div class="relative">
          <input type="text" placeholder="Memasak" class="w-full pr-16 input input-primary input-bordered bg-gray-100 text-gray-800" id="task" wire:model.defer="task">
          <button class="absolute top-0 right-0 rounded-l-none btn btn-primary">Edit</button>
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
          <button class="absolute top-0 right-0 rounded-l-none btn btn-primary">Tambahkan</button>
        </div>
      </div>
    </form>
    @endif
  </div>

  <div class="card mt-20 text-black bg-white">
    <div class="overflow-x-auto">
      <table class="table w-full table-zebra">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Job</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tasks as $index => $task)
          <tr @if ($index%2==1)
            class="hover"
            @endif
            >
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
              <button class="btn btn-danger" wire:click="destroy({{$task->id}})">
                hapus
              </button>
              <button class="btn btn-danger" wire:click="edit('{{$task->task}}')" value="true">
                Edit
              </button>
            </td>
          </tr>
          @empty

          @endforelse
        </tbody>
      </table>
      {{ $edit }}
    </div>
  </div>
</div>