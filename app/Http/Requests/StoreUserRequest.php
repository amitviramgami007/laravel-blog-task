<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8|max:40|same:confirm-password',
                    'role' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,'.$this->segment(2),
                    'password' => 'nullable|same:confirm-password|min:8|max:40',
                    'role' => 'required',
                ];
            }
            default: break;
        }
    }
}
