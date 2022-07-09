===================
inesonic-shortcodes
===================
This is a small WordPress plugin that provides a small number of generic and
useful shortcodes for WordPress.  This plugin is currently used on the
``Inesonic, LLC website <https://inesonic.com>``.

To use, simply copy this entire directory into your WordPress plugins directory
and then activate the plugin from the WordPress admin panel.

Once activated, you can use any of the shortcodes below.

inesonic_first_name
===================
This shortcode will display the first name of the current user.  To use, simply
insert ``[inesonic_first_name]`` into your page or post.


inesonic_last_name
==================
This shortcode will display the last name of the current user.  To use, simply
insert ``[inesonic_last_name]`` into your page or post.


inesonic_full_name
==================
This shortcode will display the first and last name of the current user.  To
use, simply insert ``[inesonic_full_name]`` into your page or post.


inesonic_username
=================
This shortcode will display the login username of the current user.  To use,
simply insert ``[inesonic_username]`` into your page or post.


inesonic_email_address
======================
This shortcode will display the current user's email address.  To use, simply
insert ``[inesonic_email_address]`` into your page or post.


inesonic_registered_datetime
============================
This shortcode will display the date and time that the user account was
created.  You can use this shortcode to show messages such as
``User since April 1, 2017``, etc.

The shortcode accepts an optional ``format`` parameter you can use to
specify the date/time format.  Use a format string supported by the
PHP ``date`` function documented at
https://www.php.net/manual/en/function.date.php.

To use, simply insert ``[inesonic_registered_datetime]``.  Alternately,
you can insert a specially formatted datetime such as
``[inesonic_registered_datetime format="F j, Y g:i a"]``.
