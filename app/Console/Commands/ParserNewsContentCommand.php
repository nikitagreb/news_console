<?php

namespace App\Console\Commands;

use App\Services\Parsers\ContentNewsParser;
use PHPHtmlParser\Exceptions\{ChildNotFoundException,
    CircularException,
    CurlException,
    NotLoadedException,
    StrictException};
use Illuminate\Console\Command;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class ParserNewsContentCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "parser:newsContent";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Parser news content";

    /**
     * Execute the console command.
     *
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws NotLoadedException
     * @throws StrictException
     * @throws CurlException
     */
    public function handle()
    {
        $service = new ContentNewsParser($this);
        $service->run();
    }
}
