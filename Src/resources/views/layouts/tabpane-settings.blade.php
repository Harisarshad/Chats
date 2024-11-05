<!-- Start Settings content -->
<div>
    <div class="px-4 pt-4">
        <h4 class="mb-0">{{ __('Settings') }}</h4>
    </div>

    <div class="text-center border-bottom p-4">
        <div class="mb-4 profile-user">
            <form name="avatar-form" id="avatar-form" method="post" accept-charset="utf-8" enctype="multipart/form-data"
                action="">
                <input type="file" name="avatar" id="avatar" style="display:none;" />
                <img id="imgAvatar" src="{{(!empty( Auth::user()->avatar ))?  \Modules\Chats\Src\Models\Group::get_file( Auth::user()->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}"
                    class="rounded-circle avatar-lg img-thumbnail imgavatar" alt="">
                <button type="button" id="btnAvatar"
                    class="btn bg-light avatar-xs p-0 rounded-circle profile-photo-edit"
                    onclick="document.getElementById('avatar').click();">
                    <i class="ri-pencil-fill"></i>
                </button>
            </form>
        </div>

        <h5 id="user-profile-name" class="font-size-16 mb-1 text-truncate profile-newname">{{ Auth::user()->name }}</h5>
        <div class="dropdown d-inline-block mb-1">
            <a class="text-muted dropdown-toggle pb-1 d-block" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{ __('Available') }} <i class="mdi mdi-chevron-down"></i>
            </a>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">{{ __('Available') }}</a>
                <a class="dropdown-item" href="#">{{ __('Busy') }}</a>
            </div>
        </div>
    </div>
    <!-- End profile user -->

    <!-- Start User profile description -->
    <div class="p-4 user-profile-desc" data-simplebar>

        <div id="profile-setting-accordion" class="custom-accordion">
            <div class="card shadow-none border mb-2">
                <a href="#profile-setting-personalinfocollapse" class="text-dark" data-toggle="collapse"
                    aria-expanded="true" aria-controls="profile-setting-personalinfocollapse">
                    <div class="card-header" id="profile-setting-personalinfoheading">
                        <h5 class="font-size-14 m-0">
                            {{ __("Personal Info") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a>

                <div id="profile-setting-personalinfocollapse" class="collapse show"
                    aria-labelledby="profile-setting-personalinfoheading" data-parent="#profile-setting-accordion">
                    <div class="card-body">
                        <div class="float-right">
                            <button type="button" id="btnName" class="btn btn-light btn-sm"><i
                                    class="ri-edit-fill mr-1 align-middle"></i> {{ __("Edit") }}</button>
                        </div>
                        <div>
                            <p class="text-muted mb-1">{{ __("Name") }}</p>
                            <h5 id="profile-newname" class="font-size-14 profile-newname text-truncate">{{ Auth::user()->name }}</h5>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control bg-soft-light border-light" name="profile-name"
                                    id="profile-name" style="display: none" />
                                <div class="float-right">
                                    <button type="button" id="btnSave"
                                        class="btn btn-primary btn-block waves-effect waves-light"
                                        style="display: none"> {{ __("Save") }}</button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Email") }}</p>
                            <h5 class="font-size-14">{{ Auth::user()->email }}</h5>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Time") }}</p>
                            <h5 class="font-size-14">{{ Auth::user()->created_at }}</h5>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-1">{{ __("Location") }}</p>
                            <h5 class="font-size-14 mb-0">{{ Auth::user()->location }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end profile card -->
            <div class="card shadow-none border mb-2">
                {{-- <a href="#profile-setting-privacycollapse" class="text-dark collapsed" data-toggle="collapse"
                    aria-expanded="false" aria-controls="profile-setting-privacycollapse">
                    <div class="card-header" id="profile-setting-privacyheading">
                        <h5 class="font-size-14 m-0">
                            {{ __("Privacy") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a> --}}
                <div id="profile-setting-privacycollapse" class="collapse"
                    aria-labelledby="profile-setting-privacyheading" data-parent="#profile-setting-accordion">
                    <div class="card-body">
                        {{-- <div class="py-3">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Profile photo") }}</h5>
                                </div>
                                <div class="dropdown ml-2">
                                    <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __("Everyone") }} <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">{{ __("Everyone") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("selected") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("Nobody") }}</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="py-3 border-top">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Last seen") }}</h5>
                                </div>
                                <div class="ml-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="privacy-lastseenSwitch"
                                            checked>
                                        <label class="custom-control-label" for="privacy-lastseenSwitch"></label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="py-3 border-top">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Status") }}</h5>
                                </div>
                                <div class="dropdown ml-2">
                                    <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __("Everyone") }} <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">{{ __("Everyone") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("selected") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("Nobody") }}</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="py-3 border-top">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Read receipts") }}</h5>
                                </div>
                                <div class="ml-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input"
                                            id="privacy-readreceiptSwitch" checked>
                                        <label class="custom-control-label" for="privacy-readreceiptSwitch"></label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="py-3 border-top">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Groups") }}</h5>
                                </div>
                                <div class="dropdown ml-2">
                                    <button class="btn btn-light btn-sm dropdown-toggle w-sm" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __("Everyone") }} <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">{{ __("Everyone") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("selected") }}</a>
                                        <a class="dropdown-item" href="#">{{ __("Nobody") }}</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
            <!-- end Privacy card -->
{{-- 
            <div class="card shadow-none border mb-2">
                <a href="#profile-setting-securitynoticollapse" class="text-dark collapsed" data-toggle="collapse"
                    aria-expanded="false" aria-controls="profile-setting-securitynoticollapse">
                    <div class="card-header" id="profile-setting-securitynotiheading">
                        <h5 class="font-size-14 m-0">
                            {{ __("Security") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a>
                <div id="profile-setting-securitynoticollapse" class="collapse"
                    aria-labelledby="profile-setting-securitynotiheading" data-parent="#profile-setting-accordion">
                    <div class="card-body">
                        <div>
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-13 mb-0 text-truncate">{{ __("Show security notification") }}</h5>
                                </div>
                                <div class="ml-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input"
                                            id="security-notificationswitch">
                                        <label class="custom-control-label" for="security-notificationswitch"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end Security card -->

            {{-- <div class="card shadow-none border mb-2">
                <a href="#profile-setting-helpcollapse" class="text-dark collapsed" data-toggle="collapse"
                    aria-expanded="false" aria-controls="profile-setting-helpcollapse">
                    <div class="card-header" id="profile-setting-helpheading">
                        <h5 class="font-size-14 m-0">
                            {{ __("Help") }}
                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                        </h5>
                    </div>
                </a>
                <div id="profile-setting-helpcollapse" class="collapse" aria-labelledby="profile-setting-helpheading"
                    data-parent="#profile-setting-accordion">
                    <div class="card-body">
                        <div>
                            <div class="py-3">
                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">{{ __("FAQs") }}</a></h5>
                            </div>
                            <div class="py-3 border-top">
                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">{{ __("Contact") }}</a></h5>
                            </div>
                            <div class="py-3 border-top">
                                <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">{{ __("Terms & Privacy policy") }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end Help card -->
        </div>
        <!-- end profile-setting-accordion -->
    </div>
    <!-- End User profile description -->
</div>
<!-- Start Settings content -->
