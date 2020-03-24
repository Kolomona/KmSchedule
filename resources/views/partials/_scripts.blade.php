<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        var tempDate = $('#period_date').val();
        $j("#period_date").datepicker();
        $j("#period_date").datepicker("option", "dateFormat", "yy-mm-dd");
        $j('#period_date').val(tempDate);

        // support for hiding inactive employees
        // This seems very kludgy, there must be a better way
        var select = document.getElementById('hide_inactive_employees');
        select.onchange = function(){
            this.form.action = 'users?hide_inactive_employees=' + this.checked;
            this.form.submit(); 
        };
    });
    
    

</script>