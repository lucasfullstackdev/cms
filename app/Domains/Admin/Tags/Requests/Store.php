<?php

namespace App\Domains\Admin\Tags\Requests;

use App\Domains\Admin\AdminRequest;

class Store extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name',
            'active' => 'required|boolean',
        ];
    }
}
