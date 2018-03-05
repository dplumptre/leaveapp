<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Leave;
use App\Department;
use App\Grade;
use App\Employeetype;
use Mail;

class AdminsController extends Controller
{
	
	public function __construct(){
		$this->middleware('admin');
	}


	public function view_dept()
	{
		$departments = Department::all();
		return view('admins/departments', compact('departments'));
	}

	public function add_dept()
	{
		return view('admins/add_dept');
	}

	public function store_dept(Request $request)
	{
		$this->validate($request, ['name' => 'required|string|max:255', ]);

		$dept = new Department;
		$dept->name = $request->name;
		
		if ($dept->save()) {
				$request->Session()->flash('message.content', 'Department was successfully added!');
			  	$request->session()->flash('message.level', 'success');
		}
		return redirect('admins/departments');

	}


	public function delete_dept(Department $dept){
		$dept->delete($dept);
		return redirect('admins/departments');
	}



	public function view_grades()
	{
		$grades = Grade::all();
		return view('admins/grades', compact('grades'));
	}

	public function add_grade()
	{
		return view('admins/add_grade');
	}

	public function store_grade(Request $request)
	{
		$this->validate($request, ['level' => 'required|string|max:255', ]);

		$grade = new Grade;
		$grade->level = $request->level;
		
		if ($grade->save()) {
			$request->Session()->flash('message.content', 'Grade Level was successfully added!');
		  	$request->session()->flash('message.level', 'success');
		}
		return redirect('admins/grades');

	}


	public function delete_grade(Grade $grade){
		$grade->delete($grade);
		return redirect('admins/grades');
	}




	public function view_employee_type()
	{
		$employee_types = Employeetype::all();
		return view('admins/employee_type', compact('employee_types'));
	}

	public function add_employee_type()
	{
		return view('admins/add_employee_type');
	}

	public function store_employee_type(Request $request)
	{
		$this->validate($request, ['employee_type' => 'required|string|max:255', ]);

		$employee_type = new Employeetype;
		$employee_type->employee_type = $request->employee_type;
		
		if ($employee_type->save()) {
				$request->Session()->flash('message.content', 'Employee Type was successfully added!');
			  	$request->session()->flash('message.level', 'success');
		}
		return redirect('admins/employee_type');

	}


	public function delete_employee_type(Employeetype $type){
		$type->delete($type);
		return redirect('admins/employee_type');
	}



	public function reset()
	{
		return view('admins/reset');
	}


	public function reset_column()
	{

		$resetLeave = Leave::where('days_hr_approved', '>', 0)->update(array('days_hr_approved' => 0));
		$resetAllowance = Leave::where('allowance', '>', 0)->update(array('allowance' => 0));

		$request->Session()->flash('message.content', 'RESET was successfully executed!');
	  	$request->session()->flash('message.level', 'success');

		return redirect('admins/reset');
	}




	public function all_users(){
		$employees = User::orderBy('department', 'desc')->orderBy('role', 'desc')->get();
		return view('admins.users', compact('employees'));
	}


	public function show($id){
		$users = User::find($id);
		return view('admins.show', compact('users'));
	}

	public function show_search($search){
		$users = User::find($search);
		return view('admins.search_result', compact('users'));
	}

	public function search_page(){
		return view('admins.search');
	}


	public function search(Request $request){

		$search = $request->search;
		
		$users = User::where('name', 'LIKE', "%$search%")->get();
		//$users = User::find($search);

		return view('admins.search_result', compact('users'));
	}


	public function create()
	{
		$departments = Department::all();
		$grades = Grade::all();
		$employee_types = Employeetype::all();

		return view('admins.create', compact('departments', 'grades', 'employee_types'));

	}

	public function store_user(Request $request, User $user)
	{

		$this->validate($request, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'department' => 'required',
			'entitled' => 'required',
			'job_title' => 'required|string|max:100',
			'date_of_hire' => 'required|date:dd-mm-yyyy',
		]);


		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->role = $request->role;
		$user->password = bcrypt($request->password);
		$user->marital_status = $request->marital_status;
		$user->gender = $request->gender;
		$user->department = $request->department;
		$user->grade = $request->grade;
		$user->employee_type = $request->employee_type;
		$user->date_of_hire = $request->date_of_hire;
		$user->job_title = $request->job_title;
		$user->entitled = $request->entitled;




		if(isset($request->role) && $request->role == "supervisor"){
			
			$check = User::where('role', '=', 'supervisor')
			->where('department', '=', $request->department)->count();

			if ($check > 0 ) {

				
				$request->session()->flash('flash_message', 'A supervisor already exist in this department!');
				$request->session()->flash('flash_type', 'alert-danger');


				return redirect('admins/create');	
			}
			
		}

		$user->save();

		$request->session()->flash('flash_message', 'New User creation was successfull!');
		$request->session()->flash('flash_type', 'alert-success');

		return redirect('admins/create');	


	} //end




	public function edit_user(User $user)
	{
		$departments = Department::all();
		$grades = Grade::all();
		$employee_types = Employeetype::all();

		return view('admins/edit', compact('user', 'departments', 'grades', 'employee_types'));
	}

	public function update_user(Request $request, User $user)
	{

		if(isset($request->role) && $request->role == "supervisor"){

			$check = User::where('role', '=', 'supervisor')
			->where('department', '=', $request->department)->count();
			
			if ($check > 0 ) {

				Session()->flash('flash_message', 'A supervisor already exist in this department!');
				Session()->flash('flash_type', 'alert-danger');
				return redirect('admins/users');	
			}

		}

		$user->update($request->all());
			$request->Session()->flash('message.content', 'Employee details was successfully updated!');
		  	$request->session()->flash('message.level', 'success');

		return redirect('admins/users');
		
	}

	public function delete_user(User $user){
		    //$users = User::find($user);

		$user->delete($user);
		return redirect('admins/users');
	}


	public function show_all_leave_request(Request $request){
		$users = $request->user();
		$requests = Leave::orderBy('id', 'desc')->get();

							// $requests = Leave::orderBy('id', 'desc')
							// ->paginate(50);
		return view('admins.requests', compact('users', 'requests'));
	}


	public function show_all_leave_return(Request $request){
		$users = $request->user();
		$requests = Leave::orderBy('id', 'desc')->paginate(50);
		return view('admins.return', compact('users', 'requests'));
	}



	public function application_status(Request $request){
		$users = $request->user();
		$requests = Leave::orderBy('id', 'desc')->paginate(50);
        //$requests = Leave::paginate(3);
		return view('admins.application_status', compact('users', 'requests'));
	}


	public function admin_edit(Leave $users)
	{

		$app_email = User::find($users->user_id);
		$applicant_email = $app_email->email;

		return view('admins/admin_edit', compact('users','applicant_email'));
	}


	public function admin_approval(Request $request, Leave $users)
	{

		$applicant_name = $request->applicant_name;
		$applicant_email = $request->applicant_email;



		
		$this->validate($request, [
			'hr_signature' => 'required',
		]);

		$users->admin_name = $request->user()->admin_name;
		if ($users->update($request->all())) {
			//$users->update();
			
			if($request->admin_approval_status == "Approved"){

				Mail::send('mail.approved_mail', array('applicant_name'=> $applicant_name), function($message) use ($applicant_email) 
				{
					$message->to($applicant_email,'TFOLC LEAVE APP')->subject('Your Leave has been approved!');
				});  

			}

			
			if($request->admin_approval_status == "Rejected"){
				
				Mail::send('mail.failmailtwo', array('applicant_name'=> $applicant_name), function($message) use ($applicant_email)
				{
					$message->to($applicant_email,'TFOLC LEAVE APP')->subject('Result of your Leave Application!');
				});  

			}
				$request->Session()->flash('message.content', 'Leave status was successfully updated!');
			  	$request->session()->flash('message.level', 'success');
		}
		return redirect('admins/requests');
			//return view('admins.requests', compact('users'));

	}



	public function admin_confirm(Leave $users)
	{
		return view('admins/admin_confirm', compact('users'));
	}


	public function admin_confirmation(Request $request, Leave $users)
	{
		
		$this->validate($request, [
			'hr_confirm_signature' => 'required',
		]);

		$users->admin_name = $request->user()->admin_name;
		if ($users->update($request->all())) {
			//$users->update();
				$request->Session()->flash('message.content', 'Leave Return was successfully confirmed!');
			  	$request->session()->flash('message.level', 'success');
		}
		return redirect('admins/return');
			//return view('admins.requests', compact('users'));

	}



	public function leave_history($user){
		$users = User::find($user);
		return view('admins.history', compact('users'));
	}




}
