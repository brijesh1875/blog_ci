
<div class="wraper container-fluid">
            <div class="page-title">
               <h3 class="title"><?php echo $section; ?> Category</h3>
            </div>
            <div class="row">
               
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <form class="form-horizontal" role="form" action='<?php echo SITE_PATH; ?>insert_category' method="post">
                           <?php 
                              if($id!='')
                              {
                                 echo "<input type='hidden' name='id' value='$id'>";
                              }
                           ?>
                           <div class="form-group">
                              <label class="col-sm-3 control-label">Category</label>
                              <div class="col-sm-9">
                                 <input type="textbox" name='name' value='<?php echo $category_name; ?>' class="form-control" id="category" placeholder="Enter Category">
                              </div>
                           </div>
                           <div class="form-group m-b-0">
                              <div class="col-sm-offset-3 col-sm-9">
                                 <button type="submit" class="btn btn-info"><?php echo $section; ?></button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <!-- panel-body -->
                  </div>
                  <!-- panel -->
               </div>
               <!-- col -->
            </div>
            <!-- End row -->
            
         </div>
         