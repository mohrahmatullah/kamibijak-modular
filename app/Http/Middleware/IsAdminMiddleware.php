<?php
namespace App\Http\Middleware;

use Closure;
use Session;

class IsAdminMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Session::has('kamibijak_admin')){
			return $next($request);
		}
    
		return redirect()->route('admin.login');
  }
}