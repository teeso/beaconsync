What's this for?
---

Beaconsync is a pattern, and WordPress plugin, associating WordPress content and Bluetooth 4 proximity beacons. This enables a growing class of app that use beacons for accurate positioning, while keeping content management for such apps simple, familiar, and webby. The pattern & plugin can be applied in apps that use any beacon spec, incuding AltBeacon, although it was originally designed for use with Apple's iBeacon UUID/major/minor metadata.

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

How apps should use a beaconsync site
---
A special-purpose app that can detect beacons (for example, a city walking tour app) should sync with a corresponding WordPress beaconsync site using WordPress' Atom or RSS2 protocol feed. This is how the app gets the full list of beacons and associated content it can display from the site.

The following examples are for Atom (http://www.rfc-base.org/rfc-4287.html), but RSS2 is quite similar. We recommend you use Atom over RSS2, in case we choose to deprecate RSS2 support in the future.

A post associated with a beacon has &lt;beacon:uuid&gt; and/or &lt;beacon:majorminor&gt; elements within the corresponding &lt;entry&gt;, for example:

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
  
After detecting the beacon *b41bbe2-42c2-4b84-ab96-6e9d5509138b.0.2* the app may choose to follow the corresponding &lt;entry&gt;'s &lt;link&gt; within a web browser frame, or may choose to display other Atom element values like &lt;title&gt; and &lt;summary&gt;, or Atom extension element values.

The app controls how much of the feed data it caches, and should sync as often as necessary to support the frequency of addition/repurposing of beacons and updating of content. It should at minimum cache the beacon:uuid, beacon:majorminor, and link, for quick response to detection of a beacon that matches that UUID and major/minor.

History
---

This plugin came about as part of a volunteer effort for Discovery Center of Idaho
(http://www.dcidaho.org) to improve exhibit signage and depth of available information. Please feel free to use it and give me feedback!
