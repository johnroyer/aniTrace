/******************************************************************************
 *
 * Javascript for user admin panel.
 *
 * ***************************************************************************/

// User search at admin panel
$('#username-key').keyup(  function(){
      var keyword = $('#username-key').attr('value');
      fetchUser( keyword );
});

function clearTable(){
   $('#user-list > tbody > tr:not(#row-template)').remove();
}

function fetchUser( keyword ){
   $.ajax( {
      url: site_url + '/admin/searchUser/' + encodeURIComponent( keyword ),
      dataType: 'json',
      error: function(){ console.log('error'); },
      success: function(response){
         renewTable( response );
      }
   });
}

function renewTable( list ){
   clearTable();
   for( index in list ){
      $('#user-list > tbody > tr:last').after( $('#row-template').clone().removeAttr('id') );
      var $currRow = $('tr:last');
      for( elem in list[index] ){
         // $('tr:last > td.row-' + elem ).text( data[elem] );
         $currRow.find('> td.row-' + elem ).text( list[index][elem] );
      }
      var $link = $currRow.find(' > td > a.deleteUser');
      $link.attr('href', $link.attr('href') + '/' + list[index]['id'] );
      var $link = $currRow.find(' > td > a.editUser');
      $link.attr('href', $link.attr('href') + '/' + list[index]['id'] );
   }
}
