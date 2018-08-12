<!doctype html>
<html>

<head>
	<title><?php print $layout_title?></title>
	<script>
    (function(document,navigator,standalone) {
        // prevents links from apps from oppening in mobile safari
        // this javascript must be the first script in your <head>
        if ((standalone in navigator) && navigator[standalone]) {
            var curnode, location=document.location, stop=/^(a|html)$/i;
            document.addEventListener('click', function(e) {
                curnode=e.target;
                while (!(stop).test(curnode.nodeName)) {
                    curnode=curnode.parentNode;
                }
                // Conditions to do this only on links to your own app
                // if you want all links, use if('href' in curnode) instead.
                if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                    e.preventDefault();
                    location.href = curnode.href;
                }
            },false);
        }
    })(document,window.navigator,'standalone');
</script>
	<?php include("header.php"); ?>
	<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, width=device-width" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, width=device-width" />
</head>

<body style="width:100%; font-size: 90%;" id="mobile-body">
	<div id="drawer">
		<img id="theme_banner" style="width:100%" src="<?php print htmlspecialchars($layout_logopic); ?>" alt="" title="<?php print htmlspecialchars($layout_logotitle); ?>" style="padding: 8px;" />
		
		<?php 
			$layout_navigation->setClass("stackedMenu");
			$layout_userpanel->setClass("stackedMenu");
		?>
		<?php print $layout_userpanel->build(0); ?>
		&nbsp;
		<?php print $layout_navigation->build(0); ?>
	</div>
	<div id="drawer-overlay">
	</div>
	<div id="mobile-headerBar">
		<table style="width:100%;"><tr  class="cell0">
		<td>
			<a id="drawer-toggle" href="#" class="button"><i class="icon-reorder"></i></a>
		</td>
		<?php 
			$last = $layout_crumbs->pop();
			if($last == NULL)
				$now = htmlspecialchars(Settings::get("boardname"));
			else
				$now = $last->getText();

			$last2 = NULL;
			if($last != NULL && $last->getLink() == "")
			{
				$last2 = $layout_crumbs->pop();
				if($last2 == NULL)
					$now2 = "<a href=\"$boardroot\">".htmlspecialchars(Settings::get("boardname"))."</a>";
				else
					$now2 = $last2->getText();
				$now = $now2."&nbsp;&nbsp;&mdash;&nbsp;&nbsp;&nbsp;".$now;
			}		
			if($last2 == NULL)
				$last2 = $layout_crumbs->pop();
		
			$backurl = "";
//			$now = $last->getText();
			if($last2 != NULL)
			{
				$backurl = htmlspecialchars($last2->getLink());
				$now = "<i class=\"icon-chevron-left\">&nbsp;</i> ".$now;
			}
			
			$now = "<a href=\"$backurl\">$now</a>";
			echo "<td style='width: 99%'><div style='width: 100%; height: 40px; position:relative;'><div style=\"position:absolute;\">$now</div></div></td>";
		?>
		<td>
			<?php
				$layout_links->setClass("toolbarMenu");
			 	print $layout_links->build(2); 
			 ?>
		</td>
		</tr></table>
	</div>
	<div id="body">
		<div id="body-wrapper">
			<div id="main" style="padding:8px;">

				<form action="<?php print actionLink('login'); ?>" method="post" id="logout">
					<input type="hidden" name="action" value="logout" />
				</form>

				<?php print $layout_bars; ?>
				<?php print $layout_contents;?>

			</div>
			<div class="footer" style="clear: both;">
				<?php echo $layout_footer; ?>
			</div>
		</div>
	</div>
</body>
</html>
