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
				'amount_approved' => 'required|digits_between:4,9',
				'gm_status' => 'required',
			]);

			$users->gm_status = $request->gm_status;
			$users->amount_approved = $request->amount_approved;
			$users->update();
					$request->Session()->flash('message.content', 'Loan was successfully approved!');
				  	$request->session()->flash('message.level', 'success');
			return redirect('admins/loan_applications');
				//return view('admins.requests', compact('users'));

		}
    
}
