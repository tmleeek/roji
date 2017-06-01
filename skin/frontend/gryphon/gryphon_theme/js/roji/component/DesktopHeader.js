goog.provide('roji.component.DesktopHeader');

goog.require('goog.events.Event');
goog.require('goog.events.EventTarget');

/**
 * The DesktopHeader constructor
 * @param {object} options The object extendable like jquery plugins
 * @param {element} element The jQuery element connected to class
 * @constructor
 * @extends {goog.events.EventTarget}
 */
roji.component.DesktopHeader = function(options, element) {

  goog.events.EventTarget.call(this);
  this.options = $j.extend({}, roji.component.DesktopHeader.DEFAULT, options);
  this.element = element;

  // if class has parent
  //goog.events.EventTarget.call(this, options, element);
  //this.options = $j.extend(this.options, roji.component.DesktopHeader.DEFAULT, options);
  
  window.header_cart_is_open = false;

  this.sticky_header_cart();  

  this.element.find("#desktop-header-cart-btn").click(this.on_desktop_header_cart_btn_click.bind(this));  

  console.log('roji.component.DesktopHeader: init');
};
goog.inherits(roji.component.DesktopHeader, goog.events.EventTarget);


/**
 * like jQuery options
 * @const {object}
 */
roji.component.DesktopHeader.DEFAULT = {
  'option_01': '',
  'option_02': ''
};

/**
 * DesktopHeader Event Constant
 * @const
 * @type {string}
 */
roji.component.DesktopHeader.EVENT_01 = '';

/**
 * DesktopHeader Event Constant
 * @const
 * @type {string}
 */
roji.component.DesktopHeader.EVENT_02 = '';


//    ____  ____  _____     ___  _____ _____
//   |  _ \|  _ \|_ _\ \   / / \|_   _| ____|
//   | |_) | |_) || | \ \ / / _ \ | | |  _|
//   |  __/|  _ < | |  \ V / ___ \| | | |___
//   |_|   |_| \_\___|  \_/_/   \_\_| |_____|
//


roji.component.DesktopHeader.prototype.private_method_01 = function() {};
roji.component.DesktopHeader.prototype.private_method_02 = function() {};
roji.component.DesktopHeader.prototype.private_method_03 = function() {};
roji.component.DesktopHeader.prototype.private_method_04 = function() {};
roji.component.DesktopHeader.prototype.private_method_05 = function() {};
roji.component.DesktopHeader.prototype.private_method_06 = function() {};


//    ____  _   _ ____  _     ___ ____
//   |  _ \| | | | __ )| |   |_ _/ ___|
//   | |_) | | | |  _ \| |    | | |
//   |  __/| |_| | |_) | |___ | | |___
//   |_|    \___/|____/|_____|___\____|
//


roji.component.DesktopHeader.prototype.sticky_header_cart = function() {
  if(this.controller==null){
    this.controller = new ScrollMagic.Controller(); // needed by some components
  }
  this.sticky_sidebar_scence = new ScrollMagic.Scene({triggerElement: "#desktop-header-cart-menu", triggerHook: 'onLeave', offset: 60 }) //offset: $('#sticky-sidebar').height()
    .setClassToggle("#desktop-header-cart-expand-container", "stick") // add class toggle
    // .setPin("#sticky-sidebar")
    // .addIndicators({name: ("" + Math.random()) }) // add indicators (requires plugin)
    .addTo(this.controller);

};
roji.component.DesktopHeader.prototype.open_header_cart = function() {
  window.header_cart_is_open = true;
  this.element.find("#desktop-header-cart-expand-container").slideDown(300);
};
roji.component.DesktopHeader.prototype.close_header_cart = function() {
  window.header_cart_is_open = false;
  this.element.find("#desktop-header-cart-expand-container").slideUp(300);
};
roji.component.DesktopHeader.prototype.public_method_04 = function() {};
roji.component.DesktopHeader.prototype.public_method_05 = function() {};
roji.component.DesktopHeader.prototype.public_method_06 = function() {};


//    _______     _______ _   _ _____ ____
//   | ____\ \   / / ____| \ | |_   _/ ___|
//   |  _|  \ \ / /|  _| |  \| | | | \___ \
//   | |___  \ V / | |___| |\  | | |  ___) |
//   |_____|  \_/  |_____|_| \_| |_| |____/
//

/**
 * @param {object} event
 */
roji.component.DesktopHeader.prototype.on_desktop_header_cart_btn_click = function(event) {
  if(window.header_cart_is_open==false) {
    this.open_header_cart();
  }else {
    this.close_header_cart();
  }
};

/**
 * @param {object} event
 */
roji.component.DesktopHeader.prototype.on_event_handler_02 = function(event) {
};

/**
 * @param {object} event
 */
roji.component.DesktopHeader.prototype.on_event_handler_03 = function(event) {
};

/**
 * @param {object} event
 */
roji.component.DesktopHeader.prototype.on_event_handler_04 = function(event) {
};






roji.component.DesktopHeader.prototype.sample_method_calls = function() {

  // sample override
  roji.component.DesktopHeader.superClass_.method_02.call(this);

  // sample event
  this.dispatchEvent(new goog.events.Event(roji.component.DesktopHeader.EVENT_01));
};