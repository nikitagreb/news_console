<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class TestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "test:test";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Test";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info(env('NEWS_API_KEY'));
        $this->info("Test");
        return;

//        try {
//            $posts = Post::getPosts();
//
//            if (!$posts) {
//                $this->info("No posts exist");
//                return;
//            }
//            foreach ($posts as $post) {
//                $post->delete();
//            }
//            $this->info("All posts have been deleted");
//        } catch (Exception $e) {
//            $this->error("An error occurred");
//        }
    }
}
