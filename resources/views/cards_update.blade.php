<x-album.layout title="MyPage | pub-album">
<main>
<div class="album py-5 bg-light">
  <div class="container">
    ユーザー名：{{ $userName }}
      @if(session('message'))
        <p style="color: green">{{ session('message') }}</p>
      @endif
      @if(session('delete.success'))
        <p style="color: red">{{ session('delete.success') }}</p>
      @endif
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @for($i = 0; $i < 9; $i++)
      <?php
        $imgurl = $rows[$i]['imgurl'];
        if($rows[$i]['composition'] == "") {
          $composition = "未編集状態" . $i+1;
        } else {
          $composition = $rows[$i]['composition'];
        }
        $position = $rows[$i]['position']
      ?>
        <x-album.card_update user="{{ auth()->id() }}" imgurl="{{ $imgurl }}" composition="{{ $composition }}" position="{{ $position }}"></x-album.card_update>
      @endfor
    </div>
  </div>
</div>
</main>
</x-album.layout>