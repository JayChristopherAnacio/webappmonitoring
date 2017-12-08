<?php

namespace App\Http\Controllers;

use DB;
use App\Log;
use Exception;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function show($id)
    {
         
        $logs = DB::table('logs')
				->select(
						'id'
						,'process_id'
						,'DATE_FORMAT(start_time, "%m/%d/%Y %H:%i:%s %p") as start_time'
						,'DATE_FORMAT(end_time, "%m/%d/%Y %H:%i:%s %p") as end_time'
						,'status'
						,'log_description'
						,'DATE_FORMAT(created_at, "%m/%d/%Y %H:%i:%s %p")as created_at'
						,'DATE_FORMAT(updated_at, "%m/%d/%Y %H:%i:%s %p")as updated_at'
				)
        		->where('process_id', $id)
                ->whereRaw('DATE(created_at) =  DATE(NOW())')
                ->orderBy('created_at', 'desc')
        		->get();

        
        if(count($logs) > 0){
        	
        	$result = array(
        		'status' => 'success',
	            'data' => $logs
        	);

        }else{

        	$result = array(
        		'status' => 'success',
        		'message' => 'No record(s) found.',
	            'data' => $logs
        	);
        }

        return response()->json($result);
    }

    public function get_last_active_log(Request $request)
    {
        $processes = DB::table('logs')
                    ->where('process_id', $request->process_id)
                    ->where('status', 1)
                    ->select('start_time')
                    ->limit(1)
                    ->orderByRaw('process_id, created_at DESC')
                    ->get();
        
        if(count($processes) > 0){
            
            $result = array(
                'status' => 'success',
                'data' => $processes
            );

        }else{

            $result = array(
                'status' => 'success',
                'message' => 'No record(s) found.',
                'data' => $processes
            );
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {

        try {
      		
	      	$log = new Log();
	        $log->process_id = $request->input('process_id');
	        $log->start_time = $request->input('start_time');
	        $log->end_time = $request->input('end_time');
	        $log->status = $request->input('status');
	        $log->log_description = $request->input('log_description');

	        $log->save();

	        $result = array(
        		'status' => 'success',
        		'message' => 'Record successfuly saved.'
        	);

        } catch (\Exception $e) {

        	$errorCode = $e->errorInfo[1];
		    
		    if($errorCode == 1265){
		        $message = "Data truncated for column 'process_id' at row 1";
		    }else{
		    	$message = $e->errorInfo;
		    }

        	$result = array(
        		'status' => 'fail',
        		'message' => $message
        	);
        	
        }

        return response()->json($result);

    }

}
