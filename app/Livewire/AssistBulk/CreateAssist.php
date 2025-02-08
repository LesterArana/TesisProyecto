<?php

namespace App\Livewire\AssistBulk;

use App\Models\Schedule;
use App\Models\Assist;
use App\Models\Employee;
use App\Models\Projet;
use App\Models\NumberOfHour;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAssist extends Component
{
    public $employee_id; // Para el empleado seleccionado
    public $projet_id;
    public $days = [];
    public $extra_hours_diurnas;
    public $extra_hours_nocturnas;
    public $start_week;
    public $end_week;

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'projet_id' => 'required|exists:projets,id',
        'days' => 'required|array|min:1',
        'days.*' => 'in:Lunes,Martes,Miercoles,Jueves,Viernes',
        'extra_hours_diurnas' => 'nullable|numeric|min:0',
        'extra_hours_nocturnas' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->start_week = now()->startOfWeek()->format('Y-m-d');
        $this->end_week = now()->endOfWeek()->format('Y-m-d');
    }

    public function save()
    {
        DB::beginTransaction();

        try {
            $this->validate();

            $schedule = Schedule::first();
            if (!$schedule) {
                session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'No se ha configurado un horario. Por favor, configure uno antes de continuar.',
                    'position' => 'center',
                    'timer' => 6000,
                ]);
                return;
            }

            $dayMapping = [
                'Lunes' => 'Monday',
                'Martes' => 'Tuesday',
                'Miercoles' => 'Wednesday',
                'Jueves' => 'Thursday',
                'Viernes' => 'Friday',
            ];

            $employee = Employee::find($this->employee_id);
            if (!$employee) {
                session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'Empleado seleccionado no válido.',
                    'position' => 'center',
                    'timer' => 6000,
                ]);
                return;
            }

            foreach ($this->days as $day) {
                $dayInEnglish = $dayMapping[$day] ?? null;
                if (!$dayInEnglish) {
                    continue;
                }

                $date = now()->startOfWeek()->modify($dayInEnglish)->format('Y-m-d');

                $existingAssist = Assist::where('employee_id', $employee->id)
                    ->where('projet_id', $this->projet_id)
                    ->whereDate('start_date', $date)
                    ->exists();

                if ($existingAssist) {
                    session()->flash('alert', [
                        'type' => 'error',
                        'message' => "El empleado ya tiene asistencia registrada para el día $day.",
                        'position' => 'center',
                        'timer' => 6000,
                    ]);
                    continue;
                }

                Assist::create([
                    'employee_id' => $employee->id,
                    'projet_id' => $this->projet_id,
                    'start_date' => $date . ' ' . $schedule->start,
                    'status' => 1,
                    'user_id' => auth()->id(),
                ]);
            }

            if ($this->extra_hours_diurnas) {
                NumberOfHour::updateOrCreate(
                    [
                        'date' => $this->start_week,
                        'employee_id' => $employee->id,
                        'type_of_hours' => 0,
                    ],
                    [
                        'amount' => $this->extra_hours_diurnas,
                    ]
                );
            }

            if ($this->extra_hours_nocturnas) {
                NumberOfHour::updateOrCreate(
                    [
                        'date' => $this->start_week,
                        'employee_id' => $employee->id,
                        'type_of_hours' => 1,
                    ],
                    [
                        'amount' => $this->extra_hours_nocturnas,
                    ]
                );
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Asistencia registrada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('assists.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error registrando asistencia: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('assists.index');
        }
    }




    public function render()
    {
        return view('livewire.assist-bulk.create-assist', [
            'projets' => Projet::all(),
            'employees' => Employee::with('person')->get(),
        ]);
    }
}
