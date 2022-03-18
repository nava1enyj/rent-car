$('#push-package').click(function (e){
    e.preventDefault();
    $(`input`).removeClass('error');
    let check1 = document.getElementById("flexRadioDefault1");
    let check2 = document.getElementById("flexRadioDefault2");
    let check3 = document.getElementById("flexRadioDefault3");
    let checkbook = document.getElementById("checkBook");

    let price = 0;
    let checkbookForFuture = '0';

    if(checkbook.checked){
        checkbookForFuture = 1;
    }

    if(check1.checked){
        price = 320;
    }
    if (check2.checked){
        price = 420;
    }
    if (check3.checked){
        price = 1420;
    }

    let firstAddress = document.getElementById('firstAddress').value,
        lastAddress = document.getElementById('lastAddress').value,
        numberCard = document.getElementById('numberCard').value,
        timeCard = document.getElementById('timeCard').value,
        cvvCard = document.getElementById('cvvCard').value;

    let formData = new FormData();
    formData.append('price' , price);
    formData.append('checkbookForFuture' , checkbookForFuture);
    formData.append('firstAddress' , firstAddress);
    formData.append('lastAddress' , lastAddress);
    formData.append('numberCard' , numberCard);
    formData.append('timeCard' , timeCard);
    formData.append('cvvCard' , cvvCard);


    $.ajax({
        url: '/send/package',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success (data){
            if(data.status){
                document.location.href = 'successpackageapplication';
            }
            if(data.type === 1){
                data.fields.forEach(function (field){
                    $(`input[id = "${field}"]`).addClass('error');
                    msgReg.textContent = data.massage;
                });
            }
        }
    });
});