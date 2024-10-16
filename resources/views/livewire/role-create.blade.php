<form wire:submit.prevent="store">
    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" id="name" class="form-control" wire:model="name">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="permissions">Permissions</label>
        <div>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        id="permission-{{ $permission->id }}" 
                        value="{{ $permission->id }}" 
                        wire:model="selectedPermissions"
                    >
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
        @error('selectedPermissions') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-success">Save Role</button>
</form>
