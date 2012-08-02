<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>{title}</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="/libs/scripts/jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/libs/scripts/jquery/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="{theme}/events.js"></script>
	<link rel="stylesheet" type="text/css" href="{theme}/css/ui-lightness/jquery-ui-1.8.21.custom.css" />
	<link rel="stylesheet" type="text/css" href="{theme}/css/style.css" />
	
</head>

<body>
	<div class="page">
		<div class="header">
			<h1>QuiZ</h1>
		</div>
		
		
		<div class="menu">
			<ul>
				<?php foreach ($this->var["menu"] as $menu) { ?>
					<li><a href="<?php echo $menu["href"]; ?>"><?php echo $menu["title"]; ?></a></li>
				<?php } ?>
			</ul>		

		</div>		
	
		<div id="ajaxContext">
		</div>
	
		<div class="content">
			{content}
		</div>
		
	</div>
	<div id="win">
		<div class="wrap">
			<a href="#" id="closeBut">Close</a>
			<div id="win_main">
			</div>		
		</div>
	</div>
</body>
</html>