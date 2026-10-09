<?php
/**
* QuestionStoreRequest.php - Form request for admin question create/update
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Requests;

use App\Yantrana\Base\BaseRequest;

class QuestionStoreRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question_text' => 'required|string|min:3',
            'category_tag'  => 'nullable|string|max:40',
            'status'        => 'nullable|integer|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'question_text.required' => __tr('Question text is required.'),
            'question_text.min'      => __tr('Question needs to be at least 3 characters.'),
            'category_tag.max'       => __tr('Category tag must not exceed 40 characters.'),
        ];
    }
}
