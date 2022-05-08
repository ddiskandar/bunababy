<div class="flex items-center justify-start gap-4 py-2">
    <img src="{{ asset(auth()->user()->profile_photo_url) }}" alt="User Photo" class="inline-block w-12 h-12 rounded-full ">
    <div>
        <div class="text-xl font-semibold leading-tight">
            Hi, {{ auth()->user()->name }}
        </div>
        <p class="text-sm text-slate-400">{{ auth()->user()->email }}</p>
    </div>
</div>

@if ( $profileCompleted )
    <div class="flex items-center justify-start gap-4 py-4">
        <div class="flex items-center justify-start gap-1">
            <svg class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.25 11C18.25 15 12 19.25 12 19.25C12 19.25 5.75 15 5.75 11C5.75 7.5 8.68629 4.75 12 4.75C15.3137 4.75 18.25 7.5 18.25 11Z"></path>
                <circle cx="12" cy="11" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
            </svg>
            <p class="font-medium">{{ auth()->user()->address }}</p>
        </div>
        <div class="flex items-center justify-start gap-1">
            <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" >
                <path fill="currentColor"  d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 0 0 1.333 4.993L2 22l5.232-1.236a9.981 9.981 0 0 0 4.774 1.215h.004c5.505 0 9.985-4.48 9.988-9.985a9.922 9.922 0 0 0-2.922-7.066A9.923 9.923 0 0 0 12.012 2zm-.002 2a7.95 7.95 0 0 1 5.652 2.342 7.93 7.93 0 0 1 2.336 5.65c-.002 4.404-3.584 7.987-7.99 7.987a7.999 7.999 0 0 1-3.817-.971l-.673-.367-.745.175-1.968.465.48-1.785.217-.8-.414-.72a7.98 7.98 0 0 1-1.067-3.992C4.023 7.582 7.607 4 12.01 4zM8.477 7.375a.917.917 0 0 0-.666.313c-.23.248-.875.852-.875 2.08 0 1.228.894 2.415 1.02 2.582.123.166 1.726 2.765 4.263 3.765 2.108.831 2.536.667 2.994.625.458-.04 1.477-.602 1.685-1.185.208-.583.209-1.085.147-1.188-.062-.104-.229-.166-.479-.29-.249-.126-1.476-.728-1.705-.811-.229-.083-.396-.125-.562.125-.166.25-.643.81-.79.976-.145.167-.29.19-.54.065-.25-.126-1.054-.39-2.008-1.24-.742-.662-1.243-1.477-1.389-1.727-.145-.25-.013-.386.112-.51.112-.112.248-.291.373-.437.124-.146.167-.25.25-.416.083-.166.04-.313-.022-.438s-.547-1.357-.77-1.851c-.186-.415-.384-.425-.562-.432-.145-.006-.31-.006-.476-.006z"/>
            </svg>
            <p class="font-medium">{{ auth()->user()->profile->phone }}</p>
        </div>
    </div>
@else
    <div class="py-4">
        <div class="bg-white border  border-bunababy-50 overflow-hidden rounded-md">
            <div class="px-4 py-5 sm:px-6 flex justify-between border-bunababy-50 border-b">
                <div>
                    <h3 class="text-md leading-6 font-semibold text-bunababy-400">
                        Sedikit lagi, lengkapi profil
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-900">
                        agar reservasi treatment bisa menjadi lebih cepat.
                    </p>
                </div>
            </div>

            <nav aria-label="Progress">
                <ol class=" rounded-md divide-y divide-bunababy-50 md:flex md:divide-y-0">
                    <li class="relative md:flex-1 md:flex">
                        <a href="{{ route('client.profile.edit') }}" class="group flex items-center w-full">
                            <span class="px-6 py-4 flex items-center text-sm font-medium">
                                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-bunababy-400 rounded-full group-hover:bg-bunababy-300">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-900">Informasi Login</span>
                            </span>
                        </a>

                        <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                            <svg class="h-full w-full text-bunababy-50" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"></path>
                            </svg>
                        </div>

                    </li>

                    <li class="relative md:flex-1 md:flex">
                        <a href="{{ route('client.profile.edit') }}" class="group flex items-center w-full">
                            <span class="px-6 py-4 flex items-center text-sm font-medium">
                                <span
                                    @class([
                                        'flex-shrink-0 w-10 h-10 flex items-center justify-center  rounded-full',
                                        'border-2 border-bunababy-200' => ! $hasPhone,
                                        'bg-bunababy-400 group-hover:bg-bunababy-300' => $hasPhone,
                                    ])
                                    aria-current="step"
                                >
                                    @if (! $hasPhone)
                                        <span class="text-bunababy-200">02</span>
                                    @else
                                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </span>

                                <span
                                    @class([
                                        'ml-4 text-sm font-medium ',
                                        'text-bunababy-200' => ! $hasPhone,
                                        'text-gray-900' => $hasPhone
                                    ])
                                >
                                    Nomor WhatsApp
                                </span>
                            </span>
                        </a>

                        <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                            <svg class="h-full w-full text-bunababy-50" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"></path>
                            </svg>
                        </div>

                    </li>

                    <li class="relative md:flex-1 md:flex">
                        <a href="{{ route('client.addresses') }}" class="group flex items-center w-full">
                            <span class="px-6 py-4 flex items-center text-sm font-medium">
                                <span
                                    @class([
                                        'flex-shrink-0 w-10 h-10 flex items-center justify-center  rounded-full',
                                        'border-2 border-bunababy-200' => ! $hasAddress,
                                        'bg-bunababy-400 group-hover:bg-bunababy-300' => $hasAddress,
                                    ])
                                    aria-current="step"
                                >
                                    @if (! $hasAddress)
                                        <span class="text-bunababy-200">03</span>
                                    @else
                                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </span>

                                <span
                                    @class([
                                        'ml-4 text-sm font-medium ',
                                        'text-bunababy-200' => ! $hasAddress,
                                        'text-gray-900' => $hasAddress
                                    ])
                                >
                                    Alamat Utama
                                </span>
                            </span>
                        </a>

                    </li>
                </ol>
            </nav>
        </div>
    </div>
@endif
