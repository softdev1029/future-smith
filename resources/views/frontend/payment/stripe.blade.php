@push('scripts')
    <script type="text/javascript">
        var STRIPE_KEY = '{{ env('STRIPE_KEY') }}';
    </script>
    <!-- Javascript Library -->
    <script src="https://js.stripe.com/v3/" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/payment/stripe.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/payment/stripe.css') }}" rel="stylesheet">
@endpush

<!-- Modal -->
<div class="modal fade" id="model_join_stripe_plan" tabindex="-1" role="dialog" aria-labelledby="model_stripe_plan_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model_stripe_plan_title">Create new subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="payment-form" action="{{ route('user.memberships') }}">
                    @csrf
                    <input type="hidden" name="_action" />
                    <input type="hidden" name="plan_id" />

                    <div class="form-row">
                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element" class="mb-3">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <button class="btn btn-primary float-right">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>