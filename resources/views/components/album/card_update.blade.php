<div class="col">
    <div class="card shadow-sm">
      <div class="d-flex justify-content-center border border-dark m-1" style="height: 225px;">
        @if($imgurl !== "")
          <!-- 画像がある場合は表示 -->
          <x-album.imageModal imgurl="{{ $imgurl }}" i="{{ $i }}"></x-album.imageModal>
        @else
          <!-- 画像が無い場合は代替のsvg製四角形を表示 -->
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">画像無し</text></svg>
        @endif
      </div>
      <div class="card-body">
        <p class="card-text">{{ $composition }}</p>
        <div class="d-flex justify-content-between align-items-center">
          @auth
          <div class="btn-group">
            <form id="card" action={{ route('card', ['userId' => auth()->id(), 'position' => $position]) }} method="post">
              @csrf
              <input type="hidden" value="{{ $position }}">
              <button id="card" type="submit" class="btn btn-sm btn-outline-secondary">編集する</button>
            </form>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">削除※編集画面内に実装</button> -->
          </div>
          @endauth
          <small class="text-muted">{{ $position }}枚目</small>
        </div>
      </div>
    </div>
</div>
