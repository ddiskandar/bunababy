<ul class="fixed bottom-0 left-0 right-0 flex justify-around py-3 z-80 bg-slate-50/90 backdrop-blur-sm">
    <li >
        <a href="{{ route('me') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('me'),
                'text-gray-400 ' => ! Route::is('me'),
            ])>
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75024 19.2502H17.2502C18.3548 19.2502 19.2502 18.3548 19.2502 17.2502V9.75025L12.0002 4.75024L4.75024 9.75025V17.2502C4.75024 18.3548 5.64568 19.2502 6.75024 19.2502Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.74963 15.7493C9.74963 14.6447 10.6451 13.7493 11.7496 13.7493H12.2496C13.3542 13.7493 14.2496 14.6447 14.2496 15.7493V19.2493H9.74963V15.7493Z"></path>
            </svg>
            <span class="mt-2 text-xs">Home</span>
        </a>
    </li>
    <li >
        <a href="{{ route('order.create') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('order.create'),
                'text-gray-400 ' => ! Route::is('order.create'),
            ])>
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 12C4.75 7.99594 7.99594 4.75 12 4.75V4.75C16.0041 4.75 19.25 7.99594 19.25 12V12C19.25 16.0041 16.0041 19.25 12 19.25V19.25C7.99594 19.25 4.75 16.0041 4.75 12V12Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8.75003V15.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.25 12L8.75 12"></path>
            </svg>
            <span class="mt-2 text-xs">Reservasi Baru</span>
        </a>
    </li>
    <li>
        <a
            href="https://api.whatsapp.com/send?phone=628997897991&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+%28Isi+Nama%29.+Lokasi+saya+di+%28Sebutkan+alamat+jelas%29.+Ingin+reservasi+treatment+%28sebutkan%29.+Thank+you" target="_blank"
            class="flex flex-col items-center text-gray-400 cursor-pointer hover:text-bunababy-200"
            >
            <svg class="mt-1 w-7 h-7" fill="none" viewBox="0 0 24 24" >
                <path fill="currentColor"  d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 0 0 1.333 4.993L2 22l5.232-1.236a9.981 9.981 0 0 0 4.774 1.215h.004c5.505 0 9.985-4.48 9.988-9.985a9.922 9.922 0 0 0-2.922-7.066A9.923 9.923 0 0 0 12.012 2zm-.002 2a7.95 7.95 0 0 1 5.652 2.342 7.93 7.93 0 0 1 2.336 5.65c-.002 4.404-3.584 7.987-7.99 7.987a7.999 7.999 0 0 1-3.817-.971l-.673-.367-.745.175-1.968.465.48-1.785.217-.8-.414-.72a7.98 7.98 0 0 1-1.067-3.992C4.023 7.582 7.607 4 12.01 4zM8.477 7.375a.917.917 0 0 0-.666.313c-.23.248-.875.852-.875 2.08 0 1.228.894 2.415 1.02 2.582.123.166 1.726 2.765 4.263 3.765 2.108.831 2.536.667 2.994.625.458-.04 1.477-.602 1.685-1.185.208-.583.209-1.085.147-1.188-.062-.104-.229-.166-.479-.29-.249-.126-1.476-.728-1.705-.811-.229-.083-.396-.125-.562.125-.166.25-.643.81-.79.976-.145.167-.29.19-.54.065-.25-.126-1.054-.39-2.008-1.24-.742-.662-1.243-1.477-1.389-1.727-.145-.25-.013-.386.112-.51.112-.112.248-.291.373-.437.124-.146.167-.25.25-.416.083-.166.04-.313-.022-.438s-.547-1.357-.77-1.851c-.186-.415-.384-.425-.562-.432-.145-.006-.31-.006-.476-.006z"/>
            </svg>

            <span class="mt-2 text-xs">WA Admin</span>
        </a>
    </li>
    <li >
        <a href="{{ route('client.profile') }}"
            @class([
                'flex flex-col items-center cursor-pointer hover:text-bunababy-200',
                'text-bunababy-200' => Route::is('client.profile'),
                'text-gray-400 ' => ! Route::is('client.profile'),
            ])>
            <svg  class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
              </svg>
            <span class="mt-2 text-xs">Profil</span>
        </a>
    </li>
</ul>
