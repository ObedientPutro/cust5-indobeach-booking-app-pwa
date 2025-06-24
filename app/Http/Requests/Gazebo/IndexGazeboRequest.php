<?php

namespace App\Http\Requests\Gazebo;

use App\Models\Amenity;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexGazeboRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', Rule::exists(Category::class, 'id')],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['integer', Rule::exists(Amenity::class, 'id')],
        ];
    }
}
