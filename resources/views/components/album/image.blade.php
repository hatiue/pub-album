@props([
    'image' => ''
])
<!-- 未使用ファイル、このコードは動きません -->
<!-- imageModal.blade.phpを使用しています -->
<!-- p231 画像の表示を行う -->
<!-- 今はclass空白、ドキュメントの翻訳をコメントで追記 -->
@if($image)
<div x-data="{}"><!-- アルパインのコンポーネントを作りたいが、データは必要ない。このような場合、常に空のオブジェクトを渡すことができます。 -->
    <div>
        <div>
            <div><!-- dispatchは、ブラウザのイベントをディスパッチするための便利なショートカットです。 -->
                <a @click="$dispatch('img-modal', { imgModalSrc:
                '{{ asset('storage/images/' . $image) }}' })" class="">
                    <img alt="{{ $image }}" src="{{ asset('storage/images/') . $image }}">
                </a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- p232 img-modalを実行 -->
@once
    <div x-data="{ imgModal : false, imgModalSrc : ''}">
        <div
            @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc;"
            x-cloak
            x-show="imgModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform"
            x-transition:enter-end="opacity-100 transform"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform"
            x-transition:leave-end="opacity-0 transform"
            x-on:click.away="imgModalSrc = ''"
            class="">

            <div @click.away="imgModal = ''" class="">
                <div>
                    <button @click="imgModal = ''" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div>
                    <img
                        class=""
                        :alt="imgModalSrc"
                        :src="imgModalSrc">
                </div>
            </div>
        </div>
    </div>
    @push('css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush
@endonce