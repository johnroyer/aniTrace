/******************************************************************************
 *
 * Javascript for animation list.
 *
 *****************************************************************************/

function getAniList ( ) {
   $.ajax( {
      url: site_url + '/ajax/',
      dataType: 'json',
      error: function(){ console.log('Get animation list failed') },
      success: renewList()
   }
}

function renewList (response) {
}
