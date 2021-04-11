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
                ->select('collegefacilities.facilities_id', 'collegefacilities.college_area', 'collegefacilities.college_faculty', 'collegefacilities.facilities_detail', 'collegefacilities.college_established', 'facilities.facilitiesName', 'colleges.collegeName')
                ->join('facilities', 'facilities.id', '=', 'collegefacilities.facilities_id')
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
