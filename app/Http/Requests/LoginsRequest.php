<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidacionFactory;

class LoginsRequest extends FormRequest
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
            'email'=>'required',
            'password' => 'required'
        ];
    }

    public function getCredentials()
    {
        $usename = $this->get('email');

        if($this->isEmail(($usename)))
        {
            return ['email'=>$usename,$this->get('password')];
        }
        return $this->only('email','password');
    }

    public function isEmail($value)
    {
        $factory = $this->container->make(ValidacionFactory::class);
        return !$factory->make(['email'=>$value],['email'=>'email'])->fails();
    }
}
