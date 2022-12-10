<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = array(
            array('id' => '1', 'name' => 'Sunway Resort', 'country' => 'my', 'city' => '1949', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 21:57:50', 'updated_at' => '2022-12-07 15:52:59', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Sunway Pyramid Hotel', 'country' => 'my', 'city' => '1949', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:00:09', 'updated_at' => '2022-11-09 05:37:04', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'The Banjaran Hotsprings Retreat', 'country' => 'my', 'city' => '5117', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:03:23', 'updated_at' => '2022-12-10 15:37:40', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'DoubleTree Resort by Hilton Hotel Penang', 'country' => 'my', 'city' => '1939', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"5011850835.jpeg"}]', 'created_at' => '2022-10-26 22:04:15', 'updated_at' => '2022-12-09 20:15:45', 'deleted_at' => NULL),
            array('id' => '5', 'name' => 'Hard Rock Hotel Penang', 'country' => 'my', 'city' => '1939', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:04:55', 'updated_at' => '2022-10-26 22:27:36', 'deleted_at' => NULL),
            array('id' => '6', 'name' => 'Melia Kuala Lumpur', 'country' => 'my', 'city' => '1949', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 22:05:30', 'updated_at' => '2022-10-26 22:29:26', 'deleted_at' => NULL),
            array('id' => '7', 'name' => 'JW Marriott Kuala Lumpur', 'country' => 'my', 'city' => '1949', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 22:06:21', 'updated_at' => '2022-10-26 22:31:19', 'deleted_at' => NULL),
            array('id' => '8', 'name' => 'Grand Lexis Port Dickson', 'country' => 'my', 'city' => '5118', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:08:27', 'updated_at' => '2022-10-26 22:32:17', 'deleted_at' => NULL),
            array('id' => '9', 'name' => 'LUX Grand Gaupe Resort & Villas', 'country' => 'mu', 'city' => '5119', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:17:01', 'updated_at' => '2022-10-26 22:34:33', 'deleted_at' => '2022-10-26 22:34:33'),
            array('id' => '10', 'name' => 'Avani Plus Riverside Bangkok Hotel', 'country' => 'th', 'city' => '3554', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 22:19:16', 'updated_at' => '2022-10-26 22:35:37', 'deleted_at' => '2022-10-26 22:35:37'),
            array('id' => '11', 'name' => 'Amari Phuket', 'country' => 'th', 'city' => '3536', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 22:20:08', 'updated_at' => '2022-10-26 22:38:39', 'deleted_at' => '2022-10-26 22:38:39'),
            array('id' => '12', 'name' => 'Deevana Plaza Phuket', 'country' => 'th', 'city' => '3536', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:20:36', 'updated_at' => '2022-10-26 22:39:31', 'deleted_at' => NULL),
            array('id' => '13', 'name' => 'Pullman Phuket Panwa Beach Resort', 'country' => 'th', 'city' => '3536', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-10-26 22:21:21', 'updated_at' => '2022-10-26 22:21:21', 'deleted_at' => NULL),
            array('id' => '14', 'name' => 'Conrad Koh Samui', 'country' => 'th', 'city' => '5120', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"}]', 'created_at' => '2022-10-26 22:23:22', 'updated_at' => '2022-10-26 22:23:22', 'deleted_at' => NULL),
            array('id' => '15', 'name' => 'Ahmed Wael', 'country' => 'eg', 'city' => '3235', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-11-03 21:03:17', 'updated_at' => '2022-11-09 05:47:06', 'deleted_at' => '2022-11-09 05:47:06'),
            array('id' => '16', 'name' => 'Hotel 1', 'country' => 'eg', 'city' => '3235', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-11-08 20:19:09', 'updated_at' => '2022-11-09 05:47:10', 'deleted_at' => '2022-11-09 05:47:10'),
            array('id' => '20', 'name' => 'Hotel Test', 'country' => 'eg', 'city' => '3235', 'rooms' => '[{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0641\\u0631\\u062f\\u064a\\u0629","image":"1670428379.jpeg"},{"name":"\\u063a\\u0631\\u0641\\u0629 \\u0645\\u0632\\u062f\\u0648\\u062c\\u0629","image":"8352141895.jpeg"}]', 'created_at' => '2022-11-09 05:46:55', 'updated_at' => '2022-11-09 05:47:13', 'deleted_at' => '2022-11-09 05:47:13')
        );


        Hotel::insert($hotels);
    }
}
