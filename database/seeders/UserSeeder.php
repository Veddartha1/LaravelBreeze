<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuari i admin tenen password 12345678

        $usuari = new User();
        $usuari->name = 'usuari';
        $usuari->email = 'usuari@email.com';
        $usuari->password = '$2y$10$uKLjyCzWCRcM.Dp6f.ML4e/5dhCIGVfvlu8hHiFmFEyuf97likLUq';
        $usuari->save();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@email.com';
        $admin->password = '$2y$10$uKLjyCzWCRcM.Dp6f.ML4e/5dhCIGVfvlu8hHiFmFEyuf97likLUq';
        $admin->save();

        User::factory()->count(10)->create();
    }
}
