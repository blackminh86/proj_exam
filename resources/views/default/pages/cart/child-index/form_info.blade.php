
@php
$shippingInfo = Session::get('shipping-info') ;
@endphp
<div class="panel-body">
	<div class="row">
		<div class="form-group">
			<label style="width:100px">Full Name :</label>
			<input type="text" name="fullname" value="{{ (isset($shippingInfo['fullname'])) ? $shippingInfo['fullname'] : null }}" size="80">
		</div>
		<div class="form-group">
			<label style="width:100px">Email :</label>
			<input type="text" name="email" value="{{ (isset($shippingInfo['email'])) ? $shippingInfo['email'] : null }}"  size="80">
		</div>
		<div class="form-group">
			<label style="width:100px">Address :</label>
			<input type="text" name="address" value="{{ (isset($shippingInfo['address'])) ? $shippingInfo['address'] : null }}"  size="80">
		</div>
		<div class="form-group">
			<label style="width:100px">Phone :</label>
			<input type="text" name="phone" value="{{ (isset($shippingInfo['phone'])) ? $shippingInfo['phone'] : null }}" size="80">
		</div>
	</div>
</div>

