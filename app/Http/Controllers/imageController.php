<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\task;

class imageController extends Controller
{
    //
    public function displayImage()
    {
        $display = task::select('image','date_of_birth')->orderBy('created_at','desc')->paginate();
        return response() ->json($display,200);
    }

    public function imgALl()
    {
      $display = task::find(8)->relation;
      return response()->json($display,200);
    }
}
