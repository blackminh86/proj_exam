@php
$shippingInfo = Session::get('shipping-info') ;
@endphp

<div style="background-color:#ffffff;color:#000000">
    <div style="margin:0px auto;width:600px">
        <div style="padding:30px 20px">
            <table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#ffffff;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đặt hàng,</h1>

                            <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"> Đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Chúng tôi sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>

                            <h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày {{date('d')}} Tháng {{date('m')}} Năm {{date('Y')}} {{date('h:m:s')}})</span></h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"> Địa chỉ giao hàng </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">{{$shippingInfo['fullname']}}</span><br>
                                            <a href="mailto:{{$shippingInfo['email']}}" target="_blank">{{$shippingInfo['email']}} </a><br>
                                                Add:   {{$shippingInfo['address']}}<br>
                                                Phone: {{{$shippingInfo['phone']}}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>

                            <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                                <thead>
                                    <tr>
                                        <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                        <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Phân loại</th>
                                        <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
                                        <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                        <th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                    </tr>
                                </thead>

                                @include('email.detail_order')

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;
                            <p>Một lần nữa xin cảm ơn quý khách.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>