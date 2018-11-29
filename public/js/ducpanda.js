 $(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            var count = 0;
            checkbox.each(function(){
                this.checked = true;                        
            });
            count_item_delete();
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
            count_item_delete();
        }
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
        count_item_delete();
    });
    function count_item_delete() {
        var count = $('table tbody input[type="checkbox"]:checked').length;
        if (count > 0) {
            $('.check_number_delete').text(count);
        }else{
            $('.check_number_delete').text('');
        }
    }
});


    $('.change_filter').on('change', function(event) {
        filter_form();
    });
    function filter_form() {
        $('#filter_form').submit();
    }

    $('.delete_one').on('click', function(event) {
        $('#deleteEmployeeModal').modal('show');
        var id = $(this).data('id');
        $('#deleteEmployeeModal').find('.list_id').val(id);
    });

    $('.delete_mute').on('click', function(event) {

        var ckUnit = [];
        var i =0;
        $('.delete_mute_value').each(function(index, el) {
            if ($(this).is(':checked')) {
                ckUnit[i] = $(this).val();
                i++;
            }
        });
        var list_id = _.join(ckUnit, [separator=',']);
        if (!_.isEmpty(list_id)) {
            $('#deleteEmployeeModal').find('.list_id').val(list_id);
            $('#deleteEmployeeModal').modal('show');
        }

    });