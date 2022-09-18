<div>
    <div class="px-6 pt-4">
        <x-title >Katalog Treatment</x-title>
        <div class="flex flex-wrap gap-2 mt-3">
            <button
                wire:click="$set('filterCategory', '')"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full',
                    'bg-bunababy-200 text-white' => $filterCategory == '',
                    'text-bunababy-200' => $filterCategory != '',
                ])>
                Semua
            </button>
            @foreach ($categories as $category)
            <button
                wire:click="$set('filterCategory', {{ $category->id }})"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full',
                    'bg-bunababy-200 text-white' => $filterCategory == $category->id,
                    'text-bunababy-200' => $filterCategory != $category->id,
                ])>
                {{ $category->name }}
            </button>
            @endforeach
        </div>
    </div>
    <div class="flex snap-x scroll-pl-4 space-x-4 overflow-x-auto p-4 sm:scroll-pl-6 sm:space-x-8 md:scroll-pl-[calc(50%-20rem)] lg:scroll-pl-[calc(50%-25rem)]">
        <div class=" snap-start">
        </div>
        @foreach ($treatments as $treatment)
        <div class="flex flex-col justify-between flex-none gap-1 p-6 shadow-lg shadow-bunababy-50 rounded snap-start w-72 border-bunababy-200 ">
            <div class="space-y-1">
                <p class="text-xs text-bunababy-100">{{ $treatment->category->name }}</p>
                <h3 class="text-lg font-bold leading-tight">
                    {{ $treatment->name }}
                </h3>
                <p class="text-sm text-slate-600">{{ $treatment->desc }}</p>
                <p class="text-xs font-semibold text-slate-600">{{ $treatment->duration }} menit</p>
            </div>
            <div>
                <span class="font-semibold text-bunababy-200">{{ rupiah($treatment->price) }}</span>
            </div>
        </div>
        @endforeach
        <div class=" snap-start">
        </div>
    </div>
</div>
