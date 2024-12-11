<?php
namespace App\Livewire\User;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditUser extends Component
{
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $status;
    public $role;
    public $roles;

    public function rules()
    {
        return [
            'name' => 'required|max:40',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => 'nullable|min:8',
            'status' => 'boolean',
            'role' => 'required|exists:roles,name',
        ];
    }

    public function mount(User $user)
    {
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->role = $user->roles->pluck('name')->first(); // Asignar el rol actual
        $this->roles = Role::all(); // Cargar todos los roles
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->status = $this->status;

        $user->syncRoles($this->role);

        if ($user->isDirty()) {
            $user->save();
            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Usuario actualizado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }

        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.edit-user', [
            'roles' => $this->roles
        ]);
    }
}


