<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
<link rel="stylesheet" href="style.css">
<section>
    <div class='container'>
        <div class='col-xs-12 form'>
            <h1>Review</h1>
            <div class="form-group">
                <form action="/ProgettoTecWeb/controller/action/submitReview.php" method="POST">
                    <label for='description'>Add description (optional):</label><br/>
                    <textarea name="description" id="description" class="form-control input-sm" cols="30" rows="5"></textarea>
                    <fieldset id="ratingSet">
                        <legend>Please rate this order:</legend>
                        <div class='stars'>
                            <ul class="c-rating">        
                                <li class="c-rating__item fa fa-star"></li>
                                <li class="c-rating__item fa fa-star"></li>
                                <li class="c-rating__item fa fa-star"></li>
                                <li class="c-rating__item fa fa-star"></li>
                                <li class="c-rating__item fa fa-star"></li>
                            </ul>
                        </div>
                        <input type="hidden" id="rank" name="rank" value=""/>
                    </fieldset>

                    <input type="submit" value="Confirm" id="confirm" class='btn btn-primary'/>
                    <a href="../orders/orderPage.php" class='btn btn-primary'>Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="review.js"></script>