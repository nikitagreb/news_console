<?php


namespace App\Services\Parsers;


use Illuminate\Database\Eloquent\Collection;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use Illuminate\Support\Facades\Validator;
use App\Console\Commands\TestParserCommand;
use App\Models\{ParseCategory, ParseLinkNews};

class LinkNewsParser
{
    private const COUNT_PARSE = 2;

    private $command;

    private $parseCategories;

    public function __construct(TestParserCommand $command)
    {
        $this->command = $command;
    }

    /**
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\CurlException
     * @throws \PHPHtmlParser\Exceptions\NotLoadedException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    public function run()
    {
        if ($this->getParseCategories()->count()) {
            $dom = new Dom();
            foreach ($this->getParseCategories() as $category) {
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
                $category->setStatusLoaded();
                $category->save();
            }
        } else {
            ParseCategory::query()->update(['status' => ParseCategory::STATUS_NEW]);
            $this->command->info('Updates status by new.');
        }
    }

    private function savePlaceLinkNews($node, ParseCategory $category): void
    {
        /** @var HtmlNode $node */
        $linkNews = new ParseLinkNews();
        $linkNews->link = $node->getAttribute('href');
        $linkNews->title = $node->text(true);
        $linkNews->source_id = $category->source_id;
        $linkNews->category_id = $category->category_id;
        $linkNews->save();
    }

    /**
     * @param mixed $node
     * @return bool
     */
    private function validate($node, $link): bool
    {
        $nodeLink = $node->getAttribute('href');
        if ($nodeLink === $link) {
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