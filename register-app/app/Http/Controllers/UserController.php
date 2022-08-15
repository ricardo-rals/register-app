<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index() {

        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request) {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $data['image'] = $request->image->store('users');
        //$extension = $request->image->getClientOriginalExtension();
        //$data['image'] = $request->image->storeAs('users', now() . ".{$extension}");

        $this->model->create($data)->givePermissionTo('user');

        return redirect()->route('users.index');
    }
}
