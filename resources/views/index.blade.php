<x-album.layout title="検索結果 | pub-album">
<main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-12 col-md-8 mx-auto">
          <p>ToDo：ヒット件数</p>
          <p>ToDo：閲覧用に有効なページが作成されていなければリンクを無効にする</p>
          <p>■IDでの検索結果</p>
          @if($id)
            <a href="{{ route('page', ['userId' => $id[0]['id']]) }}">
              <p>ID: {{ $id[0]['id'] }}  名前: {{ $id[0]['name'] }}</p>
            </a>
          @else
            <p>ユーザーIDでの検索結果は0件でした…</p>
          @endif
          <p>■ユーザー名での検索結果</p>
          @if($users)
            @foreach($users as $user)
            <a href="{{ route('page', ['userId' => $user['id']]) }}">
              <p>ID: {{ $user['id'] }}  名前: {{ $user['name'] }}</p>
            </a>
            @endforeach
          @else
            <p>ユーザー名での検索結果は0件でした…</p>
          @endif
          <a href="{{ route('home') }}" class="btn btn-outline-primary">戻る</a>
        </div>
      </div>
    </section>
</main>
</x-album.layout>