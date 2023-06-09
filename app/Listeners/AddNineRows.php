<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Bind;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNineRows
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $userId = $event; // 新規登録したユーザーのIDのはず

        // insertはイベントの自動実行がされないらしい？
    
        // fillableにpositionとuser_idを入れても下記エラー文が出力される
        // Object of class App\Events\UserRegistered could not be converted to string
        for($i = 1; $i <= 9; $i++) {
            Bind::create([
                'position' => $i,
                'user_id' => $userId
            ]);
        }
        
    }
}
