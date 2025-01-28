<?php

use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/credits', \App\Livewire\Credit\TableCredit::class)->name('credit.index')->middleware('can:credit.index');
    Route::get('/credits/create', \App\Livewire\Credit\CreateCredit::class)->name('credit.create')->middleware('can:credit.create');
    Route::get('/credits/{credit}', \App\Livewire\Credit\ShowCredit::class)->name('credit.show')->middleware('can:credit.show');

    Route::get('/users',\App\Livewire\User\TableUser::class)->name('user.index')->middleware('can:user.index');
    Route::get('/users/create', \App\Livewire\User\CreateUser::class)->name('user.create')->middleware('can:user.create');
    Route::get('/users/{user}/edit',\App\Livewire\User\EditUser::class)->name('user.edit')->middleware('can:user.edit');
    Route::get('/users/{user}',\App\Livewire\User\ShowUser::class)->name('user.show')->middleware('can:user.show');

    Route::get('/dashboard',\App\Livewire\Components\DashboardCharts::class)->name('dashboard')->middleware('can:dashboard');

    Route::get('/positions', \App\Livewire\Position\TablePosition::class)->name('positions.index');
    Route::get('/positions/create', \App\Livewire\Position\CreatePosition::class)->name('positions.create');
    Route::get('/positions/{position}/edit', \App\Livewire\Position\EditPosition::class)->name('positions.edit');
    Route::get('/positions/{position}', \App\Livewire\Position\ShowPosition::class)->name('positions.show');

    Route::get('/employees', \App\Livewire\Employee\TableEmployee::class)->name('employees.index');
    Route::get('/employees/create', \App\Livewire\Employee\CreateEmployee::class)->name('employees.create');
    Route::get('/employees/{employee}/edit', \App\Livewire\Employee\EditEmployee::class)->name('employees.edit');
    Route::get('/employees/{employee}', \App\Livewire\Employee\ShowEmployee::class)->name('employees.show');

    Route::get('/employees/{employee}/download-qr', function (Employee $employee) {
        $data = [
            'id' => $employee->id,
            'name' => $employee->person->name,
        ];

        $qrCode = QrCode::format('png')->size(300)->generate(json_encode($data));

        return response($qrCode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="employee-qr-' . $employee->id . '.png"');
    })->name('employees.download-qr');

    Route::get('/assists', \App\Livewire\Assist\TableAssist::class)->name('assists.index');
    Route::get('/assists/bulk-create', \App\Livewire\AssistBulk\CreateAssist::class)->name('assists.create.bulk');
    Route::get('/assists/create/manual', \App\Livewire\Assist\CreateManualAssist::class)->name('assists.create.manual');
    Route::get('/assists/create/qr', \App\Livewire\Assist\CreateQrAssist::class)->name('assists.create.qr');
    Route::get('/assists/{assist}/edit', \App\Livewire\Assist\EditAssist::class)->name('assists.edit');
    Route::get('/assists/{assist}', \App\Livewire\Assist\ShowAssist::class)->name('assists.show');

    Route::get('/projets', \App\Livewire\Projet\TableProjet::class)->name('projets.index');
    Route::get('/projets/create', \App\Livewire\Projet\CreateProjet::class)->name('projets.create');
    Route::get('/projets/{projet}/edit', \App\Livewire\Projet\EditProjet::class)->name('projets.edit');
    Route::get('/projets/{projet}', \App\Livewire\Projet\ShowProjet::class)->name('projets.show');

    Route::get('/travel-expenses', \App\Livewire\TravelExpense\TableTravelExpense::class)->name('travel-expenses.index');
    Route::get('/travel-expenses/create', \App\Livewire\TravelExpense\CreateTravelExpense::class)->name('travel-expenses.create');
    Route::get('/travel-expenses/{travelExpense}/edit', \App\Livewire\TravelExpense\EditTravelExpense::class)->name('travel-expenses.edit');
    Route::get('/travel-expenses/{travelExpense}', \App\Livewire\TravelExpense\ShowTravelExpense::class)->name('travel-expenses.show');

    Route::get('/number-of-hours', \App\Livewire\NumberOfHours\TableNumberOfHours::class)->name('number-of-hours.index');
    Route::get('/number-of-hours/create', \App\Livewire\NumberOfHours\CreateNumberOfHours::class)->name('number-of-hours.create');
    Route::get('/number-of-hours/{numberOfHours}/edit', \App\Livewire\NumberOfHours\EditNumberOfHours::class)->name('number-of-hours.edit');
    Route::get('/number-of-hours/{numberOfHours}', \App\Livewire\NumberOfHours\ShowNumberOfHours::class)->name('number-of-hours.show');

    Route::get('/fixed-payments', \App\Livewire\FixedPayments\TableFixedPayments::class)->name('fixed-payments.index');
    Route::get('/fixed-payments/create', \App\Livewire\FixedPayments\CreateFixedPayments::class)->name('fixed-payments.create');
    Route::get('/fixed-payments/{fixedPayment}/edit', \App\Livewire\FixedPayments\EditFixedPayments::class)->name('fixed-payments.edit');
    Route::get('/fixed-payments/{fixedPayment}', \App\Livewire\FixedPayments\ShowFixedPayments::class)->name('fixed-payments.show');

    Route::get('/schedules', \App\Livewire\Schedules\TableSchedules::class)->name('schedules.index');
    Route::get('/schedules/create', \App\Livewire\Schedules\CreateSchedules::class)->name('schedules.create');
    Route::get('/schedules/{schedule}/edit', \App\Livewire\Schedules\EditSchedules::class)->name('schedules.edit');
    Route::get('/schedules/{schedule}', \App\Livewire\Schedules\ShowSchedules::class)->name('schedules.show');

    Route::get('/payrolls', \App\Livewire\Payrolls\TablePayroll::class)->name('payrolls.index');
    Route::get('/payrolls/generate', \App\Livewire\Payrolls\GeneratePayroll::class)->name('payrolls.create');
    Route::get('/payrolls/{payroll}', \App\Livewire\Payrolls\ShowPayroll::class)->name('payrolls.show');






    Route::get('/welcome-iserpro', \App\Livewire\Components\WelcomeIserpro::class)->name('welcome_iserpro');

});

require __DIR__.'/auth.php';
