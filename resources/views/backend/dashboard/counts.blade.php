<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $user_count }}</div>
                        <div>Users</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{ route('admin.user.list') }}" class="pull-left">View Details</a>
                    <a href="{{ route('admin.user.list') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $tribe_count }}</div>
                        <div>Tribes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{ route('admin.tribe.list') }}" class="pull-left">View Details</a>
                    <a href="{{ route('admin.tribe.list') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $project_count }}</div>
                        <div>Projects</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{ route('admin.project.list') }}" class="pull-left">View Details</a>
                    <a href="{{ route('admin.project.list') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
