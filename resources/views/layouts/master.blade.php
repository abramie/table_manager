@include('layouts.head')

@yield('navigation_bonus')
@livewireStyles
@stack('styles')
<a  href="{{ url()->previous() }}" class="btn btn-primary">
    <i class="fa fa-arrow-circle-o-left"></i>
    <span>Back</span>
</a>



<body>
@session('toast')


<div class="toast-container som-toast-container">

    @foreach(session()->pull('toast') as $t)
        <div class="toast som-toast style-solid som-toast-{{$t['type']}}" role="alert" aria-live="polite" aria-atomic="true" data-bs-autohide="true" data-bs-delay="{{ 2000*$loop->iteration }}" >
            <div class="som-toast-icon"></div>
            <div class="som-toast-content" role="alert" aria-live="assertive" aria-atomic="true"><b>{{ucfirst( __($t['type']))}}</b><div>{{ $t['message'] }}</div></div>
            <button class="som-toast-close" data-bs-dismiss="toast" aria-label="Close">&times;</button>
            <div class="som-toast-progress"></div>
        </div>

    @endforeach
</div>
@endsession
@if(session()->has('success'))
    <div class="error">Il y a une erreur de toasts à corriger sur cette page</div>
@endif





<div class="container">
    @yield('content')

</div>

</body>
@livewireScripts
@stack('scripts')
@include('layouts.foot')


<script>



    window.onload = () => {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        })

        toastList.forEach((toast) => {
            toast.show();
        });


    }







</script>
