<?php
namespace App\Http\Middleware;

use Closure;
use Session;

class IsSufficientPermissionMiddleware
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
    if(sufficient_permission_check()){
			return $next($request);
		}
    
    return response(view('admin::pages_message.no_permission'));
  }
}