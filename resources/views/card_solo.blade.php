<x-album.layout title="Update | pub-album">
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="card shadow-sm">
        @if(session('update.success'))
          <p style="color: green">{{ session('update.success') }}</p>
        @endif
        @auth
        <div class="d-flex justify-content-center border border-dark m-1" style="height: 225px;">
          @if($card->imgurl != "")
            <img class="img-thumbnail mw-100 mh-100" src="{{ asset('storage/images/' . $card->imgurl) }}">
          @else
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">画像無し</text></svg>
          @endif
        </div>
            <form id="imgUpdate" action={{ route('updateImage', ['userId' => auth()->id(), 'position' => $card->position]) }} method="post" enctype="multipart/form-data">
            @csrf
            <p style="color: red">注意：画像と本文の更新ボタンは別々なので、<br>　　　両方編集したい時は1つずつお願いします。</p>
            <div class="d-flex justify-content-center">
              <input id="imgUpdate" type="file" name="image">
            </div>
            <div class="d-flex justify-content-end align-items-center me-3"><!-- 位置 -->
              <button id="imgUpdate" type="submit" class="btn btn-sm btn-outline-secondary">画像を更新</button>
            </div>
            
          </form>
          <div class="card-body">
            <form id="update" action={{ route('updateComposition', ['userId' => auth()->id(), 'position' => $card->position]) }} method="post">
              @csrf
                <div class="d-flex justify-content-center">
                  <textarea class="card-text mb-2" cols="40" rows="5" maxlength="128" name="composition">{{ $card->composition }}</textarea>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <input type="hidden" name="position" value="{{ $card->position }}">
                    <button id="update" type="submit" class="btn btn-sm btn-outline-secondary">本文を更新</button>
                </div>
            </form>
              
            <div class="mt-1">
              <div class="d-flex justify-content-start">
                <form id="delete" action={{ route('delete', ['userId' => auth()->id(), 'position' => $card->position]) }} method="post">
                  @csrf
                  <button id="delete" type="submit" class="btn btn-sm btn-outline-danger"> 削除 </button>
                </form>
              </div>
              <div class="d-flex justify-content-end">
                  <button id="back" type="button" class="btn btn-sm btn-outline-secondary">
                    <a class="text-decoration-none" href={{ route('mypage', ['userId' => auth()->id()]) }}>戻る</a>
                  </button>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <small class="text-muted">{{ $card->position }}枚目を編集中</small>
            </div>

          </div>
        @endauth
      @guest
        <p>ログインしてから時間が経ちすぎてしまいました…</p>
        <button type="button" class="btn btn-sm btn-outline-secondary"><a href={{ route('home')}}>トップへ戻る</a></button>
      @endguest
      </div>
    </div>
  </div>
</x-album.layout>
