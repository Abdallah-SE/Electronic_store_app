<style>
*{
    margin:0;
    padding:0;
    border: none;
    outline: none;
    line-height: 1.2;
    font-size: 1em;
}
div.wrapper{
    overflow: hidden;
}
div.wrapper div.empForm{
    width: 700px;
    margin: 0 auto;
}
div.wrapper div.employees{
}
form.appForm{
    width:500px;
    margin: 25px 25px 0 20px;
}
form.appForm fieldset{
    padding: 10px;
    border: 5px solid silver;
    background: #f1f1f1; 
} 
form.appForm fieldset p.message{
    background: green;
    color: black;
    margin: 3px;
    padding: 2px;
    border-radius: .5em .5em .5em .5em;
    font: 20px bold sans-serif, Arial;
}
form.appForm fieldset p.message.error{
    background: #900;
    margin: 1px 0;
    padding: 2px;
}
form.appForm fieldset legend{
    padding: 10px;
    border: 1px solid silver;
    background: #f1f1f3; 
    font: 1.2em 'Arial, sans-serif';
    color:  windowframe;
}
form.appForm table{
    width: 100%;
}
form.appForm label{
    font: 1em sans-serif;
    color: darkblue;
}
form.appForm table tr td input[type=text]
,form.appForm table tr td input[type=number]{
    width: 100%;
    font: 19px sans-serif;
    border: 2px solid darkgray;
    padding: 1%;
}          
form.appForm table tr td input[type=submit]{                
    font: 20px sans-serif;
    border: 1px solid darkgray;
    padding: 1%;
    background: #44cc00;
    color: whitesmoke;
}  
form.appForm table tr td{                
    font: 20px sans-serif;
    border: 1px  darkgray;
    padding: 1%;
}
div.wrapper div.employees table{
    width: 700px;
    margin: 50px 25px 0 20px;
    border-collapse: collapse;
}
div.wrapper div.employees table thead th{
    text-align: left;
    background: activecaption;
    margin: 5px;
    padding: 5px;
    border-left: 3px solid silver;  
    border-right: 3px solid aqua;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 black; 
    border-bottom: 3px solid darkgray; 
    font: 1.09em bold sans-serif, arial;
}
div.wrapper div.employees table tbody td{
    text-align: left;
    padding: 5px;
    border-bottom: 2px solid silver;
    border-top: 2px solid silver;
    font: 1em  sans-serif, arial;
}
div.wrapper div.employees table tbody tr:nth-child(2n) td{
    background: buttonface;
}
div.wrapper div.employees table tbody td a:link,
div.wrapper div.employees table tbody td a:visited{
    color:#44cc00;
}


</style>
<h1>Edit or Add Employees</h1>
         <div class="wrapper">
            <div class="empForm">
                <form class="appForm" method="post" enctype="application/x-www-form-urlencoded">
                    <fieldset>
                        <?php if(isset($_SESSION['message'])){?>
                               <p class="message<?=  isset($error)?$error:''?>"><?=$_SESSION['message'];?></p>
                        <?php unset($_SESSION['message']);}?>
                    <table>

                            <legend>Employee Information</legend>
                            <tr>
                                <td>
                                    <label for="name">Employee name</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="text" name="name" id="name" placeholder="Write the employee name..." maxlength="55" value="<?=  $employee->name;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="age">Employee age</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="number" id="age" name="age" min="23" max="60" value="<?=  $employee->age;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address">Employee address</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="text" id="address" name="address" placeholder="Write the employee address..." maxlength="100" value="<?=  $employee->address;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="salary">Employee salary</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="number"  id="salary" step=".01" name="salary" min="1500" max="9000" value="<?=  $employee->salary;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tax">Employee tax(%)</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="number"  id="tax" step=".01" name="tax" min="1" max="5" value="<?=  $employee->tax;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Save" name="submit">
                                </td>
                            </tr>
                        </table>
                   </fieldset>
                </form> 
            </div>
        </div>