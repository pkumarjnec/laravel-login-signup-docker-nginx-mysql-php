<?php

namespace App\Http\Middleware;

use App\Model\Account;
use Closure;
use Illuminate\Support\Facades\Lang;

class ApiHeader
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        $token         = $request->bearerToken();
        $account        = Account::search(array('access_token'=>$token));
        if(empty($account) || $account->id == ''){
            return response('Unauthorized.', 401);
        }
        $request->attributes->add(['account_id' => $account->id]);
        return $next($request);
    }
}
