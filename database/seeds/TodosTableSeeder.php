<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first();
        $titles = ['Todo作成', '進捗チェック', '提出'];
        //
        foreach($titles as $title){
            DB::table('todos')->insert([
                'title' => $title,
                'body'  => '内容テスト',
                'due_date' => Carbon::now('+1 day'),
                'done_flag' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'user_id' => $user->id,

            ]);
        }
    }
}
