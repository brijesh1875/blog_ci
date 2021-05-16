<!--Add the following script at the bottom of the web page (before </body></html>)-->


<div class="wraper container-fluid">
            <div class="page-title">
               <h3 class="title"><?php echo $section; ?> Post</h3>
            </div>
            <div class="row">
               
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-body">
                           <?php 
                              echo "<p class='text-center text-danger'>$error</p>";
                              echo form_open_multipart(SITE_PATH."insert_post",["class" => "form-horizontal"]);
                              if($id != '')
                                 echo form_hidden("id",$id);
                           ?>
                           <div class="form-group">
                              <label class="col-sm-3 control-label">Title</label>
                              <div class="col-sm-9">
                                 <input type="textbox" class="form-control" id="title" name="title" placeholder="Enter Title" value="<?php echo $title; ?>" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-3 control-label">Category</label>
								<div class="col-sm-9">
									 <select class="form-control" name="category_id" required="">
										<option disabled selected value="-1">Select Category</option>
                              <?php foreach ($category_name as $category) {?>
										<option value="<?php echo $category->id; ?>"<?php if($cat_id==$category->id){ echo "selected";} ?>><?php echo $category->category_name ?></option>
                           <?php } ?>
									 </select>
								</div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-3 control-label">Image</label>
                              <div class="col-sm-9">
                                 <input type="file" class="form-control" id="image" name="img" placeholder="Select Image" <?php if($id==''){echo "required";} ?>>
                              </div>
                           </div>
                           
						   <div class="form-group">
                              <label class="col-sm-3 control-label" required>Description</label>
                              <div class="col-sm-9">
                                  <textarea class="form-control" rows="5" cols="10" name="description" required><?php echo $description; ?></textarea>
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
         