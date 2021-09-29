<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test(Request $request)
    {
        logger($request->hasFile('file'));

        $path = storage_path('app/tmp');

        if(!file_exists($path)){
            mkdir($path, 0777, true);
            $file = fopen($path . '/.gitignore', 'w');
            fwrite($file, '*'.PHP_EOL.'!.gitignore');
            fclose($file);
        }

        $file = $request->file('file');

        $file_name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $file_name);

        return response()->json([
            'name' => $file_name,
            'original_name' => $file->getClientOriginalName()
        ]);
    }

    public function removetemp(Request $request) {
        $path = storage_path('app/tmp');

        $result = unlink($path . '/' . $request->file);

        return response()->json([
            'message' => $result ? 'Success' : 'Error'
        ], $result ? 200 : 500);
    }
}
