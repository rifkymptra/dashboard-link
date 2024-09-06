<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Masoudi\Laravel\Visitors\Models\Visitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Mendapatkan IP pengunjung dan user agent
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $referer = $request->header('referer');

        // Mencatat pengunjung jika belum ada catatan untuk hari ini
        $today = now()->toDateString();
        $visitor = Visitor::whereDate('created_at', $today)
            ->where('ip', $ip)
            ->first();

        if (!$visitor) {
            Visitor::create([
                'ip' => $ip,
                'user_agent' => $userAgent,
                'referer' => $referer,
            ]);
        }

        return $next($request);
    }
}
