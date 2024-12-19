<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\PaymentMethod\CreatePaymentMethod;
use App\Livewire\PaymentMethod\EditPaymentMehthod;
use App\Livewire\PaymentMethod\ShowPaymentMethod;
use App\Livewire\PaymentMethod\TablePaymentMethod;
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


    Route::get('/payment_methods', TablePaymentMethod::class)->name('payment_methods.index')->middleware('can:payment_methods.index');
    Route::get('/payment_methods/create', CreatePaymentMethod::class)->name('payment_methods.create')->middleware('can:payment_methods.create');
    Route::get('/payment_methods/{payment_method}/edit', EditPaymentMehthod::class)->name('payment_methods.edit')->middleware('can:payment_methods.edit');
    Route::get('/payment_methods/{payment_method}', ShowPaymentMethod::class)->name('payment_methods.show')->middleware('can:payment_methods.show');

    Route::get('/credits', \App\Livewire\Credit\TableCredit::class)->name('credit.index')->middleware('can:credit.index');
    Route::get('/credits/create', \App\Livewire\Credit\CreateCredit::class)->name('credit.create')->middleware('can:credit.create');
    Route::get('/credits/{credit}/edit', \App\Livewire\Credit\EditCredit::class)->name('credit.edit')->middleware('can:credit.edit');
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
    Route::get('/assists/create/manual', \App\Livewire\Assist\CreateManualAssist::class)->name('assists.create.manual');
    Route::get('/assists/create/qr', \App\Livewire\Assist\CreateQrAssist::class)->name('assists.create.qr');
    Route::get('/assists/{assist}/edit', \App\Livewire\Assist\EditAssist::class)->name('assists.edit');
    Route::get('/assists/{assist}', \App\Livewire\Assist\ShowAssist::class)->name('assists.show');

    Route::get('/projets', \App\Livewire\Projet\TableProjet::class)->name('projets.index');
    Route::get('/projets/create', \App\Livewire\Projet\CreateProjet::class)->name('projets.create');
    Route::get('/projets/{projet}/edit', \App\Livewire\Projet\EditProjet::class)->name('projets.edit');
    Route::get('/projets/{projet}', \App\Livewire\Projet\ShowProjet::class)->name('projets.show');



    Route::get('/welcome-iserpro', \App\Livewire\Components\WelcomeIserpro::class)->name('welcome_iserpro');

});

require __DIR__.'/auth.php';
