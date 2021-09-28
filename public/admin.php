<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('template/headDt.php') ?>
</head>

<body>
	<?php include('template/navDt.php') ?>
	<div class="tab-content">
		<div id="landingPage" class="tab-pane active show" role="tabpanel">
			<div id="tbl_report_spinner" class="spinner">
				<div class="spinner-db"></div>
				<div class="spinner-arrow"></div>
			</div>
			<table id="tbl_toblerone_report" class="table table-striped" style="height: 100%; width: 100%; display: none;">
				<thead>
					<tr>
						<th>Table</th>
						<th>Rows</th>
						<th>Size (MB)</th>
						<th>Collation</th>
						<th>Engine</th>
						<th>Creation Time</th>
						<th>Update Time</th>
						<th>Comment</th>
					<tr>
				</thead>
				<tbody>
					<tr>
						<td>content_source</td>
						<td>0</td>
						<td>0.015625</td>
						<td>utf8mb4_general_ci</td>
						<td>InnoDB</td>
						<td>Thu Sep 23 2021 16:23:45 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td>Tue Sep 28 2021 10:00:53 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td></td>
					</tr>
					<tr>
						<td>content_submission</td>
						<td>2</td>
						<td>0.03125</td>
						<td>utf8mb4_general_ci</td>
						<td>InnoDB</td>
						<td>Thu Sep 23 2021 16:25:19 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td>Tue Sep 28 2021 09:50:54 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td></td>
					</tr>
					<tr>
						<td>content_tag</td>
						<td>2</td>
						<td>0.015625</td>
						<td>utf8mb4_general_ci</td>
						<td>InnoDB</td>
						<td>Thu Sep 23 2021 16:25:10 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>content_x_submission_tag</td>
						<td>5</td>
						<td>0.046875</td>
						<td>utf8mb4_general_ci</td>
						<td>InnoDB</td>
						<td>Wed Sep 22 2021 17:57:34 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td>Tue Sep 28 2021 08:55:00 GMT+0200 (Ora legale dell’Europa centrale)</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="cont_tbl_content_source" class="tab-pane" role="tabpanel">
			<table id="tbl_content_source" class="table table-striped" style="height: 100%; width: 100%;">
				<thead>
					<th>Name</th>
					<th>Regex</th>
				</thead>
			</table>
		</div>
		<div id="cont_tbl_content_submission" class="tab-pane" role="tabpanel">
			<table id="tbl_content_submission" class="table table-striped" style="height: 100%; width: 100%;">
				<thead>
					<th>Url</th>
					<th>Email</th>
					<th>State</th>
					<th>Ip</th>
					<th>Date</th>
					<th>Multimedia format</th>
					<th>content_source (name)</th>
					<th class="none">content_tag (name)</th>
				</thead>
			</table>
		</div>
		<div id="cont_tbl_content_tag" class="tab-pane" role="tabpanel">
			<table id="tbl_content_tag" class="table table-striped" style="height: 100%; width: 100%;">
				<thead>
					<th>Name</th>
					<th class="none">content_submission (url)</th>
				</thead>
			</table>
		</div>
		<div id="cont_tbl_content_x_submission_tag" class="tab-pane" role="tabpanel">
			<table id="tbl_content_x_submission_tag" class="table table-striped" style="height: 100%; width: 100%;">
				<thead>
					<th>content_submission (url)</th>
					<th>content_tag (name)</th>
				</thead>
			</table>
		</div>
	</div>
	<script type="text/javascript" src="/Progetti/content_manager_better/src/js/tables/tbl_content_source.js"></script>
	<script type="text/javascript" src="/Progetti/content_manager_better/src/js/tables/tbl_content_submission.js"></script>
	<script type="text/javascript" src="/Progetti/content_manager_better/src/js/tables/tbl_content_tag.js"></script>
	<script type="text/javascript" src="/Progetti/content_manager_better/src/js/tables/tbl_content_x_submission_tag.js"></script>
</body>

</html>