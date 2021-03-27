jQuery(document).ready(function($) {
    $(".tab-titles li").hover(function() {
        $(".tab-content").hide();
        $(".tab-titles li").removeClass('active');
        $(this).addClass("active");
        var selected_tab = $(this).find("a").attr("href");
        $(selected_tab).stop().fadeIn();
        return false;
    });
});
