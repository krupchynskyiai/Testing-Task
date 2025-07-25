<section class='hero'>
  <div class='container'>
    <div class='hero__content'>
      <div class='hero__swiper'>
        <div class='swiper-wrapper'>
          <?php
          for ($i = 1; $i <= 5; $i++) {
            $image_id = get_field("slide_{$i}_image");
            $text = get_field("slide_{$i}_text");
            if (!$image_id && !$text) continue;

            $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
          ?>
            <div class="swiper-slide hero__slide">
              <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="">
              <?php endif; ?>
              <p><?php echo esc_html($text); ?></p>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>