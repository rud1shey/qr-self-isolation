<?php

namespace App\Http\Controllers;

use App\QrCode;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function postQrCode()
    {
        $qr=QrCode::all()
            ->where('user_id',Auth::id())->first();
        if($qr !=null&&$qr->end_date<Carbon::now()->subMinutes(30))
        {
            $qr->end_date = Carbon::now()->addDay(2);
            DB::update('update qr_codes set end_date=? where qr_id=?',[Carbon::now()->addDay(2)->toDateTime(),$qr->qr_id]);
        }
        else{
            $qr=new QrCode();
            $date=Carbon::now()->addDay(2);
            $qr->end_date=$date->toDate();
            $qr->uid=Str::random(40);
            $qr->user_id=Auth::id();
            $qr->save();
        }

        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard()
    {

        if(Auth::check()){
            $qr=QrCode::all()
                ->where('user_id',Auth::id())
                ->where('end_date','>=',Carbon::now()->subMinutes(30))->first();
            $json="";
            if($qr!=null)
            {
             $json = json_encode($qr);
            }

            return view('dashboard',compact('json'));
        }
        return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
