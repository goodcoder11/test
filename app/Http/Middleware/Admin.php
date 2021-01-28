<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * Admin constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->guard(null);

        if ($user->check() && $this->userService->hasRole($user->id(), 'admin')) {
            if (!$request->is('admin', 'admin/*')) {
                return redirect()->to('admin');
            }

            return $next($request);
        }

        if ($request->is('admin', 'admin/*')) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
