# flarum-isaa-opengraph
A flarum extension for embedding opengraph content

## Where to download it
You find the script on GitHub
https://github.com/ItalianSpaceAstronauticsAssociation/flarum-isaa-opengraph

## Description
This plugin is our first attempt in writing flarum plugins and has to be considered early alpha.
The Open Graph protocol enables any web page to become a rich object in a social graph. This code takes the last URL in a flarum post and embeds title, description, url and, if available, an image adding them at the bottom of the post body.
If neither title nor url are not available, nothing gets embedded.
We do not have a list of supported website. All resources offering OpenGraph standard metadata information are embedded following the simple template "Title - Optional description - Link to content - Optional Image".

## Changelog
- 2016-09-05: Version 0.1 Alpha 1
  - First commit (for flarum ver. 0.1.0-beta.5)
  
## Known issues / Future features
- flarum already offers partial open graph embedding through mediaembed extension. If mediaembed is installed, for some domains such as Twitter, Facebook and Google+ the embedding is duplicated (will try to solve this in upcoming releases).

## Credits and copyright
The original code for the OpenGraph class is Copyright 2010 Scott MacVicar and released under Apache License, Version 2.0. Original can be found at https://github.com/scottmac/opengraph/blob/master/OpenGraph.php.

## Help us
Feel free to contribute to this project!
