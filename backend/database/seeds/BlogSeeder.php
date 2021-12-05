<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Blog::create([
                'title'=>'first blog',
                'description'=>'first one is vey important'
            ]);
    }
}
