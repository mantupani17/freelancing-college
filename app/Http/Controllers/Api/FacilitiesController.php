<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

class FacilitiesController extends Controller
{
    public function getFacilities(Request $request)
    {
        try {
            $reqData = $request->all();
            $where = [];
            if($reqData && isset($reqData['college_id'])){
                $where['collegefacilities.college_id'] = $reqData['college_id'];
            }
            $diets = DB::table('collegefacilities')
                ->where($where)
                ->select('collegefacilities.facility_name', 'collegefacilities.facility_value')
                ->join('colleges', 'colleges.id', '=', 'collegefacilities.college_id')
                ->get();
            
            return [
                'status' => true,
                'data' => $diets,
                'message' => ''
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
