function submitregdata()
{
    $.post("../handlers/submitregdata.php",{
        'can_name':document.getElementById('can_name').value,
        'can_uid':document.getElementById('can_uid').value,
        'can_fname':document.getElementById('can_fname').value,
        'can_dob':document.getElementById('can_dob').value,
        'can_mob':document.getElementById('can_mob').value,
        'can_email':document.getElementById('can_email').value},
    function(data,status)
    {
        resarr=data.split("~");
        if(resarr[0]=='d')
        {
            document.location="../pages/regpass.php?reg="+resarr[1]+"&pass="+resarr[2];
        }
        else
        {
            alert(data);
        }
    }
    )
}


