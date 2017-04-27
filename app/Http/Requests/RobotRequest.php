<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RobotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // mettre l'autorisation à true sinon on ne peut pas passer
        // nous avons deja le login/password qui vérifie les autorisations
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'          => 'required|string|max:100',     //rules
          'tags.*'        => 'integer',                     // On doit recevoir un tableau d'entier
          'category_id'   => 'required|integer',
          'link'          => 'image|max:2048',              // Taille maximale exprimée en kilobtye
          'published_at'  => 'in:on'                        // On vérifie que ce champ correspond à "on"
            
        ];
    }
}
