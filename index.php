<?php

    include "connect.php";
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";

?>

    <!-- HOME SECTION -->




    <!-- ABOUT SECTION -->

    <section id="about" class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_content" style="text-align: center;">
                        <h3>Introducing</h3>
                        <h2>Fresh Fade Co. <br>Science 2024</h2>
                       <p style="color: #777">
                            At our barbershop, we believe a cut is more than just a haircut it’s an experience. 
                            A barber is a master of grooming, style, and confidence, dedicated to helping men and boys 
                            look sharp and feel their best. From classic cuts to modern fades, clean shaves to beard trims, we’ve got you covered. <br><br>
                            
                            But a barbershop is more than scissors and clippers it’s a culture. It’s where conversations spark, 
                            stories are shared, and friendships are built. For generations, barbershops have been places of connection, 
                            style, and community, and we carry that tradition forward with a modern touch. <br><br>
                            
                            Step into our space and you’ll find more than just a fresh look you’ll find a vibe, an atmosphere, 
                            and a place that feels like home.
                        </p>
                    </div>
                </div>
                <div class="col-md-6  d-none d-md-block">
                    <div class="about_img">
                        <img class="about_img_single" src="Design/images/barbershop_image_1.jpg" alt="Barbershop">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->

   <section class="services_section" id="services">
    <div class="container">
        <div class="section_heading">
            <h2>Our Services</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-scissors-1"></i>
                    <h3>Haircut Styles</h3>
                    <p>Fresh Fade Co offers stylish haircuts that suit your personality and lifestyle.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-razor-2"></i>
                    <h3>Beard Trimming</h3>
                    <p>Precision beard trims that keep your facial hair neat and well groomed.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-brush"></i>
                    <h3>Smooth Shave</h3>
                    <p>Enjoy a smooth, clean shave with expert care for comfort and style and a look.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-hairbrush-1"></i>
                    <h3>Face Masking</h3>
                    <p>Rejuvenate your skin with soothing face treatments for a refreshed look and feel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- BOOKING SECTION -->

    <section class="book_section" id="booking">
        <div class="book_bg "></div>
        <div class="map_pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <form action="appointment.php" method="post" id="appointment_form" class="form-horizontal appointment_form">
                        <div class="book_content">
                            <h2 style="color: white;">Make an appointment</h2>
                            <p style="color: #999;">
                                Come and experience world class service <br>style and shave men's and boys hair.
                            </p>
                        </div>

                        <button id="app_submit" class="default_btn" type="submit">
                            Make Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->

    <section class="gallery-section" id="gallery">
        <div class="section_heading">
            <h2>Barbers Gallery</h2>
            <div class="heading-line"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/1.webp');">    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/2.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/3.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/4.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/5.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/6.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/7.webp');"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-column">
                    <div style="height: 230px">
                        <div class="gallery-img" style="background-image: url('Design/images/8.webp');"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING SECTION  -->

    <section class="pricing_section" id="pricing">

        <!-- START GET CATEGORIES  PRICES FROM DATABASE -->

            <?php

                $stmt = $con->prepare("Select * from service_categories");
                $stmt->execute();
                $categories = $stmt->fetchAll();

            ?>

        <!-- END -->

        <div class="container">
            <div class="section_heading">
                <h2>Our Barber Pricing</h2>
                <div class="heading-line"></div>
            </div>
            <div class="row">
                <?php

                    foreach($categories as $category)
                    {
                        $stmt = $con->prepare("Select * from services where category_id = ?");
                        $stmt->execute(array($category['category_id']));
                        $totalServices =  $stmt->rowCount();
                        $services = $stmt->fetchAll();

                        if($totalServices > 0)
                        {
                        ?>

                            <div class="col-lg-4 col-md-6 sm-padding">
                                <div class="price_wrap">
                                    <h3><?php echo $category['category_name'] ?></h3>
                                    <ul class="price_list">
                                        <?php

                                            foreach($services as $service)
                                            {
                                                ?>

                                                    <li>
                                                        <h4><?php echo $service['service_name'] ?></h4>
                                                        <p><?php echo $service['service_description'] ?></p>
                                                        <span class="price">R<?php echo $service['service_price'] ?></span>
                                                    </li>

                                                <?php
                                            }

                                        ?>
                                        
                                    </ul>
                                </div>
                            </div>

                        <?php
                        }
                    }

                ?>
                
            </div>
        </div>
    </section>

<!-- REVIEWS SECTION -->
<section id="reviews" class="testimonial_section">
	<div class="container">
		<div class="section_heading">
			<h2>Reviews</h2>
			<div class="heading-line"></div>
		</div>

		<div class="row reviews-grid">
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
					</div>
					<p class="review-text">I always leave feeling like a brand new man. Professional staff and unmatched attention to detail.</p>
					<div class="review-author">— Michael R.</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
					</div>
					<p class="review-text">Best haircut in town. They always listen and deliver exactly what I want. Highly recommended.</p>
					<div class="review-author">— Sarah L.</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
					</div>
					<p class="review-text">More than a haircut, it’s an experience. Clean space, friendly team, and great results every time.</p>
					<div class="review-author">— Daniel K.</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
					</div>
					<p class="review-text">Excellent beard trim and styling tips. Friendly barbers who really know their craft.</p>
					<div class="review-author">— James T.</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
					</div>
					<p class="review-text">Relaxed atmosphere and top-notch service. I won’t go anywhere else.</p>
					<div class="review-author">— Ashley P.</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="review-card">
					<div class="review-rating">
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
					</div>
					<p class="review-text">Consistently great cuts and great conversation. Feels like a community.</p>
					<div class="review-author">— Kevin S.</div>
				</div>
			</div>
		</div>
	</div>
</section>

    <!-- CONTACT SECTION -->

    <section class="contact-section" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Get in touch with us & 
                            <br>send us message today!
                        </h2>
                        <p>
                            Fresh Fade Co is more than just a barbershop. Founded with a passion for style and precision, we deliver top-notch grooming experiences while creating a welcoming space where every client feels valued and refreshed.
                        </p>

                        <h3>
                            198 West 21th Street, Suite 721 
                            <br>
                            Noordvyk, Midrand 1687
                        </h3>
                        <h4>
                            <span style = "font-weight: bold">Email:</span> 
                            Freshfade@gmail.com 
                            <br> 
                            <span style = "font-weight: bold">Phone:</span> 
                            +27 (011) 058 4889
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="default_btn">Send Message</button>
                                </div>
                            </div>
                            <img src="Design/images/ajax_loader_gif.gif" id = "contact_ajax_loader" style="display: none">
                            <div id="contact_status_message"></div>
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

    <!-- FOOTER  -->

    <?php include "Includes/templates/footer.php"; ?>