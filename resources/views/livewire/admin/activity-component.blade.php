<div class="container mt-4">
    <h1>Activity Logs</h1>

    <div class="row">
        <div class="col-2">
            <p><b>Activity</b></p>
        </div>
        <div class="col-2">
            <p><b>User ID</b></p>
        </div>
        <div class="col-2">
            <p><b>Date/Time</b></p>
        </div>
    </div>
    @foreach($activities as $activity)
    <div class="row">
        <div class="col-2">
            <p>{{ $activity->activity }}</p>
        </div>
        <div class="col-2">
            <p>{{ $activity->user_id }}</p>
        </div>
        <div class="col-2">
            <p>{{ $activity->created_at }}</p>
        </div>
    </div>
    @endforeach
</div>