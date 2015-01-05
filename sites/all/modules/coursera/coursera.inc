<?php
/**
 * This page handle the urls callback
 */

/*
 * This function server the url : "coursera/listing"  	 	
 */
function coursera_list() {
    $filterString = "";
    if (isset($_GET["courseType"])) {
        $filterString.="" . $_GET["courseType"];
    } else {
        $filterString.="v1.session,v2.ondemand";
    }
    if (isset($_GET["certificates"])) {
        $filterString.="&certificates=" . $_GET["certificates"];
    }
    if (isset($_GET["languages"])) {
        $filterString.="&languages=" . $_GET["languages"];
    }
    if (isset($_GET["categories"])) {
        $filterString.="&categories=" . $_GET["categories"];
    }
    $url = "https://www.coursera.org/api/courses.v1?fields=certificates,instructorIds,partnerIds,photoUrl,specializations,startDate,v1Details,partners.v1(homeLink,logo,name),instructors.v1(firstName,lastName,middleName,prefixName,profileId,shortName,suffixName),specializations.v1(logo,partnerIds,shortName),v1Details.v1(upcomingSessionId),v1Sessions.v1(durationWeeks,hasSigTrack)&includes=instructorIds,partnerIds,specializations,v1Details,specializations.v1(partnerIds),v1Details.v1(upcomingSessionId)&extraIncludes=_facets&q=search&courseType={$filterString}&limit=20";
    $dataObj = getDataByCurl($url);
	
    $courseListHtml = $html = "";
    $courseListArrayData = array();
    if (is_array($dataObj["elements"])) {
        foreach ($dataObj["elements"] as $key => $value) {
            if (is_array($value["instructorIds"])) {
                $instructions = array();
                foreach ($value["instructorIds"] as $insids) {
                    $key = array_search($insids, array_column($dataObj["linked"]["instructors.v1"], 'id')); // die;
                    $instructions["instructors"][] = ($dataObj["linked"]["instructors.v1"][$key]);
                }
                foreach ($value["partnerIds"] as $partnerid) {
                    $key = array_search($partnerid, array_column($dataObj["linked"]["partners.v1"], 'id'));
                    $instructions["partners"][] = ($dataObj["linked"]["partners.v1"][$key]);
                }
            }
            $coursedata = (array_merge($value, $instructions));
            $courseListArrayData[] = $coursedata;
        }
    }
    $courseListHtml = theme('courses_list_data', array("coursesListArray" => $courseListArrayData)); // Call the template for theme the array content
    $searchCourseFormHtml = theme('search_course_form', $dataObj["paging"]["facets"]); // Call the template for theme the array content
    
	// Check for Ajaxcall and return json object
	if (isset($_GET["ajaxcall"])) {
        return drupal_json_output(array("list" => $courseListHtml, "paging" => $dataObj["paging"]["facets"], "curlurl" => $url,));
    }
	
	// Theme the final html outputs.
    $html = theme('courses_output_html', array("courseListHtml" => $courseListHtml, 'searchCourseFormHtml' => $searchCourseFormHtml));
    
	return $html;
}

/*
 * This function server the url : "coursera/courser/%"  	 	
 */
function coursera_details() {	
    $arg=arg(2); //Load the third parameter from url.
    $url = "https://www.coursera.org/api/courses.v1?fields=categories,certificates,description,instructorIds,partnerIds,partnerLogo,photoUrl,previewLink,primaryLanguages,specializations,subtitleLanguages,v1Details,workload,partners.v1(classLogo,homeLink,logo,name,shortName),v1Details.v1(aboutTheCourse,courseFormat,courseSyllabus,faq,readings,recommendedBackground,sessionIds,videos),v1Sessions.v1(active,dbEndDate,durationString,hasSigTrack,instructorIds,startDay,startMonth,startYear),instructors.v1(firstName,fullName,lastName,middleName,partnerIds,partners,photo,prefixName,profileId,shortName,suffixName),languages.v1(englishName),specializations.v1(logo,name,partnerIds,shortName)&includes=categories,instructorIds,partnerIds,primaryLanguages,specializations,subtitleLanguages,v1Details,v1Details.v1(sessionIds),v1Sessions.v1(instructorIds),instructors.v1(partnerIds),specializations.v1(partnerIds)&q=slug&slug={$arg}";
    $dataObj = getDataByCurl($url);
    $html=theme("course_detail_page",$dataObj); // Call the template for theme the array content
    return $html;
}

function getDataByCurl($url = null) {
	$dataObj=array();
    if ($url != "") {
		//  Initiate curl
        $ch = curl_init();
		// Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
		// Execute
        $result = curl_exec($ch);
		// Closing
        curl_close($ch);
		// Will dump a beauty json :3
        $dataObj = json_decode($result, true);
    }
    return $dataObj;
}
