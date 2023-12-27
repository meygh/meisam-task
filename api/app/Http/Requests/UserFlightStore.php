<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFlightStore extends FormRequest
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
//            'user_id' => ['bail', 'required', 'int', 'exists:users,id'],
            'flights' => ['bail', 'required', 'array'],
            'flights.*' => ['bail', 'required_with:flights', 'required', 'array'],
            'flights.*.0' => ['required_with:flights', 'required', 'string', 'min:3', 'max:4'],
            'flights.*.1' => ['required_with:flights', 'required', 'string', 'min:3', 'max:4'],
        ];
    }

    public function messages()
    {
        return [
//            'user_id' => 'کد کاربر نامعتبر است',
            'flights.required' => 'حداقل یک آرایه شامل کد شهر مبدا و مقصد الزامی است',
            'flights.array' => 'یک یا چند پرواز را به صورت آرایه ای از آرایه پرواز دو مولفه ای ارسال کنید. مثال [["ATL", "EWR"]]',
            'flights.*' => 'هر پرواز باید به صورت آرایه دو مولفه نظیر ["ATL", "EWR"] باشد',

            'flights.*.0' => 'کد فرودگاه مبدا نامعتبر است',

            'flights.*.1.required' => 'کد فرودگاه مقصد به عنوان پارامتر دوم الزامی است',
            'flights.*.1' => 'کد فرودگاه مقصد نامعتبر است',
        ];
    }
}
