<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPHtmlParser\Dom;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class ParseSaveToFilerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "parserSaveToFile:test";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Parser save to file";

    /**
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\CurlException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    public function handle()
    {
        $categoryUrl = 'https://www.bbc.com/news/technology';
        $categoryUrl = 'https://www.nytimes.com/section/business';
        $categoryUrl = 'https://abcnews.go.com/Business';
        $categoryUrl = 'https://edition.cnn.com/business';

        $fileName = implode(DIRECTORY_SEPARATOR, [
            __DIR__,
            'data',
            'parser',
            str_replace([ '.', '/', 'html', ':'], '_', $categoryUrl),
        ]);

        $dom = new Dom();
        $dom->load($categoryUrl);
        $html = $dom->outerHtml;

        $file = fopen($fileName, 'w');
        fwrite($file, $html);
        fclose($file);

        $this->info('Done!');
    }
}
