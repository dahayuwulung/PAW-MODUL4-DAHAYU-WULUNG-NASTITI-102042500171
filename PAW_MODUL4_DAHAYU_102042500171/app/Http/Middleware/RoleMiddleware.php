<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar bisa menggunakan Auth

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Logika Pengecekan Role (Sesuai Modul 4)
        // Jika user belum login ATAU role user tidak sesuai dengan parameter yang diminta
        if (!Auth::check() || Auth::user()->role !== $role) {
            
            // UBAH BAGIAN INI: Dari abort(403) menjadi redirect dengan flash message
            // Agar tampilannya seperti pop-up merah di modul
            return redirect()->route('home')->with('error', 'Akses ditolak, Anda tidak memiliki izin untuk mengakses halaman tersebut.');
            
        }

        // Jika lolos pengecekan, izinkan request berlanjut ke controller
        return $next($request);
    }
}