<?php

namespace App\Services\Parsers;

use Throwable;
use PHPHtmlParser\Exceptions\{ChildNotFoundException,
    CircularException,
    CurlException,
    NotLoadedException,
    StrictException};
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use App\Console\Commands\ParserLinkNewsCommand;
use App\Models\{ParseCategory, ParseLinkNews};

class LinkNewsParser
{
    private const COUNT_PARSE = 5;

    private $command;

    private $parseCategories;

    public function __construct(ParserLinkNewsCommand $command)
    {
        $this->command = $command;
    }

    /**
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws CurlException
     * @throws NotLoadedException
     * @throws StrictException
     */
    public function run()
    {
        if ($this->getParseCategories()->count()) {
            $dom = new Dom();
            foreach ($this->getParseCategories() as $category) {
                sleep(rand(3,30));

                try {
                    $dom->load($category->link);
                    $linkSelector = str_replace(
                        '{date}',
                        (new \DateTime())->format('Y/m/d'),
                        $category->linkSelector
                    );
                    $contents = $dom->find($linkSelector);
                    foreach ($contents as $content)
                    {
                        /** @var HtmlNode $content */
                        if ($this->validate($content, $category->link)) {
                            $this->savePlaceLinkNews($content, $category);
                        }
                    }
                    $this->saveStatusCategory($category);
                } catch (Throwable $e) {
                    $this->command->error($e->getMessage());
                    $this->saveStatusCategory($category);
                }
            }
        } else {
            ParseCategory::query()->update(['status' => ParseCategory::STATUS_NEW]);
            $this->command->info('Updates status by new.');
        }
    }

    private function saveStatusCategory(ParseCategory $category): void
    {
        $category->setStatusLoaded();
        $category->save();
    }

    private function savePlaceLinkNews($node, ParseCategory $category): void
    {
        try {

            $nodeLinkData = parse_url($node->getAttribute('href'));

            $path = $nodeLinkData['path'];
            if (substr($path, strlen($path)-1) == "/") {
                $path = substr($path,0,strlen($path)-1);
            }

            if (isset($nodeLinkData['query'])) {
                parse_str($nodeLinkData['query'], $nodeLinkDataQuery);
                if (isset($nodeLinkDataQuery['id'])) {
                    $path .= '?id=' . $nodeLinkDataQuery['id'];
                }
            }

            /** @var \Illuminate\Database\Eloquent\Collection $collection */
            $collection = ParseLinkNews::where('link', '=', $path)->get();
            if ($collection->count()) {
                return;
            }

            /** @var HtmlNode $node */
            $linkNews = new ParseLinkNews();
            $linkNews->link = $path;
            $linkNews->title = $node->text(true);
            $linkNews->source_id = $category->source_id;
            $linkNews->category_id = $category->category_id;
            $linkNews->error = '';
            $linkNews->save();

        } catch (Throwable $e) {
            $this->command->error($e->getMessage());
        }
    }

    /**
     * @param mixed $node
     * @return bool
     */
    private function validate($node, $link): bool
    {
        $linkData = parse_url($link);
        $nodeLinkData = parse_url($node->getAttribute('href'));
        if ($nodeLinkData['path'] === $linkData['path']) {
            return false;
        }

        /** @var HtmlNode $node */
        $validator = Validator::make(
            [
                'title' => $node->text(true),
                'link' => $node->getAttribute('href'),
            ],
            [
                'title' => ['required'],
                'link' => ['required', 'unique:parse_link_news,link'],
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->command->error($error);
            }

            return false;
        }

        return true;
    }

    /**
     * @return Collection
     */
    private function getParseCategories(): Collection
    {
        if ($this->parseCategories === null) {
            $this->parseCategories = ParseCategory::where('status', ParseCategory::STATUS_NEW)->take(self::COUNT_PARSE)->get();
        }

        return $this->parseCategories;
    }
}
