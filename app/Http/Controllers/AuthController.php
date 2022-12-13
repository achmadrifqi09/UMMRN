<?php

namespace App\Http\Controllers;

use App\Models\Researcher;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signin()
    {
        return view('pages/auth/signin');
    }

    public function signup()
    {
        return view('pages/auth/signup');
    }

    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'student_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email|regex:/(.*)@webmail\.umm\.ac\.id/i|unique:students,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        $validatedData['status'] = 'Non Active';
        $validatedData['role'] = 'Student';
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['otp'] = $this->generateOtp();
        $validatedData['otp_expired'] = Carbon::now()->addMinutes(1);
        
        $data = Student::create($validatedData);

        $mailer = new MailController();
        $mailer->sendEmail($validatedData['email'], $validatedData['otp'], 'Hi '.$validatedData['name']);
    
        return redirect()->route('otp-validation', ['id' => $data->id, 'role' => Crypt::encryptString( $data->role)]);
    }

    public function validateUser(Request $request){
        $credential = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('student')->attempt($credential)){
            $user = Student::where('email', $credential['email'])->first();

            if($user->status == 'Active'){
                $request->session()->regenerate();
                return redirect()->intended('/');
            }else{
                $otp = $this->generateOtp();
                $user->update(['otp' => $otp]);

                $mailer = new MailController();
                $mailer->sendEmail($user->email, $user->otp, 'Hi '.$user->name);

                return redirect()->route('otp-validation', ['id' => $user->id, 'role' => Crypt::encryptString($user->role)]);
            }
        }
        else if(Auth::guard('researcher')->attempt($credential)){
            $user = Researcher::where('email', $credential['email'])->first();

            if($user->status == 'Active'){
                $request->session()->regenerate();
                return redirect()->intended('/');
            }else{
                $otp = $this->generateOtp();
                $user->update([
                    'otp' => $otp, 
                    'otp_expired' => Carbon::now()->addMinutes(1),
                ]);

                $mailer = new MailController();
                $mailer->sendEmail($user->email, $user->otp, 'Hi '.$user->name);

                return redirect()->route('otp-validation', ['id' => $user->id, 'role' => Crypt::encryptString($user->role)]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        else{
             return back()->with('errorMessage', 'There seems to be something wrong with your email or password');
        }

    }

    public function generateOtp(){
        return rand(10000, 99999);
    }

    public function validateOtp(Request $request){
        $validatedData = $request->validate([
            'otp' => 'required', 
            'id' => 'required', 
            'role' => 'required'
        ]);
        
        $decryptRole = Crypt::decryptString($validatedData['role']);
        $userData = $this->findUser($validatedData['id'], $decryptRole);
    
        if($userData && $userData->otp == $validatedData['otp']){
            $currentTime = Carbon::now();
            if($currentTime->isAfter($userData->otp_expired)){
                return back()->withErrors(['errorMessage' => 'Your OTP code has expired']);
            }else{
                $userData->update(['status'=>'Active']);
                return redirect('/');
            }
        } else{
            return back()->withErrors(['errorMessage' => 'Invalid code OTP']);
        }
    }

    public function findUser($id, $role){
        if($role == 'Student'){
            return Student::find($id);
        }else{
            return Researcher::find($id);
        }
    }

    public function otp($id, $role)
    {
        return view('pages/auth/otp', ['id' => $id, 'role'=>$role]);
    }

     public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/signin');
    }

    public function resendCode($id, $role){
        $userRole = Crypt::decryptString($role);
        $user = $this->findUser($id, $userRole);


        $otp = $this->generateOtp();
        $user->update([
            'otp' => $otp, 
            'otp_expired' => Carbon::now()->addMinutes(1),
        ]);

        $mailer = new MailController();
        $mailer->sendEmail($user->email, $user->otp, 'Hi '.$user->name);

        return redirect()->route('otp-validation', ['id' => $user->id, 'role' => Crypt::encryptString($user->role)]);
    }

}
