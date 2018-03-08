<?php

// Connecting, selecting database
$dbconn = pg_connect("host=10.31.4.49 dbname=tipsdb user=appexternal password=eTIPS123")
    or die('Could not connect: ' . pg_last_error());
$device_category=$_GET["device_category"];
print "<h1>Endpoints in Category: <u>$device_category</u></h1> <br><br>";

// Performing SQL query
$query = "SELECT DISTINCT device_family, device_name FROM tips_endpoint_profiles WHERE device_category= '".$device_category."'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table border=1>\n";
echo "<tr><td width=200px bgcolor=lightgrey><b>Device OS</b></td><td width=200px bgcolor=lightgrey><b>Device name</b></td></tr>";
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

print "<h3><a href=endpoints.php><= Back to Category overview</a> </h3> <br><br>";

?>
