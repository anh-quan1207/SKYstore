<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/vnpay_php/assets/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('/vnpay_php/assets/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('/vnpay_php/assets/jquery-1.11.3.min.js') }}"></script>
</head>

<body>

    <div class="container">
        <div class="header clearfix">
            <h3>Thanh Toán Trực Tuyến</h3>
        </div>
        <div class="table-responsive">
            <form action="{{ route('create-payment-online') }}" id="create_form" method="post">
                @csrf
                <div class="form-group">
                    <label for="language">Loại thanh toán </label>
                    <select name="order_type" id="order_type" class="form-control" required readonly>
                        <option value="billpayment">Thanh toán hóa đơn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Số tiền</label>
                    <input class="form-control" id="amount" name="amount"
                        value="{{ priceFormat($totalPayment) }}" readonly />
                </div>
                <div class="form-group">
                    <label for="order_desc">Nội dung thanh toán</label>
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2"
                        placeholder="Nội dung thanh toán" required></textarea>
                </div>
                <div class="form-group" required>
                    <label for="bank_code">Ngân hàng</label>
                    <select name="bank_code" id="bank_code" class="form-control">
                        <option value="">Không chọn</option>
                        <option value="NCB"> Ngan hang NCB</option>
                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                        <option value="SCB"> Ngan hang SCB</option>
                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                        <option value="MSBANK"> Ngan hang MSBANK</option>
                        <option value="NAMABANK"> Ngan hang NamABank</option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                        <option value="HDBANK">Ngan hang HDBank</option>
                        <option value="DONGABANK"> Ngan hang Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngan hang VPBank</option>
                        <option value="MBBANK"> Ngan hang MBBank</option>
                        <option value="ACB"> Ngan hang ACB</option>
                        <option value="OCB"> Ngan hang OCB</option>
                        <option value="IVB"> Ngan hang IVB</option>
                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select name="language" id="language" class="form-control">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="btnPopup">Xác nhận thanh toán</button>
                <button type="submit" class="btn " onclick="history.back()">Hủy</button>
            </form>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">

        </footer>
    </div>
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        // $("#btnPopup").click(function() {
        //     var postData = $("#create_form").serialize();
        //     var submitUrl = $("#create_form").attr("action");
        //     $.ajax({
        //         type: "POST",
        //         url: submitUrl,
        //         data: postData,
        //         dataType: 'JSON',
        //         success: function(x) {
        //             console.log(x.data)
        //             if (x.code === '00') {
        //                 // if (window.vnpay) {
        //                 //     vnpay.open({width: 768, height: 600, url: x.data});
        //                 // } else {
        //                 //
        //                 // }
        //                 location.href = x.data;
        //                 return false;
        //             } else {
        //                 alert(x.Message);
        //             }
        //         }
        //     });
        //     return false;
        // });
    </script>


</body>

</html>
