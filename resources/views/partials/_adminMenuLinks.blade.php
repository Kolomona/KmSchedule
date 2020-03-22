@can('manage-users')
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Admin <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('schedule.create') }}">Add New Schedule</a>
        <a class="dropdown-item" href="{{ route('admin.users.create') }}">Add New Employee</a>
        <a class="dropdown-item" href="{{ route('schedule.index') }}">Manage Schedules</a>
        <a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Employees</a>
    </div>
</li>
@endcan