<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Search using AJAX</title>
    <!-- Including jQuery is required. -->


    <!-- Including our scripting file. -->
    {{--<script type="text/javascript" src="script.js"></script>--}}
    {{--<!-- Including CSS file. -->--}}
    {{--<link rel="stylesheet" type="text/css" href="style.css">--}}
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
</head>
<style>
    p {
        color: red;
        cursor: pointer;
    }
    p:hover {
        background: yellow;
    }
</style>
<body>
            <!-- Search box. -->
            <input type="text" id="search" placeholder="Search" />
            <!-- Suggestions will be displayed in below div. -->
            <div id="display" hidden>
                <p class="test"></p>
            </div>
            <input type="hidden" value="" id="objectid">

            <a id="toEdit" href="">Edit</a>





<script>
    // function fill(Value) {
    //     //Assigning value to "search" div in "search.php" file.
    //     $('#search').val(Value);
    //     //Hiding "display" div in "search.php" file.
    //     $('#display').hide();
    // }
    // $("#display").click(function(){
    //
    //     $("#search").val("test");
    //     $(this).hide();
    // });


    $(document).ready(function() {

        $('#search').keyup(function() {
            var name = $('#search').val();
            if (name.length >= 3) {
                $("#display").html('');
                        //AJAX is called.
                        $.ajax({
                            //AJAX type is "Post".
                            type: "GET",
                            datatype: 'json',
                            cache: false,
                            //Data will be sent to.
                            url: "{{route('welcome.search')}}",
                            //Data, that will be sent".
                            data: {
                                //Assigning value of "name" into "search" variable.
                                search: name
                            },
                            //If result found, this function will be called.
                            success: function (data) {
                                var lijst = "";
                                //Assigning result to "display" div in "search.php" file.
                                console.log(data);
                                $.each(data.results, function (i, result) {

                                    lijst = lijst + "<p class='test' id='" + result.id + "' style='margin: 0px;'>" + result.Name + "</p>";

                                });
                                $("#display").append(lijst).show();

                                $(".test").click(function(){
                                    var name = $(this).text();
                                    var id = $(this).attr('id');
                                    $("#search").val(name);
                                    $('#display').hide();
                                    $('#objectid').val(id);
                                    $('#toEdit').attr('href', '/testajax/public/klant/' + id + '/edit');

                                });
                            },
                            error: function (data) {
                                console.log(data);
                                $("#display").html('Er is iets fouts gelopen, probeer opnieuw.');
                            }
                        });
            }else{
                $("#display").html('');
            }
            });

    });


</script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}

</body>
</html>
