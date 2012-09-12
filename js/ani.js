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
         url: data.url,
         dataType: 'json',
         error: console.log( data.errorMsg ),
         success: data.onSuccess
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
         $('td.col-vol > div > i.icon-plus').click( function(){ volClicked('up', $(this) ); } );
         $('td.col-vol > div > i.icon-minus').click( function(){ volClicked('down', $(this) ); } );
         $('td.col-buy > div > i.icon-plus').click( function(){ buyClicked('up', $(this) ); } );
         $('td.col-buy > div > i.icon-minus').click( function(){ buyClicked('down', $(this) ); } );
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

function volClicked( act, $clicked ) {
   if( act !== undefined ){
      var data = {};
      var id = $clicked.parent().parent().parent().attr('id');
      var $vol = $clicked.parent().parent().children('div.vol');
      var vol = Number( $vol.text() );
      if( act === 'up' ){
         $vol.text( vol + 1 );
      }else{
         $vol.text( vol - 1 );
      }
   }
}

function buyClicked( act, $clicked ) {
   if( act !== undefined ){
      var data = {};
      var id = $clicked.parent().parent().parent().attr('id');
      var $buy = $clicked.parent().parent().children('div.buy');
      var buy = Number( $buy.text() );
      if( act === 'up' ){
         $buy.text( buy + 1 );
      }else{
         $buy.text( buy - 1 );
      }
   }
}
