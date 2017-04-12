<?php

namespace App\Http\Controllers;

use Consatan\Weibo\ImageUploader\Client;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return $this->fail($validator->errors()->first());
        }

        $weibo = new Client();
        /** @var UploadedFile $file */
        $file = $request->image;
        try {
            $url = $weibo->upload(fopen($file->getRealPath(), 'r'), config('services.weibo.username'), config('services.weibo.password'));

            return $this->success($url);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function success($url)
    {
        return [
            'status' => 0,
            'message' => 'success',
            'url' => !empty($url) ? $url : '',
        ];
    }

    public function fail($message)
    {
        return [
            'status' => 1,
            'message' => $message,
            'url' => '',
        ];
    }
}
