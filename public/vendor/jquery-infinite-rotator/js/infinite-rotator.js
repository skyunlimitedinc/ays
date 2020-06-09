// Copyright (c) 2010 TrendMedia Technologies, Inc., Brian McNitt.
// All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

$(window).load(function() {
  //start after HTML, images have loaded

  // Enable the passage of the 'this' object through the JavaScript timers

  var __nativeST__ = window.setTimeout,
    __nativeSI__ = window.setInterval;

  window.setTimeout = function(
    vCallback,
    nDelay /*, argumentToPass1, argumentToPass2, etc. */
  ) {
    var oThis = this,
      aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeST__(
      vCallback instanceof Function
        ? function() {
            vCallback.apply(oThis, aArgs);
          }
        : vCallback,
      nDelay
    );
  };

  window.setInterval = function(
    vCallback,
    nDelay /*, argumentToPass1, argumentToPass2, etc. */
  ) {
    var oThis = this,
      aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeSI__(
      vCallback instanceof Function
        ? function() {
            vCallback.apply(oThis, aArgs);
          }
        : vCallback,
      nDelay
    );
  };

  var InfiniteRotator = {
    init: function() {
      $(".rotating-item-group").each(function() {
        //initial fade-in time (in milliseconds)
        var initialFadeIn = 1000;

        //interval between items (in milliseconds)
        var itemInterval = 5000;

        //cross-fade time (in milliseconds)
        var fadeTime = 2500;

        //count number of items
        var numberOfItems = $(this).children(".rotating-item").length;

        //set current item
        var currentItem = 0;

        //show first item
        $(this)
          .children(".rotating-item")
          .eq(currentItem)
          .fadeIn(initialFadeIn);

        //loop through the items
        var infiniteLoop = setInterval.call(
          $(this),
          function() {
            $(this)
              .children(".rotating-item")
              .eq(currentItem)
              .fadeOut(fadeTime);

            if (currentItem === numberOfItems - 1) {
              currentItem = 0;
            } else {
              currentItem++;
            }
            $(this)
              .children(".rotating-item")
              .eq(currentItem)
              .fadeIn(fadeTime);
          },
          itemInterval
        );
      }); // $('rotating-item-wrapper').each()
    } // init
  }; // InfiniteRotator

  InfiniteRotator.init();
});
