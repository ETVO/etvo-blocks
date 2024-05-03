<?php

function testimonials($attrs)
{
  $attrs = shortcode_atts(['color' => '#000'], $attrs);

  $color = $attrs['color'];

  ob_start(); // Start HTML buffering

  // $faq = clean_and_return(get_field('faq'), '_', '|');
  $testimonials = clean_and_return(get_field('testimonials'), '_', '|', false);

?>

  <div id="carouselTestimonials" class="testimonials carousel slide" style="color: <?= $color; ?>;" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach ($testimonials as $key => $testimonial) : ?>
        <div class="carousel-item testimonial <?php if ($key == 0) echo 'active' ?>">
          <div class="testimonial-text">
            <?php echo $testimonial[0]; ?>
          </div>
          <div class="testimonial-author">
            <?php echo $testimonial[1]; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="buttons-wrap" style="border-color: <?= $color; ?>">
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?= $color ?>" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?= $color ?>" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>


<?php

  $output = ob_get_contents(); // collect buffered contents

  ob_end_clean(); // Stop HTML buffering

  return $output; // Render contents
}
