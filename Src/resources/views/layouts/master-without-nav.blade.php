<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')

</body>
</html>
