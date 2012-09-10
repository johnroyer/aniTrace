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

         // Bind clicked event to icons
         $('td.col-vol > i.icon-plus').click( function(){ volClicked('up', $(this).parent().parent() ); } );
         $('td.col-vol > i.icon-minus').click( function(){ volClicked('down', $(this).parent().parent() ); } );
         $('td.col-buy > i.icon-plus').click( function(){ buyClicked('up', $(this).parent().parent() ); } );
         $('td.col-buy > i.icon-minus').click( function(){ buyClicked('down', $(this).parent().parent() ); } );
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

function volClicked( act, $targetRow ) {
   if( act !== undefined ){
      var data = {};
      var id = $targetRow.attr('id');
      if( act === 'up' ){
         console.log( 'vol ' + id + ' up');
      }else{
         console.log( 'vol ' + id + ' down');
      }
   }
}

function buyClicked( act, $targetRow ) {
   if( act !== undefined ){
      var data = {};
      var id = $targetRow.attr('id');
      if( act === 'up' ){
         console.log( 'buy' + id + ' up' ); 
      }else{
         console.log( 'buy' + id + ' down' );
      }
   }
}
