<?php 
include('userheader.php');
//this has to be echoed because the <? symbol confuses the PHP parser
echo '<?xml version="1.0"?>'; 
//get up to 8 recent approved climbs
$query = "SELECT climbs.name, climbs.climb_id, climbs.description, climbs.v_grade, climbs.y_grade, users.username, users.email
			FROM climbs, areas, users
			WHERE climbs.is_approved = 1
			AND areas.is_approved = 1
			AND climbs.area_id = areas.area_id
			AND climbs.user_id = users.user_id
			ORDER BY climbs.date DESC
			LIMIT 8";
//run it
$result = $db->query($query);
//check it
if(!$result){
	die( $db->error );
}
?>			
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Betabase - Recently Posted Climbs &amp; Areas</title>
		<link>http://localhost/christian_php/beta-base_site</link>
		<description>A place for climbers to share and find rock climbing information</description>
		<atom:link href="http://localhost/christian_php/beta-base_site/rss.php" rel="self" type="application/rss+xml" />
		<language>en-us</language>
		<pubDate><?php echo date('r'); ?></pubDate>
		<?php while( $row = $result->fetch_assoc() ){ ?>
		<item>
			<title><?php echo $row['name'] ?></title>
			<link>http://localhost/christian_php/beta-base_site/single.php?climb_id=<?php echo $row['climb_id'] ?></link>
			<guid>http://localhost/christian_php/beta-base_site/single.php?climb_id=<?php echo $row['climb_id'] ?></guid>
			<pubDate><?php echo rss_date($row['date']) ?></pubDate>
			<author><?php echo $row['email'] ?> (<?php echo $row['username'] ?>)</author>
			<!-- The CDATA wrapper allows us to have HTML in the body of the post -->
			<description><![CDATA[ <?php echo $row['description'] ?> ]]></description>
		</item>
		<?php } ?>
	</channel>
</rss>