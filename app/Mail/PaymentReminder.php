<?php


namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Mail\Mailable;

class PaymentReminder extends Mailable
{
    public $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        return $this->subject('Payment Reminder for Invoice ' . $this->invoice->invoice_number)
                    ->view('emails.payment_reminder');
    }
}
