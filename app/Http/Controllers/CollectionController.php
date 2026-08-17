<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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


    public function search_image($search_param)
    {
        if(!Session::get('user_id')){
            return [];
        }

        $search_param = trim(urldecode($search_param));

        if ($search_param === '') {
            return response()->json([
                'results' => []
            ]);
        }

        $response = Http::timeout(15)
            ->acceptJson()
            ->get('https://api.openverse.org/v1/images/', [
                'q' => $search_param,
                'license' => 'cc0,pdm',
                'page_size' => 18,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Openverse image search failed.'
            ], 502);
        }

        return response()->json($response->json());
    }

    public function add_favorite(Request $request)
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        $validated = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
        ]);

        $id_utente = Session::get('user_id');

        $favorite = new Favorite;
        $favorite->user_id = $id_utente;
        $favorite->username = User::where('id', $id_utente)->value('username');
        $favorite->url = $validated['url'];
        $favorite->save();

        return response()->json([
            'success' => true
        ]);
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


