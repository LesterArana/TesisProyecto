<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name'=>'SuperAdmin']);
        $role2=Role::create(['name'=>'Admin']);
        $role3=Role::create(['name'=>'Operator']);

        Permission::create(['name'=>'dashboard'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'category.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'category.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'category.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'category.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'category.show'])->syncRoles([$role1,$role2]);;

        Permission::create(['name'=>'product.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'product.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'product.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'product.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'product.show'])->syncRoles([$role1,$role2,$role3]);;

        Permission::create(['name'=>'supplier.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'supplier.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'supplier.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'supplier.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'supplier.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'customer.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'customer.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'customer.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'customer.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'customer.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'payment_methods.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'payment_methods.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'payment_methods.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'payment_methods.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'payment_methods.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'bank_account.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'bank_account.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'bank_account.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'bank_account.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'bank_account.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'credit.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'credit.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'credit.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'credit.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'credit.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'shopping.index'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'shopping.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'shopping.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'shopping.show'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'destination_plant.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'destination_plant.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'destination_plant.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'destination_plant.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'destination_plant.show'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'sale.index'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'sale.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'sale.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'sale.show'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'customer_payment.index'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'customer_payment.create'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'customer_payment.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'customer_payment.show'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name'=>'user.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'user.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'user.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'user.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'user.show'])->syncRoles([$role1,$role2]);

        //Permission::create(['name'=>'role.index'])->syncRoles([$role1,$role2]);
    }
}
