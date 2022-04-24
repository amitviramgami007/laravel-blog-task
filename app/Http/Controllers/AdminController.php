<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = getTotalCount('User');
        $postCount = getTotalCount('Post');
        $userWiesPostCount = auth()->user()->posts()->count();
        $categoryCount = getTotalCount('Category');
        return view('admin.dashboard', compact('userCount', 'postCount', 'userWiesPostCount', 'categoryCount'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateAvatar(Request $request)
    {
        $this->validate($request, ['avatar_image' => 'image|mimes:png,jpg,jpeg']);

        if ($request->hasFile('avatar_image'))
        {
            User::updateAvatar($request->avatar_image);
        }

        Session::flash('statusCode', 'success');
        return redirect()->route('profile')->with('status', 'Avatar Updated Successfully');
    }

    public function updateProfileInfo(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        else
        {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if(!$query)
            {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            }
            else
            {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been update successfuly.']);
            }
        }
    }

    function changePassword(Request $request)
    {
        //Validate form
        $validator = Validator::make($request->all(),
        [
            'oldpassword'=>
            [
                'required', function($attribute, $value, $fail)
                {
                    if( !Hash::check($value, Auth::user()->password) )
                    {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword'=>'required|min:8|max:30',
            'cnewpassword'=>'required|same:newpassword'
        ],
        [
            'oldpassword.required'=>'Enter your current password',
            'oldpassword.min'=>'Old password must have atleast 8 characters',
            'oldpassword.max'=>'Old password must not be greater than 30 characters',
            'newpassword.required'=>'Enter new password',
            'newpassword.min'=>'New password must have atleast 8 characters',
            'newpassword.max'=>'New password must not be greater than 30 characters',
            'cnewpassword.required'=>'ReEnter your new password',
            'cnewpassword.same'=>'New password and Confirm new password must match'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        else
        {
            $update = User::find(Auth::user()->id)->update(['password' => Hash::make($request->newpassword)]);

            if( !$update )
            {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            }
            else
            {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }
}
