<?php

namespace App\Service;

use Illuminate\Http\Request;
use Imgur;

trait ImgurHelpers
{
    public function upload(Request $request, $key)
    {
        if ($request->file($key)) {
            $image = $request->file($key);
            if ($image != null) {
                $finalImage = Imgur::upload($image);
                $finalImageLink = $finalImage->link();
            }
        } else {
            $finalImageLink = 'https://i.imgur.com/zCL2LAh.png';
        }

        return $finalImageLink;
    }
}
