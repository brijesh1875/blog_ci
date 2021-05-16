
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('<?php SITE_PATH ?>template/assets/img/contact.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <?php if(isset($posts[0])){ 
                        foreach($posts as $post){?>
                    <div class="post-preview">
                        <a href="post/<?php echo $post->id; ?>">
                            <h2 class="post-title"><?php echo $post->title; ?></h2>
                            <h3 class="post-subtitle"><?php echo $post->description; ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            Admin
                            on <?php echo $post->added_on ?>
                        </p>
                    </div>
                    <hr />
                <?php }} else{?>
                    <div class="post-preview">
                        <a>
                            <h2 class="post-title">No Posts available</h2>
                        </a>
                    </div>
                <?php }?>
                    
                </div>
            </div>
        </div>
        <hr />
        
