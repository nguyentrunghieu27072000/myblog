@extends('LayoutWeb/master')
@section('body')
<style>
    .wrap {
        margin: 10vh 0;
        font-size: 14px;
        font-family: Helvetica Neue, sans-serif;
    }

    .shipment-details,.product-information {
        border: 1px solid #ddd;
        padding: 3vw;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
    }

    .detailed-address {
        width: calc(33% - 10px);
    }

    .select2 {
        height: 40px;
    }

    .select2-container--default .select2-selection--single {
        height: 100%;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }

    button {
        padding: 15px 0px;
        margin-top: 20px;
        background: purple;
        color: #fff;
        border: 1px solid purple;
        cursor: pointer;
        border-radius: 3px;
    }
    .list-product{
        padding-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }
    .item-product{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
    }
    .product-image {
        position: relative;
        height: 80px;
        width: 15%;
        border: 1px solid #ddd;
    }
    .product-image img {
        height: 100%;
        width: 100%;
    }
    .product-image span{
        position: absolute;
        top: -10px;
        right: -10px;
        height: 20px;
        width: 20px;
        line-height: 20px;
        text-align: center;
        background-color: gray;
        color: #fff;
    }
    .product-name{
        width: calc(60% - 20px);
    }
    .into-money{
        width: 25%;
        flex: 0 0 calc(25% - 10px);
        text-align: right;
    }
    .equal{
        height: 2px;
        width: 100%;
        background-color: red;
    }
    .total-money{
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        color: #000;
        font-size: 25px;
    }
</style>
<div style="height: 85px;background-color: #000;"></div>
<div class="main-content">
    <div class="container-fluid">
        <div class="wrap">
            <div class="row">
                <div class="col col-md-7 col-sm-12">
                    <div class="shipment-details">
                        <h4 class="text-center font-weight-bold">Th??ng tin giao h??ng</h4>
                        <div class="d-flex justify-content-between">
                            <label class="label-form" for="name" style="width:60%;">
                                <input class="input-form" type="text" id="name" placeholder="Name" autocomplete="off">
                                <span class="span-form">H??? v?? t??n</span>
                            </label>
                            <label class="label-form" for="sdt" style="width:35%;">
                                <input class="input-form" type="text" id="sdt" placeholder="sdt" autocomplete="off">
                                <span class="span-form">S??? ??i???n tho???i</span>
                            </label>
                        </div>
                        <label class="label-form" for="email">
                            <input class="input-form" type="address" id="address" placeholder="address" autocomplete="off">
                            <span class="span-form">?????a ch???</span>
                        </label>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="form-group detailed-address">
                                <label for="tinh">Th??nh ph??? / T???nh:</label>
                                <select class="form-control" id="tinh">
                                    <option>Ch???n t???nh / th??nh</option>;
                                </select>
                            </div>
                            <div class="form-group detailed-address">
                                <label for="huyen">Qu???n / Huy???n:</label>
                                <select class="form-control" id="huyen">
                                    <option>Ch???n qu???n / huy???n</option>
                                </select>
                            </div>
                            <div class="form-group detailed-address">
                                <label for="xa">Ph?????ng / X??:</label>
                                <select class="form-control" id="xa">
                                    <option>Ch???n ph?????ng / x??</option>
                                </select>
                            </div>
                        </div>
                        <button type="button">X??c nh???n</button>
                    </div>
                </div>
                <div class="col col-md-5 col-sm-12">
                    <div class="product-information">
                        <h4 class="text-center font-weight-bold">Th??ng tin s???n ph???m</h4>
                        <div class="list-product">
                            @if(Session::has('Cart'))
                            @foreach(Session::get('Cart')->products as $item)
                            <div class="item-product">
                                <div class="product-image">
                                    <img src="{{asset('haircare/images').'/'.$item['productInfo']->Image_Product}}">
                                    <span>{{$item['Quanty']}}</span>
                                </div>
                                <span class="product-name">{{$item['productInfo']->Name_Product}}</span>
                                <span class="into-money">{{number_format($item['price'])}}???</span>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <div>
                                <p>T???m t??nh</p>
                                <p>Mi???n ph?? ship ( > 500K )</p>
                                <p>Ph?? v???n chuy???n</p>
                            </div>
                            <div class="text-right">
                                <p>{{number_format(Session::get('Cart')->totalPrice)}}???</p>
                                <p class="font-weight-bold"><i class="icon-plus"></i></p>
                                <p>@if(Session::get('Cart')->totalPrice > 500000) 0??? @else 30,000??? @endif</p>
                            </div>
                        </div>
                        <p class="equal"></p>
                        <div class="total-money">
                            <span>T???ng c???ng (VN??)</span>
                            <span>
                                @if(Session::get('Cart')->totalPrice > 500000) 
                                    {{number_format(Session::get('Cart')->totalPrice)}}??? 
                                @else 
                                    {{number_format(Session::get('Cart')->totalPrice + 30000)}}???
                                @endif 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tinh').select2();
        $('#huyen').select2();
        $('#xa').select2();
        $.ajax({
                url: 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province',
                headers: {
                    'token': '7c4a1e3d-fb1f-11eb-bfef-86bbb1a09031',
                    'Content-Type': 'application/json',
                },
                method: 'GET',
                dataType: 'json',
            })
            .done(function(response) {
                dstinh = response.data;
                let html = `<option>Ch???n t???nh / th??nh</option>`;
                dstinh.forEach(el => {
                    html += `<option value="${el['ProvinceID']}">${el['ProvinceName']}</option>`
                })
                $('#tinh').html(html);
            })
        $(document).on('change', '#tinh', function() {
            $.ajax({
                    url: 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district',
                    headers: {
                        'token': '7c4a1e3d-fb1f-11eb-bfef-86bbb1a09031',
                        'Content-Type': 'application/json',
                    },
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        "province_id": $('#tinh').val()
                    },
                })
                .done(function(response) {
                    dshuyen = response.data;
                    let html = `<option>Ch???n qu???n / huy???n</option>`;
                    dshuyen.forEach(el => {
                        html += `<option value="${el['DistrictID']}">${el['DistrictName']}</option>`
                    })
                    $('#huyen').html(html);
                })
        })
        $(document).on('change', '#huyen', function() {
            $.ajax({
                    url: 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                    headers: {
                        'token': '7c4a1e3d-fb1f-11eb-bfef-86bbb1a09031',
                        'Content-Type': 'application/json',
                    },
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        "district_id": $('#huyen').val()
                    },
                })
                .done(function(response) {
                    dsxa = response.data;
                    let html = `<option>Ch???n ph?????ng / x??</option>`;
                    dsxa.forEach(el => {
                        html += `<option value="${el['WardCode']}">${el['WardName']}</soption>`
                    })
                    $('#xa').html(html);
                })
        })
    })
</script>
@endsection