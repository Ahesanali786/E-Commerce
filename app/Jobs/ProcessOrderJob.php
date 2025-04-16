<?php

namespace App\Jobs;

use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ProcessOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Log::info('ProcessOrderJob is running for order ID: ' . $this->order->id);
        // sendin email with order details
        Mail::to($this->order->user->email)->send(new OrderPlacedMail($this->order));
    }
}
