<div>
    <button class="btn btn-secondary form-control" wire:click.prevent="addToCart"><i class="fas fa-cart-plus"></i> Add To Cart</button>
</div>

@push('scripts')
    <script>
        window.livewire.on("added", () => {
            Swal.fire({
                toast:true,
                icon: 'success',
                title: 'Successfully Added to Cart!',
                timer: 2500,
                showConfirmButton: false,
            });
        });
    </script>
@endpush