<?php

namespace App\Services\Parsers;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use PHPHtmlParser\Exceptions\{ChildNotFoundException,
    CircularException,
    NotLoadedException,
    UnknownChildTypeException,
    StrictException};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use App\Console\Commands\ParserNewsContentCommand;
use App\Models\{News, ParseCategory, ParseLinkNews};
use Throwable;

/**
 * Class ContentNewsParser
 * @package App\Services\Parsers
 */
class ContentNewsParser
{
    private const COUNT_PARSE = 1;

    private $command;

    private $parseLinkNews;

    private $validateErrors;

    /**
     * ContentNewsParser constructor.
     * @param ParserNewsContentCommand $command
     */
    public function __construct(ParserNewsContentCommand $command)
    {
        $this->command = $command;
    }

    public function run()
    {
        $dom = new Dom();

        $news = $this->getParseLinkNews();

        foreach ($news as $newsItem) {

            sleep(rand(3,30));

            try {
                /** @var $newsItem ParseLinkNews */
                $dom->load($newsItem->getAbsoluteLink());

                $attributes = [];
                $attributes['title'] = $this->getOGContent($dom, $newsItem->source->parseNews->title_selector);
                $attributes['description'] = $this->getOGContent($dom, $newsItem->source->parseNews->description_selector);
                $attributes['image'] = $this->getOGContent($dom, $newsItem->source->parseNews->image_selector);
                $attributes['category_id'] = $newsItem->category_id;
                $attributes['source_id'] = $newsItem->source_id;
                $attributes['link'] = $newsItem->link;
                $attributes['text'] = $this->getNewsContent($dom, $newsItem->source->parseNews->content_selector, $newsItem->source->parseNews->content_filter_selector);

                if ($this->validate($attributes)) {
                    $news = new News();
                    $news->fill($attributes);
                    if ($news->save()) {
                        $newsItem->saveStatusLoaded();
                    };
                } else {
                    $newsItem->saveStatusError($this->validateErrors);
                }
            } catch (Throwable $e) {
                $this->command->error($e->getMessage());
                $newsItem->saveStatusError($e->getMessage());
            }
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function validate(array $attributes): bool
    {
        $validator = Validator::make($attributes,
            [
                'title' => ['required'],
                'description' => ['required'],
                'image' => ['required'],
                'category_id' => ['required'],
                'source_id' => ['required'],
                'link' => ['required'],
                'text' => ['required'],
            ]
        );

        if ($validator->fails()) {
            $this->validateErrors = implode(', ', $validator->errors()->all());
            foreach ($validator->errors()->all() as $error) {
                $this->command->error($error);
            }

            return false;
        }

        return true;
    }

    /**
     * @param Dom $dom
     * @param $contentSelector
     * @param $filterSelector
     * @return string|null
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws NotLoadedException
     * @throws StrictException
     * @throws UnknownChildTypeException
     */
    private function getNewsContent(Dom $dom, $contentSelector, $filterSelector): ?string
    {
        $contents = $dom->find($contentSelector);

        if (isset($contents[0])) {
            /** @var $node HtmlNode */
            $node = $contents[0];

            $domContent = new Dom;
            $domContent->loadStr($node->innerHtml());

            // тут бывают ошибки в самой библиотеке
            $contentsContent = @$domContent->find($filterSelector);
            $newsContentData = [];

            foreach ($contentsContent as $item) {
                /** @var $item HtmlNode */
                $newsContentData[$item->id()] = [
                    'tag' => $item->tag->name(),
                    'content' => trim(strip_tags($item->innerHtml())),
                ];
            }

            ksort($newsContentData);

            $result = "";

            foreach ($newsContentData as $id => $item) {
                $tag = $item['tag'];
                $content = $item['content'];
                $result .= "<$tag>$content</$tag>";
            }

            return $result;
        }

        return null;
    }

    /**
     * @param Dom $dom
     * @param string $selector
     * @return string|null
     * @throws ChildNotFoundException
     * @throws NotLoadedException
     */
    private function getOGContent(Dom $dom, string  $selector): ?string
    {
        $contents = $dom->find($selector);

        if (isset($contents[0])) {
            /** @var $node HtmlNode */
            $node = $contents[0];

            if ($node->hasAttribute('name')) {
                return $node->getAttribute('content');
            } elseif ($node->hasAttribute('property')) {
                return $node->getAttribute('content');
            } else {
                $this->command->error('Not find attribute name or property.');
            }
        } else {
            $this->command->error('Not find element by selector - ' . $selector);
        }

        return null;
    }

    /**
     * @return Collection
     */
    private function getParseLinkNews(): Collection
    {
        if ($this->parseLinkNews === null) {
            $this->parseLinkNews = ParseLinkNews::with('source.parseNews')
                ->where('status', ParseCategory::STATUS_NEW)
                ->take(self::COUNT_PARSE)
                ->get();
        }

        return $this->parseLinkNews;
    }
}
