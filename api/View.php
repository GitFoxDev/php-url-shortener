<?php

class View
{
	public function getView()
	{
		return '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8"/>
					<title>XIAG Shortener</title>
					<link href="assets/style.css" rel="stylesheet">
					<script type="text/javascript" src="assets/script.js"></script>
				</head>
				<body>
				<div class="content">
						<div class="sleft">
							<div class="stitle">Long URL</div>
							<div class="form">
								<input type="url" name="longUrl" id="longUrl" requared>
								<button onClick="shortUrl()">Do!</button>
							</div>
							<div class="serror" id="serror"></div>
						</div>
						<div class="sright">
							<div class="stitle">Short URL</div>
							<div class="sresult" id="sresult"></div>
						</div>
				</div>
				</body>
			</html>';
	}
}