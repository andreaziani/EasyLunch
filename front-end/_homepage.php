<?php 
include ("utils/BaseController.php");
    $base = new BaseController();    
    $base->requireFromWebSitePath('header/_header.php');
?>
    
    <section>  
        <!---<img src="resources/lunch-icon.png" alt="Logo"/>-->
            <div>
                <h1> Order your lunch in few simple steps! </h1>
            </div>
    </section>
    <!-- Other pretty images here-->
    <section>
        <p> 
            We're working for giving users an extraordinary lunch experience,
            selecting the best providers with the highiest quality of products.
        </p>
    </section>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>