<?php
/** 
 * Available variables:
 * - $elements 
 * - $linked
 * - $languages
 * - $certificates
 * - $categories
 * - $partnerIds
 * 
 */
?>

<?php foreach ($elements as $elemet): ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="">
				<img src="<?php echo $elemet["partnerLogo"]; ?>?auto=format&amp;dpr=1&amp;w=150" alt="...">
			</div>
			<h2><?php echo $elemet["name"] ?></h2>
			<p><?php echo $elemet["description"] ?></p>
		</div>
		<div class="col-lg-6">
			<?php if (isset($linked["v1Details.v1"][0]["videos"][0]["source"])): ?>
				<video controls width="100%" id="demo1">
					<source src="<?php print_r($linked["v1Details.v1"][0]["videos"][0]["source"]); ?>" type="video/mp4"></source>
					<a href="<?php print_r($linked["v1Details.v1"][0]["videos"][0]["source"]); ?>">
						<img src="<?php echo $elemet["photoUrl"]; ?>" alt="Dynamic app search in Firefox OS">
					</a>
					<p>Click image to play a video demo of dynamic app search</p>
				</video>
			<?php elseif (isset($elemet["photoUrl"])): ?>
				<img src="<?php echo $elemet["photoUrl"]; ?>" alt="...">
			<?php endif; ?>
		</div>
		<div class="clear"></div>
		<?php if (is_array($linked["v1Details.v1"])): ?>
			<div class="row">
				<div class="col-lg-12">
					<h3>About the Course</h3>
					<?php foreach ($linked["v1Details.v1"] as $v1Details): ?>
						<p><?php echo $v1Details["aboutTheCourse"]; ?></p>
						<p><?php echo $v1Details["faq"]; ?></p>

					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>