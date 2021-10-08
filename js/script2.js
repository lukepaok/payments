

    $(document).ready(function() {
	
	
     $("body").backstretch("/payments/images/bg_main.jpg");

	
	 $(".navbar-link").click(function(){
	 
	 window.location.replace("/payments");
	 $('form').reset();
	 
	 });
        $.datepicker.regional['el'] = {
            closeText: 'Επιλογή',
            prevText: 'Προηγούμενος',
            nextText: 'Επόμενος',
            currentText: 'Τρέχων Μήνας',
            monthNames: ['Ιανουάριος','Φεβρουάριος','Μάρτιος','Απρίλιος','Μάιος','Ιούνιος',
                'Ιούλιος','Αύγουστος','Σεπτέμβριος','Οκτώβριος','Νοέμβριος','Δεκέμβριος'],
            monthNamesShort: ['Ιαν','Φεβ','Μαρ','Απρ','Μαι','Ιουν',
                'Ιουλ','Αυγ','Σεπ','Οκτ','Νοε','Δεκ'],
            dayNames: ['Κυριακή','Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο'],
            dayNamesShort: ['Κυρ','Δευ','Τρι','Τετ','Πεμ','Παρ','Σαβ'],
            dayNamesMin: ['Κυ','Δε','Τρ','Τε','Πε','Πα','Σα'],
            weekHeader: 'Εβδ',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['el']);



    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/yy",
        showButtonPanel: true,
        currentText: "Τρέχων Μήνας",
        onChangeMonthYear: function (year, month, inst) {
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month - 1, 1)));
        },
        onClose: function(dateText, inst) {
            var month = $(".ui-datepicker-month :selected").val();
            var year = $(".ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
        }
    }).focus(function () {
            $(".ui-datepicker-calendar").hide();
        }).after(
            $("<a id='clear'' href='javascript: void(0);'>Επαναφορά</a>").click(function() {
                $(this).prev().val('');
            }));

});