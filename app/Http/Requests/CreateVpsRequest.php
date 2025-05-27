<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'package_id' => 'required|integer|exists:vps_packages,id',
            'name' => 'required|string|max:255',
            'cpu' => 'required|integer|min:1|max:16',
            'ram' => 'required|integer|min:512|max:32768',
            'storage' => 'required|integer|min:10|max:1000',
        ];
    }
}
