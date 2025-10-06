@section('page-title', __tr('Notifications'))
@section('head-title', __tr('Notifications'))
@section('keywordName', __tr('Notifications'))
@section('keyword', __tr('Notifications'))
@section('description', __tr('Notifications'))
@section('keywordDescription', __tr('Notifications'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="mb-6">
	<h1 class="text-3xl font-semibold lw-font" style="color: var(--lw-primary);">
		<i class="fas fa-bell mr-2" style="color: var(--lw-gradient-start);" aria-hidden="true"></i>
		<?= __tr('Notifications') ?>
	</h1>
	<p class="lw-body-text mt-2"><?= __tr('Manage your notifications and stay updated') ?></p>
</div>

<!-- Start of Notification Wrapper -->
<div class="lw-card-glass mb-6">
	<div class="p-6">
		<x-lw.datatable id="lwManageUserPhotosTable" :url="route('user.notification.read.list')">
			<th data-template="#notificationMsgActionTemplate" data-orderable="true"  data-order-by="true" data-order-type="desc" data-name="formattedMessage"><?= __tr('Notification For') ?></th>
			<th data-order-by="true" data-order-type="desc" data-template="#notificationTimeActionTemplate" data-orderable="true"  data-name="created_at"><?= __tr('Time') ?></th>
		</x-lw.datatable>
	</div>
</div>
<!-- End of Notification Wrapper -->

<!-- Notification Msg Action Column -->
<script type="text/_template" id="notificationMsgActionTemplate">
	<!-- Notification Msg link -->
	<div class="flex items-center gap-2">
		<span class="lw-body-text flex-1"><%= __tData.formattedMessage %></span>
		<a href="<%= __tData.action %>" class="lw-btn lw-btn-secondary" style="padding: 8px 16px; height: auto; font-size: 14px;">
			<i class="fas fa-user-circle mr-1"></i><?= __tr('View') ?>
		</a>
	</div>
	<!-- /Notification Msg link -->
</script>
<!-- Notification Msg Action Column -->

<!-- Notification Msg Action Column -->
<script type="text/_template" id="notificationTimeActionTemplate">
	<!-- Notification Time link -->
	<span class="lw-small-text" title="<%= __tData.created_at %>" style="color: var(--lw-gray-600);">
		<i class="far fa-clock mr-1" style="color: var(--lw-gradient-start);"></i><%= __tData.formattedCreatedAt %>
	</span>
	<!-- /Notification Time link -->
</script>
<!-- Notification Msg Action Column -->

@lwPush('appScripts')
<script>
	//notification read callback
	function notificationReadCallback(response) {
		if (response.reaction == 1) {
			//reload data-table instance
			reloadDT(notificationTableInstance);
			//get notification list
			var requestData = response.data.getNotificationList,
				getNotificationList = requestData.notificationData,
				getNotificationCount = requestData.notificationCount,
				notification = '';
			//empty text
			$("#lwNotificationList").text('');
			if (!_.isEmpty(getNotificationList)) {
				_.forEach(getNotificationList, function(value, key) {
					notification = '<a class="dropdown-item d-flex align-items-center"><div><div class="small text-gray-500">' + value.created_at + '</div><span class="font-weight-bold">' + value.message + '</span></div></a>';
					$("#lwNotificationList").append(notification);
				});
			} else {
				//hide show all notification link in top header
				$("#lwShowAllNotifyLink").hide();
				notification = '<a class="dropdown-item text-center small text-gray-500"><?= __tr('There are no notification.') ?></a>'
			}
			$("#lwNotificationCount").text(getNotificationCount);
		}
	}
</script>
@lwPushEnd

<style>
/* Notification List Page Styling - Override dark theme */

/* Target both card and lw-card-glass to ensure styling applies */
.lw-card-glass 	.card {
	background: rgba(255, 255, 255, 0.95) !important;
	background-color: rgba(255, 255, 255, 0.95) !important;
	border: none !important;
}

/* DataTable Wrapper - Remove dark backgrounds */
.lw-card-glass .dataTables_wrapper,
.card .dataTables_wrapper {
	background: transparent !important;
}

.lw-card-glass table.dataTable,
.lw-card-glass .table,
.card table.dataTable,
.card .table {
	background: white !important;
	background-color: white !important;
	color: var(--lw-primary) !important;
	border: 1px solid var(--lw-gray-200) !important;
	border-radius: 12px !important;
	overflow: hidden !important;
}

/* Table Headers */
.lw-card-glass table.dataTable thead,
.lw-card-glass .table thead,
.card table.dataTable thead,
.card .table thead {
	background: var(--lw-gradient-light) !important;
	background-color: rgba(197, 62, 141, 0.08) !important;
}

.lw-card-glass table.dataTable thead th,
.lw-card-glass .table thead th,
.card table.dataTable thead th,
.card .table thead th {
	background: transparent !important;
	background-color: transparent !important;
	color: var(--lw-primary) !important;
	font-family: var(--lw-font-family) !important;
	font-weight: 600 !important;
	font-size: 15px !important;
	border-bottom: 2px solid var(--lw-gradient-start) !important;
	border-top: none !important;
	padding: 16px !important;
}

/* Table Body */
.lw-card-glass table.dataTable tbody,
.lw-card-glass .table tbody,
.card table.dataTable tbody,
.card .table tbody {
	background: white !important;
	background-color: white !important;
}

.lw-card-glass table.dataTable tbody td,
.lw-card-glass .table tbody td,
.card table.dataTable tbody td,
.card .table tbody td {
	background: white !important;
	background-color: white !important;
	color: var(--lw-primary) !important;
	padding: 16px !important;
	border-bottom: 1px solid var(--lw-gray-200) !important;
	border-top: none !important;
	vertical-align: middle !important;
}

.lw-card-glass table.dataTable tbody tr,
.lw-card-glass .table tbody tr,
.card table.dataTable tbody tr,
.card .table tbody tr {
	background: white !important;
	background-color: white !important;
	transition: all 0.3s ease !important;
}

.lw-card-glass table.dataTable tbody tr:hover,
.lw-card-glass .table tbody tr:hover,
.card table.dataTable tbody tr:hover,
.card .table tbody tr:hover {
	background: rgba(197, 62, 141, 0.05) !important;
	background-color: rgba(197, 62, 141, 0.05) !important;
}

/* DataTable controls wrapper */
.lw-card-glass .dataTables_wrapper .dataTables_length,
.lw-card-glass .dataTables_wrapper .dataTables_filter,
.lw-card-glass .dataTables_wrapper .dataTables_info,
.lw-card-glass .dataTables_wrapper .dataTables_paginate,
.card .dataTables_wrapper .dataTables_length,
.card .dataTables_wrapper .dataTables_filter,
.card .dataTables_wrapper .dataTables_info,
.card .dataTables_wrapper .dataTables_paginate {
	background: transparent !important;
	color: var(--lw-primary) !important;
}

/* DataTable controls labels */
.lw-card-glass .dataTables_wrapper .dataTables_length label,
.lw-card-glass .dataTables_wrapper .dataTables_filter label,
.card .dataTables_wrapper .dataTables_length label,
.card .dataTables_wrapper .dataTables_filter label {
	font-family: var(--lw-font-family) !important;
	color: var(--lw-primary) !important;
	font-weight: 500 !important;
	font-size: 14px !important;
}

/* Select and Input fields */
.lw-card-glass .dataTables_wrapper .dataTables_length select,
.lw-card-glass .dataTables_wrapper .dataTables_filter input,
.card .dataTables_wrapper .dataTables_length select,
.card .dataTables_wrapper .dataTables_filter input {
	border: 2px solid var(--lw-gradient-start) !important;
	border-radius: 20px !important;
	padding: 4px 16px !important;
	font-family: var(--lw-font-family) !important;
	color: var(--lw-primary) !important;
	background: white !important;
	background-color: white !important;
}

.lw-card-glass .dataTables_wrapper .dataTables_length select:focus,
.lw-card-glass .dataTables_wrapper .dataTables_filter input:focus,
.card .dataTables_wrapper .dataTables_length select:focus,
.card .dataTables_wrapper .dataTables_filter input:focus {
	outline: none !important;
	border-color: var(--lw-gradient-end) !important;
	box-shadow: 0 0 0 3px rgba(197, 62, 141, 0.1) !important;
	background: white !important;
	background-color: white !important;
}

/* Info text */
.lw-card-glass .dataTables_wrapper .dataTables_info,
.card .dataTables_wrapper .dataTables_info {
	font-family: var(--lw-font-family) !important;
	color: var(--lw-secondary) !important;
	font-size: 14px !important;
	background: transparent !important;
}

/* Pagination styling */
.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button,
.card .dataTables_wrapper .dataTables_paginate li {
	border: 1px solid var(--lw-gradient-start) !important;
	border-radius: 8px !important;
	background: white !important;
	background-color: white !important;
	color: var(--lw-primary) !important;
	margin: 0 4px !important;
	font-family: var(--lw-font-family) !important;
	transition: all 0.3s ease !important;
	padding: 6px 12px !important;
}
.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button,
.card .dataTables_wrapper .dataTables_paginate a {
	/* border: 1px solid var(--lw-gradient-start) !important; */
	border-radius: 8px !important;
	background: white !important;
	background-color: white !important;
	color: var(--lw-primary) !important;
	margin: 0 4px !important;
	font-family: var(--lw-font-family) !important;
	transition: all 0.3s ease !important;
	padding: 6px 12px !important;
}
.page-link{
	border:none !important;
}

.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
.card .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
	background: var(--lw-gradient-start) !important;
	background-color: var(--lw-gradient-start) !important;
	color: white !important;
	border-color: var(--lw-gradient-start) !important;
}

.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button.current,
.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
.card .dataTables_wrapper .dataTables_paginate .paginate_button.current,
.card .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	background: var(--lw-gradient-main) !important;
	background-color: var(--lw-gradient-start) !important;
	color: white !important;
	border-color: var(--lw-gradient-start) !important;
}

.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.lw-card-glass .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
	opacity: 0.5 !important;
	cursor: not-allowed !important;
	background: white !important;
	background-color: white !important;
	color: var(--lw-gray-400) !important;
}

/* Empty state styling */
.lw-card-glass .dataTables_empty,
.card .dataTables_empty {
	padding: 40px !important;
	text-align: center !important;
	font-family: var(--lw-font-family) !important;
	color: var(--lw-secondary) !important;
	font-size: 16px !important;
	background: white !important;
	background-color: white !important;
}

/* Remove any odd/even row coloring */
.lw-card-glass table.dataTable.stripe tbody tr.odd,
.lw-card-glass table.dataTable.display tbody tr.odd,
.card table.dataTable.stripe tbody tr.odd,
.card table.dataTable.display tbody tr.odd {
	background: white !important;
	background-color: white !important;
}

.lw-card-glass table.dataTable.stripe tbody tr.even,
.lw-card-glass table.dataTable.display tbody tr.even,
.card table.dataTable.stripe tbody tr.even,
.card table.dataTable.display tbody tr.even {
	background: white !important;
	background-color: white !important;
}

/* Sorting icons */
.lw-card-glass table.dataTable thead .sorting:before,
.lw-card-glass table.dataTable thead .sorting:after,
.lw-card-glass table.dataTable thead .sorting_asc:before,
.lw-card-glass table.dataTable thead .sorting_asc:after,
.lw-card-glass table.dataTable thead .sorting_desc:before,
.lw-card-glass table.dataTable thead .sorting_desc:after,
.card table.dataTable thead .sorting:before,
.card table.dataTable thead .sorting:after,
.card table.dataTable thead .sorting_asc:before,
.card table.dataTable thead .sorting_asc:after,
.card table.dataTable thead .sorting_desc:before,
.card table.dataTable thead .sorting_desc:after {
	color: var(--lw-gradient-start) !important;
	opacity: 0.6 !important;
}

/* Override card-body dark background */
.card .card-body {
	background: transparent !important;
	background-color: transparent !important;
}
</style>
