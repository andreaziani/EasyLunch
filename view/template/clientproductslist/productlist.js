// @flow
$(function () {
    //Search the product written by the user
    function search(e) { 
        if(e.which == 13) { // if the key is "Enter"
        //TODO: validate the text, send it to Web server and return only this type of products
            $(this).val();

            $(this).val(" ");//clear the search bar
        }
    }
    $("#searchBar").keypress(search);
 })