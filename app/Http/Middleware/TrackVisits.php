<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request and record simple visit metrics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET HTML requests (avoid assets, API, console, etc.)
        if ($request->isMethod('GET') && $request->acceptsHtml()) {
            $path = $request->path();

            // Skip common asset routes
            if (str_starts_with($path, 'build') || str_starts_with($path, 'assets') || $request->is('favicon.ico')) {
                return $response;
            }

            try {
                Visit::create([
                    'path' => '/' . ltrim($path, '/'),
                    'ip' => $request->ip(),
                    'user_agent' => substr($request->userAgent() ?? '', 0, 1000),
                    'user_id' => $request->user()?->id,
                ]);
            } catch (\Throwable $e) {
                // Swallow exceptions to avoid breaking requests
            }
        }

        return $response;
    }
}
