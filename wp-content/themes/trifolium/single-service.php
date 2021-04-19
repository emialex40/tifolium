<?php
/**
 *  Template for the services post type single page
 */
get_header();
?>

    <section class="services-post">
        <div class="container">
            <div class="row header_row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row services-post-container">
                <div class="col-md-8 col-12">
                    <?php
                    $details = get_field('details');

                    if (have_rows('details')) :
                        while (have_rows('details')) :
                            the_row();
                            ?>
                            <div class="services-post-details">
                                <div class="services-post-row">
                                    <div class="services-post-ml-col">
                                        <h6 class="text-blue services-post-details-title"><i
                                                    class="far fa-clock"></i> <?php the_sub_field('src_sroki_title'); ?>
                                        </h6>
                                        <span class="services-post-details-val"><?php the_sub_field('src_sroki'); ?></span>
                                    </div>
                                    <div class="services-post-ml-col">
                                        <h6 class="text-blue services-post-details-title"><i
                                                    class="fas fa-dollar-sign"></i> <?php the_sub_field('src_pay_title'); ?>
                                        </h6>
                                        <span class="services-post-details-val"><?php the_sub_field('src_pay'); ?></span>
                                    </div>
                                </div>
                                <div class="services-post-row">
                                    <div class="services-post-lg-col">
                                        <h6 class="text-blue services-post-details-title"><i
                                                    class="fas fa-poll"></i> <?php the_sub_field('src_res_title'); ?>
                                        </h6>
                                        <div class="content">
                                            <?php the_sub_field('src_res'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="services-post-row">
                                    <div class="services-post-lg-col">
                                        <h6 class="text-blue services-post-details-title"><i
                                                    class="fas fa-exclamation"></i> <?php the_sub_field('src_must_title'); ?>
                                        </h6>
                                        <div class="content">
                                            <?php the_sub_field('src_must'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>

                    <article class="content services-post-text">
                        <?php the_field('src_content'); ?>
                    </article>
                </div>
                <div class="col-md-4 col-12">
                    <div class="services-post-emp">
                        <?php if (get_field('src_emp')) : ?>
                            <div class="services-post-img">
                                <?php
                                $img_arr = get_field('src_emp');
                                $img = $img_arr['url'];
                                ?>
                                <img src="<?php echo $img; ?>" alt="<?php the_field('src_name'); ?>">
                            </div>
                        <?php endif; ?>
                        <h4 class="services-post-name"><?php the_field('src_name'); ?></h4>
                        <?php if (get_field('src_position')) : ?>
                            <span class="services-post-position"><?php the_field('src_position'); ?></span>
                        <?php endif; ?>
                        <?php
                        $phones = get_field('srs_phones');
                        $mails = get_field('src-e-mailes');
                        ?>

                        <?php if ($phones) : ?>
                            <div class="services-post-phones">
                                <?php foreach ($phones as $phone) : ?>
                                    <a href="<?php echo phone_format($phone['src_add_phone']); ?>" class="services-post-contacts"><?php echo $phone['src_add_phone']; ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($mails) : ?>
                            <div class="services-post-emails">
                                <?php foreach ($mails as $mail) : ?>
                                    <a href="mailto:<?php echo $mail['src_add_email']; ?>" class="services-post-contacts"><?php echo $mail['src_add_email']; ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (get_field('src_doc')) : ?>
                    <div class="services-post-eml_doc">
                        <?php
                        $doc_arr = get_field('src_doc');
                        $doc = $doc_arr['url'];
                        $alt = ($doc_arr['alt']) ? $doc_arr['alt'] : 'Document';
                        ?>
                        <a data-fancybox href="<?php echo $doc; ?>">
                            <img src="<?php echo $doc; ?>" alt="<?php echo $alt; ?>">
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>