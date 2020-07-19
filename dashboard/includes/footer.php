<!--footer-->
<div class="footer">
	<p>&copy; 2019 Petty Cash. All Rights Reserved | Design by
		<a href="https://ascii.co.zw" target="_blank">Ascii Technologies</a>
	</p>
</div>
<!--//footer-->
</div>

<!-- new added graphs chart js-->
<script src="js/utils.js"></script>

<!-- new added graphs chart js-->
<script>
	function myFunction() {
		/* Get the text field */
		var copyText = document.getElementById("refferal");

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/* Copy the text inside the text field */
		document.execCommand("copy");

		/* Alert the copied text */
		alert("Copied the text: " + copyText.value);
	}
	$(document).ready(function() {
		$('#approvals').DataTable();
		setInterval(function() {
			changeColor();
		}, 1000);

	});

	var colors = new Array('#ff4f81', '#8e43e7', '#146eb4', '#ff9900', '#6a67ce');
	var nextColor = 0;

	function changeColor() {
		if (nextColor == 5) {
			nextColor = 0;
		}
		$('#upgrade').css('color', colors[nextColor]);
		nextColor++;
	}
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- Classie -->
<!-- for toggle left push menu script -->
<script src="js/classie.js"></script>
<script>
	<?php
	$query = "SELECT * FROM auth_user where sponsor_id='" . $_SESSION['id'] . "'";
	$statement = $db->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$result = $statement->fetchAll();
	$children = array();
	$children_id = array();
	foreach ($result as $row) {
		array_push($children, $row['first_name']);
		array_push($children_id, $row['id']);
	}

	?>
	var svg = d3.select("#tree").append("svg")
		.attr("width", 1000).attr("height", 600)
		.append("g").attr("transform", "translate(50,50)");

	var data = [{
		"child": "<?php echo $_SESSION['first_name']; ?>",
		"parent": ""
	}, <?php
		$i = 0;
		while ($i < sizeof($children)) {
			$query = "SELECT * FROM auth_user where sponsor_id='" . $children_id[$i] . "' LIMIT 3";
			$statement = $db->prepare($query);
			$statement->execute();
			$count = $statement->rowCount();
			$result = $statement->fetchAll();

			foreach ($result as $row) {
				echo '{"child": "' . $row['first_name'] . '","parent": "' . $children[$i] . '"},';
			}
			echo '{"child": "' . $children[$i] . '","parent": "' . $_SESSION['first_name'] . '"},';
			$i++;
		}
		?>];
	var dataStructure = d3.stratify()
		.id(function(d) {
			return d.child;
		})
		.parentId(function(d) {
			return d.parent;
		})
		(data);

	var treeStructure = d3.tree().size([1000, 200]);
	var information = treeStructure(dataStructure);
	console.log(information.descendants());
	var connections = svg.append("g").selectAll("path").data(information.links());
	connections.enter().append("path")
		.attr("d", function(d) {
			return "M" + d.source.x + "," + d.source.y + "v 40 H" +
				d.target.x + " V" + d.target.y;

		});

	var rectangles = svg.append("g").selectAll("rect").data(information.descendants());
	rectangles.enter().append("rect")
		.attr("x", function(d) {
			return d.x - 55;
		})
		.attr("y", function(d) {
			return d.y - 20;
		})
		.attr('width', '110px')
		.attr('height', '40px')
		.style(
			'fill', 'yellow'
		);

	var names = svg.append("g").selectAll("text")
		.data(information.descendants());
	names.enter().append("text")
		.text(function(d) {
			return d.data.child;
		})
		.attr("x", function(d) {
			return d.x;
		})
		.attr("y", function(d) {
			return d.y;
		})
</script>
<script>
	var menuLeft = document.getElementById('cbp-spmenu-s1'),
		showLeftPush = document.getElementById('showLeftPush'),
		body = document.body;

	showLeftPush.onclick = function() {
		classie.toggle(this, 'active');
		classie.toggle(body, 'cbp-spmenu-push-toright');
		classie.toggle(menuLeft, 'cbp-spmenu-open');
		disableOther('showLeftPush');
	};


	function disableOther(button) {
		if (button !== 'showLeftPush') {
			classie.toggle(showLeftPush, 'disabled');
		}
	}
</script>

<!-- //Classie -->
<!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->

<!-- side nav js -->
<script src='js/SidebarNav.min.js' type='text/javascript'></script>


<script>
	$('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->

<!-- for index page weekly sales java script -->
<script src="js/SimpleChart.js"></script>
<!-- //for index page weekly sales java script -->


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"> </script>
<!-- //Bootstrap Core JavaScript -->

</body>

</html>