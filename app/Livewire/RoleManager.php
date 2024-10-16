<?php
namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleManager extends Component
{
    
    public $roles;
    public $permissions = [];
    public $name = ''; 
    public $selectedPermissions = []; 
    public $role_id;
    public $updateMode = false;

    public function render()
    {
        $this->authorize('read-roles');
        $this->roles = Role::with('permissions')->get();
        $this->permissions = Permission::all();
        
        return view('livewire.role-manager')->layout('layouts.main');
    }

    public function store()
    {
        $this->authorize('create-roles');
        $this->validate([
            'name' => 'required',
            'selectedPermissions' => 'required|array',
        ]);
        $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        if (count($validPermissions) !== count($this->selectedPermissions)) {
            session()->flash('error', 'One or more selected permissions do not exist.');
            return;
        }
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($validPermissions);

        session()->flash('message', 'Role created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->authorize('edit-roles');
        $role = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->updateMode = true;
    }

    public function update()
    {
        $this->authorize('edit-roles');
        $this->validate([
            'name' => 'required',
            'selectedPermissions' => 'required|array',
        ]);
        $validPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        if (count($validPermissions) !== count($this->selectedPermissions)) {
            session()->flash('error', 'One or more selected permissions do not exist.');
            return;
        }
        $role = Role::findOrFail($this->role_id);
        $role->update(['name' => $this->name]);
        $role->syncPermissions($validPermissions);
    
        session()->flash('message', 'Role updated successfully.');
    
        $this->resetInputFields();
        $this->updateMode = false;
    }
    

    public function delete($id)
    {
        $this->authorize('delete-roles');
        Role::findOrFail($id)->delete();
        session()->flash('message', 'Role deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->selectedPermissions = [];
        $this->updateMode = false;
    }
}
