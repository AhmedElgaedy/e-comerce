<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class checkCode extends BaseApiRequest
{
    public function __construct(Request $request) {
        $request['phone']        = fixPhone($request['phone']);
        $request['country_code'] = 20;
    }

    public function rules() {
        return [
            'code'         => 'required|max:10',
            'phone'        => 'required|exists:users,phone',
        ];
    }
}
