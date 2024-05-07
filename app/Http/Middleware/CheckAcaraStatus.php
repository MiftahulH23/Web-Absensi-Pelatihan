<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Acara;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAcaraStatus
{
    public function handle($request, Closure $next)
    {
        $acaraId = $request->route('id');
        $acara = Acara::find($acaraId);

        // Jika acara tidak ditemukan atau statusnya 'off'
        if (!$acara || $acara->status === 'off') {
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
