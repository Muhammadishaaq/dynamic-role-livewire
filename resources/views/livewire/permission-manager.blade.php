
<div>

    @if (session()->has('message'))

        <div class="alert alert-success">

            {{ session('message') }}

        </div>

    @endif



    @if($updateMode)

        @include('livewire.update')

    @else

        @include('livewire.create')

    @endif



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

                        <button wire:click="edit({{ $permission->id }})" class="btn btn-primary btn-sm">Edit</button>

                        <button wire:click="delete({{ $permission->id }})" class="btn btn-danger btn-sm">Delete</button>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>
