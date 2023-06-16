<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // 画像のファイルサイズについて：iphone8で取った写真がjpegで1.5MB～3.2MBなので2048KBじゃ少ないかも
        // スマホゲームのスクショはpngで1.5～4MB超
        // ただしPCからのスクショやペイント製画像は1MBもない 通帳のカラースキャンが900KBくらい
        return [
            'composition' => 'max:128',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048' 
        ];
    }

    public function imgurl(): string
    {
        return $this->input('imgurl');
    }

    public function composition(): string
    {
        return $this->input('composition');
    }

    public function position(): int
    {
        //return $this->input('position'); // hiddenで送ってるから？input()ではNULLが返ってくる
        return $this->position;
    }

    public function image()
    {
        return $this->file('image');
    }

    public function searchUser()
    {
        return $this->input('searchWord');
    }

}
