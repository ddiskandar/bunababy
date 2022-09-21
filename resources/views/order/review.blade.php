<div x-data="
    {
        rating: @entangle('rate'),
        hoverRating: 5,
        ratings: [
            {'amount': 1, 'label':'kecewa', 'placeholder':'Ceritain lebih lengkap apa yang bikin bunda tidak puas dan perlu ditingkatkan.'},
            {'amount': 2, 'label':'tidak puas', 'placeholder':'Ceritain lebih lengkap apa yang bikin bunda tidak puas dan perlu ditingkatkan.'},
            {'amount': 3, 'label':'kurang puas', 'placeholder':'Kasih tahu apa yang kurang dan yang perlu ditingkatkan.'},
            {'amount': 4, 'label':'puas', 'placeholder':'Yuk, ceritain kepuasan bunda tentang kualitas treatment & pelayanan bidan.'},
            {'amount': 5, 'label':'sangat puas', 'placeholder':'Yuk, ceritain kepuasan bunda tentang kualitas treatment & pelayanan bidan.'}
        ],
        rate(amount) {
            if (this.rating == amount) {
                this.rating = 0;
            }
            else this.rating = amount;
        },
        currentLabel() {
            let r = this.rating;
            if (this.hoverRating != this.rating) r = this.hoverRating;
            let i = this.ratings.findIndex(e => e.amount == r);
            if (i >=0) {return this.ratings[i].label;} else {return ''};
        },
        currentPlaceholder() {
            let r = this.rating;
            if (this.hoverRating != this.rating) r = this.hoverRating;
            let i = this.ratings.findIndex(e => e.amount == r);
            if (i >=0) {return this.ratings[i].placeholder;} else {return ''};
        }
    }
">
    <x-title>Ulasan anda</x-title>
    <div class="py-2">
        <div class="flex">
            <div class="flex space-x-0">
                <template x-for="(star, index) in ratings" :key="index">
                    <button x-on:click="rate(star.amount)" x-on:mouseenter="hoverRating = star.amount" x-on:mouseleave="hoverRating = rating"
                        aria-hidden="true"
                        x-bind:title="star.label"
                        class="w-8 p-1 m-0 rounded-sm cursor-pointer fill-current text-slate-400 focus:outline-none focus:shadow-outline"
                        x-bind:class="{
                            'text-slate-600': hoverRating >= star.amount,
                            'text-yellow-400': rating >= star.amount && hoverRating >= star.amount,
                        }">
                        <svg class="transition duration-150 w-15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </button>

                </template>
            </div>
        </div>
        <x-input-error for="rate" class="mt-2" />
    </div>
    <div class="py-2">
        <p class="mb-1 text-sm font-semibold">Apa yang bikin bunda <span x-text="currentLabel()"></span>?</p>
        <x-textarea wire:model.defer="description" name="description" x-bind:placeholder="currentPlaceholder()" class="w-full placeholder:text-sm"></x-textarea>
        <x-input-error for="description" class="mt-2" />
    </div>
    <div class="py-2">
        <x-button wire:click="save">
            Simpan
        </x-button>
    </div>
</div>
