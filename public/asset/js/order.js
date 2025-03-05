$(document).ready(function () {

    

    $('form[name="order"]').submit(function (e) {
        e.preventDefault();
        var formJSON = {};
        var serializedData = $(this).serializeArray();
        let dataId = $('select[name="pizza"] option:selected').data('id');
        let dataSize = $('select[name="size"] option:selected').data('size');
        //console.log(dataId);
        $.each(serializedData, function() {
            formJSON[this.name] = this.value;
        });
        formJSON['id'] = dataId
        formJSON['size'] = dataSize

        $.post($(this).attr('action'), formJSON, function(response) {

            if (response !== '') {
                const res = JSON.parse(response);

                let text = "Here is your order: \n Pizza`s name:" +res.name+ " \n Order`s price: " + res.price + " BYN\n Pizza's size:"+ res.size
                let sauce = "\n And don`t forget your Sause: "+ res.sauce+ "\n Bon appetite!"
    
                alert(text + sauce);
            } else {
                alert("Sorry, we can`t make your order :(")
            }
        });
        
    });
})

