<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class FolderNotification extends Controller
{

    public function fetch(Request $request){

        $user = Auth::user();
        //$notif_count = DB::select('select count(*) from folder_notifications where status=0');
        
        $notif_count = App\FolderNotification::where('receiver_id', '=', Auth::user()->id)
            ->where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->count();
        
            // ->orWhere(function($query){
            //     $query->where('receiver_id', '=', Auth::user()->id)
            //           ->where('status', '=', 0);
            //  })
        //$users = DB::table('users')->select('name', 'email as user_email')->get();
        
        $data = array('user'=>$user, 'notif_count' => 5 );
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
