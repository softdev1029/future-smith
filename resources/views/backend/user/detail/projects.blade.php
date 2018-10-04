<div class="panel panel-default">

  <!-- header -->
  <div class="panel-heading">
      Tribes
  </div>
  <div class="panel-body">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Topics</th>
            <th>Location</th>
            <th>Owner</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
        <tr class="odd gradeX">
          <td>{{ $project->id }}</td>
          <td>{{ $project->title }}</td>
          <td>{{ $project->description }}</td>
          <td>{{ $project->topicsToString() }}</td>
          <td>{{ $project->location }}</td>
          <td>{{ $project->user->name }}</td>
          <td>{{ $project->created_at }}</td>
          <td><a href="{{ route('admin.project.detail', ['id' => $project->id]) }}">View</a></td>
        </tr>
        @empty
          No Data
        @endforelse
      </tbody>
    </table>
  </div>
</div>
