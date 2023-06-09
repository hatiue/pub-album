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
              <a href="{{ route('page', ['userId' => 1]) }}" class="btn btn-primary my-2">ランダムに見る（未）</a>
              <p>有効なページを作成したユーザーIDを抽出してランダムに飛ばす予定</p>
              <p>現在はユーザーID1固定（シーディングで作成されるユーザー）</p>
              <p>URLのIDを触れば利用登録後に作成ボタンを押したユーザーのページへ直接飛べます</p>              
              <input type="text" placeholder="ユーザーIDを入力"><button type="button">仮</button>
              <p>ユーザーIDか名前を指定してページを表示　未実装</p>
            </p>
        </div>
      </div>
    </section>

</main>
</x-album.layout>