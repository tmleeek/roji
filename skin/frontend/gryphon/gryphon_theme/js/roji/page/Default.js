goog.provide('roji.page.Default');

goog.require('goog.events.Event');
goog.require('goog.events.EventTarget');

goog.require('manic.page.Page');

goog.require('roji.component.DesktopHeader');
goog.require('roji.component.MobileHeader');
goog.require('roji.component.MailingList');

/**
 * The Default Page constructor
 * @inheritDoc
 * @constructor
 * @extends {manic.page.Page}
 */
roji.page.Default = function(options, element) {

  manic.page.Page.call(this, options);
  this.options = $j.extend(this.options, roji.page.Default.DEFAULT, options);


  /*
  if ($j('body').hasClass('chinese-version')) {
    manic.SITE_LANGUAGE = 'cn';
  }
  if ($j('body').hasClass('bahasa-version')) {
    manic.SITE_LANGUAGE = 'in';
  }
  */
  

 
  //   __     ___    ____
  //   \ \   / / \  |  _ \
  //    \ \ / / _ \ | |_) |
  //     \ V / ___ \|  _ <
  //      \_/_/   \_\_| \_\
  //

  /**
   * @type {roji.component.DesktopHeader}
   */
  this.desktop_header = null;

  /**
   * @type {roji.component.MobileHeader}
   */
  this.mobile_header = null;

  /**
   * @type {roji.component.MailingList}
   */
  this.mailing_list = null;




  this.page_wrapper = $j('#page-wrapper');
  this.page_wrapper_content = $j('#page-wrapper-content');

  


  // min height variables
  // 
  this.is_page_min_height = false;
  if( this.body.hasClass('min-height-version') == true ){
    this.is_page_min_height = true;
  }

  this.desktop_header_element = $j('#desktop-header');
  this.mobile_header_element = $j('#mobile-header');
  this.desktop_footer_element = $j('#desktop-footer');
  this.mobile_footer_element = $j('#mobile-footer');


  var product_price = $j("#page-product-detail-content").find(".regular-price").html();
  $j("#page-product-detail-form").find('.form-total-value').html(product_price);

  $j('#page-product-detail-form .form-quantity').find(".form-quantity-plus-btn").click(function(e){
    e.preventDefault();
    var $qty=$j(this).parent().find('.qty');
    var currentVal = parseInt($qty.val());

    if (!isNaN(currentVal)) {
      currentVal = currentVal + 1;
      $qty.val(currentVal);
    
      var product_price = $j("#page-product-detail-content").find(".regular-price").html();
      var currency_symbol = $j("#page-product-detail-form").find('.form-total-value').data('currency');
      product_price = product_price.replace( /^\D+/g, '');
      
      var total_price = product_price * currentVal;

      $j("#page-product-detail-form").find('.form-total-value').html(currency_symbol + total_price.toFixed(2));
    }
  });

  $j('#page-product-detail-form .form-quantity').find(".form-quantity-minus-btn").click(function(e){
    e.preventDefault();
    var $qty=$j(this).parent().find('.qty');
    var currentVal = parseInt($qty.val());

    if (!isNaN(currentVal) && currentVal > 1) {
      currentVal = currentVal - 1;
      $qty.val(currentVal);
  
      var product_price = $j("#page-product-detail-content").find(".regular-price").html();
      var currency_symbol = $j("#page-product-detail-form").find('.form-total-value').data('currency');
      product_price = product_price.replace( /^\D+/g, '');
      var total_price = product_price * currentVal;

      $j("#page-product-detail-form").find('.form-total-value').html(currency_symbol + total_price.toFixed(2));
    }

  });

  $j(".add-to-cart-links").click(this.on_add_to_cart_link_click.bind(this));

  $j("#desktop-header-cart-expand-container").on("click", '.remove-item', function(e){
      e.preventDefault();
      var item_id = $j(e.currentTarget).data("item-id");

      var request = $j.ajax({
          url: "/discovertea/index/deletecartitem",
          method: "POST",
          data: { item_id : item_id },
          dataType: "html"
      });

      request.done(function() {
          this.update_header_cart();
      }.bind(this));
      
  }.bind(this));

  console.log('roji.page.Default: init');
};
goog.inherits(roji.page.Default, manic.page.Page);


/**
 * like jQuery options
 * @const {object}
 */
roji.page.Default.DEFAULT = {
};

/**
 * CLASSNAME Event Constant
 * @const
 * @type {string}
 */
roji.page.Default.EVENT_01 = '';

//    ___ _   _ ___ _____
//   |_ _| \ | |_ _|_   _|
//    | ||  \| || |  | |
//    | || |\  || |  | |
//   |___|_| \_|___| |_|
//


roji.page.Default.prototype.init = function() {
  roji.page.Default.superClass_.init.call(this);



  if ($j('#desktop-header').length != 0) {
    this.desktop_header = new roji.component.DesktopHeader({}, $j('#desktop-header'));
  }

  if ($j('#mobile-header').length != 0 && $j('#mobile-header-expanded').length != 0){
    this.mobile_header = new roji.component.MobileHeader({}, $j('#mobile-header'));
  }
  
  if ($j('#mailing-list-popup-container').length != 0) {
    this.mailing_list = new roji.component.MailingList({}, $j('#mailing-list-popup-container'));
  }

  console.log('roji.page.Default: init');

};




//    _        _ __   _____  _   _ _____
//   | |      / \\ \ / / _ \| | | |_   _|
//   | |     / _ \\ V / | | | | | | | |
//   | |___ / ___ \| || |_| | |_| | | |
//   |_____/_/   \_\_| \___/ \___/  |_|
//


/**
 * @override
 * @inheritDoc
 */
roji.page.Default.prototype.update_page_layout = function(){
  roji.page.Default.superClass_.update_page_layout.call(this);


  if (this.is_page_min_height == true) {
    if (manic.IS_MOBILE == false) {

      var target_height = this.window_height - this.desktop_header_element.outerHeight() - this.desktop_footer_element.outerHeight();

      this.page_wrapper_content.css({
        'min-height': target_height + 'px'
      });

    }
  }

  if (manic.IS_MOBILE_HEADER == false) {

  } else {

  }

};




//    _   _    _    ____  _   _ _____  _    ____ ____
//   | | | |  / \  / ___|| | | |_   _|/ \  / ___/ ___|
//   | |_| | / _ \ \___ \| |_| | | | / _ \| |  _\___ \
//   |  _  |/ ___ \ ___) |  _  | | |/ ___ \ |_| |___) |
//   |_| |_/_/   \_\____/|_| |_| |_/_/   \_\____|____/
//


/**
 * @override
 * @inheritDoc
 */
roji.page.Default.prototype.scroll_to_target = function(str_param, str_param_2, str_param_3) {
  roji.page.Default.superClass_.scroll_to_target.call(this, str_param, str_param_2, str_param_3);
  

  
}

/**
 * @override
 * @inheritDoc
 */
roji.page.Default.prototype.on_scroll_to_no_target = function() {
  roji.page.Default.superClass_.on_scroll_to_no_target.call(this);

  
}

roji.page.Default.prototype.update_header_cart = function() {

  $j("#desktop-header-cart-menu").find(".cart-btn-value").removeClass('animated fadeIn').addClass('animated flipOutX');

  $j.ajax({
      url: '/discovertea/index/cartpreview',
      dataType: 'json',
      type : 'get',
      success: function(data){

          // update product count in cart
          $j("#desktop-header-cart-menu").find(".cart-btn-value").text(data.cart_qty);
          // $j("#mobile-header-cart-btn-container").find(".count").text(data.cart_qty);

          $j("#desktop-header-cart-menu").find(".cart-btn-value").removeClass('animated flipOutX').addClass('animated fadeIn');

          $j('.desktop-header-cart-expand').html('');

          if(data.cart_qty > 0) {

              $j.each(data.cart_items, function(key,value){

                  $j('.desktop-header-cart-expand').append('<ul class="desktop-header-cart-expand-content"><li><div class="manic-image-container"><img src="'+value.image+'" alt=""></div></li><li><p>'+value.qty+' x</p><p>'+value.name+'</p><p>'+value.name_in_color+'</p><p>'+value.row_price+'</p></li><li><a href="#" title="Remove item" data-item-id="'+value.id+'" class="close-btn remove-item"></a></li></ul>');

              });                    

          } else {

              $j('.desktop-header-cart-expand').append('<ul class="desktop-header-cart-expand-content"><li class="empty-cart"><p>Your cart is empty.</p></li></ul>');

          }       

          $j('.desktop-header-cart-expand-summary').find('.sub-total-amount').html(data.cart_total);

          $j('#desktop-header-cart-expand-container').slideDown(300);
          window.header_cart_is_open = true;
          $j('#desktop-header-cart-expand-container').delay(5000).slideUp(300);

          setTimeout(function() {
            window.header_cart_is_open = false;
          }, 5000);

          // var mobile_header = $j("#main-mobile-header").data('gryphon_mobile_header');
          // mobile_header.public_open_cart();
          //$j('#mobile-cart-expand-container').show();
          

          // $j('.mobile-cart-button').find('span').html(data.cart_qty);
          // $j('.cart-summary-data').find('.price').html(data.cart_total);
          // $j('.cart-summary-data').find('.count').html(data.cart_qty);
          // $j('.cart-summary-data span').html('<span class="price">'+data.cart_total+'</span> (<span class="count">'+data.cart_qty+'</span>)');                            
      }
  });                     
}


roji.page.Default.prototype.on_add_to_cart_link_click = function(event){
    event.preventDefault();

    var add_to_cart_url = $j(event.currentTarget).attr("href");

    $j.get( add_to_cart_url, function( data ) {
       this.update_header_cart();
    }.bind(this));         
    
}


