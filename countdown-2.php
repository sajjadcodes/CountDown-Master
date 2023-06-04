<?php

function my_page_scripts1()
{
    wp_enqueue_script('my_new_script', plugin_dir_url(__FILE__) . 'public/js/countdown-2.js', [], '1.0', true);
    wp_register_style('my_new_css', plugin_dir_url(__FILE__) . 'public/css/countdown-2.css', false, '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'my_page_scripts1');

?>

<!-- countdown-2.php -->

<div id="clockdiv" style="text-align: <?php echo $alignment; ?>;">
    <?php if (!empty($image_url)) : ?>
        <img src="<?php echo esc_attr($image_thumb_url[0]); ?>" alt="Uploaded Image">
    <?php endif; ?>
    <h1 style="color: <?php echo esc_attr($title_color); ?>; font-size: <?php echo esc_attr($title_font_size); ?>;"><?php echo esc_html($title); ?></h1>

    <?php if (in_array('days', $main_format)) : ?>
        <div class="bloc-time days" data-init-value="<?php echo $days; ?>">
            <span class="count-title">Days</span>

            <div class="figure days days-1">
                <span class="top"><?php echo substr($days, 0, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($days, 0, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($days, 0, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($days, 0, 1); ?></span>
                </span>
            </div>

            <div class="figure days days-2">
                <span class="top"><?php echo substr($days, 1, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($days, 1, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($days, 1, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($days, 1, 1); ?></span>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (in_array('hours', $main_format)) : ?>
        <div class="bloc-time hours" data-init-value="<?php echo $hours; ?>">
            <span class="count-title">Hours</span>

            <div class="figure hours hours-1">
                <span class="top"><?php echo substr($hours, 0, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($hours, 0, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($hours, 0, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($hours, 0, 1); ?></span>
                </span>
            </div>

            <div class="figure hours hours-2">
                <span class="top"><?php echo substr($hours, 1, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($hours, 1, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($hours, 1, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($hours, 1, 1); ?></span>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (in_array('minutes', $main_format)) : ?>
        <div class="bloc-time min" data-init-value="<?php echo $minutes; ?>">
            <span class="count-title">Minutes</span>

            <div class="figure min min-1">
                <span class="top"><?php echo substr($minutes, 0, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($minutes, 0, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($minutes, 0, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($minutes, 0, 1); ?></span>
                </span>
            </div>

            <div class="figure min min-2">
                <span class="top"><?php echo substr($minutes, 1, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($minutes, 1, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($minutes, 1, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($minutes, 1, 1); ?></span>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (in_array('seconds', $main_format)) : ?>
        <div class="bloc-time sec" data-init-value="<?php echo $seconds; ?>">
            <span class="count-title">Seconds</span>

            <div class="figure sec sec-1">
                <span class="top"><?php echo substr($seconds, 0, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($seconds, 0, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($seconds, 0, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($seconds, 0, 1); ?></span>
                </span>
            </div>

            <div class="figure sec sec-2">
                <span class="top"><?php echo substr($seconds, 1, 1); ?></span>
                <span class="top-back">
                    <span><?php echo substr($seconds, 1, 1); ?></span>
                </span>
                <span class="bottom"><?php echo substr($seconds, 1, 1); ?></span>
                <span class="bottom-back">
                    <span><?php echo substr($seconds, 1, 1); ?></span>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php $this->wpct_display_social_icons(); ?>

</div>

<script>
    initializeClock("clockdiv", "<?php echo $deadline->format('Y-m-d\TH:i:s'); ?>");
</script>