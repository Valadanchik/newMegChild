<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Eraz newmag</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/admin/img/favicon.png') }}" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script type="text/javascript">

        // document.addEventListener('DOMContentLoaded', function() {
        //     var elements = document.querySelectorAll('.ckeditor');
        //     elements.forEach(function(element) {
        //         ClassicEditor.create(element);
        //     });
        // });

    </script>
</head>
<body class="nav-fixed">

@include('admin.layout.header')

<div id="layoutSidenav">

    @include('admin.layout.sidebar')

    <div id="layoutSidenav_content">

        @yield('admin.content')

        @include('admin.layout.footer')

    </div>
</div>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/admin/scripts.js') }}"></script>

<!--Page Scripts-->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/admin/datatables/datatables-simple-demo.js') }}"></script>
<script src="{{ asset('/js/admin/main.js') }}"></script>
</body>
</html>

