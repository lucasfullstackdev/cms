<?php

namespace App\Domains\Admin\Posts\Status\Requests;

use App\Domains\Admin\AdminRequest;

final class Store extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:post_statuses,name',
        ];
    }
}
