<?php foreach ($content as $page): ?>

<!-- Post -->
<div class="card my-5 border-0">

	<!-- Load Bludit Plugins: Page Begin -->
	<?php Theme::plugins('pageBegin'); ?>

	<!-- Cover image -->
	<?php if ($page->coverImage()): ?>
	<img class="card-img-top mb-3 rounded-0" alt="Cover Image" src="<?php echo $page->coverImage(); ?>"/>
	<?php endif ?>

	<div class="card-body p-0">
		<!-- Title -->
		<a class="text-dark" href="<?php echo $page->permalink(); ?>">
			<h2 class="title"><?php echo $page->title(); ?></h2>
		</a>

		<!-- Creation date -->
		<h6 class="card-subtitle mb-3 text-muted"><?php echo $page->date(); ?> - <?php echo $language->get('Reading time') . ': ' . $page->readingTime(); ?></h6>

		<!-- Breaked content -->
		<?php echo $page->contentBreak(); ?>

		<!-- "Read more" button -->
		<?php if ($page->readMore()): ?>
		<a href="<?php echo $page->permalink(); ?>"><?php echo $language->get('Read more'); ?></a>
		<?php endif ?>

	</div>

	<!-- Load Bludit Plugins: Page End -->
	<?php Theme::plugins('pageEnd'); ?>

</div>

<hr>

<?php endforeach ?>

<!-- Pagination -->
<?php if (Paginator::amountOfPages()>1): ?>
<nav class="paginator">
	<ul class="pagination flex-wrap">

		<!-- Previous button -->
		<li class="page-item mr-2 <?php if (!Paginator::showPrev()) echo 'disabled' ?>">
			<a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#9664; <?php echo $language->get('Previous'); ?></a>
		</li>

		<!-- Home button -->
		<li class="page-item <?php if (Paginator::currentPage()==1) echo 'disabled' ?>">
			<a class="page-link" href="<?php echo $site->url() ?>">Home</a>
		</li>

		<!-- Next button -->
		<li class="page-item ml-2 <?php if (!Paginator::showNext()) echo 'disabled' ?>">
			<a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $language->get('Next'); ?> &#9658;</a>
		</li>

	</ul>
</nav>
<?php endif ?>
