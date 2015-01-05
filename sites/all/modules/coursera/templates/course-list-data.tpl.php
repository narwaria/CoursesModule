<?php
/** 
 * Available variables:
 * - $coursesListArray
 * 
 */
?>

<?php if (count($coursesListArray) == 0): ?>
    <li class="list-group-item text-center"><?php echo t("No record found"); ?></li>
<?php else: ?>
    <?php foreach ($coursesListArray as $course): ?>
        <li class="list-group-item"> 
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php print $course["photoUrl"]; ?>?auto=format&amp;dpr=1&amp;w=300" alt="...">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <?php if (is_array($course["partners"])): ?>
                        <?php foreach ($course["partners"] as $partner): ?>
                            <h4><?php print $partner["name"]; ?></h4>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <p>                        
                        <?php echo  l(t($course["name"]), "coursera/courser/{$course["slug"]}", array('attributes' => array('class' => array('about-link')))); ?>
                        <br />with
                        <?php
                        $andsymbol = "";
                        foreach ($course["instructors"] as $insValue):
                            echo isset($insValue["prefixName"]) ? " " . t($andsymbol) . " " . t($insValue["prefixName"]) : $andsymbol;
                            echo isset($insValue["firstName"]) ? " " . t($insValue["firstName"]) : "";
                            echo isset($insValue["middleName"]) ? " " . t($insValue["middleName"]) : "";
                            echo isset($insValue["lastName"]) ? " " . t($insValue["lastName"]) : "";
                            $andsymbol = "&";
                        endforeach;
                        ?>
                    </p>
                    <?php //print_r($certificates); ?>            
                    <?php if (in_array("Specialization", $course["certificates"])): ?>
                        <button class="btn btn-default " type="button" ><?php echo t("Specializations"); ?></button>
                    <?php elseif (in_array("VerifiedCert", $course["certificates"])): ?>
                        <button class="btn btn-default " type="button" ><?php echo t("Verified Certificate"); ?></button>
                    <?php else: ?>
                        <button class="btn btn-success" type="button" ><?php echo t("Learn now!"); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endforeach; ?>    
<?php endif; ?>