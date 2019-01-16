<?php ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section>
        <ul id="reviews">
            <?php
                $query = "SELECT * FROM ProvidersReviews WHERE CompanyName='" . $_POST["companyname"] . "' AND ProviderId='" . $_POST["username"] . "'";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        $html =  "<li>";
                        //TODO: Maybe there is another way to make stars
                        for($i=0; $i < $row["Rank"]; $i++){
                            $html = $html . "<span class='fa fa-star checked'></span>";
                        }
                        $html = "<p class='comment'>" . $row["Comment"] . "</p></li>";
                }
            ?>
        </ul>
</section>