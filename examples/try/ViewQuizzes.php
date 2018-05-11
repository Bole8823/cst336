<!DOCTYPE html>
<html>

<head>
    <title>Quizzes List </title>
</head>

<body>


    <script type="text/javascript" src="results.json"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript">
        $.ajax({
            url: "dbGetQuizz.php",
            type: "GET",
        });
        var scene = {};
        $.getJSON('results.json', function(data) {
            scene = data;
            console.log(scene);
        });
        var scene1 = {};
        $.getJSON('questions.json', function(data) {
            scene1 = data;
            console.log(scene1[2]);
            var l = scene1.length;
            console.log(l)
        });
    </script>

</body>

</html>