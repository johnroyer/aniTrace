/******************************************************************************
 *
 * Javascript for animation list.
 *
 *****************************************************************************/

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

         // Bind event for finish button
         $('i.icon-ok').click( function(){ markFinished( $(this) ); });
      }
   } );
}

function getWatchableList( ) {
   $.ajax( {
      url: site_url + '/ajax/watchableList/',
      dataType: 'json',
      error: function(){ console.log('Get animation list failed') },
      success: function( response ){
         renewList( response );

         // Bind clicked event to icons
         $('td.col-vol > div > i.icon-plus').click( function(){ volClicked('up', $(this) ); } );
         $('td.col-vol > div > i.icon-minus').click( function(){ volClicked('down', $(this) ); } );
         $('td.col-buy > div > i.icon-plus').click( function(){ buyClicked('up', $(this) ); } );
         $('td.col-buy > div > i.icon-minus').click( function(){ buyClicked('down', $(this) ); } );

         // Bind event for finish button
         $('i.icon-ok').click( function(){ markFinished( $(this) ); });
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
         var $currRow = $('#ani-list > tbody > tr:last');

         $currRow.find('td.col-act > .act-edit').attr('data-id', response[aniId]['sn'] );

         if( response[aniId].finished == 1 )
            $currRow.find('i.icon-ok').addClass('finished');

         if( response[aniId].link != null && response[aniId].link != '' )
            $currRow.find('div.link').removeClass('hide');
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

function markFinished( $clicked ){
   var id = $clicked.parent().parent().attr('id');
   $.get( site_url + '/ajax/finished/' + id ,
      function( response ){
         response = response[0];
         if( response.finished == 1 ){
            $('tr#' + response.sn).find('i.icon-ok').addClass('finished');
            console.log('Marked as finished');
         }else{
            $('tr#' + response.sn).find('i.icon-ok').removeClass('finished');
            console.log('Marked as unfinished');
         }
      }, 'json' )
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
         $form.addClass('active');

         e.preventDefault()

         $target
         .modal(option)
         .one('hide', function () {
            $this.focus()
         })
      })
})

$('.modal').on('hide', function(){
      $(this).find('form.active').removeClass('active');
});

// Remove text in the form
$('#dialog-addAni').on('show', function(){
      $('#dialog-addAni').find('input').attr('value', '');
});

// Adding events to modal 'dialog-edit'
$('#dialog-edit').on('show', function(){
      var $this = $(this);
      var aniId = $this.find('> form').attr('data-id');
      var name, link, sub, vol, buy;
      var data = {
         path: 'anime/' + aniId,
         errorMsg: 'vol access failed',
         onSuccess: function( response ){
            name = response[0].name;
            link = response[0].link;
            sub = response[0].sub;
            vol = response[0].vol;
            buy = response[0].buy;
            $this.find('#ani-name').val( name );
            $this.find('#ani-link').val( link );
            $this.find('#ani-sub').val( sub );
            $this.find('#ani-vol').val( vol );
            $this.find('#ani-buy').val( buy );
            console.log( aniId );
         }
      };
      req( data );
} );

// Bind click event to submit button in dialog
$('#submit-new-animation').click( function(){
      console.log('form submit');
      $.post( site_url+'/ajax/add/', $('form.active').serializeArray() , 
         function( response ){ 
            // Add Animation into list
            var tmpl = $('#row-template').clone().removeAttr('id');
            $('<tr></tr>').attr('id', response[0].sn)
            .insertAfter('#ani-list > tbody > tr:last');
            var result = $.tmpl( tmpl, response[0] )
            .appendTo('#ani-list > tbody > tr:last');
            $row = $('#ani-list > tbody > tr:last');

            $row.find('td.col-act > .act-edit').attr('data-id', response[0].sn );

            if( response[0].link != null && response[0].link != '' ){
               $row.find('.link > a').attr('href', response[0].link);
               $row.find('.link').removeClass('hide');
            }
            
            // Bind clicked event to icons
            $('td.col-vol > div > i.icon-plus').click( function(){ volClicked('up', $(this) ); } );
            $('td.col-vol > div > i.icon-minus').click( function(){ volClicked('down', $(this) ); } );
            $('td.col-buy > div > i.icon-plus').click( function(){ buyClicked('up', $(this) ); } );
            $('td.col-buy > div > i.icon-minus').click( function(){ buyClicked('down', $(this) ); } );

            // Bind event for finish button
            $('i.icon-ok').click( function(){ markFinished( $(this) ); });

            // Close dialog
            $('#dialog-addAni').modal('hide');

         }, 'json' );
});

// Submit changes
$('#submit-animation-change').click( function(){
   console.log('submiting changes');
   var data = $('form.active').serializeArray();
   data.push( {name:'id', value: $('form.active').attr('data-id') } );
   $.post( site_url+'/ajax/mod/', data , function( response ){
      // Update view
      var id = response[0].sn;
      var $row = $('tr#' + id );
      $row.find('.name').text( response[0].name );
      $row.find('.col-sub').text( response[0].sub );
      $row.find('.vol').text( response[0].vol );
      $row.find('.buy').text( response[0].buy );
      
      if( response[0].link != null && response[0].link != '' ){
         $row.find('.link > a').attr('href', response[0].link);
         $row.find('.link').removeClass('hide');
      }else{
         $row.find('.link > a').attr('href', '');
         $row.find('.link').addClass('hide');
      }

      // Close dialog
      $('#dialog-edit').modal('hide');
   }, 'json' )
   .error( function( data ){
      console.log('data update failed');
      console.log(data);
   } );
});

// Get anime list
$('document').ready(  function(){
      if( navbarHighlight == 'download-list' ){
         getAniList();
      }else{
         getWatchableList();
      }
});

