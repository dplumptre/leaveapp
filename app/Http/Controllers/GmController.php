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

class GmController extends Controller
{
    
     public function gm_loan_approve(Request $request, Loan $users)
		{
			
			$this->validate($request, [
				'amount_approved' => 'digits_between:4,9',
				'gm_status' => 'required',
			]);

			$users->gm_status = $request->gm_status;
			$users->amount_approved = $request->amount_approved;



			$status  = $request->gm_status;


			if(  ($status == "Approved") && ($request->amount_approved =="") ){
			 $request->Session()->flash('message.content', 'Amount Required!');
			 $request->session()->flash('message.level', 'danger');
			 return back();
			}




			$users->update();

					  



       //email




	   $user_id  = $request->user_id;
	   $userinfo = User::find($user_id);
	   $applicant_name  =  $userinfo->name;
	   $applicant_email =  $userinfo->email;



				 



//emails

/*
//sending mail to applicant that hr approves or disapprove
Mail::send('mail.approved_loan_final_mail', array('applicant_name'=> $applicant_name, function($message) use ($applicant_email)
{
 $message->to($applicant_email,'TFOLC LEAVE APP')->subject('Update on your Loan Application!');
});  
*/

$request->Session()->flash('message.content', 'Operation was carried out successfully!');
$request->session()->flash('message.level', 'success');

			return redirect('admins/loan_applications');
				//return view('admins.requests', compact('users'));

		}
    
}
