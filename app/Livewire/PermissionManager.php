<?php
namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionManager extends Component
{
    public $permissions, $name, $permission_id;
    public $updateMode = false;


    public function render()
    {
        $this->authorize('read-permissions');
        $this->permissions = Permission::all();
        return view('livewire.permission-manager')->layout('layouts.main');
    }

  
    private function resetInputFields(){
        $this->name = '';
    }


    public function store()
    {
        $this->authorize('create-permissions');
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);
        Permission::create($validatedDate);
        session()->flash('message', 'Permission Created Successfully.');
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $this->authorize('edit-permissions');
        $permission = Permission::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;
        $this->updateMode = true;
    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->authorize('edit-permissions');
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);
        $permission = Permission::find($this->permission_id);
        $permission->update([
            'name' => $this->name,
        ]);
        $this->updateMode = false;
        session()->flash('message', 'Permission Updated Successfully.');
        $this->resetInputFields();

    }


    public function delete($id)
    {
        $this->authorize('delete-permissions');
        Permission::find($id)->delete();
        session()->flash('message', 'Permission Deleted Successfully.');
    }
}