// Create Countdown
var Countdown = {

    // Backbone-like structure
    jQueryel: jQuery('.countdown'),

    // Params
    countdown_interval: null,
    total_seconds: 0,

    // Initialize the countdown  
    init: function () {

        // DOM
        this.jQuery = {
            hours: this.jQueryel.find('.bloc-time.hours .figure'),
            minutes: this.jQueryel.find('.bloc-time.min .figure'),
            seconds: this.jQueryel.find('.bloc-time.sec .figure')
        };

        // Init countdown values
        this.values = {
            hours: this.jQuery.hours.parent().attr('data-init-value'),
            minutes: this.jQuery.minutes.parent().attr('data-init-value'),
            seconds: this.jQuery.seconds.parent().attr('data-init-value'),
        };

        // Initialize total seconds
        this.total_seconds = this.values.hours * 60 * 60 + (this.values.minutes * 60) + this.values.seconds;

        // Animate countdown to the end 
        this.count();
    },

    count: function () {

        var that = this,
            jQueryhour_1 = this.jQuery.hours.eq(0),
            jQueryhour_2 = this.jQuery.hours.eq(1),
            jQuerymin_1 = this.jQuery.minutes.eq(0),
            jQuerymin_2 = this.jQuery.minutes.eq(1),
            jQuerysec_1 = this.jQuery.seconds.eq(0),
            jQuerysec_2 = this.jQuery.seconds.eq(1);

        this.countdown_interval = setInterval(function () {

            if (that.total_seconds > 0) {

                --that.values.seconds;

                if (that.values.minutes >= 0 && that.values.seconds < 0) {

                    that.values.seconds = 59;
                    --that.values.minutes;
                }

                if (that.values.hours >= 0 && that.values.minutes < 0) {

                    that.values.minutes = 59;
                    --that.values.hours;
                }

                // Update DOM values
                // Hours
                that.checkHour(that.values.hours, jQueryhour_1, jQueryhour_2);

                // Minutes
                that.checkHour(that.values.minutes, jQuerymin_1, jQuerymin_2);

                // Seconds
                that.checkHour(that.values.seconds, jQuerysec_1, jQuerysec_2);

                --that.total_seconds;
            }
            else {
                clearInterval(that.countdown_interval);
            }
        }, 1000);
    },

    animateFigure: function (jQueryel, value) {

        var that = this,
            jQuerytop = jQueryel.find('.top'),
            jQuerybottom = jQueryel.find('.bottom'),
            jQueryback_top = jQueryel.find('.top-back'),
            jQueryback_bottom = jQueryel.find('.bottom-back');

        // Before we begin, change the back value
        jQueryback_top.find('span').html(value);

        // Also change the back bottom value
        jQueryback_bottom.find('span').html(value);

        // Then animate
        TweenMax.to(jQuerytop, 0.8, {
            rotationX: '-180deg',
            transformPerspective: 300,
            ease: Quart.easeOut,
            onComplete: function () {

                jQuerytop.html(value);

                jQuerybottom.html(value);

                TweenMax.set(jQuerytop, { rotationX: 0 });
            }
        });

        TweenMax.to(jQueryback_top, 0.8, {
            rotationX: 0,
            transformPerspective: 300,
            ease: Quart.easeOut,
            clearProps: 'all'
        });
    },

    checkHour: function (value, jQueryel_1, jQueryel_2) {

        var val_1 = value.toString().charAt(0),
            val_2 = value.toString().charAt(1),
            fig_1_value = jQueryel_1.find('.top').html(),
            fig_2_value = jQueryel_2.find('.top').html();

        if (value >= 10) {

            // Animate only if the figure has changed
            if (fig_1_value !== val_1) this.animateFigure(jQueryel_1, val_1);
            if (fig_2_value !== val_2) this.animateFigure(jQueryel_2, val_2);
        }
        else {

            // If we are under 10, replace first figure with 0
            if (fig_1_value !== '0') this.animateFigure(jQueryel_1, 0);
            if (fig_2_value !== val_1) this.animateFigure(jQueryel_2, val_1);
        }
    }
};

// Let's go !
Countdown.init();