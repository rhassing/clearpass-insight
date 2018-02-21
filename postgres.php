<?php

print '<a href="sessions.php">Sessions</a>';
// Connecting, selecting database
$dbconn = pg_connect("host=10.254.5.3 dbname=insightdb user=appexternal password=eTIPS123")
    or die('Could not connect: ' . pg_last_error());
print "<h1>Auth</h1>";
// Performing SQL query
$query = "SELECT * FROM auth WHERE auth_status = 'Failed'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table border=1>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
	$session_id = $line["session_id"];
    echo "\t<tr>\n";
        echo "\t\t<td><a href='./alerts.php?sessionid=$session_id'> alert </a></td>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);

print "<h1>Endpoints</h1>";
// Performing SQL query
$query = 'SELECT * FROM endpoints';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table border=1>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";


// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
