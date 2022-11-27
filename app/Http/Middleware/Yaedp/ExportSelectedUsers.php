<?php

namespace App\Http\Middleware\Yaedp;

use App\Services\Learning\Account\YaedpAccountService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportSelectedUsers
{
    protected YaedpAccountService $yaedpUser;
    public function __construct(YaedpAccountService $yaedpUser)
    {
        $this->yaedpUser = $yaedpUser;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->yaedpUser->yaedpSelectedUser(Auth::user()->email)) {
            return redirect()->route('yaedp.account.unauthorized');
        }
        return $next($request);
    }
}
