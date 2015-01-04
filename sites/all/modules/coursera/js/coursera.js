/**
 * 
 * Jquery for display checkbox listing.
 */
jQuery(function () {
    jQuery("body").on('click', ".checked-list-box li.tick", function () {
        if (jQuery(this).hasClass("list-group-item-primary")) {
            jQuery(this).removeClass("list-group-item-primary active").find(".state-icon").addClass("glyphicon-unchecked").removeClass("glyphicon-check")
        } else {
            jQuery(this).addClass("list-group-item-primary active").find(".state-icon").addClass("glyphicon-check").removeClass("glyphicon-unchecked");
        }
        jQuery("body #get-checked-data").trigger("click");
    });
    /*
     * jQuery code for managing check listing.
     */
    jQuery('body').on('click', "#get-checked-data", function (event) {
        event.preventDefault();
        jQuery(".course-list-data").html("<li class='list-group-item text-center'>Loading please wait</li>")
        var checkedItems = {}, counter = 0, checkedItemsList = {};
        jQuery("#check-list-box li.active").each(function (idx, li) {
            checkedItems[counter] = jQuery(li).text();
            if (checkedItemsList[jQuery(li).find(".key-value-pair").attr("key")]) {
                checkedItemsList[jQuery(li).find(".key-value-pair").attr("key")] = checkedItemsList[jQuery(li).find(".key-value-pair").attr("key")] + "," + jQuery(li).find(".key-value-pair").attr("data");
            } else {
                checkedItemsList[jQuery(li).find(".key-value-pair").attr("key")] = jQuery(li).find(".key-value-pair").attr("data");
            }
            counter++;
        });
        var urlString = "", andopertor = "";
        jQuery.each(checkedItemsList, function (index, value) {
            if (urlString != "") {
                andopertor = "&";
            }
            if (value) {
                urlString += andopertor + index + "=" + value;
            }
        });
        
         /*
         * Ajax integration to load the courses requested.
         */
        jQuery.get(Drupal.settings.basePath+"coursera/listing?" + urlString, {"ajaxcall": "true"}, function (data) {
            if (data.list != "") {
                jQuery(".course-list-data").html(data.list);
            }
            if (data.paging != "") {
                jQuery(".key-value-pair").html("0");
                jQuery.each(data.paging.courseType.facetEntries, function (index, value) {
                    jQuery("#"+value.id.replace('.', '_')).html(value.count);
                });
                jQuery.each(data.paging.certificates.facetEntries, function (index, value) {
                    jQuery("#"+value.id).html(value.count);
                });
                jQuery.each(data.paging.languages.facetEntries, function (index, value) {
                    jQuery("#"+value.id).html(value.count);
                });
                jQuery.each(data.paging.categories.facetEntries, function (index, value) {
                    jQuery("#"+value.id).html(value.count);
                });               
            }
            
        });        
        /*
         * below code for dubug search urls
         */
        jQuery("#display-urldata").html(urlString);
        jQuery('#display-json').html(JSON.stringify(checkedItemsList, null, '\t'));
        //jQuery('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });
});