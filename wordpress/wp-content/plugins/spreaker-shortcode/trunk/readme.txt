=== Spreaker Shortcode ===
Contributors: Spreaker
Tags: spreaker, shortcode, audio, embed, widget, player, podcast, music, sound
Requires at least: 2.5.0
Tested up to: 5.6
Stable tag: 1.8.0


A simple and easy way to embed Spreaker player into your WordPress blog.


== Description ==

The Spreaker shortcode plugin is an easy way to embed Spreaker audio player into your WordPress blog. It works for any Spreaker episode, show, or user. Once you install this plugin, it will work on all of your blog posts.

A simple example:

`[spreaker type=player resource="episode_id=3331356"]`


**More Options**

Spreaker shortcode requires the resource play. It can be only of the following:

* `resource="episode_id=X"`: id of the episode to embed.
* `resource="show_id=X"`: id of the show, whose latest episode should be displayed.
* `resource="show_key=X"`: private key of the show to embed.
* `resource="user_id=X"`: id of the user, whose latest episode should be displayed.

The plugin also supports the following optional parameters:

* `width`: player's width - can be in % or px (ie. `100%` or `400px`).
* `height`: player's height - can be in % or px (ie. `100%` or `400px`).
* `theme`: player's UI theme. Supported themes are: `light` (default) and `dark`.
* `color`: player’s main color. Supported fromats are short and long hex values (ie: `F00` or `FF0000`). This feature requires the podcast author to subscribe to [Station plan or above](https://www.spreaker.com/plans).
* `cover`: HTTPS url of an image to display as player's background.
* `playlist`:  configures how the playlist should be built. It can be `playlist="false"` to disable the playlist, `playlist="user"` to display all user's episodes in the playlist or `playlist="show"` to display all show's episodes in the playlist. The default behavious depends on resource. The playlist is visible only if the player height is greater than 200px.
* `playlist-continuous`: enables or disables the playlist continuous playback. When `true` it continuously plays all episodes in the playlist until the end.
* `playlist-loop`: enables or disables loop playlist playback when continuous playback is enabled. When `true` and playlist continuous playback is enabled as well, it will loop the playlist continuously (defaults to `false`).
* `playlist-autoupdate`: enables or disables the playlist autoupdate, when a new episode is published. This feature is enabled by default.
* `chapters-image`: enables or disables the display of chapters images in the player (defaults to `true`).
* `episode-image-position`: when `right` or `left` shows the episode image on the `right` or `left` (defaults to `right`)
* `hide-likes`: when `true` the likes button is not displayed in the player (defaults to `false`)
* `hide-comments`: when `true` the comments button is not displayed in the player (defaults to `false`)
* `hide-sharing`: when `true` the share button is not displayed in the player (defaults to `false`)
* `hide-logo`: when `true` the Spreaker logo is not displayed in the player (defaults to `false`). This feature requires the podcast author to subscribe to [Broadcaster plan or above](https://www.spreaker.com/plans).
* `hide-episode-description`: when `true` the button to open the description of the current episode is not displayed in the player (defaults to `false`)
* `hide-playlist-descriptions`: when `true` the button to open the description of episodes in the playlist is not displayed in the player (defaults to `false`)
* `hide-playlist-images`: when `true` the images of episodes in the playlist are not displayed in the player (defaults to `false`)
* `hide-download`: When `true`, it hides the episode download button (defaults to `true`)


**How to get the shortcode**

Play any track on <a href="http://www.spreaker.com">www.spreaker.com</a> and then click on the **share button** in the player (bottom-right corner): you can customize the appearance of the player and get the shortcode to copy and paste to your WordPress blog.


**Help**

If you need further help, please contact us at <a href="http://help.spreaker.com">help.spreaker.com</a>.



== Changelog ==

= 1.8.0 =
* Dropped `autoplay` and `live-autoplay`

= 1.8.0 =
* Tested with WordPress 5.6

= 10 =
* Bugfixes

= 1.7.8 =
* Added `color` attribute support

= 1.7.7 =
* Tested with WordPress 5.1

= 1.7.6 =
* Added `hide-download` attribute support

= 1.7.5 =
* FIX: the plugin is now able to embed correctly limited access episodes

= 1.7.2 =
* Added `episode-image-position` to select if the image should be on the `right` or the `left`

= 1.7.1 =
* Updated readme

= 1.7.0 =
* Added `episode_key` support to display limited access episodes

= 1.6.0 =
* Added `hide-episode-description`, `hide-playlist-descriptions` and `hide-playlist-images` attributes support

= 1.5.0 =
* Added `hide-likes`, `hide-comments`, `hide-sharing` and `hide-logo` attributes support
* Tested with WordPress 4.8.2

= 1.4.1 =
* Tested with WordPress 4.8.0

= 1.4.0 =
* Removed the support for the old embedded player (no more supported by Spreaker). If a widget has been included with the old shortcode syntax, it's now automatically converted to the new embedded player.
* Added `chapters-image` attribute support for the new Spreaker's player

= 1.3.6 =
* Added `live-autoplay` attribute support for the new Spreaker's player

= 1.3.5 =
* FIX: the plugin should display the old (mini) embedded player when type attribute is missing, in order to avoid breaking backward compatibility

= 1.3.4 =
* Translated the plugin in Spanish and Italian

= 1.3.3 =
* Added `playlist-loop` attribute support for the new Spreaker's player

= 1.3.2 =
* Added `playlist-autoupdate` attribute support for the new Spreaker's player

= 1.3.0 =
* Added support for the new Spreaker's player

= 1.2.5 =
* Tested with WordPress 4.5.3

= 1.2.4 =
* FIX: the plugin now supports sharing of user's latest episode via `user_id` param

= 1.2.3 =
* FIX: the plugin now supports both HTTP and HTTPS WordPress websites
* Tested with WordPress 4.4

= 1.2.2 =
* Tested with WordPress 4.3.1

= 1.2.1 =
* Tested with WordPress 4.1
* Added banner and icon
* Updated description

= 1.2 =
* Updated the link to spreaker support forum

= 1.1 =
* Added coupon support

= 1.0 =
* First Release
