<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\Event;
use App\Mail\UserDeleteMail;
use App\Models\PasswordResetToken;
use Mail;
use App\Mail\VendorCreateMail;

class AuthController extends Controller
{

    function authenticate(Request $request){
      $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required']
      ]);

      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
        $request->session()->regenerate();

        return redirect()->intended();
      }
      else {
        return redirect('inloggen')->withErrors('De combinatie van e-mailadres en wachtwoord is niet geldig.');
      }
    }

    function login(){
      if (Auth::check()) return redirect('/');
      else return view('inloggen');
    }

    function destroy(){
      return view('dashboard.destroy');
    }

    function destroyAccept(Request $request){
      $data = $request->validate([
        'password' => ['required'],
      ]);
      $user = Auth::user();
      if(Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])){
            Mail::to($user->email)->send(new UserDeleteMail);
            Auth::logout();
            $user->delete();
      }
      return redirect('/')->with('destroy', 'Wat jammer dat je gaat. Hopelijk tot ziens!');
    }

    function aanmaken(){
      if (Auth::check()) return redirect('/');
      else return view('account-aanmaken');
    }

    function vendor(){
      if (Auth::check()) return redirect('/dashboard');
      else return view('vendor-aanmaken', ['events' => Event::whereStatus('live')->get()]);
    }

    function createVendor(Request $request){
      $data = $request->validate([
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8',
        'first_name' => 'required',
        'last_name' => 'required',
        'street' => 'required',
        'zip' => 'required',
        'town' => 'required',
        'country' => 'required',
        'vendor_name' => 'required',
        'vendor_about' => 'required',
        'event' => 'required',
      ], [
        'password.min' => 'Het wachtwoord moet minimaal 8 tekens lang zijn.',
        'email.unique' => 'Dit e-mailadres is al gekoppeld aan een account.'
      ]);
      if (User::where('email', '=', $request->input('email'))->exists()) {
        return redirect('vendor-aanmaken');
      }
      else{
      $user = new User;
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->street = $request->input('street');
      $user->zip = $request->input('zip');
      $user->town = $request->input('town');
      $user->country = $request->input('country');
      $user->entered_event = "";
      // $user->permission = json_encode($request->permissions);
      $user->permission = 2;
    //   Mail::to($user->email)->send(new VendorCreateMail());
      $user->save();
      $vendor = new Vendor;
      $vendor->name = $request->input('vendor_name');
      $vendor->about = $request->input('vendor_about');
      $vendor->ownerID = $user->id;
      $vendor->enabled = 0;
      $vendor->eventID = $request->input('event');
      $vendor->auction_item_count = $request->input('auction_item_count');
      // $vendor->permissions = json_encode($request->input('permissions'));
      $vendor->permissions = implode(',', $request->input('permissions'));
      $vendor->save();

      Auth::login($user);
      return redirect('dashboard');
    }
    }

    function create(Request $request){
      $data = $request->validate([
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8',
        'first_name' => ['required'],
        'last_name' => ['required'],
        'street' => ['required'],
        'zip' => ['required'],
        'town' => ['required'],
        'country' => ['required']
      ], [
        'password.min' => 'Het wachtwoord moet minimaal 8 tekens lang zijn.',
        'email.unique' => 'Er bestaat al een account met dit e-mailadres.'
      ]);
      if (User::where('email', '=', $request->input('email'))->exists()) {
        return redirect('account-aanmaken')->with('emailError', 'Er bestaat al een account met dit e-mailadres.');
      }
      else{
      $user = new User;
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->street = $request->input('street');
      $user->zip = $request->input('zip');
      $user->town = $request->input('town');
      $user->country = $request->input('country');
      $user->entered_event = "";
      $user->permission = 1;
      $user->save();
      Auth::login($user);
      return redirect('dashboard');
    }
    }

    function update(Request $request){
      $data = $request->validate([
        'email' => 'required|unique:users,email,'.Auth::id(),
        'password' => ['required'],
        'first_name' => ['required'],
        'last_name' => ['required'],
        'street' => ['required'],
        'zip' => ['required'],
        'town' => ['required'],
        'country' => ['required']
      ], [
        'email.unique' => 'Er bestaat al een account met dit e-mailadres.'
      ]);
      $user = Auth::user();
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->street = $request->input('street');
      $user->zip = $request->input('zip');
      $user->town = $request->input('town');
      $user->country = $request->input('country');
      $user->entered_event = $user->entered_event;
      $user->permission = 1;
      $user->save();

      return redirect('dashboard');
    }

    function dashboard(){
      $user = Auth::user();
      if($user->permission == 2) return redirect('vendor');
      else return view('dashboard.index', [ 'user' => $user, 'events' => Event::where('status', 'live')->get() ]);
    }
    function chatBox(){
      $users = User::where('id', '!=', Auth::id())->get();
      return view('dashboard.chatBox', compact('users'));
    }

    function orders(){
      if ( Auth::user() ){
        return view('dashboard.bestellingen', [
          'orders' => Order::where('paid_by', Auth::user()->id)->get(),
          'vendors' => Vendor::all()
                ]);
      }
      else {
        return redirect()->back();
      }
    }

    function forgotPass(Request $request){
      $request->validate(['email' => 'required|email']);

          $status = Password::sendResetLink(
              $request->only('email')
          );

          return $status === Password::RESET_LINK_SENT
                      ? back()->with(['status' => __($status), 'msg' => 'Dank! Je krijgt z.s.m. een e-mail om je wachtwoord te resetten.'])
                      : back()->withErrors(['email' => __($status)]);
    }


    function resetPass(Request $request){
      $request->validate([
              'token' => 'required',
              'email' => 'required|email',
              'password' => 'required|min:8|confirmed',
            ],[
                'password.min' => 'Het wachtwoord moet minimaal 8 tekens lang zijn.',
                'password.confirmed' => 'De wachtwoordbevestiging komt niet overeen.',
            ]);

          $status = Password::reset(
              $request->only('email', 'password', 'password_confirmation', 'token'),
              function ($user, $password) {
                  $user->forceFill([
                      'password' => Hash::make($password)
                  ])->setRememberToken(Str::random(60));

                  $user->save();

                  event(new PasswordReset($user));
              }
          );

          if($status === Password::PASSWORD_RESET){
            PasswordResetToken::create([
              'token' => $request->token
            ]);
            return redirect('/inloggen')->withSuccess('Je wachtwoord is succesvol gewijzigd.');
          }else{
            return back()->withErrors(['email' => [__($status)]]);
          }

          // return $status === Password::PASSWORD_RESET
          //             ? redirect()->route('login')->with('status', __($status))
          //             : back()->withErrors(['email' => [__($status)]]);
    }

    function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }
}
