<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

// Get published blog posts from database
$stmt = $con->prepare("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
$stmt->execute();
$blogPosts = $stmt->fetchAll();
?>

<!-- BLOGS SECTION -->
<section class="blogs-section" style="padding: 120px 0 80px 0; background-color: #faf9f5;">
    <div class="container">
        <div class="section_heading">
            <h2>Our Blog</h2>
            <div class="heading-line"></div>
            <p style="color: #666; margin-top: 20px; font-size: 18px;">Expert tips, trends, and insights from our professional barbers</p>
        </div>

        <div class="row">
            <?php if(empty($blogPosts)): ?>
                <div class="col-12 text-center">
                    <p style="color: #666; font-size: 18px;">No blog posts available at the moment. Check back soon!</p>
                </div>
            <?php else: ?>
                <?php foreach($blogPosts as $post): ?>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                            <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #9e8a78, #897666); display: flex; align-items: center; justify-content: center;">
                                <?php if($post['image_url']): ?>
                                    <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fas fa-cut" style="font-size: 60px; color: white;"></i>
                                <?php endif; ?>
                            </div>
                            <div class="blog-content" style="padding: 25px;">
                                <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                                    <i class="far fa-calendar-alt"></i> <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
                                </div>
                                <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                                    <?php echo htmlspecialchars($post['excerpt'] ?: substr(strip_tags($post['content']), 0, 150) . '...'); ?>
                                </p>
                                <?php if($post['tags']): ?>
                                    <div class="blog-tags" style="margin-bottom: 20px;">
                                        <?php 
                                            $tags = explode(',', $post['tags']);
                                            foreach($tags as $tag): ?>
                                                <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;"><?php echo htmlspecialchars(trim($tag)); ?></span>
                                            <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <a href="blog-post.php?id=<?php echo $post['post_id']; ?>" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                                    Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


    </div>
</section>

    <!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/logo.png" alt="Brand">
                        <p>
                            Our barbershop is the created for men who appreciate premium quality, time and flawless look.
                        </p>
                        <ul class="widget_social">
                            <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="TikTok"><i class="fab fa-tiktok fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                        198 West 21th Street, Suite 721, Noordvyk, Midrand 1687

                        </p>
                        <p>
                            contact@freshfade.com
                            <br>
                            +27 (011) 058 4889    
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 20:00pm</li>
                            <li>Saturday - Sunday 08:00am - 20:00pm</li>
                            <li>Public Holidays 11:30am - 2:00pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>Subscribe to our contents</h3>
                        <div class="subscribe_form">
                            <form action="#" class="subscribe_form" novalidate="true">
                                <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                                <button type="submit" class="submit">SUBSCRIBE</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
.blog-card:hover {
    transform: translateY(-5px);
}

.read-more:hover {
    color: #897666 !important;
}


</style>

<?php include "Includes/templates/footer.php"; ?>
