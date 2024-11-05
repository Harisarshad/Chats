<ul class="list-unstyled chat-list chat-user-list">
    @foreach ($users as $user)
        <li class="user" data-id="{{ $user->id }}" id="user-{{ $user->id }}" user-id="{{ $user->id }}">
            <a href="#">
                <div class="media">
                    @if (Cache::has('is_online' . $user->id))
                        <div class="chat-user-img online align-self-center mr-3">
                            <img src="{{(!empty($user->avatar))?  \Modules\Chats\Src\Models\Group::get_file($user->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" class="rounded-circle avatar-xs" alt="">
                            <span class="user-status"></span>
                        </div>
                    @else
                        <div class="chat-user-img away align-self-center mr-3">
                            <img src="{{(!empty($user->avatar))?  \Modules\Chats\Src\Models\Group::get_file($user->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" class="rounded-circle avatar-xs" alt="">
                            <span class="user-status"></span>
                        </div>
                    @endif

                    <div class="media-body overflow-hidden">
                        <h5 class="text-truncate font-size-15 mb-1">{{ $user->name }}</h5>

                        @if ($user->file)
                            @if (strtolower(pathinfo($user->file, PATHINFO_EXTENSION)) == 'jpg' || strtolower(pathinfo($user->file, PATHINFO_EXTENSION)) == 'png' || strtolower(pathinfo($user->file, PATHINFO_EXTENSION)) == 'gif')
                                <p class="chat-user-message text-truncate mb-0"><i class="ri-image-fill align-middle mr-1"></i> {{ $user->message }}</p>
                            @else
                                <p class="chat-user-message text-truncate mb-0"><i class="ri-file-text-fill align-middle mr-1"></i> {{ $user->message }}</p>
                            @endif

                        @else
                            <p class="chat-user-message text-truncate mb-0">{{ $user->message }}</p>
                        @endif
                    </div>
                    @if (date('Y-m-d') == date('Y-m-d', strtotime($user->created_at)))
                        <div class="font-size-11">{{ date('h:i a', strtotime($user->created_at)) }}</div>
                    @else
                        <div class="font-size-11">{{ date('d/m', strtotime($user->created_at)) }}</div>
                    @endif
                    @if ($user->unread)
                        <div class="unread-message">
                            <span class="badge badge-soft-danger badge-pill pending">{{ $user->unread }}</span>
                        </div>
                    @endif
                </div>
            </a>
        </li>
    @endforeach
</ul>
