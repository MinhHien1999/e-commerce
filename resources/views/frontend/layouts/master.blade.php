<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.head')

<body>

@include('frontend.layouts.header')


@include('frontend.layouts.navbar')

@if(request()->segment(1)==null)
    @include('frontend.layouts.featured')
@endif


@yield('content')


@include('frontend.layouts.vendor')


@include('frontend.layouts.footer')

</body>

</html>
