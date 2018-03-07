<?php

// Connecting, selecting database
$dbconn = pg_connect("host=10.31.4.49 dbname=insightdb user=appexternal password=eTIPS123")
    or die('Could not connect: ' . pg_last_error());
print "<h1>Endpoints Categories</h1>";

// Performing SQL query
$query = 'SELECT DISTINCT device_category FROM endpoints';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table border=1>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
	$device_category = $line["device_category"];
    echo "\t<tr>\n";
        echo "\t\t<td><a href='./endpoints2.php?device_category=$device_category'> $device_category </a></td>\n";
    foreach ($line as $col_value) {
    }
    echo "\t</tr>\n";
}
echo "</table>\n";


// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
