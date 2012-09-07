/******************************************************************************
 *
 * Javascript for animation list.
 *
 *****************************************************************************/

$('document').ready( getAniList() );

function getAniList ( ) {
   $.ajax( {
      url: site_url + '/ajax/',
      dataType: 'json',
      error: function(){ console.log('Get animation list failed') },
      success: renewList
   } );
}

function renewList( response ){
   clearTable();
   if( !('error' in response) ){
      for( aniId in response ){
         var tmpl = $('#row-template').clone().removeAttr('id');
         $('<tr></tr>').attr('id', response[aniId]['sn'])
            .insertAfter('#ani-list > tbody > tr:last');
         var result = $.tmpl( tmpl, response[aniId] )
            .appendTo('#ani-list > tbody > tr:last');
      }
   }else{
      $('<tr><td colspan="5"></td></tr>').insertAfter('#ani-list > tbody > tr:last');
      $('tr:last > td').text( response['error'] );
   }
}

function clearTable(){
   $('#ani-list > tbody > tr:not(#row-template)').remove();
}
