<?php

namespace App\Http\Middleware\Browser;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasStore
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		$response = $next($request);
		return $response;
	}
}
