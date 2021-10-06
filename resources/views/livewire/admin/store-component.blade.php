<div class="container mt-4">
    <h1>All Stores</h1>

    <div class="row">
        <div class="col-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-4">

        </div>
        <div class="col-4 d-flex justify-content-center">
            <h4 class="m-0 mt-2"><b>Total Stores: </b> {{ $total_stores }}</h4>
        </div>
    </div>

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Store Owner</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
                <tr>
                    <th>{{ $store->id }}</th>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->user->full_name }}</td>
                    <td>{{ count($store->products) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($stores) > 0)
        <div class="d-flex justify-content-center">
            {{ $stores->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No stores to show...</p>
        </div>
    @endif
</div>
