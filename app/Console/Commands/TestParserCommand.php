<?php


namespace App\Console\Commands;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Exceptions\{ChildNotFoundException, CircularException, NotLoadedException, StrictException};
use Illuminate\Console\Command;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class TestParserCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "testParser:test";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Test parser";

    protected $dataCategory = [
        [
            'source' => 'bbc',
            'name' => 'technology',
            'url' => 'https://www.bbc.com/news/technology',
            'linkSelector' => 'a[href^="/news/technology"]',
        ],
        [
            'source' => 'nytimes',
            'name' => 'business',
            'url' => 'https://www.nytimes.com/section/business',
            'linkSelector' => 'a[href^="/{date}/business/"]',
        ],
        [
            'source' => 'abcnews',
            'name' => 'business',
            'url' => 'https://abcnews.go.com/Business',
            'linkSelector' => 'a[href^="https://abcnews.go.com/Business"]',
        ],
        [
            'source' => 'cnn',
            'name' => 'business',
            'url' => 'https://edition.cnn.com/business',
            'linkSelector' => 'a[href^="/{date}/business/"]',
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    /**
     * Execute the console command.
     *
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws NotLoadedException
     * @throws StrictException
     */
    public function handle()
    {
        $i = 2;
        $categoryUrl = $this->dataCategory[$i]['url'];
        $linkSelector = $this->dataCategory[$i]['linkSelector'];
        $linkSelector = str_replace('{date}', (new \DateTime())->format('Y/m/d'), $linkSelector);

        $fileName = implode(DIRECTORY_SEPARATOR, [
            __DIR__,
            'data',
            'parser',
            str_replace([ '.', '/', 'html', ':'], '_', $categoryUrl),
        ]);

        $dom = new Dom();
        $dom->loadFromFile($fileName);

        $contents = $dom->find($linkSelector);

        foreach ($contents as $content)
        {
            /** @var \PHPHtmlParser\Dom\HtmlNode $content */
            $href = $content->getAttribute('href');
            $this->info($content->text(true));
            $this->info($href);
        }

        $this->info('Counts - ' . count($contents));
    }
}
