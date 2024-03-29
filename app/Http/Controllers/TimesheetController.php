<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TimeSheet;
use Auth;
use DB;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
       $timeSheets =  DB::table('timesheets')
                     ->select('*')
                     ->where('employee_id', $userId)
                     ->get();

                     
        // $timeSheets = TimeSheet::where('employee_id' , $userId);

        return view('home', compact('timeSheets'));
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

    }


    public function timeIn(Request $request, $id)
    {
        
        $userId = Auth::user()->id;
        
        $users = User::find($userId);

        // if($users->status == "0")
        // {
            $timeSheets = new TimeSheet;
            $timeSheets->employee_id = $id;
            $timeSheets->date = date('Y-m-d');
            $users->status = "1";
            $timeSheets->time_from = date('H:i:s');
            $timeSheets->id = $request->randId;
            
        // }
        // else{
        //    $timeSheets = TimeSheet::find($id);
        //    if($timeSheets->time_to != null){

           
        //    }
        //    else{
        //     $users->status = "0";
        //     $timeSheets->time_to = date('H:i:s');
        //    }
       
        // }

        
     
        $timeSheets->save();
       
        $users->save();

        return view('/login');

        // return redirect()->route('home');
    }
    /*    public function timeIn(Request $request, $id)
    {
    
        $users = User::find($id);
        

        if($users->status == "0")
        {
            $timeSheets = new TimeSheet;
            $timeSheets->employee_id = $id;
            $timeSheets->date = date('Y-m-d');
        $users->status = "1";
        $timeSheets->time_from = date('H:i:s');
            $timeSheets->randId = $request->randId;
            $timeSheets->save();
        }
        else{
            $timeSheets = TimeSheet::findOrFail($request->randId);
        $users->status = "0";
        $timeSheets->time_to = date('H:i:s');
            $timeSheets->save();
        }

        
     
        
       
        $users->save();
        // return view('home');

        return redirect()->route('home');
    }*/

    public function timeOut(Request $request, $id)
    {   

        $userId = Auth::user()->id;
        $users = User::find($userId);
        DB::table('timesheets')
                    ->where('id', $request->testID)
                    ->update(['time_to' => date('H:i:s')]);
        
        // $timeSheets = TimeSheet::find(2222);
        // // $timeSheets = TimeSheet::find($request->randId);
       
                $users->status = "0";
        //        $timeSheets->time_to = date('H:i:s');
        //         // $timeSheets->time_to = date('H:i:s');
        //         $timeSheets->save();
                $users->save();

        return view('/home');
    }

}
    