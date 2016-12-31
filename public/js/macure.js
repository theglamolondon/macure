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
        placeholder: "Choisir un item",
        minimumResultsForSearch: -1
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
        //maximumSelectionLength: 4,
        placeholder: "Vous pouvez sélectionner plusieurs",
        allowClear: true
    });
    <!-- /Select2 -->
});