<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ParseNewsTableSeeder extends Seeder
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
                'source_id' => 2,
                'title_selector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'description_selector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'image_selector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'content_selector' => '*[itemprop="articleBody"]',
                'content_filter_selector' => 'p[class^="css"], h2[class^="css"]',
            ],
            [
                'source_id' => 3,
                'title_selector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'description_selector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'image_selector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'content_selector' => '.article-body',
                'content_filter_selector' => 'p[itemprop="articleBody"]',
            ],
            [
                'source_id' => 4,
                'title_selector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'description_selector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'image_selector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'content_selector' => '*[itemprop="articleBody"]',
                'content_filter_selector' => '.zn-body__paragraph',
            ],
            [
                'source_id' => 1,
                'title_selector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'description_selector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'image_selector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'content_selector' => '*[property="articleBody"]',
                'content_filter_selector' => 'p',
            ],
        ];

        foreach ($data as $item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('parse_news')->insert($item);
        }
    }
}
