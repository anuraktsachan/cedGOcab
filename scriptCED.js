$(document).ready(function() {
    $('#dropdown1').on('change', function() {
        if ($(this).val() == 50) {
            $('#dropdown2').val('');
            $('#dropdown2').attr("disabled", "disabled");
        } else {
            $('#dropdown2').removeAttr("disabled", "disabled");
        }
    });


    $("#userInfo2").hide();
    $("#requestUpdInf").click(function() {
        $("#userInfo1").hide();
        $("#userInfo2").show();

    });
    $("#sendUpdInf").click(function() {
        $("#userInfo2").hide();
        $("#userInfo1").show();

    });


    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
    setInputFilter(document.getElementById("dropdown2"), function(value) {
        return /^-?\d*$/.test(value);
    });
    $("#button1").click(function(e) {
        if ($('#dropdown3').val() == $('#dropdown4').val()) {
            alert("Current and destination location can'nt be same.");
        } else {
            e.preventDefault();
            var carType = $("#dropdown1").val();
            var luggage = $("#dropdown2").val();
            var currentLoc = $("#dropdown3").val();
            var destn = $("#dropdown4").val();

            $.ajax({
                type: "POST",
                url: "dataCED.php",
                data: { carType: carType, luggage: luggage, currentLoc: currentLoc, destn: destn },
                success: function(result) {
                    var newFare = result;
                    // $("#fare").val(newFare);
                    $("#fare").val(newFare);

                }

            });
        }

    });


});