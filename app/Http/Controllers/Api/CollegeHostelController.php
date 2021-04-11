<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

class CollegeHostelController extends Controller
{
    public function getHostelFacilities(Request $request)
    {
        try {
            $reqData = $request->all();
            $where = [];
            if($reqData && isset($reqData['college_id'])){
                $where['hosteles.college_id'] = $reqData['college_id'];
            }
            $diets = DB::table('hosteles')
                ->where($where)
                ->select('hosteles.hostel_name','hosteles.state_id', 'hosteles.hostel_facility', 'hosteles.city', 'hosteles.hostel_type', 'hosteles.address_detail', 'states.state_name', 'colleges.collegeName')
                ->join('states', 'states.id', '=', 'hosteles.state_id')
                ->join('colleges', 'colleges.id', '=', 'hosteles.college_id')
                ->get();
            
            return [
                'status' => true,
                'data' => $diets,
                'message' => 'Data get response successfuly'
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => 'Internal Server Error'
            ];
        } //facilities collegefacilities
        
        
    }
}
