<!-- Start Contact content -->
<div>
    <div class="p-4">
        <div class="user-chat-nav float-right">
            <div data-toggle="tooltip" data-placement="bottom" title="{{ __("Add Contact") }}">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-link text-decoration-none text-muted font-size-18 py-0" data-toggle="modal" data-target="#addContact-exampleModal">
                    <i class="ri-user-add-line"></i>
                </button>
            </div>
        </div>
        <h4 class="mb-4">{{ __("Contacts") }}</h4>

        <!-- Start Add contact Modal -->
        <div class="modal fade" id="addContact-exampleModal" tabindex="-1" role="dialog" aria-labelledby="addContact-exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-size-16" id="addContact-exampleModalLabel">{{ __("Add New Contact") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="form-group mb-4">
                                <label for="addcontactemail-input">{{ __("Email") }}</label>
                                <input type="email" class="form-control" id="addcontactemail-input" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="addcontact-invitemessage-input">{{ __("Invitation Message") }}</label>
                                <textarea class="form-control" id="addcontact-invitemessage-input" rows="3" placeholder="Enter Message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{ __("Close") }}</button>
                        <button type="button" class="btn btn-primary">{{ __("Add") }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add contact Modal -->

        <div class="search-box chat-search-box">
            <div class="input-group bg-light  input-group-lg rounded-lg">
                <div class="input-group-prepend">
                    <button class="btn btn-link text-decoration-none text-muted pr-1" type="button">
                        <i class="ri-search-line search-icon font-size-18"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-light " placeholder="{{ __("Search users") }}.." id="search">
            </div>
        </div>
        <!-- End search-box -->
    </div>
    <!-- end p-4 -->
    <!-- Start contact lists -->
    <div class="p-4 chat-message-list chat-group-list" data-simplebar>
        <div class="chat-contactlist">
            @include('Chats::layouts.tabpane-contact-list')
        </div>
    </div>
    <!-- end contact lists -->
</div>
<!-- Start Contact content -->