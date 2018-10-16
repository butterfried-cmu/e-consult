<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('messages')->insert([
            [
                'message_id' => 'messageid0001',
                'user_id' => '3333333333333',
                'consult_id' => 'bbbbbbbbbbbbb',
                'message' => 'ข้อความหมายเลข 1',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 1)->format('Y-m-d H:i:s')
            ],
            [
                'message_id' => 'messageid0002',
                'user_id' => '2222222222222',
                'consult_id' => 'bbbbbbbbbbbbb',
                'message' => 'ข้อความหมายเลข 2',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 2)->format('Y-m-d H:i:s')
            ],
            [
                'message_id' => 'messageid0003',
                'user_id' => '2222222222222',
                'consult_id' => 'bbbbbbbbbbbbb',
                'message' => 'ข้อความหมายเลข 3',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 3)->format('Y-m-d H:i:s')
            ],
            [
                'message_id' => 'messageid0004',
                'user_id' => '2222222222222',
                'consult_id' => 'ccccccccccccc',
                'message' => 'ข้อความหมายเลข 4',
                'created_at' => Carbon::create(2015, 3, 1, 0, 0, 1)->format('Y-m-d H:i:s')
            ],
            [
                'message_id' => 'messageid0005',
                'user_id' => '3333333333333',
                'consult_id' => 'ccccccccccccc',
                'message' => 'ข้อความหมายเลข 2',
                'created_at' => Carbon::create(2015, 3, 1, 0, 0, 2)->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
