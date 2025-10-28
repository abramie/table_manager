{{--<div x-data="datepicker(@entangle($attributes->wire('model')))" class="relative">--}}

<div x-data="datepicker($wire.entangle('{{ $attributes->wire('model')->value }}'), {{$options}})" class="relative">
    <div class="flex flex-col">
        <label>{{$label}}</label>
        <div class="flex items-center gap-2">
            <input type="text" x-ref="myDatepicker" x-model="value">
{{--            <span class="cursor-pointer underline" x-on:click="reset">--}}
{{--                Reset--}}
{{--            </span>--}}
        </div>
    </div>
</div>

@once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        document.addEventListener('alpine:init', () => {
            Alpine.data('datepicker', (model, options) => ({
                options: options,
                value: model,
                init(){
                    console.log(this.options);
                    this.pickr = flatpickr(this.$refs.myDatepicker, options)
                    this.$watch('value', function(newValue){
                        this.pickr.setDate(newValue);
                    }.bind(this));
                },
                reset(){
                    this.value = null;
                }
            }))
        })
    </script>
@endonce

