@foreach ($messages as $message)
    <li class="{{ $message->from_user == Auth::id() ? 'right' : 'left' }}" id="msg-{{ $message->id }}">
        <div class="conversation-list">
            <div class="chat-avatar">
                @if ($message->from_user == Auth::id())

                    <img src="{{(!empty(Auth::user()->avatar))?  \Modules\Chats\Src\Models\Group::get_file(Auth::user()->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="" class="imgavatar">
                @else
                    <img src="{{(!empty($chatUser->avatar))?  \Modules\Chats\Src\Models\Group::get_file($chatUser->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="">
                @endif
            </div>

            <div class="user-chat-content">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        @if ($message->file)
                            @if (strtolower(pathinfo($message->file, PATHINFO_EXTENSION)) == 'jpg' || strtolower(pathinfo($message->file, PATHINFO_EXTENSION)) == 'png' || strtolower(pathinfo($message->file, PATHINFO_EXTENSION)) == 'gif')
                                <ul class="list-inline message-img  mb-0">
                                    <li class="list-inline-item message-img-list">
                                        <div>
                                            <a class="popup-img d-inline-block m-1" href="{{ asset($message->file) }}" title="{{ __("Project 1") }}">
                                                <img src="{{ asset($message->file) }}" alt="" class="rounded border">
                                            </a>
                                        </div>
                                        <div class="message-img-link">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ asset($message->file) }}" download="">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle" href="{{ $message->file }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">{{ __("Copy") }} <i class="ri-file-copy-line float-right text-muted"></i></a>
                                                        <a class="dropdown-item" href="#">{{ __("Save") }} <i class="ri-save-line float-right text-muted"></i></a>
                                                        <a class="dropdown-item" href="#">{{ __("Forward") }} <i class="ri-chat-forward-line float-right text-muted"></i></a>
                                                        <a class="dropdown-item deleteMessage" href="javascript:void(0)" msg-id="{{ $message->id }}">{{ __("Delete") }} <i class="ri-delete-bin-line float-right text-muted"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            @else
                                <div class="card p-2 mb-2">
                                    <div class="media align-items-center">
                                        <div class="avatar-sm mr-3">
                                            <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                <i class="ri-file-text-fill"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="text-left">
                                                <h5 class="font-size-14 mb-1">{{ $message->message }}</h5>
                                                <p class="text-muted font-size-13 mb-0">
                                                    @php echo Modules\Chats\Src\Controllers\HomeControllerChats::bytesToHuman(File::size(public_path($message->file))); @endphp
                                                </p>
                                            </div>
                                        </div>

                                        <div class="ml-4">
                                            <ul class="list-inline mb-0 font-size-20">
                                                <li class="list-inline-item">
                                                    <a href="{{ $message->file }}" class="text-muted">
                                                        <i class="ri-download-2-line"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle text-muted" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                                        <a class="dropdown-item" href="#">{{ __("Share") }} <i class="ri-share-line float-right text-muted"></i></a>
                                                        <a class="dropdown-item deleteMessage" href="javascript:void(0)" msg-id="{{ $message->id }}">{{ __("Delete") }} <i class="ri-delete-bin-line float-right text-muted"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <p class="mb-0" id="aaa">
                                {{ $message->message }}
                            </p>
                        @endif
                        <p class="chat-time mb-0">
                            <i class="ri-time-line align-middle"></i> 
                            <span class="align-middle">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</span>
                        </p>
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item copyTextToClipboard" data-text="{{ $message->message }}">{{ __("Copy") }} <i class="ri-file-copy-line float-right text-muted"></i></a>
                            <a class="dropdown-item" href="#">{{ __("Save") }} <i class="ri-save-line float-right text-muted"></i></a>
                            <a class="dropdown-item" href="#">{{ __("Forward") }} <i class="ri-chat-forward-line float-right text-muted"></i></a>
                            <a class="dropdown-item deleteMessage" href="javascript:void(0)" msg-id="{{ $message->id }}">{{ __("Delete") }} <i class="ri-delete-bin-line float-right text-muted"></i></a>
                        </div>
                    </div>
                </div>
                @if ($message->from_user == Auth::id())
                    <div class="conversation-name profile-newname">{{ Auth::user()->name }}</div>
                @else
                    <div class="conversation-name">{{ $chatUser->name }}</div>
                @endif

            </div>
        </div>
    </li>
@endforeach
