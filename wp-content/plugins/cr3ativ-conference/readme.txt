=== Cr3ativ Conference ===
Contributors: Cr3ativ
Tags: conference, events, speakers
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 1.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cr3ativ Conference plugin enables you to create a single conference event, with speaker profiles, over multiple days, with unlimited sessions per day.


== Description ==

Easily add unlimited ‘sessions’ and assign ‘speakers’ and ‘session categories’ to your WordPress site for a single conference event.  The plugin will tie a session to an unlimited number of speakers, along with relevant information such as date, start and end time, location of session (conference room B etc) and assign categories (as many as you’d like) and choose if you’d like to ‘highlight’ a session via a selection box.

For your convenience, the plugin also contains a directory called language files, where you will find the mo/po files you may use for translation purposes.

Here is [the demo](http://mythemepreviews.com/plugins/full-schedule/ "the demo").


== Required Files ==

Included in the templates directory are:

template-cr3ativspeaker.php
template-cr3ativconference.php
taxonomy-cr3ativconfcategory.php
single-cr3ativspeaker.php
single-cr3ativconference.php

You will need to upload all of the above templates in to your current theme's directory. 


== Installation ==

1. Upload the `cr3ativ-conference` folder to your to the `/wp-content/plugins/` directory or alternatively upload the cr3ativ-conference.zip via the plugin page of WordPress by clicking 'Add New' and select the zip from your local computer.

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. You will see a new post type on the left of the WP admin menu ‘Conference’. Under this menu option are several sub-menus.  ‘All Sessions’, ‘Add New Session’, ‘Session Category’, ‘Speakers’ and ‘Conference Options’.

4. Inside the 'cr3ativ-conference' plugin folder, there is a directory called 'templates', upload ONLY the template files from that folder into your current theme directory (as mentioned above). Do not upload the actual template folder, just the files within it!

5. Under the ‘Conference’ menu option in your WordPress admin area, you will see ‘Conference Options’. These options relate to the URL displayed in the browser address bar when you visit a Session Single page, Session Category page or Speaker Single page. By default you would receive the name of the plugin so we offer you the opportunity to name that however you wish - for example:

By not entering anything in these options would result in a URL appearing something like this:

http://YourWebsite.com/cr3ativspeaker/barb-atkinson/

After entering a more read-friendly slug name (Speaker) for a speaker single page my URL now appears like this:

http://YourWebsite.com/Speaker/barb-atkinson/

As an example I used the following naming conventions for the slug items in our demo:

Session Single Page Slug Name - Session
Session Category Page Slug Name - Session-Category
Speaker Single Page Slug Name - Speaker

If you have any 404 errors when trying to access your page, or if your permalinks haven’t changed, go to WordPress Admin > Settings > Permalink and re-save your permalink to reset the new url’s.


== Creating a Single Speaker ==

1. Click ‘Speakers’ and then from the top of the window click Add New and enter all relevant information including full regular content as you would normally in WordPress when creating a post or page. The post title will be the speakers name, the content will display as the ‘bio’ area for the speaker, the featured image is the ‘head shot’ of the speaker (we recommend you upload the same size images for all speakers for best appearance).

2. Below the regular content area you should see a special area named ‘Speaker Data’ - if you do not see this then please click ‘Screen Options’ at the top of the screen and ensure everything is checked so you can see everything.

3. You will see the following options: 

Speaker Title - title for the speaker such as CEO, COO, CTO
 
Speaker Company URL - url for the company the speaker is associated with

Speaker Company Name - company name the speaker is associated with

Social Follow - this is a repeatable field. Upload an image for the social icon and enter the url, if you need to add another, just click the green + to add another social icon/social follow

4. Click Publish.


== Creating a Single Session ==

1. Click ‘Add New Session’ and enter all relevant information including full regular content as you would normally in WordPress when creating a post or page. The title of the post will be the title of the session.

2. Below the regular content area you should see a special area named ‘Session Information’ - if you do not see this then please click ‘Screen Options’ at the top of the screen and ensure everything is checked so you can see everything.

3. You will see the following options: 

Date - click to assign a date for this session
 
Start Time - in the 24-hour clock format, please enter your start time of the event.  The plugin requires this field to sort by the date and time of the event.  If you do not put your time in a 24-hour clock format, the sorting for the session will be incorrect.

Display Start Time - If you do not want to 'display' the 24-hour clock format from above, you can enter what you wish here.  The plugin will still use the above for sorting, but for displaying will look to this field first, if this field is empty, the plugin will output the above 24-hour clock start time.

End Time - in the 24-hour clock format, please enter your start time of the event.  The plugin requires this field to sort by the date and time of the event.  If you do not put your time in a 24-hour clock format, the sorting for the session will be incorrect.

Display End Time - If you do not want to 'display' the 24-hour clock format from above, you can enter what you wish here.  For displaying the end time, the plugin will look to this field first, if this field is empty, the plugin will output the above 24-hour clock end time.

Location - this is just a text field, enter the location (for example: Building A or Cafe C), whatever you enter here will display.

Speaker - this box will display any and all speakers you have created, you can use your shift key or control key on your keyboard to select multiple speakers.

Highlight Style - this will place a background color around the session (for example if you wanted to highlight ‘lunch’ you would create a session called lunch and click this field).

4. On the right of the screen you will see a new box named ‘Session Category’ - this is used to categorize your session easily - an example being Workshop, Q & A, Networking etc - either choose an existing category or create a new one for it to be assigned.

5. If you wish to display an image for each session simply upload, or choose from media, the Featured Image. We recommend that you ensure all featured images for sessions are created the same size for a uniformed appearance.

6. Click Publish and create any and all further sessions.


== Creating a Session Index page ==

1. Navigate to your WordPress admin > Pages and Add New

2. Give your page a title such as Meetings or Sessions etc You may also add regular content as normal that will appear above the sessions.

3. Choose ‘Cr3ativ-Conference’ template from the right side of the page in the box titled ‘Page Attributes > Template’.  This template is specifically coded to display all sessions to a page (and their relevant information) that you can easily later add to your menu.

4. Click Publish and add this to your menu if your theme does not automatically add new pages to your site-wide menu system.


== Creating a Speaker Index page ==

1. Navigate to your WordPress admin > Pages and Add New

2. Give your page a title such as ‘Speakers’ etc You may also add regular content as normal that will appear above the speaker listings.

3. Choose ‘Cr3ativSpeaker’ template from the right side of the page in the box titled ‘Page Attributes > Template’.  This template is specifically coded to display all speakers and their relevant information, that you can easily later add to your menu.

4. Click Publish and add this to your menu if your theme does not automatically add new pages to your site-wide menu system.


== Creating a Index page for a Session Category ==

1. Navigate to your WordPress admin menu and select ‘Appearance > Menus’.

2. Look for the box on the left that is titled ‘Session Category’ - this lists all the sessions you have created under this particular session category and therefore simply click ‘Add to Menu’ to display all sessions on a per category basis.


== Adding a single Session to your menu ==

1. Navigate to your WordPress admin menu and select ‘Appearance > Menus’.

2. Look for the box on the left that is titled ‘Sessions’ - this lists all the sessions you have published, simply click each session you want to show in your menu and then click ‘Add to Menu’. If you do not see ‘Sessions’ then click ‘Screen Options’ and check all options to ensure it is displayed for you.


== Adding a single Speaker to your menu ==

1. Navigate to your WordPress admin menu and select ‘Appearance > Menus’.

2. Look for the box on the left that is titled ‘Speakers’ - this lists all the speakers you have published, simply click each speaker you want to show in your menu and then click ‘Add to Menu’. If you do not see ‘Speakers’ then click ‘Screen Options’ and check all options to ensure it is displayed for you.


== Screenshots ==

1. Sessions admin view
2. Adding a new session
3. Session category view
4. Speaker admin view
5. Adding a new speaker
6. Pretty permalink settings (remember to click save on Settings > Permalinks if you receive 404 page errors)


== Styling ==

Styling for these page templates are included in the includes directory under :

/includes/css/cr3ativconference.css


== Changelog ==

= 1.4.1 =
* Updated to correct date sort using the drag/drop widget.

= 1.4.0 =
* Updated widget section to support WP 4.3.


= 1.3.0 =
* Updated cr3ativ-conference.php, /includes/session-widget.php, /templates/single-cr3ativconference.php, /templates/single-cr3ativspeaker.php, /templates/taxonomy-cr3ativconfcategory.php, /templates/template-cr3ativconference.php.  2 new meta fields have been created so that you can choose to display the 24 hour clock or choose to put your own time.  Please note, the start and end time are still required to sort by using the 24-hour clock format, but 2 new inputs have been added for your convenience so if you wish to display on your site the 12 hour format you can.  Please update the templates listed above to your theme's root directory.  If you are using our Conference or Attend theme, an update to the theme will be forthcoming.

= 1.2.0 =
* Updated single-cr3ativconference.php, single-cr3ativspeaker.php, taxonomy-cr3ativconfcategory.php and template-cr3ativconference.php as well as the /includes/session-widget.php to correct issue with dates not translating from WP to native language.

= 1.1.0 =
* Updated single-cr3ativconference.php to correct issue with event date, please replace the single-cr3ativconference.php file with the file in your current theme’s root directory.

= 1.0.9 =
* Updated session-widget.php - Issue fixed with sorting of sessions when not added on the same date as the others but sharing the same session date.

= 1.0.8 =
* Updated cr3ativ-conference.php - The start and end time fields that were previously select and have now been changed to text fields. As long as the 24-hour clock time is used (00:00 is midnight), the sorting will not be affected and any combination of hours and minutes for your sessions can be used.

= 1.0.7 =
* Updated session-widget.php to include the 1.0.6 update, the widget was not updated with the changes for this update.

= 1.0.6 =
* Updated single-cr3ativconference.php, taxonomy-cr3ativconfcategory.php and template-cr3ativconference.php to fix issue when exporting XML of speakers to point to the correct url.

= 1.0.5 =
* Updated speaker drag/drop widget to link featured image to the post.

= 1.0.4 =
* One final change, forgot to update the media queries for new widgets.

= 1.0.3 =
* Had to remove line break on the session-widget.php added by our lovely new kitten inadvertently while I was making my last update to fix the headers already sent message.

= 1.0.2 =
* Updated session-widget.php, taxonomy-cr3ativconfcagegory.php and template-cr3ativconference.php to make sure it is ordering with oldest date first.

= 1.0.1 =
* Updated to include new drag and drop widgets for sessions and speakers.  Also updated mo/po files.

= 1.0.0 =
* First release.

