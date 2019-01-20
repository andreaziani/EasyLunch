<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>        
<link rel="stylesheet" href="style.css"> <!--TODO header?-->
<section>
    <h1>Review</h1>
    <form action="/ProgettoTecWeb/controller/action/submitReview.php" method="POST">
        <label>Add description (optional): <input type="text" name="description" id="description" /></label><br/>

        <fieldset id="ratingSet">
            <legend>Please rate this order:</legend>
            <ul class="c-rating">
                <li class="c-rating__item rating left" data-index="0"></li>
                <li class="c-rating__item" data-index="1"></li>
                <li class="c-rating__item left" data-index="2"></li>
                <li class="c-rating__item" data-index="3"></li>
                <li class="c-rating__item left" data-index="4"></li>
                <li class="c-rating__item" data-index="5"></li>
                <li class="c-rating__item left" data-index="6"></li>
                <li class="c-rating__item" data-index="7"></li>
                <li class="c-rating__item left" data-index="8"></li>
                <li class="c-rating__item" data-index="9"></li>
            </ul>
            <input type="hidden" id="rank" name="rank" value=""/>
        </fieldset>

        <input type="submit" value="Confirm" id="confirm"/>
    </form>
    <a href="../mainPage.php">Skip review</a>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="review.js"></script>