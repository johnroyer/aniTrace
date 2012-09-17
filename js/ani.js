/******************************************************************************
 *
 * Javascript for animation list.
 *
 *****************************************************************************/

$('document').ready(  function(){
      getAniList();
});

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
   clearTable('#ani-list');
   if( !('error' in response) ){
      for( aniId in response ){
         var tmpl = $('#row-template').clone().removeAttr('id');
         $('<tr></tr>').attr('id', response[aniId]['sn'])
            .insertAfter('#ani-list > tbody > tr:last');
         var result = $.tmpl( tmpl, response[aniId] )
            .appendTo('#ani-list > tbody > tr:last');
         $('#ani-list > tbody > tr:last > td.col-act > .act-edit').attr('data-id', response[aniId]['sn'] );
      }
   }else{
      $('<tr><td colspan="5"></td></tr>').insertAfter('#ani-list > tbody > tr:last');
      $('tr:last > td').text( response['error'] );
   }
}

function req( data ) {
   if( data !== undefined ){
      var url = site_url + '/ajax/';
      $.ajax( {
         url:  url + data.path,
         dataType: 'json',
         error: function(){ console.log( data.errorMsg ) },
         success: data.onSuccess
      } );
   }
}

function volClicked( act, $clicked ) {
   if( act !== undefined ){
      var id = $clicked.parent().parent().parent().attr('id');
      var $vol = $clicked.parent().parent().children('div.vol');
      var vol = Number( $vol.text() );
      var data = {
         errorMsg: 'vol access failed',
         onSuccess: function( response ){
            $vol.text( response[0].vol );
         }
      };
      if( act === 'up' ){
         data.path = 'vol/up/' + id;
         req( data );
      }else{
         data.path = 'vol/down/' + id;
         req( data );
      }
   }
}

function buyClicked( act, $clicked ) {
   if( act !== undefined ){
      var data = {};
      var id = $clicked.parent().parent().parent().attr('id');
      var $buy = $clicked.parent().parent().children('div.buy');
      var buy = Number( $buy.text() );
      var data = {
         errorMsg: 'buy access failed',
         onSuccess: function( response ){
            $buy.text( response[0].buy );
         }
      };
      if( act === 'up' ){
         data.path = 'buy/up/' + id;
         req( data );
      }else{
         data.path = 'buy/down/' + id;
         req( data );
      }
   }
}

/* ==========================================================
 * Own modal dialog. This modal get id from toggle 'form-edit'
 * and pass 'id' to data-id in target form.
 * ========================================================== */
$(function () {
      $('body').on('click.modal.data-api', '[data-toggle="form-modal"]', function ( e ) {
         var $this = $(this)
         , href = $this.attr('href')
         , $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) //strip for ie7
         , option = $target.data('modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

         var id = $this.attr('data-id');
         var $form = $target.find('> form');
         $form.attr('data-id', id);

         e.preventDefault()

         $target
         .modal(option)
         .one('hide', function () {
            $this.focus()
         })
      })
})

// Adding events to modal 'dialog-edit'
$('#dialog-edit').on('show', function(){
      var $this = $(this);
      var aniId = $this.find('> form').attr('data-id');
      var $targetRow = $('#ani-list > tbody > tr#' + aniId);
      var name = $targetRow.find('> td.col-name').text();
      var sub = $targetRow.find('> td.col-sub').text();
      var vol = $targetRow.find('> td.col-vol > div.vol').text();
      var buy = $targetRow.find('> td.col-buy > div.buy').text();
      $this.find('#ani-name').val( name );
      $this.find('#ani-sub').val( sub );
      $this.find('#ani-vol').val( vol );
      $this.find('#ani-buy').val( buy );
      console.log( aniId );
} );
