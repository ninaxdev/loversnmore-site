@section('page-title', __tr('Setup Gift Payments'))
@section('head-title', __tr('Setup Gift Payments'))
@section('keywordName', __tr('Setup Gift Payments'))
@section('keyword', __tr('Setup Gift Payments'))
@section('description', __tr('Setup your account to receive gift payments'))
@section('keywordDescription', __tr('Setup your account to receive gift payments'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Stripe Connect Onboarding Page -->
<div class="w-full min-h-screen md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
	<!-- Header -->
	<div class="max-w-4xl mx-auto pt-8 mb-8">
		<h1 class="text-3xl md:text-4xl font-bold mb-2" style="color: #1F1638;">
			Setup Gift Payments
		</h1>
		<p class="text-lg" style="color: #6B7280;">
			Connect your bank account to start receiving gifts from your admirers
		</p>
	</div>

	<!-- Main Content -->
	<div class="max-w-4xl mx-auto">
		<div class="rounded-3xl p-8 shadow-sm mb-6" style="background-color: white;">
			<!-- Status Check Section -->
			<div id="statusSection" class="mb-6">
				<div class="flex items-center justify-center py-8">
					<div class="lw-page-loader"></div>
				</div>
			</div>

			<!-- Not Connected State -->
			<div id="notConnectedState" class="hidden">
				<!-- Icon -->
				<div class="text-center mb-6">
					<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #FCE7F3;">
						<svg class="w-10 h-10" style="color: #EC4899;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						</svg>
					</div>
					<h2 class="text-2xl font-bold mb-2" style="color: #1F1638;">
						Start Receiving Gifts
					</h2>
					<p class="text-base" style="color: #6B7280;">
						Set up your payment account in just a few minutes
					</p>
				</div>

				<!-- Benefits List -->
				<div class="mb-8">
					<h3 class="text-lg font-semibold mb-4" style="color: #1F1638;">What you'll get:</h3>
					<div class="space-y-3">
						<div class="flex items-start">
							<svg class="w-6 h-6 mr-3 flex-shrink-0" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
							<div>
								<p class="font-medium" style="color: #1F1638;">Receive 60% of gift value</p>
								<p class="text-sm" style="color: #6B7280;">Money goes directly to your bank account</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg class="w-6 h-6 mr-3 flex-shrink-0" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
							<div>
								<p class="font-medium" style="color: #1F1638;">Fast & secure payments</p>
								<p class="text-sm" style="color: #6B7280;">Powered by Stripe - trusted by millions</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg class="w-6 h-6 mr-3 flex-shrink-0" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
							</svg>
							<div>
								<p class="font-medium" style="color: #1F1638;">Easy dashboard</p>
								<p class="text-sm" style="color: #6B7280;">Track your earnings and manage payouts</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Get Started Button -->
				<button id="startOnboardingBtn" class="w-full py-4 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-4" style="background-color: #EC4899; font-family: 'Poppins', sans-serif;">
					<span class="btn-text">Get Started</span>
					<span class="btn-loading hidden">
						<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
						Setting up...
					</span>
				</button>

				<!-- Info Note -->
				<div class="mt-6 p-4 rounded-2xl" style="background-color: #FEF3C7;">
					<div class="flex items-start">
						<svg class="w-5 h-5 mr-2 flex-shrink-0" style="color: #D97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						</svg>
						<p class="text-sm" style="color: #92400E;">
							You'll need to provide some basic information and bank details. The process is handled securely by Stripe and typically takes 5-10 minutes.
						</p>
					</div>
				</div>
			</div>

			<!-- Already Connected State -->
			<div id="connectedState" class="hidden text-center">
				<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #D1FAE5;">
					<svg class="w-10 h-10" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>
				<h2 class="text-2xl font-bold mb-2" style="color: #1F1638;">
					You're All Set!
				</h2>
				<p class="text-base mb-6" style="color: #6B7280;">
					Your account is connected and you can receive gifts
				</p>
				<a href="<?= route('user.stripe_connect.earnings') ?>" class="inline-block px-8 py-3 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90" style="background-color: #EC4899; font-family: 'Poppins', sans-serif;">
					View Earnings Dashboard
				</a>
			</div>

			<!-- Pending State -->
			<div id="pendingState" class="hidden text-center">
				<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #FEF3C7;">
					<svg class="w-10 h-10" style="color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>
				<h2 class="text-2xl font-bold mb-2" style="color: #1F1638;">
					Setup In Progress
				</h2>
				<p class="text-base mb-6" style="color: #6B7280;">
					Complete your account setup to start receiving gifts
				</p>
				<button id="continueOnboardingBtn" class="inline-block px-8 py-3 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90" style="background-color: #EC4899; font-family: 'Poppins', sans-serif;">
					Continue Setup
				</button>
			</div>
		</div>

		<!-- FAQ Section -->
		<div class="rounded-3xl p-8 shadow-sm" style="background-color: white;">
			<h3 class="text-xl font-bold mb-4" style="color: #1F1638;">Frequently Asked Questions</h3>

			<div class="space-y-4">
				<div>
					<h4 class="font-semibold mb-1" style="color: #1F1638;">How much do I earn per gift?</h4>
					<p class="text-sm" style="color: #6B7280;">You receive 60% of the gift value. For example, if someone sends you a $4.99 gift, you'll receive approximately $2.99.</p>
				</div>

				<div>
					<h4 class="font-semibold mb-1" style="color: #1F1638;">When do I get paid?</h4>
					<p class="text-sm" style="color: #6B7280;">Payments are transferred to your bank account according to your Stripe payout schedule, typically within 2-7 business days.</p>
				</div>

				<div>
					<h4 class="font-semibold mb-1" style="color: #1F1638;">Is my information secure?</h4>
					<p class="text-sm" style="color: #6B7280;">Yes! All payment processing is handled by Stripe, a PCI-compliant payment processor trusted by millions of businesses worldwide.</p>
				</div>

				<div>
					<h4 class="font-semibold mb-1" style="color: #1F1638;">What information do I need to provide?</h4>
					<p class="text-sm" style="color: #6B7280;">You'll need basic identification information and bank account details. This is required by financial regulations to prevent fraud.</p>
				</div>
			</div>
		</div>
	</div>
</div>

@push('footer')
<script>
$(document).ready(function() {
	// Check account status on page load
	checkAccountStatus();

	// Handle start onboarding button
	$('#startOnboardingBtn, #continueOnboardingBtn').on('click', function() {
		const btn = $(this);
		btn.find('.btn-text').addClass('hidden');
		btn.find('.btn-loading').removeClass('hidden');
		btn.prop('disabled', true);

		startOnboarding();
	});

	function checkAccountStatus() {
		$.ajax({
			url: '<?= route("user.stripe_connect.account_status") ?>',
			type: 'GET',
			success: function(response) {
				$('#statusSection').hide();

				if (response.reaction === 1) {
					const data = response.data;

					if (data.has_account && data.onboarding_completed) {
						// Account fully set up
						$('#connectedState').removeClass('hidden');
					} else if (data.has_account && !data.onboarding_completed) {
						// Account exists but onboarding not complete
						$('#pendingState').removeClass('hidden');
					} else {
						// No account yet
						$('#notConnectedState').removeClass('hidden');
					}
				} else {
					// No account
					$('#notConnectedState').removeClass('hidden');
				}
			},
			error: function() {
				$('#statusSection').hide();
				$('#notConnectedState').removeClass('hidden');
			}
		});
	}

	function startOnboarding() {
		$.ajax({
			url: '<?= route("user.stripe_connect.start_onboarding") ?>',
			type: 'POST',
			data: {
				_token: '{{ csrf_token() }}'
			},
			success: function(response) {
				if (response.reaction === 1) {
					// Redirect to Stripe onboarding
					window.location.href = response.data.onboarding_url;
				} else {
					showErrorMessage(response.data.message || response.message || 'Failed to start onboarding');
					resetButton();
				}
			},
			error: function(xhr) {
				showErrorMessage('An error occurred. Please try again.');
				resetButton();
			}
		});
	}

	function resetButton() {
		const btn = $('#startOnboardingBtn, #continueOnboardingBtn');
		btn.find('.btn-text').removeClass('hidden');
		btn.find('.btn-loading').addClass('hidden');
		btn.prop('disabled', false);
	}
});
</script>
@endpush
