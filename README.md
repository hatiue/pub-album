<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 内容

アプリケーションをアルバムと例えて、利用登録したアカウント1つにつき、9枚分だけ編集できる1ページが与えられます。  
共用のアルバムをつくろう、という感じです。アルバムというていですが、更新は画像だけ・本文だけでも構いません。  
※[Bootstrapのサンプル](https://getbootstrap.jp/docs/5.0/examples/)から、[Album](https://getbootstrap.jp/docs/5.0/examples/album/)を使用しました。

## 1.インストール

- Docker Desktopをインストール
- WSL2をインストール
- Microsoft StoreからUbuntuを入手(22.04)
- Docker Desktopの設定をUbuntuを利用するように変更
- Docker Desktopの設定でDocker Composeを有効にする
- Microsoft StoreからWindows Terminalを入手
- Windows TerminalからUbuntuを開き、sudo apt update && sudo apt upgrade -y

## 2.開発環境を再現する

- 下記引用のコマンドを入力
#### [Laravelドキュメント](https://readouble.com/laravel/10.x/ja/) パッケージ ＞ [Sailの章](https://readouble.com/laravel/10.x/ja/sail.html)
「既存アプリケーションでComposer依存関係のインストール」より一部を引用

>アプリケーションのリポジトリをローカルコンピュータにクローンした後、Sailを含むアプリケーションのComposer依存関係は一切インストールされていません。
>
>アプリケーションの依存関係をインストールするには、アプリケーションのディレクトリに移動し、次のコマンドを実行します。このコマンドは、PHPとComposerを含む小さなDockerコンテナを使用して、アプリケーションの依存関係をインストールします。
>
>docker run --rm \\
>    -u "$(id -u):$(id -g)" \\
>    -v "$(pwd):/var/www/html" \\
>    -w /var/www/html \\
>    laravelsail/php82-composer:latest \\
>    composer install --ignore-platform-reqs
#### ※コマンドのバックスラッシュを表示させるために、少し手を加えています。正確な表現はリンク先をご確認ください。

#### sailを起動した後に、**空のデータベース**「binds」が作成されているはずです。確認は下記コマンドで可能です。
- cd pub-album
- ./vendor/bin/sail up -d
- ./vendor/bin/sail mysql
- show databases; // exitで戻る

## 3.次の準備

「.env.example」に記載されている内容を、「.env」にリネームしてご使用ください。

## 4.起動

下記のコマンドを順に実行
- cd pub-album
- ./vendor/bin/sail up -d // アプリケーションコンテナをデーモン起動する
- ./vendor/bin/sail artisan storage:link // 画像保存用ディレクトリのシンボリックリンクを作成
- ./vendor/bin/sail artisan migrate // テーブルを作成、初回起動時のみ
- ./vendor/bin/sail artisan db:seed // ダミーデータを作成　id1のユーザーと、そのユーザーのページを作成※恐らくエラーが発生しますが、データは作成されています

## 5.表示する

ローカルホストで表示します。  
http://localhost/pub-album  
ダミーデータを作成していれば、ランダムに見るボタンからサンプルページが確認できます。

## 6.使ってみる

- 利用登録ボタンからユーザー登録
- 登録・ログイン後は、アルバムのページをつくるボタンから自分用のページへ行けます
- 1～9枚目まであるので、編集したい箇所の編集するボタンを押してください。削除ボタンは確認無しに働きます

## 7.終了する

- ./vendor/bin/sail down // アプリケーションコンテナを停止

## エイリアスの設定（オプション）
「./vendor/bin/sail」を「sail」に省略する設定
- vi ~/.profile
- alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'　// 左記を入力して保存
- source ~/.profile
