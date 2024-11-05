<!-- Start chat user head -->
<div class="p-3 p-lg-4 border-bottom">
    <div class="row align-items-center">
        <div class="col-sm-4 col-8">
                <div class="media align-items-center GROUP" id="{{$groupdata->id}}">
                    <div class="d-block d-lg-none mr-2">
                        <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                    </div>
                    <div class="chat-user-img mr-3">
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary text-uppercase">
                                {{substr($groupdata->group_name, 0, 1)}} 
                            </span>
                        </div>
                    </div>
                    <div class="media-body overflow-hidden">
                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-group-show">{{$groupdata->group_name}}</a></h5>
                    </div>
                </div>
        </div>
        <div class="col-sm-8 col-4">
            <ul class="list-inline user-chat-nav text-right mb-0">
                
                <li class="list-inline-item">
                    <div class="dropdown">
                        <button class="btn nav-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu p-0 dropdown-menu-right dropdown-menu-md">
                            <div class="search-box p-2">
                                <input type="text" class="form-control bg-light border-0" placeholder="{{ __("Search") }}.." id="groupmessagesearch">
                            </div>
                        </div>
                    </div>
                </li>

                <li class="list-inline-item d-none d-lg-inline-block">
                    <button type="button" class="btn nav-btn user-group-show">
                        <i class="ri-user-2-line"></i>
                    </button>
                </li>

                <li class="list-inline-item">
                    <div class="dropdown">
                        <button class="btn nav-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-fill"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-block d-lg-none user-profile-show" href="#">{{ __("View profile") }} <i class="ri-user-2-line float-right text-muted"></i></a>
                            <a class="dropdown-item" href="#">{{ __("Archive") }} <i class="ri-archive-line float-right text-muted"></i></a>
                            <a class="dropdown-item" href="#">{{ __("Muted") }} <i class="ri-volume-mute-line float-right text-muted"></i></a>
                            <a class="dropdown-item deleteGroupConversation" href="#" group-id="{{ $groupdata->id }}">{{ __("Delete") }} <i class="ri-delete-bin-line float-right text-muted"></i></a>
                        </div>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- end chat user head -->
<!-- start chat conversation -->
<div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
    <ul class="list-unstyled mb-0" id="chatgroup-ul">
        @include('Chats::layouts.group-conversation')
    </ul>
</div>
<!-- end chat conversation end -->
<!-- start chat input section -->
<div class="chat-input group-chat-input p-3 p-lg-4 border-top mb-0">
    <div class="row no-gutters">
        <div class="col">
            <div>
                <p class="emoji-picker-container d-flex align-items-end m-0">
                    <input class="input-field form-control form-control-lg bg-light border-light" data-emojiable="true"
                        data-emoji-input="true" type="text" name="comment"
                        id="comment" placeholder="{{ __("Enter Message") }}..." />
                </p>
            </div>
        </div>
        <div class="col-auto">
            <div class="chat-input-links ml-md-2">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">  
                        <form name="chat-file-form" id="chat-file-form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="">
                            <input type="file" name="fileUpload" id="GroupfileUpload" group-id="{{$groupdata->id}}"  style="display:none;"/>
                            <button type="button" id="btnFile" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="{{ __("Attached File") }}" onclick="document.getElementById('GroupfileUpload').click();">
                                <i class="ri-attachment-line"></i>
                            </button>
                        </form>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light send-group-message" group-id="{{ $groupdata->id }}">
                            <i class="ri-send-plane-2-fill"></i>
                        </button>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</div>
<!-- end chat input section -->

