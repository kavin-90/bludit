<?php defined('BLUDIT') or die('Bludit CMS.');

// ============================================================================
// Check role
// ============================================================================

checkRole(array('admin', 'editor'));

// ============================================================================
// Functions
// ============================================================================

// ============================================================================
// Main before POST
// ============================================================================

// ============================================================================
// POST Method
// ============================================================================

// ============================================================================
// Main after POST
// ============================================================================

// List of published pages
$onlyPublished = true;
$amountOfItems = ITEMS_PER_PAGE_ADMIN;
$pageNumber = $url->pageNumber();
$published = $pages->getList($pageNumber, $amountOfItems, $onlyPublished);

// Check if out of range the pageNumber
if (empty($published) && $url->pageNumber()>1) {
	Redirect::page('content');
}

$drafts = $pages->getDraftDB(true);
$scheduled = $pages->getScheduledDB(true);
$static = $pages->getStaticDB(true);
$sticky = $pages->getStickyDB(true);

// Title of the page
$layout['title'] .= ' - '.$language->g('Manage content');