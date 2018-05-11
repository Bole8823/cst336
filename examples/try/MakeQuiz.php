<!DOCTYPE html>
<html>

<head>
    <title> Make Quiz</title>
</head>

<body>


    <input type="text" name="Name" id="name">
    <br>
    <br>
    <input type="text" name="Description" id="description">
    <br>
    <br>

    <div class="container">
        <div class="col-md-3">
            <form>
                <div style="display:none;">
                    <input type="file" multiple name="fileName[]" />
                </div>
                <div>
                    <button id="selectButton" type="button" class="btn btn-primary btn-xs">Pick File(s)</button>
                </div>
                <div id="filesList">
                </div>
                <div>
                    <button id="uploadButton" type="button" class="btn btn-primary btn-xs">Upload File(s)</button>
                </div>
            </form>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
            <div id="results">

            </div>
        </div>

        <button onclick="submitData()">Submit</button>


        <script type="text/javascript" src="results.json"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            // 1. Get rid of file input button
            //$("form button:nth-of-type(1)").click(function() {
            $("#selectButton").click(function() {
                console.log("clicked")
                $("form input[type='file']").trigger("click")
            })
            // 2. Use ajax to submit files
            $("form input[type='file']").change(function(e) {
                $('#filesList').empty();
                $.map(this.files, function(val) {
                    $('#filesList')
                        .append($('<div>')
                            .html(val.name)
                        );
                });
            })
            // 3. Send files with ajax
            $('#uploadButton').click(function(e) {
                // ONLY SENDING ONE FILE WITH PUT, SO IF YOU WANT MULTIPLE,
                // EXECUTE MULTIPLE AJAX CALLS, ONE FOR EACH FILE 
                // (separate progress bars for each file, etc, etc)
                // Get the JavaScript version of the input, 
                // then the first element of the files array (only sending one)
                var file = $("form input[type='file']")[0].files[0]
                var reader = new FileReader();
                reader.onload = function(e) {
                    var fileBinary = reader.result;
                    var fileMimeType = file.type;
                    makeAjaxCall(fileBinary, fileMimeType)
                }
                reader.readAsArrayBuffer(file);
            });
            function makeAjaxCall(blob, mimeType) {
                setProgress(0);
                $.ajax({
                        url: "uploadFile.php",
                        type: "PUT",
                        data: blob,
                        processData: false,
                        contentType: false,
                        mimeType: mimeType,
                        cache: false,
                        // This part gives up chunk progress of the file upload
                        xhr: function() {
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    setProgress(percent);
                                }, true);
                            }
                            return xhr;
                        }
                    })
                    .done(function(data, status, xhr) {
                        console.log('upload done');
                        //window.location.href = "<?php echo BASE_PATH; ?>/assets/<?php echo $controller->group; ?>";
                        console.log(xhr);
                        $("#results").html(xhr.responseText)
                    })
                    .fail(function(xhr) {
                        console.log('upload failed');
                        console.log(xhr);
                    })
                    .always(function() {
                        //console.log('done processing upload');
                    });
            }
            function setProgress(percent) {
                $(".progress-bar").css("width", +percent + "%");
                $(".progress-bar").text(percent + "%");
            }
            function submitData() {
                var name = document.getElementById("name");
                var description = document.getElementById("description");
                var nameVal = name.value;
                var descriptionVal = description.value;
               
                var request1 = $.post("dbPush.php", { name: nameVal , description: descriptionVal });
                console.log(request1);
                window.location.href="questions.html";
            }
        </script>




</body>

</html>
