<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title ?></title>
</head>
<body>
<div class="container">
    <div class="row mt-2">
        <div class="col-sm-12">
            <h2 class="text-center"><?= $title?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form class="row" action="<?= BASE_URL.'?route=change-text-post' ?>" method="POST" id="textForm">

                <div class="col-sm-12">
                    <textarea class="form-control" name="text" rows="7" placeholder="Please enter the words to scramble" required ></textarea>
                </div>
                <div class="col-sm-12 mt-2">
                    <label class="fw-bold">Direction</label>
                    <select class="form-control" name="direction" id="direction">
                        <option  value="directly"  selected>Directly</option>
                        <option value="reverse" >Reverse</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success mt-2">Generate</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <p id="scrambledTextWrapper">Your words will come here!</p>
            <input type="hidden" name="scrambledText" id="scrambledText" value="">
            <button class="btn btn-outline-primary" type="button" id="convertToOriginal" disabled data-bs-toggle="tooltip" data-bs-placement="bottom">Convert To Original</button>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>

        $(document).on("click", "#convertToOriginal", function (){
            let scrambledText = $("#scrambledText").val().trim();
            if(scrambledText.length <= 0){
                alert("You have to generate a directly scrambled text");
                return false;
            }

            $('#direction').val('reverse').attr("selected", "selected");
            $("#textForm").submit();
        });

        $(document).on("submit", "#textForm", function (){

            let action = $(this).attr("action");
            let formData = $(this).serializeArray();
            $.ajax({
                url : action,
                type : 'POST',
                data : formData,
                dataType:'json',
                success : function(data) {
                    if(data.status != 200){
                        alert(data.message);
                        $("#scrambledText").val('');
                        $("#convertToOriginal").prop("disabled", true);
                        return false;
                    }

                    $("#scrambledTextWrapper").html(data.text);
                    $("#scrambledText").val(data.text);
                    $("#convertToOriginal").prop("disabled", false);

                },
                error : function(request,error)
                {
                    console.log("Request: "+JSON.stringify(request));
                    console.log("Error: "+error);
                    $("#scrambledText").val('');
                    $("#convertToOriginal").prop("disabled", true);

                }
            });
            return false;
        });
    </script>
</body>
</html>