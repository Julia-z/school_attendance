function export_data(tid, with_edit = false, name = '') {

    tid = '#' + tid;

    var row_length = -1; // we want the row length WITHOUT the edit/add
    if(with_edit == false) { row_length = 0; }
    var table_headers = []

    // iterate over table headers...
    $(tid + ' thead th').each(function() {
        table_headers.push($(this).html());
        row_length++;
    });

    var table_data = '';

    for(var i = 0; i < row_length; i++) {
        table_data += table_headers[i] + ';:;';
    }

    // now iterate over all other rows and fill
    var local_count = 0;
    $(tid + ' tbody tr th').each(function() {
        if(local_count != row_length || with_edit == false) {
            var data = $(this).html();
            table_data = table_data + data + ';:;';
        }

        if(local_count == (row_length)) {
            local_count = -1;
            if(with_edit == false) local_count = 0;
        }

        local_count++;
    });

    $('#export_table_name').val(name);
    $('#row_length').val(row_length);
    $('#table_data').val(table_data.substring(0, table_data.length-3));
    $('#export_data_form').submit();
}
