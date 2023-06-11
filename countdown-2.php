<!-- countdown-2.php -->
<div class="wrap">
    <div class="countdown" style="text-align: <?php echo $alignment; ?>;">

        <?php if (!empty($image_url)) : ?>
            <img src="<?php echo esc_attr($image_thumb_url[0]); ?>" alt="Uploaded Image">
        <?php endif; ?>
        <h1 style="color: <?php echo esc_attr($title_color); ?>; font-size: <?php echo esc_attr($title_font_size); ?>;"><?php echo esc_html($title); ?></h1>
        <div class="countdown-alignment">
            <?php if (in_array('days', $main_format)) : ?>
                <div class="bloc-time days" data-init-value="<?php echo $days; ?>">
                    <span class="count-title">Days</span>

                    <div class="figure days days-1">
                        <span class="top"><?php echo sprintf('%02d', $days)[0]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $days)[0]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $days)[0]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $days)[0]; ?></span>
                        </span>
                    </div>

                    <div class="figure days days-2">
                        <span class="top"><?php echo sprintf('%02d', $days)[1]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $days)[1]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $days)[1]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $days)[1]; ?></span>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array('hours', $main_format)) : ?>
                <div class="bloc-time hours" data-init-value="<?php echo $hours; ?>">
                    <span class="count-title">Hours</span>

                    <div class="figure hours hours-1">
                        <span class="top"><?php echo sprintf('%02d', $hours)[0]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $hours)[0]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $hours)[0]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $hours)[0]; ?></span>
                        </span>
                    </div>

                    <div class="figure hours hours-2">
                        <span class="top"><?php echo sprintf('%02d', $hours)[1]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $hours)[1]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $hours)[1]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $hours)[1]; ?></span>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array('minutes', $main_format)) : ?>
                <div class="bloc-time min" data-init-value="<?php echo $minutes; ?>">
                    <span class="count-title">Minutes</span>

                    <div class="figure min min-1">
                        <span class="top"><?php echo sprintf('%02d', $minutes)[0]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $minutes)[0]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $minutes)[0]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $minutes)[0]; ?></span>
                        </span>
                    </div>

                    <div class="figure min min-2">
                        <span class="top"><?php echo sprintf('%02d', $minutes)[1]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $minutes)[1]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $minutes)[1]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $minutes)[1]; ?></span>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array('seconds', $main_format)) : ?>
                <div class="bloc-time sec" data-init-value="<?php echo $seconds; ?>">
                    <span class="count-title">Seconds</span>

                    <div class="figure sec sec-1">
                        <span class="top"><?php echo sprintf('%02d', $seconds)[0]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $seconds)[0]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $seconds)[0]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $seconds)[0]; ?></span>
                        </span>
                    </div>

                    <div class="figure sec sec-2">
                        <span class="top"><?php echo sprintf('%02d', $seconds)[1]; ?></span>
                        <span class="top-back">
                            <span><?php echo sprintf('%02d', $seconds)[1]; ?></span>
                        </span>
                        <span class="bottom"><?php echo sprintf('%02d', $seconds)[1]; ?></span>
                        <span class="bottom-back">
                            <span><?php echo sprintf('%02d', $seconds)[1]; ?></span>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php $this->wpct_display_social_icons(); ?>

    </div>
</div>
<script>
    initializeClock("clockdiv", "<?php echo $deadline->format('Y-m-d\TH:i:s'); ?>");
</script>