<div class="fixed right-10 top-10">
    @foreach($toast as $alert)

        <div
            x-data="{ shown: true, timeout: null }"
            x-init="setTimeout(() => { shown = false }, 5000)"
        >

            <div x-show="shown"
                class="flex items-center w-full p-4 mb-4 text-gray-500


                 {{ $alert->get('type') === 'success' ? 'bg-green-100' : '' }}
                 {{ $alert->get('type') === 'error' ? 'bg-red-100' : '' }}

                 rounded-lg shadow-md dark:text-gray-400 dark:bg-gray-800" role="alert">
{{--                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-white bg-black/20 rounded-lg">--}}
{{--                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>--}}
{{--                    </svg>--}}
{{--                    <span class="sr-only">Check icon</span>--}}
{{--                </div>--}}
                <div class="ms-3 text-sm font-normal

                 {{ $alert->get('type') === 'success' ? 'text-black' : '' }}
                 {{ $alert->get('type') === 'error' ? 'text-red-900' : '' }}

                 ">{{ $alert->get('title') }}</div>
            </div>

        </div>



    @endforeach
</div>
