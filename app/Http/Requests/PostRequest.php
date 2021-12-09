<?php

namespace App\Http\Requests;

use App\Rules\MaxSixExclamationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return $this->user()->can('create', Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'               => "required|unique:posts,title|max:255",
            'content'             => [ "required", "min:100", new MaxSixExclamationRule ],
            'schedule_publishing' => "boolean",
            'publish_at'          => "bail|date|after_or_equal:today|required_if:schedule_publishing,true",
            'tags'                => "required|array|min:2",
            'tags.*'              => "distinct,exists:tags,name",
            'thumb_img'           => "image|mimes:jpeg,png,jpg|min_width=100,min_height=200",
        ];
    }

    public function messages()
    {
        return [
            'publish_at.required_if' => 'Publishing date is required if you want to schedule post release.',
        ];
    }
}
