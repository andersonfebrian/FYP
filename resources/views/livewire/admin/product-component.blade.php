<div class="container mt-4">
    <h1>All Products</h1>

    <div class="col-4 p-0">
        <input type="text" wire:model="search" class="form-control" placeholder="Search">
    </div>

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Store Owner</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->currency . ' ' . $product->price }}</td>
                    <td> - </td>
                    <td>{{ $product->store->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($products) > 0)
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No products to show...</p>
        </div>
    @endif
</div>
