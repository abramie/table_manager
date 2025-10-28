
@include('layouts.head')
<body class="font-sans text-gray-900 antialiased">
    <div class="container ">
        <div class="border container w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

