<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['italian', 'english', 'spanish', 'german', 'french'];


        foreach ($tags as $tag) {

            $new_tags = new Tag();

            $new_tags->name = $tag;
            $new_tags->slug = Str::slug($new_tags->name, '-');

            $new_tags->save();
        }
    }
}
