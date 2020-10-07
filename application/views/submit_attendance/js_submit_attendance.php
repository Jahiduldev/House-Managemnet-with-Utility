
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_submit_attendance.js"></script>


<script>

    $("#submitBtn").click(function(){
        var progressbar = $('#progressbar'),
        max = progressbar.attr('max'),
        time = (100000/max)*5,
        value = progressbar.val();
        progressbar.show();
        var loading = function() {
            value += 1;
            addValue = progressbar.val(value);
            if(value==100){             
                progressbar.val(0)
                progressbar.hide();
            }
            $('.progress-value').html(value + '%');

            if (value == max) {
                clearInterval(animate);
            }
        };

        var animate = setInterval(function() {
            loading();
        }, time);
    });
</script>

</body>
</html>
