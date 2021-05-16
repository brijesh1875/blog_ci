
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('<?php echo SITE_PATH; ?>uploads/<?php echo $post[0]->image; ?>')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="post-heading">
                            <h1><?php echo $post[0]->title; ?></h1>
                            <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
                            <span class="meta">
                                Posted by Admin on <?php echo $post[0]->added_on; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <?php echo $post[0]->description; ?>
                    </div>
                </div>
            </div>
        </article>
        <hr />