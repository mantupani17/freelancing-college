<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;

use App\Models\Colleges;
use App\Models\State;
use App\Models\City;
use App\Models\Univercity;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Coursefees;
use App\Models\Addmissionprocess;
use App\Models\Coursemapping;
use App\Models\Collegefacilities;
use App\Models\Facilities;
use App\Models\Hosteles;
use App\Imports\ImportCollege;
use App\Exports\ExportCollege;
use Excel;
use DB;
use Session;


class CollegeadminController extends Controller
{
   public function index(Request $request)
    {
        $states = State::orderBy('state_name')->get();
        $collegesList = Colleges::all();
        return view('colleges',compact('collegesList','states'))->with('i', (request()->input('page', 1) - 1) * 5);
    
    }


    public function addBranch(Request $request)
    {
        $branchList = Branch::orderBy('branch_name')->get();
        
        return view('addBranch',compact('branchList'));
    }

    public function addState(Request $request)
    {
       
        
        return view('addState');
    }

    public function addCity(Request $request)
    {
       
        $states = State::orderBy('state_name')->get();
        return view('addCity',compact('states'));
    }

    public function newCollege(Request $request)
    {
        $branchList = Branch::orderBy('branch_name')->get();
        $states = State::orderBy('state_name')->get();
        return view('newCollege',compact('states','branchList'));
    }


    public function importCSVfile(Request $request)
    {
        $branchList = Branch::orderBy('branch_name')->get();
        $states = State::orderBy('state_name')->get();
        return view('importCSVfile',compact('states','branchList'));
    }



     public function homePage(Request $request)
    {
        $branchList = Branch::all();
        //return $branchList;
       $branches = Branch::orderBy('branch_name')->get();
       return view('home',compact('branchList'));
    }



    public function view(Request $request){
        try{
            $url_params = $request->getRequestUri();
            $uri_segments = explode('/', $url_params);
            $states = State::orderBy('state_name')->get();
            $branch_name = "";
            $query = [];
            $colleges = [];
            $state_id = '';
            $city_id = '';
            $state_name = "";
            $city_name = "";
            if(count($uri_segments) > 2 && $uri_segments[2]){
                if($uri_segments[2]=='list'){
                    // if state is present
                    if(count($uri_segments) > 3 && $uri_segments[3]){
                        $state_name = $uri_segments[3];
                        $state = State::where('state_name', $uri_segments[3])
                            ->get(["state_name","id"]);
                        if(count($state)){
                            $query['state_id'] = $state[0]['id'];
                            $state_id = $state[0]['id'];
                        }
                    }

                    // if state and city present
                    if(count($uri_segments) > 4 && $uri_segments[4]){
                        $city_name = $uri_segments[4];
                        $city = City::where('city_name', $uri_segments[4])
                            ->get(["city_name","id"]);
                        if(count($city)){
                            $query['city_id'] = $city[0]['id'];
                            $city_id = $city[0]['id'];
                        }
                    }

                    // if there is any condition then just fetch the query
                    if(count($query)){
                        $colleges = Colleges::where($query)
                            ->get();
                    }
                    
                    
                }else{
                    // if the endpoint not containes list keyword in url then that means the query is for branch
                    $branch_name = $uri_segments[2];
                    $branch = Branch::where('branch_name', $uri_segments[2])
                        ->get(["branch_name","id"]);
                    if(count($branch)){
                        $colleges = Colleges::where('branch_id', $branch[0]['id'])
                        ->get();
                    } 
                }
            }else{
                $colleges = Colleges::all();
            }
    
            $total = count($colleges);
            return view('index',compact('states','colleges','total', 'branch_name', 'state_id', 'city_id', 'city_name', 'state_name'));
        }catch(Exception $e){
            print_r($e);
        }
    }






    public function saveCollege(Request $request)
    {

        
        $this->validate($request,[
            'collegeName' => 'required|unique:colleges||max:255',
            'location' => 'required|max:255',
            'contact' => 'required|digits_between:10,11',
            'name' => 'required|max:255',
            'state_id' => 'required',
            'city_id' => 'required',
            'branch_id' => 'required|integer',
            
            'email' => 'required|max:255',
            'address' => 'required|max:255',
            'facilites' => 'required|max:255',
            'history' => 'required',
            'mission' => 'required',
            'highlight' => 'required'
        ]);
        $stateData = explode('##', $request->state_id);
        $cityData = explode('##', $request->city_id);
        $college = new Colleges;
        $college->collegeName = $request->collegeName;
        $college->location = $request->location;
        //$college->aboutCollege = $request->about;
        $collegeUrl = strtolower($request->collegeName.' '.$stateData[1].' '.$cityData[1]);
        $college->url = str_replace(" ","-",$collegeUrl);
        $college->contact = $request->contact;
        $college->email = $request->email;
        $college->address = $request->address;
        $college->facilites = $request->facilites;
        
        $college->mission = $request->mission;
        $college->highlight = $request->highlight;
        $college->history = $request->history;
        $college->name = $request->name;
       // $college->state = $request->state;
        $college->state_id = $stateData[0];
        $college->city_id = $cityData[0];
        $college->branch_id = $request->branch_id;
        $college->mission = $request->mission;

        $college->save();
        return redirect('/')->with('success','College added successfully');
        

    }


     public function saveBranch(Request $request)
       {

        $branch = new Branch;
        $branch->branch_name = $request->branch_name;

        $branch->save();
        return redirect('home')->with('success','Branch added successfully');
        
      }




    public function saveState(Request $request)
    {

        $college = new State;
        $college->state_name = $request->state_name;

        $college->save();
        return redirect('/')->with('success','State added successfully');
        

    }


    public function saveCities(Request $request)
    {

        $college = new City;
        $college->city_name = $request->city_name;
        $college->state_id = $request->state_id;

        $college->save();
        return redirect('/')->with('success','City added successfully');
        

    }



    public function detail($collegeurl, $tab_name = null) {
        $data = [];
        $college = Colleges::select('*')
                    ->where('url', '=', $collegeurl)
                    ->first();
                  
        $state = State::select('*')
                ->where('id', $college['state_id'])
                ->first();
        
        
        $city = City::select('*')
                ->where('id', $college['city_id'])
                ->first();
        $data['college'] = $college;
        $data['college']['state_name'] = $state['state_name'];
        $data['college']['city_name'] = $city['city_name'];
       // $preg_replace['college,pattern,replacement'] = $college;
        return view('collegedetail', $data);
    }




    public function getCities(Request $request)
    
    {
        $cities = City::whereIn('state_id',$request->state_id)->get();
        $hashed_type = $request->hashed_type;
        $multiple = $request->multiple;
        if(!isset($hashed_type)){
            $html = view('ajax.city_ajax',compact('cities','multiple'))->render();
        }else{
            $html = view('ajax.hashed_city_ajax',compact('cities','multiple'))->render();
        }
        
        return response()->json([
            'success' => $html,
        ]);
    }






    public function getColleges(Request $request)
    {
       try {
            $colleges = new Colleges();
            $branch = [];
            if(isset($request->branch_name) && $request->branch_name != null){
                $branch = Branch::where('branch_name', $request->branch_name)
                            ->get(["branch_name","id"]);
            }
            if(count($branch)){
                $colleges = $colleges->where('branch_id', $branch[0]['id']);
            }
            if(isset($request->state_id) && $request->state_id != null){
                $colleges = $colleges->whereIn('state_id',$request->state_id);
            }
            if(isset($request->city_id) && $request->city_id != null){
                $colleges = $colleges->whereIn('city_id',$request->city_id);
            }
            // $sql = $colleges->toSql();
            $colleges = $colleges->get();
            $total = $colleges->count();
   
            $html = view('ajax.get_colleges',compact('colleges','total'))->render();

            return response()->json([
                'success' => $html,
            ]);

       } catch (Exception $th) {
           return response()->json([
               'success' => $th,
           ]);
       }

    }



    function import(Request $request)
    {
        try{
            $isValid = $this->validate($request, [
                'select_file'  => 'required|mimes:xls,xlsx'
            ]);

            # Total number of rows in the sheet to session
            Session::put('importResult');

            Excel::import(new ImportCollege(), request()->file('select_file'));

            $value = Session::get('importResult');

            return $value;

        }catch(Exception $e){
            return $e;
        }
    }



    function exportCollege(Request $request){
        try {
            //code...
            $fileName = 'COLLEGE_'.date("hisa");
            return Excel::download(new ExportCollege, $fileName.'.csv');
        } catch (Exception $e) {
            //throw $th;
            return $e;
        }
    }


     public function addCourse(Request $request)
    {
        
        $collegesList = Colleges::orderBy('collegeName')->get();
        return view('addCourse',compact('collegesList'));
    }



    public function newCoursesfees($collegeurl)
    {
        $data = [];
        $college = Colleges::select('*')
                    ->where('url', '=', $collegeurl)
                    ->first();
                  
        $state = State::select('*')
                ->where('id', $college['state_id'])
                ->first();
        
        
        $city = City::select('*')
                ->where('id', $college['city_id'])
                ->first();

         $course = Course::select('*')
                ->where('id', $college['course_id'])
                ->first();       

        $data['college'] = $college;
        $data['college']['state_name'] = $state['state_name'];
        $data['college']['city_name'] = $city['city_name'];
       // $data['college']['course_id'] = $course['course_id'];
        return view('course-fees', $data);
    }


     public function saveCourses(Request $request)
       {

        $this->validate($request,[
            'courseName' => 'required|max:255',
            'course_details' => 'required'
        ]);

        $courses = new Course;
        $courses->courseName = $request->courseName;
        $courses->course_details = $request->course_details;

        $courses->save();
        return redirect('addcourses')->with('success','Course added successfully');
        
      }


public function addCoursefees(Request $request)
    {
        $collegeList = Colleges::orderBy('collegeName')->get();
        $courseList = Course::orderBy('courseName')->get();
        return view('addcoursefees',compact('collegeList','courseList'));
    }

 public function saveCoursefees(Request $request)
       {

        $this->validate($request,[
            'college_id' => 'required|max:255',
            'course_id' => 'required|max:255',
            'course_fees' => 'required|max:255',
            'course_type' => 'required|max:255',
            'course_duration' => 'required|max:255',
        ]);

        $courses = new Coursefees;
        $courses->college_id = $request->college_id;
        $courses->course_id = $request->course_id;
        $courses->course_fees = $request->course_fees;
        $courses->course_type = $request->course_type;
         $courses->course_duration = $request->course_duration;

        $courses->save();
        return redirect('addcourses')->with('success','Coursefees added successfully');
        
      }
  public function addCourseMapping(Request $request)
    {
        $collegeList = Colleges::orderBy('collegeName')->get();
        $courseList = Course::orderBy('courseName')->get();
        return view('addCourseMapping',compact('collegeList','courseList'));
    }

   public function saveCourseMapping(Request $request)
       {

        $this->validate($request,[
            'college_id' => 'required|max:255',
            'course_id' => 'required|max:255',
            
        ]);

        $coursesmapping = new Coursemapping;
        $coursesmapping->college_id = $request->college_id;
        $coursesmapping->course_id = $request->course_id;

        $coursesmapping->save();
        return redirect('addcoursemapping')->with('success','CourseMapping added successfully');
        
      }

      public function addAdmissionprocess(Request $request)
    {
        $collegeList = Colleges::orderBy('collegeName')->get();
        $courseList = Course::orderBy('courseName')->get();
        return view('addAdmissionProcess',compact('collegeList','courseList'));
    }

   public function saveAdmissionprocess(Request $request)
       {
       


        $admissionprocess= new Addmissionprocess;
        $admissionprocess->college_id = $request->college_id;
        $admissionprocess->course_id = $request->course_id;
        $admissionprocess->own_admission_process = $request->own_admission_process;
        if($request->own_admission_process== "true"){
            $admissionprocess->admission_process = $request->admission_process;
            $admissionprocess->admission_process_detail = $request->admission_process_detail;
                 
          }else{
            $admissionprocess->admission_process_link = $request->admission_process_link;
            $admissionprocess->admission_process_link_text = $request->admission_process_link_text;
            
        }
        
        
        

        $admissionprocess->save();
        return redirect('addadmissionprocess')->with('success','CourseMapping added successfully');
        
      }



       public function addFacilities(Request $request)
    {
        
        
        return view('addFacilities');
    }

   public function saveFacilities(Request $request)
       {

        $this->validate($request,[
            'facilitiesName' => 'required|max:255',
            
        ]);

        $facilities = new Facilities;
        $facilities->facilitiesName = $request->facilitiesName;
        
        $facilities->save();
        return redirect('addfacilities')->with('success','Facilities added successfully');
        
      }
       public function addCollegeFacilities(Request $request)
    {
        $collegeList = Colleges::orderBy('collegeName')->get();
        $facilitiesarray = array(
            ['facilitiesName' => 'Comp Labs'],
            ['facilitiesName' => 'Sports'],
            ['facilitiesName' => 'Cafeteria'],
            ['facilitiesName' => 'Library'],
            ['facilitiesName' => 'Auditorium'],
            ['facilitiesName' => 'Hostel'],
            ['facilitiesName' => 'Gym'],
            ['facilitiesName' => 'Laboratory'],
            ['facilitiesName' => 'Medical'],
            ['facilitiesName' => 'Classrooms'],
            ['facilitiesName' => 'Security'],
            ['facilitiesName' => 'Area'],
            ['facilitiesName' => 'Faculty'],
            ['facilitiesName' => 'Established']
        );
        $facilitiesList = json_decode(json_encode($facilitiesarray), FALSE);
        return view('addCollegeFacilities',compact('collegeList','facilitiesList'));
    }

   public function saveCollegeFacilities(Request $request)
       {

        $this->validate($request,[
            'college_id' => 'required|max:255',
            'facility_name' => 'required|max:255',
            'facility_value' => 'required|max:255'
        ]);

        $facilities = new Collegefacilities;
        $facilities->college_id = $request->college_id;
        $facilities->facility_name = $request->facility_name;
        $facilities->facility_value = $request->facility_value;


        $facilities->save();
        return redirect('addcollegefacilities')->with('success','collegefacilities added successfully');
        
      }

public function addHostel(Request $request)
    {
        $collegeList = Colleges::orderBy('collegeName')->get();
        $states = State::orderBy('state_name')->get();
        return view('addHostel',compact('states','collegeList'));
    }

   public function saveHosteles(Request $request)
       {

        $this->validate($request,[
            'college_id' => 'required|max:255',
            'hostel_name' => 'required|max:255',
            'hostel_facility' => 'required',
            'state_id' => 'required|max:255',
            'city' => 'required|max:255',
            'hostel_type' => 'required|max:255',
            'address_detail' => 'required',
        ]);

        $hostelfacilities = new Hosteles;
        $hostelfacilities->college_id = $request->college_id;
        $hostelfacilities->hostel_name = $request->hostel_name;
        $hostelfacilities->hostel_facility = $request->hostel_facility;
        $hostelfacilities->hostel_type = $request->hostel_type;
        $hostelfacilities->state_id = $request->state_id;
        $hostelfacilities->city = $request->city;
        $hostelfacilities->address_detail = $request->address_detail;

        $hostelfacilities->save();
        return redirect('addhostel')->with('success','Hosteles added successfully');
        
      }

    public function admissionProcess($collegeurl)
    {
        $data = [];
        $college = Colleges::select('*')
                    ->where('url', '=', $collegeurl)
                    ->first();
                  
        $state = State::select('*')
                ->where('id', $college['state_id'])
                ->first();
        
        
        $city = City::select('*')
                ->where('id', $college['city_id'])
                ->first();

           

        $data['college'] = $college;
        $data['college']['state_name'] = $state['state_name'];
        $data['college']['city_name'] = $city['city_name'];
        return view('admission-process', $data);
    }


     public function facilitie($collegeurl)
    {
        $data = [];
        $college = Colleges::select('*')
                    ->where('url', '=', $collegeurl)
                    ->first();
                  
        $state = State::select('*')
                ->where('id', $college['state_id'])
                ->first();
        
        
        $city = City::select('*')
                ->where('id', $college['city_id'])
                ->first();

         $course = Course::select('*')
                ->where('id', $college['course_id'])
                ->first();       

        $data['college'] = $college;
        $data['college']['state_name'] = $state['state_name'];
        $data['college']['city_name'] = $city['city_name'];
        return view('facilities', $data);
    }



    public function hostel($collegeurl)
    {
        $data = [];
        $college = Colleges::select('*')
                    ->where('url', '=', $collegeurl)
                    ->first();
                  
        $state = State::select('*')
                ->where('id', $college['state_id'])
                ->first();
        
        
        $city = City::select('*')
                ->where('id', $college['city_id'])
                ->first();

         $course = Course::select('*')
                ->where('id', $college['course_id'])
                ->first();       

        $data['college'] = $college;
        $data['college']['state_name'] = $state['state_name'];
        $data['college']['city_name'] = $city['city_name'];
        return view('hosteles', $data);
    }
}