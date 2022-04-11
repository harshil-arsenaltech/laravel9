<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

trait ValidationTrait
{
    public function validateRequest($fields, $request)
    {
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
