<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User;
use App\Charges;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;

        $user = User::find($id);

        return view('dashboard')->with('charges', $user->charges);
    }

    public function stripeConnect(Request $request)
    {
        if ($request->input('error')) {
            echo $request->input('error_description');
        }

        $client = new \GuzzleHttp\Client();

        $code = $request->input('code');


        $response = $client->post(env('STRIPE_TOKEN_URL'), [
            'form_params' => [
                'client_secret' => env('STRIPE_SECRET'),
                'code' => $code,
                'grant_type' => "authorization_code"
            ]
        ]);

        $contents = (string) $response->getBody()->getContents();
        $json = json_decode($contents);

        $id = auth()->user()->id;

        $users = User::find($id);

        $users->stripe_user_id = $json->stripe_user_id;

        $users->save();
            
        return redirect()->to(route('dashboard'))->with('status', 'You are successfully connected to stripe');
    }

    public function getPaymentLink($charge_id)
    {
        $user = User::find(auth()->user()->id);

        $charges = $user->charges()->find($charge_id);

        return view('getpaymentlink')->with('charges', $charges)->with('user', $user);
    }

    public function createPaymentLink(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required',
            'amount'    =>  'required',
            'description' =>  'required',
        ]);

        $charge = new Charges();

        $user_id = auth()->user()->id;

        $charge->user_id     = $user_id;
        $charge->name        = $request->name;
        $charge->email       = $request->email;
        $charge->phone       = $request->phone;
        $charge->amount      = $request->amount;
        $charge->paid        = 'false';
        $charge->description = $request->description;

        $charge->save();

        return redirect()->back()->with('status', 'You successfully created a new payment request');
    }

    public function deletePaymentLink($charge_id)
    {
        return $charge_id;
    }

    public function getPayment($user_name, $user_id, $charge_id)
    {
        $user = User::find($user_id);

        if ($user_name == strtolower($user->first_name)) {
            $charges = $user->charges()->find($charge_id);

            return view('getpayment')->with('user', $user)->with('charges', $charges);
        }
        else{
            abort('404', 'Error 404. There is no payment requests related to this user');
        }
        
    }

    public function createPayment(Request $request, $user_id)
    {
        $token = $request->input('stripeToken');
        $amount = $request->input('amount');
        $appFee = (1 / 100) * $amount;
        $charge_id = $request->input('charge_id');

        $users = User::find($user_id);


        $stripe_user_id = $users->stripe_user_id;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = \Stripe\Charge::create([
          "amount" => $amount,
          "currency" => "eur",
          "source" => $token,
          "application_fee_amount" => $appFee,
        ], ["stripe_account" => $stripe_user_id]);

        $chargeUpdatePaid = Charges::find($charge_id);
        
        $chargeUpdatePaid->paid = 'true';

        $chargeUpdatePaid->save();

        return redirect()->to(route('dashboard'))->with('status', 'Your Product Have Been Purchased');
    }

    public function directChargeUser(Request $request, $user_name, $user_id)
    {
        $check_user_exists = User::where('first_name', strtoupper($user_name))
            ->where('id', $user_id)
            ->first();

        if (!$check_user_exists) {
            return abort('404');
        }

        if ($request->isMethod('post')) {
            $validateRules = [
                'name' => 'required',
                'email' => 'required',
                'description' => 'required',
                'amount' => 'required|numeric',
            ];

            $messages = [
                'name.required' => 'Please you are required to provide your name upon payment',
                'email.required' => 'Please provide your e-mail for identification purpose',
                'description.required' => 'We want to know what this payment is all about for your own safety',
                'amount.required' => 'Amount field cannot be empty required',
                'amount.numeric' => 'invalid characters in amount',
            ];

            $this->validate($request, $validateRules, $messages);

            $name = $request->get('name');
            $email = $request->get('email');
            $description = $request->get('description');
            $amount = $request->get('amount');
            
            $token = $request->input('stripeToken');
            $appFee = (1 / 100) * $amount;

            $users = User::find($user_id);


            $stripe_user_id = $users->stripe_user_id;
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = \Stripe\Charge::create([
              "amount" => $amount,
              "currency" => "eur",
              "source" => $token,
              "application_fee_amount" => $appFee,
            ], ["stripe_account" => $stripe_user_id]);

            if ($charge) {
                 return 'successfully paid a certain amount';
             } 
        }
        
        return view('directchargeuser', compact('check_user_exists'));
    }
}
