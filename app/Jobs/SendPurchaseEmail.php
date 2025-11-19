<?php

namespace App\Jobs;

use App\Mail\PaymentStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPurchaseEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customerName;
    protected $orderNumber;
    protected $orderDate;
    protected $orderTotal;
    protected $status;
    protected $email;
    protected $additionalData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customerName, $orderNumber, $orderDate, $orderTotal, $status, $email, $additionalData = [])
    {
        $this->customerName = $customerName;
        $this->orderNumber = $orderNumber;
        $this->orderDate = $orderDate;
        $this->orderTotal = $orderTotal;
        $this->status = $status;
        $this->email = $email;
        $this->additionalData = $additionalData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Extract billing and product info from additional data
        $billingInfo = isset($this->additionalData['billingName']) ? [
            'name' => $this->additionalData['billingName'],
            'address' => $this->additionalData['billingAddress'] ?? '',
            'city' => $this->additionalData['billingCity'] ?? '',
            'country' => $this->additionalData['billingCountry'] ?? '',
        ] : [];
        
        $productInfo = isset($this->additionalData['productName']) ? [
            'name' => $this->additionalData['productName'],
            'quantity' => $this->additionalData['productQuantity'] ?? 1,
            'price' => $this->additionalData['productPrice'] ?? 0,
            'days' => $this->additionalData['productDays'] ?? null,
            'nights' => $this->additionalData['productNights'] ?? null,
            'departureDate' => $this->additionalData['departureDate'] ?? null,
        ] : [];
        
        $passengers = $this->additionalData['passengers'] ?? [];
        
        Mail::to($this->email)->bcc('cynthiagarsketurismo@gmail.com')->send(new PaymentStatus(
            $this->customerName,
            $this->orderNumber,
            $this->orderDate,
            $this->orderTotal,
            $this->status,
            $this->email,
            $billingInfo,
            $productInfo,
            $passengers
        ));
    }
}
