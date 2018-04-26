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
					$request->Session()->flash('message.content', 'Operation was carried successfully!');
				  	$request->session()->flash('message.level', 'success');
			return redirect('admins/loan_applications');
				//return view('admins.requests', compact('users'));

		}
}
