<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        $addresses = DB::table('search')->select('search.*')->where('search.Name', 'like', $request['search'] . '%')->get();

        return response()->JSON(['results' => $addresses]);
    }


}
