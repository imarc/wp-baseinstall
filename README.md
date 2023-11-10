baseinstall
===

baseinstall is a responsive starter theme for WordPress development built on Underscores as a starting point. It features a [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) inspired by Scribu for keeping page templates free of excessive repetition.

As an added bonus it also features a customizable theme options page, a mobile menu with sub-menu toggles, and no external library/framework dependencies such as jQuery, Bootstrap, or Foundation. The minified CSS/JS files weigh in at 77kb combined.

This theme is currently under active development and will see some changes, but the demo as it is now can be viewed here: [baseinstall Demo](https://dev-baseinstall.pantheonsite.io).


Quick Start Guide
---

This quick-start guide assumes you already have a local development environment with WordPress already installed and running. More detailed documentation is in the works, but if you've done this type of thing before it should be easy to get going.

First, either download the files from this repo or run the following commands in your terminal:

```shell
$ cd your-wp-directory/wp-content/themes
$ git clone https://github.com/imarc/wp-baseinstall.git baseinstall
```

Once the theme files are in <code>wp-content/themes</code>, open <code>webpack.mix.js</code> in your code editor and look for this:

```javascript
proxy: 'https://baseinstall:8890/' // Project URL. Could be something like localhost:8888.
```

You'll need to update that line above to reflect your local development settings for BrowserSync to work properly. Check your `wp-config.php` or `wp-config-local.php` and look for the lines that define `WP_HOME` and `WP_SITEURL`.

```php
define( 'WP_HOME', 'https://baseinstall:8890/' );
define( 'WP_SITEURL', 'https://baseinstall:8890/' );
```

You also might want to run a search-and-replace to change the theme name from "baseinstall" to something else, like "Client Name" or "My Awesome Theme." Once you've done that, CD into your theme folder and run <code>npm install</code> to install your dependencies.

```shell
$ cd baseinstall
$ npm install
```

```shell
$ npm run watch
```

Any time you save a .scss, .js, or .php file, your code will re-compile and the browser will reload.

Happy coding!

***

baseinstall is licensed under the [GPL](https://en.wikipedia.org/wiki/GNU_General_Public_License). Use it to make something cool, have fun, and share what you've learned with others.