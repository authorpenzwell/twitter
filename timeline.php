<?php
echo "<h2>My Twitter API Test</h2>";

require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "277804874-Tt9QLTvRyJ6xVR64ENZMq5hY7kPR9hRxi1R12MBb",
    'oauth_access_token_secret' => "Eepyls81wE4ac0YqbM5qHUzxXLq7GgeHqVqja3TYnT7qa",
    'consumer_key' => "UpX3pbWEB3efxl3FBhSXiTCHR",
    'consumer_secret' => "fjFfslij7qOGFwtcjNARBpyVlJXnBDxh9uY4a8V1zPRN4Vmhpd"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
	if (isset($_GET['user']))  {$user = $_GET['user'];}  
		else {$user  = "kay_snow";}
	if (isset($_GET['count'])) {$user = $_GET['count'];} 
		else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3>
		<p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."
			</em></p>";exit();}
	foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
?>
