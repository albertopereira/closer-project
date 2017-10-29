var closer = closer || {};

closer.cards = function(){
    // all the cards that need to be shown for the current section
    var deck = [],
    // all card objects
    cardstack = [],
    $cards;

    /*
    *   Initializes cards
    */
    initialize = function(){
        cardstack = [];
        $cards = $("#cards");
        // each section has its own deck, or information to be shown
        // about each entry
        // eg. only default has personal contribution card
        deck = decks[closer.section];

        var container,
            rowHtml = '<div class="row-fluid card-row separator"> </div>';
        // draw all cards in deck
        for(var i=0; i < deck.length; i++) {
            // append new row every 2 cards
            if (i%2 === 0) {
                container = $(rowHtml).appendTo($cards);
            }
            // creates div for new card
            var newcard = $('<div class="card-wrapper"></div>').appendTo(container);
            // var newcard = drawCard(container, deck[i]);
            // remember card object for future updates
            cardstack.push(newcard);
        }
    },

    /*
    *   Updates all cards with latest data
    *
    *   @param {node} data - node for which data has to be displayed
    */
    update = function (data) {

        // update all cards in deck
        $.each(deck, function(i,d){
            // render template

            if(typeof(d.cardRenderer) === 'function') {
                d.cardRenderer(data, cardstack[i]);
            } else {
                cardstack[i].html(Mustache.render($('#card-template').html(),d));
            }
            // set value
            cardstack[i].find(".card-value").html(deck[i].value(data));

            // set card description if available
            cardstack[i].find(".card-desc").html(
                (typeof(deck[i].side) === 'string') ? deck[i].side : deck[i].side(data));
        });
    },

    /*
    *   Displays node in cards
    *
    *   @param {node} data - node for which data has to be displayed
    */
    open = function(data){
        closer.cards.update(data);
    };

    return{
        open : open,
        update : update,
        initialize : initialize
    }
}();
