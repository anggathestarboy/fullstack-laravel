<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book_name' => 'required|string|max:255',
            'book_isbn' => 'required|string|unique:books,book_isbn',
            'book_img' => 'required|string',
            'book_author_id' => 'required|exists:authors,author_id',
            'book_category_id' => 'required|exists:categories,category_id',
            'book_publisher_id' => 'required|exists:publishers,publisher_id',
            'book_shelf_id' => 'required|exists:shelfs,shelf_id',
            'book_stock' => 'required',
            'book_description' => 'required',
        ];
    }
}
