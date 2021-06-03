<form class="online_payment ajax" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post" id="stripe-payment-form">
    <div class="form-row">
        <label for="card-element">
            @lang("Public_ViewEvent.stripe_credit_or_debit_card")
        </label>
        <div id="card-element">

        </div>

        <div id="card-errors" role="alert"></div>
    </div>
    {!! Form::token() !!}

    <input class="btn btn-lg btn-success card-submit" style="width:100%;" type="submit" value="@lang("Public_ViewEvent.complete_payment")">
</form>
