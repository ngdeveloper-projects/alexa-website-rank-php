<?php
$siteName = "";
$worldRank = "";
$countryName = "";
$countryRank = "";
// url
if(isset($_POST['siteNm'])){
	$siteName = $_POST['siteNm'];
$url='http://data.alexa.com/data?cli=10&dat=snbamz&url='.$siteName.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
$data = curl_exec($ch); // execute curl request
curl_close($ch);
$xml = simplexml_load_string($data);
// parsing the xml data
// sample response xml
/*<ALEXA VER="0.9" URL="javadomain.in/" HOME="0" AID="=" IDN="javadomain.in/">
<RLS PREFIX="http://" more="0"></RLS>
<SD TITLE="A" FLAGS="" HOST="javadomain.in"></SD>
<SD>
<POPULARITY URL="javadomain.in/" TEXT="225237" SOURCE="panel"/>
<REACH RANK="311374"/>
<RANK DELTA="-208466"/>
<COUNTRY CODE="IN" NAME="India" RANK="21029"/>
</SD>
</ALEXA>*/
$siteName = $xml->SD[1]->POPULARITY['URL'];
$worldRank = $xml->SD[1]->POPULARITY['TEXT'];
$countryName = $xml->SD[1]->COUNTRY['NAME']; 
$countryRank = $xml->SD[1]->COUNTRY['RANK'];
}
?>
<p>
<table id="demoPostTable" class="display" cellspacing="0" width="100%">
<thead><tr><th>Site Name</th><th>Global Rank</th><th>Country Rank</th><th>Country Name</th></tr></thead>
<tbody><tr><td><?php echo $siteName; ?></td><td><?php echo $worldRank; ?></td><td><?php echo $countryRank; ?></td><td><?php echo $countryName; ?></td></tbody>
</table>
</p>


