<?php

namespace App\Http\Controllers\Browser\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BiosecureController extends Controller
{
	public function storeFrame(Request $request) {
		$request->validate([
			'base64_str' => 'required|string'
		]);
		$user = strtolower($request->user['first_name'].'_'.strtolower($request->user['last_name'].'_'.$request->email));
		base64_to_image($request->base64_str, $user);

		//0. validate base64 request
		//1. convert base64 to image
		//2. save the image to local storage (storage/app folder)
		//3. pass the image to python script

		//Image currently stored in local project folder (storage/app/biosecure) - not ideal however, for local development and time whatever - future could be moved to storage like s3

		return response()->json(['message' => 'Captured Success.'], 200);
	}

	public function initScript(Request $request) {
		$process = new Process([env('PYTHON_DIR'), base_path('py_scripts/biosecure.py')]);

		$process->run();

		if(!$process->isSuccessful()) {
			throw new ProcessFailedException($process);
		}

		logger($process->getOutput());

		//return response()->json();
	}
}
