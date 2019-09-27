<?php

namespace Railroad\Maropost\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Railroad\Maropost\ValueObjects\ContactVO;

/**
 * Class SyncContactRequest
 *
 * @package Railroad\Maropost\Requests
 */
class SyncContactRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
        ];
    }

    /**
     * @return ContactVO
     */
    public function toContactVO()
    {
        return new ContactVO(
            $this->input('email'),
            $this->input('first_name', null),
            $this->input('last_name', null),
            $this->input('custom_fields', []),
            $this->input('tag_names_to_add', []),
            $this->input('tag_names_to_remove', []),
            $this->input('list_ids_to_subscribe_to', []),
            $this->input('list_ids_to_unsubscribe_from', [])
        );
    }

    /**
     * @param  Validator  $validator
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->isJson()) {
            $errors = [];

            foreach (
                $validator->errors()
                    ->getMessages() as $key => $value
            ) {
                $errors[] = [
                    "title" => 'Validation failed.',
                    "source" => $key,
                    "detail" => $value[0],
                ];
            }

            throw new HttpResponseException(
                response()->json(['errors' => $errors], 422)
            );
        }

        throw (new ValidationException($validator))->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}