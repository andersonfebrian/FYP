@extends('browser.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
					<div class="col">
						<h2 class="m-0">Income statement - Products Sold</h2>
					</div>
					<div class="col d-flex justify-content-end">
						<h2 class="m-0"><b>Total Income: </b>{{ $total }} </h2>
					</div>
				</div>
        <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Customer</th>
										<th>Transaction</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
								@foreach ($income_statement as $sold)
										<tr>
											<td>{{ $sold->product->name }}</td>
											<td>MYR {{ $sold->product->price }}</td>
											<td>{{ $sold->transaction->user->full_name }}</td>
											<td>{{ $sold->transaction->transaction_id }}</td>
											<td>{{ $sold->created_at }}</td>
										</tr>
								@endforeach
            </tbody>
        </table>
    </div>
@endsection
