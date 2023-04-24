<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveSearch extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $users = DB::table('users')->where('user_id', 'LIKE', '%' . $request->search . "%")->get();
            if ($users) {
                foreach ($users as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->id . '</td>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->email . '</td>' .
                        '<td>' . $product->username . '</td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }
}
