<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Fees</title>
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
            <td>&nbsp; &nbsp; &nbsp; &nbsp;Level: {{$level->name}}</td>
            <td></td>
            <td>
                Date: {{date("Y-m-d")}}
            </td>
        </tr>
        

        <tr>
            <td colspan="3">
                <center><h3>TUITION FEE AND OTHER SCHOOL FEES</h3></center>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <center><h4>AY {{$SY->name}}</h4></center>
            </td>
        </tr>

    </table>

    <table  width="100%">

        <!-- Body -->
        <tr>
            <th>PARTICULARS</th>
            <th>CASH</th>
        </tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Registration</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->registration}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Tuition Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->tuition}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Insurance Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->insurance}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Library Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->library}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Science Laboratory Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->science}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Computer Laboratory Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->computer}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Athletics Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->athletics}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Miscellaneous Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->misc}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Books</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->books}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">School Uniform</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->school_uniform}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">P.E. Uniform</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{$level->pe_uniform}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">_</td>
    <td style="border: 1px solid black; padding-left: 10px;">_</td>
</tr>



<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;"><b>Total</b></td>
    <td style="border: 1px solid black; padding-left: 10px;"><b>P{{$level->totalFees}}</b></td>
</tr>

       

    </table>
    
</body>
</html>