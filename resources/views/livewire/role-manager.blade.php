<div class="container">
    <!-- Display success message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Conditionally show either update or create form -->
    @if($updateMode)
        @can('edit-roles')
        @include('livewire.role-update') <!-- Update view -->
        @endcan
    @else
        @can('create-roles')
        @include('livewire.role-create') <!-- Create view -->
        @endcan
    @endif
   @can('read-roles')
    <!-- Table for displaying roles -->
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <!-- Displaying permissions associated with the role -->
                        @if($role->permissions->isNotEmpty())
                            @foreach ($role->permissions as $permission)
                                <span>{{ $permission->name }}</span>
                            @endforeach
                        @else
                            <span>No permissions assigned</span>
                        @endif
                    </td>
                    <td>
                        @can('edit-roles')
                        <button wire:click="edit({{ $role->id }})" class="btn btn-primary btn-sm">Edit</button>
                        @endcan
                        @can('delete-roles')
                        <button wire:click="delete({{ $role->id }})" class="btn btn-danger btn-sm">Delete</button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endcan
</div>
