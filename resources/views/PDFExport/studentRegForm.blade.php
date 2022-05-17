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
            /* border: 1px solid black; padding-left: 10px; */
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
        
        <!-- Header -->
        <tr>
            <td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp;Name: {{$student->lname . ', ' . $student->name . ' ' . $student->middlename}}</td>
            <td>Level: {{$student->currentEnrollment->sectionName}}</td>
        </tr>
        <tr>
            <td>&nbsp; &nbsp; &nbsp; &nbsp;Level: {{$student->currentEnrollment->levelName}}</td>
            <td></td>
            <td>
                Date: {{date("Y-m-d")}}
            </td>
        </tr>
        

        <tr>
            <td colspan="3">
                <center><h3>ENROLLMENT FORM</h3></center>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>INSTRUCTOR</th>
        </tr>
        @foreach($subjects as $subject)
            <tr style="border: 1px solid black; padding-left: 10px;">
                <td style="border: 1px solid black; padding-left: 10px;">{{$subject->name}}</td>
                <td style="border: 1px solid black; padding-left: 10px;">{{$subject->code}}</td>
                <td style="border: 1px solid black; padding-left: 10px;">{{($subject->fName ? $subject->lname . ', ' . $subject->fName : 'To be advised')}}</td>
            </tr>
        @endforeach
        

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