<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>{{$siteTitle}} {{ isset($pageTitle) ? '| '.$pageTitle : '' }}</title>
    
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="https://npmcdn.com/react-select/dist/react-select.css">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
     
    <script src="https://use.typekit.net/rqb4xyg.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    

</head>
<body id="app-layout">

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
      <nav class="navbar navbar-inverse navbar-fixed-side">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{$siteTitle}}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                       <li><a href="{{ url('/login') }}">Login</a></li>
                       <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                 @if(Session::has('user.administrator'))
                                    <li><a href="{{ url('/admin') }}">Admin Dashboard</a></li>
                                @endif
                                    <li><a href="/dashboard">Dashboard</a></li>
                                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(! empty($contentId))
                    @include('partials.sectionsNav')
                        <li><a href="/artifact-tags/{{ $contentId }}">Tag</a></li>
                        <li><a href="/artifact-collaboration/{{ $contentId }}">Collaborate 
                        @if($commentsCount > 0)({{ $commentsCount }})@endif</a></li>
                        <li><a href="/artifact-notes/{{ $contentId }}">Notes from the field</a></li>
                    @endif
                </ul>
                <div><a class="btn btn-default" href="/publish-content/{{ $contentId }}">Publish</a></div>
            </div>
        </div>
      </nav>
    </div>
    <div class="col-sm-9 col-lg-10">
      @yield('content')
    </div>
  </div>
</div>

    <!-- JavaScripts -->
    <script src="{{ asset('/js/vendor.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $(document).ready(function () {
            $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
        });
    </script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('/js/components.js') }}"></script>

</body>
</html>

