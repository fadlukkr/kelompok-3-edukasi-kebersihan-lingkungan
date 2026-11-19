<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = base64_encode(random_bytes(16));
        view()->share('cspNonce', $nonce);

        $response = $next($request);

        // 1. Anti-Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. Cegah MIME Sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. Referrer Policy, XSS Protection & Permissions Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // 4. Content Security Policy (CSP) - Standar OWASP: Bebas Wildcard, Bebas unsafe-eval, Bebas unsafe-inline
        $csp = "default-src 'self'; " .
               "base-uri 'self'; " .
               "form-action 'self'; " .
               "frame-ancestors 'self'; " .
               "object-src 'none'; " .
               "script-src 'self' 'nonce-{$nonce}'; " .
               "style-src 'self' 'nonce-{$nonce}'; " .
               "img-src 'self' data:; " .
               "font-src 'self' data:; " .
               "connect-src 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // 5. Hapus header informasi teknologi server
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
            header_remove('Server');
        }

        // 6. Atasi "Cookie No HttpOnly Flag" (Paksa semua cookie, termasuk XSRF-TOKEN, memiliki flag HttpOnly)
        foreach ($response->headers->getCookies() as $cookie) {
            $response->headers->setCookie($cookie->withHttpOnly(true));
        }

        // 7. Atasi "Big Redirect Detected" (Kosongkan body response jika terjadi HTTP Redirect 301/302)
        if ($response->isRedirection() && ! ($response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse)) {
            $response->setContent('');
        }

        // 8. Cegah browser menyimpan cache halaman di riwayat (Wajib validasi login saat buka link kembali / tombol Back)
        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');

        return $response;
    }
}