<div class="container mt-4">
    <h1>All Purchases</h1>
    {{-- <div class="row">
        <div class="col-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-4">

        </div>
        <div class="col-4 d-flex justify-content-center">
            <h4 class="m-0 mt-2"><b>Total Purchases: </b></h4>
        </div>
    </div> --}}

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Product ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $purchase)
                <tr>
                    <th>{{ $purchase->id }}</th>
                    <td>{{ $purchase->transaction->transaction_id }}</td>
                    <td>{{ $purchase->product_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($purchases) > 0)
        <div class="d-flex justify-content-center">
            {{ $purchases->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No purchases to show...</p>
        </div>
    @endif
</div>
