<x-album.layout title="HOME | pub-album">
<main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-12 col-md-8 mx-auto">
          <p class="lead text-muted">このサイトでは、アルバムに1ページだけ自分のページを作ることができます。</p>
            @guest
            <a href="{{ route('login') }}" class="btn btn-primary my-2">ログイン</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary my-2">利用登録</a>
            @endguest
            @auth
            <form action="{{ route('add', ['userId' => auth()->id()]) }}" method="post">
              @csrf
              <button class="btn btn-primary my-2" type="submit">アルバムのページをつくる</button>
              <p>↑ログイン後のユーザーの本人ページもここから</p>
              @if(session('message'))
                <div class="teble-status">
                  {{ session('message') }}
                </div>
              @endif
            </form>
            @endauth
          </p>
        </div>
        <div class="col-lg-12 col-md-8 mx-auto">
            <p class="lead text-muted">他のユーザーのページを見ることもできます。</p>
            <h2 class="fw-light">アルバムを見る</h2>
              <a href="{{ route('randPage') }}" class="btn btn-primary my-2">誰かのページを見る</a>
              <p>↑有効なページを作成したユーザーIDを抽出してランダムに飛ぶ</p>
              <p>↑URLにユーザーIDを反映したい：未</p>
              <form action="{{ route('search') }}" method="get">
                <input type="text" id="search" name="searchWord" placeholder="ユーザーのIDか名前を入力">
                <button type="submit" id="search" class="btn btn-outline-info mx-2">検索する</button>
                <p style="color: red">{{ session('searchMessage') }}</p>
                <p>※エスケープ未対応　addcslashes()</p>
              </form>
            </p>
        </div>
      </div>
    </section>

</main>
</x-album.layout>