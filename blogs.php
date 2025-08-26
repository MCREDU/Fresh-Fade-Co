<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
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
            <!-- Blog Post 1 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #9e8a78, #897666); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-cut" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 15, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">The Classic Pompadour: A Timeless Style</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            The pompadour has been a symbol of confidence and style for decades. This classic cut features short sides and back with longer hair on top, styled upward and back. Perfect for men who want a sophisticated, retro look that never goes out of style.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Classic</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Pompadour</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 2 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #897666, #6b5b4d); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-razor" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 12, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">Modern Fade Techniques: From Skin to High</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            Fades have become the go-to style for modern men. From skin fades to high fades, these techniques create seamless transitions between different hair lengths. Learn about the different fade styles and which one suits your face shape best.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Modern</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Fade</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 3 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #6b5b4d, #9e8a78); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-beard" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 10, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">Beard Grooming: The Complete Guide</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            A well-groomed beard can transform your entire look. From trimming techniques to product recommendations, discover how to maintain a healthy, stylish beard that complements your haircut and enhances your overall appearance.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Beard</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Grooming</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 4 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #9e8a78, #6b5b4d); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-palette" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 8, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">2024 Hair Color Trends for Men</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            From subtle highlights to bold color choices, men's hair coloring is more popular than ever. Explore the latest trends including balayage, ombre, and creative color techniques that can add dimension and personality to any haircut.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Color</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Trends</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 5 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #6b5b4d, #897666); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-tint" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 5, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">Hair Care Products: What You Need to Know</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            The right hair care products can make all the difference in maintaining your style. From shampoos and conditioners to styling products, learn which products work best for different hair types and how to use them effectively.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Products</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Care</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 6 -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="blog-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                    <div class="blog-image" style="height: 250px; background: linear-gradient(45deg, #897666, #9e8a78); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie" style="font-size: 60px; color: white;"></i>
                    </div>
                    <div class="blog-content" style="padding: 25px;">
                        <div class="blog-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <i class="far fa-calendar-alt"></i> December 3, 2024
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-size: 22px;">Professional Hairstyles for the Workplace</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                            Looking professional doesn't mean sacrificing style. Discover haircuts that are both trendy and workplace-appropriate. From executive cuts to modern business styles, find the perfect look for your professional environment.
                        </p>
                        <div class="blog-tags" style="margin-bottom: 20px;">
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; margin-right: 8px;">Professional</span>
                            <span style="background: #9e8a78; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;">Workplace</span>
                        </div>
                        <a href="#" class="read-more" style="color: #9e8a78; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Read More <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
                        </a>
                    </div>
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
