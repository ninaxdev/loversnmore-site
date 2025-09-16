<!-- Modern Payment Gateways Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-credit-card text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Payment Gateways') }}</h1>
            </div>
        </div>
    </x-lw.card>

    @php $isExtendedLicence = (getStoreSettings('product_registration', 'licence') === 'dee257a8c3a2656b7d7fbe9a91dd8c7c41d90dc9'); @endphp
    
    <!-- Extended Licence Warning -->
    @if(!$isExtendedLicence)
        <div class="alert alert-warning my-3">
            <strong title="Extended Licence Required">{{ __tr('Extended Licence Required') }}</strong> <br>
            {{ __tr('To use the payment gateway to charge customers you need to buy an Extended licence.') }}
        </div>
    @endif

    <!-- Payment Setting Form -->
    <form class="lw-ajax-form lw-form" method="post" data-callback="onPaymentGatewayFormCallback" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        
        <!-- PayPal Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/paypal-small.png') }}" alt="{{ __tr('PayPal') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('PayPal') }}</h3>
            </div>

            <!-- Enable PayPal Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_paypal" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnablePaypal" name="enable_paypal" {{ ($configurationData['enable_paypal'] ?? false) == true ? 'checked' : '' }} value="true">
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnablePaypal">{{ __tr('Enable Paypal Checkout') }}</label>
                </div>
            </div>

            <div id="lwPaypalCheckoutContainer">
                <!-- PayPal Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUsePaypalCheckoutTest" name="use_test_paypal_checkout" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_paypal_checkout'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUsePaypalCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing paypal checkout information -->
                        <div class="btn-group mb-3" id="lwTestPaypalCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Paypal Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestPaypalCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Paypal test key exists hidden field -->
                        <input type="hidden" name="paypal_test_keys_exist" id="lwPaypalTestKeysExist" value="{{ $configurationData['paypal_checkout_testing_client_id'] ?? '' }}" />

                        <div id="lwTestPaypalInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Client Id') }}" name="paypal_checkout_testing_client_id">
                                <x-lw.input type="text" name="paypal_checkout_testing_client_id" id="lwPaypalTestClientId" placeholder="{{ __tr('Client Id') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Secret Key') }}" name="paypal_checkout_testing_secret_key">
                                <x-lw.input type="text" name="paypal_checkout_testing_secret_key" id="lwPaypalTestSecretKey" placeholder="{{ __tr('Secret Key') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- PayPal Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUsePaypalCheckoutLive" name="use_test_paypal_checkout" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_paypal_checkout'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUsePaypalCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live paypal checkout information -->
                        <div class="btn-group mb-3" id="lwLivePaypalCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Paypal Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLivePaypalCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Paypal live key exists hidden field -->
                        <input type="hidden" name="paypal_live_keys_exist" id="lwPaypalLiveKeysExist" value="{{ $configurationData['paypal_checkout_live_client_id'] ?? '' }}" />

                        <div id="lwLivePaypalInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Client Id') }}" name="paypal_checkout_live_client_id">
                                <x-lw.input type="text" name="paypal_checkout_live_client_id" id="lwPaypalLiveClientId" placeholder="{{ __tr('Client Id') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Secret Key') }}" name="paypal_checkout_live_secret_key">
                                <x-lw.input type="text" name="paypal_checkout_live_secret_key" id="lwPaypalLiveSecretKey" placeholder="{{ __tr('Secret Key') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>
        </x-lw.card>

        <!-- Stripe Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/stripe-small.png') }}" alt="{{ __tr('Stripe') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('Stripe') }}</h3>
            </div>

            <!-- Enable Stripe Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_stripe" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnableStripe" name="enable_stripe" {{ ($configurationData['enable_stripe'] ?? false) == true ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnableStripe">{{ __tr('Enable Stripe Checkout') }}</label>
                </div>
            </div>

            <!-- Stripe Webhook URL -->
            <div class="mb-4">
                <label for="lwStripeWebhookUrl" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Stripe Webhook URL') }}</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">{{ __tr('Webhook') }}</span>
                    <input type="text" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" readonly id="lwStripeWebhookUrl" value="{{ route('stripe-webhook') }}">
                    <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm px-3 py-2 rounded-r-md" type="button" onclick="copyToClipboardWebhookUrl()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                
                <div class="text-red-600 text-sm mt-2">
                    <p>{{ __tr('IMPORTANT: It is very important that you should add this Webhook to Stripe account, as all the payment information gets updated using this webhook. Go to the link given below and follow the steps') }}</p>
                </div>
                <div class="alert alert-secondary mt-2">
                    <a target="_blank" href="https://stripe.com/docs/webhooks/go-live">https://stripe.com/docs/webhooks/go-live</a>
                </div>
            </div>

            <div id="lwStripeCheckoutContainer">
                <!-- Stripe Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseStripeCheckoutTest" name="use_test_stripe" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_stripe'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseStripeCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing stripe checkout information -->
                        <div class="btn-group mb-3" id="lwTestStripeCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Stripe Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestStripeCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Stripe test secret key exists hidden field -->
                        <input type="hidden" name="stripe_test_keys_exist" id="lwStripeTestKeysExist" value="{{ $configurationData['stripe_testing_secret_key'] ?? '' }}" />

                        <div id="lwTestStripeInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Secret Key') }}" name="stripe_testing_secret_key">
                                <x-lw.input type="text" name="stripe_testing_secret_key" id="lwStripeTestSecretKey" placeholder="{{ __tr('Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Publish Key') }}" name="stripe_testing_publishable_key">
                                <x-lw.input type="text" name="stripe_testing_publishable_key" id="lwStripeTestPublishKey" placeholder="{{ __tr('Publish Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Stripe Webhook Secret') }}" name="stripe_testing_webhook_secret">
                                <x-lw.input type="text" name="stripe_testing_webhook_secret" id="lwStripeTestWebhookSecret" placeholder="{{ __tr('Stripe Webhook Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- Stripe Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseStripeCheckoutLive" name="use_test_stripe" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_stripe'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseStripeCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live stripe checkout information -->
                        <div class="btn-group mb-3" id="lwLiveStripeCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Stripe Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLiveStripeCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Stripe live secret key exists hidden field -->
                        <input type="hidden" name="stripe_live_keys_exist" id="lwStripeLiveKeysExist" value="{{ $configurationData['stripe_live_secret_key'] ?? '' }}" />

                        <div id="lwLiveStripeInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Secret Key') }}" name="stripe_live_secret_key">
                                <x-lw.input type="text" name="stripe_live_secret_key" id="lwStripeLiveSecretKey" placeholder="{{ __tr('Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Publish Key') }}" name="stripe_live_publishable_key">
                                <x-lw.input type="text" name="stripe_live_publishable_key" id="lwStripeLivePublishKey" placeholder="{{ __tr('Publish Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Stripe Webhook Secret') }}" name="stripe_live_webhook_secret">
                                <x-lw.input type="text" name="stripe_live_webhook_secret" id="lwStripeLiveWebhookSecret" placeholder="{{ __tr('Stripe Webhook Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>
        </x-lw.card>

        <!-- Razorpay Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/razorpay-small.png') }}" alt="{{ __tr('Razorpay') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('Razorpay') }}</h3>
            </div>

            <!-- Enable Razorpay Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_razorpay" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnableRazorpay" name="enable_razorpay" {{ ($configurationData['enable_razorpay'] ?? false) == true ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnableRazorpay">{{ __tr('Enable Razorpay Checkout') }}</label>
                </div>
            </div>

            <!-- Razorpay Webhook URL -->
            <div class="mb-4">
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">{{ __tr('Webhook') }}</span>
                    <input type="text" class="rounded-none bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" readonly id="lwRazorPayWebhookUrl" value="{{ route('razorpay-webhook') }}">
                    <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm px-3 py-2 rounded-r-md" type="button" onclick="copyToClipboardRazorpayWebhookUrl()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                
                <div class="text-red-600 text-sm mt-2">
                    <p>{{ __tr('IMPORTANT: It is very important that you should add this Webhook to Razorpay account, as all the payment information gets updated using this webhook. Go to the link given below and follow the steps') }}</p>
                </div>
                <div class="alert alert-secondary mt-2">
                    <a target="_blank" href="https://razorpay.com/docs/webhooks/setup-edit-payments/">https://razorpay.com/docs/webhooks/setup-edit-payments/</a>
                </div>
            </div>

            <div id="lwRazorpayCheckoutContainer">
                <!-- Razorpay Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseRazorpayCheckoutTest" name="use_test_razorpay" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_razorpay'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseRazorpayCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing razorpay checkout information -->
                        <div class="btn-group mb-3" id="lwTestRazorpayCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Razorpay Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestRazorpayCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Razorpay test secret key exists hidden field -->
                        <input type="hidden" name="razorpay_test_keys_exist" id="lwRazorpayTestKeysExist" value="{{ $configurationData['razorpay_testing_key'] ?? '' }}" />

                        <div id="lwTestRazorpayInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Razorpay Key') }}" name="razorpay_testing_key">
                                <x-lw.input type="text" name="razorpay_testing_key" id="lwRazorpayTestKey" placeholder="{{ __tr('Razorpay Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Razorpay Secret Key') }}" name="razorpay_testing_secret_key">
                                <x-lw.input type="text" name="razorpay_testing_secret_key" id="lwRazorpayTestSecretKey" placeholder="{{ __tr('Razorpay Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Webhook Signing Secret') }}" name="razorpay_testing_webhook_secret">
                                <x-lw.input type="text" name="razorpay_testing_webhook_secret" id="lwRazorPayTestWebhookSecretKey" placeholder="{{ __tr('Webhook Signing Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- Razorpay Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseRazorpayCheckoutLive" name="use_test_razorpay" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_razorpay'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseRazorpayCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live razorpay checkout information -->
                        <div class="btn-group mb-3" id="lwLiveRazorpayCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Razorpay Checkout keys are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLiveRazorpayCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Razorpay live secret key exists hidden field -->
                        <input type="hidden" name="razorpay_live_keys_exist" id="lwRazorpayLiveKeysExist" value="{{ $configurationData['razorpay_live_key'] ?? '' }}" />

                        <div id="lwLiveRazorpayInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Razorpay Key') }}" name="razorpay_live_key">
                                <x-lw.input type="text" name="razorpay_live_key" id="lwRazorpayLiveKey" placeholder="{{ __tr('Razorpay Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Razorpay Secret Key') }}" name="razorpay_live_secret_key">
                                <x-lw.input type="text" name="razorpay_live_secret_key" id="lwRazorpayLiveSecretKey" placeholder="{{ __tr('Razorpay Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Webhook Signing Secret') }}" name="razorpay_live_webhook_secret">
                                <x-lw.input type="text" name="razorpay_live_webhook_secret" id="lwRazorPayLiveWebhookSecretKey" placeholder="{{ __tr('Webhook Signing Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>
        </x-lw.card>

        <!-- Coingate Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/coingate-small.png') }}" alt="{{ __tr('Coingate') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('Coingate') }}</h3>
            </div>

            <!-- Enable Coingate Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_coingate" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnableCoingate" name="enable_coingate" {{ ($configurationData['enable_coingate'] ?? false) == true ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnableCoingate">{{ __tr('Enable Coingate Checkout') }}</label>
                </div>
            </div>

            <div id="lwCoingateCheckoutContainer">
                <!-- Coingate Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseCoingateCheckoutTest" name="use_test_coingate" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_coingate'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseCoingateCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing coingate checkout information -->
                        <div class="btn-group mb-3" id="lwTestCoingateCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Coingate Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestCoingateCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Coingate test secret key exists hidden field -->
                        <input type="hidden" name="coingate_test_token_exist" id="lwCoingateTestTokenExist" value="{{ $configurationData['coingate_test_token'] ?? '' }}" />

                        <div id="lwTestCoingateInputField">
                            <x-lw.form-field label="{{ __tr('Coingate Test Token') }}" name="coingate_test_token">
                                <x-lw.input type="text" name="coingate_test_token" id="lwCoingateTestToken" placeholder="{{ __tr('Coingate Test Token') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- Coingate Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseCoingateCheckoutLive" name="use_test_coingate" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_coingate'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseCoingateCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live coingate checkout information -->
                        <div class="btn-group mb-3" id="lwLiveCoingateCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Coingate Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLiveCoingateCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Coingate live secret key exists hidden field -->
                        <input type="hidden" name="coingate_live_token_exist" id="lwCoingateLiveKeysExist" value="{{ $configurationData['coingate_live_token'] ?? '' }}" />

                        <div id="lwLiveCoingateInputField">
                            <x-lw.form-field label="{{ __tr('Coingate Live Token') }}" name="coingate_live_token">
                                <x-lw.input type="text" name="coingate_live_token" id="lwCoingateLiveToken" placeholder="{{ __tr('Coingate Live Token') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>
        </x-lw.card>

        <!-- Crypto Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/crypto.png') }}" alt="{{ __tr('CRYPTO') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('CRYPTO') }}</h3>
            </div>

            <!-- Enable Crypto Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_crypto" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnableCrypto" name="enable_crypto" {{ ($configurationData['enable_crypto'] ?? false) == true ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnableCrypto">{{ __tr('Enable Crypto Checkout') }}</label>
                </div>
            </div>

            <!-- Crypto Webhook URL -->
            <div class="mb-4">
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">{{ __tr('Webhook') }}</span>
                    <input type="text" class="rounded-none bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" readonly id="lwCryptoWebhookUrl" value="{{ route('crypto-webhook') }}">
                    <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm px-3 py-2 rounded-r-md" type="button" onclick="copyToClipboardCryptoWebhookUrl()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                
                <div class="text-red-600 text-sm mt-2">
                    <p>{{ __tr('IMPORTANT: It is very important that you should add this Webhook to Crypto account, as all the payment information gets updated using this webhook. Go to the link given below and follow the steps') }}</p>
                </div>
                <div class="alert alert-secondary mt-2">
                    <a target="_blank" href="https://pay-docs.crypto.com/#api-reference-webhooks-troubleshooting">https://pay-docs.crypto.com/#api-reference-webhooks</a>
                </div>
            </div>

            <div id="lwCryptoCheckoutContainer">
                <!-- Crypto Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseCryptoCheckoutTest" name="use_test_crypto" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_crypto'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseCryptoCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing crypto checkout information -->
                        <div class="btn-group mb-3" id="lwTestCryptoCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Crypto Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestCryptoCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Crypto test secret key exists hidden field -->
                        <input type="hidden" name="crypto_testing_publishable_key_exist" id="lwCryptoTestKeysExist" value="{{ $configurationData['crypto_testing_publishable_key'] ?? '' }}" />

                        <div id="lwTestCryptoInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Crypto Test Token') }}" name="crypto_testing_publishable_key">
                                <x-lw.input type="text" name="crypto_testing_publishable_key" id="lwCryptoTestToken" placeholder="{{ __tr('Crypto Test Token') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Crypto Secret Key') }}" name="crypto_testing_secret_key">
                                <x-lw.input type="text" name="crypto_testing_secret_key" id="lwCryptoTestSecretKey" placeholder="{{ __tr('Crypto Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Crypto Webhook Secret') }}" name="crypto_testing_webhook_secret">
                                <x-lw.input type="text" name="crypto_testing_webhook_secret" id="lwCryptoTestWebhookSecret" placeholder="{{ __tr('Crypto Webhook Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- Crypto Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUseCryptoCheckoutLive" name="use_test_crypto" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_crypto'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUseCryptoCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live crypto checkout information -->
                        <div class="btn-group mb-3" id="lwLiveCryptoCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Crypto Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLiveCryptoCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Crypto live secret key exists hidden field -->
                        <input type="hidden" name="crypto_live_publishable_key_exist" id="lwCryptoLiveKeysExist" value="{{ $configurationData['crypto_live_publishable_key'] ?? '' }}" />

                        <div id="lwLiveCryptoInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Crypto Live Token') }}" name="crypto_live_publishable_key">
                                <x-lw.input type="text" name="crypto_live_publishable_key" id="lwCryptoLiveToken" placeholder="{{ __tr('Crypto Live Token') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Crypto Secret Key') }}" name="crypto_live_secret_key">
                                <x-lw.input type="text" name="crypto_live_secret_key" id="lwCryptoTestSecretKey" placeholder="{{ __tr('Crypto Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Crypto Webhook Secret') }}" name="crypto_live_webhook_secret">
                                <x-lw.input type="text" name="crypto_live_webhook_secret" id="lwCryptoTestWebhookSecret" placeholder="{{ __tr('Crypto Webhook Secret') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>
        </x-lw.card>

        <!-- Paystack Settings -->
        <x-lw.card class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('imgs/payment-images/paystack-small.png') }}" alt="{{ __tr('Paystack') }}" class="h-8">
                <h3 class="font-semibold text-lg text-lw-primary">{{ __tr('Paystack') }}</h3>
            </div>

            <!-- Enable Paystack Checkout -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="hidden" name="enable_paystack" value="0">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="lwEnablePaystack" name="enable_paystack" {{ ($configurationData['enable_paystack'] ?? false) == true ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwEnablePaystack">{{ __tr('Enable Paystack Checkout') }}</label>
                </div>
            </div>

            <div id="lwPaystackCheckoutContainer">
                <!-- Paystack Testing -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUsePaystackCheckoutTest" name="use_test_paystack" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="1" {{ ($configurationData['use_test_paystack'] ?? false) == true ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUsePaystackCheckoutTest">{{ __tr('Use Testing') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added testing paystack checkout information -->
                        <div class="btn-group mb-3" id="lwTestPaystackCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Testing Paystack Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateTestPaystackCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Paystack test secret key exists hidden field -->
                        <input type="hidden" name="paystack_testing_publishable_key_exist" id="lwPaystackTestKeysExist" value="{{ $configurationData['paystack_testing_publishable_key'] ?? '' }}" />

                        <div id="lwTestPaystackInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Paystack Secret Key') }}" name="paystack_testing_secret_key">
                                <x-lw.input type="text" name="paystack_testing_secret_key" id="lwPaystackTestSecretKey" placeholder="{{ __tr('Paystack Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Paystack Publish Key') }}" name="paystack_testing_publishable_key">
                                <x-lw.input type="text" name="paystack_testing_publishable_key" id="lwPaystackTestToken" placeholder="{{ __tr('Paystack Publish Key') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>

                <!-- Paystack Live -->
                <x-lw.card class="mb-4">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="radio" id="lwUsePaystackCheckoutLive" name="use_test_paystack" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" value="0" {{ ($configurationData['use_test_paystack'] ?? false) == false ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-lw-primary" for="lwUsePaystackCheckoutLive">{{ __tr('Use Live') }}</label>
                        </div>
                    </div>

                    @if($isExtendedLicence)
                        <!-- Show after added Live paystack checkout information -->
                        <div class="btn-group mb-3" id="lwLivePaystackCheckoutExists">
                            <button type="button" disabled="true" class="btn btn-success lw-btn">{{ __tr('Live Paystack Checkout Token are installed.') }}</button>
                            <button type="button" class="btn btn-light lw-btn" id="lwUpdateLivePaystackCheckout">{{ __tr('Update') }}</button>
                        </div>

                        <!-- Paystack live secret key exists hidden field -->
                        <input type="hidden" name="paystack_live_publishable_key_exist" id="lwPaystackLiveKeysExist" value="{{ $configurationData['paystack_live_publishable_key'] ?? '' }}" />

                        <div id="lwLivePaystackInputField" class="space-y-4">
                            <x-lw.form-field label="{{ __tr('Paystack Secret Key') }}" name="paystack_live_secret_key">
                                <x-lw.input type="text" name="paystack_live_secret_key" id="lwPaystackTestSecretKey" placeholder="{{ __tr('Paystack Secret Key') }}" />
                            </x-lw.form-field>

                            <x-lw.form-field label="{{ __tr('Paystack Publish Key') }}" name="paystack_live_publishable_key">
                                <x-lw.input type="text" name="paystack_live_publishable_key" id="lwPaystackLiveToken" placeholder="{{ __tr('Paystack Publish Key') }}" />
                            </x-lw.form-field>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{ __tr('Extended licence required.') }}
                        </div>
                    @endif
                </x-lw.card>
            </div>

            <!-- Paystack URLs -->
            <div class="space-y-4">
                <!-- Callback URL -->
                <div>
                    <label for="lwPaystackCallbackUrl" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Paystack Callback URL') }}</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">{{ __tr('Callback') }}</span>
                        <input type="text" class="rounded-none bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" readonly id="lwPaystackCallbackUrl" value="{{ route('user.credit_wallet.read.view') }}">
                        <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm px-3 py-2 rounded-r-md" type="button" onclick="copyToClipboardPaystackCallbackUrl()">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <!-- Webhook URL -->
                <div>
                    <label for="lwPaystackWebhookUrl" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Paystack Webhook URL') }}</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">{{ __tr('Webhook') }}</span>
                        <input type="text" class="rounded-none bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" readonly id="lwPaystackWebhookUrl" value="{{ route('paystack-webhook') }}">
                        <button class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm px-3 py-2 rounded-r-md" type="button" onclick="copyToClipboardPaystackWebhookUrl()">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-red-600 text-sm mt-2">
                <p>{{ __tr('IMPORTANT: It is very important that you should add this Webhook to paystack account, as all the payment information gets updated using this webhook. Go to the link given below and follow the steps') }}</p>
            </div>

            <div class="alert alert-secondary mt-2">
                <a target="_blank" href="https://dashboard.paystack.com/">https://dashboard.paystack.com</a>
            </div>
        </x-lw.card>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <x-lw.button type="button" variant="primary" size="lg" class="lw-ajax-form-submit-action px-12">
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update') }}
            </x-lw.button>
        </div>
    </form>
</div>

@lwPush('appScripts')
<script>
    "use strict";
    /*********** Paypal Enable / Disable Checkout start here ***********/
    var isPaypalCheckoutEnable = $('#lwEnablePaypal').is(':checked'),
        isUsePaypalCheckoutTest = $("#lwUsePaypalCheckoutTest").is(':checked'),
        lwUsePaypalCheckoutLive = $("#lwUsePaypalCheckoutLive").is(':checked');
    //paypal checkout is enable then add disable content class
    if (!isPaypalCheckoutEnable) {
        $('#lwPaypalCheckoutContainer').addClass('lw-disabled-block-content');
    }
    //paypal checkout is enable/disabled on change 
    //then add/remove disable content class
    $("#lwEnablePaypal").on('change', function(event) {
        isPaypalCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isPaypalCheckoutEnable) {
            $("#lwPaypalCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwPaypalCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check paypal test mode is true then disable paypal live input field	
    if (isUsePaypalCheckoutTest) {
        $('#lwUpdateLivePaypalCheckout').attr('disabled', true);
        $('#lwLivePaypalInputField').addClass('lw-disabled-block-content');
        //check paypal test mode is false then disable paypal test input field	
    } else if (lwUsePaypalCheckoutLive) {
        $('#lwUpdateTestPaypalCheckout').attr('disabled', true);
        $('#lwTestPaypalInputField').addClass('lw-disabled-block-content');
    }

    //check paypal test mode is true on change 
    //then disable paypal live input field	
    $("#lwUsePaypalCheckoutTest").on('change', function(event) {
        var isUsePaypalCheckoutTest = $(this).is(':checked');
        if (isUsePaypalCheckoutTest) {
            $('#lwUpdateLivePaypalCheckout').attr('disabled', true);
            $('#lwUpdateTestPaypalCheckout').attr('disabled', false);
            $('#lwTestPaypalInputField').removeClass('lw-disabled-block-content');
            $('#lwLivePaypalInputField').addClass('lw-disabled-block-content');
        }
    });

    //check paypal test mode is false on change 
    //then disable paypal test input field	
    $("#lwUsePaypalCheckoutLive").on('change', function(event) {
        var lwUsePaypalCheckoutLive = $(this).is(':checked');
        if (lwUsePaypalCheckoutLive) {
            $('#lwUpdateTestPaypalCheckout').attr('disabled', true);
            $('#lwUpdateLivePaypalCheckout').attr('disabled', false);
            $('#lwLivePaypalInputField').removeClass('lw-disabled-block-content');
            $('#lwTestPaypalInputField').addClass('lw-disabled-block-content');
        }
    });
    /*********** Paypal Enable / Disable Checkout end here ***********/

    /*********** Paypal Testing Keys setting start here ***********/
    var isTestPaypalKeysInstalled = "{{ $configurationData['paypal_checkout_testing_client_id'] ?? '' }}",
        lwTestPaypalInputField = $('#lwTestPaypalInputField'),
        lwTestPaypalCheckoutExists = $('#lwTestPaypalCheckoutExists');

    // Check if test paypal keys are installed
    if (isTestPaypalKeysInstalled) {
        lwTestPaypalInputField.hide();
    } else {
        lwTestPaypalCheckoutExists.hide();
    }
    // Update paypal checkout testing keys
    $('#lwUpdateTestPaypalCheckout').click(function() {
        $("#lwPaypalTestKeysExist").val(0);
        lwTestPaypalInputField.show();
        lwTestPaypalCheckoutExists.hide();
    });
    /*********** Paypal Testing Keys setting end here ***********/

    /*********** Paypal Live Keys setting start here ***********/
    var isLivePaypalKeysInstalled = "{{ $configurationData['paypal_checkout_live_client_id'] ?? '' }}",
        lwLivePaypalInputField = $('#lwLivePaypalInputField'),
        lwLivePaypalCheckoutExists = $('#lwLivePaypalCheckoutExists');

    // Check if test paypal keys are installed
    if (isLivePaypalKeysInstalled) {
        lwLivePaypalInputField.hide();
    } else {
        lwLivePaypalCheckoutExists.hide();
    }
    // Update paypal checkout testing keys
    $('#lwUpdateLivePaypalCheckout').click(function() {
        $("#lwPaypalLiveKeysExist").val(0);
        lwLivePaypalInputField.show();
        lwLivePaypalCheckoutExists.hide();
    });
    /*********** Paypal Live Keys setting end here ***********/

    /*********** Stripe Enable / Disable Checkout start here ***********/
    var isStripeCheckoutEnable = $('#lwEnableStripe').is(':checked'),
        isUseStripeCheckoutTest = $("#lwUseStripeCheckoutTest").is(':checked'),
        isUseStripeCheckoutLive = $("#lwUseStripeCheckoutLive").is(':checked');

    if (!isStripeCheckoutEnable) {
        $('#lwStripeCheckoutContainer').addClass('lw-disabled-block-content');
    }
    $("#lwEnableStripe").on('change', function(event) {
        isStripeCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isStripeCheckoutEnable) {
            $("#lwStripeCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwStripeCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is true then disable stripe live input field	
    if (isUseStripeCheckoutTest) {
        $('#lwUpdateLiveStripeCheckout').attr('disabled', true);
        $('#lwLiveStripeInputField').addClass('lw-disabled-block-content');
        //check stripe test mode is false then disable stripe test input field	
    } else if (isUseStripeCheckoutLive) {
        $('#lwUpdateTestStripeCheckout').attr('disabled', true);
        $('#lwTestStripeInputField').addClass('lw-disabled-block-content');
    }

    //check stripe test mode is true on change 
    //then disable stripe live input field	
    $("#lwUseStripeCheckoutTest").on('change', function(event) {
        var isUseStripeCheckoutTest = $(this).is(':checked');
        if (isUseStripeCheckoutTest) {
            $('#lwUpdateLiveStripeCheckout').attr('disabled', true);
            $('#lwUpdateTestStripeCheckout').attr('disabled', false);
            $('#lwTestStripeInputField').removeClass('lw-disabled-block-content');
            $('#lwLiveStripeInputField').addClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is false on change 
    //then disable stripe test input field	
    $("#lwUseStripeCheckoutLive").on('change', function(event) {
        var isUseStripeCheckoutLive = $(this).is(':checked');
        if (isUseStripeCheckoutLive) {
            $('#lwUpdateTestStripeCheckout').attr('disabled', true);
            $('#lwUpdateLiveStripeCheckout').attr('disabled', false);
            $('#lwLiveStripeInputField').removeClass('lw-disabled-block-content');
            $('#lwTestStripeInputField').addClass('lw-disabled-block-content');
        }
    });
    /*********** Stripe Enable / Disable Checkout end here ***********/

    /*********** Stripe Testing Keys setting start here ***********/
    var isTestStripeKeysInstalled = "{{ $configurationData['stripe_testing_publishable_key'] ?? '' }}",
        lwTestStripeInputField = $('#lwTestStripeInputField'),
        lwTestStripeCheckoutExists = $('#lwTestStripeCheckoutExists');

    // Check if test stripe keys are installed
    if (isTestStripeKeysInstalled) {
        lwTestStripeInputField.hide();
    } else {
        lwTestStripeCheckoutExists.hide();
    }
    // Update stripe checkout testing keys
    $('#lwUpdateTestStripeCheckout').click(function() {
        $("#lwStripeTestKeysExist").val(0);
        lwTestStripeInputField.show();
        lwTestStripeCheckoutExists.hide();
    });
    /*********** Stripe Testing Keys setting end here ***********/

    /*********** Stripe Live Keys setting start here ***********/
    var isLiveStripePublishKeysInstalled = "{{ $configurationData['stripe_live_publishable_key'] ?? '' }}",
        lwLiveStripeInputField = $('#lwLiveStripeInputField'),
        lwLiveStripeCheckoutExists = $('#lwLiveStripeCheckoutExists');

    // Check if test Stripe keys are installed
    if (isLiveStripePublishKeysInstalled) {
        lwLiveStripeInputField.hide();
    } else {
        lwLiveStripeCheckoutExists.hide();
    }
    // Update Stripe checkout testing keys
    $('#lwUpdateLiveStripeCheckout').click(function() {
        $("#lwStripeLiveKeysExist").val(0);
        lwLiveStripeInputField.show();
        lwLiveStripeCheckoutExists.hide();
    });
    /*********** Stripe Live Keys setting end here ***********/

    /*********** Coingate Enable / Disable Checkout start here ***********/
    var isCoingateCheckoutEnable = $('#lwEnableCoingate').is(':checked'),
        isUseCoingateCheckoutTest = $("#lwUseCoingateCheckoutTest").is(':checked'),
        isUseCoingateCheckoutLive = $("#lwUseCoingateCheckoutLive").is(':checked');

    if (!isCoingateCheckoutEnable) {
        $('#lwCoingateCheckoutContainer').addClass('lw-disabled-block-content');
    }
    $("#lwEnableCoingate").on('change', function(event) {
        isCoingateCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isCoingateCheckoutEnable) {
            $("#lwCoingateCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwCoingateCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is true then disable stripe live input field	
    if (isUseCoingateCheckoutTest) {
        $('#lwUpdateLiveCoingateCheckout').attr('disabled', true);
        $('#lwLiveCoingateInputField').addClass('lw-disabled-block-content');
        //check Coingate test mode is false then disable Coingate test input field	
    } else if (isUseCoingateCheckoutLive) {
        $('#lwUpdateTestCoingateCheckout').attr('disabled', true);
        $('#lwTestCoingateInputField').addClass('lw-disabled-block-content');
    }

    //check Coingate test mode is true on change 
    //then disable Coingate live input field	
    $("#lwUseCoingateCheckoutTest").on('change', function(event) {
        var isUseCoingateCheckoutTest = $(this).is(':checked');
        if (isUseCoingateCheckoutTest) {
            $('#lwUpdateLiveCoingateCheckout').attr('disabled', true);
            $('#lwUpdateTestCoingateCheckout').attr('disabled', false);
            $('#lwTestCoingateInputField').removeClass('lw-disabled-block-content');
            $('#lwLiveCoingateInputField').addClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is false on change 
    //then disable stripe test input field	
    $("#lwUseCoingateCheckoutLive").on('change', function(event) {
        var isUseCoingateCheckoutLive = $(this).is(':checked');
        if (isUseCoingateCheckoutLive) {
            $('#lwUpdateTestCoingateCheckout').attr('disabled', true);
            $('#lwUpdateLiveCoingateCheckout').attr('disabled', false);
            $('#lwLiveCoingateInputField').removeClass('lw-disabled-block-content');
            $('#lwTestCoingateInputField').addClass('lw-disabled-block-content');
        }
    });

    /*********** Coingate Testing Keys setting start here ***********/
    var isTestCoingateKeysInstalled = "{{ $configurationData['coingate_test_token'] ?? '' }}",
        lwTestCoingateInputField = $('#lwTestCoingateInputField'),
        lwTestCoingateCheckoutExists = $('#lwTestCoingateCheckoutExists');

    // Check if test stripe keys are installed
    if (isTestCoingateKeysInstalled) {
        lwTestCoingateInputField.hide();
    } else {
        lwTestCoingateCheckoutExists.hide();
    }
    // Update Coingate checkout testing keys
    $('#lwUpdateTestCoingateCheckout').click(function() {
        $("#lwCoingateTestKeysExist").val(0);
        lwTestCoingateInputField.show();
        lwTestCoingateCheckoutExists.hide();
    });
    /*********** Coingate Testing Keys setting end here ***********/

    /*********** Coingate Live Keys setting start here ***********/
    var isLiveCoingateSecretKeysInstalled = "{{ $configurationData['coingate_live_token'] ?? '' }}",
        lwLiveCoingateInputField = $('#lwLiveCoingateInputField'),
        lwLiveCoingateCheckoutExists = $('#lwLiveCoingateCheckoutExists');

    // Check if test Stripe keys are installed
    if (isLiveCoingateSecretKeysInstalled) {
        lwLiveCoingateInputField.hide();
    } else {
        lwLiveCoingateCheckoutExists.hide();
    }
    // Update Coingate checkout testing keys
    $('#lwUpdateLiveCoingateCheckout').click(function() {
        $("#lwCoingateLiveKeysExist").val(0);
        lwLiveCoingateInputField.show();
        lwLiveCoingateCheckoutExists.hide();
    });
    /*********** Coingate Live Keys setting end here ***********/

    /*********** Coingate Enable / Disable Checkout end here ***********/

    /*********** crypto Enable / Disable Checkout start here ***********/
    var isCryptoCheckoutEnable = $('#lwEnableCrypto').is(':checked'),
        isUseCryptoCheckoutTest = $("#lwUseCryptoCheckoutTest").is(':checked'),
        isUseCryptoCheckoutLive = $("#lwUseCryptoCheckoutLive").is(':checked');

    if (!isCryptoCheckoutEnable) {
        $('#lwCryptoCheckoutContainer').addClass('lw-disabled-block-content');
    }
    $("#lwEnableCrypto").on('change', function(event) {
        isCryptoCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isCryptoCheckoutEnable) {
            $("#lwCryptoCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwCryptoCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check Crypto test mode is true then disable Crypto live input field	
    if (isUseCryptoCheckoutTest) {
        $('#lwUpdateLiveCryptoCheckout').attr('disabled', true);
        $('#lwLiveCryptoInputField').addClass('lw-disabled-block-content');
        //check Crypto test mode is false then disable Crypto test input field	
    } else if (isUseCryptoCheckoutLive) {
        $('#lwUpdateTestCryptoCheckout').attr('disabled', true);
        $('#lwTestCryptoInputField').addClass('lw-disabled-block-content');
    }

    //check Crypto test mode is true on change 
    //then disable Crypto live input field	
    $("#lwUseCryptoCheckoutTest").on('change', function(event) {
        var isUseCryptoCheckoutTest = $(this).is(':checked');
        if (isUseCryptoCheckoutTest) {
            $('#lwUpdateLiveCryptoCheckout').attr('disabled', true);
            $('#lwUpdateTestCryptoCheckout').attr('disabled', false);
            $('#lwTestCryptoInputField').removeClass('lw-disabled-block-content');
            $('#lwLiveCryptoInputField').addClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is false on change 
    //then disable Crypto test input field	
    $("#lwUseCryptoCheckoutLive").on('change', function(event) {
        var isUseCryptoCheckoutLive = $(this).is(':checked');
        if (isUseCryptoCheckoutLive) {
            $('#lwUpdateTestCryptoCheckout').attr('disabled', true);
            $('#lwUpdateLiveCryptoCheckout').attr('disabled', false);
            $('#lwLiveCryptoInputField').removeClass('lw-disabled-block-content');
            $('#lwTestCryptoInputField').addClass('lw-disabled-block-content');
        }
    });

    /*********** Crypto Testing Keys setting start here ***********/
    var isTestCryptoKeysInstalled = "{{ $configurationData['crypto_testing_publishable_key'] ?? '' }}",
        lwTestCryptoInputField = $('#lwTestCryptoInputField'),
        lwTestCryptoCheckoutExists = $('#lwTestCryptoCheckoutExists');

    // Check if test Crypto keys are installed
    if (isTestCryptoKeysInstalled) {
        lwTestCryptoInputField.hide();
    } else {
        lwTestCryptoCheckoutExists.hide();
    }
    // Update Crypto checkout testing keys
    $('#lwUpdateTestCryptoCheckout').click(function() {
        $("#lwCryptoTestKeysExist").val(0);
        lwTestCryptoInputField.show();
        lwTestCryptoCheckoutExists.hide();
    });
    /*********** Crypto Testing Keys setting end here ***********/

    /*********** Crypto Live Keys setting start here ***********/
    var isLiveCryptoSecretKeysInstalled = "{{ $configurationData['crypto_live_publishable_key'] ?? '' }}",
        lwLiveCryptoInputField = $('#lwLiveCryptoInputField'),
        lwLiveCryptoCheckoutExists = $('#lwLiveCryptoCheckoutExists');

    // Check if test Crypto keys are installed
    if (isLiveCryptoSecretKeysInstalled) {
        lwLiveCryptoInputField.hide();
    } else {
        lwLiveCryptoCheckoutExists.hide();
    }
    // Update Crypto checkout testing keys
    $('#lwUpdateLiveCryptoCheckout').click(function() {
        $("#lwCryptoLiveKeysExist").val(0);
        lwLiveCryptoInputField.show();
        lwLiveCryptoCheckoutExists.hide();
    });
    /*********** Crypto Live Keys setting end here ***********/

    /*********** Crypto Enable / Disable Checkout end here ***********/


    /*********** Paystack Enable / Disable Checkout start here ***********/
    var isPaystackCheckoutEnable = $('#lwEnablePaystack').is(':checked'),
        isUsePaystackCheckoutTest = $("#lwUsePaystackCheckoutTest").is(':checked'),
        isUsePaystackCheckoutLive = $("#lwUsePaystackCheckoutLive").is(':checked');

    if (!isPaystackCheckoutEnable) {
        $('#lwPaystackCheckoutContainer').addClass('lw-disabled-block-content');
    }
    $("#lwEnablePaystack").on('change', function(event) {
        isPaystackCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isPaystackCheckoutEnable) {
            $("#lwPaystackCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwPaystackCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check Paystack test mode is true then disable Paystack live input field	
    if (isUsePaystackCheckoutTest) {
        $('#lwUpdateLivePaystackCheckout').attr('disabled', true);
        $('#lwLivePaystackInputField').addClass('lw-disabled-block-content');
        //check Paystack test mode is false then disable Paystack test input field	
    } else if (isUsePaystackCheckoutLive) {
        $('#lwUpdateTestPaystackCheckout').attr('disabled', true);
        $('#lwTestPaystackInputField').addClass('lw-disabled-block-content');
    }

    //check Paystack test mode is true on change 
    //then disable Paystack live input field	
    $("#lwUsePaystackCheckoutTest").on('change', function(event) {
        var isUsePaystackCheckoutTest = $(this).is(':checked');
        if (isUsePaystackCheckoutTest) {
            $('#lwUpdateLivePaystackCheckout').attr('disabled', true);
            $('#lwUpdateTestPaystackCheckout').attr('disabled', false);
            $('#lwTestPaystackInputField').removeClass('lw-disabled-block-content');
            $('#lwLivePaystackInputField').addClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is false on change 
    //then disable Paystack test input field	
    $("#lwUsePaystackCheckoutLive").on('change', function(event) {
        var isUsePaystackCheckoutLive = $(this).is(':checked');
        if (isUsePaystackCheckoutLive) {
            $('#lwUpdateTestPaystackCheckout').attr('disabled', true);
            $('#lwUpdateLivePaystackCheckout').attr('disabled', false);
            $('#lwLivePaystackInputField').removeClass('lw-disabled-block-content');
            $('#lwTestPaystackInputField').addClass('lw-disabled-block-content');
        }
    });

    /*********** Paystack Testing Keys setting start here ***********/
    var isTestPaystackKeysInstalled = "{{ $configurationData['paystack_testing_publishable_key'] ?? '' }}",
        lwTestPaystackInputField = $('#lwTestPaystackInputField'),
        lwTestPaystackCheckoutExists = $('#lwTestPaystackCheckoutExists');

    // Check if test Paystack keys are installed
    if (isTestPaystackKeysInstalled) {
        lwTestPaystackInputField.hide();
    } else {
        lwTestPaystackCheckoutExists.hide();
    }
    // Update Paystack checkout testing keys
    $('#lwUpdateTestPaystackCheckout').click(function() {
        $("#lwPaystackTestKeysExist").val(0);
        lwTestPaystackInputField.show();
        lwTestPaystackCheckoutExists.hide();
    });
    /*********** Paystack Testing Keys setting end here ***********/

    /*********** Paystack Live Keys setting start here ***********/
    var isLivePaystackSecretKeysInstalled = "{{ $configurationData['paystack_live_publishable_key'] ?? '' }}",
        lwLivePaystackInputField = $('#lwLivePaystackInputField'),
        lwLivePaystackCheckoutExists = $('#lwLivePaystackCheckoutExists');

    // Check if test Paystack keys are installed
    if (isLivePaystackSecretKeysInstalled) {
        lwLivePaystackInputField.hide();
    } else {
        lwLivePaystackCheckoutExists.hide();
    }
    // Update Paystack checkout testing keys
    $('#lwUpdateLivePaystackCheckout').click(function() {
        $("#lwPaystackLiveKeysExist").val(0);
        lwLivePaystackInputField.show();
        lwLivePaystackCheckoutExists.hide();
    });
    /*********** Paystack Live Keys setting end here ***********/

    /*********** Paystack Enable / Disable Checkout end here ***********/

    //on payment setting success callback function
    function onPaymentGatewayFormCallback(responseData) {
        //check reaction code is 1 then reload view
        if (responseData.reaction == 1) {
            showConfirmation("{{ __tr('Settings Updated Successfully') }}", function() {
                __Utils.viewReload();
            }, {
                confirmButtonText: "{{ __tr('Reload Page') }}",
                type: "success"
            });
        }
    };



    /*********** Razorpay Enable / Disable Checkout start here ***********/
    var isRazorpayCheckoutEnable = $('#lwEnableRazorpay').is(':checked'),
        isUseRazorpayCheckoutTest = $("#lwUseRazorpayCheckoutTest").is(':checked'),
        isUseRazorpayCheckoutLive = $("#lwUseRazorpayCheckoutLive").is(':checked');

    if (!isRazorpayCheckoutEnable) {
        $('#lwRazorpayCheckoutContainer').addClass('lw-disabled-block-content');
    }
    $("#lwEnableRazorpay").on('change', function(event) {
        isRazorpayCheckoutEnable = $(this).is(":checked");
        //check is enable false then add class
        if (!isRazorpayCheckoutEnable) {
            $("#lwRazorpayCheckoutContainer").addClass('lw-disabled-block-content');
            //else remove class
        } else {
            $("#lwRazorpayCheckoutContainer").removeClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is true then disable stripe live input field	
    if (isUseRazorpayCheckoutTest) {
        $('#lwUpdateLiveRazorpayCheckout').attr('disabled', true);
        $('#lwLiveRazorpayInputField').addClass('lw-disabled-block-content');
        //check razorpay test mode is false then disable razorpay test input field	
    } else if (isUseRazorpayCheckoutLive) {
        $('#lwUpdateTestRazorpayCheckout').attr('disabled', true);
        $('#lwTestRazorpayInputField').addClass('lw-disabled-block-content');
    }

    //check razorpay test mode is true on change
    //then disable razorpay live input field
    $("#lwUseRazorpayCheckoutTest").on('change', function(event) {
        var isUseRazorpayCheckoutTest = $(this).is(':checked');
        if (isUseRazorpayCheckoutTest) {
            $('#lwUpdateLiveRazorpayCheckout').attr('disabled', true);
            $('#lwUpdateTestRazorpayCheckout').attr('disabled', false);
            $('#lwTestRazorpayInputField').removeClass('lw-disabled-block-content');
            $('#lwLiveRazorpayInputField').addClass('lw-disabled-block-content');
        }
    });

    //check stripe test mode is false on change
    //then disable stripe test input field
    $("#lwUseRazorpayCheckoutLive").on('change', function(event) {
        var isUseRazorpayCheckoutLive = $(this).is(':checked');
        if (isUseRazorpayCheckoutLive) {
            $('#lwUpdateTestRazorpayCheckout').attr('disabled', true);
            $('#lwUpdateLiveRazorpayCheckout').attr('disabled', false);
            $('#lwLiveRazorpayInputField').removeClass('lw-disabled-block-content');
            $('#lwTestRazorpayInputField').addClass('lw-disabled-block-content');
        }
    });

    /*********** Razorpay Testing Keys setting start here ***********/
    var isTestRazorpayKeysInstalled = "{{ $configurationData['razorpay_testing_secret_key'] ?? '' }}",
        lwTestRazorpayInputField = $('#lwTestRazorpayInputField'),
        lwTestRazorpayCheckoutExists = $('#lwTestRazorpayCheckoutExists');

    // Check if test stripe keys are installed
    if (isTestRazorpayKeysInstalled) {
        lwTestRazorpayInputField.hide();
    } else {
        lwTestRazorpayCheckoutExists.hide();
    }
    // Update razorpay checkout testing keys
    $('#lwUpdateTestRazorpayCheckout').click(function() {
        $("#lwRazorpayTestKeysExist").val(0);
        lwTestRazorpayInputField.show();
        lwTestRazorpayCheckoutExists.hide();
    });
    /*********** Razorpay Testing Keys setting end here ***********/

    /*********** Razorpay Live Keys setting start here ***********/
    var isLiveRazorpaySecretKeysInstalled = "{{ $configurationData['razorpay_live_secret_key'] ?? '' }}",
        lwLiveRazorpayInputField = $('#lwLiveRazorpayInputField'),
        lwLiveRazorpayCheckoutExists = $('#lwLiveRazorpayCheckoutExists');

    // Check if test Stripe keys are installed
    if (isLiveRazorpaySecretKeysInstalled) {
        lwLiveRazorpayInputField.hide();
    } else {
        lwLiveRazorpayCheckoutExists.hide();
    }
    // Update Razorpay checkout testing keys
    $('#lwUpdateLiveRazorpayCheckout').click(function() {
        $("#lwRazorpayLiveKeysExist").val(0);
        lwLiveRazorpayInputField.show();
        lwLiveRazorpayCheckoutExists.hide();
    });
    /*********** Razorpay Live Keys setting end here ***********/

    /*********** Razorpay Enable / Disable Checkout end here ***********/

    //copy webhook url lwStripeWebhookUrl
    function copyToClipboardWebhookUrl() {
         /* Get the text field */
         var copyTextElement = document.getElementById("lwStripeWebhookUrl");
        /* Select the text field */
        copyTextElement.select();
        copyTextElement.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        window.navigator.clipboard.writeText(copyTextElement.value);
    }
//copy webhook url lwRazorPayWebhookUrl
    function copyToClipboardRazorpayWebhookUrl() {
        /* Get the text field */
        var copyTextElement = document.getElementById("lwRazorPayWebhookUrl");
        /* Select the text field */
        copyTextElement.select();
        copyTextElement.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        window.navigator.clipboard.writeText(copyTextElement.value);
    }
    //copy webhook url lwCryptoWebhookUrl
    function copyToClipboardCryptoWebhookUrl() {
        /* Get the text field */
        var copyTextElement = document.getElementById("lwCryptoWebhookUrl");
        /* Select the text field */
        copyTextElement.select();
        copyTextElement.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        window.navigator.clipboard.writeText(copyTextElement.value);
    }
    //copy webhook url lwPaystackWebhookUrl
    function copyToClipboardPaystackWebhookUrl() {
        /* Get the text field */
        var copyTextElement = document.getElementById("lwPaystackWebhookUrl");
        /* Select the text field */
        copyTextElement.select();
        copyTextElement.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        window.navigator.clipboard.writeText(copyTextElement.value);
    }
    //copy webhook url lwPaystackWebhookUrl
    function copyToClipboardPaystackCallbackUrl() {
        /* Get the text field */
        var copyTextElement = document.getElementById("lwPaystackCallbackUrl");
        /* Select the text field */
        copyTextElement.select();
        copyTextElement.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        window.navigator.clipboard.writeText(copyTextElement.value);
    }
</script>
@lwPushEnd