jQuery(function ($) {

    $("#start-date").datepicker({
        dateFormat: "dd-M-yy",
//        minDate: 0,
        onSelect: function () {
            var dt2 = $('#end-date');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate) / (86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30) {
                dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
//            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#end-date').datepicker({
        dateFormat: "dd-M-yy"
    });

    $('#time').timepicker({
        timeFormat: 'H:mm',
        interval: 60,
        dynamic: false,
        dropdown: true
    });

});