document.addEventListener("DOMContentLoaded", () => {
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    var id_new = getParameterByName('id_new');


    list_btn_tmp = document.getElementsByClassName("btn_rep");

    let list_btn = Array.from(list_btn_tmp);

    list_btn.forEach(function (btn) {
        btn.addEventListener('click', function () {

            id_cmt = btn.closest('.box_reply').getAttribute('id_comment');
            console.log(id_cmt);

            btn.closest('.box_reply').innerHTML = "<form method='post' action='controller/reply_comment.php?id_new=" + id_new + "&id_cmt=" + id_cmt + "'>"
                + " <input type='text' name='txt_reply_comment'>"
                + " <input type='submit' name='btn_reply_comment' value='trả lời'>"
                + "</form>"
                + "";


        });
    });

});

function confirm_pay(id_user, date, sum_price) {
    alert("Xác nhận thanh toán thành công");
    $.ajax({
        type: "POST",  //type of method
        url: "controller/confirm_pay.php",  //your page
        data: { id_user: id_user, date: date, sum_price: sum_price },// passing the values
        success: function (res) {
            location.reload();
        }
    });
};


