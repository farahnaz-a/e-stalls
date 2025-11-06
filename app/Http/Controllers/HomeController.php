<?php

namespace App\Http\Controllers;

use App\Mail\EntrepreneurCreateAdminMail;
use App\Mail\VendorCreateMail;
use App\Models\Entrepreneur;
use Illuminate\Http\Request;
use App\Models\Event;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  function index(){

    return view('home.index', [
      'events' => Event::all()
    ]);
  }

  public function ondernemerStore(Request $request){
    $item = Entrepreneur::create($request->except(['_token', 'offer']));
    if($request->offer){
      $offer = implode(',', $request->offer);
      $item->offer = $offer;
    }
    $item->save();
    // Sending mail to vendor
    if($item->email){
      Mail::to($item->email)->send(new VendorCreateMail());
    }
    Mail::to('info@e-stalls.nl')->send(new EntrepreneurCreateAdminMail($item));
    return back()->with('success', 'Submitted successfully');
  }

  public function addressValidation(){
        return redirect('/');
        $postal_code = request()->postal_code;
        $street_number = request()->house_number;
        $street_number_arr = explode(' ', $street_number);
        $house_number = end($street_number_arr);
       $client = new \GuzzleHttp\Client();
       $data = [];
       $status = 'mileni';
       if($postal_code && $house_number){
            try{
                $response = $client->request('GET', "https://api.pro6pp.nl/v2/suggest/nl/streetNumber?postalCode=$postal_code&streetNumber=$house_number&authKey=yHUEzutaPI8fWpO7");
                $data = json_decode($response->getBody(), true);
                if($data){
                    foreach($data as $item){
                        foreach($item as $key => $value){
                            if($key == 'streetNumber' && $value == $house_number){
                                if(strtolower($item['street']).' '.$house_number == strtolower($street_number)){
                                    $status = 'milse';
                                }
                                break;
                            }
                        }
                    }
                }
            }catch(Exception $e){
                $data = [];
            }
       }
        return view('address-validation', compact('data', 'status'));

        // $response = $client->request('GET', 'https://addressperfect-dutch-streets.p.rapidapi.com/validateaddress?street=Jan%20van%20Eijckstraat&hnr=47&zip=1077LH&city=Amsterdm', [
        //     'headers' => [
        //         'x-rapidapi-host' => 'addressperfect-dutch-streets.p.rapidapi.com',
        //         'x-rapidapi-key' => '2b71bb99e8msh0389a4952600854p1ee208jsn5b12e502f9c6',
        //     ],
        // ]);

        // echo $response->getBody();
  }
    public function addressVerification(Request $request){

        $postcode = $request->postcode;
        $street_number = $request->street_number;
        $town = $request->town;
        $street_number_arr = explode(' ', $street_number);
        $house_number = end($street_number_arr);

        $client = new Client();

        $status = false;
        if($postcode && $house_number){
            try{
                $response = $client->request('GET', "https://api.pro6pp.nl/v2/suggest/nl/streetNumber?postalCode=$postcode&streetNumber=$house_number&authKey=FX5HqZpz1e69GWZq");
                $data = json_decode($response->getBody(), true);
                if($data){
                    foreach($data as $item){
                        // foreach($item as $key => $value){
                        //     if($key == 'streetNumber' && $value == $house_number){
                        //         if(strtolower($item['street']).' '.$house_number == strtolower($street_number)){
                        //             $status = true;
                        //         }
                        //         break;
                        //     }
                        // }
                          $streetNumber = isset($item['streetNumber']) && $item['streetNumber'] == $house_number;
                          $settlement = isset($item['settlement']) && $item['settlement'] == $town;
                           if( $streetNumber && $settlement){
                               if(strtolower($item['street']).' '.$house_number == strtolower($street_number)){
                                    $status = true;
                                }
                                break;
                          }
                    }
                }
            }catch(Exception $e){

            }
        }

        return response($status);
  }

}
