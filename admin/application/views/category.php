<div class="wraper container-fluid">
            <div class="page-title">
				<div class="row">
					<div class="col-md-10">
						<h3 class="title">Category</h3>
					</div>
					<div class="col-md-2">
						<h3 class="title"><a href="<?php echo SITE_PATH; ?>add_category"/>Add Category</a></h3>
					</div>
				</div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>S.No</th>
                                          <th>Category</th>
                                          <th>Added On</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       if(isset($data[0]))
                                       {
                                          $i=1;
                                          foreach ($data as $category) {?>
                                             <tr>
                                                <td width="2%"><?php echo $i; ?></td>
                                                <td width=38%><?php echo $category->category_name; ?></td>
                                                <td width="30%">
                                                 <?php 
                                                   $time = strtotime($category->added_on);
                                                   echo date("d M Y h:iA",$time);  
                                                ?>
                                                </td>
                                               <td width="20%">
                                                <?php
                                                   if($category->status == 1)
                                                   {
                                                      $class='success';
                                                      $txt = 'Active';
                                                      $status=0;
                                                   } 
                                                   else
                                                   {
                                                      $class = 'danger';
                                                      $txt = 'Deactive';
                                                      $status = 1; 
                                                   }
                                                ?>
                                                   <a href="<?php echo SITE_PATH; ?>update_status/category/<?php echo $status.'/'.$category->id; ?>" class="badge badge-<?php echo $class; ?>"><?php echo $txt; ?></a>
                                                   <a href="<?php echo SITE_PATH; ?>add_category/<?php echo $category->id; ?>" class="badge badge-info ml-2">Edit</a>
                                                   <a href="<?php echo SITE_PATH; ?>delete_category/category/<?php echo $category->id; ?>" class="badge badge-danger">Delete</a>
                                               </td>
                                             </tr>   
                                          <?php $i++;
                                          }
                                       }
                                       else
                                       {
                                          echo "<tr>".
                                                   "<td colspan='4'>No category found</td>".
                                                "</tr>";
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
         