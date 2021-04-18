jQuery(document).ready(function ($) {

    $('#hamburger_header').click(function () {
        if ($(this).hasClass('is-active')) {
            $('.bg').removeClass('activate');
            $('.mobile_menu').removeClass('active');
            $('#hamburger_header').removeClass('is-active');
            $("html,body").css("overflow", "auto");
        } else {
            $('.bg').addClass('activate');
            $('.mobile_menu').addClass('active');
            $('#hamburger_header').addClass('is-active');
            $("html,body").css("overflow", "hidden");

        }
    });

    $('.bg').click(function () {
        $(this).removeClass('activate');
        $('.mobile_menu').removeClass('active');
        $('#hamburger_header').removeClass('is-active');
        $("html,body").css("overflow", "auto");
    })

    const curText = $('.language-chooser').find('.active').children('a').text()

    $(".language-chooser").hover(function () {
        let lang = $(this).find('.active').siblings().children('a').text();
        $(this).find('.active').children('a').text(lang).fadeIn(300)
    }, function () {
        $(this).find('.active').children('a').text(curText).fadeIn(300)
    })

    $(".language-chooser")
        .find(".active")
        .click(function (e) {
            e.preventDefault();
            let href = $(this).siblings().children().attr("href");
            location.href = href;
        });

    $('.faq-header').click(function () {
        if ($(this).parent().hasClass('open')) {
            $(this).siblings('.faq-content').slideUp();
            $(this).parent().removeClass('open');
        } else {
            $(this).parent().addClass('open');
            $(this).siblings('.faq-content').slideDown()
            $(this).parent().siblings('.faq-item').removeClass('open')
            $(this).parent().siblings('.faq-item').find('.faq-content').slideUp()
        }
    })

})