<?php

namespace App\Services\Parsers;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use App\Console\Commands\ParserNewsContentCommand;

class ContentNewsParser
{
    private $command;

    public function __construct(ParserNewsContentCommand $command)
    {
        $this->command = $command;
    }

    public function run()

    {
        $dom = new Dom();

        $index = 0;
        $data = [
            // NYTimes
            [
                'link' => 'https://www.nytimes.com/2019/10/10/business/road-trips.html',
                'titleSelector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'descriptionSelector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'imageSelector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'contentSelector' => '*[itemprop="articleBody"]',
                'contentFilterSelector' => 'p[class^="css"], h2[class^="css"]',
            ],
            // ABCNews
            [
                'link' => 'https://abcnews.go.com/Business/amazon-takes-public-stand-minimum-wage-climate-change/story?id=66208132&cid=clicksource_74_null_headlines_hed',
                'titleSelector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'descriptionSelector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'imageSelector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'contentSelector' => '.article-body',
                'contentFilterSelector' => 'p[itemprop="articleBody"]',
            ],
            // CNN
            [
                'link' => 'https://edition.cnn.com/2019/10/11/tech/apple-tim-cook-letter-hkmap-live/index.html',
                'titleSelector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'descriptionSelector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'imageSelector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'contentSelector' => '*[itemprop="articleBody"]',
                'contentFilterSelector' => '.zn-body__paragraph',
            ],
            // BBS
            [
                'link' => 'https://www.bbc.com/news/technology-50018512',
                'titleSelector' => 'head meta[name="og:title"], head meta[property="og:title"]',
                'descriptionSelector' => 'head meta[name="og:description"], head meta[property="og:description"]',
                'imageSelector' => 'head meta[name="og:image"], head meta[property="og:image"]',
                'contentSelector' => '*[property="articleBody"]',
                'contentFilterSelector' => 'p',
            ],
        ];

        $dom->load($data[$index]['link']);
        $this->command->info('Start');

        $this->getOGContent($dom, $data[$index]['titleSelector']);
        $this->getOGContent($dom, $data[$index]['descriptionSelector']);
        $this->getOGContent($dom, $data[$index]['imageSelector']);

        // contentSelector
        $this->command->info('Start content');
        $this->getNewsContent($dom, $data[$index]['contentSelector'], $data[$index]['contentFilterSelector']);
        $this->command->info('End');
    }

    private function getNewsContent(Dom $dom, $contentSelector, $filterSelector)
    {
        $contents = $dom->find($contentSelector);

        if (isset($contents[0])) {
            /** @var $node HtmlNode */
            $node = $contents[0];

            $domContent = new Dom;
            $domContent->loadStr($node->innerHtml());
            // contentFilterSelector
            $contentsContent = $domContent->find($filterSelector);
            $newsContentData = [];
            foreach ($contentsContent as $item) {

                /** @var $item HtmlNode */
                $this->command->info($item->tag->name());
                $newsContentData[$item->id()] = [
                    'tag' => $item->tag->name(),
                    'content' => trim(strip_tags($item->innerHtml())),
                ];
            }

            ksort($newsContentData);

            $result = "<div>";

            foreach ($newsContentData as $id => $item) {
                $tag = $item['tag'];
                $content = $item['content'];
                $result .= "<$tag>$content</$tag>";
            }

            $result .= "</div>";

            $this->command->info($result);

        }
    }

    private function getOGContent(Dom $dom, string  $selector)
    {
        $contents = $dom->find($selector);

        if (isset($contents[0])) {
            /** @var $node HtmlNode */
            $node = $contents[0];

            if ($node->hasAttribute('name')) {
                $this->command->info($node->getAttribute('content'));
            } elseif ($node->hasAttribute('property')) {
                $this->command->info($node->getAttribute('content'));
            } else {
                $this->command->error('Not find attribute name or property.');
            }
        } else {
            $this->command->error('Not find element by selector - ' . $selector);
        }
    }
}
