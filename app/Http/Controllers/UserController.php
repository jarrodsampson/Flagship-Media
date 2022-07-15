<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if using permissions
        $roles = Role::all();
        return view('users.create', compact('roles'));
        // no permissions
        //return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validator($request->all())->validate();
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['api_token'] = Str::random(60);

        $user = User::create($validatedData);
        //$profile = UsersProfile::create(['user_id' => $user->id]);
        //$settings = UsersSetting::create(['user_id' => $user->id]);

        // if using permissions
        // assign user a role
        $user->assignRole($request->role);

        // if using activity logging
        $this->activityLogger('Created New User: ' . $user->email);
        $this->activityLogger('Assigned user ' . $user->email . ' a role: ' . $request->role);

        // send verify email
        $user->sendEmailVerificationNotification();
   
        return redirect('/dashboard/user')->with('success', 'User Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if using permissions
        $user = User::findOrFail($id);
        $roles = Role::all();
        // get user roles 
        $userRoles = $user->getRoleNames();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
        // no permissions
        //return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'is_active' => ['required'],
        ]);

        $userAuth = auth()->user();
        $user = User::findOrFail($id);

        // if admin user
        if ($user->id === 1) {
            if ($request->input('is_active')[0] != $user->is_active) { 
                return back()->with('error', 'Admin roles and status cannot be changed.');
            }
        }

        // if this is you
        if ($userAuth->id === $user->id) {
            /*if ($request->role !== $user->getRoleNames()[0]) { 
                return back()->with('error', 'You cannot update your own roles and permissions.');
            }*/

            if ($request->input('is_active')[0] != $user->is_active) { 
                return back()->with('error', 'You cannot change your own status, please contact administrator.');
            }
        } 

        $user->update($validatedData);

        // remove all user permissions
        //$user->syncRoles([]);
        // assign user a role
        $user->assignRole($request->role);

        // if using activity logging
        $this->activityLogger('Updated User: '. $user->email);
       
        return redirect('/dashboard/user')->with('success', 'User Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $userAuth = auth()->user();
        $user = User::findOrFail($userId);
        if ($userAuth->id === $user->id) {
            return redirect('/dashboard/user')->with('error', 'You cannot delete yourself.');
        } 

        if ($user->id === 1) {
            return redirect('/dashboard/user')->with('error', 'You cannot delete the main admin user.');
        } 
 
        $user->delete();
        //DB::table('users_profiles')->where('user_id', $userId)->delete();
        //DB::table('users_settings')->where('user_id', $userId)->delete();

        // if using activity logging
        $this->activityLogger('Deleted User: ' . $user->email);
        return redirect('/dashboard/user')->with('success', $user->name . ' was removed.');
    }

    public function changePassword()
    {
        $user = auth()->user();
        return view('users.password', compact('user'));
    }

    public function changePasswordStore(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'max:255'],
        ]);

        $userAuth = auth()->user();

        if (Hash::check($validatedData['old_password'], $userAuth->password)) {
            User::whereId($userAuth->id)->update(['password' => Hash::make($validatedData['password'])]);
            // send password reset notification
            $mailData = [
                'title' => 'Your Password Has Been Changed',
                'body' => 'This is for testing email using smtp.'
            ];
            var_dump($userAuth->email);
            Mail::to($userAuth->email)->send(new SendMailable($mailData));

            return redirect('/dashboard/user')->with('success', 'Password successfully changed. You will need your changed password when you log in next time.');
        } else {
            return back()->with('error', 'Your existing password did not match what you entered.');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function activityLogger(string $text)
    {
        return activity()->log($text);
    }
}
