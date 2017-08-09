/**
 * Created by nancy on 15-7-6.
 */
/*
 region linkage
 */

$.fn.linkage = function (options) {
    var default_option = {
        html: '<option value="0" selected="" disabled="">请选择...</option>',
        $city: $('.city'),
        data: []
    };

    if (options) {
        $.extend(default_option, options)
    }

    $(this).append(default_option.html);
    default_option.$city.append(default_option.html);

    for (var i = 0; i < default_option.data.length; i++) {
        $(this).append("<option value=" + default_option.data[i].value + ">" + default_option.data[i].show + "</option>");
    }

    $(this).on('change', function (e) {
        var valueSelected = this.value;

        for (var i = 0; i < default_option.data.length; i++) {
            if (valueSelected === default_option.data[i].value) {
                var cityOption = '<option value="0" selected="" disabled="">市/(区、县)</option>';
                for (var j = 0; j < default_option.data[i].children.length; j++) {
                    cityOption += '<option value="' + default_option.data[i].children[j].value + '">' + default_option.data[i].children[j].show + '</option>';
                }
                default_option.$city.empty().append(cityOption);
            }
        }
    });
}