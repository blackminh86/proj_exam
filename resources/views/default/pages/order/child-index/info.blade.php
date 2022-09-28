@php
$shippingInfo = Session::get('shipping-info') ;
@endphp
		<div class="checkout-box ">
		    <div class="row">
		        <div class="col-md-8">
		            <div class="panel-group checkout-steps" id="accordion">
		                <!-- checkout-step-01  -->
		                <div class="panel panel-default checkout-step-01">

		                    <!-- panel-heading -->
		                    <div class="panel-heading">
		                        <h4 class="unicase-checkout-title">
		                            <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
		                                Info Shipping
		                            </a>
		                        </h4>
		                    </div>
		                    <!-- panel-heading -->

		                    <div id="collapseOne" class="panel-collapse collapse in">

		                        <!-- panel-body  -->
		                        <div class="panel-body">
		                            <div class="row">
		                                <div class="form-group">
		                                    <label style="width:100px">Full Name :</label>
		                                    <input type="text" name="fullname" value="{{ (isset($shippingInfo['fullname'])) ? $shippingInfo['fullname'] : null }}" readonly="readonly" size="80">
		                                </div>
		                                <div class="form-group">
		                                    <label style="width:100px">Email :</label>
		                                    <input type="text" name="email" value="{{ (isset($shippingInfo['email'])) ? $shippingInfo['email'] : null }}" readonly="readonly" size="80">
		                                </div>
		                                <div class="form-group">
		                                    <label style="width:100px">Address :</label>
		                                    <input type="text" name="address" value="{{ (isset($shippingInfo['address'])) ? $shippingInfo['address'] : null }}" readonly="readonly" size="80">
		                                </div>
                                        <div class="form-group">
		                                    <label style="width:100px">Phone :</label>
		                                    <input type="number" name="phone" value="{{ (isset($shippingInfo['phone'])) ? $shippingInfo['phone'] : null }}" readonly="readonly" size="80">
		                                </div>
		                            </div>
		                        </div>
		                        <!-- panel-body  -->

		                    </div><!-- row -->
		                </div>
		            </div><!-- /.checkout-steps -->
		        </div>
		    </div>
		</div>