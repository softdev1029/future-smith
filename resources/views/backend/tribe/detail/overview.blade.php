<h4>Name: {{ $tribe->title }}</h4>

<img src="{{ file_url($tribe->image(), 'get', 'thumb') }}"></img>

<p>Created at: {{ $tribe->created_at }}</p>
