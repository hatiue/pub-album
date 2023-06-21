<x-album.layout title="HOME | pub-album">
<main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-12 col-md-8 mx-auto">
          <p class="lead text-muted">このサイトでは、アルバムに1ページだけ自分のページを作ることができます。</p>
          <p></p>
          <h2 class="fw-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
              <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
            </svg>
            アルバムを見る
          </h2>
          <p>ランダムに開きます。</p>
          <a href="{{ route('randPage') }}" class="btn btn-primary my-2">誰かのページを見る</a>
          <p></p>
          <h2 class="fw-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            探す
          </h2>
          <p>ユーザー名とユーザーIDを検索します。</p>
          <form action="{{ route('search') }}" method="get">
            <input type="text" id="search" name="searchWord" placeholder="ユーザーのIDか名前を入力">
            <button type="submit" id="search" class="btn btn-outline-info mx-2">検索する</button>
            <p style="color: red">{{ session('searchMessage') }}</p>
          </form>
        </div>

        <div class="col-lg-12 col-md-8 mx-auto">
            @guest
              <p class="lead text-muted">自分のページをつくるためには、利用登録とログインが必要です。</p>
              <a href="{{ route('login') }}" class="btn btn-primary my-2">ログイン</a>
              <a href="{{ route('register') }}" class="btn btn-outline-primary my-2">利用登録</a>
            @endguest
            @auth
              <form action="{{ route('add', ['userId' => auth()->id()]) }}" method="post">
                @csrf
                <button class="btn btn-primary my-2" type="submit">アルバムのページをつくる</button>
                @if(session('message'))
                  <div class="teble-status">
                    {{ session('message') }}
                  </div>
                @endif
              </form>
            @endauth
        </div>
      </div>
    </section>
</main>
</x-album.layout>