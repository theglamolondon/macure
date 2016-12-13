/**
 * Created by BW.KOFFI on 29/11/2016.
 */

<!-- bootstrap-daterangepicker -->
$(document).ready(function() {
    moment.locale('fr');
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4"
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });

    $('.datepicker-time').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        calender_style: "picker_4",
        timePickerIncrement: 5,
        language:'fr',
        timePicker24Hour : true,
        locale: {
            format: 'DD/MM/YYYY H:mm',
            applyLabel: 'Valider',
            cancelLabel: 'Annuler'
        }
    });

    <!-- Select2 -->
    $(".select2_single").select2({
        allowClear: false,
        placeholder: "Select a state",
        minimumResultsForSearch: -1
    });
    <!-- /Select2 -->
});