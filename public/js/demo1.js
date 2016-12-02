(function() {

    $( ".trigger-overlay" ).click(function() {
        $(".overlay").toggleClass( "open" );

    });
     $( ".overlay-close" ).click(function() {
        $(".overlay").toggleClass( "open" );
    });

})();

$(document).ready(function () {
    //funcion para abrir el listado de idiomas
   $( ".language-activate" ).on( "click", function( event ) {
       $(".nav-languages-selector").toggleClass( "nav-languages-selector-open" );
   });
});
