<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = array(
            array('name' => 'System Adminstrator', 'email' => 'admin@admin.com', 'password' => Hash::make('12345678'), 'photo' => 'admin_avatar.jpg', 'role' => 1, 'created_at' => Carbon::createFromDate(2022, 12, 10), 'updated_at' => Carbon::createFromDate(2022, 12, 10)),
            array('name' => 'Ahmed', 'email' => 'Ahmed@wael.com', 'password' => Hash::make('P@ssw0rd'), 'photo' => 'admin_avatar.jpg', 'role' => 1, 'created_at' => Carbon::createFromDate(2022, 12, 10), 'updated_at' => Carbon::createFromDate(2022, 12, 10)),
        );

        Admin::insert($admins);
    }
}
