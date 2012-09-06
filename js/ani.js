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
      success: function(response){
            renewList(response);
         }
   } );
}

function renewList( response ){
   clearTable();
   if( response === undefined )
      console.log('response is empty');
      for( aniId in response ){
         $('#ani-list > tbody > tr:last').after( $('#row-template').clone().removeAttr('id') );
         var $currRow = $('tr:last');
         for( elem in response[aniId] ){
            $currRow.find('> td.col-' + elem ).text( response[aniId][elem] );
         }
      }
}

function clearTable(){
   $('#ani-list > tbody > tr:not(#row-template)').remove();
}
