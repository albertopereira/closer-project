var closer = closer || {};

// navigation variables

closer.root = null; // reference to root node of current section
closer.budget = null; // current selected section
closer.view = null; // current selected section
closer.section = null; // current selected section
closer.mode = null; // current mode (map, table etc.)
closer.data = {}; // json data
closer.currentNode = {}; // currently selected node

// time variables

// first datapoint
closer.firstYear = null;
// last datapoint
closer.lastYear = null;
closer.currentYear = new Date().getFullYear();
closer.thisYear = closer.currentYear;

// available data sections
closer.sections = ['default'];
// available modes (treemap, table..)
closer.modes =
{
    "l" : {
        js : closer.table,
        template : '#table-template',
        container : '#table-container'
    },
    "t" : {
        js : closer.treemap,
        template : '#treemap-template',
        container : '#navigation'
    },
    "h" : {
        js : closer.heatmap,
        template : '#heatmap-template',
        container : '#heatmap_container'
    }
}

var timer = 0;

// Protoypes

/*
* Converts number to css compatible value
*/
Number.prototype.px = function () {
    return this.toString() + "px";
};

/*
*   Reads parameters from current url path and calls related
*   initialization routines
*/
function initialize(){
    var urlComponents = window.location.pathname.substring(1).split('/');
    var params = {
        budget : urlComponents[1],
        view : urlComponents[2],
        section : urlComponents[3],
        year : urlComponents[4],
        mode : urlComponents[5],
        node : urlComponents[6]
    }

    closer.navbar.initialize();
    
    if(params.section === undefined || params.section === "") {
        params.section = 'default'
    }
    if($.inArray(params.section, closer.sections) > -1){
        initializeVisualizations(params);
    } else {
        closer.navbar.minimize();
    }
}

/*
*  Initializes data visualization components
*
*  @param {obj} params - year, mode, section and node
*/
function initializeVisualizations(params) {
    // get previosly set year
    var yearCookie = parseInt(jQuery.cookie('year'));
    // use year listed in the params object
    if (params.year !== undefined && !isNaN(parseInt(params.year))) {
        closer.thisYear = params.year;
    // use year previosly set (if any)
    } else if (!isNaN(yearCookie)) {
        closer.thisYear = yearCookie;
    } else {

    }
    closer.section = params.section;
    closer.budget = params.budget;
    closer.view = params.view;

    // highlight current selection in navigation bar
    $('.section').each(function () {
        if ($(this).data('section') === closer.section.toLowerCase()) {
            $(this).addClass('selected');
        }
    });

    // set viewing mode
    setMode(params.mode);

    // connect search actions
    $('#searchbox').keyup(closer.navbar.searchChange);

    loadData();
}

/*
*   Parses JSON files and calls visualization subroutines
*/
function loadData() {
    // get datasets
    // loads all jsons in data
    $.each(closer.sections, function (i, url) {
        closer.data[url] = JSON.parse($('#data-' + url).html());
    });

    // initialize root level
    closer.root = closer.data[closer.section];

    // inialize year variables based on data

    // determine oldest year
    closer.firstYear = d3.min(closer.root.values, function (d) {
        return d.year
    });
    // determine newest year
    closer.lastYear = d3.max(closer.root.values, function (d) {
        return d.year
    });
    yearIndex = closer.thisYear - closer.firstYear;
    closer.navbar.initialize(closer.thisYear);

    closer.currentNode.data = undefined;

    // initialize cards
    closer.cards.initialize();

    //initialize heatmap
    //closer.heatmap.initialize()


    // navigation (treemap or table)
    closer.navigation.initialize($(closer.modes[closer.mode].container), closer.root);
    closer.navigation.open(closer.root.hash);

}

/*
*   Browser history routines
*   (Chrome, Safari, FF)
*/

/*
*   Back button action
*/
window.onpopstate = popUrl;

/*
*   Pushes current status to browser history
*
*   @param {string} section - current section
*   @param {int} year - current year
*   @param {string} mode - treemap or table view
*   @param {string} node - hash of current node
*
*/
function pushUrl(budget, section, year, mode, node) {
    if (ie()) return;
    // format URL
    var url = '/view/' + budget + '/' + section + '/' + year + '/' + mode + '/' + node;
    // create history object
    window.history.pushState({
        budget: budget,
        section: section,
        year: closer.thisYear,
        mode: mode,
        nodeId: node
    }, "", url);
}

/*
*   Restores previous history state
*
*   @param {state obj} event - object containing previous state
*/
function popUrl(event) {
    if (ie()) return;

    if (event.state === null) {
        closer.navigation.open(closer.root.hash, 500);
    } else if (event.state.mode !== closer.mode) {
        switchMode(event.state.mode, false);
    } else {
        closer.navigation.open(event.state.nodeId, 500);
    }
}


/*
*   Mode selection subroutines
*/

/*
*   Sets visualization mode
*
*   @param {string} mode - 'l' for list, 't' for treemap
*/
function setMode(mode) {
    var $container = $('#closer-wrap');
    mode = mode || defaultMode;
    closer.mode = mode;
    closer.navigation = closer.modes[mode].js;
    $container.html(Mustache.render($(closer.modes[mode].template).html()));
}

/*
* Switches between visualization models
*
* @param {string} mode - visualization mode ('l' for list, 't' for treemap)
* @param {bool} pushurl - whether to push change in browser history
*/
function switchMode(mode, pushurl) {
    if (pushurl === undefined) pushurl = true;
    setMode(mode);
    if (pushurl) pushUrl(closer.budget, closer.view, closer.section, closer.thisYear, mode, closer.root.hash);
    loadData();
}

/*
*   Year selection subroutines
*/

/*
* Switches visualizations to selected year
*
* @param {int} year - selected year
*
*/
function changeYear(year) {
    // don't switch if year is already selected
    if (year === closer.thisYear) return;

    // push change to browser history
    pushUrl(closer.budget, closer.view, closer.section, year, closer.mode, closer.root.hash);
    // set new year values
    closer.thisYear = year;
    yearIndex = closer.thisYear - closer.firstYear;
    // update navigation (treemap or table)
    closer.navigation.update(closer.root);

    closer.navigation.open(closer.currentNode.data.hash);
    // remember year over page changes
    $.cookie('year', year, {
            expires: 14
    });
    // update homepage graph if needed
    if ($('#closer-home').is(":visible")) {
        closer.home.showGraph(100);
    }
}

/*
*   Helper functions
*/

/* As simple as that */
var log = function (d) {
    console.log(d);
}

/*
* Converts hex encoded color value to rgb
*
* @param {string} hex - hex color value
* @return {object} - rgb color object
*/
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

/*
*   Mixes two rgb colors
*
*   @param {object} rgb1 - rgb color object
*   @param {object} rgb2 - rgb color object
*   @param {float} p - weight (0 to 1)
*   @return {rgb object} - mixed color
*/
function mixrgb(rgb1, rgb2, p) {
    return {
        r: Math.round(p * rgb1.r + (1 - p) * rgb2.r),
        g: Math.round(p * rgb1.g + (1 - p) * rgb2.g),
        b: Math.round(p * rgb1.b + (1 - p) * rgb2.b)
    };
}

/*
*   Mixes RGB color with white to give a transparency effect
*
*   @param {hex color} hex - color to which transparency has to be applied
*   @param {float} opacity - level of opacity (0.0 - 1.0 scale)
*   @return {rgba string} - rgba color with new transparency
*/
function applyTransparency(hex, opacity){
    var startRgb = mixrgb(hexToRgb(hex), {r:255, g:255, b:255}, opacity);
    return 'rgba(' + startRgb.r + ',' + startRgb.g + ',' + startRgb.b + ',' + 1.0 + ')';
}

/*
*   Applies translate to svg object
*/
function translate(obj, x, y) {
    obj.attr("transform", "translate(" + (x).toString() + "," + (y).toString() + ")");
}

/*
*  Centers object vertically
*/
$.fn.center = function () {
    this.css("margin-top", Math.max(0, $(this).parent().height() - $(this).outerHeight()) / 2);
    return this;
}

/*
*   Resizes text to match target width
*
*   @param {int} maxFontSize - maxium font size
*   @param {int} targetWidth - desired width
*/
$.fn.textfill = function (maxFontSize, targetWidth) {
    var fontSize = 10;
    $(this).css({
        'font-size': fontSize
    });
    while (($(this).width() < targetWidth) && (fontSize < maxFontSize)) {
        fontSize += 1;
        $(this).css({
            'font-size': fontSize
        });
    }
    $(this).css({
        'font-size': fontSize - 1
    });

};

/*
*   Stops event propagation (on all browsers)
*
*   @param {event object} event - event for which propagation has to be stopped
*/
function stopPropagation(event){
    if(event) {
        event.cancelBubble = true;
        if(event.stopPropagation) event.stopPropagation();
    }
}

/*
*   Capitalizes a string
*
*   @param {string} string - string to be capitalized
*   @return {string} - capitalized string
*/
function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function findSection(hash){
    var section = null;
    $.each(closer.data, function(){
        if(findHash(hash, this) !== false) {
            section = this;
        }
    })
    return section;
}

/*
*   Finds node with given hash
*
*   @param {string} hash - hash to be searched
*   @param {node} node - current node
*   @return {node} - node with given hash
*/
function findHash(hash, node){
    var index = node.hash.indexOf(hash);
    // results
    if (index !== -1) return node;
    // propagate recursively
    if(node.sub !== undefined) {
        // propagate to all children
        for(var i=0; i<node.sub.length; i++) {
            var subResults = findHash(hash, node.sub[i]);
            if (subResults) return subResults;
        }
    }
    return false;
};
