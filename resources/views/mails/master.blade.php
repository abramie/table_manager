@yield('content')



@if(config('app.env') != "PROD")
    @include('mails.testlayout')
@endif
