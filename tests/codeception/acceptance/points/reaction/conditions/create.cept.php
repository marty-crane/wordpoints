<?php

/**
 * Tests creating a condition for a points reaction.
 *
 * @package WordPoints\Codeception
 * @since 2.1.3
 */

use WordPoints\Tests\Codeception\Element\Reaction;

$I = new AcceptanceTester( $scenario );
$I->wantTo( 'Create a condition for a points reaction' );
$the_reaction = $I->hadCreatedAPointsReaction();
$reaction     = new Reaction( $I, $the_reaction );
$I->amLoggedInAsAdminOnPage( 'wp-admin/admin.php?page=wordpoints_points_types' );
$I->waitForElement( (string) $reaction );
$reaction->edit();
$condition = $reaction->addCondition( array( 'User » Roles', 'Contains' ) );
$reaction->save();
$I->canSeePointsReactionConditionInDB( $the_reaction );

// EOF
