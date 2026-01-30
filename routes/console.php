<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\TicketingJob;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');


// Schedule::call(new TicketingJob())->everyMinute();
Schedule::call(function(){
    // cari email yg blm dikirim
    // loop
    //{
    //   TicketingJob::dispatch($email->id);
   // }
    
    print_r("Ticketing Job Running \n");
})->everyMinute();