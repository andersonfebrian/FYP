<div class="container mt-4">
    <h1>All Transactions</h1>
    <div class="row">
        <div class="col-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-4">

        </div>
    </div>

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Total Price</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <th>{{ $transaction->id }}</th>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->total_price }}</td>
                    <td>{{ $transaction->user->id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($transactions) > 0)
        <div class="d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No transactions to show...</p>
        </div>
    @endif
</div>
