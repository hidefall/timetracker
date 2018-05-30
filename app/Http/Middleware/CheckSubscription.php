<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubscription
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
        if(auth()->user()->role == 'company') {
            $user = auth()->user()->asStripeCustomer();
            if ($user && count($user->subscriptions->data)) {
                $subscription = $user->subscriptions->data[0];
                if ($subscription) {
                    $period_end = $subscription->current_period_end;
                    $canceled = $subscription->canceled_at;
                    $ended = $subscription->ended_at;
                    if (time() > $period_end || $canceled || $ended) {
                        return redirect('/payment');
                    }
                } else {
                    return redirect('/payment');
                }
            } else {
                return redirect('/payment');
            }
        }
        return $next($request);
    }
}
