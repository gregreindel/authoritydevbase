AuthorityDev-Base-Genesis-Child-Theme
=================================

Author: <a href="http://www.gregreindel.com">Greg Reindel</a>

Current Version: 1.0

Requires: Wordpress 3.7+ and Genesis 2.0+

Starter theme for Genesis Famework.


<ul>
<li>support for native WordPress Customizer
	<ul>
	<li>change favicon</li>
	<li>add custom header image or logo</li>
	<li>add back to top text with smooth scroll</li>
	<li>change color and background image - enables backstretch.js to fit background images to the area</li>
	<li>enable sticky header - stays on the top during scroll</li>
	<li>set static or widgitized front page</li>
	</ul>
</li>
<li>editor styles</li>
<li>used mobile-detect php class to add body class and create js variable about which device is in use - isMobile, isTablet, isDesktop.</li>
<li>clean nav menu item classes
	<ul>
	<li>reduce to current-menu-item, menu-item</li>
	<li>rename ID to post-slug</li>
	</ul>
</li>
<li>homepage widgets
    <ul>
    <li>home featured full</li>
    <li>home middle halves</li>
    <li>home middle thirds</li>
    <li>home bottom full</li>
    </ul>
</li>
<li>added body classes
    <ul>
    <li>header-logo (if the header image is specifically a logo)</li>
    <li>isTablet (if the browsing device is a tablet)</li>
    <li>isMobile (if the browsing device is a mobile phone)</li>
    <li>isDesktop (if the browsing device is a desktop)</li>
    </ul>
</li>
<li>Added post classes
    <ul>
    <li>post-even (even posts)</li>
    <li>post-odd (odd posts)</li>
    <li>post-count-{number} (all posts)</li>
    </ul>
</li>
</ul>


Page Templates
<ul>
<li>page_blog.php
    <ul>
    <li>Add/remove post meta</li>
    <li>Add/remove post info</li>
    <li>Alter post meta output filter</li>
    <li>Alter post info output filter</li>
    </ul>
</li>
<li>single.php
    <ul>
    <li>Add/remove post meta</li>
    <li>Add/remove post info</li>
    <li>Alter post meta output filter</li>
    <li>Alter post info output filter</li>
    </ul>
</li>
<li>page_landing.php
    <ul>
    <li>force full width</li>
    <li>remove header</li>
    <li>remove nav</li>
    <li>remove subnav</li>
    <li>remove breadcrumbs</li>
    <li>remove footer widgets</li>
    <li>remove footer</li>
    </ul>
</li>
</ul>




<ul>
<li>functions.php & authoritydevbase_child_functions.php
    <ul>
    <li>define child theme name, url, version</li>
    <li>set content Width</li>
    <li>includes core theme files</li>
    <li>enables editor styles </li>
    <li>sets translations directory</li>
    <li>custom Favicon</li>
    <li>load & localize custom scripts</li>
    <li>remove version from script output</li>
    <li>adds theme support
        <ul>
        <li>genesis structural wraps</li>
        <li>post formats</li>
        <li>custom header</li>
        <li>custom background</li>
        <li>automatic feed links</li>
        <li>post thumbnails</li>
        <li>genesis style selector</li>
        <li>genesis footer widgets</li>
        </ul>
    </li>
    </ul>
</li>
</ul>



Change Log:

Version 1.0

Initial Commit


