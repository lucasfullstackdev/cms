<?php

namespace App\Domains\Common\Posts\Requests;

use App\Domains\BaseRequest;
use App\Models\Tag;
use App\Rules\ExistsNotSoftDeleted;

final class UpdateStatus extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => 'integer|exists:post_statuses,id',
        ];
    }
}
