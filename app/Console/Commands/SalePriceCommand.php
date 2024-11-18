<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SalePriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sale-price-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $books = \App\Models\Books::all();

        foreach ($books as $book) {
            $currentPrice = $book->price;
            $book->old_price = (int) $currentPrice * 2;
            $book->save();
        }

    }
}
