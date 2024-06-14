<?php

namespace App\Domains\Common\Posts\Requests;

use App\Domains\BaseRequest;
use App\Models\Tag;
use App\Rules\ExistsNotSoftDeleted;

final class UpdateTags extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tags' => 'nullable|array',
            'tags.*' => ['integer', new ExistsNotSoftDeleted(Tag::class)],
        ];
    }
}
