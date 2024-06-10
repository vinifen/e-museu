<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Item;

class ValidateItem
{
    public function handle($request, Closure $next)
    {
        $itemId = $request->route('id');

        if ($itemId) {
            $item = Item::find($itemId);

            if ($item && $item->validation == false)
                abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
