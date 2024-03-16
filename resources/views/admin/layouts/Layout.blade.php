<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Layout</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body class="flex">

        @include('admin/components/Sidebar')
        
        <section class="bg-[#eae4f7] w-full min-h-[100vh] overflow-y-auto">
            @yield('Content')
        </section>

        @stack('script')
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @php
            $currentRoute = Request::route()->getName();
        @endphp
        <script>
            const csrfToken = "{{ csrf_token() }}";
            const currentRoute = '@php echo $currentRoute; @endphp';
            const pathAssets = "{{ URL('/assets/') }}/";
            const pathUploads = "{{ URL('/uploads/') }}/";
            const sessionUsername = "@php echo Session::get('username') @endphp";

            if(currentRoute === currentRoute) {
                if(currentRoute === 'Members' || currentRoute === 'Admins') {
                    $('#' + currentRoute).removeClass('text-indigo-600');
                    openMenuMembers();
                }

                $('#' + currentRoute).addClass('text-indigo-600 bg-[#E4E9F7]');
            }
        </script>
        
        <script src="{{ URL('js/admin/LayoutAdmin.js') }}" defer></script>
    </body>
</html>