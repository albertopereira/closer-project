window.addEventListener('load', function() {

    document.getElementById('entitySelector').addEventListener('change', function() {

        var selectVal = this.options[this.selectedIndex].value

        window.location.replace('/home/' + selectVal)

    })


    $(".form-confirm .confirmActionForm").on('click', function(e){
      selectedForm = $(this).parents('form:first');

      $("#confirm_modal").modal({
            backdrop: false
        });
    });

    $('.confirmAction').on('click', function(e){
        $("#confirm_modal").modal('hide');
        selectedForm.submit();
    });

    $('#confirm_modal').on('show.bs.modal', function (event) {
        var textInput = selectedForm.data('text');
        var titleInput = selectedForm.data('title');
        var modal = $(this);
        modal.find('#text').text(textInput);
        modal.find('.modal-title').text(titleInput);
    })


    let arrayData = []
    let jsonYears = []
    let jsonLevels = 0    

     // convert json to array for handsontable
    function parseJSONData(objs, row = []){
      for (var i in objs) {
        if(!objs[i].hasOwnProperty('sub')){
                         
            row.push(objs[i].key)
            row.push(objs[i].descr)
            row.push(objs[i].src)
            row.push(objs[i].url)
            row.push(objs[i].coords)

            // get years for first row of array (push it after)
            for(y in objs[i].values){
              row.push(objs[i].values[y].val)
              if(jsonYears.indexOf(objs[i].values[y].year) === -1)  
                jsonYears.push(objs[i].values[y].year)
            }            

            if(arrayData.length){
              for (var j = 0; j < arrayData[0].length - row.length; j++) {
                row.unshift('')
              }
            }

            arrayData.push(row.splice(0))
            row.length = 0
        }

        if(objs[i].hasOwnProperty('sub')){
            row.push(objs[i].key)
            parseJSONData(objs[i].sub, row)
        }
      }
    }

    function getNLevels(objs){
      jsonLevels += 1

      for (var i in objs) {
        if(objs[i].hasOwnProperty('sub')){
          getNLevels(objs[i].sub)
          
          return
        }
      }
    }

    parseJSONData(jsonData.sub)
    getNLevels(jsonData.sub)

    let firstRow = []

    for (var i = 1; i <= jsonLevels; i++) {
      firstRow.push('Level ' + i) 
    }

    firstRow.push('Description')
    firstRow.push('Source')
    firstRow.push('Source URL')
    firstRow.push('Coords')
    firstRow = firstRow.concat(jsonYears)

    arrayData.unshift(firstRow)

    var data = arrayData,
      container = document.getElementById('data-content'),
      rowHeaders = document.getElementById('rowHeaders'),
      colHeaders = document.getElementById('colHeaders'),
      hot,
      level = 0,
      year = 0;

    hot = new Handsontable(container, {
      startRows: 15,
      startCols: 16,
      rowHeaders: false,
    //  colHeaders: function(index) {
    //    return index + ': AB';
    //  },
      colHeaders: false,
      minSpareCols: 1,
      minSpareRows: 1,
      mergeCells: true,
      fixedRowsTop: 1,
      autoRowSize: true,
      wordWrap: false,
      contextMenu: ['row_above', 'row_below', 'remove_row', '---------', 'mergeCells', '---------', 'undo', 'redo', 'copy', 'cut'],
      outsideClickDeselects: false,
      removeRowPlugin: true
    });
    hot.loadData(data);

    Handsontable.dom.addEvent(addLevel, 'click', function () {
      hot.alter('insert_col', level);
      hot.setDataAtCell(0, level, 'Level ' + (level + 1));
      level++;
      year++;
    });

    Handsontable.dom.addEvent(removeLevel, 'click', function () {
      if(level > 1){
        level--;
        year--;
        hot.alter('remove_col', level);
      }
    });

    Handsontable.dom.addEvent(addYear, 'click', function () {
      hot.alter('insert_col', year);
      var currentYear = parseInt(hot.getDataAtCell(0,year - 1));
      hot.setDataAtCell(0, year, (currentYear + 1));
      year++;
    });

    Handsontable.dom.addEvent(removeYear, 'click', function () {
      if(year > (level + 4)) {
        year--;
        hot.alter('remove_col', year);
      }
    });

    function getLevel() {
      let level = 0;
      for (var i = 0; i < data[0].length - 1; i++) {
        if(isNaN(data[0][i]) && data[0][i].startsWith('Level')){
          level++;
        }
      }
      return level
    }

    function getYear() {
        return data[0].length - 1
    }

    level = getLevel()
    year = getYear()

    // Handsontable.dom.addEvent(showObject, 'click', function () {
    function dataToJSON(){
      let data = hot.getSourceData()
      let levels = 0;
      let years = 0;

      // number of levels
      levels = data[0].reduce(function (level, item) {
        if (item !== null && String(item).startsWith('Level')) {
          return level + 1;
        } else return level + 0
      }, 0);

      // number of years
      years = data[0].length - (levels + 5)

      // json structured object
      let f = []

      for (var i = 1; i < data.length - 1; i++) {

        let pushed = false

        let yrs = []
        
        for (var j = data[i].length - years - 1; j < data[i].length - 1; j++) {
          if(data[i][j] === null)
            data[i][j] = 0
          yrs.push({'year': String(data[0][j]), 'val': parseInt(data[i][j])})
        }

        let value = {
          'key': data[i][levels - 1],
          'src': data[i][levels + 1],
          'url': data[i][levels + 2],
          'coords': data[i][levels + 3],
          'descr': data[i][levels],
          'hash': Math.random().toString(36).substr(2, 5), 
          'values': yrs
        }

        for (var lvl = levels - 2; lvl >= 0; lvl--) {
          if (data[i][lvl] != '') {
            value = {
              'key': data[i][lvl],
              'descr': data[i][lvl],
              'hash': Math.random().toString(36).substr(2, 5), 
              'values': [],
              'sub': [value]
            }
            for (var ii = data[i].length - years - 1; ii < data[i].length - 1; ii++) {
              value.values.push({'year': String(data[0][ii]), 'val': 0})
            }
          } else if (!pushed){
            getLastLevel(f, value, lvl)
            pushed = true
          }
        }

        if(!pushed)
          f.push(value)

      }

      for (var i = 0; i < f.length; i++) {
        calculateValues(f[i])
      }

      let budget = {
        "key": $('#entity_org_name').text().trim(),
        "descr": $('#budgetSelector option:selected').text().trim(),
        "src": $('#entity_org_email').text().trim(),
        "hash": Math.random().toString(36).substr(2, 5),
        "coords":"38.7057302,-9.1414086",
        "sub": f,
        "values": []
      }

      for (var i = 0; i < f.length; i++) {
        for (var j = 0; j < f[i].values.length; j++) {
            let exists = false

            for (var k = 0; k < budget.values.length; k++) {
                if(budget.values[k].year == f[i].values[j].year) {
                    budget.values[k].val += f[i].values[j].val
                    exists = true
                }
            }

            if(!exists) {
                budget.values.push({'year': String(f[i].values[j].year), 'val': parseInt(f[i].values[j].val)})
            }
        }
      }

      return JSON.stringify(budget)
    }

    function getLastLevel(obj, value, toLvl, startLvl = 0) {
      if (
        (obj[obj.length - 1].hasOwnProperty('sub') && !obj[obj.length - 1].sub[obj[obj.length - 1].sub.length - 1].hasOwnProperty('sub')) ||
        startLvl == toLvl){
        obj[obj.length - 1].sub.push(value)
      } else if(
        obj[obj.length - 1].hasOwnProperty('sub') && 
        obj[obj.length - 1].sub[obj[obj.length - 1].sub.length - 1].hasOwnProperty('sub')
        ){
        return getLastLevel (obj[obj.length - 1].sub, value, toLvl, startLvl + 1)
      }
    }

    function calculateValues(obj){
      if(obj.hasOwnProperty('sub')){
        for (var j = 0; j < obj.sub.length; j++) {
          values = calculateValues(obj.sub[j])

          for (var i = 0; i < obj.values.length; i++) {
            for (var ii = 0; ii < values.length; ii++) {
              if (obj.values[i].year == values[ii].year) {
                obj.values[i].val = parseInt(obj.values[i].val) + parseInt(values[ii].val)
              }
            }
          }
        }
      }

      return obj.values
    }

    $('#saveData').on('click', function(){
        $('#formattedJSON').val(dataToJSON())
    })

    function updateIconClicks() {

      $('.icon').unbind()
      $('.remove-single-view').unbind()
      $('[data-toggle="tooltip"]').tooltip("destroy")

      $('.remove-single-view').on('click', function () {
        $('.single-view[data-content=' + $(this).attr('data-content') + ']').remove()
      })

      $('[data-toggle="tooltip"]').tooltip();

      $('.icon').on('click', function(){
        $(this).toggleClass('selected')

        $('.cb[data-type=' + $(this).attr('data-type') + '][data-content=' + $(this).attr('data-content') + ']').prop("checked", !$('.cb[data-type=' + $(this).attr('data-type') + '][data-content=' + $(this).attr('data-content') + ']').prop("checked"));
      })
    }

    $('#new_view').on('click', function (e) {

      e.preventDefault()
      let data_content = parseInt($('.single-view:last').attr('data-content')) + 1

      $('.views').append(
          `<div class="single-view" data-content="` + data_content + `" >
            <input type="checkbox" data-content="` + data_content + `" name='v[` + data_content + `]["gt"]' class="cb" data-type="gt">
            <input type="checkbox" data-content="` + data_content + `" name='v[` + data_content + `]["m"]' class="cb" data-type="m">
            <input type="checkbox" data-content="` + data_content + `" name='v[` + data_content + `]["t"]' class="cb" data-type="t">

            <img src="` + iconsHome + `/graph_treemap.png" class="icon big" data-toggle="tooltip" title="Graph & Treemap" data-content="` + data_content + `" data-type="gt">
            <img src="` + iconsHome + `/map.png" class="icon" data-toggle="tooltip" title="Heatmap" data-content="` + data_content + `" data-type="m">
            <img src="` + iconsHome + `/tabular.png" class="icon" data-toggle="tooltip" title="Tabular" data-content="` + data_content + `" data-type="t">
            <button class="btn pull-right btn-xs btn-danger remove-single-view" data-content="` + data_content + `">Remove</button>
          </div>`
      )

      updateIconClicks()
    })

    updateIconClicks()

})

    