<?php

    namespace App\Http\Requests;

    use Illuminate\Contracts\Validation\Validator;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Http\Exceptions\HttpResponseException;
    
    /**
     * 
     * 因為原始的 FormRequest 經過 validated 後如果錯誤會返回上一頁
     * 所以要再寫此程式來覆寫 FormRequest 裡 "會返回上一頁" 的部分
     * 
     */
    

    class APIRequest extends FormRequest
    {
        protected function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(response(['errors' => $validator->errors()],400));
        }
    }