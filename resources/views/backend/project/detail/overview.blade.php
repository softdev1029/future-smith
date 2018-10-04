<h4>Name: {{ $project->title }}</h4>

<img src="{{ file_url($project->image(), 'get', 'thumb') }}"></img>

<p>Created at: {{ $project->created_at }}</p>
