<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\BookAction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class ExpiredReservationsCheckCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:check';

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
            $reservations = Book::getBreachedReservations();
            foreach ($reservations as $reservation) {
                // Genreate action model for returned book
                $bookActionModel = new BookAction();
                $bookActionModel->book()->associate($reservation);
                $bookActionModel->librarian()->associate($reservation->activeAction->librarian->id);
                $bookActionModel->status()->associate(5);
                $bookActionModel->action_start = $reservation->activeAction->action_start;
                $bookActionModel->action_deadline = $reservation->activeAction->action_deadline;
                $bookActionModel->action_addons = date('Y-m-d');
                $bookActionModel->save();
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
