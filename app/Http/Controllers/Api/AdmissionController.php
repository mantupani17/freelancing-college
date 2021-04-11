<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

class AdmissionController extends Controller
{
    public function getAdmissionProcess(Request $request)
    {
        try {
            $reqData = $request->all();
            $where = [];
            if($reqData && isset($reqData['college_id'])){
                $where['addmissionprocesses.college_id'] = $reqData['college_id'];
            }
            $diets = DB::table('addmissionprocesses')
                ->where($where)
                ->select('addmissionprocesses.admission_process','addmissionprocesses.admission_process_detail','addmissionprocesses.admission_process_link', 'addmissionprocesses.admission_process_link_text',                                     'addmissionprocesses.own_admission_process','courses.courseName', 'colleges.collegeName')
                ->join('courses', 'courses.id', '=', 'addmissionprocesses.course_id')
                ->join('colleges', 'colleges.id', '=', 'addmissionprocesses.college_id')
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
