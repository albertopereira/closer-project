var closer = closer || {};

closer.navbar = function(){

	/*
	*	Input change event
	*/
	var searchChange = function(){
	    var  keyword = $(this).val();

	    // displays search results
	    function showResults(){
	    	// switch to table view
	        if(closer.navigation !== closer.table){
	            setMode('l');
	        };
	        // allow to go back
	        pushUrl(closer.section, closer.thisYear, 'l', closer.root.hash);
	        // show search results
	        closer.navigation.initialize($('#closer-wrap'), search(keyword));
	    }

	    // have a 300ms timeout from the time the user
	    // stops typing
	    clearTimeout(timer);
	    timer = setTimeout( showResults, 300);
	},

	/*
	*	Searches all datasets for keywords
	*
	*	@param {string} keyword - keyword to be searched
	*	@return {array} - array containing all matched nodes
	*/
	search = function(keyword){
	    var result = [];
	    // aggregate search results from all sections
	    $.each(closer.sections, function(){
	        var searchSection = this;
	        var newResult = searchObject(keyword, closer.data[this], closer.data);
	        // remember where searched element was found
	        $.each(newResult, function() {this.section = capitalize(searchSection)});
	        result = result.concat(newResult);
	    });
	    return result;
	},

	/*
	*	Recursively searches dataset
	*
	*	@param {string} keyword - keyword to be searched
	*	@param {object} object - object to be searched
	*	@param {object} parent - object parent
	*
	*/
	searchObject = function(keyword, object, parent){
		var index = object.key.toLowerCase().indexOf(keyword.toLowerCase());
		// ignore matches in mid word
		if (index !== 0 && object.key[index-1] !== ' ') index = -1;
		// each matched object has to report its parent name
		if(index != -1) { object.parent = parent.key};
		// results
	    var result = index !== -1 ? [object] : [];
	    // propagate recursively
	    if(object.sub !== undefined) {
	    	// propagate to all children
	        for(var i=0; i<object.sub.length; i++) {
	        	// aggregate children results
	            result = result.concat(searchObject(keyword, object.sub[i], object));
	        }
	    }
	    return result;
	},

	/*
	*	Removes right-handside portion of navbar
	*	Used in pages that do not have a map/table interactions
	*	(glossary, data...)
	*/
	minimize = function(){
		$('#navbar-links .entry').last().remove();
	},

	/*
	*	Initialize navigation bar
	*/
	initialize = function(){
		// year dropdown (non-mobile browsers)
		$dropdown = $('#yeardrop-container');
		$dropdownLabel = $('#yeardrop-label');
		$dropdownList = $('#yeardrop-list');

		// year selector (mobile browsers)
		$selector = $('#yeardrop-container-mobile');

		if(!jQuery.browser.mobile) {

			/*
			*	Desktop browser
			*/

			$dropdownList.html('');
			// add dropdown element for each year
			for(var i=closer.firstYear; i<=closer.lastYear; i++) {
				// render button
				$dropdownList.append(Mustache.render($('#dropdown-template').html(), [i]));
				// attach click action
				$dropdownList.find('li').last().click(function(event) {
					event.preventDefault();
					// get year
					var year = parseInt($(this).text());
					// change dropdown active entry to selected
					$dropdownLabel.html(year + ' <b class="caret"></b>');
					// change year
					changeYear(year);
					// close dropdown
					$dropdown.removeClass('open');
				});
			};
			// set current year and show dropdown
			$dropdownLabel.html(closer.thisYear + ' <b class="caret"></b>');
			$dropdown.show();

		} else {

			/*
			*	Mobile browser
			*/

			$selector.html('');
			// add option for each available year
			for(var i=closer.firstYear; i<=closer.lastYear; i++) {
				var html = '<option'
				+ ((i == closer.thisYear) ? ' selected="selected"' : ' ')
				+ 'value="' + i + '">' + i + '</option>';
				$selector.append(html);
			}
			// change year when selection changes
			$selector.change(function(){
				changeYear(parseInt($selector.val()));
			})

			//show selector
			$selector.show();
			$('#yeardrop').css({'vertical-align' : 'top'});
		}

		// Mobile browser don't have enough h space for long titles
		// in navbar, shorten names
		if(jQuery.browser.mobile) {
			$('#navbar-map').text('Map');
			$('#navbar-table').text('Table');
			$('#navbar-funds').text('Funds');
		}

	};

return{
	initialize : initialize,
	searchChange : searchChange,
	minimize : minimize
}
}();