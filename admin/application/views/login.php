<?php 
$msg='';
if(isset($status_code))
{
   if($status_code == 404)
      $msg='Invalid username or password';
   else
      $msg='Deactivated User';

}
?>
<div class="wrapper-page animated fadeInDown">
         <div class="panel panel-color panel-primary">
            <div class="panel-heading">
               <h3 class="text-center m-t-10"> Sign In to <strong>Admin</strong> </h3>
            </div>
            <form class="form-horizontal m-t-40" action="auth_user" method="post">
               <div class="form-group ">
                  <div class="col-xs-12">
                     <input class="form-control" name="username" type="text" placeholder="Username" required>
                  </div>
               </div>
               <div class="form-group ">
                  <div class="col-xs-12">
                     <input class="form-control" type="password" name="password" placeholder="Password" required>
                  </div>
               </div>
               
               <div class="form-group text-right">
                  <div class="col-xs-12">
                     <button class="btn btn-purple w-md" type="submit">Log In</button>
                  </div>
               </div>
               <div class="text-center mt-2">
                  <span class="text-danger"><?php echo $msg; ?></span>
               </div>
            </form>
         </div>
      </div>
      