<?php
namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionManager extends Component
{
    public $permissions, $name, $permission_id;

    public $updateMode = false;

   

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function render()

    {

        $this->permissions = Permission::all();

        return view('livewire.permission-manager')->layout('layouts.main');

    }

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    private function resetInputFields(){

        $this->name = '';

    }

   

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function store()

    {

        $validatedDate = $this->validate([

            'name' => 'required',

        ]);

  

        Permission::create($validatedDate);

  

        session()->flash('message', 'Permission Created Successfully.');

  

        $this->resetInputFields();

    }

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function edit($id)

    {

        $permission = Permission::findOrFail($id);

        $this->permission_id = $id;

        $this->name = $permission->name;

        $this->updateMode = true;

    }

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function cancel()

    {

        $this->updateMode = false;

        $this->resetInputFields();

    }

  

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function update()

    {

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

   

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public function delete($id)

    {

        Permission::find($id)->delete();

        session()->flash('message', 'Permission Deleted Successfully.');

    }
}