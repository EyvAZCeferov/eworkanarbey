<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Payments;
use Illuminate\Console\Command;

class UserPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:status';

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
        $payments=Payments::where('payment_status',1)->where('end_time', '=<', Carbon::now()->format('Y-m-d'))->get();
        foreach($payments as $payment){
            $payment->update(['payment_status'=>false]);
        }
    }
}
