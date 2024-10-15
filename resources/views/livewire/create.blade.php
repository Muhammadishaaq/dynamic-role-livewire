<form>

    <div class="form-group">

        <label for="exampleFormControlInput1">Permission:</label>

        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Permission" wire:model="name">

        @error('name') <span class="text-danger">{{ $message }}</span>@enderror

    </div>

    <button wire:click.prevent="store()" class="btn btn-success">Save</button>

</form>