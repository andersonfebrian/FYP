<div class="container mt-4">
    <h1>All Users</h1>

    <div class="row">
        <div class="col-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-4">

        </div>
        <div class="col-4 d-flex justify-content-center">
            <h4 class="m-0 mt-2"><b>Total Users: </b> {{ count($users) }}</h4>
        </div>
    </div>

    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Biosecure Enabled</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->biosecure_enabled ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($users) > 0)
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @else
        <div class="d-flex justify-content-center">
            <p>No users to show...</p>
        </div>
    @endif
</div>
