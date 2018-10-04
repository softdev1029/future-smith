<h4>Name: {{ $user->name }}</h4>

<img src="{{ file_url($user->image(), 'get', 'thumb') }}"></img>

<p>Email: {{ $user->email }}</p>
<p>Email Verified at: {{ $user->email_verified_at }}</p>
<p>Role: {{ $user->roleToString() }}</p>
<p>Status: {{ $user->statusToString() }}</p>
<p>Created at: {{ $user->created_at }}</p>
