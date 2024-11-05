<!-- Start chats content -->
<div>
    <div class="px-4 pt-4">
        <h4 class="mb-4">Ezy Chats</h4>
        <div class="search-box chat-search-box">
            <div class="input-group mb-3 bg-light  input-group-lg rounded-lg">
                <div class="input-group-prepend">
                    <button class="btn btn-link text-muted pr-1 text-decoration-none" type="button">
                        <i class="ri-search-line search-icon font-size-18"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-light" placeholder="{{ __("Search messages or users") }}" id="recentcontactsearch">
            </div>
            
        </div> <!-- Search Box-->
    </div> <!-- .p-4 -->
    
    <!-- Start user status -->
    <div class="px-4 pb-4" dir="ltr">

        <div class="owl-carousel owl-theme" id="user-status-carousel">
            @foreach($users as $user)
                @if(Cache::has('is_online' . $user->id))
                    <div class="item user chat-user-click" id="{{$user->id}}" user-id="{{ $user->id }}">
                        <a href="#" class="user-status-box">
                            <div class="avatar-xs mx-auto d-block chat-user-img online">
                                <img src="{{(!empty( $user->avatar ))?  \Modules\Chats\Src\Models\Group::get_file( $user->avatar ): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="user-img" class="img-fluid rounded-circle">
                                <span class="user-status"></span>
                            </div>
                            <h5 class="font-size-13 text-truncate mt-3 mb-1">{{$user->name}}</h5>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- end user status carousel -->
    </div>
    <!-- end user status -->

    <!-- Start chat-message-list -->
    <div class="px-2">
        <h5 class="mb-3 px-3 font-size-16">{{ __("Recent") }}</h5>

        <div class="chat-message-list" data-simplebar>
            <div class="chat-message-chatlist">
                @include('Chats::layouts.tabpane-recent-contact-list')
            </div> 
        </div>
        
    </div>
    <!-- End chat-message-list -->
</div>
<!-- Start chats content -->