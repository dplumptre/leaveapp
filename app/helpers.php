<?php
	
use  App\Loan;
use  App\Leave;
use  App\User;
use  App\Loan_role;


	function status($state){

		 $pending = "\"btn btn-warning btn-xs\"";
         $approved = "\"btn btn-success btn-xs\"";
         $rejected = "\"btn btn-danger btn-xs\"";

         $status = $state;

         if(($status == "Approved") or ($status == "approved")){
          echo $approved;
         }

         elseif(($status == "Rejected") or ($status == "rejected")){
          echo $rejected;
         }

         else{
          echo $pending;
         }
         return $state;
	}

?>

<?php
  function status1($state){

     $pending = "\"btn btn-warning btn-xs\"";
         $approved = "\"btn btn-success btn-xs\"";
         $rejected = "\"btn btn-danger btn-xs\"";

         $status = $state;

         if(($status == "Approved") || ($status == "approved")){
          echo $approved;
         }

         elseif(($status == "Rejected") || ($status == "rejected")){
          echo $rejected;
         }

         else{
          echo $pending;
         }
         return $state;
  }

function getAllowance($status){

         if($status == 1){
          echo "YES";
         }

         else{
          echo  "*";
         }
  }




  function getName($id)
  {
    $user = User::where('id', '=',  $id)->first();
    echo $user->name;
  }



  function getStatus($status){

   if($status == 1){
    echo "YES";
  }

  else{
    echo  "No";
  }
}




  function getLoanRole($id)
  {
    $Loan_role = Loan_role::where('id', '=',  $id)->first();
    if (!$Loan_role) {
      echo "None";
    }
    else {
      echo $Loan_role->role;
    }
  }




?>