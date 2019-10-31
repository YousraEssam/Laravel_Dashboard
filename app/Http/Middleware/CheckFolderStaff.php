<?php

namespace App\Http\Middleware;

use App\Folder;
use Closure;

class CheckFolderStaff
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
        if($request->user()->hasRole('Admin')){
            $folders = Folder::latest();
        }

        return $next($request);
    }
}
