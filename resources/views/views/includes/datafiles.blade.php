<?php
	foreach($dataSections as $section){
?>
		<script id="data-{{ $section }}" type="application/json">
		  <?php echo html_entity_decode(json_encode($budgetData)) ?>
        <?php 
            //require 'frontend/data/'.$section.'.json'; 
        ?> 
	    </script>;
<?php
	}
?>

