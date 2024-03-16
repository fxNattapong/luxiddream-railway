<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <title>Layout</title>

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        
        @include('game.components.Loading')

        <div class="z-10 relative min-h-screen">
            @include('game.components.Navbar')

            @include('game.components.SidebarMobile')

            @yield('Content')

        </div>
    </body>

    @stack('script')
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @php
        $currentRoute = Request::route()->getName();
    @endphp
    <script>
        var sessionPlayerID = "<?php echo Session::get('player_id');  ?>";
        var sessionUsername = "<?php echo Session::get('username');  ?>";
        const sessionName = '<?php echo Session::get('name_ingame') ?>';
        const csrfToken = "{{ csrf_token() }}";
        const currentRoute = '@php echo $currentRoute; @endphp';
        const pathAssets = "{{ URL('/assets/') }}/";
        const pathUploads = "{{ URL('/uploads/') }}/";

        $(document).ready(function() {
            $('#sidebar-mobile').on('click', function() {
                $('#modal-sidebar-mobile').removeClass('hidden');
            });
            $('#icon-sidebar-mobile-close').on('click', function() {
                var modal = $('.modal-mobile-left-bar');
                modal.addClass('fade-out-mobile-left-bar');

                setTimeout(function() {
                    $('#modal-sidebar-mobile').addClass('hidden');
                    modal.removeClass("fade-out-mobile-left-bar");
                }, 500);
            });
        });
    </script>

</html>
