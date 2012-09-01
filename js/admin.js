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
   $('#user-list > tbody > tr').remove();
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
      addRow( list[index] );
   }
}

function addRow( data ){
   $('#user-list > tbody ').append(
         '<tr> ' + 
            '<td>' + data.id + '</td>' +
            '<td>' + data.username + '</td>' +
            '<td>' + data.email + '</td>' +
            '<td>' +
               '<a href="' + site_url + '/admin/deleteUser/' + data.id + '" class="action-link">' +
               '<i class="icon-trash action-icon"></i> Delete </a>' +
               '<a href="#" class="action-link"><i class="icon-pencil action-icon"></i>Edit</a>' +
            '</td>' +
         '</tr>'
      );
}
