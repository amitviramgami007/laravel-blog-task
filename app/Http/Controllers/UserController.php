<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);
        $createRoute = 'users.create';

        if ($request->ajax())
        {
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addColumn('role', function ($data)
                {
                    return '<label class="badge badge-success">'.$data->role.'</label>';
                })
                ->addColumn('created_by', function ($data)
                {
                    return getUserName($data->created_by);
                })
                ->addColumn('updated_by', function ($data)
                {
                    return getUserName($data->updated_by);
                })
                ->addColumn('action', function($data)
                {
                    return (string) view('users.action', ['data' => $data]);
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        return view('users.index', compact('createRoute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = config('dom.roles');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);

        Session::flash('statusCode', 'success');
        return redirect()->route('users.index')->with('status', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = config('dom.roles');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $input = $request->all();

        if(!empty($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            $input = Arr::except($input, ['password']);
        }

        $user->update($input);

        Session::flash('statusCode', 'success');
        return redirect()->route('users.index')->with('status', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        Session::flash('statusCode', 'success');
        return redirect()->route('users.index')->with('status', 'User Deleted Successfully');
    }

    public function sendWelcomeEmail(Request $request)
    {
        $input = $request->all();
        $user = User::where('email', $input['email'])->get();
        Notification::send($user, new WelcomeNotification);
        return response()->json(['success' => 'Welcome Mail Sent Successfully.']);
    }
}
