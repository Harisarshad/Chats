<!-- Start Groups content -->
<div>
    <div class="p-4">
        <div class="user-chat-nav float-right">
            <div data-toggle="tooltip" data-placement="bottom" title="{{ __('Create group') }}">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-link text-decoration-none text-muted font-size-18 py-0"
                    data-toggle="modal" data-target="#addgroup-exampleModal">
                    <i class="ri-group-line mr-1"></i>
                </button>
            </div>
        </div>

        <h4 class="mb-4">{{ __('Groups') }}</h4>

        <!-- Start add group Modal -->
        <div class="modal fade" id="addgroup-exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="addgroup-exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-size-16" id="addgroup-exampleModalLabel">
                            {{ __('Create a New Group.') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label for="addgroup_name-input">{{ __('Group Name') }}</label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Group Name') }}"
                                    name="group_name" id="group_name">
                            </div>
                            <div class="form-group mb-4">
                                <label>{{ __('Group Members') }}</label>
                                <div class="mb-3">
                                    <button class="btn btn-light btn-sm" type="button" data-toggle="collapse"
                                        data-target="#groupmembercollapse" aria-expanded="false"
                                        aria-controls="groupmembercollapse">
                                        {{ __('Select Members') }}
                                    </button>
                                </div>

                                <div class="collapse" id="groupmembercollapse">
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 class="font-size-15 mb-0">{{ __('Contacts') }}</h5>
                                        </div>
                                        <div class="card-body p-2">
                                            <div data-simplebar style="max-height: 150px;">
                                                <div>
                                                    @foreach ($contacts as $user => $key)
                                                        <div class="p-3 font-weight-bold text-primary text-uppercase">
                                                            {{ $user }}
                                                        </div>
                                                        <ul class="list-unstyled contact-list">
                                                            @foreach ($key as $contact)
                                                                <li id="{{ $contact->id }}">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input batchCheckbox"
                                                                            id="contact-{{ $contact->id }}"
                                                                            name="checkboxusers[]"
                                                                            value="{{ $contact->id }}">
                                                                        <label class="custom-control-label"
                                                                            for="contact-{{ $contact->id }}">{{ $contact->name }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addgroupdescription-input">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" rows="3"
                                    placeholder="{{ __('Enter Description') }}" name="description"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-primary create-group"
                            data-dismiss="modal">{{ __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End add group Modal -->

        <div class="search-box chat-search-box">
            <div class="input-group bg-light  input-group-lg rounded-lg">
                <div class="input-group-prepend">
                    <button class="btn btn-link text-decoration-none text-muted pr-1" type="button">
                        <i class="ri-search-line search-icon font-size-18"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-light" placeholder="{{ __('Search groups') }}..."
                    id="groupsearch">
            </div>
        </div>
        <!-- end search-box -->
    </div>
    <div class="p-4 chat-message-list chat-group-list" data-simplebar>
        <div id="chat-group-list">
            @include('Chats::layouts.chat-group-list')
        </div>
    </div>
</div>
<!-- End Groups content -->
