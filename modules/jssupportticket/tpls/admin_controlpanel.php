<?php
	wp_enqueue_script('chart.min.js',jssupportticket::$_pluginpath.'includes/js/chart.min.js');
?>
<script>
	var doughnutData = [
			{
				value: <?php echo jssupportticket::$_data['pie_openticket']; ?>,
				color:"#E16AA2",
				highlight: "#FF78B8",
				label: "<?php echo __('OPEN','js-support-ticket'); ?>"
			},
			{
				value: <?php echo jssupportticket::$_data['pie_closeticket']; ?>,
				color: "#19A7D1",
				highlight: "#1FCCFF",
				label: "<?php echo __('CLOSE','js-support-ticket'); ?>"
			},
			{
				value: <?php echo jssupportticket::$_data['pie_answeredticket']; ?>,
				color: "#D5D6DE",
				highlight: "#F5F6FF",
				label: "<?php echo __('ANSWERED','js-support-ticket'); ?>"
			},
			{
				value: <?php echo jssupportticket::$_data['pie_allticket']; ?>,
				color: "#D54E21",
				highlight: "#FF5D28",
				label: "<?php echo __('ALL_TICKET','js-support-ticket'); ?>"
			}

		];

		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : <?php echo "[".jssupportticket::$_data['line_dates']."]"; ?>,
			datasets : [
				{
					label: "<?php echo __('OPEN','js-support-ticket'); ?>",
					fillColor : "rgba(225,106,162,0.2)",
					strokeColor : "rgba(225,106,162,1)",
					pointColor : "rgba(225,106,162,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(225,106,162,1)",
					data : <?php echo "[".jssupportticket::$_data['line_openticket']."]"; ?>
				},
				{
					label: "<?php echo __('CLOSE','js-support-ticket'); ?>",
					fillColor : "rgba(25,167,209,0.2)",
					strokeColor : "rgba(25,167,209,1)",
					pointColor : "rgba(25,167,209,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(25,167,209,1)",
					data : <?php echo "[".jssupportticket::$_data['line_closeticket']."]"; ?>
				},
				{
					label: "<?php echo __('ANSWERED','js-support-ticket'); ?>",
					fillColor : "rgba(213,214,222,0.2)",
					strokeColor : "rgba(213,214,222,1)",
					pointColor : "rgba(213,214,222,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(213,214,222,1)",
					data : <?php echo "[".jssupportticket::$_data['line_answeredticket']."]"; ?>
				},
				{
					label: "<?php echo __('ALL_TICKET','js-support-ticket'); ?>",
					fillColor : "rgba(213,78,33,0.2)",
					strokeColor : "rgba(213,78,33,1)",
					pointColor : "rgba(213,78,33,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(213,78,33,1)",
					data : <?php echo "[".jssupportticket::$_data['line_allticket']."]"; ?>
				}
			]

		}

		window.onload = function(){
			var ctx = document.getElementById("chart-area").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});

			var ctx = document.getElementById("canvas").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		};
</script>
<span class="js-admin-title"><?php echo __('SATISTICS','js-support-ticket');?></span>
<div class="js-wrapper">
	<div class="js-col-md-4">
		<canvas id="chart-area" height="260"/>
	</div>
	<div class="js-col-md-7">
		<canvas id="canvas" ></canvas>
	</div>
	<div class="row js-span-wrapper">
		<div class="js-col-md-3">
			<span class="js-admin-ticket-open"><?php echo __('OPEN','js-support-ticket'); ?></span>
		</div>
		<div class="js-col-md-3">
			<span class="js-admin-ticket-close"><?php echo __('CLOSE','js-support-ticket'); ?></span>
		</div>
		<div class="js-col-md-3">
			<span class="js-admin-ticket-answered"><?php echo __('ANSWERED','js-support-ticket'); ?></span>
		</div>
		<div class="js-col-md-3">
			<span class="js-admin-ticket-allticket"><?php echo __('ALL_TICKET','js-support-ticket'); ?></span>
		</div>
	</div>
</div>
<span class="js-admin-title"><?php echo __('CONTROL_PANEL','js-support-ticket');?></span>
<div class="js-wrapper">
	<div class="js-box-wrapper js-1">
		<a class="js-admin-link" href="?page=ticket&layout=tickets"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/ticket.png"/></div><div class="text-wrapper"><?php echo __('TICKETS','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=configuration&layout=configurations"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/configuration.png"/></div><div class="text-wrapper"><?php echo __('CONFIGURATIONS','js-support-ticket');?></div></div></a>
		<a class="js-admin-link" href="?page=department&layout=departments"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/departments.png"/></div><div class="text-wrapper"><?php echo __('DEPARTMENTS','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=priority&layout=priorities"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/priority.png"/></div><div class="text-wrapper"><?php echo __('PRIORITES','js-support-ticket'); ?></div></div></a>
	</div>
	<div class="js-box-wrapper js-2">
		<a class="js-admin-link" href="?page=email&layout=emails"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/system_email.png"/></div><div class="text-wrapper"><?php echo __('SYSTEM_EMAILS','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=emailtemplate&layout=emailtemplates"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/email_template.png"/></div><div class="text-wrapper"><?php echo __('EMAIL_TEMPLATES','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=userfeild&layout=userfeilds"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/user_fields.png"/></div><div class="text-wrapper"><?php echo __('USER_FIELDS','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=systemerror&layout=systemerrors"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/system_error.png"/></div><div class="text-wrapper"><?php echo __('SYSTEM_ERRORS','js-support-ticket'); ?></div></div></a>
	</div>
	<div class="js-box-wrapper js-3">
		<a class="js-admin-link" href="?page=jssupportticket&layout=propage&task=jssupportticket_propage"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/pro_icon.png"/></div><div class="text-wrapper"><?php echo __('PRO_VERSION','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=jssupportticket&layout=aboutus&task=jssupportticket_aboutus"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/about_us.png"/></div><div class="text-wrapper"><?php echo __('ABOUT_US','js-support-ticket'); ?></div></div></a>
		<a class="js-admin-link" href="?page=proinstaller&layout=step1"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/upgrade.png"/></div><div class="text-wrapper"><?php echo __('UPGRADE','js-support-ticket'); ?></div></div></a>		
	</div>
<span class="js-admin-title"><?php echo __('SUPPORT_AREA','js-support-ticket');?></span>
    <div class="js-box-wrapper js-1">        
		<a class="js-admin-link" href="?page=jssupportticket&layout=shortcodes"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/short_code.png"/></div><div class="text-wrapper"><?php echo __('SHORT_CODES', 'js-support-ticket'); ?></div></div></a>
        <a class="js-admin-link" target="_blank" href="http://joomshark.com/index.php/documentations/jsdocumentation/categories/default/5"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/documentation.png"/></div><div class="text-wrapper"><?php echo __('DOCUMENTATION', 'js-support-ticket'); ?></div></div></a>
        <a class="js-admin-link" target="_blank" href="http://joomshark.com/index.php/forum/js-support-ticket-wp"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/forum.png"/></div><div class="text-wrapper"><?php echo __('FORUM', 'js-support-ticket'); ?></div></div></a>
        <a class="js-admin-link" target="_blank" href="http://joomshark.com/index.php/jstickets"><div class="js-box"><div class="img-wrapper"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/support.png"/></div><div class="text-wrapper"><?php echo __('SUPPORT', 'js-support-ticket'); ?></div></div></a>
    </div>
</div>
<span class="js-admin-title"><?php echo __('LATEST_TICKETS', 'js-support-ticket'); ?></span>
<div class="js-ticket-admin-cp-tickets">
    <div class="js-row js-ticket-admin-cp-head js-ticket-admin-hide-head">
        <div class="js-col-xs-12 js-col-md-2"><?php echo __('TICKET_ID', 'js-support-ticket'); ?></div>
        <div class="js-col-xs-12 js-col-md-3"><?php echo __('SUBJECT', 'js-support-ticket'); ?></div>
        <div class="js-col-xs-12 js-col-md-1"><?php echo __('STATUS', 'js-support-ticket'); ?></div>
        <div class="js-col-xs-12 js-col-md-2"><?php echo __('FROM', 'js-support-ticket'); ?></div>
        <div class="js-col-xs-12 js-col-md-2"><?php echo __('PRIORITY', 'js-support-ticket'); ?></div>
        <div class="js-col-xs-12 js-col-md-2"><?php echo __('CREATED', 'js-support-ticket'); ?></div>
    </div>
    <?php foreach (jssupportticket::$_data['tickets'] AS $ticket): ?>
        <div class="js-ticket-admin-cp-data">
            <div class="js-col-xs-12 js-col-md-2"><span class="js-ticket-admin-cp-showhide"><?php echo __('TICKET_ID', 'js-support-ticket');
    echo " : "; ?></span> <a href="<?php echo admin_url("admin.php?page=ticket&layout=ticketdetail&jssupportticketid=" . $ticket->id); ?>"><?php echo $ticket->ticketid; ?></a></div>
            <div class="js-col-xs-12 js-col-md-3 js-admin-cp-text-elipses"><span class="js-ticket-admin-cp-showhide" ><?php echo __('SUBJECT', 'js-support-ticket');
    echo " : "; ?></span> <?php echo $ticket->subject; ?></div>
            <div class="js-col-xs-12 js-col-md-1 js-nullpadding">
                <span class="js-ticket-admin-cp-showhide" ><?php echo __('STATUS', 'js-support-ticket');
    echo " : "; ?></span>
                <?php
                if ($ticket->status == 0) {
                    $style = "red;";
                    $status = __('NEW', 'js-support-ticket');
                } elseif ($ticket->status == 1) {
                    $style = "orange;";
                    $status = __('WAITING_STAFF_REPLY', 'js-support-ticket');
                } elseif ($ticket->status == 2) {
                    $style = "#FF7F50;";
                    $status = __('IN_PROGRESS', 'js-support-ticket');
                } elseif ($ticket->status == 3) {
                    $style = "green;";
                    $status = __('WAITING_YOUR_REPLY', 'js-support-ticket');
                } elseif ($ticket->status == 4) {
                    $style = "blue;";
                    $status = __('CLOSED', 'js-support-ticket');
                }
                echo '<span style="color:' . $style . '">' . $status . '</span>';
                ?>
            </div>
            <div class="js-col-xs-12 js-col-md-2"> <span class="js-ticket-admin-cp-showhide" ><?php echo __('FROM', 'js-support-ticket');
                echo " : "; ?></span> <?php echo $ticket->name; ?></div>
            <div class="js-col-xs-12 js-col-md-2" style="color:<?php echo $ticket->prioritycolour; ?>;"> <span class="js-ticket-admin-cp-showhide" ><?php echo __('PRIORITY', 'js-support-ticket');
    echo " : "; ?></span> <?php echo $ticket->priority; ?></div>
            <div class="js-col-xs-12 js-col-md-2"><span class="js-ticket-admin-cp-showhide" ><?php echo __('CREATED', 'js-support-ticket');
    echo " : "; ?></span> <?php echo date(jssupportticket::$_config['date_format'], strtotime($ticket->created)); ?></div>
        </div>
<?php endforeach; ?>
</div>
