<div class="py-4">
    <div class="font-semibold text-bunababy-400">Katalog Treatment</div>
    <div class="flex flex-wrap mt-3 gap-2">
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
    <div class="flex snap-x scroll-pl-4 space-x-4 overflow-x-auto py-6 sm:scroll-pl-6 sm:space-x-8 md:scroll-pl-[calc(50%-20rem)] lg:scroll-pl-[calc(50%-25rem)]">
        @foreach ($treatments as $treatment)
        <div class="flex-none flex flex-col gap-1 justify-between snap-start w-72 p-6 border max-w-lg border-bunababy-50 rounded shadow-lg shadow-bunababy-50">
            <div class="space-y-1">
                <p class="text-xs text-bunababy-100">{{ $treatment->category->name }}</p>
                <h3 class="font-bold leading-tight text-lg">
                    {{ $treatment->name }}
                </h3>
                <p class="text-sm text-slate-600">{{ $treatment->desc }}</p>
                <p class="text-slate-600 text-xs font-semibold">{{ $treatment->duration }} menit</p>
            </div>
            <div>
                <span class="text-bunababy-200 font-semibold">{{ rupiah($treatment->price) }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
