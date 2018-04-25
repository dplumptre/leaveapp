<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Leave;
use App\Loan;
use App\Grade;
use App\Department;
use App\Employeetype;
use Mail;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

     public function access_denied()
    {
        return view('access_denied');
    }

     
   public function view_profile($id){


	    $users = User::find($id);
	    return view('profile', compact('users'));
	}
    

    
	public function edit_profile(User $user)
	{
		$departments = Department::all();
		$grades = Grade::all();
		$employee_types = Employeetype::all();

		return view('edit', compact('user', 'departments', 'grades', 'employee_types'));
		
	}


	public function update_profile(Request $request, User $user)
	{

		if ($user->update($request->all())) {		
			$request->Session()->flash('message.content', 'Your profile was successfully updated!');
		  	$request->session()->flash('message.level', 'success');
		}
		return back();
	}

    
    public function application(Request $request)
    {
    	$user_id = Auth::user()->id; 	
        $leave = Leave::where('user_id', '=', $user_id)
        				->where('allowance', '>', 0)
        				->where('approval_status', '=', "Approved")
        				->where('admin_approval_status', '=', "Approved")
        				->where('days_hr_approved', '>', 0)->get();
        $allowance = $leave->count();

		$requests = User::where('role', '=', 'supervisor')
						->where('department', '=', $request->user()->department)->get();

		$relievers = User::where('department', '=', $request->user()->department)->get();
        return view('apply', compact('requests', 'relievers', 'allowance'));

    }


    public function store_application(Request $request, Leave $leave, User $user)
	{


		$this->validate($request, [
            'reason' => 'required|string|max:255',
            'working_days_no' => 'required|integer',
            //'reliever_name' => 'required|string',
            'leave_address' => 'required|string',
            'leave_starts' => 'required|date:dd-mm-yyyy|after:yesterday',
            'leave_ends' => 'required|date:dd-mm-yyyy|after:leave_starts',
            'resumption_date' => 'required|date:dd-mm-yyyy|after:leave_ends',
            //'date_unithead_approved' => 'required',
            //'signature' => 'required',
			]);



		$leave = new Leave;
		$leave->leave_starts = $request->leave_starts;
		$leave->leave_ends = $request->leave_ends;
		$leave->working_days_no = $request->working_days_no;
		$leave->resumption_date = $request->resumption_date;
		$leave->reason = $request->reason;
		$leave->reliever_name = $request->reliever_name;
		$leave->leave_address = $request->leave_address;
		$leave->allowance = $request->allowance;
		$leave->approval_status = $request->approval_status;
		$leave->mobile = $request->mobile;
		$leave->leave_type = $request->leave_type;
		$leave->unit_head_name = $request->unit_head_name;
				
		$leave->user_id = $request->user()->id;
		$leave->name = $request->user()->name;
		$leave->department = $request->user()->department;
		$leave->grade = $request->user()->grade;
		//$leave->save();

		if ($leave->save()) {
		
			$request->Session()->flash('message.content', 'Your leave application was successful!');
		  	$request->session()->flash('message.level', 'success');

				#SEND EMAIL
				$supervisor = $request->unit_head_name;
				$supervisor_email = $request->unit_head_email;
				$applicant_name = $request->user()->name;
				$applicat_email = $request->user()->email;


				if($supervisor_email == "" || empty($supervisor_email)){

					$hremails = User::where('role', '=', 'admin')
					->where('department', '=', 'Human Resource')->first();


					$supervisor_email = $hremails->email;
				}


				Mail::send('mail.firstmail', array('supervisor'=> $supervisor,'applicant_name'=> $applicant_name), function($message) use ($supervisor_email) 
				{
					$message->to($supervisor_email,'TFOLC LEAVE APP')->subject('Leave Request has been sent to you');
				});  			
			
		}
		return back();
	}


   public function status($users){         
        $users = User::find($users);
	    return view('status', compact('users'));
    }


   public function all_leave_status(Request $request){
 		$users = $request->user();
        $requests = Loan::orderBy('id', 'desc')->paginate(50);
        //$requests = Leave::paginate(3);
        return view('all_leaves', compact('users', 'requests'));
    }


	public function supervisor_approval(Request $request){

		$uhDept = $request->user()->department;
		
		$requests = Leave::where('department', '=', "$uhDept")->orderBy('id', 'desc')->get();

	    return view('supervisor_approval', compact('requests'));
	}


    

    public function supervisor(Leave $users)
	{
		//$leave = User::find($leave);
		return view('supervisor', compact('users'));
	}


	public function supervisor_update(Request $request, Leave $users)
	{

		$this->validate($request, [
           'date_unithead_approved' => 'required',
           'signature' => 'required',
			]);


			$hremails = User::where('role', '=', 'admin')
			->where('department', '=', 'Human Resource')->get();




			//$email = $email->email;
			$staff = User::find($request->user_id);
			$staff_email = $staff->email;





		if ($users->update($request->all())) 
		{
			//$users->update();
			if($request->approval_status == "Approved"){

				$applicant_name = $request->applicant_name;
				$unit = $request->unit;

       #SENDING MAIL TO HR COS SUPERVISOR HAS APPROVED

				foreach($hremails as $hremail){
					Mail::send('mail.admin_reminder_to_approve', array('applicant_name'=> $applicant_name,'unit'=> $unit), function($message) use ($hremail)
				{
					$message->to($hremail->email,'TFOLC LEAVE APP')->subject('Result of your Leave Application!');
				}); 				
				}

#SENDING TO USER THAT SUPERVISOR HAS APPROVED
				Mail::send('mail.approvestatusone', array('applicant_name'=> $applicant_name,'unit'=> $unit), function($message) use ($staff)
				{
					$message->to($staff->email,'TFOLC LEAVE APP')->subject('Status of your leave application!');
				});  

				
			}



			
			if($request->approval_status == "Rejected"){
				
								$applicant_name = $request->applicant_name;
								$unit = $request->unit;
				
				//sending mail to staff cos it was rejected by supervisor got the user_id from the supervispr,blade
				
								Mail::send('mail.failmail', array('applicant_name'=> $applicant_name,'unit'=> $unit), function($message) use ($staff)
								{
									$message->to($staff->email,'TFOLC LEAVE APP')->subject('Result of your Leave Application!');
								});  
				
							} 
		
				$request->Session()->flash('message.content', 'Leave status was successfully updated!');
			  	$request->session()->flash('message.level', 'success');

		}
		return redirect('supervisor_approval');

	}


	public function leave_return(Leave $users)
	{ 
		//$leave = User::find($leave);
		return view('leave_return', compact('users'));
	}


	public function leave_return_update(Request $request, Leave $users, User $user)
	{
		$this->validate($request, [
           'resumed_on' => 'required',
           'returnee_signature' => 'required',
			]);

		$user = $request->user()->id;

		if ($users->update($request->all())) {
		
			$request->Session()->flash('message.content', 'Leave return form status was successfully submitted!');
		  	$request->session()->flash('message.level', 'success');

			
		}
		
		return redirect()->action(
   		 'HomeController@status', ['id' => $request->user()->id]
		);
	}


public function uh_confirmation(Leave $users)
	{ 
		return view('uh_confirmation', compact('users'));
	}


	public function uh_confirmation_update(Request $request, Leave $users, User $user)
	{
		$this->validate($request, [
           'super_confirm_signature' => 'required',
			]);

		$user = $request->user()->id;

		if ($users->update($request->all())) {
		
			$request->Session()->flash('message.content', 'User Resumption status was successfully updated!');
		  	$request->session()->flash('message.level', 'success');
		}
		return redirect('supervisor_approval');
		
	}










//-----------------------------------------------------------------
//EVERYTHING LOAN
//-----------------------------------------------------------------


	public function loan_application(Request $request)
	{
		$user_id = Auth::user()->id; 	
       
		 $requests = User::where('id', '=', '$user_id')->get();

		$relievers = User::where('department', '=', $request->user()->department)->get();
        return view('loan_application', compact('requests', 'relievers', 'allowance'));
	}






public function store_loan(Request $request, Loan $loan, User $user)
	{


		$this->validate($request, [
            'amount' => 'required|digits_between:4,9',
            'installment' => 'required|digits_between:4,9',
            'purpose' => 'required|string',
            'deduction_start' => 'required',
			]);



		$loan = new Loan;
		$loan->amount = $request->amount;
		$loan->installment = $request->installment;
		$loan->purpose = $request->purpose;
		$loan->deduction_start = $request->deduction_start;
		$loan->loan_status = $request->loan_status;
		$loan->amount_approved = 0;
		$loan->hr_status = "Pending";
		$loan->mgt_status = "Pending";
		$loan->gm_status = "Pending";
				
		$loan->user_id = $request->user()->id;
		//$leave->save();

		if ($loan->save()) {
		
			$request->Session()->flash('message.content', 'Your loan application was successful!');
		  	$request->session()->flash('message.level', 'success');

				#SEND EMAIL
				// $supervisor = $request->unit_head_name;
				// $supervisor_email = $request->unit_head_email;
				// $applicant_name = $request->user()->name;
				// $applicat_email = $request->user()->email;


				// if($supervisor_email == "" || empty($supervisor_email)){

				// 	$hremails = User::where('role', '=', 'admin')
				// 	->where('department', '=', 'Human Resource')->first();


				// 	$supervisor_email = $hremails->email;
				// }


				// Mail::send('mail.firstmail', array('supervisor'=> $supervisor,'applicant_name'=> $applicant_name), function($message) use ($supervisor_email) 
				// {
				// 	$message->to($supervisor_email,'TFOLC LEAVE APP')->subject('Leave Request has been sent to you');
				// });  			
			
		
		}


		return back();
	}


//Loan status of all Users
   public function loan_status($users){      
   	
        // $users = Loan::find($users);
        $user_id = Auth::user()->id; 
        $user_loan_status = Loan::where('user_id', '=', $user_id)->count();

        $users = Loan::where('user_id', '=', $users)->orderBy('id', 'desc')->get();
	    return view('loan_status', compact('users', 'user_loan_status'));
    }



//Loan status of a particular User
   public function user_loan_status($users){      
		$user_loan_status = Loan::where('user_id', '=', $users)->count();
        $users = Loan::where('user_id', '=', $users)->orderBy('id', 'desc')->get();

	    return view('user_loan_status', compact('users', 'user_loan_status'));
    }




public function loan_info($loan_id)
	{
		$users = Loan::where('id', '=', $loan_id)->get();

        return view('/loan_info', compact('users'));
	}



	public function complete_status(Request $request, Loan $users)
	{

		$this->validate($request, [
			'complete_status' => 'required',
		]);

		$users->complete_status = $request->complete_status;
		$users->update();
		$request->Session()->flash('message.content', 'Status was successfully Updated!');
		$request->session()->flash('message.level', 'success');
		return redirect()->back();
				//return view('admins.requests', compact('users'));

	}





public function loan_edit($loan_id)
	{
		$users = Loan::where('id', '=', $loan_id)->get();
        return view('/loan_edit', compact('users'));
	}



	public function update_loan_edit(Request $request, Loan $users)
	{

		$this->validate($request, [
            'amount' => 'required|digits_between:4,9',
            'installment' => 'required|digits_between:4,9',
            'purpose' => 'required|string',
            'deduction_start' => 'required',
			]);


		$users->amount = $request->amount;
		$users->installment = $request->installment;
		$users->purpose = $request->purpose;
		$users->deduction_start = $request->deduction_start;
		$users->loan_status = $request->loan_status;
				
		$users->update();
		$request->Session()->flash('message.content', 'Loan update was successfull!');
		$request->session()->flash('message.level', 'success');

        $user_id = Auth::user()->id; 

	    $user_loan_status = Loan::where('user_id', '=', $user_id)->count();
        $users = Loan::where('user_id', '=', $user_id)->orderBy('id', 'desc')->get();

	    return view('user_loan_status', compact('users', 'user_loan_status'));
		

	}




	public function loan_delete(Loan $users){
		$users->delete($users);
		Session()->flash('message.content', 'Loan application was successfully deleted!');
		session()->flash('message.level', 'success');
		return redirect()->back();
	}




	public function repayment_status(Request $request, Loan $users)
	{

		$this->validate($request, [
			'repayment_status' => 'required',
		]);

		$users->repayment_status = $request->repayment_status;
		$users->update();
		$request->Session()->flash('message.content', 'Status was successfully Updated!');
		$request->session()->flash('message.level', 'success');
		return redirect()->back();
				//return view('admins.requests', compact('users'));

	}







}
