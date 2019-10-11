<?php


namespace App\Console\Commands;

use App\Services\Parsers\LinkNewsParser;
use PHPHtmlParser\Exceptions\{ChildNotFoundException, CircularException, NotLoadedException, StrictException};
use Illuminate\Console\Command;


/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class ParserLinkNewsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "parser:linkByNews";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Parser links by news";

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
