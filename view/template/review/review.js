$(document).ready(function() {
    $("form").validate({
        ignore: "",
        rules: {
            rank: {
                required: true
            }
        }
    });

    var stars = ".c-rating__item";
    $(".c-rating").hover(function() {
        activeClassCount = $(this).find('.rating').index() + 1;
    }, function() {
        var $this = $(this);
        $this.find(stars).slice(1, activeClassCount).addClass('is-active');
        $this.find(stars).slice(activeClassCount, 5).not('.rating').removeClass('is-active');
    });
    $(stars).hover(function() {
        $(this).prevAll(stars).add($(this)).addClass('is-active');
        $(this).nextAll(stars).removeClass('is-active');
    });
    $(stars).click(function(event) {
        $(".rating").removeClass("rating");
        $(this).addClass('rating');
        activeClassCount = $(this).index() + 1;
        $(this).prevAll(stars).addClass('is-active');
        $("#rank").val(($(this).index() + 1));
    });
});