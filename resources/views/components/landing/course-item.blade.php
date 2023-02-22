@props(['course'])
<div class="bg-slate-800 rounded-lg shadow-custom">
    <img class="rounded-t-lg" src="{{ $course->image }}" alt="product image">
    <div class="p-4 md:p-5 text-center">
        <a href="{{ route('course.show', $course->slug) }}"
            class="text-lg font-semibold text-white hover:text-red-500 hover:underline">
            {{ $course->name }}
        </a>
        <div class="flex flex-row gap-3 text-xs justify-center my-4">
            <div class="text-slate-400 flex items-center gap-1 align-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list w-5 h-5" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="9" y1="6" x2="20" y2="6"></line>
                    <line x1="9" y1="12" x2="20" y2="12"></line>
                    <line x1="9" y1="18" x2="20" y2="18"></line>
                    <line x1="5" y1="6" x2="5" y2="6.01"></line>
                    <line x1="5" y1="12" x2="5" y2="12.01"></line>
                    <line x1="5" y1="18" x2="5" y2="18.01"></line>
                </svg>
                {{ $course->videos_count }} Episode
            </div>
            <div class="text-slate-400 flex items-center gap-1 align-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users w-5 h-5"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                </svg>
                {{ $course->enrolled }} Member
            </div>
            <div class="text-slate-400 flex items-center gap-1 align-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2 w-5 h-5"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3">
                    </path>
                    <line x1="8" y1="9" x2="16" y2="9"></line>
                    <line x1="8" y1="13" x2="14" y2="13"></line>
                </svg>
                {{ $course->reviews_count }} Review
            </div>
        </div>
        <div class="flex justify-between items-center mt-5">
            <span class="text-base p-2 border bg-red-800 text-white rounded font-semibold border-red-600">
                Discount {{ $course->discount }}%
            </span>
            <div class="flex flex-col">
                <span class="line-through text-red-500 font-mono">
                    <sup>Rp</sup>{{ moneyFormat($course->price) }}
                </span>
                <span class="text-green-500 font-mono">
                    <sup>Rp</sup>{{ moneyFormat(discount($course->price, $course->discount)) }}
                </span>
            </div>
        </div>
    </div>
    <div class="border-t border-slate-700 border-dashed p-4">
        <div class="flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-user-circle w-5 h-5 text-slate-400" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="12" r="9"></circle>
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
            </svg>
            <div class="text-slate-400 font-medium text-sm">{{ $course->user->name }}</div>
        </div>
    </div>
</div>