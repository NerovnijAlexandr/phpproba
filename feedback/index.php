<?php

?>

<div class="content">
    <h2>Форма обратной связи</h2>
    <form method="post" onsubmit="sendData(); return false;" id="feedbackForm">
        <div class="p5">
            <div>
                <label for="name">Имя: </label>
                <input type="text" name="name" id="name">
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="p5">
            <div>
                <label for="email">Имя: </label>
                <input type="text" name="email" id="email">
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="p5">
            <div>
                <label for="message">Имя: </label>
                <textarea name="message" id="message"></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div>
            <button type="submit">Отправить</button>
        </div>
    </form>
    <style>
        .error{border-color:red;}
        .invalid-feedback{color:red;}
        .p2{padding: 5px 0;}
        .p5{padding: 15px 0;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">

        function sendData()
        {
            let form = '#feedbackForm';
            let dataForm = $(form).serialize();
            $('*', form).removeClass('error');
            $('.invalid-feedback').empty();
            $.ajax({
                url: 'server.php',
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(responce){
                    console.log(responce);
                    for(key in responce)
                    {
                        $(`[name="${key}"]`, form).addClass('error');
                        $(`[name="${key}"]`, form).siblings('.invalid-feedback')
                            .html( responce[key]
                                .join("<br>") )
                            .show();
                    }
                }
            });
        }
    </script>
</div>
