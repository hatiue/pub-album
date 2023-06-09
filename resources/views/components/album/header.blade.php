<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <!-- collapse:bootstrapのJSプラグイン、折り畳み機能 使わないが便利そう -->
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">このサイトは何？</h4>
            <p class="text-muted">画像を9枚以下に厳選して、自分だけのページを作成しましょう。そして他の人のページを旅しましょう！</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Twitter（未）</a></li>
              <li><a href="#" class="text-white">Like on Facebook（無）</a></li>
              <li><a href="#" class="text-white">Email me（未）</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">    
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
          <strong>pub-album</strong>
        </a>
        @auth
        <form method="post" action="{{ route('logout') }}">
          @csrf
          <button type="submit">ログアウト</button>
        </form>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
</header>