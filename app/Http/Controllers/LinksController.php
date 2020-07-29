<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LinksController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function shorten(Request $request){
        
        if($request->has('original_link') && !empty($request->input('original_link'))) {        
        $random_token = Str::random(6);
        $query = DB::table('links')->where('original_link','=',$request['original_link'])->first();
        if (!$query){
            DB::table('links')->insert([
               'original_link' => $request['original_link'],
               'short_link' => URL::to("/") . '/' . $random_token,
               'visited_counter' => 0,
         ]);
        $result = URL::to("/") . '/' . $random_token;
        return view('welcome')->with('short_link',$result);
        } else{  
             return view('welcome', [
                 'short_link' => $query->short_link,
                 'visited_counter' =>$query->visited_counter,
                 'original_link' => $query->original_link,
             ]);        
        }
    } else {
        return view('welcome')->with('error',true);

    }
    }
    
    public function fetchLink($link){
        $short_link = URL::to('/') . '/' . $link;
        $query = DB::table('links')->where('short_link','=',$short_link);

       if ($query->exists()){
        DB::table('links')
            ->where('short_link', $short_link)
             ->update([
                 'visited_counter' => DB::raw('visited_counter + 1'),
        ]);
            return redirect($query->value('original_link'));
        } else{
            return ('error');
            
        }
        
    }
}
