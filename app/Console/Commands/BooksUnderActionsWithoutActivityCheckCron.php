<?php

namespace App\Console\Commands;

use App\Models\BooksUnderAction;
use Illuminate\Console\Command;

class BooksUnderActionsWithoutActivityCheckCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actions:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $books = BooksUnderAction::booksUnderActionsWithoutAction();
            foreach ($books as $book) {
                $book->delete();
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
