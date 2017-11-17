What's this for?
---

Beaconsync is a pattern, and WordPress plugin, associating WordPress content and Bluetooth proximity beacons. This enables a growing class of app that use beacons for accurate positioning, while keeping content management and service deployment required to support the app simple and familiar (WordPress.)

The pattern & plugin can be applied in apps that use any beacon spec, incuding AltBeacon, although it was originally designed for use with Apple's iBeacon UUID/major/minor metadata.

Install the plugin
---
Download https://github.com/waded/beaconsync/archive/master.zip then upload the file in the Plugins section of your WordPress site's administration screens.

Don't forget to activate the plugin after you've uploaded it! (I always forget.)

Associate posts with beacons
---

To associate a beacon with a post, edit the post. You'll see **Beacon UUID** and **Beacon Major/Minor** sections (they're very similar to the built-in *Category* section.) Add the beacon's UUID, for example *2b41bbe2-42c2-4b84-ab96-6e9d5509138b*, and major/minor values, for example *0.2* for major value 0, minor value 2, in these sections:

![Screenshot of afformentioned sections](https://raw.githubusercontent.com/waded/beaconsync/master/docs/beacon-ui.png "The Beacon UUID and Beacon Major/Minor sections")

Be sure to click "Update" to save your changes. (I forget to do that even more often than I forget to activate plugins.)

Avoid adding more than 1 UUID or major/minor per post, as this may result in undefined behavior in apps. Adding UUID but not major/minor, or major/minor and not UUID is fine though: for example, if each of your beacons has a different UUID you may choose to add only UUID. Apps must support this usage.

Example: How an app can use a beaconsync WordPress site to drive its behavior when it detects a beacon
---
A special-purpose app developed to detect beacons (for example, a city walking tour app) should sync with a corresponding WordPress beaconsync site using the Atom (recommended) or RSS2 (deprecated) Feed URL (https://codex.wordpress.org/WordPress_Feeds). This way the app will be aware of what content is available, associate with which beacon, by examining the &lt;beacon:uuid&gt; and &lt;beacon:majorminor&gt; information provided by the feed.

For example, a site the app syncs with has a post associated with a beacon as follows:

	<entry>
		<title>Bar Gernika</title>
		<link href="http://www.boisebeaconblog.com/posts/bar-gernika" />
		<id>http://www.boisebeaconblog.com/postid/1</id>
		<published>2003-12-13T18:30:02Z</published>
		<updated>2014-03-26T06:59:04Z</updated>
		<summary>Bar Gernika has been a fixture on the Basque Block for almost 20 years 
		         and serves authentic Basque foods, wine and desserts.
		         Try the croquetas!</summary>
		<!-- ... -->
		<beacon:uuid>2b41bbe2-42c2-4b84-ab96-6e9d5509138b</beacon:uuid>
		<beacon:majorminor>0.2</beacon:majorminor>
		<!-- ... -->
	</entry>
  
Then after detecting the beacon *b41bbe2-42c2-4b84-ab96-6e9d5509138b.0.2* the app might choose to render the corresponding content/media (for example the &lt;summary&gt; value) directly within the app, or launch the user's browser to the URL specified by &lt;link href&gt;.

History
---

This plugin came about as part of a volunteer effort for Discovery Center of Idaho
(http://www.dcidaho.org) to improve exhibit signage and depth of available information. Please feel free to use it and give me feedback!
