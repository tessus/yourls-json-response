# JSON Response

Plugin for [YOURLS](http://yourls.org/).

Add .json (or a custom string/character) to the short URL to get info about it as a JSON response.

## Installation

1. Change to the `user/plugins` directory
	  - `git clone https://github.com/tessus/yourls-json-response.git json-response`
  
    	or
	
    - create a directory `json-response` and copy the [files of this repository](https://github.com/tessus/yourls-json-response/archive/master.zip) to it
2. Activate the plugin (in your YOURLS admin page) 

## Configuration

By default the suffix `.json` is used. However, it is possible to use a different string or character.

In `config.php` add the following (to change the suffix to `.j`):

```php
define('TESSUS_JSON_TRIGGER', '\.j');
```

Please note that certain characters have to be escaped. The plugin uses a regex to search for the suffix. Therefore all characters that have a special meaning in the regex world will have to be escaped accordingly.

## Usage

Just add the JSON suffix to the short URL.

The JSON response consists of 4 keys: `url`, `title`, `keyword`, and `shorturl`. 

### Example

```bash
$ curl -s http://g0to.ca/cu2t8.json |jq
{
  "url": "https://www.amazon.ca/hz/wishlist/ls/109NPR6TPF108?&sort=default",
  "title": "Helmut K. C. Tessarek's Wish List",
  "keyword": "cu2t8",
  "shorturl": "http://g0to.ca/cu2t8"
}
```

## License

This plugin is licensed under the terms of the GNU General Public License, version 3 (GPLv3).
License conditions are included in [LICENSE](LICENSE) or can be found at the [GNU website](https://www.gnu.org/licenses/gpl.html).