<html>
<head>
<title>2008-09 College Bowl Pool</title>

<style type="text/css">
<!--
.tdcorrect {
	 background-image: url(img/checkmark.gif);
	 height: 105px;
	 width: 105px;
	 text-align: center;
	 vertical-align: center;
 }
.tdwrong {
	 background-image: url(img/cross.gif);
	 height: 105px;
	 width: 105px;
	 text-align: center;
	 vertical-align: center;
 }
.tdblank {
	 height: 105px;
	 width: 105px;
	 text-align: center;
	 vertical-align: center;
 }
.tdbowl {
	 width: 105px;
 }
-->
</style>
</head>

<body bgcolor=white>


<?php

$bowls = array (
	array (name => "Poinsettia Bowl",
	    date => "Dec. 23",
	    teama => "Boise State",
	    teamb => "TCU",
	    teama_img => "boise",
	    teamb_img => "tcu",
	    winner => nil),
	array (name => "Meineka Car Care Bowl",
	    date => "Dec. 27",
	    teama => "West Virginia",
	    teamb => "North Carolina",
	    teama_img => "wvu",
	    teamb_img => "unc",
	    winner => nil),
	array (name => "Champs Sports Bowl",
	    date => "Dec. 27",
	    teama => "Wisconsin",
	    teamb => "Florida State",
	    teama_img => "wisconsin",
	    teamb_img => "fsu",
	    winner => nil),
	array (name => "Alamo Bowl",
	    date => "Dec. 29",
	    teama => "No. 21 Missouri",
	    teamb => "No. 23 Northwestern",
	    teama_img => "missouri",
	    teamb_img => "northwestern",
	    winner => nil),
	array (name => "Holiday Bowl",
	    date => "Dec. 30",
	    teama => "Oklahoma State",
	    teamb => "Oregon",
	    teama_img => "osu",
	    teamb_img => "oregon",
	    winner => nil),
	array (name => "Sun Bowl",
	    date => "Dec. 31",
	    teama => "Oregon State",
	    teamb => "Pittsburgh",
	    teama_img => "oregonstate",
	    teamb_img => "pitt",
	    winner => nil),
	array (name => "Chick-Fil-A Bowl",
	    date => "Dec. 31",
	    teama => "LSU",
	    teamb => "Georgia Tech",
	    teama_img => "lsu",
	    teamb_img => "gtech",
	    winner => nil),
	array (name => "Gator Bowl",
	    date => "Jan. 1",
	    teama => "Clemson",
	    teamb => "Nebraska",
	    teama_img => "clemson",
	    teamb_img => "nebraska",
	    winner => nil),
	array (name => "Capitol One Bowl",
	    date => "Jan. 1",
	    teama => "Georgia",
	    teamb => "Michigan State",
	    teama_img => "georgia",
	    teamb_img => "michstate",
	    winner => nil),
	array (name => "Rose Bowl",
	    date => "Jan. 1",
	    teama => "Penn State",
	    teamb => "USC",
	    teama_img => "psu",
	    teamb_img => "usc",
	    winner => nil),
	array (name => "Cotton Bowl",
	    date => "Jan. 2",
	    teama => "Mississippi",
	    teamb => "Texas Tech",
	    teama_img => "miss",
	    teamb_img => "texastech",
	    winner => nil),
	array (name => "Liberty Bowl",
	    date => "Jan. 2",
	    teama => "Kentucky",
	    teamb => "East Carolina",
	    teama_img => "uk",
	    teamb_img => "ecu",
	    winner => nil),
	array (name => "Sugar Bowl",
	    date => "Jan. 2",
	    teama => "Utah",
	    teamb => "Alabama",
	    teama_img => "utah",
	    teamb_img => "alabama",
	    winner => nil),
	array (name => "Fiesta Bowl",
	    date => "Jan. 5",
	    teama => "Ohio State",
	    teamb => "Texas",
	    teama_img => "ohiostate",
	    teamb_img => "texas",
	    winner => nil),
	array (name => "BCS National Champ.",
	    date => "Jan. 8",
	    teama => "Florida",
	    teamb => "Oklahoma",
	    teama_img => "florida",
	    teamb_img => "oklahoma",
	    winner => nil),
	);
$tie =
    array (name => "Orange Bowl",
	date => "Jan. 1",
	teama => "Cincinnati",
	teamb => "Virginia Tech",
	teama_img => "cinn",
	teamb_img => "vt",
	teama_score => nil,
	teamb_score => nil
	    );

$users = array();

function fail($name)
{
	print "<h1>ERROR while processing: ". $name ."</h1>";
	exit(1);
}

function print_img($img_src)
{
	print "<img src=\"img/" . $img_src . ".gif\" alt=\"\" " .
	    "height=50 width=50>";
}

function is_winner($bowl, $pic)
{
	if ($bowl[winner] == nil)
		return FALSE;

	/* validity check */
	if (stristr($bowl[teama], $bowl[winner]) != FALSE &&
	    stristr($bowl[teamb], $bowl[winner]) != FALSE)
		fail("Winner doesn't match teams: " . $bowl[winner]);

	# match the pic to full team name, then the winner
	# to that full team name
	$team = "";
	if (stristr($bowl[teama], $pic) != FALSE)
		$team = $bowl[teama];
	else if (stristr($bowl[teamb], $pic) != FALSE)
		$team = $bowl[teamb];
	else
		fail("Pic doesn't match teams: " . $pic);

	if (stristr($team, $bowl[winner]) != FALSE)
		return TRUE;
	else
		return FALSE;
}

function print_user($name, $correct, $pics, $tot_pic, $tot_off)
{
	global $bowls, $tie;

	if (sizeof($pics) != sizeof($bowls))
		fail("Sizeof pics: " . sizeof($pics) . " does not match bowl count " .
		    sizeof($bowls));

	print "<tr>";
	print "<td>";
	print $name;
	print "<br>";
	print "Score: " . $correct;
	print "</td>";
	for ($i = 0; $i < sizeof($bowls); $i++) {
		if ($bowls[$i][winner] == nil)
 			print "<td class=\"tdblank\">";
		else if (is_winner($bowls[$i], $pics[$i]) == TRUE)
   			print "<td class=\"tdcorrect\">";
		else
   			print "<td class=\"tdwrong\">";

		if (stristr($bowls[$i][teama], $pics[$i]) != FALSE) {
			print_img($bowls[$i][teama_img]);
		} else if (stristr($bowls[$i][teamb], $pics[$i]) != FALSE) {
			print_img($bowls[$i][teamb_img]);
		} else
			fail("Failed to match pic to teams: " . $pics[$i]);

		print "</td>";
	}

	$total = nil;
	if ($tie[teama_score] != nil && $tie[teamb_score] != nil)
		$total = $tie[teama_score] + $tie[teamb_score];

	print "<td class=\"tdblank\">";
	print $tot_pic;
	if ($total != nil) {
		print " (";
		if ($tot_off > 0)
			print "+";
		print $tot_off;
		print ")";
	}
	print "</td>";

	print "</tr>";
}

function print_users()
{
	global $users, $bowls;

	foreach ($users as $user) {
		print_user($user[name], $user[correct], $user[pics], $user[tot_pic],
			$user[tot_off]);
	}
}

function add_user($name, $pics, $tot_pic)
{
	global $users, $bowls, $tie;
	$correct = 0;
	$user;

	if (sizeof($pics) != sizeof($bowls))
		fail($name);

	for ($i = 0; $i < sizeof($pics); $i++) {
		if ($bowls[$i][winner] != nil) {
			if (is_winner($bowls[$i], $pics[$i]) == TRUE)
				$correct++;
		}
	}

	# validate tie score
	if (($tie[teama_score] != nil && $tie[teamb_score] == nil) ||
	    ($tie[teama_score] == nil && $tie[teamb_score] != nil))
		fail("One tie team scored but other didn't");

	$tot_off = nil;
	if ($tie[teama_score] != nil &&
	    $tie[teamb_score] != nil) {
		$total = $tie[teama_score] + $tie[teamb_score];
		$tot_off = $total - $tot_pic;
	}

	$user = array(name => $name,
	    correct => $correct,
	    pics => $pics,
	    tot_pic => $tot_pic,
	    tot_off => $tot_off,
		);

	array_push($users, $user);
}

function cmp_users($a, $b)
{
	if ($a[correct] > $b[correct])
		return -1;
	else if ($a[correct] < $b[correct])
		return 1;

	# Now compare tie breaker
	if ($a[tot_off] == $b[tot_off] ||
	    ($a[tot_off] < 0 && $b[tot_off] < 0))
		return 0;

	if ($a[tot_off] < 0)
		return 1;
	else if ($b[tot_off] < 0)
		return -1;
	else
		return $a[tot_off] - $b[tot_off];

}

print "<h1>2008-09 College Bowl pool</h1>";
print "<table border=1>";

print "<tr>";
print "<td></td>";
foreach ($bowls as $bowl) {
	print "<td class=\"tdbowl\" align=center valign=center>";
	print $bowl[name];
	print "<br>";
	print_img($bowl[teama_img]);
	print "<br>";
	print "vs";
	print "<br>";
	print_img($bowl[teamb_img]);
	print "<br>";
	print $bowl[date];
	print "</td>";
}

# tie breaker
print "<td class=\"tdbowl\" align=center valign=center>";
print "<font color=red>TieBreaker</font><br>";
print $tie[name];
print "<br>";
print_img($tie[teama_img]);
print "<br>";
print "vs";
print "<br>";
print_img($tie[teamb_img]);
print "<br>";
print $tie[date];
if ($tie[teama_score] != nil && $tie[teamb_score] != nil) {
	print "<br>";
	print $tie[teama_score] . " - ". $tie[teamb_score];
}
print "</td>";

print "</tr>";

#
# Example Users
#

add_user("John Smith", array("tcu", "north carolina", "wisconsin", "missouri", "oklahoma", "oregon", "lsu", "nebraska", "georgia", "usc", "texas tech", "east carolina", "alabama", "texas", "florida"), 39);

add_user("Harry Potter", array("boise", "north carolina", "florida state", "missouri", "oklahoma", "pittsburgh", "georgia", "clemson", "michigan state", "usc", "texas tech", "kentucky", "alabama", "texas", "florida"), 32);

add_user("Swarley Stinson", array("boise", "north carolina", "florida state", "missouri", "oklahoma", "oregon", "georgia", "clemson", "georgia", "penn state", "texas tech", "east carolina", "alabama", "texas", "oklahoma"), 35);

add_user("Ted Mosby", array("boise", "west virginia", "wisconsin", "missouri", "oregon", "pittsburgh", "georgia tech", "clemson", "georgia", "usc", "texas tech", "east carolina", "alabama", "texas", "florida"), 37);

add_user("John Dorian", array("tcu", "north carolina", "florida state", "missouri", "oregon", "pittsburgh", "georgia tech", "clemson", "georgia", "usc", "texas tech", "east carolina", "alabama", "texas", "florida"), 36);

add_user("Perry Cox", array("tcu", "west virginia", "florida state", "missouri", "oklahoma", "pittsburgh", "georgia tech", "clemson", "georgia", "usc", "texas tech", "east carolina", "alabama", "texas", "florida"), 37);

usort($users, "cmp_users");
print_users();

print "</table>";
?>

</body>
</html>
