<x-album.layout title="Page | pub-album">
<main>
<div class="album py-5 bg-light">
    <div class="container">
      <div class="d-flex">
        <p class="me-auto">{{ $userName }}さんのページ（ユーザーID：{{ $rows[0]['user_id'] }}）</p>
        <a href="{{ route('randPage') }}" class="btn btn-primary my-2 ms-auto">誰かのページを見る</a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @for($i = 0; $i < 9; $i++)
        <?php
          $imgurl = $rows[$i]['imgurl'];
          $composition = $rows[$i]['composition'];
          if($composition == "") {
            $composition = "未編集状態" . $i+1;
          }
          $position = $rows[$i]['position']
        ?>
          <x-album.card_read imgurl="{{ $imgurl }}" composition="{{ $composition }}" position="{{ $position }}" i="{{ $i }}"></x-album.card_read>
        @endfor
      </div>
    </div>
</div>
</main>
</x-album.layout>