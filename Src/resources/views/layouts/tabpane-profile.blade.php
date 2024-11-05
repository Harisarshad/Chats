<!-- Start profile content -->
<div>
    <div class="px-4 pt-4">
        <div class="user-chat-nav float-right">
            <div class="dropdown">
                <a href="javascript: void(0);" class="font-size-18 text-muted dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-more-2-fill"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">{{ __("Edit") }}</a>
                    <a class="dropdown-item" href="#">{{ __("Action") }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">{{ __("Another action") }}</a>
                </div>
            </div>
        </div>
        <h4 class="mb-0">{{ __("My Profile") }}</h4>
    </div>

    <div class="text-center p-4 border-bottom">
        <div class="mb-4">
            <img src="{{(!empty(Auth::user()->avatar))?  \Modules\Chats\Src\Models\Group::get_file(Auth::user()->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" class="rounded-circle avatar-lg img-thumbnail imgavatar" alt="">
        </div>

        <h5 class="font-size-16 mb-1 text-truncate profile-newname">{{(Auth::user()->name)}}</h5>
        @if(Cache::has('is_online' . Auth::user()->id))
            <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success mr-1 d-inline-block"></i> {{ __("Active") }}</p>
        @else
            <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-warning mr-1 d-inline-block"></i> {{ __("Deactivate") }}</p>
        @endif
    </div>
    <!-- End profile user -->

    <!-- Start user-profile-desc -->
    <div class="p-4 user-profile-desc" data-simplebar>
        <div class="text-muted">
            <p class="mb-4">{{ __("If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.") }}</p>
        </div>

        <div id="profile-user-accordion-1" class="custom-accordion">
            <div class="card shadow-none border mb-2">
                <a href="#profile-user-collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="profile-user-collapseOne">
                    <div class="card-header" id="profile-user-headingOne">
                        <h5 class="font-size-14 m-0">
                            <i class="ri-user-2-line mr-2 align-middle d-inline-block"></i> {{ __("About") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a>

                <div id="profile-user-collapseOne" class="collapse show"
                        aria-labelledby="profile-user-headingOne" data-parent="#profile-user-accordion-1">
                    <div class="card-body">
                        <div>
                            <p class="text-muted mb-1">{{ __("Name") }}</p>
                            <h5 class="font-size-14 profile-newname text-truncate">{{(Auth::user()->name)}}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Email") }}</p>
                            <h5 class="font-size-14">{{(Auth::user()->email)}}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Time") }}</p>
                            <h5 class="font-size-14">{{(Auth::user()->created_at)}}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Location") }}</p>
                            <h5 class="font-size-14 mb-0">{{(Auth::user()->location)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End About card -->
            <div class="card mb-1 shadow-none border">
                <a href="#profile-user-collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="profile-user-collapseTwo">
                    <div class="card-header" id="profile-user-headingTwo">
                        <h5 class="font-size-14 m-0">
                            <i class="ri-attachment-line mr-2 align-middle d-inline-block"></i> {{ __("Attached Files") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a>
                <div id="profile-user-collapseTwo" class="collapse" aria-labelledby="profile-user-headingTwo" data-parent="#profile-user-accordion-1">
                    <div class="card-body">
                        @foreach($AttachedFiles as $message)
                        <div class="card p-2 border mb-2" id="msg-{{ $message->id }}"> 
                            @if(strtolower(pathinfo($message->file, PATHINFO_EXTENSION))=='jpg' || strtolower(pathinfo($message->file, PATHINFO_EXTENSION))=='png' || strtolower(pathinfo($message->file, PATHINFO_EXTENSION))=='gif')
                            <div class="media align-items-center" >
                                <div class="avatar-sm mr-3">
                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                        <i class="ri-image-fill"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="text-left">
                                        <h5 class="font-size-14 mb-1">{{ $message->message }}</h5>
                                        <p class="text-muted font-size-13 mb-0">
                                            @php
                                                echo Modules\Chats\Src\Controllers\HomeControllerChats::bytesToHuman(File::size(public_path($message->file)));
                                            @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="ml-4">
                                    <ul class="list-inline mb-0 font-size-18">
                                        <li class="list-inline-item">
                                            <a href="{{ asset ($message->file) }}" class="text-muted px-1" download="">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item dropdown">
                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">{{ __("Action") }}</a>
                                                <a class="dropdown-item" href="#">{{ __("Another action") }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item deleteMessage" href="javascript:void(0)" msg-id="{{ $message->id }}">{{ __("Delete") }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @else 
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
                                            @php
                                                echo Modules\Chats\Src\Controllers\HomeControllerChats::bytesToHuman(File::size(public_path($message->file)));
                                            @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="ml-4">
                                    <ul class="list-inline mb-0 font-size-18">
                                        <li class="list-inline-item">
                                            <a href="{{ asset ($message->file) }}" class="text-muted px-1" download="">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item dropdown">
                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">{{ __("Action") }}</a>
                                                <a class="dropdown-item" href="#">{{ __("Another action") }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item deleteMessage" href="javascript:void(0)" msg-id="{{ $message->id }}">{{ __("Delete") }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif 
                        </div>
                        <!-- end card -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Attached Files card -->
        </div>
        <!-- end profile-user-accordion -->

    </div>
    <!-- end user-profile-desc -->
</div>
<!-- End profile content -->
