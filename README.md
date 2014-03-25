Beaconsync is a WordPress plugin that makes it easy to link up WordPress content with a
mobile app that can detect Bluetooth Low Energy beacons.

Beacon UUID, major, and minor codes may be set on each WordPress post by the author
during creation of the post, or after the fact. This is implemented using WordPress
taxonomies.

A mobile app may then sync with the WordPress site to get a list of beacons known to the
site, as well as retrieve information about the post(s) that correspond to each beacon,
through the site's existing Atom/RSS2 feeds: each entry/item is annotated with beacon:uuid,
beacon:major, and beacon:minor.

This plugin came about as part of a volunteer effort for Discovery Center of Idaho
(http://www.dcidaho.org) to simplify exhibit signage and add to the depth of information
available at each exhibit using "iBeacons."