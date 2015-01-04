<?php
$ondemandkey = array_search("v2.ondemand", array_column($courseType["facetEntries"], 'id'));
$SpecializationKey = array_search("Specialization", array_column($certificates["facetEntries"], 'id'));
$VerifiedCertKey = array_search("VerifiedCert", array_column($certificates["facetEntries"], 'id'));

$languages_sort = array_sort($languages["facetEntries"], 'count', SORT_DESC);
$categories = array_sort($categories["facetEntries"], 'name', SORT_ASC);

$checkCourseTypeActive = isset($_GET["courseType"]) ? 1 : 0;

$getCertificateArray = isset($_GET["certificates"]) ? explode(",", $_GET["certificates"]) : array();
$getLanguagesArray = isset($_GET["languages"]) ? explode(",", $_GET["languages"]) : array();
$getCategoriesArray = isset($_GET["categories"]) ? explode(",", $_GET["categories"]) : array();
?>

<ul id="check-list-box" class="list-group checked-list-box">
    <li class="list-group-item tick <?php if ($checkCourseTypeActive == 1): ?>list-group-item-primary active<?php endif; ?>" >
        <?php if ($checkCourseTypeActive == 1): ?>
            <span class="state-icon glyphicon glyphicon-check"></span>
        <?php else: ?>
            <span class="state-icon glyphicon glyphicon-unchecked"></span>
        <?php endif; ?>
        On-Demand <div key="courseType" data="v2.ondemand" id="v2_ondemand" class="key-value-pair pull-right">
            <?php echo (is_numeric($ondemandkey)) ? $courseType["facetEntries"][$ondemandkey]["count"] : "0"; ?>
        </div>
    </li>
    <li class="list-group-item tick <?php if (in_array("VerifiedCert", $getCertificateArray)): ?>list-group-item-primary active<?php endif; ?>">
        <?php if (in_array("VerifiedCert", $getCertificateArray)): ?>
            <span class="state-icon glyphicon glyphicon-check"></span>
        <?php else: ?>
            <span class="state-icon glyphicon glyphicon-unchecked"></span>
        <?php endif; ?>                    
        Verified Certificates <div key="certificates" data="VerifiedCert" id="VerifiedCert" class="key-value-pair pull-right"><?php echo ($VerifiedCertKey !== "") ? $certificates["facetEntries"][$VerifiedCertKey]["count"] : "0"; ?></div>
    </li>
    <li class="list-group-item tick <?php if (in_array("Specialization", $getCertificateArray)): ?>list-group-item-primary active<?php endif; ?>">
        <?php if (in_array("Specialization", $getCertificateArray)): ?>
            <span class="state-icon glyphicon glyphicon-check"></span>
        <?php else: ?>
            <span class="state-icon glyphicon glyphicon-unchecked"></span>
        <?php endif; ?>
        Specialization <div key="certificates" data="Specialization" id="Specialization" class="key-value-pair pull-right"><?php echo ($SpecializationKey !== "") ? $certificates["facetEntries"][$SpecializationKey]["count"] : "0"; ?></div>
    </li>
    <li class="list-group-item btn-primary active">All Languages</li>
    <?php foreach ($languages_sort as $lang): ?>
        <li class="list-group-item tick <?php if (in_array($lang["id"], $getLanguagesArray)): ?>list-group-item-primary active<?php endif; ?>">
            <?php if (in_array($lang["id"], $getLanguagesArray)): ?>
                <span class="state-icon glyphicon glyphicon-check"></span>
            <?php else: ?>
                <span class="state-icon glyphicon glyphicon-unchecked"></span>
            <?php endif; ?>
            <?php echo drupal_ucfirst($lang["name"]); ?> <div key="languages" id="<?php echo $lang["id"]; ?>" data="<?php echo $lang["id"]; ?>" class="key-value-pair pull-right"><?php echo $lang["count"]; ?></div></li>
        <?php endforeach; ?>
    <li class="list-group-item btn-primary active">All Categories</li>
    <?php foreach ($categories as $category): ?>
        <li class="list-group-item tick <?php if (in_array($category["id"], $getCategoriesArray)): ?>list-group-item-primary active<?php endif; ?>">
            <?php if (in_array($category["id"], $getCategoriesArray)): ?>
                <span class="state-icon glyphicon glyphicon-check"></span>
            <?php else: ?>
                <span class="state-icon glyphicon glyphicon-unchecked"></span>
            <?php endif; ?>
            <?php echo drupal_ucfirst($category["name"]); ?> 
            <div key="categories" id="<?php echo $category["id"]; ?>" data="<?php echo $category["id"]; ?>" class="key-value-pair pull-right">
                <?php echo $category["count"]; ?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<div class="hide">
    <button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button> 
    <pre id="display-json"></pre>
    <pre id="display-urldata"></pre>
</div>