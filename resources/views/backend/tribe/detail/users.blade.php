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
            <th>Created At</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tribe->members as $user)
        <tr class="odd gradeX">
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->created_at }}</td>
          <td><a href="{{ route('admin.user.detail', ['id' => $user->id]) }}">View</a></td>
        </tr>
        @empty
          No Data
        @endforelse
      </tbody>
    </table>
  </div>
</div>
