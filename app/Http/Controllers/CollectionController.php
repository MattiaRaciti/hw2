<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Like;

class CollectionController extends BaseController {

    public function home() {
        if(!Session::get('user_id')){
            return redirect('login');
        }
        $user = User::find(Session::get('user_id'));        
        return view('home')->with('username', $user->username);
    }   

    public function list(){
        if(!Session::get('user_id')){
            return [];
        }

        $user = User::find(Session::get('user_id'));
        return $user->favorites;
    }

    public function preferiti(){
        return view('preferiti');
    }


    public function search_image($search_param){
        if(!Session::get('user_id')){
            return [];
        }

        $curl = curl_init(); 
	
        $rapid_api_key = "X-RapidAPI-Key: ";
        $rapid_api_key = $rapid_api_key . env('RAPIDAPI_KEY');
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bing-image-search1.p.rapidapi.com/images/search?q=$search_param",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: bing-image-search1.p.rapidapi.com",
                $rapid_api_key
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            return [];
        }
        else{;
            return $response;
        }
    }

    public function add_favorite($url){
        if(!Session::get('user_id')){
            return [];
        }

        $bing_base_url = 'https://tse4.mm.bing.net/th?id=';

        $id_utente = Session::get('user_id');

        $favorite = new Favorite;
        $favorite->user_id = $id_utente;
        $favorite->username = User :: where('id', $id_utente)->value('username');
        $favorite->url = $bing_base_url .= urldecode($url);
        $favorite->save();

        return [];
    }

    public function remove_favorite($favorite_id){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        $favorite = Favorite :: find($favorite_id);

        $favorite->delete();
        return [];
    }

    public function search_user($search_param){
        if(!Session::get('user_id')){
            return [];
        }

        $user = User :: select('username', 'created_at')
                -> where('username','like', $search_param . '%')
                ->get();

        $count_user = User ::  where('username','like', $search_param . '%')
        ->count();

        $utente_trovato = false;
        if($count_user > 0){
            $utente_trovato = true;
        }
        
        $json_user = [];
        $json_user = [
            'success' => $utente_trovato,
            'content' => $user
        ];

        return $json_user;
    }

    public function view_collection($search_param){

        $user_id = Session::get('user_id');
        if(!Session::get('user_id')){
            return [];
        }

        $mittente = User :: whereId($user_id)->first();

        $favorite = Favorite :: select('username', 'url')
                        -> where('username', '=', $search_param)
                        -> get();

        $count_favorites = Favorite :: where('username', '=', $search_param)
                        -> count();                       

        $count_like = Like :: where('destinatario', '=', $search_param)
                        -> where('mittente' , '=', $mittente->username)
                        -> count();

        $success = false;
        if($count_favorites > 0){
            $success = true;
        }

        $like_presente = false;
        if($count_like > 0){
            $like_presente = true;
        }

        $json_collection = [];
        $json_collection = [
            'success' => $success,
            'content' => $favorite,
            'like_presente' => $like_presente,
            'username' => $search_param
        ];

        return $json_collection;
    }

    public function add_like($search_param){

        $user_id = Session::get('user_id');
        if(!Session::get('user_id')){
            return [];
        }

        $mittente = User :: whereId($user_id)->first(); 

        $like = new Like;
        $like->mittente = $mittente->username;
        $like->destinatario = $search_param;
        $like->save();

        return [];
    }

    public function undo_like($search_param){

        $user_id = Session::get('user_id');
        if(!Session::get('user_id')){
            return [];
        }

        $mittente = User :: whereId($user_id)->first(); 

        $like = Like :: where('mittente', '=', $mittente->username)
                    ->where('destinatario', '=', $search_param)
                    ->first();

        $like->delete();

        return [];
    }

    public function get_like_number(){

        $user_id = Session::get('user_id');
        if(!Session::get('user_id')){
            return [];
        }

        $user = User :: whereId($user_id)->first(); 

        $count_likes = Like :: where('destinatario', '=', $user->username)
                        -> count();

        $success = false;
        if($count_likes > 0){
            $success = true;
        }

        $likes = Like :: where('destinatario', '=', $user->username)
                    ->get();

        $json_likes = [];
        $json_likes = [
            'success' => $success,
            'content' => $likes
        ];

        return $json_likes;
    }
}
?>


