<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Lock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CheckLock
{
    public function handle($request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        $modelName = $this->getModelClassFromRouteName($routeName);

        if (!$modelName) {
            abort(400, 'Rota ou modelo inválido');
        }

        $subjectId = $request->route($modelName[0]);

        $lock = Lock::where('lockable_type', $modelName[1])
                    ->where('lockable_id', $subjectId)
                    ->first();

        if ($lock && $lock->expiresAt() && $lock->user_id != Auth::id()) {
            return back()->withErrors(['Não é possível fazer alterações enquanto outro administrador estiver editando o mesmo.']);
        }

        return $next($request);
    }

    private function getModelClassFromRouteName($routeName)
    {
        $routeToModel = [
            'admin.items' => ['item', 'App\Models\Item'],
            'admin.tags' => ['tag', 'App\Models\Tag'],
            'admin.contributions' => ['contribution', 'App\Models\Contribution'],
            'admin.categories' => ['category', 'App\Models\Category'],
            'admin.proprietaries' => ['proprietary', 'App\Models\Proprietary'],
            'admin.extras' => ['extra', 'App\Models\Extra'],
            'admin.sections' => ['section', 'App\Models\Section'],
        ];

        foreach ($routeToModel as $routePrefix => $modelClass) {
            if (Str::startsWith($routeName, $routePrefix)) {
                return $modelClass;
            }
        }

        return null;
    }
}
