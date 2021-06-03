<section class="payment_gateway_options" id="gateway_{{$payment_gateway['id']}}">
    <h4>Gopay Settings</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[goid]', 'GoID', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[goid]', $account->getGatewayConfigVal($payment_gateway['id'], 'goid'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[client_id]', 'Client ID', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[client_id]', $account->getGatewayConfigVal($payment_gateway['id'], 'client_id'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('gopay[client_secret]', 'Client Secret', array('class'=>'control-label ')) !!}
                {!! Form::text('gopay[client_secret]', $account->getGatewayConfigVal($payment_gateway['id'], 'client_secret'),[ 'class'=>'form-control'])  !!}
            </div>
        </div>
    </div>
</section>
