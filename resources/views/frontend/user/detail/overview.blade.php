<div class="card">
    <div class="card-header page-title">Overview</div>
    <div class="card-body">
        <div class="media">
            <img class="mr-3 rounded" src="{{ file_url($user->image()) }}" alt="{{ $user->profile->name }}">
            <div class="media-body">
                <h5 class="mt-0">{{ $user->profile->name }}</h5>
                <p>{{ $user->profile->overview }}</p>
            </div>
        </div>
    </div>
</div>