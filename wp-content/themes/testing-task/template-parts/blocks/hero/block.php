<section class='hero'>
  <div class='container'>
    <div class='hero__content w-full'>
      <div class='hero__swiper overflow-hidden'>
        <div class='swiper-wrapper'>
          <?php
          while (have_rows('slider')) : the_row() ?>
            <div class="swiper-slide hero__slide relative rounded-xl overflow-hidden">
              <img src="<?php echo get_sub_field('image') ?>" alt="" class='w-full object-center object-cover h-[300px] md:h-[500px]'>
              <div class='hero__overlay absolute top-0 left-0 w-full h-full bg-sky-500/20 backdrop-blur-sm'></div>
              <div class='absolute top-[50%] left-[10%] text-white flex flex-col gap-4 text-xl'><?php echo get_sub_field('text'); ?></div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>