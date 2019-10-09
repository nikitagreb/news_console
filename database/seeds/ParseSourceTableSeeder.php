<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParseSourceTableSeeder extends Seeder
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
                'id' => 1,
                'name' => 'BBS',
                'site' => 'https://www.bbc.com',
            ],
            [
                'id' => 2,
                'name' => 'NYTimes',
                'site' => 'https://www.nytimes.com',
            ],
            [
                'id' => 3,
                'name' => 'ABCNews',
                'site' => 'https://abcnews.go.com',
            ],
            [
                'id' => 4,
                'name' => 'CNN',
                'site' => 'https://edition.cnn.com',
            ],
        ];

        foreach ($data as $item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('parse_source')->insert($item);
        }
    }
}
