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
        <div class="col-md-12">
            <div class="alert alert-info">
                This page shows the report of job hits(hits table). Query:
                <pre>
                    SELECT job_title AS title, COUNT(*) AS hit_count, MIN(date_time) AS first_access, MAX(date_time) AS last_access
                    FROM hits
                    GROUP BY job_title
                    ORDER BY title ASC
                </pre>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Hit Count</th>
                            <th>First Access</th>
                            <th>Last Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($rows) > 0): ?>
                            <?php foreach ($rows as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index + 1?></td>
                                    <td><?php echo $row["title"]?></td>
                                    <td><?php echo $row["hit_count"]?></td>
                                    <td><?php echo $row["first_access"]?></td>
                                    <td><?php echo $row["last_access"]?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-warning">
                                        There is no data to report yet.
                                    </div>
                                </td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
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