<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Bootstrap -->
        <link href="{{ theme_url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ theme_url('css/bootstrap-theme.min.css') }}">

        <link rel="stylesheet" href="{{ theme_url('css/quick16.css') }}">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <title>{{ isset($title) ? $title: "Quicklime" }}</title>
    </head>
    <body>

        @navbar()

        <div class="container">
            @yield('main-contents')
        </div>
        <footer class="footer">
            <div class="container">
                <span class="copyright">&copy; 2016 - Quicklime</span>
                -
                <span class="poweredby">
                    {{ __('poweredby', 'theme') }} <a href="https://github.com/Quicklime/Quicklime">Quicklime CMS</a>
                </span>
                @if(isset($version))<span class="version">{{ $version }}</span>@endif
            </div>
        </footer>

        <script src="{{ theme_url('js/jquery-2.1.4.min.js') }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ theme_url('js/bootstrap.min.js') }}"></script>
        <script src="{{ theme_url('js/quick16.js') }}"></script>
    </body>
</html>
