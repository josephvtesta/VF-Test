<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <!-- Stylesheets -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="src/css/grid.css" type="text/css" />
    <link rel="stylesheet" href="src/css/style.css" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


    <!-- External JavaScripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#city_selector').on('change',function() {
            $('#filter div').show().not("#data-" + this.value).hide();
        });
    });
    </script>


    <title>VF Project - Results</title>

</head>

<body class="full">

    <section class="header">

        <div class="container-fluid wrap">

            <div class="row center">
                <div class="col-half right">
                    <img src="src/img/vodka.png" height="99px" width="141px">
                </div>
                <div class="col-half left">
                    <img src="src/img/red.png" height="90px" width="123px">
                </div>
            </div>

            <h3 class="fancy center">Enter to Win a</h3>

            <h2 class="center">Odio Dignissimos Ducimus Qui Vaid</h2>

        </div>
    </section>

<section class="results center">
<h2 class="fancy">Results</h2>
</section>
<section class="results center">
        <div class="container-fluid wrap">

<div id="filter" class="row">
<?php
// Require config.php
require(dirname(__FILE__)."/config.php");

// Get city data from table for sorting without showing duplicate cities
$drop = "SELECT DISTINCT city FROM `demo` ORDER BY city ASC"; 
$res = $conn->query($drop); 

// Echo query to <select> tag
echo "<select name='city_selector' id='city_selector'>"; 
while ($row = $res->fetch_assoc())  { 
$city = str_replace(" ", "-",$row['city']);

echo "<option value='$city'>" . $row["city"] . "</option>"; 
} 
echo "</select>";  

// Get all data from table to show on results page
$sql    = "SELECT * FROM `demo`";
$result = $conn->query($sql);

// If multiple entries, show them all
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
    $city = str_replace(" ", "-",$row['city']);
        echo "<div class='col-fourth card' id='data-$city'><img src='/JT-VividProject/images/" . $row["image"] . "'><p>" . $row["name"] . " from " . $row["city"] . "</p></div>";
    }
} else {
    // If no results, show on page
    echo "0 results";
}

// Close connection to database
$conn->close();

?>
</div>
</div>
</section>
    <section class="footer">
        <div class="container-fluid wrap">

            <h4 class="fancy center">Don't forget to LIKE our Facebook page to stay updated on contents details & other exciting MB special offers!</h4>

            <div class="row center">
                <div class="col-whole">
                    <img src="src/img/facebook.png">
                </div>
                <div class="col-whole">
                    <p>Must be at least 21 years of age, have fewer than 6 points on your valid Ohio drivers license, be fully insured ($250 deductible collision, $500,000 liability). Driver responsible for all maintenance over the year, $.25 per mile over 10,000. Driver responsible for all reconditioning expense and damage upon vehicle return. Driver must disclose any accidents in said vehicle to Vero Accumasas Delenti at the time of accident, repairs must be performed at Quod Maxi. ONE individual MUST be named on each raffle ticket as the winner/driver. The car cannot be won by a business, or be driven by multiple people. Courtesy of Vero eos Delenti."</p>
                </div>
            </div>

            <div class="row">
                <div class="col-half left">
                    <a href="disclaimer">Disclaimer</a> | <a href="site-map">Site Map</a>
                </div>
                <div class="col-half right">
                    At Vero eos accumasas delenti
                </div>
            </div>

    </section>
    </div>

</body>