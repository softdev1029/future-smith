
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> Notifications Panel
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
          @forelse($notifications->slice(0, 5) as $notification)
          <a href="#" class="list-group-item">
            <?php
              $data = json_decode($notification->data);
              $interval = date_diff(new DateTime($notification->created_at), now())->format("%d Day %h Hours %i Minute %s Seconds");
            ?>
            <i class="fa fa-comment fa-fw"></i> {{ $data->message }}
            <span class="pull-right text-muted small"><em>{{ $interval }} ago</em>
            </span>
          </a>
          @empty
          No Notifications
          @endforelse
        </div>
        <!-- /.list-group -->
        <a href="{{ route('admin.notification.list') }}" class="btn btn-default btn-block">View All Notifications</a>
    </div>
    <!-- /.panel-body -->
</div>
