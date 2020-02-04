<html>
    <head>
        <title>Student </title>

        <link rel="stylesheet" type="text/css" href="task.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!--icon-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!--form validation-->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    </head>

    <body>
        <br /><br />

        <br />
    <center><h1>Student Form</h1></center>
    <br />
    <form action="student.php" method="POST"  id="student_form" name="student" >
        <div class="table-responsive">
            <table class="table table-bordered" id="insert">
                <tr>

                    <th >Student Name</th>
                    <th>Passing Year</th>
                    <th >CPI </th>
                    <th >Address</th>
                    <th >Gender</th>
                    <th >College Name</th>
                    <th >DOB </th>

                    <th >Comments</th>
                    <th> <div align="right">
                            <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                        </div>
                    </th>
                </tr>
            </table>


            <div align="center">
                <button type="button" name="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
            <br />

        </div>

    </form>
</body>
</html>
<script type="text/javascript">


//          //add nd remove row//
    $(document).ready(function () {
        var count = 1;
        $('#add').click(function () {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";

            html_code += '<td class="bv_validate"><input type=text name="student_name[0]"  autocomplete="off" id="student_name"data-validation="length" class="table table-bordered student_name"/></td>';
            html_code += '<td class="bv_validate"><input type=text name=name id="passing_year" data-validation="date"class="table table-bordered passing_year"/></td>';
            html_code += '<td class="bv_validate"><input type=text name=name id="CPI" data-validation="number" class="table table-bordered CPI"/></td>';
            html_code += '<td class="bv_validate"><input type=text name=name id="address"data-validation="length" class="table table-bordered address"/></td>';
            html_code += '<td class="bv_validate"><select class="type" name="gender"><option value="empty"></option><option value="male">male</option><option value="female">female</option></select></td>';
            html_code += '<td class="bv_validate"><input type=text name=name id="college_name" data-validation="length"class="table table-bordered college_name"/></td>';
            html_code += '<td class="bv_validate"><input type=date name=name id="DOB" data-validation="date" class="table table-bordered DOB"/></td>';

            html_code += '<td class="bv_validate"><input type=text name=name id="comments" data-validation="length" class="table table-bordered comments"/></td>';
            html_code += "<td><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs remove'>-</button></td>";
            html_code += "</tr>";
            $('#insert').append(html_code);

        });


        $(document).on('click', '.remove', function () {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });



        //insert ajax with validation//
        $('#submit').click(function () {
            var validate_data = 0;
            var id = [];
            var student_name = [];
            var passing_year = [];
            var CPI = [];
            var address = [];
            var gender = [];
            var college_name = [];
            var DOB = [];
            var comments = [];


            $('.id').each(function () {
                if ($(this).val() == "") {
                    $(this).parent().append("This field is required");
                    validate_data = 1;
                } else
                {
                    id.push($(this).val());
                }
            });

            $('.student_name').each(function ()
            {
                if ($(this).val() == "")
                {
                    $(this).parent().append("This field is required");
                    validate_data = 1;
                } else
                {
                    student_name.push($(this).val());
                }
            });


            $('.passing_year').each(function ()
            {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    passing_year.push($(this).val());
                }
            });
            $('.CPI').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    CPI.push($(this).val());
                }
            });
            $('.address').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    address.push($(this).val());
                }
            });
            $('.type').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    gender.push($(this).val());
                }
            });
            $('.college_name').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    college_name.push($(this).val());
                }
            });
            $('.DOB').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    DOB.push($(this).val());
                }
            });


            $('.comments').each(function () {
                if ($(this).val() == "")
                {
                    validate_data = 1;
                    $(this).parent().append("This field is required");

                } else
                {
                    comments.push($(this).val());
                }
            });

            if (validate_data == 0)
            {
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: {id: id, student_name: student_name, passing_year: passing_year, CPI: CPI, address: address, gender: gender, college_name: college_name, DOB: DOB, comments: comments},
                    success: function (data) {

                        alert(data);
                        window.open("student.php", "_self");

                        $("td[contentEditable='true']").text("");
                        for (var i = 2; i <= count; i++)
                        {
                            $('tr#' + i + '').remove();
                        }
//    fetch_item_data();
                    }
                });
            }
        });
    });

    //ajax
// Validation for insert
    $('#student_form').validate({// initialize the plugin
        // other options
    });
    $.validator.addClassRules({
        student_validate: {
            required: true
        }
    });
</script>


