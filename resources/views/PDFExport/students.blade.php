<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Students</title>
</head>
<body>
    @php
        $levels = $students->filter(function ($student) {
            return $student->levelName;
        });
    @endphp
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
    </table>
        <hr>
    <table class="table">
        <thead>
            <tr>
                <th>LAST NAME</th>
                <TH>FIRST NAME</TH>
                <TH>MIDDLE NAME</TH>
                <TH>EMAIL</TH>
                <TH>CONTACT #</TH>
                <TH>GUARDIAN #</TH>
                <TH>LEVEL</TH>
                <TH>SECTION</TH>
            </tr>
        </thead>
        <tbody style="text-transform: uppercase; font-weight: bold;">
            @foreach($students as $student)
                <tr>
                    <td>{{$student->lname}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->middlename ?? 'N/A'}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->contactno ?? 'N/A'}}</td>
                    <td>{{$student->guardianContactNo ?? 'N/A'}}</td>
                    <td>{{$student->levelName ?? 'N/A'}}</td>
                    <td>{{$student->sectionCode ?? 'N/A'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>