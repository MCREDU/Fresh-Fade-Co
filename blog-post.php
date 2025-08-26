<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

// Check if post ID is provided
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: blogs.php');
    exit();
}

$post_id = $_GET['id'];

// Get the specific blog post
$stmt = $con->prepare("SELECT bp.*, ba.full_name as author_name FROM blog_posts bp LEFT JOIN barber_admin ba ON bp.author_id = ba.admin_id WHERE bp.post_id = ? AND bp.status = 'published'");
$stmt->execute(array($post_id));
$post = $stmt->fetch();

// If post not found or not published, redirect to blogs page
if(!$post) {
    header('Location: blogs.php');
    exit();
}

// Get related posts (same tags or recent posts)
$stmt = $con->prepare("SELECT * FROM blog_posts WHERE status = 'published' AND post_id != ? ORDER BY created_at DESC LIMIT 3");
$stmt->execute(array($post_id));
$relatedPosts = $stmt->fetchAll();
?>

<!-- BLOG POST DETAIL SECTION -->
<section class="blog-post-detail" style="padding: 120px 0 80px 0; background-color: #faf9f5;">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" style="margin-bottom: 30px;">
            <ol class="breadcrumb" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="index.php" style="color: #9e8a78; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item"><a href="blogs.php" style="color: #9e8a78; text-decoration: none;">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #666;"><?php echo htmlspecialchars($post['title']); ?></li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Blog Post Content -->
            <div class="col-lg-8">
                <article class="blog-post-content" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <!-- Featured Image -->
                    <?php if($post['image_url']): ?>
                        <div class="blog-post-image" style="height: 400px; overflow: hidden;">
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="blog-post-image" style="height: 400px; background: linear-gradient(45deg, #9e8a78, #897666); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-cut" style="font-size: 80px; color: white;"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="post-content" style="padding: 40px;">
                        <!-- Post Header -->
                        <header class="post-header" style="margin-bottom: 30px;">
                            <h1 style="color: #333; font-size: 2.5rem; margin-bottom: 20px; line-height: 1.2;">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </h1>
                            
                            <!-- Post Meta -->
                            <div class="post-meta" style="color: #666; font-size: 16px; margin-bottom: 20px;">
                                <span style="margin-right: 20px;">
                                    <i class="far fa-calendar-alt" style="margin-right: 8px;"></i>
                                    <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
                                </span>
                                <?php if($post['author_name']): ?>
                                    <span style="margin-right: 20px;">
                                        <i class="far fa-user" style="margin-right: 8px;"></i>
                                        By <?php echo htmlspecialchars($post['author_name']); ?>
                                    </span>
                                <?php endif; ?>
                                <span>
                                    <i class="far fa-clock" style="margin-right: 8px;"></i>
                                    <?php 
                                        $wordCount = str_word_count(strip_tags($post['content']));
                                        $readingTime = ceil($wordCount / 200); // Average reading speed
                                        echo $readingTime . ' min read';
                                    ?>
                                </span>
                            </div>

                            <!-- Tags -->
                            <?php if($post['tags']): ?>
                                <div class="post-tags" style="margin-bottom: 25px;">
                                    <?php 
                                        $tags = explode(',', $post['tags']);
                                        foreach($tags as $tag): ?>
                                            <span style="background: #9e8a78; color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; margin-right: 10px; display: inline-block; margin-bottom: 8px;">
                                                <?php echo htmlspecialchars(trim($tag)); ?>
                                            </span>
                                        <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </header>

                        <!-- Post Body -->
                        <div class="post-body" style="line-height: 1.8; color: #444; font-size: 18px;">
                            <?php 
                                // Convert line breaks to HTML and preserve formatting
                                $content = nl2br(htmlspecialchars($post['content']));
                                echo $content;
                            ?>
                        </div>

                        <!-- Post Footer -->
                        <footer class="post-footer" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
                            <div class="post-share" style="text-align: center;">
                                <h5 style="color: #333; margin-bottom: 15px;">Share this post</h5>
                                <div class="social-share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" 
                                       target="_blank" class="btn btn-primary" style="margin: 0 5px;">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" 
                                       target="_blank" class="btn btn-info" style="margin: 0 5px;">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" 
                                       target="_blank" class="btn btn-secondary" style="margin: 0 5px;">
                                        <i class="fab fa-linkedin-in"></i> LinkedIn
                                    </a>
                                </div>
                            </div>
                        </footer>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Author Info -->
                <?php if($post['author_name']): ?>
                    <div class="sidebar-widget" style="background: white; border-radius: 15px; padding: 25px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <h4 style="color: #333; margin-bottom: 20px; font-size: 1.3rem;">About the Author</h4>
                        <div class="author-info">
                            <div class="author-avatar" style="width: 80px; height: 80px; background: linear-gradient(45deg, #9e8a78, #897666); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fas fa-user" style="font-size: 30px; color: white;"></i>
                            </div>
                            <h5 style="text-align: center; color: #333; margin-bottom: 10px;"><?php echo htmlspecialchars($post['author_name']); ?></h5>
                            <p style="text-align: center; color: #666; font-size: 14px; margin: 0;">
                                Professional barber and style expert with years of experience in men's grooming and styling.
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Related Posts -->
                <?php if(!empty($relatedPosts)): ?>
                    <div class="sidebar-widget" style="background: white; border-radius: 15px; padding: 25px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <h4 style="color: #333; margin-bottom: 20px; font-size: 1.3rem;">Related Posts</h4>
                        <div class="related-posts">
                            <?php foreach($relatedPosts as $relatedPost): ?>
                                <div class="related-post" style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                                    <?php if($relatedPost['image_url']): ?>
                                        <div class="related-post-image" style="width: 80px; height: 60px; float: left; margin-right: 15px; border-radius: 8px; overflow: hidden;">
                                            <img src="<?php echo htmlspecialchars($relatedPost['image_url']); ?>" 
                                                 alt="<?php echo htmlspecialchars($relatedPost['title']); ?>" 
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="related-post-content" style="overflow: hidden;">
                                        <h6 style="margin: 0 0 8px 0; line-height: 1.3;">
                                            <a href="blog-post.php?id=<?php echo $relatedPost['post_id']; ?>" 
                                               style="color: #333; text-decoration: none; font-size: 14px;">
                                                <?php echo htmlspecialchars($relatedPost['title']); ?>
                                            </a>
                                        </h6>
                                        <small style="color: #999; font-size: 12px;">
                                            <?php echo date('M d, Y', strtotime($relatedPost['created_at'])); ?>
                                        </small>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Newsletter Signup -->
                <div class="sidebar-widget" style="background: linear-gradient(45deg, #9e8a78, #897666); border-radius: 15px; padding: 25px; color: white; text-align: center;">
                    <h4 style="margin-bottom: 15px; font-size: 1.3rem;">Stay Updated</h4>
                    <p style="margin-bottom: 20px; font-size: 14px; opacity: 0.9;">
                        Get the latest grooming tips and style trends delivered to your inbox.
                    </p>
                    <form style="margin-bottom: 15px;">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" style="border: none; border-radius: 25px 0 0 25px;">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit" style="border-radius: 0 25px 25px 0; border: none;">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <small style="opacity: 0.8; font-size: 12px;">
                        We respect your privacy. Unsubscribe at any time.
                    </small>
                </div>
            </div>
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
                    <h3>Services</h3>
                    <ul class="opening_time">
                        <li>Haircuts & Styling</li>
                        <li>Beard Trimming</li>
                        <li>Hair Coloring</li>
                        <li>Hair Treatments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Copyright -->
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2024 Fresh Fade Barbershop. All rights reserved.</p>
            </div>
            <div class="col-md-6">
                <p style="text-align: right;">Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for style</p>
            </div>
        </div>
    </div>
</section>

<?php include "Includes/templates/footer.php"; ?>
