jQuery.fn.table2CSV = function(options) {
    var options = jQuery.extend({
        separator: ',',
        header: [],
        delivery: 'popup' // popup, value
    },
    options);

    var csvData = [];
    var headerArr = [];
    var el = this;

    //header
    var numCols = options.header.length;
    var tmpRow = []; // construct header avalible array

    if (numCols > 0) {
        for (var i = 0; i < numCols; i++) {
            tmpRow[tmpRow.length] = formatData(options.header[i]);
        }
    } else {
        $(el).filter(':visible').find('th').each(function() {
            if ($(this).css('display') != 'none') tmpRow[tmpRow.length] = formatData($(this).html());
        });
    }

    row2CSV(tmpRow);

    // actual data
    $(el).find('tr').each(function(i) {
        if(i > 0) {
            var tmpRow = [];
            $(this).filter(':visible').find('td').each(function(j) {
                if ($(this).css('display') != 'none') {
                    var data = $(this).html();
                    tmpRow[tmpRow.length] = formatData(data);
                }    
            });
            row2CSV(tmpRow);
        }
    });
    if (options.delivery == 'popup') {
        var mydata = csvData.join('\n');
        return popup(mydata);
    } else {
        var mydata = csvData.join('\n');
        return mydata;
    }

    function row2CSV(tmpRow) {
        var tmp = tmpRow.join('') // to remove any blank rows
        // alert(tmp);
        if (tmpRow.length > 0 && tmp != '') {
            var mystr = tmpRow.join(options.separator);
            csvData[csvData.length] = mystr;
        }
    }
    function formatData(input) {
        // replace " with “
        var regexp = new RegExp(/["]/g);
        var output = input.replace(regexp, "“");
        //HTML
        var regexp = new RegExp(/\<[^\<]+\>/g);
        var output = output.replace(regexp, "");
        if (output == "") return '';
		return output;
    }
    function popup(data) {
    	var url = $("#search-url").val();
        $(".export-form").append('<form id="exportform" action="'+ url +'" method="post" ><input type="hidden" id="exportdata" name="exportdata" /></form>');
        $("#exportdata").val(data);
        $("#exportform").submit().remove();
        return true; 
    }
};

(function($) {
    $(".btn-export").click(function() {
        $(".data-search-table").table2CSV({
            header:['Status', 'Application ID', 'Applicant Name', 'Applicant Mobile', 'Loan Amount', 'Approved or Decline', 'Date/Time Application Approved or Rejected', 'Manual Status', 'Manual Stages', 'Manual Products', 'Manual Brand', 'Manual Leadgen', 'Manual Broker', 'Term Accepted', 'Broker ID']
        });		
        return true;
    });
})(jQuery);