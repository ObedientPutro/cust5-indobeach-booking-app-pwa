<?php

namespace App\Http\Requests\Post;

use App\Enums\PostStatus;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique(Post::class, 'title')],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'quantity' => ['required', 'numeric', 'min:1'],
            'status' => ['required', new Enum(PostStatus::class)],
            'selected_amenities' => ['required', 'array', 'min:1'],
            'selected_amenities.*' => ['required', Rule::exists(Amenity::class, 'id')],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'selected_amenities.required' => 'Please select at least one amenities.',
            'images.required' => 'Please upload at least one image.',
            'images.*.image' => 'Only image files are allowed.',
        ];
    }
}
