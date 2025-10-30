@include('layouts.head')

@yield('navigation_bonus')
@livewireStyles
@stack('styles')
<a  href="{{ url()->previous() }}" class="btn btn-primary">
    <i class="fa fa-arrow-circle-o-left"></i>
    <span>Back</span>
</a>



<body>

<div class="container">
    @if(session('success'))
        <div class=".alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('echec'))
        <div class=".alert alert-danger">
            {{ session('echec') }}
        </div>

    @endif
</div>


<div class="container">
    @yield('content')

</div>

</body>
@livewireScripts
@stack('scripts')
@include('layouts.foot')
