<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
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
                'name' => 'Business',
                'title' => 'Business',
                'Description' => 'Business',
            ],
            [
                'id' => 2,
                'name' => 'Technology',
                'title' => 'Technology',
                'Description' => 'Technology',
            ],
        ];

        foreach ($data as $item) {
            $item['slug'] = Str::slug('Business', '');
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('category')->insert($item);
        }
    }
}
