<?php

function faq($attrs)
{
  $attrs = shortcode_atts([], $attrs);

  ob_start(); // Start HTML buffering

  $faq = clean_and_return(get_field('faq'), '_', '|');

?>

  <div class="faq accordion accordion-flush" id="accordionFAQ">

    <?php foreach ($faq as $key => $item) : ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="heading<?= $key ?>">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="false" aria-controls="collapse<?= $key ?>">
            <?= $item[0] ?>
          </button>
        </h2>
        <div id="collapse<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionFAQ">
          <div class="accordion-body">
            <?php foreach($item[1] as $paragraph): ?>
              <p><?= $paragraph; ?></p>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>


<?php

  $output = ob_get_contents(); // collect buffered contents

  ob_end_clean(); // Stop HTML buffering

  return $output; // Render contents
}

