function clearTable( id ){
   $( id + ' > tbody > tr:not(#row-template)').remove();
}

// Navbar heighlight
$("li#" + navbarHighlight + '> a ').css('color', 'white');

