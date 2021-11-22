<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

use Validator;
use Route;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $locations = Location::pluck('name', 'id');
        return view('admin/users')->with(compact('users','locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name'=> 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'location_id' => 'required|min:1||exists:locations,id',
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $user = $request->all();

            $user['password'] = Hash::make($request->password);
            $user['role'] = 'User';

            $user = User::create($user);
            return response()->json(['message' => 'You have registered successfully','data' => $user, 'status' => 'Success'], 200);

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Login API for user
     * 
     * @param \App\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if($request->wantsJson() && $request->is('api/*')){
            // API Login
            $tokenRequest = $request->create('/oauth/token', 'POST', $request->all());
            $request->request->add([
                "client_id" => $request->client_id,
                "client_secret" => $request->client_secret,
                "grant_type" => 'password',
                "code" => '*',
            ]);
            $response = Route::dispatch($tokenRequest);
            return $response;
        }else{
            // Web login
            $validator = Validator::make($request->toArray(), ['email' => 'required|email', 'password' => 'required']);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error','error'=>1], 200);
            }
            
            try{

                $user = $request->all();
                
                $User = User::where('email',$request->email)->first();
                if($User){
                    //print_r($User);
                    $hashedPassword = $User->password;
                    if(Hash::check($request->password, $hashedPassword)){
                        if ($request->is('admin/*')){
                            if($User->role == 'Admin'){
                                //echo "in";
                                Auth::login($User,true);
                                $user = Auth::user();
                                $access_token =  $user->createToken('MyApp')->accessToken;
                                $request->session()->put('access_token', $access_token);
                                
                                return response()->json(['status' => 'Success','isAdmin' => 1], 200);
                            }else{
                                return response()->json(['message' => 'You are unauthoried to access.', 'status' => 'Error','error'=>1], 200);
                            }                        
                        }else{
                            Auth::login($User,true);
                        }
                    }else{
                        return response()->json(['message' => 'The user credentials were incorrect.', 'status' => 'Error','error'=>1], 200);
                    }    
                }else{
                        return response()->json(['message' => 'The user credentials were incorrect.', 'status' => 'Error','error'=>1], 200);
                    }
                
                
            }catch(Exception $e){
                return response()->json(['message'=>$e->getMessage(),'error' => 1, 'status' => 'Error'], 200);
            }
        }
        
    }

    /**
     * User Login Page
     * 
     */
    public function loginPage(){
        if(!Auth::check()){
            return view('user/login');
        }
    }
    /**
     * User Login Page
     * 
     */
    public function logout(){
        $isAdmin = false;
        
        if(Auth::user()->role == 'Admin'){
            $isAdmin = true;
        }
        
        Auth::logout();
        if($isAdmin){
            return redirect('/admin/login');
        }else{
            return redirect('/login');
        }
    }


}
