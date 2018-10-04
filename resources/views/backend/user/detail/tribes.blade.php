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
        @forelse ($tribes as $tribe)
        <tr class="odd gradeX">
          <td>{{ $tribe->id }}</td>
          <td>{{ $tribe->title }}</td>
          <td>{{ $tribe->description }}</td>
          <td>{{ $tribe->topicsToString() }}</td>
          <td>{{ $tribe->location }}</td>
          <td>{{ $tribe->user->name }}</td>
          <td>{{ $tribe->created_at }}</td>
          <td><a href="{{ route('admin.tribe.detail', ['id' => $tribe->id]) }}">View</a></td>
        </tr>
        @empty
          No Data
        @endforelse
      </tbody>
    </table>
  </div>
</div>
