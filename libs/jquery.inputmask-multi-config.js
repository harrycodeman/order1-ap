jQuery(document).ready(function(){
var maskList = jQuery.masksSort(jQuery.masksLoad("./wp-content/themes/imbalance2/libs/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
                            var maskOpts = {
                                inputmask: {
                                    definitions: {
                                        '#': {
                                            validator: "[0-9]",
                                            cardinality: 1
                                        }
                                    },
                                    //clearIncomplete: true,
                                    showMaskOnHover: false,
                                    autoUnmask: true
                                },
                                match: /[0-9]/,
                                replace: '#',
                                list: maskList,
                                listKey: "mask",
                                onMaskChange: function(maskObj, determined) {
                                    if (determined) {
                                        var hint = maskObj.name_ru;
                                        if (maskObj.desc_ru && maskObj.desc_ru != "") {
                                            hint += " (" + maskObj.desc_ru + ")";
                                        }
                                        jQuery("#descr").html(hint);
                                    } else {
                                        jQuery("#descr").html("Маска ввода");
                                    }
                                    jQuery(this).attr("placeholder", jQuery(this).inputmask("getemptymask"));
                                }
                            };

                            var listRU = jQuery.masksSort(jQuery.masksLoad("./wp-content/themes/imbalance2/libs/phones-ru.json"), ['#'], /[0-9]|#/, "mask");
                            var optsRU = {
                                inputmask: {
                                    definitions: {
                                        '#': {
                                            validator: "[0-9]",
                                            cardinality: 1
                                        }
                                    },
                                    //clearIncomplete: true,
                                    showMaskOnHover: false,
                                    autoUnmask: true
                                },
                                match: /[0-9]/,
                                replace: '#',
                                list: listRU,
                                listKey: "mask",
                                onMaskChange: function(maskObj, determined) {
                                    if (determined) {
                                        if (maskObj.type != "mobile") {
                                            jQuery("#descr").html(maskObj.city.toString() + " (" + maskObj.region.toString() + ")");
                                        } else {
                                            jQuery("#descr").html("мобильные");
                                        }
                                    } else {
                                        jQuery("#descr").html("Маска ввода");
                                    }
                                    jQuery(this).attr("placeholder", jQuery(this).inputmask("getemptymask"));
                                }
                            };

                            jQuery('#phone_mask, input[name="mode"]').change(function() {
                                if (jQuery('#phone_mask').is(':checked')) {
                                    if (jQuery('#is_world').is(':checked')) {
                                        jQuery('#customer_phone').inputmasks(maskOpts);
                                    } else {
                                        jQuery('#customer_phone').inputmasks(optsRU);
                                    }
                                } else {
                                    jQuery('#customer_phone').inputmask("+[####################]", maskOpts.inputmask)
                                    .attr("placeholder", jQuery('#customer_phone').inputmask("getemptymask"));
                                    jQuery("#descr").html("Маска ввода");
                                }
                            });
			
                            jQuery('#phone_mask').change();
})