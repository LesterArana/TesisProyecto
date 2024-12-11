<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{  public $name;
    public $email;
    public $password;
    public $status = true;
    public $role;
    public $roles;


    public function mount()
    {
        $this->roles=Role::all();
    }
    protected $rules = [
        'name' => 'required|max:40',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'status' => 'boolean',
        'role' => 'required|exists:roles,name',
    ];

    public function store()
    {
        $datos = $this->validate();

        $user=User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'status' => $datos['status'],
        ]);

        $user->assignRole($this->role);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Usuario creado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('user.index');
        $this->resetInputFields();

    }
    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'status','role']);
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }
}
