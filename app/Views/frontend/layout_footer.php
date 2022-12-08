<!-- Footer Section Start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="social-icons wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    <ul>
                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="site-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <?php foreach ($getInfoList as $info) { ?>
                    <p><?= $info->company_name ?></p>
                    <p><i class="lnr lnr-phone-handset item-icon" style="margin-right: 5px;"></i> <?= $info->company_contact ?></p>
                    <p><i class="lnr lnr-envelope item-icon" style="margin-right: 5px;"></i> <?= $info->company_mail ?></p>
                    <p><i class="lnr lnr-map-marker item-icon" style="margin-right: 5px;"></i> <?= $info->company_location ?></p>
                    <p>&copy; <?= $info->copyright ?></p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top" style="margin-bottom:2%;">
    <i class="lnr lnr-arrow-up"></i>
</a>

<div id="loader">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery-min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/tether.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('frontend'); ?>/assets/js/classie.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/mixitup.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/nivo-lightbox.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery.stellar.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery.nav.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/smooth-scroll.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/smooth-on-scroll.js"></script>
<script src="<?php echo base_url('frontend'); ?>/assets/js/wow.js"></script>
<script src="<?php echo base_url('frontend'); ?>/assets/js/menu.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery.vide.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery.counterup.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/waypoints.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/form-validator.min.js"></script>
<script src="<?php echo base_url(
    'frontend'
); ?>/assets/js/contact-form-script.js"></script>
<script src="<?php echo base_url('frontend'); ?>/assets/js/main.js"></script>


</body>

</html>

<script>
    const wrapper = document.querySelector(".wrappers"),
    toast = wrapper.querySelector(".toast"),
    title = toast.querySelector("span"),
    subTitle = toast.querySelector("p"),
    wifiIcon = toast.querySelector(".icon"),
    closeIcon = toast.querySelector(".close-icon");

    window.onload = () => {
    function ajax() {
        let xhr = new XMLHttpRequest(); //creating new XML object
        xhr.open("GET", "https://jsonplaceholder.typicode.com/posts",
            true); //sending get request on this URL
        xhr.onload = () => { //once ajax loaded
            //if ajax status is equal to 200 or less than 300 that mean user is getting data from that provided url
            //or his/her response status is 200 that means he/she is online
            if (xhr.status == 200 && xhr.status < 300) {
                toast.classList.remove("offline");
                subTitle.innerText = "Our team will reply to your message soon";
                wifiIcon.innerHTML = '<i class="fa fa-check"></i>';
                closeIcon.onclick = () => { //hide toast notification on close icon click
                    wrapper.classList.add("hide");
                }
                setTimeout(() => { //hide the toast notification automatically after 5 seconds
                    wrapper.classList.add("hide");
                }, 4500);
            } else {
                offline
                    (); //calling offline function if ajax status is not equal to 200 or not less that 300
            }
        }
        xhr.onerror = () => {
            offline
                (); ////calling offline function if the passed url is not correct or returning 404 or other error
        }
        xhr.send(); //sending get request to the passed url
    }
    setInterval(() => { //this setInterval function call ajax frequently after 100ms
        ajax();
    }, 100);
}
</script>