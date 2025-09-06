/*
Author : vishal
Work: All common funciton which needed for Pay Slip Projects
*/
$(document).ready(function() {
    $(document).on('click','.generatePaySlipPDF',function() {
        $.ajax({
            type: 'POST',
            url: completeURL(url),
            dataType: 'html',
            success: function (data) {

                $('#salaryGeneratePreview').html(data);

            },
            complete: function () {
                setTimeout(function () {
                    $('.slipGenerate').removeAttr('disabled');
                }, 2000);
            }
        });
    });
});