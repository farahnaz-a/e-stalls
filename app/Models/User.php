<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, $this->first_name));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'entered_event',
        'permission',
        'street',
        'zip',
        'town',
        'country'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Get the receiver information for the invoice.
    * Typically includes the name and some sort of (E-mail/physical) address.
    *
    * @return array An array of strings
    */

    public function getVendor(){
        return $this->hasOne(Vendor::class, 'ownerID', 'id');
    }

    // public function lastMessage(){

    //     if(Auth::id() > $this->id){
    //         $pair = $this->id.'pair'.Auth::id();
    //     }else{
    //         $pair = Auth::id().'pair'.$this->id;
    //     }

    //     return Message::where('pair', $pair)->latest()->first();
    // }



    public function accessedReturnRequests()
        {
            return $this->belongsToMany(ReturnRequest::class, 'vendor_accessed_return_requests', 'user_id', 'return_id');
        }

          public function accessedCancelRequests()
        {
            return $this->belongsToMany(CancelRequest::class, 'vendor_accessed_cancel_requests', 'user_id', 'cancel_id');
        }
}
