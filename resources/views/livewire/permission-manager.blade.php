
<div class='container'>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @can('edit-permissions')
        @include('livewire.permission-update')
        @endcan
    @else
        @can('create-permissions')
        @include('livewire.permission-create')
        @endcan
    @endif
    @can('read-permissions')
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>permissions</th>
                <th width="150px">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        @can('edit-permissions')
                        <button wire:click="edit({{ $permission->id }})" class="btn btn-primary btn-sm">Edit</button>
                        @endcan
                        @can('delete-permissions')
                        <button wire:click="delete({{ $permission->id }})" class="btn btn-danger btn-sm">Delete</button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endcan
</div>

