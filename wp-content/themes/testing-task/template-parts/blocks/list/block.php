<section class='list'>
    <div class='container'>
        <div class='list__content flex flex-col gap-8 items-center'>
            <?php $args = [
                'post_type' => 'car',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ];
            
            $query = new WP_Query($args);
            ?>
            <?php if ($query->have_posts()) : ?>
            <div class='list__swiper overflow-hidden w-full'>
                <div class='swiper-wrapper'>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php $post_id = get_the_ID(); ?>
                    <div class='swiper-slide list__slide'>
                        <a
                            href="<?php echo get_permalink($post_id); ?>"
                            title="<?php the_title($post_id); ?>"
                            class="car-card h-fit p-2 bg-sky-500/30 rounded-lg flex flex-col gap-4"
                        >
                            <span class="car-card__photo overflow-hidden rounded-md">
                            
                            <picture>
                                <img
                                src="<?php echo get_field('image', $post_id) ?>"
                                alt="<?php the_title(); ?>"
                                title="<?php the_title(); ?>"
                                width="220"
                                height="250"
                                class="car-card__image h-64 lg:h-96 w-full object-cover"
                                />
                            </picture>
                            </span>
                            <ul class="car-card__info">
                            <li class="car-card__title">
                                <span><?php the_title(); ?></span>
                            </li>
                            <li class="car-card__price">
                                <span><?php echo get_field('price', $post_id); ?>$</span>
                            </li>
                            </ul>
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            <a class='px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50 w-fit' href='/catalog/'>
                перейти в каталог
            </a>
        </div>
    </div>
</section>