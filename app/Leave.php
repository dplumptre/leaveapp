<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    
    protected $fillable = array(
		
		'leave_starts', 
		'leave_ends', 
		'reason', 
		'working_days_no',
        'balance', 
        'unit_head_name', 
        'approval_status', 
        'admin_approval_status',
        'date_unithead_approved', 
        'signature',
		'mobile',
		'leave_type',
		'resumption_date',
		'reliever_name',
		'leave_address',
		'unithead_remark',
		'admin_name',
		'admin_approval_status',
		'admin_remark',
		'date_admin_approved',
		'days_hr_approved',
		'hr_signature',

		'returnee_timestamp',
		'resumed_on',
		'reason_unable',
		'returnee_signature',
		'supervisor_confirmation',
		'super_confirm_signature',
		'date_signed',
		'admin_remark',
		'hr_confirm_signature',





        );
    
 public function users()
    {
       return $this->belongsTo(User::class);
    }
    




}
