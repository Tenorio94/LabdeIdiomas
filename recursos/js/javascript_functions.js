// ;(function($, undefined){
//     debugger;
    var Utils = {

         applyMultilingualLabels : function (parentSelector, multilingualSelector, areInputElements) {
            var $items = $(parentSelector).find(multilingualSelector),
                areInputElements = typeof areInputElements !== 'undefined' ? areInputElements : false;

            for(var i = 0, lengthItems = $items.length; i < lengthItems; i++) {
                var $current = $($items[i]);

                // We use the globalTranslations object configured by the MENU
                var key = !areInputElements ? $current.text() : $current.attr('placeholder'),
                    translatedText = i18next.t(key);

                if(typeof translatedText !== 'undefined') {
                    if(!areInputElements) {
                        // Translate the normal text of an span, paragraph, div, etc. and show it
                        // By default, all the labels are non-visible (using visibility attribute)
                        $current.html(translatedText).css('visibility', 'visible');
                    }
                    else {
                        // Translate the placeholder of an input
                        $current.attr('placeholder', translatedText).css('visibility', 'visible');
                    }
                }
            }
        },

        getMultilingualLabelByKey : function(key){ 
          var result = key;
          if ( (typeof key !== 'undefined') && (typeof i18next !== 'undefined') ) {
            result = i18next.t(key);
          }
          return result;
        }

    };

    if(typeof window.Utils === "undefined") {
        window.Utils = Utils;
    }
// })(window.jQuery);