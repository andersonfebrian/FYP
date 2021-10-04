<div class="container mt-4">
    <h1>Banners</h1>
    @include('browser.layouts.partials.messages')
    <div class="row">
        <div class="col-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-4">

        </div>
        <div class="col"></div>
        <div class="col-2">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-sm form-control btn-success">Create Banner</a>
        </div>
    </div>

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Banner Name</th>
                <th>Viewable</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <th>{{ $banner->id }}</th>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->is_viewable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.banners.edit', ['banner' => $banner]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <button wire:click="$emit('requires_action', {{ $banner }})" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($banners) > 0)
        <div class="d-flex justify-content-center">
            {{ $banners->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No banners to show...</p>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.livewire.on('requires_action', (banner) => {
                
                Swal.fire({
                    title: 'Remove Banner?',
                    icon: 'warning'
                }).then(
                    (res) => {
                        if(res.isConfirmed) {
                            window.livewire.emit('removeBanner', banner);
                        }
                    },
                    (err) => {}
                );

            });

            window.livewire.on('removed_banner', () => {
                Swal.fire({
                    title:'Successfully Removed Banner',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
@endpush
