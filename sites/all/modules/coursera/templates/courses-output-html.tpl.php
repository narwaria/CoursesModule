<div class='row row-offcanvas row-offcanvas-left'>
    <p class="pull-left visible-xs col-sm-12">
        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Filters</button>          
    <div class="clear">&nbsp;</div>
</p>
<div class="col-xs-6 col-sm-4 sidebar-offcanvas" id="sidebar" role="navigation">  
    <?php echo $searchCourseFormHtml; ?>
</div>    
<div class="col-xs-12 col-sm-8">   
    <ul class="list-group course-list-data" id="check-list-box">   
        <?php echo $courseListHtml; ?>
    </ul>
</div>    
</div>