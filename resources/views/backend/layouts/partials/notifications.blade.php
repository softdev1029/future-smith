<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts">
      @forelse($notifications->slice(0, 5) as $notification)
      <li>
          <a href="#">
              <div>
                <?php
                  $data = json_decode($notification->data);
                  $interval = date_diff(new DateTime($notification->created_at), now())->format("%i");
                ?>
                <i class="fa fa-comment fa-fw"></i>{{ $data->message }}
                <span class="pull-right text-muted small">{{ $interval }} minutes ago</span>
              </div>
          </a>
      </li>
      @empty
        No Notification
      @endforelse
      <li class="divider"></li>
      <li>
          <a class="text-center" href="{{ route('admin.notification.list') }}">
              <strong>See All Alerts</strong>
              <i class="fa fa-angle-right"></i>
          </a>
      </li>
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->
