<!--htmls/js_calendar.php-->

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/i18n/jquery-ui-i18n.min.js"></script>

<script>
    $(document).ready(function(){
        $.datepicker.setDefaults(
            $.extend($.datepicker.regional["ru"])
        );
        $("<?php echo $element_id; ?>").datepicker();
    });
</script>
