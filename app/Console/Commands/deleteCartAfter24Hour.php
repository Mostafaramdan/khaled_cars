<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon ;
use App\Models\carts;

class deleteCartAfter24Hour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteCartAfter24Hour:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command delete any cart exceed 24 hour of it\'s creation time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $day = Carbon::parse('now')->addDay(1)->format("Y-m-d h:i:s");
        foreach(carts::where('created_at','<=' ,$day)->where('orders_id',null)->get() as $cart){
            $cart->delete();
        }
    }
}
