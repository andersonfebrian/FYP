<?php

namespace App\Http\Controllers\Browser\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BiosecureController extends Controller
{
	public function storeFrame(Request $request) {
		//logger($request);
		$request->validate([
			'base64_str' => 'required|string'
		]);
		$user = strtolower($request->user['first_name'].'_'.strtolower($request->user['last_name'].'_'.$request->email));
		base64_to_image($request->base64_str, $user);

		return response()->json(['message' => 'Captured Success.'], 200);
	}

	public function initScript(Request $request) {
		logger($request);

		$user = strtolower($request->user['first_name'].'_'.strtolower($request->user['last_name'].'_'.$request->email));
		$process = new Process([env('PYTHON_DIR'), base_path('py_scripts\\biosecure.py'), $request->from, base_path(), storage_path('app\\biosecure\\'.$user)]);
		$process->setTimeout(120);
		$process->run();

		if(!$process->isSuccessful()) {
			throw new ProcessFailedException($process);
			return response()->json(['message' => 'Something went wrong on our end. Please try again later.'], 500);
		}

		// //logger($process->getOutput());

		$data = $process->getOutput();
		$data = json_decode($data, true);

		if($data['status'] == 201 && $request->from == "register") {
			$this->register($request->user, $request->email);
		}
		
		return response()->json($data, $data['status']);
	}

	private function register($user, $email) {
		$user = User::create([
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $email,
			'password' => Hash::make($user['password']),
			'biosecure_enabled' => true
		]);
	}
}
