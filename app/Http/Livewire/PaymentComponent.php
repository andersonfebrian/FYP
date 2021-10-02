<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use \Stripe\StripeClient;

class PaymentComponent extends Component
{

    protected $stripe;

    public $transaction;

    public $client_secret;

    public $state = 'init';

    protected $listeners = [
        'paymentSuccess',
        'cancelPayment'
    ];

    public function paymentSuccess($paymentIntent) {
        $transaction = Transaction::where('payment_intent_id', $paymentIntent['id'])->first();
        $transaction->update([
            'payment_status' => $paymentIntent['status']
        ]);

        $this->transaction = $transaction;

        $this->state = 'success';
        return;
    }

    public function cancelPayment() {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $cancelled_intent = $this->stripe->paymentIntents->cancel($this->transaction->payment_intent_id, ['cancellation_reason' => 'requested_by_customer']);
        $this->transaction->update([
            'payment_status' => $cancelled_intent['status']
        ]);

        $this->state = 'canceled';
        return;
    }

    public function mount() {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $this->client_secret = $this->stripe->paymentIntents->retrieve($this->transaction->payment_intent_id, [])->client_secret;
    }

    public function render()
    {
        return view('livewire.payment-component');
    }
}
