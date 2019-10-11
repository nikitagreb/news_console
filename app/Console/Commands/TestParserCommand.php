<?php


namespace App\Console\Commands;

use App\Services\Parsers\LinkNewsParser;
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
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws NotLoadedException
     * @throws StrictException
     * @throws \PHPHtmlParser\Exceptions\CurlException
     */
    public function handle()
    {
        $service = new LinkNewsParser($this);
        $service->run();

    }
}
