stats = {
    amount: {
        title: "Valor",
        class: "span6 top",
        value: function (d) {
            return formatcurrency(d.values[yearIndex].val);
        },
        side: function () {
            return " em " + (parseInt(closer.firstYear) + parseInt(yearIndex)).toString() + "."
        },
        cellClass: "value sum ",
        cellFunction: function (d, cell) {
            closer.table.renderAmount(d, cell)
        }
    },
    impact: {
        title: "Impacto",
        class: "span6 ",
        value: function (d) {
            return Math.max(0.01, (Math.round(d.values[yearIndex].val * 100 * 100 / closer.root.values[yearIndex].val) / 100)).toString() + "%";
        },
        side: function () {
            return " do total."
        },
        cardRenderer : function(d, cell){
            $(cell).html(Mustache.render($('#card-template').html(),this));
            if(this.value(d) === '100%') {
                $(cell).find('.card').css({ display : 'none'});
            }
        },
        cellClass: "value sum",
        cellFunction: function (d, cell) {
            closer.table.renderImpact(d, cell)
        }
    },
    individual: {
        title: "Individual",
        class: "span6 individual",
        value: function (d) {
            var percentage = d.values[yearIndex].val / closer.root.values[yearIndex].val;

            return '$' + (closer.userContribution * percentage).toFixed(2);
        },
        side: 'your yearly tax contribution.',
        cellClass: "value sum",
        cellFunction: function (d, cell) {
            closer.table.renderImpact(d, cell)
        }
    },
    growth: {
        title: "Crescimento",
        class: "span6 top",
        value: function (d) {
            return growth(d);
        },
        side: " comparado com o ano anterior.",
        cellFunction: function (d, cell) {
            closer.table.renderGrowth(d, cell)
        },
        cellClass: "value"
    },
    source: {
        title: "Fonte",
        class: "span6 card-source ",
        value: function (d) {
            return (d.src === '') ? longName : d.src;
        },
        link: function (d) {
            return (d.url === '') ? municipalURL : d.url;
        },
        cardRenderer : function(d, card){
            $card = $(card);
            $card.html(Mustache.render($('#card-template').html(), this));

            $card.attr('onclick', "window.location='" + this.link(d)  + "'");
                // prevent sliding animation
                $card.click(function(event){
                    // stop propagation
                stopPropagation(window.event || event);
            });
        },
        side: " "
    },
    mean: {
        title: "Média",
        class: "span6 ",
        value: function (d) {
            return formatcurrency(d3.mean(d.values, function(d) {return d.val}));
        },
        side: "em média."
    },
    filler: {
        title: "",
        class: "span6 ",
        value: function (d) {
            return "";
        },
        side: ""
    },
    name: {
        title: "Nome",
        cellClass: "value name long textleft",
        value: function (d) {
            return d.key;
        }
    },
    sparkline: {
        title: "Change",
        cellClass: "value sparkline",
        cellFunction: function (d, cell) {
            closer.table.renderSparkline(d, cell)
        }
    },
    section : {
        title: "Type",
        cellClass: "value",
        value: function (d){
            return d.section;
        }
    },
    parent : {
        title : "From",
        cellClass: "value parent",
        value: function (d){
            return (typeof(d.parent) === 'string') ? d.parent : '';
        }
    },
    mapLink : {
        title : "",
        cellClass: "value maplink",
        cellFunction: function (d, cell) {
            closer.table.renderMaplink(d, cell)
        }
    }
},

decks = {
    revenues: [stats.amount, stats.growth, stats.impact, stats.mean, stats.source],
    default: [stats.amount,  stats.growth, stats.impact, stats.mean, stats.source],
    funds: [stats.amount, stats.growth, stats.impact, stats.mean, stats.source]
},

tables = {
    revenues: [stats.name, stats.growth, stats.sparkline, stats.impact, stats.amount, stats.mapLink],
    default: [stats.name, stats.growth, stats.sparkline, stats.impact, stats.amount, stats.mapLink],
    funds: [stats.name, stats.growth, stats.sparkline, stats.impact, stats.amount, stats.mapLink],
    search: [stats.name, stats.growth, stats.sparkline, stats.amount, stats.parent,  stats.section, stats.mapLink]
}

/*
*   Formats currency
*
*   @param {float/int} value - number to be formatted
*   @return {string} formatted value
*/
function formatcurrency(value) {
    value = value * 1000
    if (value === undefined) {
        return "N/A";
    } else if (value >= 1000000) {
        return "€" + Math.round(value / 1000000).toString() + " M";
    } else if (value < 1000000 && value >= 1000) {
        //return "€" + Math.round(value / 1000).toString() + " K";
        return "€" + Math.round(value / 1000).toString() + ".000";
    } else if (value < 1 && value != 0) {
        return "c" + Math.round(value * 100).toString();
    } else {
        return "€ " + value.toString();
    }
}

/*
*   Formats currency with no rounding
*
*   @param {float/int} value - number to be formatted
*   @return {string} formatted value
*/
function formatCurrencyExact(value) {
    var commasFormatter = d3.format(",.0f")
    return "€ " + commasFormatter(value);
}

/*
*   Formats percentage
*
*   @param {float/int} value - number to be formatted
*   @return {string} formatted value
*/
function formatPercentage(value) {
    if (value > 0) {
        return "+ " + value.toString() + "%";
    } else if (value < 0) {
        return "- " + Math.abs(value).toString() + "%";
    } else {
        return Math.abs(value).toString() + "%";
    }
}

/*
*   Calculates growth (% change) compared to previous datapoint
*
*   @param {node} data - node for which growth has to be computed
*   @return {string} - growth in %
*/
function growth(data) {
    var previous = (data.values[yearIndex - 1] !== undefined) ? data.values[yearIndex - 1].val : 0;
    var perc = Math.round(100 * 100 * (data.values[yearIndex].val - previous) / data.values[yearIndex].val) / 100;
    return formatPercentage(perc);
};

