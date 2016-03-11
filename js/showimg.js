$( document ).ready(function() {
    $( "#1" ).click(function() {
        $("#placehere img:last-child").remove()
        $('#placehere').prepend('<img id="cat1" src="images/cat1.png" />')
    });

    $( "#2" ).click(function() {
        $("#placehere img:last-child").remove()
        $('#placehere').prepend('<img id="cat2" src="images/cat2.png" />')
    });

    $( "#3" ).click(function() {
        $("#placehere img:last-child").remove()
        $('#placehere').prepend('<img id="cat3" src="images/cat3.png" />')
    });

});