<section class="payment_gateway_options" id="gateway_{{$payment_gateway['id']}}">
    <h4>Gopay Settings</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[goId]', 'GoID', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[goId]', $account->getGatewayConfigVal($payment_gateway['id'], 'goId'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[clientId]', 'Client ID', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[clientId]', $account->getGatewayConfigVal($payment_gateway['id'], 'clientId'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[clientSecret]', 'Client Secret', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[clientSecret]', $account->getGatewayConfigVal($payment_gateway['id'], 'clientSecret'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>
    </div>
</section>
