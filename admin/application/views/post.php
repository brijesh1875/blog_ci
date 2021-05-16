<!--Add the following script at the bottom of the web page (before </body></html>)-->

<div class="wraper container-fluid">
            <div class="page-title">
				<div class="row">
					<div class="col-md-10">
						<h3 class="title">Post</h3>
					</div>
					<div class="col-md-2">
						<h3 class="title"><a href="add_post"/>Add Post</a></h3>
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
                                          <th width="1%">#</th>
                                          <th width="5%">Category</th>
                                          <th width='15%'>Title</th>
                                          <th width="39%">Description</th>
                                          <th width="10%">Image</th>
                                          <th width="15%">Added On</th>
                                          <th width="15%">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                       if(isset($data[0]))
                                       {
                                          $i=1;
                                          foreach($data as $post){?>
                                          <tr>
                                             <td><?php echo $i;?></td>
                                             <td><?php echo $post->category_name; ?></td>
                                             <td><?php echo $post->title;?></td>
                                             <td><?php echo $post->description;?></td>
                                             <td>
                                                <img src='<?php echo IMAGE.$post->image; ?>' height='75' width='75'>
                                             </td>
                                             <td>
                                             <?php 
                                                $time = strtotime($post->added_on);
                                                echo date("d M Y h:iA",$time);  
                                             ?>
                                             </td>
                                             <td>
                                             <?php
                                                if($post->status == 1)
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
                                                <a href="<?php echo SITE_PATH; ?>update_status/post/<?php echo $status.'/'.$post->id; ?>" class="badge badge-<?php echo $class; ?>"><?php echo $txt; ?></a>
                                                <a href="<?php echo SITE_PATH; ?>add_post/<?php echo $post->id; ?>" class="badge badge-info ml-2">Edit</a>
                                                <a href="<?php echo SITE_PATH; ?>delete_category/post/<?php echo $post->id; ?>/true" class="badge badge-danger">Delete</a>
                                             </td>
                                          </tr>
                                          <?php $i++;}
                                       }

                                       else
                                          {
                                             echo "<tr><td colspan='6'>No data found</td></tr>";
                                          }?>
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
         