@props(['data'])
<div class="w-full bg-slate-700 p-5 md:p-20">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 md:gap-20">
            <div class="md:col-span-2">
                <h1 class="text-3xl font-semibold lg:text-5xl text-white text-center md:text-start flex items-center">
                    {{ $slot }}
                    {{ $title }}
                </h1>
                <p class="mt-1 text-sm leading-relaxed md:text-xl md:text-start text-gray-300">
                    {{ $subtitle }}
                </p>
                <p class="py-2 leading-relaxed text-xs text-justify md:text-sm md:text-start text-gray-400 max-w-4xl">
                    {{ $details }}
                </p>
            </div>
            <div
                class="hidden md:flex md:text-center md:justify-center md:items-center md:row-auto mx-auto sm:mx-0 md:col-span-1">
                <div
                    class="border p-2 rounded-3xl border-slate-600 h-96 w-80 flex flex-col justify-center bg-slate-800 shadow-lg shadow-slate-900">
                    <div class="flex flex-col gap-2">
                        <span class="text-8xl text-gray-200 font-semibold">{{ $data->count() }}</span>
                        <span class="text-6xl text-gray-300 font-semibold">{{ $cardtitle }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>