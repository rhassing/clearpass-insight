<?php
print "<a href='postgres.php'>Failed authentication</a><br><br>";

// Connecting, selecting database
$dbconn = pg_connect("host=10.254.5.3 dbname=insightdb user=appexternal password=eTIPS123")
    or die('Could not connect: ' . pg_last_error());
$sessionid=$_GET["sessionid"];
print "Sessie: $sessionid";

print "<h1>cppm_alerts</h1>";
// Performing SQL query
$query = "SELECT * FROM cppm_alerts WHERE session_id = '".$sessionid."'";
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
