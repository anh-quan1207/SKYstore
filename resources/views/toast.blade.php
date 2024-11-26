<style>
    #toast {
        font-family: system-ui, sans-serif;
        position: fixed;
        top: 32px;
        right: 32px;
        z-index: 999999;
        display: none;
        align-items: center;
        background-color: #fff;
        border-radius: 2px;
        padding: 20px 0;
        min-width: 400px;
        max-width: 450px;
        border-left: 4px solid;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
        transition: all linear 0.3s;
    }

    .toast+.toast {
        margin-top: 24px;
    }

    .toast__icon {
        font-size: 24px;
    }

    .toast__icon,
    .toast__close {
        padding: 0 16px;
    }

    .toast__body {
        flex-grow: 1;
    }

    .toast__title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .toast__msg {
        font-size: 14px;
        color: #888;
        margin-top: 6px;
        line-height: 1.5;
    }

    .toast__close {
        font-size: 20px;
        color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(calc(100% + 32px));
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }

    .toast--show {
        animation: slideInLeft 0.5s forwards;
    }

    .toast--hide {
        animation: fadeOut 0.5s forwards;
    }
</style>

<div id="toast">
    <div class="toast__icon">
        <i class="fa-solid fa-circle-check"></i>
    </div>
    <div class="toast__body">
        <h3 class="toast__title"></h3>
        <p class="toast__msg"></p>
    </div>
    <div class="toast__close">
        <i class="fas fa-times"></i>
    </div>
</div>

<script>
    let result = @json(session('result'));
    console.log(1);
    if (result !== null) {
        showToast(result[1], result[0]);
    }

    function showToast(status, message) {
        let icon, title, borderColor;
        if (status === 'success') {
            icon = 'fa-solid fa-circle-check';
            title = 'Thành công!';
            borderColor = '#47d864';
            console.log(icon);
        } else if (status === 'error') {
            icon = 'fa-solid fa-circle-exclamation';
            title = 'Thất bại!';
            borderColor = '#ff623d';
        } else {
            return;
        }

        $('#toast').css('border-color', borderColor)
            .removeClass('toast--hide')
            .addClass('toast--show')
            .css('display', 'flex');

        $('.toast__icon').html(`<i class="fa-solid ${icon}" style="color:${borderColor};"></i>`);
        $('.toast__title').html(title);
        $('.toast__msg').html(message);

        setTimeout(function() {
            $('#toast').removeClass('toast--show')
                .addClass('toast--hide');
            setTimeout(function() {
                $('#toast').css('display', 'none');
            }, 500);
        }, 3000);
    }


    $('.toast__close').on('click', function() {
        $('#toast').css('display', 'none');
    });
</script>
