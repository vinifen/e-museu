<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Lock;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function lock($subject)
    {
        $lock = Lock::findByModel($subject);

        if (!$lock) {
            $lock = new Lock([
                'user_id' => Auth::id(),
                'expiry_date' => Carbon::now()->addHours(1)]);

            Lock::where('user_id', Auth::id())->delete();
            $subject->locks()->save($lock);
        }

        return $lock;
    }

    public static function unlock($subject)
    {
        $lock = Lock::findByModel($subject);

        if ($lock) {
            $lock->delete();
            return true;
        }

        return false;
    }
}
