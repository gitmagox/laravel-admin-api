<?php

namespace Magox\Admin\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        if (config('admin.operation_log') && Auth::guard('admin')->user()) {
            $log = [
                'user_id' => Auth::guard('admin')->user()->id,
                'path'    => $request->path(),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($request->input()),
            ];

            \Magox\Admin\Auth\Database\OperationLog::create($log);
        }

        return $next($request);
    }
}
