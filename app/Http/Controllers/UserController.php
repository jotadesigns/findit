<?php

namespace App\Http\Controllers;
use App\User;
use App\Like;
use Auth;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Illuminate\Support\Facades\Mail;
use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests;


class UserController extends Controller
{
    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        return view('home');
    }


    public function updateProfile(Request $request)
    {
        if ($request->user()) {
            $user = Auth::user();
            $user->fill(Request::all());
            $user->save();
        }
    }
    public function getConfig() {
        $user = Auth::user();
        return view('auth.config',compact('user'));
    }
    public function getFav() {
        $GLOBALS['user'] = Auth::user();
        $favoritos = DB::table("likes")
        ->join('platos', 'platos.id_plato', '=', 'likes.id_plato')
        ->join('restaurantes', 'restaurantes.id_restaurante', '=', 'likes.id_restaurante')
        ->where('id', '=', $GLOBALS['user']->id)
        ->get();

       //lentisimo, MEJORAR !!
        $favoritos = $favoritos->each(function ($value, $key) {
            $votado = DB::table("likes")
            ->where('id', '=', $GLOBALS['user']->id)
            ->where('id_restaurante', '=', $value->id_restaurante)
            ->where('id_plato', '=', $value->id_plato)
            ->first();
            if(isset($votado)){
                $value->favorito = 1;
            }
        });
        return view('auth.fav',compact('user','favoritos'));
    }
    public function postSaveConfig(){

        $user = Auth::user();
        $user->fill(Request::all());
        $user->save();
        Auth::setUser($user);
        return response()->json( array('success' => true, 'user'=>$user) );
    }

    public function getEditar() {
        $user = Auth::user();
        return view('auth.edit',compact('user'));
    }

    //falta actualizar el array de productos :(
    public function postVote(Request $request){
            if(Auth::check()){
                $user = Auth::user();

                $votado = DB::table("likes")
                ->where('id', '=', $user->id)
                ->where('id_restaurante', '=', Request::input('id_restaurante'))
                ->where('id_plato', '=', Request::input('id_plato'))
                ->first();

                if(!isset($votado)){
                    DB::table('likes')->insert(
                        ['id' => $user->id, 'id_restaurante' => Request::input('id_restaurante'), 'id_plato'=>Request::input('id_plato')]
                    );
                }else{
                    DB::table('likes')
                    ->where('id', '=', $user->id)
                    ->where('id_restaurante', '=', Request::input('id_restaurante'))
                    ->where('id_plato', '=', Request::input('id_plato'))
                    ->delete();
                }

            }

    }

    public function postSave(){

            $user = Auth::user();
            $user->fill(Request::all());
            $user->save();

            return redirect()->back()->withInput(['correcto'=>'correcto']);
    }
    public function getBorrar(){
        $user = Auth::user();
        $usera = array('user'=>$user);
         Mail::send('email.borrar', $usera, function($message) use ($usera)
        {
            $message->from('us@example.com', 'Find it');
            $message->to($usera['user']->email)->subject('Cuenta borrada en Find it');
        });
        $user->delete();
        return redirect()->back()->withInput(['borrado'=>'correcto']);
    }

        public function postReset(Request $request)
    {
            $this->validate($request, [
                    'token' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|confirmed',
            ]);
            $credentials = $request->only(
                    'email', 'password', 'password_confirmation', 'token'
            );

            $user = \Auth::user();
            $user->password = bcrypt($credentials['password']);
            $user->save();
           return Redirect::route('/')->with('message', 'Contraseña cambiada correctamente!');
    }
    public function postChangePassword(Request $request)
   {

        $password = Request::only('password_confirmation', 'password');

        $validator = Validator::make($password, [
                        'password' => 'required|confirmed|min:6|max:32',
                        'password_confirmation' => 'required|min:6|max:32',
                    ])->validate();

        if($password['password']===$password['password_confirmation']){

            $user = Auth::user();
                $user->fill([
                 'password' => Hash::make($password['password'])
                 ])->save();
             return redirect()->back()->withInput(['correcto'=>'correcto']);
         }else{

             return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
         }
   }





}
