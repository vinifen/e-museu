<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLock;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Models\User;
use App\Models\Lock;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $count = User::count();

        if ($request->search_column && $request->search)
            $query->where($request->search_column, 'LIKE', "%{$request->search}%");

        if ($request->sort && $request->order) {
            if ($request->order == 'asc')
                $query->orderBy($request->sort, 'desc');
            else
                $query->orderBy($request->sort, 'asc');
        }

        $users = $query->paginate(50)->withQueryString();;

        return view('admin.users.index', compact('users', 'count'));
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return redirect()->route('admin.users.show', $user)->with('success', 'Administrador adicionado com sucesso.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Administrador excluído com sucesso.');
    }

    public function destroyLock($id)
    {
        $lock = Lock::where('user_id', $id)->first();

        if ($lock) {
            $lock->delete();
            return redirect()->route('admin.users.index')->with('success', 'Tranca de edição relacionada ao administrador removida com sucesso.');
        }


        return back()->withErrors(['Nenhuma tranca está associada a este administrador.']);
    }
}
