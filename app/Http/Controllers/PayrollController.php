<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Leave;
use App\Loan;
use App\Department;
use App\Grade;
use App\Employeetype;
use Mail;

class PayrollController extends Controller
{
    public function mgt_loan_approve(Request $request, Loan $users)
		{
			
			$this->validate($request, [
				'mgt_status' => 'required',
			]);

			$users->mgt_status = $request->mgt_status;
			$users->update();

			$status  = $request->mgt_status;
			$user_id  = $request->user_id;
			$userinfo = User::find($user_id);
			$applicant_name  =  $userinfo->name;
			$applicant_email =  $userinfo->email;



					  



  //emails

/*
  //sending mail to applicant that hr approves or disapprove
  Mail::send('mail.loan_status_mail', array('applicant_name'=> $applicant_name,'status'=> $status), function($message) use ($applicant_email)
  {
	  $message->to($applicant_email,'TFOLC LEAVE APP')->subject('Update on your Loan Application!');
  });  


  //sending mail to payroll manager that hr approves 

  if($status = "approve"){

	  //get payroll email
	  $user = User::where('loan_roles_id',3)->first();
	  $gmemail = $user->email;


  Mail::send('mail.loan_status_mail', array('applicant_name'=> $applicant_name,'status'=> $status), function($message) use ($gmemail)
  {
	  $message->to($gmemail,'TFOLC LEAVE APP')->subject('Loan Application for approval!');
  });  

   }

*/

   $request->Session()->flash('message.content', 'Operation was carried out successfully!');
   $request->session()->flash('message.level', 'success');
			return redirect('admins/loan_applications');
				//return view('admins.requests', compact('users'));

		}
}
