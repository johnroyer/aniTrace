/******************************************************************************
 *
 * Javascript for animation list.
 *
 *****************************************************************************/

$('document').ready( getAniList() );

function req( data ) {
   if( data !== undefined ){
      var url = site_url + '/ajax/';
      $.ajax( {
         url: data['url'],
         dataType: 'json',
         error: console.log( data['errorMsg'] ),
         success: data['onSuccess']
      } );
   }
}

function getAniList( ) {
   $.ajax( {
      url: site_url + '/ajax/',
      dataType: 'json',
      error: function(){ console.log('Get animation list failed') },
      success: function( response ){
         renewList( response );
         $('i.icon-plus').click( function(){ vol('up', $(this).parent().parent() ); } );
      }
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

function vol( act, $targetRow ) {
   if( act !== undefined ){
      var data = {};
      if( act === 'up' ){
         var id = $targetRow.attr('id');
         console.log( id );
      }else{
      }
   }
}
