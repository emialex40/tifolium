<?php
/**
 *  Template Name: Контакты
 */

get_header();

$people = get_field('sotrudnyky');
?>

    <section class="contacts">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="contacts-info">
                        <h4><?php the_field('zagolovok_ofys'); ?></h4>
                        <a href="<?php echo phone_format(the_field('telefon', 'option')); ?>"
                           class="contacts-info-item contacts-phone"><i
                                    class="fas fa-phone"></i> <?php the_field('telefon', 'option'); ?></a>
                        <a href="mailto:<?php the_field('e-mail', 'option'); ?>"
                           class="contacts-info-item contacts-mail"><i
                                    class="far fa-envelope"></i> <?php the_field('e-mail', 'option'); ?></a>
                        <?php if (get_field('adres', 'option')) : ?>
                            <div class="contacts-info-item contacts-address">
                                <i class="fas fa-home"></i>
                                <span><?php the_field('adres', 'option'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="contacts-form">
                        <?php echo do_shortcode('' . get_field('contact_form') . ''); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if ($people) : ?>
                        <div class="contacts-emp">
                            <?php
                            foreach ($people as $man) :
                                $photo = $man['foto_sotrudnyka'];
                                $name = $man['ymya'];
                                $pos = $man['dolzhnost'];
                                $tel = $man['ct_telefon'];
                                $mail = $man['e-mail'];
                                ?>
                                <div class="contacts-item">
                                    <div class="contacts-item-img">
                                        <img src="<?php echo $photo; ?>" alt="<?php echo $name; ?>">
                                    </div>
                                    <h4><?php echo $name; ?></h4>
                                    <span class="contacts-item-position"><?php echo $pos; ?></span>
                                    <a href="<?php echo phone_format($tel); ?>" class="contacts-item-phone"><i
                                                class="fas fa-phone"></i> <?php echo $tel; ?></a>
                                    <a href="mailto:<?php echo $mail; ?>" class="contacts-item-email"><i
                                                class="far fa-envelope"></i> <?php echo $mail; ?></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="map">
        <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
            <?php the_field('map'); ?>
        <?php endif; ?>
    </section>

<?php get_footer(); ?>