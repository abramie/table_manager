@include('layouts.head')

@yield('navigation_bonus')
@livewireStyles
@stack('styles')
<a  href="{{ url()->previous() }}" class="btn btn-primary">
    <i class="fa fa-arrow-circle-o-left"></i>
    <span>Back</span>
</a>



<body>

<div class="som-toast-container">
    @if(session('success'))
        <div class="som-toast style-solid som-toast-success">
            <div class="som-toast-icon"></div>
            <div class="som-toast-content"><b>{{__('Success')}}</b><div>{{ session('success') }}</div></div>
            <button class="som-toast-close">&times;</button>
            <div class="som-toast-progress"></div>`
        </div>

    @endif

    @if(session('echec'))

        <div class="som-toast style-solid som-toast-error">
            <div class="som-toast-icon"></div>
            <div class="som-toast-content"><b>{{__('Echec')}}</b><div>{{ session('echec') }}</div></div>
            <button class="som-toast-close">&times;</button>
            <div class="som-toast-progress"></div>`
        </div>

    @endif

    @if(session('info'))
        <div class="som-toast style-solid som-toast-info">
            <div class="som-toast-icon"></div>
            <div class="som-toast-content"><b>{{__('Info')}}</b><div>{{ session('info') }}</div></div>
            <button class="som-toast-close">&times;</button>
            <div class="som-toast-progress"></div>`
        </div>

    @endif
</div>

<script>
    const activeToasts = document.querySelectorAll('.som-toast');

    console.log(activeToasts);


    activeToasts.forEach(toast => {
        const dismiss = () => {
            toast.style.animation = `${animOut} 0.3s forwards`;
            toast.addEventListener('animationend', () => t.remove());
        };

        toast.querySelector('.som-toast-close').onclick = dismiss;
        setTimeout(dismiss, 2000);
        // toast.addEventListener('click', function handleClick(event) {
        //
        // });

        const bar = toast.querySelector('.toast-progress');
        if(bar) {
            bar.style.transform = 'scaleX(1)';
            setTimeout(() => {
                bar.style.transition = `transform ${duration}ms linear`;
                bar.style.transform = 'scaleX(0)';
            }, 50);

        }

        function getIcon(type) {
            const icons = {"success":"<svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M20 6 9 17l-5-5\"/></svg>","error":"<svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m15 9-6 6\"/><path d=\"m9 9 6 6\"/></svg>","warning":"<svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z\"/><path d=\"M12 9v4\"/><path d=\"M12 17h.01\"/></svg>","info":"<svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"M12 16v-4\"/><path d=\"M12 8h.01\"/></svg>"};
            return icons[type];
        }
    })

</script>



<div class="container">
    @yield('content')

</div>

</body>
@livewireScripts
@stack('scripts')
@include('layouts.foot')
