$('a#login').click(function(){
 $("#box").fadeIn('slow');
    $('form').fadeIn('slow');
    
})

$('a#changePass').click(function(){
    $("#box").fadeIn('slow');
       $('form').fadeIn('slow');
       
    })

$('#cancel').click(function(){
$('#box,form').hide();
    
})

$('a#logout').click(function(){
    $.post( "index.php", { logout: "true" } );
  })