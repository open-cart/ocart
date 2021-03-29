<?php

namespace Ocart\Core\Http\Controllers;

use Illuminate\Http\Request;
use Ocart\Core\Models\District;

class LocationController extends BaseController
{
    public function getDistrict(Request $request) {

        return response()->json([
            'error' => 0,
            'message' => 'success',
            'data' => District::where('provinceid', $request->get('id', '99999999'))->get(),
        ]);
    }
}