<!-- layout header -->

<!-- layout sidebar -->

<!-- layout content -->
<?php foreach ($homeTitleList as $home) { ?>
<header id="video-area" data-stellar-background-ratio="0.5" class="header-area">
    <?php foreach ($home['list'] as $key) { ?>
    <div id="block" data-vide-bg="<?= base_url(
        'assets/video' . '/' . $key['video']
    ) ?>"></div>
    <?php } ?>
    <div class="fixed-top">
        <div class="container">
            <div class="logo-menu">
                <a href="" class="logo"><span class="lnr lnr-diamond"></span> Gbvrj Solutions Technology</a>
                <button class="menu-button" id="open-button"><i class="lnr lnr-menu"></i></button>
            </div>
        </div>
        <?php
        $session = \Config\Services::session();
        if ($session->getFlashData('warning')) { ?>
        <div class="wrappers">
            <div class="toast">
                <div class="content">
                    <div class="icon"><i class="fa fa-check"></i></div>
                    <div class="details">
                        <span>
                            <ul>
                                <?php foreach (
                                    $session->getFlashData('warning')
                                    as $value
                                ) { ?>
                                <li>
                                    <?= $value ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </span>
                        <p>Our team will reply to your message soon</p>
                    </div>
                </div>
                <div class="close-icon"></div>
            </div>
        </div>
        <?php }
        if ($session->getFlashData('success')) { ?>
        <div class="wrappers">
            <div class="toast">
                <div class="content">
                    <div class="icon"><i class="fa fa-check"></i></div>
                    <div class="details">
                        <span><?php echo $session->getFlashData(
                            'success'
                        ); ?></span>
                        <p>Our team will reply to your message soon</p>
                    </div>
                </div>
                <div class="close-icon"></div>
            </div>
        </div>
        <?php }
        ?>
    </div>
    <div class="overlay overlay-2"></div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-7">
                <div class="contents text-center">
                    <h3 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s"><?= $home[
                        'title'
                    ] ?></h3>
                    <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">
                        <?= $home['quote'] ?>
                    </p>
                    <a href="#services">
                        <p class="sizing-services">
                            Our Services
                        </p>
                        <div class="mouse_scroll">
                            <div class="mouse">
                                <div class="wheel"></div>
                            </div>
                            <div>
                                <span class="m_scroll_arrows unu"></span>
                                <span class="m_scroll_arrows doi"></span>
                                <span class="m_scroll_arrows trei"></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</header>

<section class="feedback-messages">
    <input type="checkbox" id="check">
    <label class="chat-btn" for="check">
        <i class="comment">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                class="bi bi-chat-text-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
            </svg>
        </i>
        <i class="fa fa-close close"></i>
    </label>
    <div class="wrapperr">
        <div class="header">
            <h6>Send Your Feedback 👋</h6>
        </div>
        <div class="text-center p-2">
            <span>Please fill in your opinion about this website</span>
            <br>
            <span>Your opinion can be influential in our future service</span>
        </div>
        <div class="chat-form">
            <form action="feedback" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required value="<?= isset(
                        $name
                    )
                        ? $name
                        : '' ?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required value="<?= isset(
                        $email
                    )
                        ? $email
                        : '' ?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Your Text Message" required value="<?= isset(
                        $message
                    )
                        ? $message
                        : '' ?>"></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <button type="submit" class="button-animation" style="border-radius:5px;">Send Feedback <i
                        class="fa fa-send" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</section>



<!-- Services Section Start -->
<section id="services" class="section">
    <?php foreach ($servicesTitleList as $service) { ?>
    <div class="container">
        <div class="section-header">
            <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <?= $service['title'] ?>
            </h2>
            <hr class="lines wow zoomIn" data-wow-delay="0.3s">
            <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <?= $service['quotes'] ?>
            </p>
        </div>
        <div class="row">
            <?php foreach ($service['list'] as $key) { ?>
            <div class="col-md-4 col-sm-6">
                <div class="item-boxes wow fadeInDown" data-wow-delay="0.4s">
                    <div class="icon">
                        <i>
                        <i class="lnr lnr-<?=$key['label_icon']?>"></i>
                        </i>
                    </div>
                    <h4>
                        <?= $key['category_name'] ?>
                    </h4>
                    <p>
                        <?= $key['description'] ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</section>

<!-- Services Section End -->

<!-- Abouts Section -->
<section id="about" class="video-promo section" data-stellar-background-ratio="0.5">
    <?php foreach ($aboutsTitleList as $about) { ?>
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-14 col-sm-12">
                <div class="video-promo-content text-center">
                    <h2 class="section-title wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">
                        <?= $about['title'] ?>
                    </h2>
                    <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    <br>
                    <p class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms"><?= $about[
                        'quote'
                    ] ?></p>
                    <?php foreach ($about['list'] as $key) { ?>
                    <a href="<?= $key[
                        'url_video'
                    ] ?>" class="video-popup wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s"><i
                            class="lnr lnr-film-play"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</section>
<!-- Abouts Section End -->

<!-- Works Section -->
<section id="works" class="section">
    <?php foreach ($worksTitleList as $works) { ?>
    <div class="container">
        <div class="section-header">
            <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><?= $works[
                'title'
            ] ?>
            </h2>
            <hr class="lines wow zoomIn" data-wow-delay="0.3s">
            <p class="section-subtitle wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <?= $works['quote'] ?></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="controls text-center wow fadeInUp" data-wow-delay=".6s">
                    <a class="control mixitup-control-active btn btn-common" data-filter="all">
                        All
                    </a>
                    <?php foreach ($works['list'] as $key) { ?>
                    <a class="control btn btn-common" data-filter=".<?= $key[
                        'filter'
                    ] ?>">
                        <?= $key['category_name'] ?>
                    </a>
                    <?php } ?>
                </div>
                <div id="portfolio" class="row wow fadeInUp" data-wow-delay="0.8s">
                    <?php foreach ($works['list'] as $key) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix <?= $key[
                        'filter'
                    ] ?>">
                        <div class="portfolio-item">
                            <div class="shot-item">
                                <a class="overlay lightbox" href="<?= base_url(
                                    'assets/image' . '/' . $key['image']
                                ) ?>">
                                    <img src="<?= base_url(
                                        'assets/image' . '/' . $key['image']
                                    ) ?>" alt="" />
                                    <i class="lnr lnr-eye item-icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</section>
<!-- Works Section Ends -->

<!-- testimonial Section Start -->
<div id="testimonial" class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10 wow fadeInRight" data-wow-delay="0.2s">
                <div class="touch-slider owl-carousel owl-theme">
                    <?php foreach ($readTestimonials as $testimonial) { ?>
                    <div class="testimonial-item">
                        <img src="<?= base_url(
                            'assets/image' . '/' . $testimonial->image
                        ) ?>" alt="Client Testimonial" />
                        <div class="testimonial-text">
                            <p>
                                <?= $testimonial->quote ?>
                            </p>
                            <h3><?= $testimonial->name ?></h3>
                            <span>
                                <?= $testimonial->profession_name ?>
                            </span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial Section Start -->

<!-- Contact Section Start -->
<section id="contact" class="section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <div class="contact-block">
                    <div class="section-header">
                        <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Contact
                            <span>Us</span>
                        </h2>
                        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                    </div>
                    <form action="contact" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name" required data-error="Please enter your name" value="<?= isset(
                                            $name
                                        )
                                            ? $name
                                            : '' ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" placeholder="Your Email" id="email" class="form-control"
                                        name="email" required data-error="Please enter your email" value="<?= isset(
                                            $email
                                        )
                                            ? $email
                                            : '' ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Subject" name="subject" id="msg_subject"
                                        class="form-control" required data-error="Please enter your subject" value="<?= isset(
                                            $subject
                                        )
                                            ? $subject
                                            : '' ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="Your Message" rows="11"
                                        data-error="Write your message" required>
                                        <?= isset($message) ? $message : '' ?>
                                    </textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="button-animation" name="submit" type="submit">Send Message <i
                                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- layout footer -->

