<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $users = $this->model->getUsers(search: $request->get('search', ''));
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        $data['image'] = $request->image->store('users');
        //$extension = $request->image->getClientOriginalExtension();
        //$data['image'] = $request->image->storeAs('users', now() . ".{$extension}");

        $data['age'] = Carbon::parse($data['birth_date'])->age;


        $this->model->create($data)->givePermissionTo('user');

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');

        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');

        $data = $request->only('name', 'email', 'birth_date');

        if ($request->password)
            $data['password'] = bcrypt($request->password);


        if ($request->image) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $data['image'] = $request->image->store('users');
        }

        if ($request->birth_date) {
            $data['age'] = Carbon::parse($data['birth_date'])->age;
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {

        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');

        $user->delete();
        return redirect()->route('users.index');
    }

    public function show($id)
    {

        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');

        return view('users.show', compact('user'));
    }
}
