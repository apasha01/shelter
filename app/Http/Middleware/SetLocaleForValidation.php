<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Factory as ValidationFactory;

class SetLocaleForValidation
{
    public function handle(Request $request, Closure $next)
    {
        // Set custom validation messages for this request
        $messages = [
            'required' => 'فیلد :attribute الزامی است.',
            'email' => ':attribute باید یک ایمیل معتبر باشد.',
            'unique' => ':attribute قبلاً استفاده شده است.',
            'numeric' => ':attribute باید یک عدد باشد.',
            'string' => ':attribute باید یک متن باشد.',
            'max' => ':attribute نمی‌تواند بیشتر از :max کاراکتر باشد.',
            'min' => ':attribute باید حداقل :min کاراکتر داشته باشد.',
        ];

        Validator::replacer('required', function ($message, $attribute, $rule, $parameters) {
            $attr = __('validation.attributes.' . $attribute, ['attribute' => $attribute]);
            return 'فیلد ' . $attr . ' الزامی است.';
        });

        Validator::replacer('email', function ($message, $attribute, $rule, $parameters) {
            $attr = __('validation.attributes.' . $attribute, ['attribute' => $attribute]);
            return $attr . ' باید یک ایمیل معتبر باشد.';
        });

        return $next($request);
    }
}
