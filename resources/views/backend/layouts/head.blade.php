<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin  {{request()->segment(2) == '' ? '' : '| '.ucfirst (request()->segment(2) )}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <!-- Switch button -->
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap4-toggle.min.css')}}">
    <!-- Switch button -->
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap.min.css')}}">
    <!-- summer note -->
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.css')}}">
    @stack('styles')
</head>
