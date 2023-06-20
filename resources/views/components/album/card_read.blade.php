<!-- 1枚のレイアウト -->
<div class="col">
    <div class="card shadow-sm">
      <div class="d-flex justify-content-center border border-dark m-1" style="height: 225px;">
        @if($imgurl !== "")
          <x-album.imageModal imgurl="{{ $imgurl }}" i="{{ $i }}"></x-album.imageModal>
        @else
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">画像無し</text></svg>
        @endif
      </div>
        <div class="card-body">
          <p class="card-text">{{ $composition }}</p><!-- 文字サイズ少し下げたい -->
          <div class="d-flex justify-content-between align-items-center">
          </div>
        </div>
    </div>
</div>