<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Good Moral</title>
    <style>
        table, th, td {
            /* border: 1px solid black; */
        }
    </style>
</head>
<body>
    <table  width="100%">
        <!-- Header -->
        <tr>
            <td width="30%">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <img src="{{asset('images/kvalogo.jfif')}}" alt="" style="border-radius: 50%;">
            </td>
            <th width="40%">
                <center>
                    Karunungan Village Academy  <br>
                    Teacher's Village, G.M.A., Cavite
                </center>
            </th>
            <td width="30%"></td>
        </tr>
        
        <!-- Date -->
        <tr>
            <td></td>
            <td></td>
            <td>
                Date: {{date("Y-m-d")}}
            </td>
        </tr>


        <tr>
            <td colspan="3">
                <center><h3>CERTIFICATION</h3></center>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td colspan="3">
            <br><br>
                <p style="padding-left:5em; padding-right:5em;">
                &nbsp; &nbsp; &nbsp; &nbsp;
                        This is to certify that {{$student->name . ' ' . $student->lname}} was enrolled as student of this school, S.Y. {{$SY->name}}.
                    He consistently maintained good moral character during his stay in this school, thus having no disiplinary action taken against him as of to date.

                    <br><br><br>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                        This certification is issued upon the request of {{$student->name . ' ' . $student->lname}} for whatever legal purpose it may serve him.
                </p>
            </td>
        </tr>

        <tr>
            <td>
                <br><br><br>
                <b>&nbsp; &nbsp; &nbsp; &nbsp;Not valid without seal</b>
            </td>
            <td></td>
            <td>
                <br><br><br>
                <center>
                    Atty. Marigold L. Arroyo <br>
                    Principal
                </center>
            </td>
        </tr>

    </table>
    
</body>
</html>