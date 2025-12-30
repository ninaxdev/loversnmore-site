@section('page-title', __tr('My Earnings'))
@section('head-title', __tr('My Earnings'))
@section('keywordName', __tr('My Earnings'))
@section('keyword', __tr('My Earnings'))
@section('description', __tr('View your gift earnings and payment history'))
@section('keywordDescription', __tr('View your gift earnings and payment history'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Earnings Dashboard Page -->
<div class="w-full min-h-screen md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
	<!-- Header -->
	<div class="max-w-6xl mx-auto pt-8 mb-8">
		<div class="flex items-center justify-between mb-4">
			<h1 class="text-3xl md:text-4xl font-bold" style="color: #1F1638;">
				My Earnings
			</h1>
			<button id="dashboardLinkBtn" class="px-6 py-3 rounded-full font-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #EC4899; font-family: 'Poppins', sans-serif;">
				Stripe Dashboard
			</button>
		</div>
	</div>

	<!-- Main Content -->
	<div class="max-w-6xl mx-auto">
		<!-- Loading State -->
		<div id="loadingSection" class="text-center py-12">
			<div class="lw-page-loader"></div>
		</div>

		<!-- Earnings Content -->
		<div id="earningsContent" class="hidden">
			<!-- Stats Cards -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
				<!-- Total Earnings Card -->
				<div class="rounded-3xl p-6 shadow-sm" style="background-color: white;">
					<div class="flex items-center justify-between mb-2">
						<h3 class="text-sm font-medium" style="color: #6B7280;">Total Earnings</h3>
						<div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #D1FAE5;">
							<svg class="w-5 h-5" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
						</div>
					</div>
					<p class="text-3xl font-bold" style="color: #1F1638;" id="totalEarnings">$0.00</p>
					<p class="text-sm mt-1" style="color: #6B7280;">From <span id="totalGifts">0</span> gifts</p>
				</div>

				<!-- Available Balance Card -->
				<div class="rounded-3xl p-6 shadow-sm" style="background-color: white;">
					<div class="flex items-center justify-between mb-2">
						<h3 class="text-sm font-medium" style="color: #6B7280;">Available Balance</h3>
						<div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #DBEAFE;">
							<svg class="w-5 h-5" style="color: #3B82F6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
							</svg>
						</div>
					</div>
					<p class="text-3xl font-bold" style="color: #1F1638;" id="availableBalance">$0.00</p>
					<p class="text-sm mt-1" style="color: #6B7280;">Ready for payout</p>
				</div>

				<!-- Pending Balance Card -->
				<div class="rounded-3xl p-6 shadow-sm" style="background-color: white;">
					<div class="flex items-center justify-between mb-2">
						<h3 class="text-sm font-medium" style="color: #6B7280;">Pending</h3>
						<div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #FEF3C7;">
							<svg class="w-5 h-5" style="color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
						</div>
					</div>
					<p class="text-3xl font-bold" style="color: #1F1638;" id="pendingBalance">$0.00</p>
					<p class="text-sm mt-1" style="color: #6B7280;">Processing</p>
				</div>
			</div>

			<!-- Recent Gifts Table -->
			<div class="rounded-3xl p-8 shadow-sm" style="background-color: white;">
				<h2 class="text-2xl font-bold mb-6" style="color: #1F1638;">Recent Gifts Received</h2>

				<!-- Empty State -->
				<div id="emptyState" class="hidden text-center py-12">
					<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #F3F4F6;">
						<svg class="w-10 h-10" style="color: #9CA3AF;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
						</svg>
					</div>
					<h3 class="text-xl font-semibold mb-2" style="color: #1F1638;">No gifts yet</h3>
					<p style="color: #6B7280;">When people send you gifts, they'll appear here</p>
				</div>

				<!-- Gifts Table -->
				<div id="giftsTable" class="hidden overflow-x-auto">
					<table class="w-full">
						<thead>
							<tr style="border-bottom: 2px solid #F3F4F6;">
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">From</th>
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">Gift</th>
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">Total</th>
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">You Received</th>
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">Date</th>
								<th class="text-left py-3 px-2 font-semibold text-sm" style="color: #6B7280;">Status</th>
							</tr>
						</thead>
						<tbody id="giftsTableBody">
							<!-- Populated by JavaScript -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Not Setup State -->
		<div id="notSetupState" class="hidden">
			<div class="rounded-3xl p-12 shadow-sm text-center" style="background-color: white;">
				<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #FEF3C7;">
					<svg class="w-10 h-10" style="color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
					</svg>
				</div>
				<h2 class="text-2xl font-bold mb-2" style="color: #1F1638;">
					Complete Your Setup
				</h2>
				<p class="text-base mb-6" style="color: #6B7280;">
					You need to complete your payment setup before you can receive gifts
				</p>
				<a href="<?= route('user.stripe_connect.onboarding') ?>" class="inline-block px-8 py-3 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90" style="background-color: #EC4899; font-family: 'Poppins', sans-serif;">
					Complete Setup
				</a>
			</div>
		</div>
	</div>
</div>

@push('footer')
<script>
$(document).ready(function() {
	loadEarningsData();

	// Handle Stripe Dashboard button
	$('#dashboardLinkBtn').on('click', function() {
		const btn = $(this);
		btn.prop('disabled', true).text('Loading...');

		$.ajax({
			url: '<?= route("user.stripe_connect.dashboard_link") ?>',
			type: 'POST',
			data: {
				_token: '{{ csrf_token() }}'
			},
			success: function(response) {
				if (response.reaction === 1) {
					window.open(response.data.dashboard_url, '_blank');
				} else {
					showErrorMessage(response.data.message || response.message || 'Failed to open dashboard');
				}
				btn.prop('disabled', false).text('Stripe Dashboard');
			},
			error: function() {
				showErrorMessage('An error occurred');
				btn.prop('disabled', false).text('Stripe Dashboard');
			}
		});
	});

	function loadEarningsData() {
		$.ajax({
			url: '<?= route("user.stripe_connect.earnings_data") ?>',
			type: 'GET',
			success: function(response) {
				$('#loadingSection').hide();

				if (response.reaction === 1) {
					const data = response.data;

					// Check if setup is complete
					if (!data.onboarding_completed) {
						$('#notSetupState').removeClass('hidden');
						return;
					}

					// Show earnings content
					$('#earningsContent').removeClass('hidden');

					// Update stats
					$('#totalEarnings').text('$' + data.total_earnings);
					$('#totalGifts').text(data.total_gifts_received);
					$('#availableBalance').text('$' + data.stripe_balance.available.toFixed(2));
					$('#pendingBalance').text('$' + data.stripe_balance.pending.toFixed(2));

					// Populate gifts table
					if (data.recent_gifts && data.recent_gifts.length > 0) {
						$('#giftsTable').removeClass('hidden');
						populateGiftsTable(data.recent_gifts);
					} else {
						$('#emptyState').removeClass('hidden');
					}
				} else {
					$('#notSetupState').removeClass('hidden');
				}
			},
			error: function() {
				$('#loadingSection').hide();
				$('#notSetupState').removeClass('hidden');
			}
		});
	}

	function populateGiftsTable(gifts) {
		const tbody = $('#giftsTableBody');
		tbody.empty();

		gifts.forEach(function(gift) {
			const statusBadge = gift.status === 'succeeded'
				? '<span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #D1FAE5; color: #065F46;">Paid</span>'
				: '<span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #FEF3C7; color: #92400E;">Pending</span>';

			const row = `
				<tr style="border-bottom: 1px solid #F3F4F6;">
					<td class="py-4 px-2">
						<div>
							<p class="font-medium" style="color: #1F1638;">${gift.from_user ? gift.from_user.name : 'Anonymous'}</p>
							${gift.from_user ? `<p class="text-sm" style="color: #6B7280;">@${gift.from_user.username}</p>` : ''}
						</div>
					</td>
					<td class="py-4 px-2" style="color: #1F1638;">${gift.gift_name}</td>
					<td class="py-4 px-2 font-medium" style="color: #1F1638;">$${parseFloat(gift.total_amount).toFixed(2)}</td>
					<td class="py-4 px-2 font-semibold" style="color: #10B981;">$${parseFloat(gift.amount).toFixed(2)}</td>
					<td class="py-4 px-2" style="color: #6B7280;">${gift.received_at}</td>
					<td class="py-4 px-2">${statusBadge}</td>
				</tr>
			`;

			tbody.append(row);
		});
	}
});
</script>
@endpush
