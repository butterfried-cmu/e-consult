<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('attachments')->insert([
            [
                'attachment_id' => 'attachment001',
                'consult_id' => 'bbbbbbbbbbbbb',
                'type' => 'file',
                'file_name' => 'file01.txt',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 1)->format('Y-m-d H:i:s')
            ],
            [
                'attachment_id' => 'attachment002',
                'consult_id' => 'bbbbbbbbbbbbb',
                'type' => 'image',
                'file_name' => 'image01.jpg',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 2)->format('Y-m-d H:i:s')
            ],
            [
                'attachment_id' => 'attachment003',
                'consult_id' => 'bbbbbbbbbbbbb',
                'type' => 'image',
                'file_name' => 'image02.png',
                'created_at' => Carbon::create(2015, 2, 1, 0, 0, 3)->format('Y-m-d H:i:s')
            ],
            [
                'attachment_id' => 'attachment004',
                'consult_id' => 'ccccccccccccc',
                'type' => 'file',
                'file_name' => 'file02.txt',
                'created_at' => Carbon::create(2015, 3, 1, 0, 0, 1)->format('Y-m-d H:i:s')
            ],
            [
                'attachment_id' => 'attachment005',
                'consult_id' => 'ccccccccccccc',
                'type' => 'file',
                'file_name' => 'file03.txt',
                'created_at' => Carbon::create(2015, 3, 1, 0, 0, 2)->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
