<!-- THIS IS AN EMBED -->
<!-- PLEASE DO NOT INCLUDE THIS -->
<?php
include 'conn.php';
include 'rating.php';
$results = $reviewSnippets();
?>
<style>
body{
    background-color: transparent !important;
    padding-top: 10px;
}
.testimonial {
  margin: 0 20px 40px;
}
.testimonial .testimonial-content {
  padding: 35px 25px 35px 50px;
  margin-bottom: 35px;
  background: rgba(255, 255, 255, 0.25);
  /* box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 ); */
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  border: 1px solid rgba(255, 255, 255, 0.18);
  position: relative;
}
.testimonial .testimonial-content:before {
  content: "";
  position: absolute;
  bottom: -30px;
  left: 0;
  border-top: 15px solid #718076;
  border-left: 15px solid transparent;
  border-bottom: 15px solid transparent;
}
.testimonial .testimonial-content:after {
  content: "";
  position: absolute;
  bottom: -30px;
  right: 0;
  border-top: 15px solid #718076;
  border-right: 15px solid transparent;
  border-bottom: 15px solid transparent;
}
.testimonial-content .testimonial-icon {
  width: 50px;
  height: 45px;
  background: #0cca4a;
  text-align: center;
  font-size: 22px;
  color: #fff;
  line-height: 42px;
  position: absolute;
  top: 37px;
  left: -19px;
}
.testimonial-content .testimonial-icon:before {
  content: "";
  border-bottom: 16px solid #05a739;
  border-left: 18px solid transparent;
  position: absolute;
  top: -16px;
  left: 1px;
}
.testimonial p.description {
  min-height: 46px;
}
.testimonial .description {
  font-size: 15px;
  font-style: italic;
  color: #3d3d3d;
  line-height: 23px;
  margin: 0;
}
.testimonial .title {
  display: block;
  font-size: 18px;
  font-weight: 700;
  color: #3d3d3d;
  text-transform: capitalize;
  letter-spacing: 1px;
  margin: 0 0 5px 0;
}
.testimonial .post {
  display: block;
  font-size: 14px;
  color: #0cca4a;
}
.owl-theme .owl-controls {
  margin-top: 20px;
}
.owl-theme .owl-controls .owl-page span {
  background: #ccc;
  opacity: 1;
  transition: all 0.4s ease 0s;
}
.owl-theme .owl-controls .owl-page.active span,
.owl-theme .owl-controls.clickable .owl-page:hover span {
  background: #0cca4a;
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="testimonial-slider" class="owl-carousel">
                <?php if ($results) {
                    foreach ($results as $row) {?>
                        <div class="testimonial">
                            <div class="testimonial-content">
                                <div class="testimonial-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <p class="description">
                                    <?php echo $row['testimony'] ?>
                                </p>
                            </div>
                            <h3 class="title"><?php echo $row['username']  ?></h3>
                            <span class="post"><?php echo rating($row['rating']); ?></span>
                        </div>

                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $("#testimonial-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1000, 3],
            itemsDesktopSmall: [980, 2],
            itemsTablet: [768, 2],
            itemsMobile: [650, 1],
            pagination: true,
            navigation: false,
            slideSpeed: 1000,
            autoPlay: true
        });
    });
</script>