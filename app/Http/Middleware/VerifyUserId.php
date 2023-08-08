<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Order\Models\Order;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            $userId = auth()->user()->id;
            $routeId = $request->id;
            $orderedProducts =  Order::where('user_id', $userId)->get();

            if($userId != $routeId){
                return redirect()->route('frontend.user.orders', $userId);
            }
        }
        return $next($request);
    }
}
