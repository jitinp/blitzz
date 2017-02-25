<?php

/*
MIT License

Copyright (c) 2016 Italian Space Astronautics Association - ISAA
Copyright (c) 2016 Marco Zambianchi for ISAA Technical Board

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/ 

use ISAA\OpenGraph\OpenGraph as OG;
use Flarum\Event\PostWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
	$events->listen(PostWillBeSaved::class, function (PostWillBeSaved $event) {
		
		$found = preg_match('#(https?://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',$event->post->content,$matches);
		if (!$found) return;
		
		$aux = new OG();
		$graph = $aux->fetch(trim($matches[0]));
		
		// Must have a title, a description and an url, or we skip
		if (!isset($graph->title)) return;
		if (!isset($graph->url)) return;
		
		$text = "## " . trim($graph->title) . PHP_EOL;
		if (isset($graph->description)) $text .= trim($graph->description) . PHP_EOL;
		$text .= "[Read more...](" . trim($graph->url) . ")". PHP_EOL;
		if (isset($graph->image)) $text .= "![](" . trim($graph->image) . ")" . PHP_EOL;
		
		unset($aux);

		/*
		// Some debug stuff...
		$text .= "---" . PHP_EOL . PHP_EOL;
		foreach ($graph as $key => $value) {
			$text .= "$key => $value" . PHP_EOL	;
		}
		$text .= "---" . PHP_EOL . PHP_EOL;
		*/ 
		
		$event->post->content .= PHP_EOL . PHP_EOL . $text;

	});
};
