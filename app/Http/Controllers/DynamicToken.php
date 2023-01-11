<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DynamicToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $referer = request()->headers->get('referer');
        $contains = str_contains($referer, request()->getHttpHost());
        if (empty($referer) || !$contains) {
            abort(404);
        }

        return response()->json([
            'csrf_token' => csrf_token()
        ]);
    }
}
