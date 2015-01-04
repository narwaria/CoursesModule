<li class="list-group-item">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="<?php print $photoUrl; ?>?auto=format&amp;dpr=1&amp;w=300" alt="...">
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <h4><?php print t($name); ?></h4>
            <p><?php print t($slug); ?></p>
<!--            <p><?php print $startDate; ?></p>
            <p><?php print date("Y-m-d H:i:s", $startDate); ?></p>-->
            <p>with 
                <?php $andsymbol = "";
                foreach ($instructors as $insValue):
                    echo isset($insValue["prefixName"]) ? " " . t($andsymbol) . " " . t($insValue["prefixName"]) : $andsymbol;
                    echo isset($insValue["firstName"]) ? " " . t($insValue["firstName"]) : "";
                    echo isset($insValue["middleName"]) ? " " . t($insValue["middleName"]) : "";
                    echo isset($insValue["lastName"]) ? " " . t($insValue["lastName"]) : "";
                    $andsymbol = "&";
                endforeach;
                ?>
            </p>
            <?php //print_r($certificates); ?>            
             <?php if (in_array("Specialization", $certificates)): ?>
                <button class="btn btn-default " type="button" ><?php echo t("Specializations"); ?></button>
            <?php elseif (in_array("VerifiedCert", $certificates)): ?>
                <button class="btn btn-default " type="button" ><?php echo t("Verified Certificate"); ?></button>
            <?php else: ?>
                <button class="btn btn-success" type="button" ><?php echo t("Learn now!"); ?></button>
            <?php endif; ?>
        </div>
    </div>
</li>