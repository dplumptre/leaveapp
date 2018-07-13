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
			$users->mgt_comment = $request->mgt_comment;


			$status = $request->mgt_status;

			if(  ($status == "Rejected") && ($request->mgt_comment =="") ){
				$request->Session()->flash('message.content', 'Please enter reason for rejecting in the comment box');
				$request->session()->flash('message.level', 'danger');
				return back();
			}



			$users->update();

			$status  = $request->mgt_status;
			// $comment = $request->mgt_comment;

			$user_id  = $request->user_id;
			$userinfo = User::find($user_id);
			$applicant_name  =  $userinfo->name;
			$applicant_email =  $userinfo->email;



					  



  //emails


  //sending mail to applicant that hr approves or disapprove
  Mail::send('mail.approved_loan_mail', array('applicant_name'=> $applicant_name,'status'=> $status), function($message) use ($applicant_email)
  {
	  $message->to($applicant_email,'TFOLC LEAVE APP')->subject('Update on your Loan Application!');
  });  


  //sending mail to payroll manager that hr approves 

  if($status = "approve"){

	  $lu= Loan_role::where('slug','general-manager')->first();
	  $ul= User::where('loan_roles_id',$lu->id)->first();
	  $gmemail = $ul->email;


	  Mail::send('mail.gm_reminder_to_approve_loan', array('applicant_name'=> $applicant_name,'status'=> $status), function($message) use ($gmemail)
  {
	  $message->to($gmemail,'TFOLC LEAVE APP')->subject('Loan Application for approval!');
  });  

   }



   $request->Session()->flash('message.content', 'Operation was carried out successfully!');
   $request->session()->flash('message.level', 'success');
			return redirect('admins/loan_applications');
				//return view('admins.requests', compact('users'));

		}
}
