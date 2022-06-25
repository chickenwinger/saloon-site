$(function () {
    $('.btn-size-charts').click(function () {
        $(".size-bg").css({
            "display": "block"
        });
    });
    $('.close-size').click(function () {
        $(".size-bg").css({
            "display": "none"
        });
    });
});

$(function () {
    var dtToday = new Date(); //store today's date

    var month = dtToday.getMonth() + 1; //april format:0-11... now is'3'
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var maxYear = dtToday.getFullYear() + 1;

    if (maxYear % 4 == 0 && month == 2 && day == 29) {
        day = day - 1;
    }

    if (month < 10) {
        month = '0' + month.toString(); //change to text so... its 03 (default must have 0) which is march
    }
    if (day < 10) {
        day = '0' + day.toString();
    }

    var minDate = year + '-' + month + '-' + day; //rmb date format in html5 is yyyy/mm/dd
    var maxDate = maxYear + '-' + month + '-' + day;
    $('.date1').attr('min', minDate);
    $('.date1').attr('max', maxDate);
});
