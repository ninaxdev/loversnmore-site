<?php
/**
* DeckStoreRequest.php - Form request for admin deck create/update
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Requests;

use App\Yantrana\Base\BaseRequest;
use App\Yantrana\Components\Icebreaker\Models\CardDeck;

class DeckStoreRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|string|max:100',
            'slug'        => 'nullable|string|max:120|regex:/^[a-z0-9\-]+$/',
            'caption'     => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:50',
            'variant'     => 'required|in:' . CardDeck::VARIANT_SOLID . ',' . CardDeck::VARIANT_SOFT,
            'vibe_label'  => 'nullable|string|max:40',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status'      => 'nullable',
            'sort_order'  => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => __tr('Deck name is required.'),
            'name.max'          => __tr('Deck name must not exceed 100 characters.'),
            'slug.regex'        => __tr('Slug can only contain lowercase letters, numbers, and dashes.'),
            'category.required' => __tr('Please pick a category for this deck.'),
            'variant.in'        => __tr('Cover variant must be Solid or Soft.'),
            'cover_image.image' => __tr('Cover must be an image file.'),
            'cover_image.mimes' => __tr('Cover must be a JPG, PNG, or WebP.'),
            'cover_image.max'   => __tr('Cover image must be under 4MB.'),
        ];
    }
}
