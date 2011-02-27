<?php

require_once dirname(__FILE__).'/../bootstrap/bootstrap.php';

$t = new lime_test();

$t->info('Create Sortable Sample Set');

    $a1 = new SortableArticleUniqueBy();
    $a1->name = 'First Article';
    $a1->category = 'Category1';
    $a1->save();

    $a2 = new SortableArticleUniqueBy();
    $a2->name = 'Second Article';
    $a2->category = 'Category1';
    $a2->save();

    $a3 = new SortableArticleUniqueBy();
    $a3->name = 'Third Article';
    $a3->category = 'Category2';
    $a3->save();

    $a4 = new SortableArticleUniqueBy();
    $a4->name = 'Fourth Article';
    $a4->category = 'Category2';
    $a4->save();

$t->info('Assert articles have the correct position');

    $t->is($a1['position'], 1, 'First item saved has position of 1 (first in category 1)');
    $t->is($a2['position'], 2, 'Second item saved has position of 2 (second in category 1)');
    $t->is($a3['position'], 1, 'Third item saved has position of 1 (first in category 2)');
    $t->is($a4['position'], 2, 'Third item saved has position of 2 (second in category 2)');

$t->info('Test Demote and Promote');

    $a1->demote();
    $t->is($a1['position'], 2, 'First item now has position of 2');
    $t->is($a2['position'], 1, 'Second item now has position of 1');

    $a3->demote();
    $t->is($a3['position'], 2, 'Third item now has position of 2');
    $t->is($a4['position'], 1, 'Fourth item now has position of 1');
    
$t->info('Test Removing an item - items after it should be promoted');

    $a2->delete();
    $t->is($a1['position'], 1, '"First item" has been promoted to "1" from "2"');
    
    $a4->delete();
    $t->is($a3['position'], 1, '"Third item" has been promoted to "1" from "2"');
