<!-- BootstrapのドキュメントModalを参照 -->

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> </button> -->
  <img class="img-thumbnail mw-100 mh-100" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}" src="{{ asset('storage/images/' . $imgurl) }}">
  
  
  <!-- Modal -->
  <!-- アニメーションを変更するには変数の設定が必要 -->
  <!-- https://getbootstrap.jp/docs/5.0/components/modal/#change-animation -->
  <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <!--
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
         -->
        <div class="modal-body mx-auto">
          <img class="mw-100 mg-100" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}" src="{{ asset('storage/images/' . $imgurl) }}">
        </div>
        <!--<div class="modal-footer">-->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
        <!--</div>-->
      </div>
    </div>
  </div>
