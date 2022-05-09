<x-guest-layout>

<!-- Page Container -->
<div id="page-container" class="flex flex-col w-full min-h-screen mx-auto bg-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-col flex-auto max-w-full">
    <!-- Hero -->
    <div class="overflow-hidden bg-white">
        <!-- Header -->
        <header id="page-header" class="flex items-center flex-none py-10 bg-white">
            <div class="container flex flex-col px-4 mx-auto space-y-6 text-center md:flex-row md:items-center md:justify-between md:space-y-0 xl:max-w-7xl lg:px-8">
                <div>
                    Bunababy.care
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
                        <a href="/me" class=" px-3 py-2 font-semibold ">
                        <span>Home</span>
                        </a>
                    @else
                        <a href="/login" class="px-3 py-2 font-semibold ">
                            <span>Login</span>
                        </a>
                        <a href="/login" class="px-6 rounded-full bg-bunababy-200 text-white py-1 font-semibold ">
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </header>
        <!-- END Header -->

        <!-- Hero Content -->
        <div class="container flex flex-col px-4  mx-auto space-y-16 text-center lg:flex-row-reverse lg:space-y-0 lg:text-left xl:max-w-7xl lg:px-8 lg:py-16">
        <div class="lg:w-1/2 lg:flex">
            <div>
                <div class="mb-6">
                    <img src="/images/logo.svg" alt="Logo" width="300">
                </div>
                <p class="text-lg  text-gray-600 ">
                    Bagi setiap orang tua, setiap detik yang dilalui dengan hadirnya buah hati adalah moment terindah. Dan perkembangan fisiologis dari hamil, bersalin, nifas, menyusui sejatinya kado berharga bagi wanita.
                </p>
                <p class="text-lg  mt-4 text-gray-600 ">
                    Kami hadir sebagai solusi Ayah dan Bunda dalam menjadi sahabat kesehatan seputar kebidanan, mempersiapkan diri sedari pra nikah, kehamilan, nifas, perawatan bayi hingga pemantauan pertumbuhan bisa dilakukan dengan nyaman dan praktis di rumah.
                </p>
                <div class="mt-6">
                    <a href="{{ route('order.create') }}" class="inline-block" >
                        <div class="flex items-center gap-3 py-3 px-8 text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
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

    <!-- CTA Section: Simple Boxed -->
    <div class="overflow-hidden bg-gray-100">
        <div class="container px-4 py-16 mx-auto xl:max-w-7xl lg:px-8 lg:py-32">
        <div class="relative">
            <div class="absolute top-0 right-0 w-32 h-32 text-gray-300 transform translate-x-12 -translate-y-16 pattern-dots-lg lg:w-48 lg:h-48"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 text-gray-300 transform -translate-x-12 translate-y-16 pattern-dots-lg lg:w-48 lg:h-48"></div>
            <div class="relative p-10 text-center bg-white rounded shadow lg:py-12 lg:px-16">
            <div class="space-y-10">
                <!-- Heading -->
                <div class="text-center">
                <h2 class="mb-4 text-3xl font-extrabold md:text-4xl">
                    Ready? <span class="text-pink-600">Let’s do it!</span>
                </h2>
                <h3 class="text-lg font-medium text-gray-600 md:text-xl md:leading-relaxed">
                    Get your own custom dashboard and start building amazing services, always with the most solid and rock steady foundation.
                </h3>
                </div>
                <!-- END Heading -->

                <!-- CTA -->
                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-center sm:space-y-0 sm:space-x-2">
                <a href="javascript:void(0)" class="inline-flex items-center justify-center px-6 py-4 space-x-2 font-semibold leading-6 text-white bg-pink-700 border border-pink-700 rounded focus:outline-none hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-arrow-right"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span>Get Started</span>
                </a>
                </div>
                <!-- END CTA -->
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- END CTA Section: Simple Boxed -->

    <!-- Footer: Simple With Social -->
    <footer id="page-footer" class="bg-white">
        <div class="container flex flex-col px-4 py-16 mx-auto space-y-6 text-sm text-center md:flex-row-reverse md:justify-between md:space-y-0 md:text-left lg:text-base xl:max-w-7xl lg:px-8 lg:py-32">
        <nav class="space-x-4">
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-facebook"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z"></path></svg>
            </a>
            <a href="javascript:void(0)" class="text-gray-400 hover:text-pink-600">
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 icon-instagram"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
            </a>
        </nav>
        <nav class="space-x-2 sm:space-x-4">
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
            About
            </a>
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
            Terms of Service
            </a>
            <a href="javascript:void(0)" class="font-medium text-gray-900 hover:text-gray-500">
            Privacy Policy
            </a>
        </nav>
        <div class="text-gray-600">
            <span class="font-medium">Bunababy.care</span>
        </div>
        </div>
    </footer>
    <!-- END Footer: Simple With Social -->

    </main>
    <!-- END Page Content -->
</div>
<!-- END Page Container -->

</x-guest-layout>
