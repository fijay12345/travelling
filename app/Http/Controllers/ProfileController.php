<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   
    public function index()
    {
        $user = \Auth::user();
       return view('profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function update(Request $request)
    {
    

        $this->validate($request, [
            'avatar' => ['file', 'image', 'mimes:jpeg'],
            'name' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        $user =\Auth::user();
        if ($request ->has('avatar')) {

        
        $avatar = $request->avatar;
        $oldFile = $user->avatar;
        $fileName = time() . md5($avatar->getClientOriginalName()) . '.' . $avatar->extension();
        $avatar->storeAs('public/assets/images', $fileName);
        if ($oldFile !== 'user.jpg') {
            unlink(storage_path('app/public/assets/images/' . $oldFile));
        }
        $user->avatar =$fileName;
        }
        $user->name =$request->get('name');
        $user->alamat =$request->get('alamat');
        $result =$user->save();

        if ($result) {

            session()->flash('status', 'Berhasil update profile');
            session()->flash('status-type', 'Berhasil ');
        }else     {
            session()->flash('status', 'gagal update profile');
            session()->flash('status-type', 'gagal');

        }
        
        return redirect()->route('profile');
    }
    public function changePassword()
    {
        $user = \Auth::user();
        return view('change-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'old_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->password)) {
                    $fail('Password doesn\'t match to our record');
                }
            }],
            'new_password' => ['required', 'string', 'min:6', 'confirmed']
        ]);
        if ($request->old_password === $request->new_password) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'new_password' => 'New password can\'t be same with old password'
                ]);
        }
        $user->password = Hash::make($request->new_password);
        if ($user->save()) {
            session()->flash('status', 'Password successfully changed.');
            session()->flash('status-type', 'success');
        } else {
            session()->flash('status', 'Something was wrong, please try again later.');
            session()->flash('status-type', 'danger');
        }
        return redirect()->route('change-password');
    }
}