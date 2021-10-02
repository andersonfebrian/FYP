<div class="container mt-4">
    @if($state == 'init')
        <div class="d-flex justify-content-center mb-2">
            <h2>Payment</h2>
        </div>

        <div class="row rounded-3 border shadow" style="height: 15rem;">
            <div class="col">
                <div class="row mt-2 mb-2" style="height: 2rem;">
                    <div class="col-3">
                        <p><b>Product Name</b></p>
                    </div>
                    <div class="col-3">
                        <p><b>Price</b></p>
                    </div>
                </div>
                @foreach($transaction->purchases as $purchase) 
                    <div class="row">
                        <div class="col-3">
                            <p>{{ $purchase->product->name }}</p>
                        </div>
                        <div class="col-3">
                            <p><b>{{ $purchase->product->currency }}</b> {{ $purchase->product->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-5 border-left">
                <div class="row mt-3 mb-2">
                    <div class="col">
                        <h3><b>Total Payable: MYR</b> {{ $transaction->total_price }}</h3>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <p><b>Card Details</b></p>
                        <div class="mt-2 mb-2">
                            <div id="card-element" class="form-control" style='height: 2.4em; padding-top: .7em;'></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <button id="payment-button" class="btn btn-sm btn-primary form-control" wire:click="$emit('confirm_payment')">Approve Payment</button>
                        <div class="d-flex justify-content-center">
                            <div id="loader" class="loader d-none"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <button id="cancel-button" class="btn btn-sm btn-danger form-control" wire:click="$emit('cancel_payment')">Cancel Payment</button>
                        <div class="d-flex justify-content-center">
                            <div id="cancel-loader" class="loader d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($state == 'success')
        <div class="row d-flex justify-content-center">
            <h1>Payment Successful</h1>
        </div>
        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <span class="far fa-check-circle" style="color: #38c172; min-width: 7.5rem !important; min-height: 7.5rem !important;"></span>
        </div>
        <div class="row mt-3 d-flex justify-content-center" style="height: 11rem !important;">
            <div class="border rounded-3 shadow" style="width: 17rem !important">
                <div class="col h-100 pt-3 pb-3">
                    <div class="row">
                        <div class="col">
                            <p><b>Transaction ID: </b> {{ $transaction->transaction_id }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p><b>Total Paid: </b> {{ $transaction->total_price }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p><b>Date & Time: </b> {{ $transaction->updated_at }}</p>
                        </div>
                    </div>
                    <div class="row d-flex align-items-end">
                        <a href="{{ route('browser.index') }}" class="btn btn-sm btn-success form-control m-3">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    @elseif($state == 'canceled')
        <div class="row d-flex justify-content-center">
            <h1>Payment Cancelled</h1>
        </div>
        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <span class="far fa-times-circle" style="color: #e3342f; min-width: 7.5rem !important; min-height: 7.5rem !important;"></span>
        </div>
        <div class="row mt-3 d-flex justify-content-center" style="height: 9rem !important;">
            <div class="border rounded-3 shadow" style="width: 17rem !important">
                <div class="col h-100 pt-3 pb-3">
                    <div class="row">
                        <div class="col">
                            <p><b>Transaction ID: </b> {{ $transaction->transaction_id }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p><b>Date & Time: </b> {{ $transaction->updated_at }}</p>
                        </div>
                    </div>
                    <div class="row d-flex align-items-end">
                        <a href="{{ route('browser.index') }}" class="btn btn-sm btn-success form-control m-3">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let stripe = new Stripe(`{{ config('services.stripe.public_key') }}`)
            let elements = stripe.elements();
            let cardElement = elements.create('card', {
                hidePostalCode: true,
            });
            cardElement.mount('#card-element');

            window.livewire.on('confirm_payment', () => {

                let button = document.getElementById('payment-button');
                button.classList.add("d-none");

                let loader = document.getElementById('loader');
                loader.classList.remove("d-none");

                let cancelbutton = document.getElementById('cancel-button');
                cancelbutton.disabled = true;

                stripe.confirmCardPayment("{{ $client_secret }}", {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: "{{ auth_user()->full_name }}",
                            email: "{{ auth_user()->email }}"
                        }
                    }
                }).then(
                    (res) => {
                        console.log(res);
                        if(res.paymentIntent) {
                            if(res.paymentIntent.status === "succeeded") {
                                window.livewire.emit('paymentSuccess', res.paymentIntent);
                            }
                        }

                        if(res.error) {
                            Swal.fire({
                                icon: 'error',
                                text: res.error.message,
                                confirmButtonColor: 'green'
                            });

                            loader.classList.add("d-none");
                            button.classList.remove("d-none");
                            cancelbutton.disabled = false;
                        }
                    },
                );
            });

            window.livewire.on('cancel_payment', () => {
                Swal.fire({
                    icon: 'warning',
                    text: 'Confirm cancel payment?',
                    confirmButtonColor: '#e3342f',
                    confirmButtonText: 'Confirm',
                    showCancelButton: true,
                    reverseButtons: true
                }).then(
                    (res) => {
                        if(res.isConfirmed) {

                            let button = document.getElementById('cancel-button');
                            let loader = document.getElementById('cancel-loader');

                            document.getElementById('payment-button').disabled = true;


                            button.classList.add('d-none');
                            loader.classList.remove('d-none');

                            window.livewire.emit('cancelPayment');
                        }
                    }
                );
            });
        });
    </script>
@endpush