<?php

// Sliders
include('sliders/slider.php');

// Galleries
include('galleries.php');
register_galleries_post_type();

// Video
include('videos.php');
register_videos_post_type();

// Testimonials
include('testimonials.php');
register_testimonials_post_type();

?>