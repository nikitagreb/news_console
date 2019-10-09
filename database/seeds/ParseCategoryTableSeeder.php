<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParseCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 2,
                'source_id' => 1,
                'link' => 'https://www.bbc.com/news/technology',
                'linkSelector' => 'a[href^="/news/technology"]',
            ],
            [
                'category_id' => 1,
                'source_id' => 2,
                'link' => 'https://www.nytimes.com/section/business',
                'linkSelector' => 'a[href^="/{date}/business/"]',
            ],
            [
                'category_id' => 1,
                'source_id' => 3,
                'link' => 'https://abcnews.go.com/Business',
                'linkSelector' => 'a[href^="https://abcnews.go.com/Business"]',
            ],
            [
                'category_id' => 1,
                'source_id' => 4,
                'link' => 'https://edition.cnn.com/business',
                'linkSelector' => 'a[href^="/{date}/business/"]',
            ],
        ];

        foreach ($data as $item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('parse_category')->insert($item);
        }
    }
}
