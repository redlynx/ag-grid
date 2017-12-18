<?php
include 'jira_utilities.php';

$enhancements = array();
$bugs = array();

$json_decoded = retrieveJiraFilterData('changelog');
for ($i = 0; $i < count($json_decoded->{'issues'}); $i++) {
    if ($json_decoded->{'issues'}[$i]->{'fields'}->{'issuetype'}->{'name'} == 'Bug') {
        array_push($bugs, $i);
    } else {
        array_push($enhancements, $i);
    }
}

echo '&lt;h3&gt;Version X.Y.Z ['.strtoupper(date('d-M-Y')).']&lt;/h3&gt;'.'<br/>';

echo '&lt;p&gt;For details of this release, check our dedicated &lt;a href="../ag-grid-blog-X-Y-Z/"&gt;blog post for vX.Y.Z&lt;/a&gt;.&lt;/p&gt'.'<br/>';

for ($i = 0; $i < count($enhancements); $i++) {
    $index = $enhancements[$i];
    if ($i == 0) {
        echo '&lt;h4&gt;Enhancements&lt;/h4&gt;'.'<br/>';
        echo '&lt;ul&gt;'.'<br/>';
    }
    ?>

    <?= '&lt;li&gt;'.'<br/>' ?>
    <?= $json_decoded->{'issues'}[$index]->{'key'} ?>: <?= $json_decoded->{'issues'}[$index]->{'fields'}->{'summary'} ?>
    <?= '&lt;/li&gt;'.'<br/>' ?>

    <?php
    if ($i === (count($enhancements) - 1)) {
        echo '&lt;/ul&gt;'.'<br/>';
    }
}

for ($i = 0; $i < count($bugs); $i++) {
    $index = $bugs[$i];
    if ($i == 0) {
        echo '&lt;h4&gt;Bugs&lt;/h4&gt;'.'<br/>';
        echo '&lt;ul&gt;'.'<br/>';
    }
    ?>

    <?= '&lt;li&gt;'.'<br/>' ?>
    <?= $json_decoded->{'issues'}[$index]->{'key'} ?>: <?= $json_decoded->{'issues'}[$index]->{'fields'}->{'summary'} ?>
    <?= '&lt;/li&gt;'.'<br/>' ?>

    <?php
    if ($i === (count($bugs) - 1)) {
        echo '&lt;/ul&gt;'.'<br/>';
    }
}
?>
