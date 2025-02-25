<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncerementBalanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            $this->handleBalance($user);
        }

        return $next($request);
    }

    private function handleBalance($user): void
    {
        $today = Carbon::today();

        $income = Transaction::where('user_id', $user->id)->where('type', 'income')->get();

        foreach ($income as $i) {
            $dateReceived = Carbon::parse($i->created_at);
            switch ($i->frequency) {
                case 'daily':
                    if ($dateReceived->isBefore($today)) {
                        $diff = $dateReceived->diffInDays($today);
                        if ($diff > 0) {
                            $user->balance += $i->amount * $diff;
                            $i->date_received = $today;
                            $i->save();
                            $user->save();
                        }
                    }
                    break;
                case 'weekly':
                    if ($dateReceived->isBefore($today)) {
                        $diff = $dateReceived->diffInDays($today);
                        if ($diff > 7) {
                            $user->balance += $i->amount;
                            $i->date_received = $today;
                            $i->save();
                            $user->save();
                        }
                    }
                    break;
                case 'monthly':
                    if ($dateReceived->isBefore($today)) {
                        $diff = $dateReceived->diffInDays($today);
                        if ($diff > 30) {
                            $user->balance += $i->amount;
                            $i->date_received = $today;
                            $i->save();
                            $user->save();
                        }
                    }
                    break;
                case 'yearly':
                    if ($dateReceived->isBefore($today)) {
                        $diff = $dateReceived->diffInDays($today);
                        if ($diff > 365) {
                            $user->balance += $i->amount;
                            $i->date_received = $today;
                            $i->save();
                            $user->save();
                        }
                    }
                    break;
                case 'default':
                    break;
            }


        }

    }
}
