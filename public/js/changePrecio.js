
$( document ).ready( function ()
{
    $( "#inputGanancia" ).change( function ()
    {
        var Precioc = document.getElementById( "inputPrecioc" ).value;
        Ganancia = $( this ).val(); // initialization in an inner scope
        Resultado = ( parseFloat( Ganancia ) + parseFloat( Precioc ) );
        $( "#inputPreciov" ).val( Resultado );
    } );

    $( "#inputPrecioc" ).change( function ()
    {
        var Ganancia = document.getElementById( "inputGanancia" ).value;
        Precioc = $( this ).val(); // initialization in an inner scope
        Resultado = ( parseFloat( Precioc ) + parseFloat( Ganancia ) );
        $( "#inputPreciov" ).val( Resultado );
    } );
} );

