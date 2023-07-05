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
        // iphone8で取った写真がjpegで1.5MB～3.2MB
        // スマホゲームのスクショはpngで1.5～4MB超
        return [
            'composition' => 'max:128|nullable',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048' // 一時4096にして戻した
        ];
    }

    public function imgurl(): string
    {
        return $this->input('imgurl');
    }

    public function composition(): ?string
    {
        return $this->input('composition');
    }

    public function position(): int
    {
        // return $this->input('position'); // NULLが返ってくる
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
