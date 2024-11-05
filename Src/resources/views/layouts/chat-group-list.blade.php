<!-- Start chat-group-list -->
<ul class="list-unstyled chat-list">
    @foreach ($groupdata as $group)
        <li class="group" group-id="{{ $group->id }}" id="group-{{ $group->id }}">
            <a href="#">
                <div class="media align-items-center">
                    <div class="chat-user-img mr-3">
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary text-uppercase">
                                {{ substr($group->group_name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div class="media-body overflow-hidden">
                        <h5 class="text-truncate font-size-14 mb-0">#{{ $group->group_name }}
                            @if ($group->users->is_read != 0)
                                <span class="group-unread badge badge-soft-danger badge-pill float-right">+{{ $group->users->is_read }}</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>
<!-- End chat-group-list -->
