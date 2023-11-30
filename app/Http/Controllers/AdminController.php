<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orwhere('name','like','%'.request('key').'%')
                  ->orwhere('phone','like','%'.request('key').'%')
                  ->orwhere('email','like','%'.request('key').'%')
                  ->orwhere('address','like','%'.request('key').'%');
        })
        ->paginate(3);

        $admin->appends(request()->all());

        return view('admin.account.list',compact('admin'));
    }
    //change password page
    public function changePasswordPage(){
        return view('admin.account.password');
    }

    public function delete($id){

        User::where('id',$id)->delete();

        return redirect()->route('admin#list')->with(['info'=>'Account deleted ...']);
    }

    public function message(){
        $data = Content::orderBy('created_at','desc')->get();

        return view('admin.message.message',compact('data'));
    }

    public function roleChange($id){
        $admin = User::where('id',$id)->first();
        return view('admin.account.role',compact('admin'));
    }

    public function changed($id,Request $request){
        $data = $this->getRoleData($request);

        User::where('id',$id)->update($data);

        return redirect()->route('admin#list')->with(['info' => 'Role updated...']);
    }

    private function getRoleData($request){
        return [
            'role' => $request->admin_role
        ];
    }

    public function changePassword(Request $request){
        $this-> PasswordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbPassword)){

            $data = ['password' => Hash::make($request->newPassword)];

            User::where('id',Auth::user()->id)->update($data);


            return back()->with(['detail' => 'Change Password Success...']);

        }
        return back()->with(['detail'=> 'The old Password do not match.Try again!']);
    }

    public function editProfile(){
        return view('admin.account.edit');
    }

    public function changeDetail(){
        return view('admin.account.details');
    }

    private function PasswordValidationCheck($request){
        validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    public function update($id,Request $request){
        $this->AccountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            };
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#detail')->with(['info' => 'Profile Updated...' ]);
    }

    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    private function AccountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }
}
