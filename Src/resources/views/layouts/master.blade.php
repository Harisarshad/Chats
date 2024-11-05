<!DOCTYPE html>
<html lang="en">
<head>
    @include('Chats::layouts.title-meta')
    @include('Chats::layouts.head')
</head>
<body>
     <!-- Begin page -->
     <div class="layout-wrapper d-lg-flex">
         <!-- Start left sidebar-menu -->
        @include('Chats::layouts.sidebar')
        <!-- end left sidebar-menu -->

        @yield('content')
    </div>
    <!-- END layout-wrapper -->
<!-- JAVASCRIPT -->
@include('Chats::layouts.vendor-scripts')
</body>
</html>