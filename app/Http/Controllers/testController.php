<?php

namespace App\Http\Controllers;

use App\Models\DataSaved;
use Carbon\Carbon;
use Illuminate\Http\Request;

class testController extends Controller
{
    function test(Request $request)
    {
        if ($request->file('photo_url')) {
            $image = $request->file('photo_url');
            if ($image != null) {
                $finalImage = Imgur::upload($image);
                $finalImageLink = $finalImage->link();
            }
        } else {
            $finalImageLink = 'https://i.imgur.com/zCL2LAh.png';
        }

        return $finalImageLink;
    }

    public function callBack(Request $request){
        $input = json_encode($request->all());
        $input['create_at'] = Carbon::now()->toString();

        DataSaved::create([
            "received_data"=> $input
        ]);
    }
}
