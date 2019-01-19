$(document).ready(function() {
    $("form").validate({
        ignore: "",
        rules: {
            rank: {
                required: true
            }
        }
    });

    $.fn.customStarRatings = function(obj) {
        var wrapper = this;
        var stars = obj.childClass;
        var input = obj.inputClass;
        $(wrapper).hover(function() {
            activeClassCount = $(this).find('.rating').index() + 1;
        }, function() {
            var $this = $(this);
            $this.find(stars).slice(1, activeClassCount).addClass('is-active');
            $this.find(stars).slice(activeClassCount, 10).not('.rating').removeClass('is-active');
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
            if (input) {
                $(input).val(($(this).index() + 1)/2);
                console.log($(input).val(), activeClassCount);
            }
        });
    }
    
    $(".c-rating").customStarRatings({
        childClass: ".c-rating__item",
        inputClass: "#rank"
    });
});