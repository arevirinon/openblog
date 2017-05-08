<?php $this->load->view('public_includes/header'); ?>
<style type="text/css">
    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

    .carousel {
      margin-bottom: 10px;
    }

    .carousel .container {
      position: relative;
      z-index: 9;
    }

    .carousel-control {
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin:0 auto;
      margin-top: 200px;
      text-align:center;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-shadow: 2px 2px #000;
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }



    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

      .carousel .item {
        height: 500px;
      }
      .carousel img {
        width: auto;
        height: 500px;
      }

    }


    @media (max-width: 767px) {

      
      .carousel {
        margin-left: -20px;
        margin-right: -20px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 65%;
        padding: 0 70px;
        margin-top: 100px;
      }
      .carousel-caption h1 {
        font-size: 30px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 18px;
      }
    }
</style>
<?php $this->load->view('public_includes/masthead'); ?>
</div>
</div>
</div>


<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?php echo site_url('assets/img/blog_splash.jpg'); ?>" alt="">
      <div class="container">
        <div class="carousel-caption">
          <h1>Get Started!</h1>
          <p class="lead">
            OpenBlog is an open-source blogging platform for everybody.
          </p>
          <a class="btn btn-large btn-info" href="<?php echo base_url() . 'public_site/blogs'; ?>">Read Posts</a>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo site_url('assets/img/sign_up.jpg'); ?>" alt="">
      <div class="container">
        <div class="carousel-caption text-centered">
          <h1>New to OpenBlog?</h1>
          <p class="lead">
            Want to be a part of blog contributors? Signing up for an account is very easy!
          </p>
          <a class="btn btn-large btn-info" href="<?php echo base_url() . 'public_site/register'; ?>">Register</a>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo site_url('assets/img/social_media.jpg'); ?>" alt="">
      <div class="container">
        <div class="carousel-caption">
          <h1>Our Social Media Accounts</h1>
          <p class="lead">
            Can't get enough? Feel free to visit us at our social media accounts and get to know our registered writers and contributors.
          </p>
          <a class="btn btn-large btn-info" href="#">Browse gallery</a>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div><!-- /.carousel -->





<?php
$copyright = 'OpenBlog &copy 2016 | An open source blogging platform for everybody.';  
$this->load->view('public_includes/footer');
?>
