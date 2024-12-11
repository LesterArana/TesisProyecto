<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\BankAccount\CreateBankAccount;
use App\Livewire\BankAccount\EditBankAccount;
use App\Livewire\BankAccount\ShowBankAccounts;
use App\Livewire\BankAccount\TableBankAccount;
use App\Livewire\PaymentMethod\CreatePaymentMethod;
use App\Livewire\PaymentMethod\EditPaymentMehthod;
use App\Livewire\PaymentMethod\ShowPaymentMethod;
use App\Livewire\PaymentMethod\TablePaymentMethod;
use App\Livewire\Supplier\CreateSupplier;
use App\Livewire\Supplier\EditSupplier;
use App\Livewire\Supplier\ShowSupplier;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/supplier/index', \App\Livewire\Supplier\TableSupplier::class)->name('supplier.index')->middleware('can:supplier.index');
    Route::get('/supplier/create',  CreateSupplier::class)->name('supplier.create')->middleware('can:supplier.create');
    Route::get('/supplier/{supplier}/edit', EditSupplier::class)->name('supplier.edit')->middleware('can:supplier.edit');
    Route::get('/supplier/{supplier}', ShowSupplier::class)->name('supplier.show')->middleware('can:supplier.show');

    Route::get('/payment_methods', TablePaymentMethod::class)->name('payment_methods.index')->middleware('can:payment_methods.index');
    Route::get('/payment_methods/create', CreatePaymentMethod::class)->name('payment_methods.create')->middleware('can:payment_methods.create');
    Route::get('/payment_methods/{payment_method}/edit', EditPaymentMehthod::class)->name('payment_methods.edit')->middleware('can:payment_methods.edit');
    Route::get('/payment_methods/{payment_method}', ShowPaymentMethod::class)->name('payment_methods.show')->middleware('can:payment_methods.show');

    Route::get('/bank_accounts', TableBankAccount::class)->name('bank_account.index')->middleware('can:bank_account.index');
    Route::get('/bank_accounts/create', CreateBankAccount::class)->name('bank_account.create')->middleware('can:bank_account.create');
    Route::get('/bank_accounts/{bank_account}/edit', EditBankAccount::class)->name('bank_account.edit')->middleware('can:bank_account.edit');
    Route::get('/bank_accounts/{bank_account}', ShowBankAccounts::class)->name('bank_account.show')->middleware('can:bank_account.show');

    Route::get('/credits', \App\Livewire\Credit\TableCredit::class)->name('credit.index')->middleware('can:credit.index');
    Route::get('/credits/create', \App\Livewire\Credit\CreateCredit::class)->name('credit.create')->middleware('can:credit.create');
    Route::get('/credits/{credit}/edit', \App\Livewire\Credit\EditCredit::class)->name('credit.edit')->middleware('can:credit.edit');
    Route::get('/credits/{credit}', \App\Livewire\Credit\ShowCredit::class)->name('credit.show')->middleware('can:credit.show');


    Route::get('/destination_plants',\App\Livewire\DestionationPlant\TableDestinationPlant::class)->name('destination_plant.index')->middleware('can:destination_plant.index');
    Route::get('/destination_plants/create', \App\Livewire\DestionationPlant\CreateDestinationPlant::class)->name('destination_plant.create')->middleware('can:destination_plant.create');
    Route::get('/destination_plants/{destinationPlant}/edit', \App\Livewire\DestionationPlant\EditDestinationPlant::class)->name('destination_plant.edit')->middleware('can:destination_plant.edit');
    Route::get('/destination_plants/{destinationPlant}', \App\Livewire\DestionationPlant\ShowDestinationPlant::class)->name('destination_plant.show')->middleware('can:destination_plant.show');


    Route::get('/users',\App\Livewire\User\TableUser::class)->name('user.index')->middleware('can:user.index');
    Route::get('/users/create', \App\Livewire\User\CreateUser::class)->name('user.create')->middleware('can:user.create');
    Route::get('/users/{user}/edit',\App\Livewire\User\EditUser::class)->name('user.edit')->middleware('can:user.edit');
    Route::get('/users/{user}',\App\Livewire\User\ShowUser::class)->name('user.show')->middleware('can:user.show');

    Route::get('/dashboard',\App\Livewire\Components\DashboardCharts::class)->name('dashboard')->middleware('can:dashboard');


    Route::get('/welcome-iglu', \App\Livewire\Components\WelcomeIglu::class)->name('welcome_iglu');

});

require __DIR__.'/auth.php';
