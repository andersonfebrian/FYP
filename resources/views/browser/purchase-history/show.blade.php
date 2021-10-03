@extends('browser.layouts.master')

@section('meta-title')
    <title>Purchase History - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <h2>Purchase History</h2>
        </div>

        <div class="mt-2">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date - Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $key=>$transaction) 
                        <tr>
                            <th>{{ $transaction->transaction_id }}</th>
                            <td><b>MYR</b> {{ $transaction->total_price }}</td>
                            <td>{{ $transaction->updated_at }}</td>
                            <td><button data-toggle="collapse" data-target="#collapsible-{{ $key }}" id="expand-{{ $key }}" class="btn btn-sm btn-secondary" aria-expanded="false" aria-controls="collapsible-{{ $key }}">Expand <span class="fas fa-sort-down" style="margin-bottom: .1rem;"></span></button></td>
                        </tr>
                        <tr id="collapsible-{{ $key }}" class="collapse">
                            <th></th>
                            <th class="bg-dark text-white">Product Name</th>
                            <th class="bg-dark text-white">Price</th>
                            <th class="bg-dark text-white">Action</th>
                        </tr>
                        <tr id="collapsible-{{ $key }}" class="collapse">
                            
                            @foreach($transaction->purchases as $purchase) 
                                <tr id="collapsible-{{ $key }}" class="collapse">
                                    <td></td>
                                    <td>{{ $purchase->product->name }}</td>
                                    <td>MYR {{ $purchase->product->price }}</td>
                                    <td><button>Review</button></td>
                                </tr>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
