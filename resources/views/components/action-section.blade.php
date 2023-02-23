<div {{ $attributes->merge(['class' => 'flex flex-col overflow-hidden bg-white rounded shadow-sm']) }}>
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="font-semibold">
                    <span>{{ $title }}</span>
                </h3>
                @if (isset($description))
                <p class="text-sm text-gray-500">
                    {{ $description }}
                </p>
                @endif
            </div>
            <div class="md:w-2/3 md:pl-2">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
