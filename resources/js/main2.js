
let pathparts = location.pathname.split('/');
let base_url = location.origin+'/'+pathparts[1].trim('/');
function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function increaseValue() {
    var value = parseInt($('.number').val(), 10);
    value = isNaN(value) ? 0 : value;
    value++;
    $('.number').val(value);
}

function decreaseValue() {
    var value = parseInt($('.number').val(), 10);
    value = isNaN(value) ? 0 : value;
    value < 2 ? value = 2 : '';
    value--;
    $('.number').val(value);
}

const firebaseConfig = {
    apiKey: "AIzaSyD6Nt2leK_3iGOBmPybm1rGYndfme8ov8A",
    authDomain: "myblog-b22d7.firebaseapp.com",
    projectId: "myblog-b22d7",
    storageBucket: "myblog-b22d7.appspot.com",
    messagingSenderId: "626165196076",
    appId: "1:626165196076:web:619be27f818cb004c27889",
    measurementId: "G-371YK6B31X"
  };
firebase.initializeApp(firebaseConfig);
    window.onload = function() {
    render();
};

function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container", {
        size: "invisible",
        callback: function(response) {
            submitPhoneNumberAuth();
        }
        }
    );
}

$(document).ready(function () {
    let sdt = "";
    $('#sdt').focus(() => {
        $('.error-phone-number').text('');
    })
    $(document).on('click','#send-OTP',function(){
        let number = $("#sdt").val();
        $.ajax({
            url: 'Check-User',
            type: 'get',
            data:{'user': number}
        })
        .done(function(response){
            if(response != 0){
                passwordUser(number);
            }else{
                sendOTP(number);
                $(document).on('keydown','.code-input',function(e){
                    let key = e.which;
                    if( ((key < 37 || key > 57) && key != 8)){
                        return false;
                    }
                })
                $(document).on('keyup','.code-input',function(e){
                    let key = e.which;
                    if( key >= 37 && key <= 57){
                        if($(this).next().val()){
                            $(this).next().select();
                        }else{
                            $(this).next().select();
                        }
                    }
                    if( key === 8){
                        $(this).prev().select();
                    }
                    else{
                        return false;
                    }
                })
            }
        });
    })
    $(document).on('click','#verify',function(){
        verify();
    })
    function sendOTP(number) {
        sdt = number;
        regex = /^0[0-9]{9}$/
        if (regex.test(number)) {
          number_vn = "+84" + number.substring(1);
          firebase.auth().signInWithPhoneNumber(number_vn, window.recaptchaVerifier).then(function(confirmationResult) {
            // window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            let html = `
            <div class="modal-header border-bottom-0">
                <div style="position:absolute;left:50%;top: 15%;"><h4 style="position: relative;font-weight: bold;left: -50%;">Nh???p m?? x??c nh???n</h4></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="recaptcha-container"></div>
            </div>
            <div class="modal-body">
                <div id="phone-number">
                    <div class="form-title mt-3 mb-3 text-center">
                    <span>Anh nh???p m?? x??c nh???n (6 ch??? s???) ???????c g???i ?????n S??T ${number} ????? ho??n t???t</span>
                    </div>
                    <div class="d-flex flex-column text-center">
                    <form>
                        <div class="number-code">
                            <input type="text" class="code-input">
                            <input type="text" class="code-input">
                            <input type="text" class="code-input">
                            <input type="text" class="code-input">
                            <input type="text" class="code-input">
                            <input type="text" class="code-input">
                        </div>
                        <label class="error-phone-number"></label>
                        <button type="button" class="btn btn-warning btn-block btn-round rounded text-uppercase font-weight-bold" id="verify">Ho??n t???t</button>
                    </form>
                    </div>
                </div>
            </div>
            `;
          $('.modal-content').html(html);
          }).catch(function(error) {
            $("#error").text(error.message);
            $("#error").show();
          });
        } else {
          $('.error-phone-number').text('S??? ??i???n tho???i sai ?????nh d???ng.')
        }
    }
    function verify() {
        var code = "";
        $('.code-input').each(function(){
            code += $(this).val();
        })
        coderesult.confirm(code).then(function (result) {
            var user = result.user;
            let html = `
            <div class="modal-header border-bottom-0">
                <div style="position:absolute;left:50%;top: 15%;"><h4 style="position: relative;font-weight: bold;left: -50%;">Nh???p m???t kh???u</h4></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="recaptcha-container"></div>
            </div>
            <div class="modal-body">
                <div id="phone-number">
                    <div class="form-title mt-3 mb-3 text-center">
                    <span>M???t kh???u ??t nh???t l?? 6 k?? t???</span>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form action="Add-Account" method="post">
                            <div class="add-pass">
                                <div class="form-group">
                                <input type="password" class="form-control password" name="password1" placeholder="Nh???p m???t kh???u" autocomplete="off">
                                <input type="password" class="form-control password" name="password2" placeholder="Nh???p l???i m???t kh???u" autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" name="completed" class="btn btn-warning btn-block btn-round rounded text-uppercase font-weight-bold" value="${sdt}">Ho??n t???t</button>
                        </form>
                    </div>
                </div>
            </div>
            `;
            $('.modal-content').html(html);
        }).catch(function (error) {
            $('.error-phone-number').text('M?? x??c nh???n kh??ng ch??nh x??c.')
        });
    }
    function passwordUser(sdt){
        let html = `
            <div class="modal-header border-bottom-0">
                <div style="position:absolute;left:50%;top: 15%;"><h4 style="position: relative;font-weight: bold;left: -50%;">Nh???p m???t kh???u</h4></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="recaptcha-container"></div>
            </div>
            <div class="modal-body">
                <div id="phone-number">
                    <div class="form-title mt-3 mb-3 text-center">
                    <span>Nh???p m???t kh???u c???a S??T ${sdt}.</span>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form action="Login" method="post">
                            <div class="add-pass">
                                <div class="form-group">
                                    <input type="password" class="form-control password" name="password-user" autocomplete="off">
                                    <label class="error-phone-number"></label>
                                </div>
                            </div>
                            <button id="login" type="button" name="login" class="btn btn-warning btn-block btn-round rounded text-uppercase font-weight-bold" value="${sdt}">Ho??n t???t</button>
                        </form>
                    </div>
                </div>
            </div>
        `;
        console.log(html);
        $('.modal-content').html(html);
    }
    $(document).on('click','#login',function(){
        $.ajax({
            url: 'Login',
            type: 'post',
            data:{
                'user': $(this).val(),
                'pass': $('input[name=password-user]').val(),
            }
        })
        .done(function(response){
            if(JSON.parse(response) == 'ok'){
                Swal.fire({icon: 'success',title: '????ng nh???p th??nh c??ng!',showConfirmButton: false,time: 2000,})
                location.reload();
            }else{
                $('.error-phone-number').text('M???t kh???u kh??ng ch??nh x??c.')
            }
        })
    })
})
