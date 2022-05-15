<x-guest-layout>

<!-- Page Container -->
<div id="page-container" class="flex flex-col w-full min-h-screen mx-auto bg-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-col flex-auto max-w-full">
    <!-- Hero -->
    <div class="overflow-hidden bg-white">
        <!-- Header -->
        <header id="page-header" class="flex items-center flex-none py-8 bg-white">
            <div class="container flex flex-col px-4 mx-auto space-y-6 text-center md:flex-row md:items-center md:justify-between md:space-y-0 xl:max-w-7xl lg:px-8">
                <div>
                    BunaBaby.Care
                </div>
                <nav class="space-x-4 md:space-x-8">
                    <a href="javascript:void(0)" class="font-medium text-slate-600">
                    <span>Treatment</span>
                    </a>
                    <a href="javascript:void(0)" class="font-medium text-slate-600">
                    <span>Testimonial</span>
                    </a>
                    <a href="javascript:void(0)" class="font-medium text-slate-600">
                    <span>FAQ</span>
                    </a>
                    <a href="javascript:void(0)" class="font-medium text-slate-600">
                    <span>About</span>
                    </a>
                </nav>

                <div class="flex items-center justify-center space-x-2 text-bunababy-200 hover:text-bunababy-100">
                    @auth
                        <a href="/me" class=" px-3 py-2 font-medium">
                        <span>Home</span>
                        </a>
                    @else
                        <a href="/login" class="px-3 py-2 font-medium">
                            <span>Login</span>
                        </a>
                        <a href="/register" class="px-6 rounded-full bg-bunababy-200 text-white py-1 font-medium">
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </header>
        <!-- END Header -->

        <!-- Hero Content -->
        <div class="container flex flex-col px-4 mx-auto space-y-16 text-center lg:flex-row-reverse lg:space-y-0 lg:text-left xl:max-w-7xl lg:px-8 lg:py-24">
        <div class="lg:w-1/2 lg:flex ">
            <div>
                <div class="flex justify-center md:justify-start w-full">
                    <img class="mb-6" src="/images/logo-full.svg" alt="Logo" width="350">
                </div>
                <p class="text-gray-600 ">
                    Bagi setiap orang tua, setiap detik yang dilalui dengan hadirnya buah hati adalah moment terindah. Dan perkembangan fisiologis dari hamil, bersalin, nifas, menyusui sejatinya kado berharga bagi wanita.
                </p>
                <p class="mt-4 text-gray-600 ">
                    Kami hadir sebagai solusi Ayah dan Bunda dalam menjadi sahabat kesehatan seputar kebidanan, mempersiapkan diri sedari pra nikah, kehamilan, nifas, perawatan bayi hingga pemantauan pertumbuhan bisa dilakukan dengan nyaman dan praktis di rumah.
                </p>
                <div class="mt-6">
                    <a href="{{ route('order.create') }}" class="inline-block" >
                        <div class="flex items-center gap-3 py-3 px-8 text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 11.25V8.75C19.25 7.64543 18.3546 6.75 17.25 6.75H6.75C5.64543 6.75 4.75 7.64543 4.75 8.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H11.25M17 14.75V19.25M19.25 17H14.75M8 4.75V8.25M16 4.75V8.25M7.75 10.75H16.25"></path>
                            </svg>
                            <span>Pesan Treatment Sekarang</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:w-1/2 lg:mr-16 lg:flex lg:justify-center lg:items-center">
            <div class="relative lg:w-96">
            <div class="absolute top-0 left-0 w-32 h-48 text-pink-100 transform -translate-x-16 -translate-y-12 pattern-dots-xl md:h-96 -rotate-3"></div>
            <div class="absolute bottom-0 right-0 w-32 h-48 text-pink-100 transform translate-x-16 translate-y-12 pattern-dots-xl md:h-96 rotate-3"></div>
            <div class="absolute top-0 right-0 w-32 h-32 -mt-12 -mr-12 bg-yellow-200 bg-opacity-50 rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 -mb-10 -ml-10 transform bg-blue-200 bg-opacity-50 rounded-xl rotate-3"></div>
            <img src="https://source.unsplash.com/oko_4WnoM98/800x1000" alt="Hero Image" class="relative mx-auto rounded-lg shadow-lg" />
            </div>
        </div>
        </div>
        <!-- END Hero Content -->
    </div>
    <!-- END Hero -->

    <div>
        @livewire('treatments-catalog')
    </div>

    <!-- FAQ Section: To the Side -->
    <div class="bg-white">
        <div class="lg:flex space-y-16 lg:justify-between lg:space-x-8 lg:space-y-0 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
        <!-- Heading -->
        <div class="text-center lg:text-left">
            <div class="text-sm uppercase font-bold tracking-wider mb-1 text-pink-700">
            We Answer
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
            Frequently Asked Questions
            </h2>
            <h3 class="text-lg md:text-xl md:leading-relaxed font-medium text-gray-600">
            Be sure to <a href="javascript:void(0)" class="text-pink-600 hover:text-pink-400">get in touch</a> and let us know if you have any further questions.
            </h3>
        </div>
        <!-- END Heading -->

        <!-- FAQ -->
        <div class="space-y-8 lg:w-3/5 lg:flex-none">
            <div class="prose prose-pink">
            <h4>
                What features are included?
            </h4>
            <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
            </p>
            </div>
            <div class="prose prose-pink">
            <h4>
                Do I get access to the community?
            </h4>
            <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
            </p>
            </div>
            <div class="prose prose-pink">
            <h4>
                Do you offer email support?
            </h4>
            <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
            </p>
            </div>
            <div class="prose prose-pink">
            <h4>
                Are the updates free for life?
            </h4>
            <p>
                Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
            </p>
            </div>
        </div>
        <!-- END FAQ -->
        </div>
    </div>
    <!-- END FAQ Section: To the Side -->

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 sm:text-4xl">
            <span class="block">Mau pesan treatment?</span>
            <span class="block text-bunababy-400">Langsung klik tombol pesan treatment sekarang.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex">
                <a href="{{ route('order.create') }}" class="inline-block" >
                    <div class="flex items-center gap-3 py-3 px-8 text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 11.25V8.75C19.25 7.64543 18.3546 6.75 17.25 6.75H6.75C5.64543 6.75 4.75 7.64543 4.75 8.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H11.25M17 14.75V19.25M19.25 17H14.75M8 4.75V8.25M16 4.75V8.25M7.75 10.75H16.25"></path>
                        </svg>
                        <span>Pesan Treatment Sekarang</span>
                    </div>
                </a>
            </div>
        </div>
        </div>
    </div>

    <!-- Footer: Simple With Social -->
    <footer id="page-footer" class="bg-white">
        <div class="container flex flex-col px-4 space-y-6 text-sm md:flex-row-reverse md:justify-between md:px-16 py-16">
            <div class="text-gray-600">
                <img class="mb-6 " src="/images/logo-full.svg" alt="Logo" width="300">
            </div>
            <div class="text-slate-500 md:w-2/3 space-y-6">
                <div class="flex items-start gap-2">
                    <svg class="w-6 h-6 flex-none" class="" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.25 11C18.25 15 12 19.25 12 19.25C12 19.25 5.75 15 5.75 11C5.75 7.5 8.68629 4.75 12 4.75C15.3137 4.75 18.25 7.5 18.25 11Z"></path>
                        <circle cx="12" cy="11" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                    </svg>
                    <div class="text-sm ">
                        <div class="font-semibold">Klinik</div>
                        <div>Komplek Nata Endah Blok N No. 170, Cibabat,  Cimahi</div>
                    </div>
                </div>
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" >
                        <path fill="currentColor"  d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 0 0 1.333 4.993L2 22l5.232-1.236a9.981 9.981 0 0 0 4.774 1.215h.004c5.505 0 9.985-4.48 9.988-9.985a9.922 9.922 0 0 0-2.922-7.066A9.923 9.923 0 0 0 12.012 2zm-.002 2a7.95 7.95 0 0 1 5.652 2.342 7.93 7.93 0 0 1 2.336 5.65c-.002 4.404-3.584 7.987-7.99 7.987a7.999 7.999 0 0 1-3.817-.971l-.673-.367-.745.175-1.968.465.48-1.785.217-.8-.414-.72a7.98 7.98 0 0 1-1.067-3.992C4.023 7.582 7.607 4 12.01 4zM8.477 7.375a.917.917 0 0 0-.666.313c-.23.248-.875.852-.875 2.08 0 1.228.894 2.415 1.02 2.582.123.166 1.726 2.765 4.263 3.765 2.108.831 2.536.667 2.994.625.458-.04 1.477-.602 1.685-1.185.208-.583.209-1.085.147-1.188-.062-.104-.229-.166-.479-.29-.249-.126-1.476-.728-1.705-.811-.229-.083-.396-.125-.562.125-.166.25-.643.81-.79.976-.145.167-.29.19-.54.065-.25-.126-1.054-.39-2.008-1.24-.742-.662-1.243-1.477-1.389-1.727-.145-.25-.013-.386.112-.51.112-.112.248-.291.373-.437.124-.146.167-.25.25-.416.083-.166.04-.313-.022-.438s-.547-1.357-.77-1.851c-.186-.415-.384-.425-.562-.432-.145-.006-.31-.006-.476-.006z"/>
                    </svg>
                    <div class="text-sm ">
                        <div class="font-semibold">WhatsApp</div>
                        <div>+62 899 789 7991</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer: Simple With Social -->

    </main>
    <!-- END Page Content -->
</div>
<!-- END Page Container -->

</x-guest-layout>
