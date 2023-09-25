</div>
<?php include('script.php') ?>

<script>
$(document).ready(function() {
    // var local_store = localStorage.setItem('total_value', $('#total_amount').val());
    // alert('');
    // $('#withdraw').on('keyup',function(){
    //     // alert('');
    //     var withdraw = parseInt($(this).val());
    //     // console.log(total);
    //     var total_amount = parseInt($('#total_amount').val());
    //     console.log(total_amount);
    //     var min = total_amount - withdraw;
    //     $('#total_amount').val(min);
    // })



    var initialTotalAmount = parseFloat($('#total_amount').val());

    $('#withdraw').on('keyup', function() {
        var withdraw = $(this).val();

        // Check if the withdraw field is empty, and if so, display the default value
        if (withdraw === '') {
            $('#total_amount').val(initialTotalAmount.toFixed(2));
            return;
        }

        withdraw = parseFloat(withdraw);
        var currentTotalAmount = initialTotalAmount - withdraw;
        $('#total_amount').val(currentTotalAmount.toFixed(2));
    });

    // Listen for changes to the withdraw field using "input" event
    $('#withdraw').on('input', function() {
        var withdraw = $(this).val();

        // Check if the withdraw field is empty, and if so, display the default value
        if (withdraw === '') {
            $('#total_amount').val(initialTotalAmount.toFixed(2));
            return;
        }

        withdraw = parseFloat(withdraw);
        var currentTotalAmount = initialTotalAmount - withdraw;
        $('#total_amount').val(currentTotalAmount.toFixed(2));
    });
})

function getValue(value) {
    $('#total_amount').val();
    console.log(value.text());
    if (value.text() == "Other Amount") {
        // console.log('Yes');
        $("#total_amount").attr("readonly", false);
        $('#total_amount').val('');
    } else {
        console.log('No');
        $("#total_amount").attr("readonly", true);
        $('#total_amount').val(value.text());
    }
}

function payment_check(value, id, userid = null, useramount = null, action) {
    var status = $(value).val();
    var id = id;
    $.ajax({
        url: "payment_check.php",
        type: "POST",
        data: {
            'status': status,
            'id': id,
            'user_id': userid,
            'user_amount': useramount,
            'action': action,
        },
        success: function(data) {
            // console.log(data);
            // $('#message').text('');
            var rp = data.replace(/\"/g, "")
            // console.log(data);
            if (data) {
                location.href = 'payment_proof.php?msg=' + rp;
                $('#message').show();
                $('#message').text(rp);
            }
        }
    })
    // console.log(status+','+id);
}

function get_rent(value) {
    // console.log(value);
    $('#vip').val();
    $('#price').val();
    var val = value.closest('tr');
    var sec_val = val.prev();
    // console.log(sec_val.find('td:eq(0)').text());
    var vip = sec_val.find('td:eq(0)').text();
    var price = sec_val.find('td:eq(3)').text();
    var income = sec_val.find('td:eq(4)').text();
    var machine_id = sec_val.find('input[type=hidden][name=machine_id]').val();
    $('#vip').val(vip);
    $('#price').val(price);
    $('#income').val(income);
    $('#m_machine_id').val(machine_id);
}

function autoRefresh(user_id) {
    var pageLoadTime = <?php echo $_SESSION['page_load_time']; ?>;

    // Calculate the current timestamp
    var currentTime = Math.floor(Date.now() / 1000); // Convert to seconds

    // Calculate the time difference in seconds
    var timeDifference = currentTime - pageLoadTime;
    // window.location = window.location.href;
    if (timeDifference >= 24 * 60 * 60) {
        $.ajax({
            url: 'load_daily_machine.php',
            type: 'POST',
            data: {
                'user_id': user_id,
            },
            success: function(data) {
                // console.log(data);
                var rp = data.replace(/\"/g, "")
                if (rp = 'ok') {
                    window.location = window.location.href;
                }
            }
        });
    }
}


$('.pay_link').on('click', function() {
    var id = $(this).data('id');
    // console.log(id);
    $('.pay_prof').attr("src", id);
})

$('#add_rent').on('click', function() {
    // console.log('Yes');
    var vip_v = $('#vip').val();
    var price_p = $('#price').val();
    var income = $('#income').val();
    var user_idd = $('#user_id').val();
    var machine_idd = $('#m_machine_id').val();
    // console.log('Vip'+vip_v+'Price'+price_p+'User Id'+user_idd+'Machine Id'+machine_idd);
    $.ajax({
        url: "add_rent.php",
        type: "POST",
        data: {
            'vip': vip_v,
            'price': price_p,
            'user_id': user_idd,
            'income' : income,
            'machine_id': machine_idd,
        },
        success: function(data) {
            // console.log(data);
            var rp = data.replace(/\"/g, "");

            if (data) {
                $('#message').show();
                $('#message').text(rp);
            }

        }
    })
});

$('#referral_link').on('click', function() {
    var url = $('#code_referral').text().trim();
    // console.log(url);
    var tempInput = $('<input>');
    $('body').append(tempInput);
    tempInput.val(url).select();
    document.execCommand('copy');
    tempInput.remove();
    alert('Copied');
})

var user_id = <?=$user_id?>;


setInterval('autoRefresh(user_id)', 24 * 60 * 60 * 1000);
</script>


</body>

</html>