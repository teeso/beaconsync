What's this for?
---

Beaconsync is a WordPress plugin that makes it possible to associate WordPress posts with apps that
detect Bluetooth Low Energy beacons (also known by Apple's name 'iBeacons") so that whenever the app/device
gets near a beacon, the app knows which content from your WordPress site is most relevant for that beacon.
This keeps content management similar and familiar, and enables a growing class of hybrid mobile/web apps
that work with beacons.

Install the plugin
---
Download https://github.com/waded/beaconsync/archive/master.zip, and then upload the file in the Plugins section of your WordPress site's administration screens.

Don't forget to activate the plugin after you've uploaded it!

Associate posts with beacons
---

To associate a beacon with a post, edit the post. You'll see **Beacon UUID** and **Beacon Major/Minor** sections (peers to Category/Tag sections.) Enter the beacon's UUID (for example *c1dac09d-c494-4a93-826c-664f62c52a10*) and major/minor codes (for example *1.5* for major 1, minor 5) in these sections. Remember to save your changes to the post!

Avoid setting more than one UUID or major/minor per post, as this can result in unexpected behavior. Using one but not the other is fine and may save you time: for example, if each of your beacons has its own UUID you might choose to set only UUID, and not major/minor.

How apps should use a beaconsync site
---
A special-purpose app that can detect beacons (for example, a city walking tour app) should sync with a corresponding WordPress beaconsync site using the site's Atom or RSS2 protocol feed. This is how the app gets the full list of beacons and associated content it can display from the site.

The following examples are for Atom, but RSS2 is very similar.

A post associated with a beacon has &lt;beacon:uuid&gt; and/or &lt;beacon:majorminor&gt; elements within the corresponding &lt;entry&gt;. For example, this entry for a beacon near "Bar Gernika":

	<entry>
		<title>Bar Gernika</title>
		<link href="http://www.boisebeaconblog.com/posts/bar-gernika" />
		<id>http://www.boisebeaconblog.com/postid/1</id>
		<published>2003-12-13T18:30:02Z</published>
		<updated>2014-03-26T06:59:04Z</updated>
		<summary>Bar Gernika has been a fixture on the Basque Block for almost 20 years and serves authentic Basque foods, wine and desserts. Try the croquetas!</summary>
		<beacon:uuid>2b41bbe2-42c2-4b84-ab96-6e9d5509138b</beacon:uuid>
		<beacon:majorminor>0.2</beacon:majorminor>
	</entry>
  
After detecting the beacon *b41bbe2-42c2-4b84-ab96-6e9d5509138b.0.2* the app may choose to follow the corresponding &lt;entry&gt;'s &lt;link&gt; within a web browser frame, or may choose to display other Atom/extension attributes of the &lt;entry&gt; like &lt;title&gt; and &lt;summary&gt;.

The app controls how much of the feed data it caches, and should sync as often as necessary to support addition and repurposing of beacons, and updated content. It should at minimum cache the beacon UUID/majorminor sets, id, and link.

History
---

This plugin came about as part of a volunteer effort for Discovery Center of Idaho
(http://www.dcidaho.org) to simplify exhibit signage and add to the depth of information
available at each exhibit.
