<?php

namespace Database\Seeders;

use App\Models\Reply_post;
use Illuminate\Database\Seeder;

class ReplyPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reply_post::class, 100)->create()->each(function ($reply_post) {
            $reply_post->save();
        });
    }
}
