<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GangaRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'url' => 'required|url',
            'category_id' => 'required',
            'price' => 'required|min:1',
            'price_sale' => 'required|min:1',
            'image' => 'required|image|mimes:jpg,jpeg',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'El títol és obligatori',
            'title.min' => 'El títol ha de tindre al menys 5 lletres',
            'description.required' => 'La descripció és obligatoria',
            'description.min' => 'La descripció ha de tindre al menys 10 lletres',
            'url.required' => 'La ulr és obligatoria',
            'url.url' => 'Format incorrecte de url',
            'category.required' => 'Has de triar una categorias',
            'price.required' => 'El preu és obligatori',
            'price.min' => 'El preu mínim és 1',
            'price_sale.required' => 'El preu de ganga és obligatori',
            'price_sale.min' => 'El preu de ganga mínim és 1',
            'image.required' => 'Has de muntar una imatge',
            'image.image' => 'Arxiu de tipus erròni',
            'image.mimes' => 'El format de la imatge ha de ser jpq o pgej'
        ];
    }
}
