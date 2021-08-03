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
    float: left;
}
div.wrapper div.employees{
    margin: 0 auto;
    width: 800px;
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
         <div class="wrapper">
            <div class="employees">
                <table>
                    <a href="/employee/add"><h1><?=@$add_new_employee;?></h1></a>
                    <thead>
                        <tr>
                        <th><?=@$text_employee_table_name;?></th>
                        <th><?=@$text_employee_table_age;?></th>
                        <th><?=@$text_employee_table_address;?></th>
                        <th><?=@$text_employee_table_salary;?></th>
                        <th><?=@$text_employee_table_tax;?></th>
                        <th><?=@$text_employee_table_actions;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(FALSE !=$employees){
                            foreach ($employees as $employee){?>
                        <tr>
                            <td><?= $employee->name?></td>
                            <td><?= $employee->age?></td>
                            <td><?= $employee->address?></td>
                            <td><?= $employee->salary?>L.E</td>
                            <td><?= $employee->tax?></td>
                            <td>
                                <a href="employee/edit/<?=$employee->id?>">Edit<i class='fas fa-edit' style='font-size:25px'></i></a>
                                <a href="employee/delete/<?=$employee->id;?>" onclick="if(!confirm('<?= $text_delete_confirm;?>'))return false;">Delete<i class='fas fa-cut' style='font-size:25px'></i></a>
                            </td>
                        </tr>
                        <?php }}else{?>
                            <td colspan="5"><p>Sorry, no employees data to fetched!!!</p></td>
                        <?php }?>
                        <tr>

                        </tr>  
                    </tbody>
                </table>
            </div>
        </div>